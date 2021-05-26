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


namespace Core\Service\Settings;


/**
 * Class Repository
 * @package Run\Settings
 */
class Repository
{
    /**
     * @var array Stored setting items.
     */
    protected static array $stored = [];

    /**
     * Stores a setting item.
     *
     * @param string $section The item group.
     * @param mixed $data The item data.
     * @return void
     */
    public static function store(string $section, mixed $data): void
    {
        /**
         * Проверка, что группа значений является массивом
         */
        if (!isset(static::$stored[$section])) {
            static::$stored[$section] = [];
        }

        static::$stored[$section][$data->key_field] = $data;
    }

    /**
     * Извлекает элемент настроек
     *
     * @param string $section
     * @param string $key
     * @return mixed
     */
    public static function retrieve(string $section, string $key): mixed
    {
        return static::$stored[$section][$key] ?? false;
    }

    /**
     * Извлекает элемент настроек группы.
     *
     * @param string $section The item group.
     * @return mixed
     */
    public static function retrieveGroup(string $section): mixed
    {
        return static::$stored[$section] ?? false;
    }
}
