<?php
class Appointment extends Model {
    public function getByProfessionalId($professionalId, $filters = []) {
        $sql = "SELECT a.*, c.name as customer_name, s.name as service_name
                FROM appointments a
                LEFT JOIN customers c ON a.customer_id = c.id
                LEFT JOIN services s ON a.service_id = s.id
                WHERE a.professional_id = :professional_id";
        
        $params = [':professional_id' => $professionalId];

        if (!empty($filters['date_from'])) {
            $sql .= " AND a.appointment_date >= :date_from";
            $params[':date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $sql .= " AND a.appointment_date <= :date_to";
            $params[':date_to'] = $filters['date_to'];
        }
        if (!empty($filters['search'])) {
            $sql .= " AND (c.name LIKE :search OR s.name LIKE :search)";
            $params[':search'] = "%{$filters['search']}%";
        }

        $sql .= " ORDER BY a.appointment_date DESC, a.start_time DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function __construct() {
        $this->table = 'appointments';
        parent::__construct();
    }

    public function getByCustomerId($customerId, $filters = []) {
        $sql = "SELECT a.*, s.name as service_name, p.name as professional_name 
                FROM appointments a
                LEFT JOIN services s ON a.service_id = s.id
                LEFT JOIN professionals p ON a.professional_id = p.id
                WHERE a.customer_id = :customer_id";
        
        $params = [':customer_id' => $customerId];

        if (!empty($filters['date_from'])) {
            $sql .= " AND a.appointment_date >= :date_from";
            $params[':date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $sql .= " AND a.appointment_date <= :date_to";
            $params[':date_to'] = $filters['date_to'];
        }
        if (!empty($filters['search'])) {
            $sql .= " AND s.name LIKE :search";
            $params[':search'] = "%{$filters['search']}%";
        }

        $sql .= " ORDER BY a.appointment_date DESC, a.start_time DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
