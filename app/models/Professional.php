<?php
class Professional extends Model {
    public function __construct() {
        $this->table = 'professionals';
        parent::__construct();
    }

    // Join with users table to get auth info or just keep it simple since it's admin manageable
    public function allWithUser() {
        $sql = "SELECT p.*, u.email FROM professionals p LEFT JOIN users u ON p.user_id = u.id ORDER BY p.name ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function paginateWithUser($page = 1, $limit = 10, $filters = []) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT p.*, u.email FROM professionals p LEFT JOIN users u ON p.user_id = u.id";
        $params = [];
        $conditions = [];
        
        if (!empty($filters['search'])) {
            $conditions[] = "p.name LIKE :search";
            $params['search'] = "%{$filters['search']}%";
        }
        
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $sql .= " ORDER BY p.name ASC LIMIT :limit OFFSET :offset";
        
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
        $sql = "SELECT COUNT(*) as total FROM professionals p";
        $params = [];
        $conditions = [];
        
        if (!empty($filters['search'])) {
            $conditions[] = "p.name LIKE :search";
            $params['search'] = "%{$filters['search']}%";
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
