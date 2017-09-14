<div class="container">
    <h1 class="title">Sample CRUD application</h1>
    <p>CRUD i.e CREATE, READ, UPDATE and DELETE are the part and parcel of the web application. PHPasap makes this insanely simple for you. Below is a sample CRUD application to help you get started.</p>
    <?php if( Session::get('errors') ) { ?>
    <div class="alert alert-danger">
        <?php echo implode("<br/>", Session::get('errors')); ?>
    </div>
    <?php } ?>
    <h3>Add New User</h3>
    <form method="POST">
        <table width="100%">
            <tr>
                <td><?php echo Form::text('first_name', isset($user) ? $user->first_name : null, ['placeholder'=>'First name']); ?></td>
                <td><?php echo Form::text('last_name', isset($user) ? $user->last_name : null, ['placeholder'=>'Last name']); ?></td>
                <td><?php echo Form::text('username', isset($user) ? $user->username : null, ['placeholder'=>'Username']); ?></td>
                <td><?php echo Form::select('gender',[0=>'Select Gender', 'male'=>'Male', 'female'=>'Female'], isset($user) ? $user->gender : null); ?></td>
                <td><input type="submit" class="btn"></td>
            </tr>
        </table>
        
    </form>
    
    <h3>All Users</h3>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>Sanket</td>
            <td>Hande</td>
            <td>Male</td>
            <td><a href="">Edit</a> | <a href="">Delete</a></td>
        </tr>
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td>Male</td>
            <td><a href="">Edit</a> | <a href="">Delete</a></td>
        </tr>
        <tr>
            <td>Anthony</td>
            <td>Lobo</td>
            <td>Male</td>
            <td><a href="">Edit</a> | <a href="">Delete</a></td>
        </tr>
    </table>
    <h3>About this page</h3>
    <ul>
        <li>The route rule for this page is defined in <code>app/config/routes.php</code></li>
        <li>The business logic is defined in all method of Crud_Controller class located in <code>app/controller/crud_controller.php</code></li>
    </ul>
</div>