<?php


namespace Modules\API\Controller;


use APIController;
use Core\Service\Auth\Auth;
use Core\Service\Auth\AuthJWT;
use Core\Service\Http\Input;
use Core\Service\Session\Session;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Modules\API\Model\UserModel;

/**
 * @package Modules\API\Controller
 */
class AccountAPI extends APIController
{
    /**
     * @throws Exception
     */
    #[NoReturn] public function verification(): void
    {
        $params = Input::post();
        $model = new UserModel();

        /**
         * Проверка, существует ли пользователь с таким логином и паролем
         * @array $params['password', 'user']
         */
        $user = $model->getUserByParams($params);

        if ($user) {
            if ($user->delete === 1) {
                $code = 401;
                $error = [];
                $result = [
                    'auth' => false,
                    'message' => 'Аккаунт удален, обратитесь в службу поддержки.',
                    'body' => '<span class="badge badge-danger yellow">Аккаунт удален, пожалуйста, обратитесь в тех. поддержку</span>'
                ];
            } else {
                Auth::authorize($user);
                $code = 200;
                $error = [];
                $result = [
                    'auth' => true,
                    'message' => 'Вы успешно авторизированы',
                    'body' => '<span class="badge badge-danger green">Вы успешно авторизированы</span>',
                    'store' => [
                        'user'  => $user->name,
                        'date'  => $user->exit_date,
                        'ip'    => $user->acting_ip,
                        'token'  => AuthJWT::userKey($user->name),
                    ]
                ];

                Session::driver()->put('key', AuthJWT::userKey($user->name));
            }
        } else {
            if ($params['user'] == '' && $params['password'] == '') {
                $code = 401;

                $error = [];
                $result = [
                    'auth' => false,
                    'type' => 'danger',
                    'message' => 'Логин и пароль не введены',
                    'body' => '<span class="badge badge-danger red">Логин и пароль не введены!</span>'
                ];
            } elseif ($params['password'] === '') {
                $code = 401;

                $error = [];
                $result = [
                    'auth' => false,
                    'type' => 'danger',
                    'message' => 'Пароль не введен',
                    'body' => '<span class="badge badge-danger red">Поле "паоль" не может быть пустым!</span>'
                ];
            } elseif ($params['user'] === '') {
                $code = 401;

                $error = [];

                $result = [
                    'auth' => false,
                    'type' => 'danger',
                    'message' => 'Логин не введен',
                    'body' => '<span class="badge badge-danger red">Поле "логин" не может быть пустым!</span>'
                ];
            } else {
                $code = 401;
                $error = [];

                $result = [
                    'auth' => false,
                    'type' => 'danger',
                    'message' => 'Логин или пароль введены неверно!',
                    'body' => '<span class="badge badge-danger red">Логин или пароль введены неверно!</span>'
                ];
            }
        }

        $this->setData($code, $error, $result);
    }
}