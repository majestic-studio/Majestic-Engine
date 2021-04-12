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


namespace Core\Service\Routing;


/**
 * Class Route
 * @package Core\Service\Routing
 */
class Route extends RouteAbstract
{
    /**
     * Устанавливает маршрут GET.
     *
     * @param  string  $uri - URI для маршрутизации.
     * @param  array   $options - варианты маршрута.
     * @return bool
     */
    public static function get(string $uri, array $options): bool
    {
        return static::add('get', $uri, $options);
    }

    /**
     * Устанавливает POST-маршрут.
     *
     * @param  string  $uri - URI для маршрутизации.
     * @param  array   $options - варианты маршрута.
     * @return bool
     */
    public static function post(string $uri, array $options): bool
    {
        return static::add('post', $uri, $options);
    }
}
