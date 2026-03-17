<?php
class Sale extends Model {
    public function __construct() {
        $this->table = 'sales';
        parent::__construct();
    }

    public function paginateWithCustomer($page = 1, $limit = 10, $filters = []) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT s.*, c.name as customer_name 
                FROM sales s 
                LEFT JOIN customers c ON s.customer_id = c.id";
        $params = [];
        $conditions = [];
        
        if (!empty($filters['date_from'])) {
            $conditions[] = "DATE(s.created_at) >= :date_from";
            $params['date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $conditions[] = "DATE(s.created_at) <= :date_to";
            $params['date_to'] = $filters['date_to'];
        }
        
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $sql .= " ORDER BY s.created_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue(":{$key}", $val);
        }
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countWithFilters($filters = []) {
        $sql = "SELECT COUNT(*) as total FROM sales s";
        $params = [];
        $conditions = [];
        
        if (!empty($filters['date_from'])) {
            $conditions[] = "DATE(s.created_at) >= :date_from";
            $params['date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $conditions[] = "DATE(s.created_at) <= :date_to";
            $params['date_to'] = $filters['date_to'];
        }
        
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return (int) ($result['total'] ?? 0);
    }
}
