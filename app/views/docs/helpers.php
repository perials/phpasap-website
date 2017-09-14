<h2>Helpers (Custom functions)</h2>
<p>Classes can be autoloaded using the namespace and directory naming convention. But what about functions? You might need a bunch of functions that are available on every HTTP request. PHPasap makes this easy for you with the use of helper files.</p>

<h3>Adding a helper file</h3>
<p>In <code>app</code> directory there is a directory named <code>helpers</code>. Any php file inside this directory will be included by PHPasap before calling the controller. So you can create any file, lets say <code>common.php</code> in this directory. This file is expected to contain only functions and no classes. Since this file will be included by PHPasap any function you write in this file will be available throughout the application.</p>
<p>Below is an example helper file. You can name you file anything.</p>
<code>app\helpers\common.php</code>
<pre class="php"><?php ___('
function abc() {
    //rest of the code
}

function xyz() {
    //rest of the code
}
'); ?></pre>

<p>So whenever you need to add a new function you may add to this <code>common.php</code> file or you may create a new helper file in <code>helpers</code> directory.</p>