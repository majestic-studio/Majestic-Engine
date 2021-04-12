<?php

if ($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '') {
    Route::get($_SERVER['REQUEST_URI'], [
        'controller'    => 'ErrorController',
        'action'        => 'page404',
    ]);
}

# Главная страница
Route::get('/', [
    'controller'	=>  'HomeController',
    'action'		=>  'home'
]);