<h2>Libraries (Custom Classes)</h2>
<p>In MVC architecture HTTP requests are handled by a Controller. Now every time writing all your business logic in one Controller method can make the code difficult to understand. For certain part of your code that you use very often, like say sending mails, you can create your own class that does this common job. Now instead of writing the same code again and again, your Controller can simply call this class thus following the principles of DRY (DONOT REPEAT YOURSELF).</p>

<h3>Classes in PHPasap</h3>
<p>You can place your custom class file anywhere in project root, like say in <code>app</code> directory or in <code>app/folder1/folder2</code>. You can autoload your class in the Controller as long as you are following the below namespace and file naming convention.</p>
<ul>
    <li>Each class will have it's own php file.</li>
    <li>The name of the file will be same as the lower case'd name of the class. Eg: Class <code>Some_Class_Name</code> will be in <code>some_class_name.php</code></li>
    <li>
        <p>Every class should be namespaced as per its parent directory structure. So a class <code>Some_Class_Name</code> located in <code>app/folder1/folder2</code> should look like below:</p>
        <code>app/folder1/folder2/some_class_name.php</code>
        <pre class="php"><?php ___('
namespace app\folder1\folder2;
class Some_Class_Name {
    
}
'); ?></pre>
        <p>To call the above file in your Controller you would reference it by its fully qualified name. Consider example below</p>
        <code>app/controllers/some_controller.php</code>
        <pre class="php"><?php ___('
namespace app\controllers;
class Some_Controller {
    public function index() {
        
        //note that Some_Class_Name is referenced by its fully qualified name i.e with namespace included
        $some_class_obj = new \app\folder1\folder2\Some_Class_Name();
        
    }
}
'); ?></pre>
    </li>
    <li>You don't need to <code>require</code> or <code>include</code> the file, as long as you follow above convention, since it will be autoloaded by PHPasap.</li>
</ul>

<h3>Libraries</h3>
<p>The term <code>library</code> must be very much familiar if you have worked on frameworks like <a href="http://codeigniter.com">Codeigniter</a>. In traditional frameworks whenever you want to add your own class you can do so by creating a library. Library is nothing but a php file just as above. The difference is in the way the frameworks loads this library. Like in case of codeigniter you would do something like <code>$this->load->library('library-file-name')</code>. As discussed in above section, in PHPasap you can place your class file anywhere. But still for providing a starting point and for making a veteran MVC developer feel at home we provide a folder <code>libraries</code> in app directory. Going by the naming convention discussed in earlier section below is how you would add a library</p>
<code>app/libraries/library_example.php</code>
        <pre class="php"><?php ___('
namespace app\libraries;
class Library_Example {
    
}
'); ?></pre>
<p>To access this library in your Controller</p>
<code>app/controllers/some_controller.php</code>
        <pre class="php"><?php ___('
namespace app\controllers;
class Some_Controller {
    public function index() {
        
        //note that Library_Example is referenced by its fully qualified name i.e with namespace included
        $library_example_obj = new \app\libraries\Library_Example();
        
    }
}
'); ?></pre>