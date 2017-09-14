<h2>Models</h2>

<p>Model is where you write all your database queries. Models may reside in <code>app/models</code> directory. Due to the namespace based autoloader in PHPasap you are free to keep your models anywhere in the project root as long as you follow proper namespace.</p>

<h3>Example Model</h3>
<p>Below is a User model in <code>app/models/user.php</code></p>
<pre class="php"><?php ___('
namespace app\Models;

class User extends \core\classes\Model{
    
    //it is assumed the base table for this model is user
    //which is lower case name of this class
    
    //if you want to explicity set the table name to something else
    //then set the table name on table property
    //protected $table = "table_name";
    
    public function get_user_details($user_id) {
        return $this->where("id", "=", $user_id)->first();
    }
    
}
'); ?></pre>

<p>Below is how you would use this model in any of your controllers</p>
<pre class="php"><?php ___('
namespace app\Controllers;

class Any_Controller {
    
    public function some_method() {
        $user_model = new app\Models\User();
        $profile = $user_model->get_user_details(5);
    }
    
}
'); ?></pre>

<h4>Table name</h4>
<p>Note that we didn't tell the Model which table it is suppose to search form. It is assumed that the base table that model will search into will be lowercased name of the model class. So for above example it is <code>user</code>. If you want to use a different table then you can set the <code>table</code> property to the table name you want to query.</p>
<pre class="php"><?php ___('
protected $table = "some_table";
'); ?></pre>

<h3>Available methods</h3>
<p>All examples listed in <?php echo HTML::link('docs/database', 'database section'); ?> are available to your model provied your model extends the <code>core\classes\Model</code>. The only difference is instead of doing <code>DB::table('table')</code> you would use <code>$this</code>. For example, a SELECT query using DB class would be as follow</p>
<pre class="php"><?php ___('
$all_users = DB::table("users")->get();
'); ?></pre>
<p>To do same thing in User model you would replace the <code>DB::table("users")</code> with <code>$this</code>.</p>
<pre class="php"><?php ___('
$all_users = $this->get();
'); ?></pre>
<p>The <code>table()</code> method sets the table property. In a model this property is assumed to be same as lower case of class name (Else if <code>table</code>property is explicity set then same will be used). So you don't need to call the <code>table()</code> method.</p>