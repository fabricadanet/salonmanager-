<?php
class Customer extends Model {
    public function __construct() {
        $this->table = 'customers';
        parent::__construct();
    }
}
