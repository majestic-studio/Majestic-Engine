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


namespace Core\Service\Http;


use JetBrains\PhpStorm\NoReturn;

/**
 * Класс для работы редиректа
 *
 * Class Redirect
 * @package Core\Service\Http
 */
class Redirect
{
    /**
     * @param string $url
     * @param false $permanent
     */
    #[NoReturn] public static function go(string $url, bool $permanent = false)
    {
        if ($permanent) {
            header('HTTP/1.1 301 Moved Permanently');
        }

        header('Location: ' . $url);
        exit();
    }
}
