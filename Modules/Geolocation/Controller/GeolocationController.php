<?php


namespace Modules\Geolocation\Controller;


use APIController;
use Core\Service\Geolocation\Geolocation;


class GeolocationController extends APIController
{
    public function get(): void
    {

        /**
         * TODO::Реальный IP пользователя + обработчик неизвестных ошибок.
         */
        $geo = new Geolocation();
        $result = [
            $geo->get('185.143.178.82')
        ];

        $error = [
        ];
        $this->setData(200, $error, $result[0]);
    }
}