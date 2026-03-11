<?php
class FinancialCategory extends Model {
    public function __construct() {
        $this->table = 'financial_categories';
        parent::__construct();
    }
}
