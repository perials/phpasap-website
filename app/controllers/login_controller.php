<?php
class Login_Controller {
    
    public function login_form() {
        
        if( Auth::user() ) 
        return Request::redirect_to('dashboard');
        
        $data = array();
        $data['content'] = View::render('modules/login-form');
        return View::make('templates/dashboard',$data);
    }
    
    
    
    public function login_user() {
        
        $validation_rules = [
                            'email' => ['type'=>'email','required'=>true],
                            'password' => ['required'=>true]
                             ];
        
        $errors = Validator::validate(Request::all(),$validation_rules);
        
        /* Validation fail condition */
        if( !empty($errors) )
        return Request::redirect_to('login')->with(['errors'=>$errors])->with_inputs();
        
        $user = DB::table('users')->where('email','=',Request::get('email'))->where('password','=',Request::get('password'))->first();
        
        /* if user doesn't exist then send back to login page with appropriate message */
        if( empty($user) )
        return Request::redirect_to('login')->with(['errors'=> ['message'=>'Username and password combination invalid'] ])->with_inputs();
        
        Session::set('user_id',$user->id);
        return Request::redirect_to('dashboard');
        
        /*
        if( !Request::get('password') || !Request::get('email')  ) {
            Sescookie::flash('error_message','Email and Password are required fields');
            Sescookie::flash(Request::all());
            return Request::redirect_to('login');
        }
        
        if( filter_var(Request::get('email'), FILTER_VALIDATE_EMAIL) == false ) {
            Sescookie::flash('error_message','Email is invalid');
            Sescookie::flash(Request::all());
            return Request::redirect_to('login');
        }
        
        $user_exists = DB::table('users')->where('email','=',Request::get('email'))->where('password','=',Request::get('password'))->get();
        if( !$user_exists ) {
            Sescookie::flash('error_message','Username and passwords don\'t match');
            Sescookie::flash(Request::all());
            return Request::redirect_to('login');
        }
        
        $user_exists = $user_exists[0];
        Sescookie::set('user_id',$user_exists->id);
        Sescookie::flash('success_message','Logged in successfully');
        return Request::redirect_to('tasks');
        */
    }
    
    /*
    public function register_form() {
        //echo Request::base_url();
        //var_dump($_SERVER);
        $data = array();
        $data['content'] = View::render('modules/register-form');
        View::make('templates/main',$data);
    }
    
    public function register_user() {
        
        $validated = true;
        
        // Check if required fields are set 
        if( !Request::get('name') || !Request::get('email')  ) {
            Sescookie::flash('error_message','Name and Email are required fields');
            Sescookie::flash(Request::all());
            return Request::redirect_to('register');
        }
        
        // Validate email 
        if( filter_var(Request::get('email'), FILTER_VALIDATE_EMAIL) == false ) {
            Sescookie::flash('error_message','Email is invalid');
            Sescookie::flash(Request::all());
            return Request::redirect_to('register');
        }
        
        /* Check if email address already exists 
        $user_exists = DB::table('users')->where('email','=',Request::get('email'))->get();
        if( $user_exists ) {
            Sescookie::flash('error_message','Email is already registered');
            Sescookie::flash(Request::all());
            return Request::redirect_to('register');
        }
        
        // Alright, so we are good to go. Insert the user in database 
        $user_id = DB::table('users')->insert([
                                'email' => Request::get('email'),
                                'name' => Request::get('name'),
                                'password' => generate_random_string(10)
                                    ]);
        
    }
    */
}
