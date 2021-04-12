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


use Core\Service\Orm\Model;
use Exception;
use Query;


/**
 * Класс исключительно для получения данных настроек сайта из базы данных
 * Таблица setting
 *
 * Class SettingDatabase
 * @package Core\Service\Settings
 */
class SettingDatabase extends Model
{
    private const SECTION_GENERAL = 'general';

    /**
     * @var string
     */
    protected static string $table = 'setting';

    /**
     * Получение настроек сайта
     *
     * @return array
     * @throws Exception
     */
    public function getSettings(): array
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('section', '=', self::SECTION_GENERAL)
            ->orderBy('id')
            ->all();
    }
}