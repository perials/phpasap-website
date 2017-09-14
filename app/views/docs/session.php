<h2>Session</h2>
<p>PHPasap provides the Session library to handle native session. By default sessions are already started. So you don't have to do a <code>session_start()</code></p>

<h3>Set new or update existing session variable</h3>
<p>Instead of using the global <code>$_SESSION</code> directly you are better off with below code</p>
<pre class="php"><?php ___('
Session::set("name", "value");
Session::set("name", ["value_1","value_2"]);
'); ?></pre>

<h3>Get session variable value</h3>
<p>Similarly for getting a session variable value you can use below code</p>
<pre class="php"><?php ___('
$value = Session::get("name");
//returns null if "name" wasn\'t set
'); ?></pre>

<p>If given session variable not found then <code>get()</code> returns <code>null</code>.</p>

<h3>Flashing data</h3>
<p>Flashing a session means the session variable will be available only for next request. This is particularly useful for showing form validation error.</p>
<pre class="php"><?php ___('
Session::flash("error", "Username/Password incorrect");
'); ?></pre>

<h3>Retrieving the flash data</h3>
<p>Getting the flash data is same as getting any other session variable</p>
<pre class="php"><?php ___('
$error = Session::get("error");
'); ?></pre>