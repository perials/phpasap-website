<h2>Cookies</h2>
<p>The Cookie_Handler class provides methods for setting, getting and deleting cookies. Instead of using the <code>setcookie()</code> function directly you are better off using the <code>Cookie_Handler</code> class.</p>

<h3>Setting a cookie</h3>
<p>Below is how you would set a cookie</p>
<pre class="php"><?php ___('
Cookie::set("cookie_name", "cookie_value", 86400); //86400 is life of cookie in seconds
//OR
Cookie::set("cookie_name", "cookie_value", Cookie::one_day());
'); ?></pre>
<p>Fourth and fifth parameter of <code>set()</code> are the path and the domain respectively.</p>

<p>For specifying duration you may use any of the below which returns integer values</p>
<ul>
    <li><code>Cookie::one_day()</code> which returns 86400</li>
    <li><code>Cookie::seven_days()</code> which returns 604800</li>
    <li><code>Cookie::thirty_days()</code> which returns 2592000</li>
    <li><code>Cookie::six_months()</code> which returns 15811200</li>
    <li><code>Cookie::one_year()</code> which returns 31536000</li>
    <li><code>Cookie::lifetime()</code> which returns -1</li>
    <li><code>Cookie::session()</code> which returns null. This cookie will exists as long as browser is not closed</li>
</ul>

<h3>Getting a cookie value</h3>
<p>Below is how you would get a cookie value</p>
<pre class="php"><?php ___('
Cookie::get("cookie_name"); //if cookie_name doesn\t exist then null is returned
//OR
Cookie::get("cookie_name", "default_value"); //if cookie_name doesn\'t exist then default_value will be returned
'); ?></pre>

<h3>Deleting a cookie</h3>
<p>Below is how you would delete a cookie.</p>
<pre class="php"><?php ___('
Cookie::remove("cookie_name");
'); ?></pre>
<p>Second and third param to <code>remove()</code> function are path and domain respectively.</p>