<?php
class Auth_Controller {
    
    protected $user;
    
    public function __construct() {
        if( !Auth::user() ) {
            Session::flash('error_message','You need to login to access this page');
            Request::redirect_to('login',true); //hard redirect
        }
    }
    
}