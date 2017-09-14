<h2>Form</h2>

<p>PHPasap provides the <code>Form_Builder</code> class to rapidly build forms. The advantage of using this class over raw html code is that this class will take care of prepopulating user filled data in case of validation errors.</p>

<h3>Input</h3>
<p>To create a input field use the code below</p>
<pre class="php"><?php ___('
echo Form::text("name", "default_value", ["attr_1"=>"value_1", "attr_2"=>"value_2"]);
//<input type="text" name="name" value="default_value" attr_1="value_1" attr_2="value_2" >
'); ?></pre>

<p>Note that <code>text()</code> method returns string and not echo's it.</p>

<p>If default value defaults to <code>null</code>. If you want to pass a class attribute and don't want a default value you may pass the second attribute as <code>null</code>. Refer the code below.</p>
<pre class="php"><?php ___('
echo Form::text("name", null, ["placeholder"=>"Name", "class"=>"form-control"]);
//<input type="text" name="name" class="form-control" placeholder="Name" >
'); ?></pre>

<h3>Select</h3>
<pre class="php"><?php ___('
echo Form::select("gender", ["male"=>"Male", "female"=>"Female"], "male", ["class"=>"form-control"]);
//male option will be selected by default. Use null to skip
'); ?></pre>