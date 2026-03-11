<?php
class Appointment extends Model {
    public function __construct() {
        $this->table = 'appointments';
        parent::__construct();
    }
}
