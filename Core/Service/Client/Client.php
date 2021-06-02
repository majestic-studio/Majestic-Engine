<?php


namespace Core\Service\Client;


use Core\Service\Localization\Language;
use DI;


class Client
{

    /**
     * Получение и подключение языка пользователя.
     * Функция Language::getLanguage(:string) вместо :string принимает значение языка
     * пользователя. Если параметр отсутствует, то получаем язык, который установлен в
     * конфигурации системы по умолчанию.
     *
     * @return string
     */
    public static function language(): string
    {
        Language::getLanguage();

        return DI::instance()->get('lang');
    }

    /**
     * Получение реального IP адреса пользователя для дальнейших
     * манипуляций над ним.
     *
     * @return string|null
     */
   public static function getIP(): ?string
   {
       $ip = null;

       $keys = [
           'HTTP_CLIENT_IP',
           'HTTP_X_FORWARDED_FOR',
           'REMOTE_ADDR'
       ];

       foreach ($keys as $key) {
           if (!empty($_SERVER[$key])) {
               $array = explode(',', $_SERVER[$key]);
               $ip = trim(end($array));
               if (filter_var($ip, FILTER_VALIDATE_IP)) {
                   return $ip;
               }
           }
       }

       return $ip;
   }
}