<?php
/**
 *=====================================================
 * Majestic Engine - by Zerxa Fun (Majestic Studio)   =
 *-----------------------------------------------------
 * @url: http://majestic-studio.ru/                   -
 *-----------------------------------------------------
 * @copyright: 2020 Majestic Studio and ZerxaFun      -
 *=====================================================
 *                                                    =
 *                                                    =
 *                                                    =
 *=====================================================
 */


namespace Core\Service\Auth;

use Core;
use Core\Service\Session\Facades\Session;

/**
 * Класс для работы с аунтефикацией и авторизации пользователя
 *
 * Class Auth
 * @package Core\App\Auth
 */
class Auth
{
    /**
     * @var bool Пользователь аутентифицирован?
     */
    protected static bool $authorized = false;

    /**
     * @var object Авторизованный пользователь.
     */
    protected static object $user;

    /**
     * Создайте экземпляр класса аутентификации.
     *
     * @return void
     */
    public static function initialize(): void
    {
        if (Session::has('auth.user') && Session::has('auth.authorized')) {
            static::$authorized = Session::get('auth.authorized');
            static::$user       = Session::get('auth.user');
        }
    }

    /**
     * Проверка, авторизирован ли пользователь.
     *
     * @return bool
     */
    public static function authorized(): bool
    {
        return static::$authorized;
    }

    /**
     * Возвращает аутентифицированного пользователя.
     *
     * @return object
     */
    public static function user(): object
    {
        return static::$user;
    }

    /**
     * Авторизация пользователя.
     * Принимает в себя данные пользователя в виде объекта.
     *
     * @param  object $user - пользователь для авторизации.
     * @return void
     */
    public static function authorize(object $user): void
    {
        Session::put('auth.authorized', true);
        Session::put('auth.user', $user);

        static::$authorized = true;
        static::$user       = $user;
    }

    /**
     * Удаление данных текущего пользователя.
     *
     * @return void
     */
    public static function UnAuthorizes(): void
    {
        Session::forget('auth.authorized');
        Session::forget('auth.user');

        static::$authorized = false;
        static::$user       = (object) null;
    }
}