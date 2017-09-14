<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>        
    </tr>
    <?php if( empty($all_users) ) { ?>
    <tr>
        <td colspan="4">No users found</td>
    </tr>
    <?php } ?>
    <tr>
        <td></td>
    </tr>
</table>