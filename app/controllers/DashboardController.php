<?php

class DashboardController extends Controller {
    public function index() {
        Auth::requireLogin();
        
        $db = Database::getConnection();
        
        // Metrics
        $today = date('Y-m-d');
        
        // Today appointments
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM appointments WHERE appointment_date = :date");
        $stmt->execute(['date' => $today]);
        $appointmentsToday = $stmt->fetch()['total'] ?? 0;
        
        // Total customers
        $stmt = $db->query("SELECT COUNT(*) as total FROM customers");
        $totalCustomers = $stmt->fetch()['total'] ?? 0;
        
        // Services performed today (concluded)
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM appointments WHERE appointment_date = :date AND status = 'concluido'");
        $stmt->execute(['date' => $today]);
        $servicesToday = $stmt->fetch()['total'] ?? 0;
        
        // Today revenue (Appointments)
        $stmt = $db->prepare("SELECT SUM(amount) as total FROM payments p JOIN appointments a ON p.appointment_id = a.id WHERE a.appointment_date = :date");
        $stmt->execute(['date' => $today]);
        $revenueAppointmentsToday = $stmt->fetch()['total'] ?? 0.00;

        // Today revenue (POS Sales)
        $stmt = $db->prepare("SELECT SUM(total_amount) as total FROM sales WHERE date(created_at) = :date");
        $stmt->execute(['date' => $today]);
        $revenueSalesToday = $stmt->fetch()['total'] ?? 0.00;

        $revenueToday = $revenueAppointmentsToday + $revenueSalesToday;

        // Comissões geradas hoje
        $stmt = $db->prepare("SELECT SUM(amount) as total FROM commissions WHERE date(created_at) = :date");
        $stmt->execute(['date' => $today]);
        $commissionsToday = $stmt->fetch()['total'] ?? 0.00;

        // Low stock products
        $stmt = $db->query("SELECT * FROM products WHERE stock_quantity <= min_stock_level AND is_active = 1 ORDER BY stock_quantity ASC");
        $lowStockProducts = $stmt->fetchAll();

        $this->view('layouts/admin', [
            'title' => 'Dashboard | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/dashboard', compact('appointmentsToday', 'totalCustomers', 'servicesToday', 'revenueToday', 'revenueSalesToday', 'commissionsToday', 'lowStockProducts'))
        ]);
    }
    
    // Helper to render partial for layout
    private function renderPartial($view, $data = []) {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        return ob_get_clean();
    }
}
