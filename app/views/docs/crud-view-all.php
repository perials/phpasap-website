<h2>CRUD Application: View All Users</h2>
<p>A GET request to <code>/crud/all</code> will show all the users in the <code>users</code> table.</p>

<h3>Create Controller method</h3>
<p>Lets create the <code>get_all()</code> method in <code>Crud_Controller.php</code>.</p>
<pre class="php"><?php ___('
public function get_index() {
    $all_users = DB::table("users")->get();
    return View::make("all-users", ["all_users"=>$all_users])]);
}
'); ?></pre>

<h3>Create the view</h3>
<p>Create a file <code>all-user.php</code> in <code>app/views</code> directory</p>
<pre class="php"><?php ___('
<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>        
    </tr>
    <?php if( empty($all_users) ) { ?>
    <tr>
        <td colspan="4">No users found</td>
    </tr>
    <?php }
    else {
        foreach($all_users as $user) {
            ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->first_name; ?></td>
                <td><?php echo $user->last_name; ?></td>
                <td><?php echo $user->gender; ?></td>
            </tr>
        <?php }
    }
    ?>
</table>
'); ?></pre>