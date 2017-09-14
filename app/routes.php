<?php
Route::add('ANY', '/', function() {
    return View::make('templates/home',['nav'=>get_prev_next_curr()]);
    $content = View::render('modules/welcome');
    return View::make('templates/main', ['content' => $content]);
    });

Route::add('GET', 'docs/{section}', 'Docs_Controller@view');

Route::add('CONTROLLER', 'crud', 'Crud_Controller');

Route::add('GET', 'test', 'Docs_Controller@test');