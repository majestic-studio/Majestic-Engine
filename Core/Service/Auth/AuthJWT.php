<?php


namespace Core\Service\Auth;


use Core\Define;
use Core\Service\JWT\JWT;
use DateTimeImmutable;

class AuthJWT
{
    /**
     * Получение JWT пользователя
     *
     * @param string $user
     * @return string
     */
    public static function userKey(string $user): string
    {
        $security = Define::SECURITY_KEY;
        $issuedAt = new DateTimeImmutable();
        $expire = $issuedAt->modify('+6 minutes')->getTimestamp();

        $JWTData = [
            "iss" => Define::base(true),
            "aud" => Define::base(true),
            'iat' => $issuedAt->getTimestamp(),
            'nbf' => $issuedAt->getTimestamp(),
            'exp' => $expire,
            'user' => [
                'name' => $user
            ]
        ];

        return JWT::encode($JWTData, $security, 'HS512');
    }

    public static function decodeUser(string $key): array|object
    {
        return JWT::decode($key, Define::SECURITY_KEY, ['HS512']);
    }

}