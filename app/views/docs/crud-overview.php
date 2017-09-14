<h2>CRUD Application</h2>

<p>In this section we'll create a simple CRUD application that will demonstrate major features, if not all, of PHPasp. CRUD stands for CREATE READ UPDATE DELETE. So in this very basic example we'll be</p>
<ul>
    <li>Adding new User</li>
    <li>Editing existing User</li>
    <li>View all Users</li>
    <li>Delete existing Users</li>
</ul>

<h3>Routing</h3>
<p>First we'll tell our framework which controller method will handle the HTTP request for each of the above.</p>

<p>In <code>app/routes.php</code> add the below line</p>
<pre class="php"><?php ___('
Route::add("CONTROLLER", "crud", "Crud_Controller");  
'); ?></pre>

<p>In above code we are using the CONTROLLER routing feature. Here any HTTP request that begins with <code>http://some-domain.com/crud</code> will be handled by the appropriate method in Crud_Controller.</p>

<p>Here is how it works.</p>
<ul>
    <li>A <code>GET</code> request to <code>/crud/add</code> will be handled by <code>get_add()</code> method of controller.</li>
    <li>A <code>POST</code> request to <code>/crud/add</code> will be handled by <code>post_add()</code> method of controller.</li>
    <li>A <code>GET</code> request to <code>/crud/edit/{user_id}</code> will be handled by <code>get_edit($user_id)</code> method of controller.</li>
</ul>
<p>
So the method that is called is <code>{HTTP_VERB}_{first_url_segment_following_crud}</code>. Any url segment following the first url segment following crud will be passed as method paramter, just as {user_id} is passed to <code>get_edit()</code>
</p>

<p>So CONTROLLER routing is equivalent to below</p>
<pre class="php"><?php ___('
Route::add("GET", "crud/add", "Crud_Controller@get_add");
//In this case it not compulsary to have method that begins with get, you can have any method name
Route::add("POST", "crud/add", "Crud_Controller@post_add");
Route::add("POST", "crud/edit/{user_id}", "Crud_Controller@get_edit");
') ?></pre>

<p>Using CONTROLLER routing saved us few line of code in routes.php. Ofcourse its upto you to decide which is better. The second example gives developer a better choice to decide the url or method name. While in CONTROLLER routing each method has to be prefixed with the HTTP_VERB the method responds to, in second one you can have any method (not necessarily begining with get_ or post_) of any Controller.</p>