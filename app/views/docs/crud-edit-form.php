<h2>CRUD Application: Edit form</h2>

<p>On visiting <code>/crud/edit/5</code> the user should be able to edit user with id <code>5</code>. As discussed earlier, the controller method for this request will be <code>get_edit()</code></p>

<h3>Create the Controller method</h3>
<p>Go ahead and create the <code>get_edit()</code> method in our <code>Crud_Controller</code> class.</p>
<pre class="php"><?php ___('
public function get_edit($id) {    
    //get the user with given id from users table
    $user = DB::table("users")->where("id", "=", $id)->first();
    
    //if user doesn\'t exist then send back to listing page with error
    if( empty($user) )
    return Request::redirect_to("crud/index")->with(["error"=>"User with id ".$id." does not exist"]);
    
    //return the form view
    return View::make("form", ["user"=>$user])]);
}
'); ?></pre>

<p>Note that we are using the same form template that we used for adding new form. Only difference in this case is that we are passing <code>user</code> variable to the view. Let's make a small change in the template to account for this addition.</p>

<pre class="html"><?php ___('
<form>
    <h2><?php echo $title; ?></h2>
    
    <p>
    <?php echo Form::text("first_name", isset($user) ? $user->first_name : null, ["placeholder"=>"First Name"]); ?>
    </p>
    
    <p>
    <?php echo Form::text("last_name", isset($user) ? $user->last_name : null, ["placeholder"=>"Last Name"]); ?>
    </p>
    
    <p>
    <?php echo Form::select("gender", ["male"=>"Male", "female"=>"Female"], isset($user) ? $user->first_name : null); ?>
    </p>
    
    <p><input type="submit"></p>
</form>
'); ?></pre>

<p>The only change we made is in the second and third param of <code>text()</code> and <code>select()</code> method, which is the default value of the corresponding field. Previously it was always <code>null</code>. But now if $user is set then it is not null.</p>
<pre class="html"><?php ___('
isset($user) ? $user->first_name : null
'); ?></pre>
<p>So if it is the edit page then <code>text()</code> will set the value of the text field to <code>$user->first_name</code> else it will be null.</p>

<h3>Save the user details</h3>
<p>This form will be submit to itself since it has no <code>action</code> attribute. So a POST request will be made to /crud/user/{user_id}. Below is the controller method that will handle this request.</p>
<pre class="php"><?php ___('
public function post_edit($id) {
    $user = DB::table("users")->where("id", "=", $id)->first();
            
    if( empty($user) )
    return Request::redirect_to("crud/index")->with(["error"=>"User with id ".$id." does not exist"]);
    
    $rules = [
            "first_name" => "required",
            "last_name" => "required",
            "username" => "required|min:5|unique_username:".$id,
            "gender" => "required"
        ];
    
    $result = Validator::validate(Request::post(), $rules);
            
    if( $result == false ) {
        Session::flash("errors", Validator::errors());
        return Request::redirect_to("crud/edit/".$id)->with_inputs();    
    }
    
    DB::table("users")->where("id","=", $id)
                      ->update([
                            "first_name" => Request::post("first_name"),
                            "last_name" => Request::post("last_name"),
                            "username" => Request::post("username"),
                            "gender" => Request::post("gender")
                        ]);
    
    return Request::redirect_to("crud/edit/".$id);
}
'); ?></pre>