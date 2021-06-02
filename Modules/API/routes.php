<?php

use Core\Service\Http\Uri;

if (Uri::segment(1) === 'api' ) {

    APIRoute::api('get', $_SERVER['REQUEST_URI'], [
        'controller'	=>  'Error',
        'action'		=>  'not_page',
        'assets'        =>  'international',
    ]);
}
# Главная страница API;
    APIRoute::api('get', '/api/', [
        'controller' => 'General',
        'action' => 'info',
        'assets' => 'international',
    ]);

# Главная страница API;
    APIRoute::api('post', '/api/v1/admin/login/', [
        'controller' => 'UserController',
        'action' => 'auth',
        'assets' => 'international',
    ]);

    # Главная страница API;
    APIRoute::api('get', '/api/v1/system/menu/', [
        'controller' => 'GeneralMenu',
        'action' => 'getSection',
        'assets' => 'international',
    ]);

        # Проверка вводимых данных пользователя POST
    APIRoute::api('post', '/api/account/verification', [
        'controller' => 'AccountAPI',
        'action' => 'verification',
        'assets' => 'international',
    ]);