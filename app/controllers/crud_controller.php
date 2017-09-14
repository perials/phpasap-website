<?php
namespace app\controllers;

class Crud_Controller {
    
    public function get_index() {
        $all_users = DB::table('users')->get();
        return View::make('templates/main', ['content'=>View::render('modules/all-users', ['all_users'=>$all_users])]);
    }
    
    public function get_add() {
        return View::make('templates/main', ['content'=>View::render('modules/form')]);
    }
    
    public function post_add() {
        $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required|min:5|unique_username',
                'gender' => 'required'
            ];
        
        $result = Validator::validate(Request::post(), $rules, $this);
                
        if( $result == false ) {
            Session::flash('errors', Validator::errors());
            return Request::redirect_to('crud/add')->with_inputs();    
        }
        
        DB::table('users')->insert([
                                'first_name' => Request::post('first_name'),
                                'last_name' => Request::post('last_name'),
                                'username' => Request::post('username'),
                                'gender' => Request::post('gender')
                                   ]);
        
    }
    
    public function get_edit($id) {
        $user = DB::table('users')->where('id', '=', $id)->first();
        
        if( empty($user) )
        return Request::redirect_to('crud/index')->with(['error'=>'User with id '.$id.' does not exist']);
    
        return View::make('templates/main', ['content'=>View::render('modules/form', ['user'=>$user])]);
    }
    
    public function post_edit($id) {
        $user = DB::table('users')->where('id', '=', $id)->first();
        
        if( empty($user) )
        return Request::redirect_to('crud/index')->with(['error'=>'User with id '.$id.' does not exist']);
    
        $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required|min:5|unique_username:'.$id,
                'gender' => 'required'
            ];
        
        $result = Validator::validate(Request::post(), $rules, $this);
                
        if( $result == false ) {
            Session::flash('errors', Validator::errors());
            return Request::redirect_to('crud/edit/'.$id)->with_inputs();    
        }
        
        DB::table('users')->where('id','=', $id)
                            ->update([
                                'first_name' => Request::post('first_name'),
                                'last_name' => Request::post('last_name'),
                                'username' => Request::post('username'),
                                'gender' => Request::post('gender')
                            ]);
        
        return Request::redirect_to('crud/edit/'.$id);  
    }
    
    public function unique_username($validator_obj, $field_value, $user_id=null) {
        if($user_id)
            $user_with_same_username = DB::table('users')->where('username', '=', $field_value)->where('id', '!=', $user_id)->count();
        else
            $user_with_same_username = DB::table('users')->where('username', '=', $field_value)->count();
        
        if($user_with_same_username>0)
        $validator_obj->set_error('username','Username already used by someone else');
    }
    
}