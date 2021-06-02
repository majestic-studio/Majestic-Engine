<?php


namespace Modules\Frontend\Model;


use Core\Service\Orm\Model;
use Core\Service\Orm\Query;

class UserModel extends Model
{
    # Выбор таблицы базы данных
    protected static string $table = 'accounts';

    public function getUser(){}

    public function auth( $login,  $password)
    {
        return self::where('name', '=', $login)
        ->where('password', '=', $password)
        ->first();
    }

    public function getUserByParams( $login,  $password)
    {
        return Query::table(static::$table)
            ->select()
            ->where('name', '=', $login)
            ->where('password', '=', $password)
            ->first();
    }
}