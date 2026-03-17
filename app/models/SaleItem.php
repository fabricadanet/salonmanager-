<?php
class SaleItem extends Model {
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
}
