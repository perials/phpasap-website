<h2>Routing</h2>
<h3>What are routes</h3>
<p>
Routes are a way to tell your application which controller will handle the given url request. So say someone hits <code>/news/all</code> then there should be a routing rule defined in your routes.php (routing file) that tell which Controller method will handle the request for this url depending upon the HTTP verb.
</p>
<p>In a very typical MVC framework this routing is handled by framework itself depending upon the requested url. So a request to <code>http://some-domain.com/news/all</code> will be handled by <code>News</code> controller (controller is nothing but a php class) which will have a <code>all</code> method.
</p>
<p>However PHPasap doesn't handle the routing implicitly but instead uses user defined routing rules. This gives the developer the ability to handle any request by any controller. So url structure is NOT limited to <code>http://some-domain.com/{controller}/{method}</code> but instead the url can anything and developer will have full control of which Controller will handle the given url request. Read below to learn how to add routing rules.
</p>

<h3>Adding routing rules</h3>
<p>
All your routing rules are defined in <code>app/routes.php</code> file.
</p>

<p>So a rule for <code>GET</code> request to /news/all can be defined as follows</p>
<pre class="php"><?php ___('
Route::add("GET", "news/all", "News_Controller@all");'); ?></pre>
<p>The above line tells the application that whenever a GET request to news/all is made then call the <code>all</code> method of <code>News_Controller</code> class. The <code>News_Controller</code> class will be in <code>app/controller/news_controller.php</code> file. Note how the controller and method name are seperated by <code>@</code> character in third param of add method</p>
<p>
The general format of add method is as below
<pre class="php"><?php ___('
Route::add($HTTP_verb, $url, $Controller@method);'); ?></pre>
</p>
<p>So to declare a rule for POST request to <code>news/add</code> you would add below line</p>
<pre class="php"><?php ___('
Route::add("POST", "news/add", "News_Controller@add");'); ?></pre>

<h3>Passing Variable / Capture a url segment</h3>
<pre class="php"><?php ___('
Route::add("GET", "news/view/{id}", "News_Controller@view");'); ?></pre>
<p>Notice the use of <code>{id}</code> in the second param. If someone hits http://some-domain.com/news/view/24 then {id} will be evaluated to 24 and this will be passed as the first parameter to the view method. Needless to say the view method of News_Controller class must accept atleast one parameter.</p>
<pre class="php"><?php ___('
public method view($id) {
    echo $id; //for http://some-domain.com/news/view/24 this will be 24
}
'); ?></pre>

<h3>Passing a closure to handle a request</h3>
<p>Instead of a controller method you can even pass a closure to handle the request in routes itself.</p>
<pre class="php"><?php ___('
Route::add("GET", "welcome", function(){ echo "Welcome to my app"; });'); ?></pre>
<p>While you may feel that it's of no use in a real world app, consider below example</p>
<pre class="php"><?php ___('
Route::add("GET", "welcome", function(){ echo View::render("welcome"); });'); ?></pre>
<p>In above example we are using a view file to render the html output. We'll learn more on Views in upcomming sections of documentation.</p>
<p>Similary you may make a database query to in the closure itself</p>
<pre class="php"><?php ___('
Route::add("GET", "news/view/{id}", function($id){
    $news_item = DB::table("news")->find($id);
    echo View::render("single-news",["news"=>$news_item]);
});'); ?></pre>
<p>In last two examples we have handled the request in closure itself avoiding use of a controller. This methodology is useful for static pages.</p>

<h3>Controller routing</h3>
<p>Sometimes you may want all urls starting with a particular url segments to be handled by a single controller. This is particularly for a CRUD application. Like <code>user/add-profile</code>, <code>user/edit-profile</code>, <code>user/view-profile</code>.. to be handled by User_Controller. Writing a new route url for each of this can be quite tedious. In such case you can use the controller routing</p>
<pre class="php"><?php ___('
Route::add("CONTROLLER", "user", "User_Controller");'); ?></pre>
<p>Note that we have</p>
<ul>
    <li>Used <code>CONTROLLER</code> as HTTP Verb</li>
    <li>Instead of <code>Controller@method</code> we have only <code>User_Controller</code> i.e the Controller name</li>
</ul>
<p>Now any request starting with http://some-domain.com/user will be handled by method having name same as first url segment after this user prepended by the HTTP Verb and underscore</p>
<ul>
    <li>So GET request <code>user/add-profile</code> will be passed to <code>get_add_profile()</code> method</li>
    <li>So POST request <code>user/add-profile</code> will be passed to <code>post_add_profile()</code> method</li>
    <li>So GET request <code>user/delete/{user_id}</code> will be passed to <code>delete($user_id)</code> method</li>
</ul>

<h3>Throwing 404 error</h3>
<p>To conditionally show a 404 error you may use the below code.</p>
<pre class="php"><?php ___('
Route::show_404();

//OR if you want to show custom 404 page
Route::show_404(View::make("path/to/view/file"));
'); ?></pre>