<?php


namespace Modules\API\Controller;


use APIController;
use Modules\API\Model\GeneralMenuModel;

class GeneralMenu extends APIController
{
    public function getSection()
    {
        $model = new GeneralMenuModel();

        $data['error'] = [];



        $this->setData(200, $data['error'], $model->getSectionMenu());
    }
}