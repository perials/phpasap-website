<h2>HTML Helper for handling Assets</h2>
<p>Instead of hardcoding the absolute URL or using a relative URL for loading a resource (js, css and image file) you are strongly encouraged to use below methods as needed. These will take care of prepending the base URL as needed so that you don't have to worry while deploying your application from development to production server.</p>

<h3>Adding a stylesheet</h3>
<pre class="php"><?php ___('
echo HTML::style("assets/css/style.css");
//assets folder is in project root and not necessarily web root
'); ?></pre>

Above tag will produce <code><?php ___('<link rel="stylesheet" href="http://your domain.com/assets/css/style.css" >'); ?></code>. PHPasap will prepend the base url to the provided url path.

<h3>Adding an external stylesheet</h3>
<pre class="php"><?php ___('
echo HTML::style("https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/googlecode.min.css");
'); ?></pre>

<p>
The syntax for loading an external stylesheet is same as for loading a local one. There is no magic here. Whenever there is a <code>http://</code> or <code>https://</code> PHPasap assumes that provided path is an absolute path and hence doesn't prepend the base url to the provided path.</p>

<p>However in some case you may want to explicitly specify if the resource is local or external instead of letting PHPasap do the guessing. Below is a particular use case</p>
<pre class="php"><?php ___('
echo HTML::style("//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/googlecode.min.css", true);
'); ?></pre>

<p>In above example a boolean <code>true</code> in second parameter tells PHPasap that this is an external resource. The default value for this parameter is boolean <code>false</code>. By default PHPasap will assume the resource is a local one if provided path doesn't begin with <code>http://</code> or <code>https://</code>.</p>

<h3>Adding a script</h3>
<pre class="php"><?php ___('
echo HTML::script("assets/js/common.js");
//assets folder is in project root and not necessarily web root
'); ?></pre>

<p>Usage is same as <code>HTML::style()</code> above</p>

<h3>Adding an external script</h3>
<pre class="php"><?php ___('
echo HTML::script("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js");

echo HTML::script("//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js", true);
//by giving true in second param we are telling PHPasap this is external resource. See HTML::style() for more info
'); ?></pre>

<h3>Creating a link</h3>
<pre class="php"><?php ___('
echo HTML::link("news/all", "All News");
'); ?></pre>

<p>The above will produce <code><?php ___('<a href="http://some-domain.com/news/all">All News</a>'); ?></code></p>

<h3>Creating an external link</h3>
<pre class="php"><?php ___('
echo HTML::link("http://perials.com", "Perials Website");
//<a href="http://perials.com">Perials Website</a>
'); ?></pre>

<p>Whenever the provided url path starts with a <code>http://</code> or <code>https://</code> PHPasap assumes it as a external resource and doesn't prepend base url to it.</p>

<p>Just as with <code>HTML::style()</code> and <code>HTML::script()</code> passing second param as <code>true</code> tells PHPasap to treat this as external resource irrespective of what the url passed in first param is.</p>
<pre class="php"><?php ___('
echo HTML::link("//perials.com", "Perials Website", true);
//<a href="http://perials.com">Perials Website</a>
'); ?></pre>

<h3>Adding custom attributes</h3>
<p>The optional third param for <code>HTML::style()</code> and <code>HTML::script()</code> and fourth param for <code>HTML::link()</code> is an associative array. Anything in this array will be added as a string of <code>attr="value"</code> to the respective resource tag. See below examples</p>
<pre class="php"><?php ___('
echo HTML::link("news/all", "All News", false, ["class"=>"anchor", "attr2"=>"value2"]);
//<a href="http://some-domain.com/news/all" class="anchor" attr2="value2">All News</a>

echo HTML::style("assets/css/style.css", false, ["attr1"=>"value1", "attr2"=>"value2"]);
//<link rel="stylesheet" href="http://some-domain.com/assets/css/style.css" attr1="value1" attr2="value2" >

echo HTML::script("assets/js/common.js", false, ["attr1"=>"value1", "attr2"=>"value2"]);
//<script src="http://some-domain.com/assets/js/common.js" attr1="value1" attr2="value2"></script>
'); ?></pre>

<h3>Creating urls</h3>
<pre class="php"><?php ___('
echo HTML::url("news/all");
'); ?></pre>
<p>
Above code will produce <code><?php ___('http://some-domain.com/news/all'); ?></code>
</p>
<p>PHPasap doesn't support external url (say http://google.com) as you are better off hardcoding it as it is.</p>
