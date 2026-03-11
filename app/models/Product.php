<?php
class Product extends Model {
    public function __construct() {
        $this->table = 'products';
        parent::__construct();
    }
}
