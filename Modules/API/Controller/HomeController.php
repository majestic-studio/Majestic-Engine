<?php


namespace Modules\API\Controller;


use APIController;
use Modules\API\Model\ProductModel;

class HomeController extends APIController
{
    public function home(): void
    {
        $result = [
            'title'     =>  'Главная страница'
        ];
        $this->setData($result);
    }
}