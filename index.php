<?php
/**
 *=====================================================
 * Majestic Next Engine - by Zerxa Fun                =
 *-----------------------------------------------------
 * @url: http://majestic-studio.com/                  =
 *-----------------------------------------------------
 * @copyright: 2021 Majestic Studio and ZerxaFun      =
 *=====================================================
 * @license GPL version 3                             =
 *=====================================================
 * index.php - исполняемый файл и точка входа         =
 * в систему.                                         =
 * Подключение composer и констант фреймворка         =
 *=====================================================
 */


use Core\Service\Routing\Router;

/**
 * @TIME - системная константа определяющая время запуска скрипта
 */
define('TIME', microtime(true));

/**
 * @ROOT_DIR - константа определяющая корневую папку проекта {src / core}.
 * Служит для удобного обращения к структуре проекта из любой точки, либо файла.
 */
const ROOT_DIR = __DIR__;

/**
 * Подключение авто загрузчика классов Composer (PSR-4)
 */
require_once ROOT_DIR . '/vendor/autoload.php';

/**
 * Подключение всех Helpers
 */
require_once ROOT_DIR . '/Core/Helpers/Language.php';

/**
 * Инициализация проекта и его запуск, в случаи непредвиденной ошибки вызываем
 * Exception и выводим ошибку в dump($var)
 *
 * TODO:: Создать функционал запиши ошибки в log-файл системы
 **/
try {
    #dd(\Core\Service\Auth\Auth::authorized());
    Router::initialize();
} catch (Exception $e) {
    dd($e);
}