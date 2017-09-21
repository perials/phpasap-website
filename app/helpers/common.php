<?php
function ___($string) {
    echo htmlentities($string);
}
/*
function get_link_class($url) {
    if( Request::is(Route::base_url().'/'.$url) )
    return 'active';
    else
    return '';
}
*/

function nav_link($url, $title) {
    $url = HTML::url($url);
    if( Request::is( $url ) )
    $attr = ['class'=>'active'];
    else
    $attr = [];
    return HTML::link($url, $title, false, $attr);
}

function my_custom_func($validator_obj, $field_value) {
    $validator_obj->set_error('last_name','This is custom message from commoon');
}

function prev_next($prev=null, $next=null) {
    if($prev == null && $next == null) return;
    ?>
    <div class="next-prev-wrap">
        <?php if( $prev ) { ?>
        <a class="prev-link" href="<?php echo HTML::url($prev); ?>"><i class="fa fa-arrow-circle-left"></i> Previous</a>
        <?php } ?>
        <?php if( $next ) { ?>
        <a class="next-link" href="<?php echo HTML::url($next); ?>">Next <i class="fa fa-arrow-circle-right"></i></a>
        <?php } ?>
    </div>
    <?php
}

function nav_array($ver = "") {
    $ver = $ver ? $ver . "/" : "";
    return [
        
        "Overview" => [
                        ['docs/'.$ver.'overview', 'What is PHPasap'],
                        ['docs/'.$ver.'license', 'License'],
                        ['docs/'.$ver.'install', 'Installation'],
                    ],
        "Quickstart Example" => [
                        ['docs/'.$ver.'crud-overview', 'CRUD application'],
                        ['docs/'.$ver.'crud-create-new-form', 'Create New form'],
                        ['docs/'.$ver.'crud-edit-form', 'Edit form'],
                        ['docs/'.$ver.'crud-view-all', 'View All'],
                        ['docs/'.$ver.'crud-delete', 'Delete'],
                    ],         
        "Basic MVC" => [
                        ['docs/'.$ver.'config', 'Config Variables'],
                        ['docs/'.$ver.'routes', 'Routing'],
                        ['docs/'.$ver.'controller', 'Controller'],
                        ['docs/'.$ver.'database', 'Database Queries'],
                        ['docs/'.$ver.'models', 'Models'],
                        ['docs/'.$ver.'views', 'Views'],
                    ],
        "General" => [
                        ['docs/'.$ver.'request', 'Request'],
                        ['docs/'.$ver.'session', 'Session'],
                        ['docs/'.$ver.'cookies', 'Cookies'],
                        ['docs/'.$ver.'form', 'Form'],
                        ['docs/'.$ver.'form-validation', 'Validation'],
                        ['docs/'.$ver.'mail', 'Mail'],
                        ['docs/'.$ver.'assets', 'Assets (CSS, JS and Images)'],
                     ],
        "Customizing" => [
                        ['docs/'.$ver.'libraries', 'Libraries (Custom Classes)'],
                        ['docs/'.$ver.'helpers', 'Helpers (Custom Functions)'],
                    ],
        "Additional Topics" => [
                        ['docs/'.$ver.'composer', 'Composer'],
                    ],
    ];    
}

function get_prev_next_curr($ver="") {
    $i = 0;
    $link_array = [];
    $current = false;
    $return_array = ['prev'=>null, 'next'=>null, 'current'=>null];
    foreach( nav_array($ver) as $section=>$sub_section_array ) {
        foreach($sub_section_array as $sub_section) {
            $i++;
            
            $link_array[$i] = $sub_section;
            
            if(Request::is(Route::base_url().'/'.$sub_section[0]))
            $current = $i;
        }
    }
    if($current) {
        
        if( isset($link_array[$current-1]) )
        $return_array['prev'] = $link_array[$current-1];
        
        if( isset($link_array[$current+1]) )
        $return_array['next'] = $link_array[$current+1];
        
        $return_array['current'] = $link_array[$current];
    }
    
    return $return_array;
    //prev_next($return_array['prev'], $return_array['next']);
}