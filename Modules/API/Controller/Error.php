<?php


namespace Modules\API\Controller;


use APIController;

/**
 * Контроллер для вывода ошибок API
 * Class Error
 * @package Modules\API\Controller
 */
class Error extends APIController
{
    public function not_page(): void
    {
        $code = 404;


        $data['error'] = [
            'message'       => 'Параметры запроса заданы не верно'
        ];

        $this->setData($code, $data['error']);
    }
}