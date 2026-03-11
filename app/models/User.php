<?php
class User extends Model {
    public function __construct() {
        $this->table = 'users'; // Explicit table name just in case
        parent::__construct();
    }
}
