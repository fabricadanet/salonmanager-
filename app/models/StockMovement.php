<?php
class StockMovement extends Model {
    public function __construct() {
        $this->table = 'stock_movements';
        parent::__construct();
    }
}
