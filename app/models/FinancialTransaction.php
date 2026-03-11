<?php
class FinancialTransaction extends Model {
    public function __construct() {
        $this->table = 'financial_transactions';
        parent::__construct();
    }

    // Helper functions specific for financial charts and calculations could go here later
}
