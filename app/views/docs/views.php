<h2>Views</h2>
<p>Views contain the HTML markup. In a typical MVC framework data variables are passed to view file and it is upto the view file how to display them. Like say an array of user profiles would be passed and the view file may display the list in a ul li or in tr td format.</p>

<h3>Views in PHPasap</h3>
<p>Views in PHPasap reside in <code>app/views/</code> directory. So suppose there is a file named <code>welcome.php</code> in this directory, then to use this view file in any of your Controller method you will use the below syntax</p>
<pre class="php"><?php ___('
$view = View::render("welcome"); //render returns string containing html markup in welcome.php
return $view;
//OR

return View::make("welcome"); //make returns an object of View_Handler class
'); ?></pre>
<p>Remember you have to return the view string or View_Handler object and not echo it.</p>

<h3>Passing data to View</h3>
<p>The second argument to make() and render() method is an optional associative array whose keys will be passed as variables with corresponding value as the vaue of variable. See example below</p>
<pre class="php"><?php ___('
return View::render("welcome", ["var_1"=>"value_1"]);

//OR

return View::make("welcome", ["var_1"=>"value_1"]);
'); ?></pre>

<h3>Passing View as data to anther View</h3>
<p>Sometimes you may want to seperate out the header and footer templates so that they can be used in common in all view files. Below is how you would do.</p>
<pre class="php"><?php ___('
$header = View::render("header"); //remember to use render() which returns string and NOT make() which returns obj
return View::make("welcome", ["header"=>$header]);
'); ?></pre>

<p>Below too is a legal example. Here in a view file we call another view</p>
<code>app/views/template.php</code>
<pre class="php"><?php ___('
<?php echo View::render("header"); ?>
    <div class="container">
    </div>
<?php echo View::render("footer"); ?>
'); ?></pre>

<h3>Nested directories in View</h3>
<p>The path passed to <code>make()</code> and <code>render()</code> method is always relative to <code>views</code> folder. Even if you are calling these methods in a view file or in a Controller the path will always be relative to the views folder.</p>
<p>Suppose you are using below file and directory structure in <code>app/views</code></p>
<ul>
    <li>
        modules
        <ul>
            <li>welcome.php</li>
        </ul>
    </li>
    <li>
        template
        <ul>
            <li>full-width.php</li>
            <li>left-sidebar.php</li>
        </ul>
    </li>
</ul>
<p>Then to access any of the above view files you may use below syntax</p>
<pre class="php"><?php ___('
View::make("template/full-width"); //for app/views/template/full-width.php
View::make("modules/welcome"); //for app/views/modules/welcome.php
'); ?></pre>