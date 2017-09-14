<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
        <?php
        if(!empty($is_home)) { ?>
            <title>PHPasap | As Simple As Possible | As Soon As Possible</title>
        <?php } elseif(is_array($nav['current']) && isset($nav['current'][1])) { ?>
            <title>PHPasap | <?php echo $nav['current'][1]; ?></title>
        <?php } ?>
            
        <?php //echo HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'); ?>
        <?php echo HTML::style('assets/css/bootstrap.min.css'); ?>
        
        <!--font-awesome-->
        <?php echo HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'); ?>
        <?php //echo HTML::style('assets/css/font-awesome.min.css'); ?>
        
        <!--style-->
        <?php /*
        if( !empty($is_home) )
            echo HTML::style('assets/css/style.css?s=1');
        else
            echo HTML::style('assets/css/docs.css'); */
        ?>

        <?php echo HTML::style('assets/css/common.css'); ?>
        
        <!--jquery-->
        <?php echo HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'); ?>
        <?php echo HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'); ?>
        <?php //echo HTML::script('assets/js/jquery.min.js'); ?>
        
        <!--jquery syntax highligther-->
        <?php echo HTML::style('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/googlecode.min.css', true); ?>
        <?php echo HTML::script('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js', true); ?>
        <?php //echo HTML::style('assets/css/googlecode.min.css'); ?>
        <?php //echo HTML::script('assets/js/highlight.min.js'); ?>
        
        <?php if( Config::get('env.environment') != 'development' ) { ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          
            ga('create', 'UA-74728582-1', 'auto');
            ga('send', 'pageview');          
        </script>
        <?php } ?>
    </head>
    <body class="<?php echo !empty($is_home) ? 'home' : ''; ?>">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Route::base_url(); ?>">
                        <ul>
                            <?php if( empty($is_home) ) { ?>
                            <li><img src="<?php echo HTML::url('assets/images/php-asap-logo-black.png'); ?>" width="35" style="display: inline"></li>
                            <?php } ?>
                            <li class="logo-text">PHPasap</li>
                        </ul>
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo HTML::url('docs/overview'); ?>">Docs</a></li>
                        <li><a href="<?php echo HTML::url(Config::get('app.download_link')); ?>">Download Ver 1.1</a></li>
                        <!--<li><a href="">GitHub</a></li>-->
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>