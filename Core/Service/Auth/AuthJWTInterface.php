<?php


namespace Core\Service\Auth;


interface AuthJWTInterface
{
    /**
     * Проверка, существует ли пользователь с указанным именем и паролем.
     *
     * Возвращает true, если есть совпадения.
     * Возвращает false, если нет совпадений.
     *
     * @param string $name
     * @param string $password
     * @return bool
     */
    public function checkUser(string $name, string $password): bool;
}