<h2>Database and Models</h2>
<h3>Configuring Database</h3>
<p>If you haven't already done so, fill the required details in <code>config/database.php</code>. All options in file are well commented and are self explanatory.</p>

<h3>Running raw queries</h3>
<p>In your controller (or from any part of your app, even a view, although not recommended) you can execute any SQL query using the below syntax</p>
<pre class="php"><?php ___('
//if your query will return a resultset
$result = DB::sel("SELECT * FROM table");

//simply to execute a query
DB::query("SELECT * FROM table");

//Insert query
$insert_id = DB::insert("INSERT INTO user (name, age) VALUES (\'John\', 15)");

//Update query
$no_of_affected_rows = DB::update("UPDATE user SET name=\'Ashley\' WHERE id=6");

//Delete query
$no_of_affected_rows = DB::delete("DELETE FROM users WHERE id=6");
'); ?></pre>

<div class="panel panel-default note">
    <div class="panel-heading">Recommended to use DB class in Controller and Model only</div>
    <div class="panel-body">
        PHPasap uses an alias loader class and an autoloader to load the DB class. Technically you can use the DB class anywhere in your app. Be it a view or library or any helper file that too namespaced under anything. The autoloader will take care of loading it for you. However as per the standards of MVC it is pretty much a bad practise to make a database query anywhere other than a Controller or a model. So unless and until there is no option avoid doing so.
    </div>
</div>

<h3>Binding data</h3>
<p>If any part of your query comes form user input you can bind the data using the <code>?</code> operator. See example below</p>
<pre class="php"><?php ___('
//Select query
$name = $_GET["name"];
$age = $_GET["age"];
$query = DB::sel("SELECT * FROM user WHERE name=? AND age=?",[$name, $age]);

//Insert query with bind data
$insert_id = DB::insert("INSERT INTO user (name, age) VALUES (?,?)",[$name, $age]);

//Update query
$no_of_affected_rows = DB::update("UPDATE user SET name=? WHERE id=?", ["Ashley", 6]);

//Delete query
$no_of_affected_rows = DB::delete("DELETE FROM users WHERE id=?", [6]);

DB::query("INSERT INTO user (name, age) VALUES (?,?)",[$name, $age]);
'); ?></pre>
<p>What happends here is that PHPasap crates a PDO prepared statement and then executes it. This rules out any chances of SQL injection.</p>

<h3>Select query</h3>
<p>To run a SELECT query like <code>SELECT * FROM users</code> you would use the below syntax.</p>
<pre><?php ___('
DB::table("users")->get();
'); ?></pre>
<p><strong>If no results then <code>get()</code> returns empty array</strong></p>

<h3>Select where</h3>
<p>To run a SELECT query like <code>SELECT * FROM users WHERE name="John"</code> you would use the below syntax.</p>
<pre><?php ___('
DB::table("users")->where("name", "=", "John")->get();
'); ?></pre>

<p>Note that you can pass raw data inside where since all the statements are executed using PDO prepare. So below is usually how you will use this syntax in real world application.</p>
<pre><?php ___('
$name = $_GET["name"];
DB::table("users")->where("name", "=", $name)->get();
'); ?></pre>

<h3>Select with multiple where</h3>
<pre><?php ___('
DB::table("users")->where("name", "=", "John")->where("dob", ">", "2015-02-01")->get();
//all conditions in where will be AND\'ed
'); ?></pre>

<h3>Select where with limit</h3>
<pre><?php ___('
DB::table("users")->where("name", "=", "John")->get(5);
//SELECT * FROM users WHERE name = "John" LIMIT 0, 5
'); ?></pre>

<h3>Select where with limit and offset</h3>
<pre><?php ___('
DB::table("users")->where("name", "=", "John")->get(5,10);
//SELECT * FROM users WHERE name = "John" LIMIT 10, 5
'); ?></pre>

<h3>Select first</h3>
<pre><?php ___('
DB::table("users")->first();
DB::table("users")->where("name", "=", "John")->first();
'); ?></pre>
<p>If no results then <code>first()</code> returns empty array.</p>

<h3>Select count</h3>
<pre><?php ___('
DB::table("users")->count();
DB::table("users")->where("name", "=", "John")->count();
'); ?></pre>

<h3>Select where in</h3>
<pre><?php ___('
DB::table("users")->where_in("name", ["John", "Barry", "Ashley"])->get();
'); ?></pre>

<h3>Select where like</h3>
<pre><?php ___('
DB::table("users")->where("name", "=". "%ohn%")->get();
'); ?></pre>

<h3>Select where between</h3>
<pre><?php ___('
DB::table("users")->where_between("registered_on", ["2015-12-01", "2016-02-02"])->get();

//you can combine where and where_between. Remember they will be AND\'ed
DB::table("users")->where("name", "=", "John")->where_between("registered_on", ["2015-12-01", "2016-02-02"])->get();
'); ?></pre>

<h3>Select or where</h3>
<pre><?php ___('
DB::table("users")->where("name", "=", "John")->or_where("name", "=", "Ashley")->get();
'); ?></pre>

<h3>Select specific columns</h3>
<pre><?php ___('
DB::table("users")->select("name, age")->get();

DB::table("users")->where("name", "=", "John")->or_where("name", "=", "Ashley")->select("name, age")->get();
DB::table("users")->where("name", "=", "John")->or_where("name", "=", "Ashley")->select("name, age")->first();
'); ?></pre>

<h3>Insert</h3>
<pre><?php ___('
$insert_id = DB::table("users")->insert(["name"=>"John", "dob"=>"2000-10-08", "age"=>13]);
'); ?></pre>
<p><code>insert()</code> will return primary key id of the inserted row</p>

<h3>Update</h3>
<pre><?php ___('
$affected_rows = DB::table("users")->where("name", "=", "John")->update(["age" => 15]);

$affected_rows = DB::table("users")->where("name", "=", "John")->or_where("name", "=", "Ashley")->update(["age" => 15]);
'); ?></pre>
<p><code>update()</code> will return no of affected rows</p>

<h3>Delete</h3>
<pre><?php ___('
$no_of_deleted_rows = DB::table("users")->where("name", "=", "John")->delete();

$no_of_deleted_rows = DB::table("users")->where("name", "=", "John")->or_where("name", "=", "Ashley")->delete();
'); ?></pre>
<p><code>delete()</code> will return no of deleted rows</p>