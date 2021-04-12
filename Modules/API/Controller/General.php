<?php


namespace Modules\API\Controller;


use APIController;
use Core\Define;
use Core\Service\Auth\AuthJWT;
use Core\Service\Client\Client;
use Core\Service\Geolocation\Geolocation;
use Core\Service\Http\Header;
use Core\Service\Http\Input;
use Core\Service\JWT\JWT;
use Modules\API\Model\ProductModel;
use Modules\API\Model\UserModel;

class General extends APIController
{
    public function info()
    {
        $code = 200;
        $data['result'] = [
            getallheaders()
        ];

        $data['error'] = [];

        $this->setData($code, $data['error'], $data['result']);
    }
}