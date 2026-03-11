<?php
class Commission extends Model {
    public function __construct() {
        $this->table = 'commissions';
        parent::__construct();
    }
}
