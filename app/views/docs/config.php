<h2>Config Variables</h2>
<p>All config variables can be set in appropriate <code>app/config</code> file. By default <code>app/config</code> directory contains below three files:</p>

<ul>
    <li><code>app.php</code></li>
    <li><code>database.php</code></li>
    <li><code>alias.php</code></li>
</ul>

<p>If you go throgh the code of each of these file you will notice that each one returns an associative array. This is how config variables are defined in PHPasap. All the keys and values of the associative array are our config variables and their corresponding values.</p>

<h3>Fetching a config item</h3>
The general syntax to access a config variable is <code>Config::get('file.variable')</code> where file is the name of the config file, followed by a dot and then a variable which is nothing but an array key defined in file.</p>

<p>For example to get the config value for debug option in <code>app.php</code> we would use the below syntax</p>
<pre class="php"><?php ___('
$debug = Config::get("app.debug");

//OR get with a default value
$debug = Config::get("app.debug", true); //if debug not found then default true will be returned
'); ?></pre>
<p>Second param is optional. It is used as default value if the item queried for doesn't exist.</p>
<p>If the config item or config file doesn't exist and no default value is set then <code>null</code> is returned.</p>

<h3>Adding a config item</h3>
<p>You can add your own config items in any of the config file. So suppose you added below line to the <code>app.php</code></p>
<pre class="php"><?php ___('
"api_key" => "anyrandomstring"
'); ?></pre>

<p>Now to access our new config item you would use the following syntax</p>
<pre class="php"><?php ___('
Config::get("app.api_key");
'); ?></pre>

<h3>Adding your own config file</h3>
<p>You can even add your own config file. Like say go ahead and create a <code>mail.php</code> file in config directory. Add the below code to it.</p>
<pre class="php"><?php ___('
return [
    "smtp_user"     => "abc",
    "smtp_password" => "xyz",
    "smtp_host"     => "lmn",
];
'); ?></pre>

<div class="panel panel-default note">
    <div class="panel-heading">Important Note</div>
    <div class="panel-body">
        Config files should always return an associative array. When adding your own config file please use an existing config file as template.
    </div>
</div>

<p>
Then you could access any of the config item in your newly created config file using below syntax:    
</p>

<pre class="php"><?php ___('
echo Config::get("mail.smtp_user"); //abc
echo Config::get("mail.smtp_password"); //xyz
echo Config::get("mail.smtp_host"); //lmn
'); ?></pre>

<h3>Fetching all config items</h3>
<p>When Config::get() is called without any param then all the config items are returned. The returned value is associative array of associative array. Each file name is array key having value which itself is an array of config items in the corresponding config file.</p>
<pre class="php"><?php ___('
$config = Config::get();
'); ?></pre>
<p>Doing a var_dump on <code>$config</code> in above code will give something as below</p>
<pre class="php"><?php ___('
Array
(
    [alias] => Array
        (
        )

    [app] => Array
        (
            [debug] => 1
        )

    [database] => Array
        (
            [hostname] => 
            [database] => 
            [username] => 
            [password] => 
        )

)
'); ?></pre>