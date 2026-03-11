<?php
class Sale extends Model {
    public function __construct() {
        $this->table = 'sales';
        parent::__construct();
    }
}
