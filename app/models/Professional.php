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
}
