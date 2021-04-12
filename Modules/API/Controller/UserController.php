<?php


namespace Modules\API\Controller;


use APIController;
use Core\Service\Auth\AuthJWT;
use Core\Service\Http\Input;
use Modules\API\Model\UserModel;

class UserController extends APIController
{
    public function auth(): void
    {
        $params  = Input::post();
       # dd($params);
       # $ip      = Client::getIP();

        #$geo     = new Geolocation();
       # $city    = $geo->get($ip)['city']['name_en'];
       #$country = $geo->get($ip)['country'];

        $userModel = new UserModel();

        $userData = [
            'username'  => $params['username'],
            'password'  => $params['password'],
        #    'ip'        => $ip
        ];


        $validationUser = $userModel->getUserByParams($userData);
        $getUser        = $userModel->getUser($userData['username']);

        if($validationUser !== null) {
            $http_code = 200;
            $jwtUser = [
                'username'  => $getUser['username'],
                'key'       => $getUser['key'],
           #     'ip'        => $ip,
           #     'city'      => $city,
            #    'country'   => $country,
            ];

            $JWT = new AuthJWT();

            $token = $JWT->generationToken($jwtUser);

            $nuxt = [
                'message'       => 'Добро пожаловать!',
                'code'          => 0
            ];

            $data['result'] = [
                'id'        => $getUser['id'],
                'isDel'     => 0,
                'isSuper'   => 1,
                'platform'  => null,
                'username'  => $getUser['username'],
                'token'     => $token,
                'login_update'  => date("Y-m-d H:i:s")
            ];

            $data['error'] = [];
        } else {
            $http_code = 200;
            $data['result'] = [];
            $data['error'] = [
                'auth'      => false,
                'message'   => 'Ошибка авторизации, введен неверный логин или пароль'
            ];

            $nuxt = [
                'message'       => $data['error']['message'],
                'code'          => 1
            ];
        }

        $this->setData($http_code, $data['error'], $data['result'], $nuxt);
    }

    public function user(): void
    {

        # foreach($_SERVER as $key=>$value) {
        #     if (substr($key,0,5)=="HTTP") {
        #         $key=str_replace(" ","-",ucwords(strtolower(str_replace("_"," ",substr($key,5)))));
        #         $out[$key]=$value;
        #     }else{
        #         $out[$key]=$value;
        #     }
        # }

dd($_POST);
        if(isset($_SERVER['HTTP_AUTHORIZATION']) === true) {
            $JWT = new AuthJWT();
            $token = $_SERVER['HTTP_AUTHORIZATION'];
            $result = $JWT->getUserToken($token);
            $error = [];
            if($result === '') {
                $error = [
                    'auth'  => false,
                    'message' => 'Неверный JWT'
                ];
            }
            $code = 200;
        } else {

            $result = [];
            $error = [
                'auth' => false,
                'message' => 'Отсутствуют данные для авторизации'
            ];

            $code = 401;
        }

       $this->setData($code, $error, $result);
    }

    public function menu()
    {
        $string = json_decode('{"result":[{"id":81,"url":"/message","sort":1,"icon":"icon-BUG","keepAlive":1,"parentId":-1,"name":"消息管理"},{"id":2,"url":"system/account","sort":2,"icon":"icon-kehuguanli","keepAlive":1,"parentId":1,"name":"账号管理"},{"id":3,"url":"/system/role","sort":3,"icon":"icon-shijuexianshi","keepAlive":1,"parentId":1,"name":"角色管理"},{"id":4,"url":"system/access","sort":5,"icon":"icon-yun","keepAlive":1,"parentId":1,"name":"资源管理"},{"id":1,"url":"system","sort":6,"icon":"icon-yun","keepAlive":1,"parentId":-1,"name":"系统管理"},{"id":5,"url":"system/dict","sort":6,"icon":"icon-ziduanguanli","keepAlive":0,"parentId":1,"name":"字典管理"}],"code":0,"message":"请求成功"}');

        $this->setData(200, '', $string->result);
    }
}