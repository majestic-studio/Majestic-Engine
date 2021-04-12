<?php


namespace Core\Service\Client;


class Client
{
    /**
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