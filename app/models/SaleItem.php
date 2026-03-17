<?php
class SaleItem extends Model {
    public function getProductsByProfessionalId($professionalId, $filters = []) {
        $sql = "SELECT si.*, s.created_at as sale_date, p.name as product_name, c.name as customer_name
                FROM sale_items si
                JOIN sales s ON si.sale_id = s.id
                LEFT JOIN products p ON si.item_id = p.id
                LEFT JOIN customers c ON s.customer_id = c.id
                WHERE si.professional_id = :professional_id 
                AND si.type = 'product'";
        
        $params = [':professional_id' => $professionalId];

        if (!empty($filters['date_from'])) {
            $sql .= " AND DATE(s.created_at) >= :date_from";
            $params[':date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $sql .= " AND DATE(s.created_at) <= :date_to";
            $params[':date_to'] = $filters['date_to'];
        }
        if (!empty($filters['search'])) {
            $sql .= " AND (p.name LIKE :search OR c.name LIKE :search)";
            $params[':search'] = "%{$filters['search']}%";
        }

        $sql .= " ORDER BY s.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function __construct() {
        $this->table = 'sale_items';
        parent::__construct();
    }

    public function getBySaleId($saleId) {
        $sql = "SELECT si.*, 
                       p.name as professional_name,
                       CASE 
                          WHEN si.type = 'product' THEN prod.name
                          WHEN si.type = 'service' THEN serv.name
                       END as item_name
                FROM sale_items si
                LEFT JOIN professionals p ON si.professional_id = p.id
                LEFT JOIN products prod ON si.type = 'product' AND si.item_id = prod.id
                LEFT JOIN services serv ON si.type = 'service' AND si.item_id = serv.id
                WHERE si.sale_id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$saleId]);
        return $stmt->fetchAll();
    }

    public function getByCustomerId($customerId, $filters = []) {
        $sql = "SELECT si.*, s.created_at as sale_date,
                       CASE 
                          WHEN si.type = 'product' THEN prod.name
                          WHEN si.type = 'service' THEN serv.name
                       END as item_name
                FROM sale_items si
                JOIN sales s ON si.sale_id = s.id
                LEFT JOIN products prod ON si.type = 'product' AND si.item_id = prod.id
                LEFT JOIN services serv ON si.type = 'service' AND si.item_id = serv.id
                WHERE s.customer_id = :customer_id";
        
        $params = [':customer_id' => $customerId];

        if (!empty($filters['date_from'])) {
            $sql .= " AND DATE(s.created_at) >= :date_from";
            $params[':date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $sql .= " AND DATE(s.created_at) <= :date_to";
            $params[':date_to'] = $filters['date_to'];
        }
        if (!empty($filters['search'])) {
            $sql .= " AND (prod.name LIKE :search OR serv.name LIKE :search)";
            $params[':search'] = "%{$filters['search']}%";
        }

        $sql .= " ORDER BY s.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
