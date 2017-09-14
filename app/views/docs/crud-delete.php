<h2>CRUD Application: Delete</h2>

<p>In this section we'll delete a user. Making a <code>GET</code> request to <code>/crud/delete/{user-id}</code> should the delete the user with id {user-id}. Below is the controller method for this.</p>
<pre class="php"><?php ___('
public method get_delete($user_id) {
    
    //delete query
    $no_of_deleted_users = DB::table("users")->where("id", "=", $user_id)->delete();
    
    if( $no_of_deleted_users )
        return Request::redirect_to("crud/index")->with(["success" => "User deleted successfully"]);
    else
        return Request::redirect_to("crud/index")->with(["error" => "Unable to delete user"]);
}'); ?></pre>

<?php //prev_next('docs/crud-create-new-form','docs/crud-view-all'); ?>