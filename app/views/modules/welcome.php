<h1 class="title">Welcome to PHPasap</h1>
<p>This is a sample page for illustrating example usage of PHPasap. To help you get started with this framework a few Controllers, Views and Modules are pre bundled with this framework. For a detailed explanation of this framework you may refer our online documentation by clicking on below url:<br/>
<a href="">http://phpasap.com/docs</a><br/>
OR you may simply go through the code for each of this pages.
</p>
<h3>About this page</h3>
<ul>
    <li>This page is generated without a Controller.</li>
    <li>The markup for this page is written in View file located at <code>app/Views/template/main.php</code></li>
    <li>The routing rule defined for this page contains a closure instead of a Controller@method. Below is the routing rule for this page defined in <code>app/config/routes.php</code>
    <pre><code>Route::add(['GET', '/', function(){
        echo View::render('templates\main');
        }]);</code></pre>
    </li>
</ul>
<p>You can click on the Sample CRUD link in navbar above to check out the CREATE READ UPDATE and DELETE application</p>    