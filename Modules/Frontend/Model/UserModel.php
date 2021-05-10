<?php


namespace Modules\Frontend\Model;


use Core\Service\Orm\Model;

class UserModel extends Model
{
    # Выбор таблицы базы данных
    protected static string $table = 'users';
}