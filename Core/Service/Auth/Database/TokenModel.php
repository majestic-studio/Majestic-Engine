<?php


namespace Core\Service\Auth\Database;


use Core\Service\Orm\Database\Eloquent\Model;

class TokenModel extends Model
{
    protected string $table = 'token';

    public function validationToken(string $key_token)
    {

    }
}