<?php
class SaleItem extends Model {
    public function __construct() {
        $this->table = 'sale_items';
        parent::__construct();
    }
}
