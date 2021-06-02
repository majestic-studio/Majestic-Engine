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
 * Class RouteAbstract
 * @package Core\Service\Routing
 */
abstract class RouteAbstract
{
    /**
     * @var string - маршрутный префикс.
     */
    private static string $prefix = '';

    /**
     * @var string - модуль, для которого мы настраиваем маршруты.
     */
    public static string $module;

    /**
     * Добавление роута.
     *
     * @param  string  $method - метод маршрута,
     * @param  string  $uri - URI для маршрутизации.
     * @param  array  $options - варианты маршрута.
     * @return bool
     */
    public static function add(string $method, string $uri, array $options): bool
    {

        if (static::validateOptions($options)) {
            # Установить модуль.
            if (!isset($options['module'])) {
                $options['module'] = static::$module;
            }

            # Установить маршрут.
            Repository::store($method, static::prefixed($uri), $options);

            return true;
        }

        return false;
    }

    /**
     * Добавляет префикс к URI.
     *
     * @param  string  $uri - URI для префикса.
     * @return string
     */
    public static function prefixed(string $uri): string
    {
        /**
         * Нормализуем URI.
         */
        $uri = trim($uri, '/');

        /**
         * Префикс префикса, если он установлен.
         */
        if (static::$prefix !== '') {
            $uri = trim(static::$prefix, '/') . '/' . $uri;
        }

        return $uri;
    }

    /**
     * Проверяет параметры маршрута.
     *
     * @param  array  $options - параметры маршрута для проверки.
     * @return bool
     */
    private static function validateOptions(array $options): bool
    {
        return isset($options['controller'], $options['action']);
    }
}