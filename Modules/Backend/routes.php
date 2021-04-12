<?php

# Главная страница
Route::get('/admin', [
    'controller'	=>  'HomeController',
    'action'		=>  'dashboard'
]);