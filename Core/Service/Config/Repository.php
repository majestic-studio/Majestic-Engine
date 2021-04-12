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


namespace Core\Service\Config;


/**
 * Class Repository
 * @package Run\Config
 */
final class Repository
{
    /**
     * Сохраненные элементы конфигурации
     *
     * @var array
     */
    private static array $stored = [];

    /**
     * Хранилище элементов конфигурации
     *
     * @param string $group
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public static function store(string $group, string $key, mixed $data): void
    {
        /**
         * Проверка, является ли группа допустимым массивом
         */
        if (!isset(self::$stored[$group]) || !is_array(self::$stored[$group])) {
            self::$stored[$group] = [];
        }

        /**
         * Помещение группы ключей в $data
         */
        self::$stored[$group][$key] = $data;
    }

    /**
     * Получение элементов конфигурации
     *
     * @param string $group
     * @param string $key
     * @return mixed
     */
    public static function retrieve(string $group, string $key): mixed
    {
        return self::$stored[$group][$key] ?? false;
    }

    /**
     * Получение элементов массива
     *
     * @param string $group
     * @return mixed
     */
    public static function retrieveGroup(string $group): mixed
    {
        return self::$stored[$group] ?? false;
    }
}
