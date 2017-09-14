<?php
namespace app\Controllers;

class Docs_Controller {
    
    public function view($section='') {
        if( !View::exists('docs/'.$section) )
        show_error("View file doesn't exists", true);
        
        return View::make('templates/docs',['content'=>View::render('docs/'.$section), 'nav'=>get_prev_next_curr()]);
    }
    
    public function test() {
        $all_posts = DB::update("UPDATE wp_posts SET post_author=5 WHERE ID=?",[6]);
        dd($all_posts);
    }
    
}