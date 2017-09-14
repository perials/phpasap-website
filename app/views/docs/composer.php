<h2>Composer</h2>

<p>PHPasap doesn't require composer to install any of it's core features. But it supports composer just in case you want to add any third party library using composer.</p>

<h3>Example</h3>
<p>So say you want to add the popular SwiftMailer library to your application. You would install it as usual using composer. Below is the command for same taken from their official docs</p>
<pre>composer require swiftmailer/swiftmailer</pre>
<p>That's it.</p>

<p>One thing to note is that when you would be using any of the SwiftMailer classes in your Controller make sure you reference them by thier full name. So instead of <code>Swift_Message</code> you would be using <code>\Swift_Message</code>. The <code>\</code> at the beginning means this class is in global namespace.</p>