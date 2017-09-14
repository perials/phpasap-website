<?php echo View::render('modules/header',['is_home'=>true, 'nav'=>$nav]); ?>
        
        <div class="d-table">
            <div class="overlay"></div>
            
            <div class="container banner">
                <div class="banner-overlay"></div>
                
                <div class="row">
                    <div class="col-md-5 logo-wrap">
                            <img src="<?php echo HTML::url('assets/images/php-asap-logo.png'); ?>" width="350" class="logo img-responsive">
                    </div>
                    <div class="col-md-6">
                        <h1 class="banner-title">
                            PHPasap
                        </h1>        
                        <div class="tagline">
                            <!--<div class="col-md-6 soon first"><h3>As Soon As Possible</h3></div>
                            <div class="col-md-6 simple"><h3>As Simple As Possible</h3></div>-->
                            <h3>As Simple As Possible</h3>
                            <h3>As Soon As Possible</h3>
                            <div class="clearfix"></div>
                        </div>
                        <h4 class="banner-desc">A bare minimum PHP framework with small footprint, easy installation, simple architecture and blazingly fast performance</h4>
                        
                        <div class="cta-btn-wrap">
                            <a class="btn" href="<?php echo HTML::url(Config::get('app.download_link')); ?>" role="button">Download</a>
                            <a class="btn" href="<?php echo HTML::url('docs/overview'); ?>" role="button">Read Docs</a>    
                            <!--<div class="col-md-6 col-xs-6 text-right">
                                <a class="btn" href="<?php echo HTML::url(Config::get('app.download_link')); ?>" role="button">Download</a>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <a class="btn" href="<?php echo HTML::url('docs/overview'); ?>" role="button">Read Docs</a>
                            </div>-->
                        </div>        
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="container">
            <h2 class="section-title text-center">Install in a minute</h2>
            <p class="text-center section-tag-line">PHPasap as such required zero configuration. You just need to extract the zip and start coding. Tell the routes which controller will handle given request or handle the request in the route itself.</p>
            <div class="row">
                <div class="col-md-6">
                    <h4>Use inline function in routes to handle request</h4>
                    <code>config/routes.php</code>
                    <pre class="php" ><?php ___('
Route::add("GET", "welcome", function(){ echo "Welcome to my app"; });'); ?></pre>
                </div>
                <div class="col-md-6">
                    <h4>Or use controller to handle reqeust</h4>
                    <code>config/routes.php</code>
                    <pre class="php"><?php ___('
Route::add("GET", "welcome", "Pages_Controller@welcome");'); ?></pre>
                    
                    <code>controller/pages_controller.php</code>
                    <pre class="php"><?php ___('
class Pages_Controller extends Base_Controller {
        
    public function welcome() {
        echo "Welcome to my first app";
    }
        
}
'); ?></pre>
                </div>
            </div>
        </div>
        
        <div class="container">
            <h2 class="section-title text-center">Simple MVC architecture</h2>
            <p class="text-center section-tag-line">Based on traditional MVC architecture: Controllers handle the businees logic, Models interact with database and Views contains the HTML markup</p>
            <div class="row">
                <div class="col-md-4">
                    <code>config/routes.php</code>
                    <pre class="php"><?php ___('
Route::add("GET", "blog", "Blogs_Controller@index");'); ?></pre>
                </div>
                <div class="col-md-4">
                    <code>controller/blogs_controller.php</code>
                    <pre class="php"><?php ___('
class Blogs_Controller extends Base_Controller {

    public function index() {
        return View::make("all_blogs",["blogs"=>Blogs_Model::all()]);
    }

}
'); ?></pre>
                </div>
                <div class="col-md-4">
                    <code>views/all_blogs.php</code>
                    <pre class="php"><?php ___('
foreach($blogs as $blog) {
    ?>
    <h2><?php echo $blog->title; ?></h2>
    <p><?php echo $blog->published_on; ?></p>
    <p><?php echo $blog->content; ?></p>
    <?php
}
'); ?></pre>
                </div>
            </div>
        </div>
        
        <div class="container">
            <h2 class="section-title text-center">Easy to remember syntax</h2>
            <p class="text-center section-tag-line">Read it once and you'll remember them forever.<br/> Each method name was well thought and then implemented</p>
            <div class="row">
                <div class="col-md-4">
                    <h4>Sessions</h4>
                    <pre class="php"><?php ___('
Session::get("some_var");

Session::set("some_var", "some_val");
'); ?></pre>
                    
                    <h4>Cookies</h4>
                    <pre class="php"><?php ___('
Cookie::set("some_var", "some_value", 8600);

Cookie::get("some_var");
'); ?></pre>
                </div>
                
                <div class="col-md-4">
                    <h4>Database</h4>
                    <pre class="php"><?php ___('
$all_users = DB::table("users")->get();
'); ?></pre>
                    
                    <h4>Models</h4>
                    <pre class="php"><?php ___('
$all_posts = Post::get();
'); ?></pre>
                </div>
                <div class="col-md-4">
                    <h4>Input</h4>
                    <pre class="php"><?php ___('
//post request
$name = Input::post("name");

//get request
$name = Input::get("name");
'); ?></pre>
                    
                    <h4>Form</h4>
                    <pre class="php"><?php ___('
//<input type="text" name="name">
echo Form::text("name");

//<select name="gender"><option..</select>
echo Form::select("gender", ["male"=>"Male", "female"=>"Female"]);
'); ?></pre>
                </div>
                
                
                    
                
            </div>
        </div>
        
        <div class="features">
            <div class="container">
                <h2 class="section-title text-center">Features</h2>
                <p class="text-center section-tag-line">Decision to choose a framework depends on the application requirements. Below are few features that makes PHPasap suitable for most of your PHP applications</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-circle"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Small Footprint</h3>
                                <p>PHPasap is one of the very few frameworks having really small footprint, about less than a MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-cogs"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Simple to install</h3>
                                <p>Just unzip and you are done. It is really as simple as that. No composer, no third party dependencies.</p>        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-rocket"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Amazingly fast</h3>
                                <p>Most of the files are lazy loaded using the powerful autoloader. This improves the performance tremendously.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-code"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Simple syntax</h3>
                                <p>PHPasap was written to speed up development process and make life of developer more easier. Accordingly each class methods names are kept precise and easy to remember.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-child"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Code as you like</h3>
                                <p>Except for a file naming convention, PHPasap doesn't restrict you in any way to any kind of coding or naming convention. You may call your controller <code>Post_Controller</code> or just <code>Post</code> or anything you want. PHPasap leaves it upto you.</p>        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-hand-o-right"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Place your classes anywhere</h3>
                                <p>PHPasap used namespace based autoloader. Except for Controllers and Views, you are free to keep your class files anywhere in your application.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-lightbulb-o"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Learn quickly</h3>
                                <p>Even if you are beginner it will not take you more than a hour to understand the entire framework.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-files-o"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Well documented</h3>
                                <p>Be it comments in code or our extensive api documentation, everything is explained clearly with examples to illustrate use wherever possible.</p>        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-support"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Full support</h3>
                                <p>We love to hear from our users. Be it a query or any suggestions we are always eager to get in touch with you.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-circle"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Small Footprint</h3>
                                <p>PHPasap is one of the very few frameworks having really small footprint, about less than a MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-cogs"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Simple to install</h3>
                                <p>Just unzip and you are done. It is really as simple as that. No composer, no third party dependencies.</p>        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="media">
                            <div class="media-left">
                                <h1><i class="fa fa-rocket"></i></h1>
                            </div>
                            <div class="media-body">
                                <h3>Amazingly fast</h3>
                                <p>Most of the files are lazy loaded using the powerful autoloader. This improves the performance tremendously.</p>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    <?php echo View::render('modules/footer'); ?>