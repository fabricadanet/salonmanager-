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

    private $template;

    public function __construct() {
        $data = $this->getWebsiteData();
        $this->template = $data['config']['content'] ?? 'noir';
    }

    public function index() {
        $website = $this->getWebsiteData(); // Renamed $data to $website for clarity and consistency with the edit
        $whatsapp = $website['whatsapp']['content'] ?? '';
        
        // New Dynamic Sections for index
        $website['services_h'] = $website['services_header'] ?? [];
        $website['products_h'] = $website['products_header'] ?? [];
        // cta, global, social are now handled in getWebsiteData()

        $serviceModel = new Service();
        $services = array_slice($serviceModel->where('is_active', 1), 0, 3); // top 3

        $productModel = new Product();
        $products = array_slice($productModel->where('is_active', 1), 0, 3); // top 3

        $this->templateView('home', [
            'title' => 'Home | SalonManager',
            'data' => $website,
            'services' => $services,
            'products' => $products,
            'whatsapp' => $whatsapp
        ]);
    }

    public function services() {
        $data = $this->getWebsiteData();
        $whatsapp = $data['whatsapp']['content'] ?? '';
        $serviceModel = new Service();
        $services = $serviceModel->where('is_active', 1);

        $this->templateView('services', [
            'title' => 'Serviços | SalonManager',
            'services' => $services,
            'whatsapp' => $whatsapp
        ]);
    }

    public function products() {
        $data = $this->getWebsiteData();
        $whatsapp = $data['whatsapp']['content'] ?? '';
        $productModel = new Product();
        $products = $productModel->where('is_active', 1);

        $this->templateView('products', [
            'title' => 'Produtos | SalonManager',
            'products' => $products,
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

        $this->templateView('book', [
            'title' => 'Agendar Horário | SalonManager',
            'services' => $services,
            'professionals' => $professionals,
            'whatsapp' => $whatsapp
        ]);
    }

    public function processBooking() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Validator::sanitize($_POST);
            
            if (empty($data['service_id']) || empty($data['professional_id'])) {
                $this->redirect('/agendar?error=missing_data');
                return;
            }
            
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
        $this->templateView('contact', [
            'title' => 'Contato | SalonManager',
            'data' => $data,
            'whatsapp' => $whatsapp,
            'logo' => $data['logo']['image'] ?? null
        ]);
    }

    public function privacy() {
        $website = $this->getWebsiteData();
        $this->templateView('privacy', [
            'title' => 'Política de Privacidade | ' . ($website['global']['subtitle'] ?? 'SalonManager'),
            'data' => $website,
            'whatsapp' => $website['whatsapp']['content'] ?? '',
            'content' => $website['privacy']['content'] ?? '<p>Política de privacidade em breve.</p>'
        ]);
    }

    public function terms() {
        $website = $this->getWebsiteData();
        $this->templateView('terms', [
            'title' => 'Termos de Uso | ' . ($website['global']['subtitle'] ?? 'SalonManager'),
            'data' => $website,
            'whatsapp' => $website['whatsapp']['content'] ?? '',
            'content' => $website['terms']['content'] ?? '<p>Termos de uso em breve.</p>'
        ]);
    }

    private function templateView($view, $data = []) {
        $data['website_data'] = $this->getWebsiteData();
        $data['logo'] = $data['website_data']['logo']['image'] ?? null;
        $data['social'] = $data['website_data']['social'] ?? [];
        $data['global'] = $data['website_data']['global'] ?? [];
        
        $templatePath = "templates/{$this->template}/";
        $layoutFile = __DIR__ . "/../views/{$templatePath}layout.php";
        
        extract($data);
        
        // Render content
        ob_start();
        require __DIR__ . "/../views/{$templatePath}{$view}.php";
        $content = ob_get_clean();
 
        // Render layout
        require $layoutFile;
    }
}

