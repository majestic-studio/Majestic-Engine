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


namespace Core\Service\Library;


use Core\Service\Path\Path;


/**
 * Class Library
 * @package Core\Service\Library
 */
class Library
{
    /**
     * Возвращение пути к папке библиотеки
     *
     * @param bool $absolute - false|true, абсолютный и относительный путь соответственно
     * @return string
     */
    final public static function library(bool $absolute = false): string
    {
        $path = new Path();

        if (!$absolute) {
            return '//' . $path->Library('', $absolute);
        }

        return $path->Library('', $absolute);
    }

    /**
     * Возвращение пути к папке Vendor
     *
     * @param bool $absolute - false|true, абсолютный и относительный путь соответственно
     * @return string
     */
    final public static function vendor (bool $absolute = false): string
    {
        $path = new Path();

        if (!$absolute) {
            return $path->Library('vendor', $absolute);
        }

        return $path->Library('vendor', $absolute);
    }

    /**
     * Возвращение пути к папке Themes
     *
     * @param bool $absolute - false|true, абсолютный и относительный путь соответственно
     * @return string
     */
    final public static function theme (bool $absolute = false): string
    {
        $path = new Path();

        if (!$absolute) {
            return '//' . $path->Library('theme', $absolute);
        }

        return $path->Library('theme', $absolute);

    }
}