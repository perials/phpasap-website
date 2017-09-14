<h2>Mail</h2>

<p>Mail class of PHPasap uses the very famous <code>PHPMailer</code> for sending mails.</p>

<h3>Configuration</h3>
<p>Before usign the mail class make sure you have configured the details in <code>app/config/mail.php</code>. If you wish to use any SMTP servers for sending mail then set <code>is_smtp</code> to <code>true</code> and fill in the smtp details</p>

<h4>Below is an example config for using Gmail SMTP</h4>
<pre class="php"><?php ___('
"from" => "somegmailaddress@gmail.com", // or ["somegmailaddress@gmail.com", "Some Name"]
"use_smtp" => true,
"smtp_host" => "smtp.gmail.com",
"smtp_username" => "somegmailaddress",
"smtp_password" => "yourpassword",
"smtp_encryption" => "tls",
"smtp_port" => 587,
'); ?></pre>

<p>Note that you can set the <code>from</code> parameter to globally set the default from name of all mails sent through Mail class. You can optionally override this from field while sending mail. See below sections for more details.</p>

<h3>Sending mail</h3>
<p>Once the config is set then below is how you would send an email</p>
<pre class="php"><?php ___('
// using just email
Mail::send("abc@somedomain.com", "This is the subject", "This is the message");

// using just email and name of recipient
Mail::send(["abc@somedomain.com", "Abc"], "This is the subject", "This is the message");

// sending to multiple recipient
Mail::send([["abc@somedomain.com", "Abc"], ["xyz@somedomain.com", "Xyz"]], "This is the subject", "This is the message");
'); ?></pre>

<h3>Syntax and Usage</h3>
<p>Below is the syntax of using the Mail class</p>
<pre class="php"><?php ___('
Mail::send($to, $subject, $message, $options=[]);
'); ?></pre>
<ul>
    <li>
        <code>$to</code> is the recipient(s). It could be either a string containing email address or an array containing name and email or an array of array containing name and email of multiple recipients. So below is how this can be used.
        <ul>
            <li><code>'somebody@somedomain.com'</code></li>
            <li><code>['somebody@somedomain.com', 'Some Name']</code></li>
            <li><code>[ ['somebody@somedomain.com', 'Some Name'], ['somebodyelse@somedomain.com'], ['anothermail@somedomain.com', 'Another Name']]</code></li>
        </ul>
    </li>
    <li><code>$subject</code> is the subject of the mail</li>
    <li><code>$message</code> is the message of the mail</li>
    <li>
        <code>$options</code> can be used to override few of the config fields and for setting additional parameters for sending mail like adding cc and bcc.
        Below are the available options. Each parameter is optional.
        <table class="table">
            <tr>
                <th width="10%">Parameter</th>
                <th width="25%">Description</th>
                <th width="25%">Type</th>
                <th width="40%">Example</th>
            </tr>
            <tr>
                <td>cc</td>
                <td>Adding CC mails</td>
                <td>
                    <ul class="list-unstyled">
                        <li>string (Email)</li>
                        <li>array (Email as first parameter and Name as second)</li>
                        <li>array of array (array of above array)</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><code>'abc@somedomain.com'</code></li>
                        <li><code>['abc@somedomain.com', 'Abc']</code></li>
                        <li><code>[<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;['abc@somedomain.com', 'Abc'],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;['xyz@somedomain.com', 'Xyz'],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;['lmn@somedomain.com']<br/>
                        ]</code></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>bcc</td>
                <td>Adding BCC mails</td>
                <td>
                    <ul class="list-unstyled">
                        <li>string (Email)</li>
                        <li>array (Email as first parameter and Name as second)</li>
                        <li>array of array (array of above array)</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><code>'abc@somedomain.com'</code></li>
                        <li><code>['abc@somedomain.com', 'Abc']</code></li>
                        <li><code>[<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;['abc@somedomain.com', 'Abc'],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;['xyz@somedomain.com', 'Xyz'],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;['lmn@somedomain.com']<br/>
                        ]</code></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>is_html</td>
                <td>Set to true if you want to send HTML mail. Default is <code>true</code></td>
                <td>boolean</td>
                <td>
                    <code>true</code>
                </td>
            </tr>
            <tr>
                <td>from</td>
                <td>Use this to override the default global from field set in the <code>app/config/mail.php</code> config file</td>
                <td>
                    <ul class="list-unstyled">
                        <li>string</li>
                        <li>array</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li><code>'abc@somedomain.com'</code></li>
                        <li><code>['abc@somedomain.com', 'Abc']</code></li>
                    </ul>
                </td>
            </tr>
        </table>
    </li>
</ul>

<h3>Return type</h3>
<p><code>send()</code> function returns boolean true if successful else returns a boolean false.</p>

<h3>Get error message if mail sending failed</h3>
<pre class="php"><?php ___('echo Mail::get_last_error();
'); ?></pre>