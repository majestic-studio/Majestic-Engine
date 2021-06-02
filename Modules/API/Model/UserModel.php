<?php


namespace Modules\API\Model;


use Core\Service\Orm\Model;
use Exception;
use Query;

class UserModel extends Model
{
    # Выбор таблицы базы данных
    protected static string $table = 'accounts';

    /**
     * Получение пользователя по его логину и паролю.
     *
     * @param array $params
     * @return object|bool
     * @throws Exception
     */
    public function getUserByParams(array $params): object|bool
    {
        return Query::table(static::$table)
            ->select()
            ->where('email', '=', $params['user'])
            ->where('password', '=', $params['password'])
            ->first();
    }
}