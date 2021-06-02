<?php


namespace Modules\API\Controller;


use APIController;
use Core\Service\Auth\Auth;
use Modules\Frontend\Model\UserModel;

/**
 * Контроллер для вывода ошибок API
 * Class Error
 * @package Modules\API\Controller
 */
class AccountAPI extends APIController
{
    public function userVerification(): void
    {
        $userModel = new UserModel();
        $auth = new Auth();
        if($_POST !== [])
        {
            $user = $_POST['user'];
            $password = $_POST['password'];
            $code = 200;
        } else {
            $user = '';
            $password = '';
            $code = 400;
            $data['error'] = [
                'message'   => 'Данные не введены или введены неверно'
            ];
        }

        $user = $userModel->getUserByParams($user, $password);

        $auth::authorize($user);
        $userModel->auth($user, $password);
        $data = [
            'result'    => [],
            'error'    => []
        ];

        $this->setData($code, $data['error'], $data['result']);
    }
}