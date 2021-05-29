<?php


namespace Modules\API\Controller;


use APIController;

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