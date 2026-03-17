<?php
class Commission extends Model {
    public function __construct() {
        $this->table = 'commissions';
        parent::__construct();
    }

    public function getDailyCommissionsByProfessionalId($professionalId, $filters = []) {
        $sql = "SELECT DATE(created_at) as date, SUM(amount) as total_amount
                FROM commissions
                WHERE professional_id = :professional_id";
        
        $params = [':professional_id' => $professionalId];

        if (!empty($filters['date_from'])) {
            $sql .= " AND DATE(created_at) >= :date_from";
            $params[':date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $sql .= " AND DATE(created_at) <= :date_to";
            $params[':date_to'] = $filters['date_to'];
        }

        $sql .= " GROUP BY DATE(created_at) ORDER BY DATE(created_at) DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
