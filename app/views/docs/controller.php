<h2>Controllers</h2>
<p>Controller is the 'C' of MVC. Although it comes last in the word MVC, but in actual MVC architecture it is the first thing that comes before V (View) and M (Model). Controller is nothing but a PHP class that contains the business logic. A Controller can make query to database or it can load a model that makes query to database. It can load a view file to render markup.</p>
<p>In route file you define which HTTP Request will be handled by which Controller. Accordingly whenever a request is made, PHPasap will check if any rule is defined for current request. If yes then it will call the corresponding Controller method. So say in <code>routes.php</code> we have below rule</p>
<pre class="php"><?php ___('
Route::add("GET", "welcome", "Pages_Controller@welcome");
'); ?></pre>
<p>Whenever any request is made to <code>http://some-domain.com/welcome</code> then PHPasap will create an instance of Class <code>Pages_Controller</code> and call the <code>welcome</code> method on this instance.</p>

<h3>Controllers in PHPasap</h3>
<p>In PHPasap all controllers live in <code>app/controllers/</code> directory. A controller should always be namespaced under <code>namespace app/Controllers</code>. Below is an example</p>
<pre class="php"><?php ___('
namespace app\Controllers;

class Pages_Controller {
    
}
'); ?></pre>

<h3>Calling a View from Controller</h3>
<p>You can use any view in your Controller without doing anything special just by calling <code>View::make()</code> or <code>View::render()</code>. Note that <code>render()</code> returns html string while <code>make()</code> returns an instance of <code>View_Handler</code> class. Controller method that handles any HTTP Request should always return a string or View_Handler object. For now remember that you are suppose to return the value returned by render() or make() and NOT echo it.</p>
<pre class="php"><?php ___('
namespace app\Controllers;

class Pages_Controller {
    
    public method welcome() {
        return View::make("modules/welcome");
    }
    
}
'); ?></pre>

<div class="panel panel-default note">
    <div class="panel-heading">Controller methods responding to HTTP Requests</div>
    <div class="panel-body">
        <p>It is expected that all the methods that respond to any HTTP request, like method welcome in above case, should return any of the below:</p>
        <ol>
            <li>String</li>
            <li>View Object</li>
            <li>Request Object</li>
        </ol>
        Of course you may anytime echo something for debugging.
    </div>
</div>

<h3>Calling a Model from Controller</h3>
<p>All model files should reside in <code>app/models</code> directory. You are however free to change this directory structure and are free to keep your model files anywhere as long as you follow proper naming convention and use proper namespace. To use a model you will have to use its full name including the namespace.</p>
<p>So say we have a <code>user.php</code> file in models directory containing our User model. Then to use it in our Pages_Controller below is how we would go</p>
<pre class="php"><?php ___('
namespace app\Controllers;

//All models must be namespaced under app/Models
use app\Models\User

class Pages_Controller {
    
    public method welcome() {
        $user = new User();
        return View::make("modules/profile", ["user" => $user->get_profile_details()]);
    }
    
}
'); ?></pre>

<h3>Calling a Controller from Controller</h3>
<p>Although as per standards of MVC you should not call a Controller from another Controller, still if your application demands such requirement, you can anytime call the Controller by directly using its name. Since all Controllers are namespaced under app/Controllers you just have to reference the class name.</p>

<p>Below is an example</p>
<pre class="php"><?php ___('
namespace app\Controllers;

class Pages_Controller {
    
    public method welcome() {
        
        //Users_Controller is in same dir as Pages_Controller
        $users_controller = new Users_Controller();
        
        //rest of the code
    }
    
}
'); ?></pre>