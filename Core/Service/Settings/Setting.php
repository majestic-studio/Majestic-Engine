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


use Exception;


/**
 * Class SettingModel
 * @package Run\Settings
 */
class Setting
{
    /**
     * Получение
     *
     * @param string $key
     * @param string $section
     * @return false|mixed
     * @throws Exception
     */
    public static function item(string $key, string $section = 'general')
    {
        if (!Repository::retrieve($section, $key)) {
            self::get($section);
        }

        return Repository::retrieve($section, $key);
    }

    /**
     * Получения значения по ключу и секции
     *
     * @param string $key
     * @param string $section
     * @return string
     * @throws Exception
     */
    public static function value(string $key, string $section = 'general'): string
    {
        $item = static::item($key, $section);

        return $item->value ?? '';
    }

    /**
     * @param string $section
     * @return bool
     * @throws Exception
     */
    public static function get(string $section): bool
    {
        $settings = SettingDatabase::select()
            ->where('section', '=', $section)
            ->all();
        // Items must be an array.
        if (is_array($settings) && !empty($settings)) {
            // Store items.
            foreach ($settings as $key => $value) {
                Repository::store($section, $value);
            }

            // Successful settings load.
            return true;
        }

        // Settings load unsuccessful.
        return false;
    }
}
