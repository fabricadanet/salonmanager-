<?php
class WebsiteContent extends Model {
    public function __construct() {
        $this->table = 'website_content';
        parent::__construct();
    }
}
