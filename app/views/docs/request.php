<h2>Requests</h2>

<p>The <code>Request_Handler</code> class provides methods that help fetch details of the current request. This class methods can be accessed via the <code>Request</code> alias loader.</p>

<h3>Get $_GET data</h3>
<p>Instead of using a <code>$_GET["some_param"]</code> you are better off with using</p>
<pre><?php ___('
$some_val = Request::get("some_param");
'); ?></pre>
<p><code>get()</code> method returns a boolean false if the request param doesn't exists in $_GET array.</p>

<h3>Get $_POST data</h3>
<pre><?php ___('
$some_val = Request::post("some_param");
'); ?></pre>
<p>Just like <code>get()</code>, <code>post()</code> method returns a boolean false if the request param doesn't exists in $_POST array.</p>

<h3>Check if current request is ajax</h3>
<p>You can if the current request is an ajax request using the below code</p>
<pre><?php ___('
$is_ajax = Request::ajax(); //returns true if ajax else returns false
'); ?></pre>
<p>The <code>ajax()</code> method returns a boolean true if current request is ajax request else it returns a boolean false.</p>

<h3>Redirect to</h3>
<p>You may want to redirect the current request to a different page. Typical use case is when someone fills a form and after successful validation you need to redirect him to a thank you page</p>
<p>Below is the code you will use in your controller.</p>
<pre class="php"><?php ___('
return Request::redirect_to("thank-you");
'); ?></pre>

<p>Kindly take a note of below things</p>
<ul>
    <li>The first parameter provided is a relative url. PHPasap will append the base url to this before redirecting.</li>
    <li>You have to return whatever is received from <code>redirect_to()</code>. It returns an Request_Handler object.</li>
</ul>

<h3>Redirect with data</h3>
<p>Sometimes you may want to redirect to page with some data. Like say somebody, who is not logged in, tries to access an admin page. Then you may want to redirect him to login page with a message that says "You need to login to view this page".</p>
<p>Below is the code you will use in your controller.</p>
<pre class="php"><?php ___('
return Request::redirect_to("login")->with(["error_msg"=>"You need to login to view this page", "flash_var_2"=>"val_2"]);
'); ?></pre>

<p>Then on login page, you may check if any flash data is set, if set then echo it.</p>
<pre class="php"><?php ___('
if( Session::get("error_msg") ) {
    echo Session::get("error_msg");
}

//Similarly Session::get("flash_var_2")
'); ?></pre>

<p>The <code>with()</code> method of Request_Handler class flashes the data provided in first param.</p>

<h3>Redirect with input data</h3>
<p>What if user submits a form, fails validation and now you want to redirect the user back to the form page with all the data that he entered. Below is the code for the same</p>
<pre class="php"><?php ___('
return Request::redirect_to("thank-you")->with_inputs();
'); ?></pre>

<p>The above is same as</p>
<pre class="php"><?php ___('
return Request::redirect_to("thank-you")->with($_POST);
//OR
return Request::redirect_to("thank-you")->with($_GET);
'); ?></pre>