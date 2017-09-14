<h2>CRUD Application: Create New form</h2>
<p>In previous article we looked at how to setup the routing rules to forward the HTTP requests to appropriate Controller method.</p>

<h3>Create the Controller</h3>
<p>Since <code>Crud_Controller</code> is the controller that will be handling all the requests for this app, let's go ahead and create it. So create a file <code>crud_controller.php</code> in <code>app/controllers</code> directory. Insert below code inside it.</p>
<pre class="php"><?php ___('
namespace app\Controllers;

class Crud_Controller {
    
}
'); ?></pre>

<h3>Add Controller method for /crud/add</h3>
<p>Whenever someone visits the <code>/crud/add</code> page he'll see the user form for adding new user. Let's add the method for GET request to /crud/add. Since we are using CONTROLLER routing our method name will be <code>get_add</code>. As explained in previous article, <code>get</code> is the HTTP VERB and add is the first url segment after <code>crud</code>.</p>

<pre class="php"><?php ___('
namespace app\Controllers;

class Crud_Controller {
    
    public function get_add() {
        
    }
    
}
'); ?></pre>

<h3>Add User form</h3>
<p>First we'll create a view file that contains the user form. Go ahead and create a new file <code>form.php</code> in <code>app/views</code> directory and insert below code in it.</p>
<pre class="html"><?php ___('
<form>
    <h2><?php echo $title; ?></h2>
    
    <p>
    <?php echo Form::text("first_name", null, ["placeholder"=>"First Name"]); ?>
    <!-- Above will produce <input type="text" name="first_name" placeholder="First Name"> -->
    </p>
    
    <p>
    <?php echo Form::text("last_name", null, ["placeholder"=>"Last Name"]); ?>
    </p>
    
    <p>
    <?php echo Form::select("gender", ["male"=>"Male", "female"=>"Female"]); ?>
    <!-- Above will produce <select name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select> -->
    </p>
    
    <p><input type="submit"></p>
</form>
'); ?></pre>
<p>Notice the use of <code>Form::text()</code> and <code>Form::textarea()</code>.</p>

<h3>Calling the view file</h3>
<p>Let's call this view file in our controller method.</p>
<pre class="php"><?php ___('
namespace app\Controllers;

class Crud_Controller {
    
    public function get_add() {
        return View::make("form", ["title"=>"Add New User"]);
    }
    
}
'); ?></pre>
<p>Now visiting <code>/crud/add</code> should display the user form</p>

<h3>Validate received data and create user</h3>
<p>Since we haven't added <code>action</code> attribute in form tag this form will submit to itself i.e it will POST to <code>/crud/add</code>. So this request will be handled by a method with name <code>post_add</code>. Let's go ahead and create it.</p>
<pre class="php"><?php ___('
public method post_add() {
    
    //define validation rules
    $rules = [
            "first_name"    => "required",
            "last_name"     => "required",
            "gender"        => "required"
        ];
    
    //run validation
    $result = Validator::validate(Request::post(), $rules);
            
    //if validation fails then flash error message and user filled form details
    if( $result == false ) {
        Session::flash("errors", Validator::errors());
        return Request::redirect_to("crud/add")->with_inputs();    
    }
    
    //if validation successful then create new user
    $user_id = DB::table("users")->insert([
                            "first_name"    => Request::post("first_name"),
                            "last_name"     => Request::post("last_name"),
                            "gender"        => Request::post("gender")
                               ]);
                               
    return Request::redirect_to("crud/edit/".$user_id)->with(["success"=>"User added successfully"]);                               
}
'); ?></pre>
<p>For sake of simplicity rest of class methods are not shown.</p>

<p>Here we first define an array of rules for each field.</p>
<pre class="php"><?php ___('
$rules = [
            "first_name"    => "required",
            "last_name"     => "required",
            "gender"        => "required"
        ];
'); ?></pre>

<p>We then run the validation on all the data received. <code>Request::post()</code>, when called without any parameters, returns entire $_POST array</p>
<pre class="php"><?php ___('
$result = Validator::validate(Request::post(), $rules);
'); ?></pre>
<p>The validator will pick up the appropriate fields that need to be validated and run validation on them. If validation fails then <code>validate()</code> returns a boolean false. All errors can be captured using <code>Validator::errors()</code> which returns an array of errors.</p>

<h3>Pre populating form fields if errors in validation</h3>
<p>You don't have to do anything to pre populate the form details on validation failure. The Form_Helper class will do this for you. If validation fails then below is code that is exectued</p>
<pre class="php"><?php ___('
return Request::redirect_to("crud/add")->with_inputs();
'); ?></pre>
<p>Here <code>with_input()</code> method will flash all the user entered form data to Session. Since we have used <code>Form::text()</code> and <code>Form::select()</code>, the user entered data will be pre populated. The Form_Helper class first checks if the field value is set in session. If set then it sets the value of the field to the session value. You may verify this by leaving any one of the form field empty and filling the rest.</p>