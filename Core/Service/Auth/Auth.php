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
final class Auth
{

    /**
     * Пользователь аутентифицирован?
     *
     * @var bool
     */
    protected static bool $authorized = false;

    /**
     * Аутентифицированный пользователь.
     *
     * @var object|null
     */
    protected static ?object $user;

    /**
     * Инициализация авторизации
     *
     * @return void
     */
    public static function initialize(): void
    {
        /**
         * Проверяем, авторизирован ли пользователь
         * если нет, то ничего не выполняем.
         */
        if (Session::has('auth.user') && Session::has('auth.authorized')) {
            static::$authorized = Session::get('auth.authorized');
            static::$user       = Session::get('auth.user');
        }
    }

    /**
     * Пользователь авторизован?
     *
     * @return bool
     */
    public static function authorized() : bool
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
     * Пользователь для авторизации.
     *
     * @param object $user
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
     * Авторизировать пользователя.
     *
     * @param object $user - пользователь для авторизации.
     * @return void
     */
    public static function authorizeUser(object $user): void
    {
        Session::put('auth.authorizedUser', true);
        Session::put('auth.userUser', $user);

        static::$authorized = true;
        static::$user       = $user;
    }

    /**
     * Несанкционированный текущий пользователь.
     *
     * @return void
     */
    public static function unauthorized(): void
    {
        Session::forget('auth.authorized');
        Session::forget('auth.user');

        static::$authorized = false;
        $user       = null;
    }

    /**
     * Неавторизированный пользователь
     *
     * @return void
     */
    public static function unAuthorizeUser(): void
    {
        Session::forget('auth.authorizedUser');
        Session::forget('auth.userUser');
        session_destroy();

        static::$authorized = false;
        static::$user       = null;
    }
}
