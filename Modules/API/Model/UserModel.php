<?php


namespace Modules\API\Model;



use Core\Service\Orm\Database\Eloquent\Model;
use Core\Service\Orm\support\Facades\DB;
use Exception;


class UserModel extends Model
{
    protected string $table = 'users';

    /**
     * Получение параметров пользователя при авторизации
     *
     * @param array $userdata
     * @return null
     */
    public function getUserByParams(array $userdata)
    {
        $model = self::where('username', '=', $userdata['username'])
            ->where('password', '=', $userdata['password'])
            ->first();

        if($model !== null) {
            return $model->toArray();
        }

        return null;
    }


    public function getUser( $username)
    {
        $model = self::where('username', '=', $username)
            ->first();


        return $model;
    }

}