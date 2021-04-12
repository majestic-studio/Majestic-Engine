<?php


namespace Modules\Geolocation\Controller;


use APIController;


class GeolocationController extends APIController
{
    public function about(): void
    {
        $result = [
            'Массив результата' => 'Главная страница',
        ];

        $error = [
        ];
        $this->setData(200, $error, $result);
    }
}