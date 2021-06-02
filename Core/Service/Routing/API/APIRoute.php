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


namespace Core\Service\Routing\API;


use Core\Service\Routing\RouteAbstract;


/**
 * Class APIRoute
 * @package Core\Service\Routing\API
 */
class APIRoute extends RouteAbstract
{
    /**
     * Устанавливает маршрут GET.
     *
     * @param string $method
     * @param string $uri - URI для маршрутизации.
     * @param array $options - варианты маршрута.
     * @return bool
     */
    public static function api(string $method, string $uri, array $options): bool
    {
        return static::add($method, $uri, $options);
    }
}