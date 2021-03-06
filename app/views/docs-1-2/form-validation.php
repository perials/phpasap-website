<h2>Validation</h2>
<p>PHPasap provides a very simple and extendable Validation library to validate any kind of data. Usually you would be using the validation library to validate the data received from a user submitted form.</p>
<p>Form validation library works on rules. You define a rule or a group of rule for a field. Form validation library check if the provided field satisfies the defined rule. If any error occurs then validation fails.</p>

<h3>Quick Example</h3>
<p>Below is an example usage of the Form Validation</p>
<pre class="php"><?php ___('
$data = [
    "first_name" => "John",
    "last_name" => "Doe",
    "website" => "",
];

//Usually $data will be $_POST

$rules = [
    "first_name" => ["required", "First name"],
    "last_name" => ["required", "Last name"],
    "website" => ["required|url", "Website link"],
];

if( !Validator::validate($data, $rules) ) {
    //validation failed
    $error_array = Validator::errors();    
}
else {
    //validation successful
}
'); ?></pre>

<p>The <code>validate()</code> method accepts two paramters. First is the data (in array format) that has to be validated and the second is the array of rules to check the data against</p>
<p>If validation is successful then <code>validate()</code> returns boolean true. If any errors then it returns boolean false.</p>

<h3>Adding rules</h3>
<p>Rules array has to be an associative array. Each key in this array is the name of the field that has to be validated for. While the value is another numeric array. First element is the rule and second one is the human readable name of the field that will be used by the validation library in the error message.</p>
<p>So say the <code>age</code> field is suppose to be numeric. Then rule to be passed would be</p>
<pre class="php"><?php ___('
"age" => ["numeric", "Age"]                           
'); ?></pre>

<p>Refer table below for the list of rules</p>

<h3>Cascading multiple validation rules</h3>
<p>To apply multiple rules to a field separate each rule by a pipe <code>|</code>. So say <code>age</code> is required and has to be numeric, then below is the rule to be defined for it.</p>
<pre class="php"><?php ___('
"age" => ["required|numeric", "Age"]                           
'); ?></pre>

<h3>Adding you own rules</h3>
<p>Sometimes you may want to add your own custom rules to predefined ones. Like say <code>username</code> should be unique. Let's say we want to add our custom rule unique_username. First we'll add below rule to the rules array</p>
<pre class="php"><?php ___('
"username" => ["unique_username", "Username"]
'); ?></pre>
<p>The validation library will first check if the <code>unique_username</code> exists in its predefined list of validation rules. If not then it will one by one do the following until it finds the callback function/method having this name</p>
<ul>
    <li>The optional third param to <code>validate()</code> method is an object. Validation library will check if this object has any method with the same name <code>unique_username</code>. If method exists it will call that method on the supplied object.</li>
    <li>If third param is not set or if the object given in third param has no method with the name <code>unique_username</code>, then PHPasap will check if there exists a function <code>unique_username()</code>. If it exists, then it calls that function</li>
</ul>

<p>While calling the callback method/function the validator will call with below two arguments and optional third argument</p>
<ul>
    <li>First param provided to the method, while calling, is the validator object itself.</li>
    <li>Second param provided to the method, while calling, is the field value.</li>
    <li>If instead of <code>unique_username</code> you provide <code>unique_username:3</code> then validator will send value <code>3</code> as third param.</li>
</ul>

<p>Both methods are explained below</p>

<h4>Using Controller method as callback function</h4>
<p>Remember the Controller method will be called only if the third param to validate method is the controller object. So below is how you would call the <code>validate()</code> method</p>
<pre class="php"><?php ___('
$rules = [
    "first_name" => ["required", "First name"],
    "last_name" => ["required", "Last name"],
    "website" => ["required|url", "Website link"],
    "username" => ["required|unique_username", "Username"] //unique_username is our custom rule
];

//notice use of $this in third param
if( !Validator::validate($data, $rules, $this) ) {
    //validation failed
    $error_array = Validator::errors();    
}
else {
    //validation successful
}
'); ?></pre>

<p>Now in the same controller create below method</p>
<pre class="php"><?php ___('
public function unique_username($validator_obj, $username_value) {
    if( DB::table("users")->where("username", "=", $username_value)->count() > 0 ) //username already in use
    $validator_obj->set_error("username", "Username already in use");
}
'); ?></pre>

<h4>Using a function in any helper file as callback function</h4>
<p>This option will be called if the third param of <code>validate()</code> method is not set. Else if set with an object, the object should not have a method with callback function name.</p>
<pre class="php"><?php ___('
if( !Validator::validate($data, $rules) { //notice third param is missing here unlike above example
    //validation failed
    $error_array = Validator::errors();    
}
else {
    //validation successful
}
'); ?></pre>
<p>Now in any of the helpers file create the function <code>unique_username</code>. Remember all helpers file in <code>app/helpers</code> are autoloaded.</p>
<pre class="php"><?php ___('
function unique_username($validator_obj, $username_value) {    
    if( DB::table("users")->where("username", "=", $username_value)->count() > 0 ) //username already in use
    $validator_obj->set_error("username", "Username already in use");
}
'); ?></pre>

<p>Few things to note here</p>
<ul>
    <li>Your validation function can use the <code>set_error()</code> method of Validator_Handler object, which is the first param passed, to set error message, if any error.</li>
    <li>Second parameter passed to this function will be value of the field to validate</li>
</ul>

<h3>Redirecting user to another page with input data</h3>
<p>Usually when form validation fails you would redirect user to another page, mostly the page containing submitted form, with all the inputs he had filled. Below is how you would do so.</p>
<pre class="php"><?php ___('
return Request::redirect_to("form-page")->with_inputs();
'); ?></pre>
<p>Here <code>with_inputs()</code> would flash the user submitted data in Session which would then be used by the form library to autofill the user form. So for the form to autopopulate user entered data after error make sure you are using the <?php echo HTML::link('docs/form', 'Form'); ?> class instead of using the HTML input fields directly. Refer the <?php echo HTML::link('docs/request', 'Request'); ?> section for more details on redirecting user.</p>

<h3>List of rules</h3>
<p>Below is the list of predefined rules</p>
<table class="table table-bordered table-striped">
    <tr>
        <th>Rule</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>required</td>
        <td>Checks if given parameter exists and is not <code>empty()</code></td>
    </tr>
    <tr>
        <td>set</td>
        <td>Checks if given parameter exists. Will validate true even if field value is 0 or null</td>
    </tr>
    <tr>
        <td>email</td>
        <td>Checks if given parameter value is a valid email</td>
    </tr>
    <tr>
        <td>max</td>
        <td>Eg usage: max:5 <br/>Check if length of string is less than given integer</td>
    </tr>
    <tr>
        <td>min</td>
        <td>Eg usage: min:5 <br/>Check if length of string is greater than given integer</td>
    </tr>
    <tr>
        <td>regex</td>
        <td>Eg usage: <code><b>regex:</b>/^[A-Za-z][A-Za-z0-9]{5,31}$/</code><br/> Note that syntax is <code>regex:</code> followed by the regular expression. The first colon <code>:</code> after word <code>regex</code> is part of the syntax.</td>
    </tr>
    <tr>
        <td>numeric</td>
        <td>Checks if given parameter has numeric value.<br/>So <code>22.55</code>, <code>"22.55"</code>, <code>22.5</code> would be valid values whereas <code>"22Ab55"</code> would be invalid.</td>
    </tr>
    <tr>
        <td>alnum</td>
        <td>Checks if given parameter contains only alphanumeric characters.<br/> So <code>22.55</code>, <code>"22ABC5"</code> would be valid values whereas <code>"a$b"</code>, <code>"22.55"</code> would be invalid. Note how a float value 22.55 is considered valid but the string type of same value is invalid.</td>
    </tr>
    <tr>
        <td>natural</td>
        <td>Checks if given parameter has positive natural number i.e 0,1,2,3...</td>
    </tr>
    <tr>
        <td>float</td>
        <td>Checks if given parameter is of type float. So <code>23.55</code> will pass validation however <code>"23.55"</code>, <code>23</code>, <code>"23"</code> will fail validation.</td>
    </tr>
    <tr>
        <td>url</td>
        <td>Checks if given parameter value is a valid url</td>
    </tr>
</table>