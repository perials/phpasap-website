<?php
Route::add('ANY', '/', function() {
    View::set(['ver'=>false, 'home'=>true]);
    return View::make('templates/home',['nav'=>get_prev_next_curr()]);
    });

Route::add('GET', 'docs', 'Docs_Controller@view');
Route::add('GET', 'docs/1.1/{section}', 'Docs_Controller@view_1_1');
Route::add('GET', 'docs/{section}', 'Docs_Controller@view');