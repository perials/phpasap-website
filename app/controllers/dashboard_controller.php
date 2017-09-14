<?php
class Dashboard_Controller extends Auth_Controller {
    
    public function index() {
        $data = array();
        $data['content'] = View::render('modules/dashboard-home');
        $data['navigation'] = View::render('modules/navigation');
        return View::make('templates/dashboard',$data);
    }
    
    public function add_bride() {
        $data = array();
        $data['content'] = View::render('modules/dashboard/add-edit-bride-groom-form');
        $data['navigation'] = View::render('modules/navigation');
        return View::make('templates/dashboard',$data);
    }
    
}