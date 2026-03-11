<?php
require_once __DIR__ . '/../models/WebsiteContent.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Professional.php';

class PublicController extends Controller {

    private function getWebsiteData() {
        $model = new WebsiteContent();
        $itemsRaw = $model->all();
        $content = [];
        foreach ($itemsRaw as $item) {
            $content[$item['section']] = $item;
        }
        return $content;
    }

    public function index() {
        $data = $this->getWebsiteData();
        $whatsapp = $data['whatsapp']['content'] ?? '';
        
        $serviceModel = new Service();
        $services = array_slice($serviceModel->where('is_active', 1), 0, 3); // top 3

        $productModel = new Product();
        $products = array_slice($productModel->where('is_active', 1), 0, 3); // top 3

        $this->view('layouts/public', [
            'title' => 'Home | SalonManager',
            'content' => $this->renderPartial('public/home', compact('data', 'services', 'products', 'whatsapp')),
            'whatsapp' => $whatsapp
        ]);
    }

    public function services() {
        $data = $this->getWebsiteData();
        $whatsapp = $data['whatsapp']['content'] ?? '';
        $serviceModel = new Service();
        $services = $serviceModel->where('is_active', 1);

        $this->view('layouts/public', [
            'title' => 'Serviços | SalonManager',
            'content' => $this->renderPartial('public/services', compact('services', 'whatsapp')),
            'whatsapp' => $whatsapp
        ]);
    }

    public function products() {
        $data = $this->getWebsiteData();
        $whatsapp = $data['whatsapp']['content'] ?? '';
        $productModel = new Product();
        $products = $productModel->where('is_active', 1);

        $this->view('layouts/public', [
            'title' => 'Produtos | SalonManager',
            'content' => $this->renderPartial('public/products', compact('products', 'whatsapp')),
            'whatsapp' => $whatsapp
        ]);
    }

    public function book() {
        $data = $this->getWebsiteData();
        $whatsapp = $data['whatsapp']['content'] ?? '';
        $serviceModel = new Service();
        $services = $serviceModel->where('is_active', 1);

        $profModel = new Professional();
        $professionals = $profModel->all();

        $this->view('layouts/public', [
            'title' => 'Agendar Horário | SalonManager',
            'content' => $this->renderPartial('public/book', compact('services', 'professionals', 'whatsapp')),
            'whatsapp' => $whatsapp
        ]);
    }

    public function processBooking() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            
            // For public booking, we just create a rudimentary Customer record or map to existing by phone
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT id FROM customers WHERE phone = ? LIMIT 1");
            $stmt->execute([$data['phone']]);
            $customer = $stmt->fetch();
            
            if (!$customer) {
                // generate customer
                $stmt = $db->prepare("INSERT INTO customers (name, phone) VALUES (?, ?)");
                $stmt->execute([$data['name'], $data['phone']]);
                $customerId = $db->lastInsertId();
            } else {
                $customerId = $customer['id'];
            }

            // Create appointment
            require_once __DIR__ . '/../models/Appointment.php';
            $appointmentModel = new Appointment();
            
            $serviceModel = new Service();
            $service = $serviceModel->find($data['service_id']);
            $durationMinutes = $service['duration'] ?? 30;
            
            $startDateTime = new DateTime($data['appointment_date'] . ' ' . $data['start_time']);
            $endDateTime = clone $startDateTime;
            $endDateTime->modify("+{$durationMinutes} minutes");

            $appointmentModel->create([
                'customer_id' => $customerId,
                'professional_id' => $data['professional_id'],
                'service_id' => $data['service_id'],
                'appointment_date' => $data['appointment_date'],
                'start_time' => $data['start_time'],
                'end_time' => $endDateTime->format('H:i'),
                'status' => 'agendado'
            ]);

            // Redirect back with success message using a simple parameter
            $this->redirect('/agendar?success=1');
        }
    }

    public function contact() {
        $data = $this->getWebsiteData();
        $whatsapp = $data['whatsapp']['content'] ?? '';
        $this->view('layouts/public', [
            'title' => 'Contato | SalonManager',
            'content' => $this->renderPartial('public/contact', compact('data', 'whatsapp')),
            'whatsapp' => $whatsapp
        ]);
    }
    
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}
