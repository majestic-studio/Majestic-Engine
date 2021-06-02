<?php

# Получение данных по IP
APIRoute::api('get', '/api/v1/geo/', [
    'controller'	=>  'GeolocationController',
    'action'		=>  'get',
    'assets'        =>  'international',
]);