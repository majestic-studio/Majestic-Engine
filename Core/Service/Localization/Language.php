<?php


namespace Core\Service\Localization;


use Core\Service\Config\Config;
use DI;

class Language
{
    /**
     * Получение языка системы
     *
     * @param string $userLanguage
     * @return object
     */
    final public static function getLanguage(string $userLanguage = ''): object
    {
        return self::setLanguage($userLanguage);
    }

    /**
     * Установка языка система по умолчанию, если нет $userLanguage,
     * то необходимо взять начальный язык системы из файла конфигурации main[defaultLanguage]
     *
     * @param string $userLanguage
     * @return object
     */
    private static function setLanguage(string $userLanguage = ''): object
    {
        if($userLanguage === '') {
            $language = Config::item('defaultLanguage');
        } else {
            $language = $userLanguage;
        }

        return DI::instance()->set('lang', $language);
    }
}