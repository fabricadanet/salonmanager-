<?php
require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Professional.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/FinancialTransaction.php';

class AppointmentController extends Controller {
    
    public function __construct() {
        Auth::requireLogin();
    }

    public function index() {
        $customerModel = new Customer();
        $customers = $customerModel->all();

        $professionalModel = new Professional();
        $professionals = $professionalModel->all();

        $serviceModel = new Service();
        $services = $serviceModel->all();

        $this->view('layouts/admin', [
            'title' => 'Agendamentos | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/appointments/index', compact('customers', 'professionals', 'services'))
        ]);
    }

    public function apiEvents() {
        $db = Database::getConnection();
        // Load events for FullCalendar
        $sql = "SELECT a.id, a.appointment_date, a.start_time, a.end_time, a.status, 
                       c.name as customer_name, s.name as service_name, p.name as professional_name
                FROM appointments a
                JOIN customers c ON a.customer_id = c.id
                JOIN services s ON a.service_id = s.id
                JOIN professionals p ON a.professional_id = p.id";
        
        $stmt = $db->query($sql);
        $appointments = $stmt->fetchAll();

        $events = array_map(function($apt) {
            $color = '#3788d8'; // default agendado
            if ($apt['status'] == 'em atendimento') $color = '#f59e0b'; // amber
            if ($apt['status'] == 'concluido') $color = '#10b981'; // green
            if ($apt['status'] == 'cancelado') $color = '#ef4444'; // red

            return [
                'id' => $apt['id'],
                'title' => $apt['service_name'] . ' - ' . $apt['customer_name'] . ' (' . $apt['professional_name'] . ')',
                'start' => $apt['appointment_date'] . 'T' . $apt['start_time'],
                'end' => $apt['appointment_date'] . 'T' . $apt['end_time'],
                'color' => $color,
                'extendedProps' => [
                    'status' => $apt['status']
                ]
            ];
        }, $appointments);

        $this->json($events);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            
            // Calculate end time based on service duration
            $serviceModel = new Service();
            $service = $serviceModel->find($data['service_id']);
            $durationMinutes = $service['duration'] ?? 30;
            
            $startDateTime = new DateTime($data['appointment_date'] . ' ' . $data['start_time']);
            $endDateTime = clone $startDateTime;
            $endDateTime->modify("+{$durationMinutes} minutes");

            $model = new Appointment();
            $model->create([
                'customer_id' => $data['customer_id'],
                'professional_id' => $data['professional_id'],
                'service_id' => $data['service_id'],
                'appointment_date' => $data['appointment_date'],
                'start_time' => $data['start_time'],
                'end_time' => $endDateTime->format('H:i'),
                'status' => 'agendado'
            ]);
            
            $this->redirect('/admin/appointments');
        }
    }

    public function updateStatus() {
        // Change status (like to 'concluido' and generate commission)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;
            $method = $_POST['payment_method'] ?? 'dinheiro'; // for completion

            if ($id && $status) {
                $db = Database::getConnection();
                $model = new Appointment();
                $appointment = $model->find($id);

                if ($appointment) {
                    $model->update($id, ['status' => $status]);

                    // Generate commission & payment if completed
                    if ($status === 'concluido' && $appointment['status'] !== 'concluido') {
                        $serviceModel = new Service();
                        $service = $serviceModel->find($appointment['service_id']);
                        
                        $profModel = new Professional();
                        $professional = $profModel->find($appointment['professional_id']);
                        
                        $commission = $service['price'] * $professional['commission_percentage'];
                        
                        // Insert payment
                        $stmt = $db->prepare("INSERT INTO payments (appointment_id, amount, method) VALUES (?, ?, ?)");
                        $stmt->execute([$id, $service['price'], $method]);

                        // Insert commission
                        $stmt = $db->prepare("INSERT INTO commissions (appointment_id, professional_id, amount) VALUES (?, ?, ?)");
                        $stmt->execute([$id, $appointment['professional_id'], $commission]);
                        $commissionId = $db->lastInsertId();

                        // -- FINANCEIRO AUTOMÁTICO --
                        
                        // 1. Receita Gerada (Agendamento Concluído)
                        $fTransactionModel = new FinancialTransaction();
                        $catStmtInc = $db->query("SELECT id FROM financial_categories WHERE name = 'Agendamento'");
                        $catIdInc = $catStmtInc->fetchColumn() ?: 2; // Fallback

                        $fTransactionModel->create([
                            'category_id' => $catIdInc,
                            'description' => "Agendamento Finalizado #{$id}",
                            'type' => 'income',
                            'amount' => $service['price'],
                            'due_date' => date('Y-m-d'),
                            'payment_date' => date('Y-m-d'), // Assume recebido na hora
                            'status' => 'paid',
                            'reference_id' => $id,
                            'reference_type' => 'appointment'
                        ]);

                        // 2. Despesa Gerada (Comissão a Pagar)
                        if ($commission > 0) {
                            $catStmtExp = $db->query("SELECT id FROM financial_categories WHERE name = 'Comissão Profissional'");
                            $catIdExp = $catStmtExp->fetchColumn() ?: 4; // Fallback

                            $fTransactionModel->create([
                                'category_id' => $catIdExp,
                                'description' => "Comissão Agendamento: {$professional['name']} (#{$id})",
                                'type' => 'expense',
                                'amount' => $commission,
                                'due_date' => date('Y-m-d'),
                                'payment_date' => null, // Fica pendente para acerto
                                'status' => 'pending',
                                'reference_id' => $commissionId,
                                'reference_type' => 'commission'
                            ]);
                        }
                    }
                }
            }
            $this->redirect('/admin/appointments');
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new Appointment();
                $model->delete($id);
            }
            $this->redirect('/admin/appointments');
        }
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}
