<?php
namespace app\Controllers;

class Docs_Controller {
    
    public function view($section='overview') {
        //if( !View::exists('docs-1-1/'.$section) && !View::exists('docs/'.$section) )
        //show_error("View file doesn't exists", true);
        View::set(['ver'=>false]);
        
        $content = "";
        if( View::exists('docs-1-2/'.$section) ) {
            $content = View::render('docs-1-2/'.$section);
        }
        elseif( View::exists('docs/'.$section) ) {
            $content = View::render('docs/'.$section);         
        }
        else {
            show_error("Not found", true);    
        }
        
        return View::make('templates/docs',['content'=>$content, 'nav'=>get_prev_next_curr()]);
        //return View::make('templates/docs',['content'=>View::render('docs/'.$section), 'nav'=>get_prev_next_curr()]);
    }
    
    public function view_1_1($section='overview') {
        if( !View::exists('docs/'.$section) )
        show_error("Not found", true);
        
        View::set(['ver'=>'1.1']);
        
        return View::make('templates/docs',['content'=>View::render('docs/'.$section), 'nav'=>get_prev_next_curr('1.1')]);
    }
    
}