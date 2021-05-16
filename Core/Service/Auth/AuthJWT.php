<?php


namespace Core\Service\Auth;


use Core\Define;
use Core\Service\JWT\JWT;

class AuthJWT
{

    public function generationToken(array $user): string
    {
        $payload = [
            'iss' => Define::base(true),
            "aud" => "majestic.io",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            'exp' => time()+600, 'uId' => 1,
            'data'  => [
                'user'  => $user['username'],
                'key'   => $user['key'],
                'auth'  => true
            ]
        ];

        return JWT::encode($payload, Define::SECURITY_KEY, 'HS256');
    }

    public function getUserToken(string $token): object|string
    {
        if($token === 'null') {
            $result = '';
        } else {
            $result = JWT::decode($token, Define::SECURITY_KEY, ['HS256']);
        }
        return $result;
    }
}