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
 * Class Repository
 * @package Core\Service\Routing
 */
class Repository {
    /**
     * @var array - хранимые маршруты.
     */
    protected static array $stored = [
        'get'       => [],
        'post'      => [],
        'put'       => [],
        'patch'     => [],
        'delete'    => [],
    ];

    /**
     * Получить сохраненные маршруты.
     *
     * @return array
     */
    public static function stored(): array
    {
        return static::$stored;
    }

    /**
     * Магазины нового маршрута.
     *
     * @param  string  $method - метод запроса маршрута.
     * @param  string  $uri - URI маршрута.
     * @param  array   $options - варианты маршрута.
     * @return void
     */
    public static function store(string $method, string $uri, array $options): void
    {

        static::$stored[$method][$uri] = $options;
    }

    /**
     * Получить сохраненный маршрут.
     *
     * @param  string  $method - метод маршрута.
     * @param  string  $uri - URI маршрута.
     * @return array
     */
    public static function retrieve(string $method, string $uri): array
    {
        return static::$stored[$method][$uri] ?? [];
    }

    /**
     * Удалить сохраненный маршрут.
     *
     * @param  string  $method - метод маршрута.
     * @param  string  $uri - URI маршрута.
     * @return bool
     */
    public static function remove(string $method, string $uri): bool
    {
        if (isset(static::$stored[$method][$uri])) {
            unset(static::$stored[$method][$uri]);
            return true;
        }

        return false;
    }
}