<?php
class Home_Controller extends Auth_Controller {
    
    public function index() {
        echo Session::get('success');
    }
    
}