<!DOCTYPE html>
<html lang="en">
    <head>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
        
        <!--bootstrap-->
        <?php echo HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'); ?>
        
        <!--style-->
        <?php echo HTML::style('assets/css/docs.css'); ?>
        
        <!--jquery-->
        <?php echo HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'); ?>
        
        <!--jquery syntax highligther-->
        <?php echo HTML::style('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/googlecode.min.css', true); ?>
        <?php echo HTML::script('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js', true); ?>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="<?php echo Route::base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo HTML::url('crud/index'); ?>">Sample CRUD</a></li>
                    <li><a href="">Support</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </body>
</html>