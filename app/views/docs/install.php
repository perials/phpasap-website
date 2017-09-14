<h2>Installation</h2>            
<h3>Server Requirements</h3>
<ul>
    <li>PHP >= 5.4</li>
    <li>PDO PHP Extension</li>
</ul>

<h3>Setup</h3>
<p>PHPasap doesn't require composer or any other third party tool or library for installation. Simply unzip the downloaded zip file to your project root directory (<code>index.php</code> should be in project root) and that's it.</p>
<p>You may install PHPasap in a web root or in a sub directory in webroot. Wherever you decide you install it, you don't need to do anything apart from extracting the downloaded compressed file.</p>

<h3>Configuring Database</h3>
<p>If your application requires use of a database you can provide the database credentials in <code>app/config/database.php</code>.</p>

<h3>Turning off error reporting in production</h3>
<p>Before going live make sure you turn off the debug mode, which is ON by default, by setting <code>debug</code> to <code>false</code> in <code>app/config/app.php</code></p>

<h3>Further steps</h3>
<p>If you haven't already done so, then please go through our precise documentation. Most are able to read the entire documentation in couple of hours. If you face any issue or have any queries/suggestions/complaints then please feel free to <a href="http://perials.com/contact">get in touch with us</a>.</p>

<!--
<h3>Url routing with .htaccess</h3>
<p>Every request is redirected to <code>index.php</code> file. This is done by the <code>.htaccess</code> file. Anything that is not a file or a directory is handled by index.php</p>
-->