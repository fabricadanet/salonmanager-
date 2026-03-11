<?php
class Service extends Model {
    public function __construct() {
        $this->table = 'services';
        parent::__construct();
    }
}
