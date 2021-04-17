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
    final public function getLanguage(string $userLanguage = '')
    {
        return $this->setLanguage($userLanguage);
    }

    /**
     * Установка языка система по умолчанию, если нет $userLanguage,
     * то необходимо взять начальный язык системы из файла конфигурации main[defaultLanguage]
     *
     * @param string $userLanguage
     * @return object
     */
    private function setLanguage(string $userLanguage = '')
    {
        if($userLanguage === '') {
            $language = Config::item('defaultLanguage', 'main');
        } else {
            $language = $userLanguage;
        }

        return DI::instance()->set('lang', $language);
    }
}