<?php

class DashboardController extends Controller {
    public function index() {
        Auth::requireLogin();
        
        $db = Database::getConnection();
        
        // Timeframe Detection
        $range = $_GET['range'] ?? 'today';
        $startDate = '';
        $endDate = date('Y-m-d 23:59:59');

        if ($range === 'month') {
            $startDate = date('Y-m-01 00:00:00');
        } elseif ($range === 'year') {
            $startDate = date('Y-01-01 00:00:00');
        } else {
            $startDate = date('Y-m-d 00:00:00');
        }

        $dateFilter = date('Y-m-d', strtotime($startDate));

        // Metrics
        $today = date('Y-m-d');
        
        // Today appointments
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM appointments WHERE appointment_date = :date");
        $stmt->execute(['date' => $today]);
        $appointmentsToday = $stmt->fetch()['total'] ?? 0;
        
        // Total customers
        $stmt = $db->query("SELECT COUNT(*) as total FROM customers");
        $totalCustomers = $stmt->fetch()['total'] ?? 0;

        // New customers in range
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM customers WHERE created_at >= :start");
        $stmt->execute(['start' => $startDate]);
        $newCustomersRange = $stmt->fetch()['total'] ?? 0;
        
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

        // TOP 5 CUSTOMERS (Consumption)
        $sqlTopCustomers = "
            SELECT c.name, SUM(total_consumed) as total 
            FROM (
                SELECT customer_id, SUM(total_amount) as total_consumed FROM sales WHERE created_at >= :start AND customer_id IS NOT NULL GROUP BY customer_id
                UNION ALL
                SELECT a.customer_id, SUM(p.amount) as total_consumed 
                FROM payments p 
                JOIN appointments a ON p.appointment_id = a.id 
                WHERE p.created_at >= :start 
                GROUP BY a.customer_id
            ) as combined
            JOIN customers c ON combined.customer_id = c.id
            GROUP BY c.id
            ORDER BY total DESC
            LIMIT 5";
        $stmtTopCustomers = $db->prepare($sqlTopCustomers);
        $stmtTopCustomers->execute(['start' => $startDate]);
        $topCustomers = $stmtTopCustomers->fetchAll();

        // TOP 5 PRODUCTS / SERVICES
        $sqlTopItems = "
            SELECT item_name, SUM(qty) as total 
            FROM (
                SELECT p.name as item_name, SUM(si.quantity) as qty 
                FROM sale_items si JOIN products p ON si.item_id = p.id WHERE si.type = 'product' AND si.sale_id IN (SELECT id FROM sales WHERE created_at >= :start) GROUP BY p.id
                UNION ALL
                SELECT s.name as item_name, COUNT(*) as qty 
                FROM appointments a JOIN services s ON a.service_id = s.id WHERE a.status = 'concluido' AND a.created_at >= :start GROUP BY s.id
            ) as combined
            GROUP BY item_name
            ORDER BY total DESC
            LIMIT 5";
        $stmtTopItems = $db->prepare($sqlTopItems);
        $stmtTopItems->execute(['start' => $startDate]);
        $topItems = $stmtTopItems->fetchAll();

        // TOP 5 PROFESSIONALS
        $sqlTopProfessionals = "
            SELECT p.name, COUNT(*) as total 
            FROM (
                SELECT professional_id FROM appointments WHERE status = 'concluido' AND created_at >= :start
                UNION ALL
                SELECT professional_id FROM sale_items WHERE type = 'service' AND professional_id IS NOT NULL AND sale_id IN (SELECT id FROM sales WHERE created_at >= :start)
            ) as combined
            JOIN professionals p ON combined.professional_id = p.id
            GROUP BY p.id
            ORDER BY total DESC
            LIMIT 5";
        $stmtTopProfessionals = $db->prepare($sqlTopProfessionals);
        $stmtTopProfessionals->execute(['start' => $startDate]);
        $topProfessionals = $stmtTopProfessionals->fetchAll();

        // Low stock products
        $stmt = $db->query("SELECT * FROM products WHERE stock_quantity <= min_stock_level AND is_active = 1 ORDER BY stock_quantity ASC");
        $lowStockProducts = $stmt->fetchAll();

        $this->view('layouts/admin', [
            'title' => 'Dashboard | SalonManager',
            'showSidebar' => true,
            'content' => $this->renderPartial('admin/dashboard', compact(
                'appointmentsToday', 'totalCustomers', 'servicesToday', 'revenueToday', 
                'revenueSalesToday', 'commissionsToday', 'lowStockProducts', 'range',
                'newCustomersRange', 'topCustomers', 'topItems', 'topProfessionals'
            ))
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
