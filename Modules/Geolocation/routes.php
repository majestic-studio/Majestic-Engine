<?php

# Главная страница API;
APIRoute::api('get', '/api/v1/geo/', [
    'controller'	=>  'GeolocationController',
    'action'		=>  'get',
    'assets'        =>  'international',
]);