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


namespace Core;


/**
 * Базовые константы проекта
 *
 * Class Define
 * @package Run
 */
class Define
{
    public const NAME               = 'Majestic Framework';
    public const NAME_HEAD          = 'Majestic System';
    public const VERSION            = '0.2.0';
    public const PHP_MIN            = '8.0';
    public const SECURITY_KEY       = 'a32#fidgrwly328or&*T#GRL&W';


    public static function base(bool $host = false)
    {
        if($host === true) return $_SERVER['HTTP_HOST'];
        else return '//' . $_SERVER['HTTP_HOST'];
    }

    /**
     * Вывод времени системы в цифровом формате:
     * Год | месяц | день | час | минуты | секунды
     * без пробелов и разделителей
     *
     * @return string
     */
    public static function systemDate(): string
    {
        return date("WmdHis");
    }
}
