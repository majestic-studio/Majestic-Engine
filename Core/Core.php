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


namespace Core;


use Core\Service\Auth\Auth;
use Core\Service\Database\Database;
use Core\Service\DI\Container;
use Core\Service\Http\Uri;
use Core\Service\Routing\API\APIRoute;
use Core\Service\Routing\Controller;
use Core\Service\Routing\APIController;
use Core\Service\Routing\Route;
use Core\Service\Session\Facades\Session;
use Core\Service\Template\Layout;
use Core\Service\Template\Theme\Theme;
use Core\Service\Template\View;
use Core\Service\Orm\Query;
use Exception;

/**
 * Класс запуска системы, подключение альянсов и инициализация компонентов
 *
 * Class Bootstrap
 * @package Bootstrap
 */
class Core
{
    /**
     * Запуск системы.
     *
     * @throws Exception
     */
    public static function start(): void
    {
        /**
         * Загрузка классов необходимых для работы
         */
        class_alias(Controller::class, 'Controller');
        class_alias(APIController::class, 'APIController');
        class_alias(Layout::class, 'Layout');
        class_alias(Route::class, 'Route');
        class_alias(Query::class, 'Query');
        class_alias(APIRoute::class, 'APIRoute');
        class_alias(View::class, 'View');
        class_alias(Theme::class, 'Theme');
        class_alias(Container::class, 'DI');
        
        /**
         * Инициализация URI.
         */
        Uri::initialize();

		/**
         * Подключение к базе данных.
         */
        Database::initialize();
        /**
         * Инициализация сессий.
         */
        Session::initialize();

        /**
         * Инициализация авторизации.
        */
        Auth::initialize();
    }
	
    /**
     * Отключение системы
     * закрытие соеденения с базой данных
     *
     * @return void
     */
    public static function close(): void
    {
        Database::finalize();
    }
}