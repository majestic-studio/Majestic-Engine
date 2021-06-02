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


namespace Core\Service\API;


use Core\Service\Http\Header;
use Core\Service\Http\Request;
use Core\Service\Http\Uri;
use Core\Service\Routing\Router;
use JetBrains\PhpStorm\NoReturn;
use JsonException;


class API
{
    /**
     * @param object $data
     * @param mixed $nuxt
     * @throws JsonException
     */
    #[NoReturn] public function data(object $data, mixed $nuxt): void
    {
        $module = new Router;
        $API = $data->APIInstance->data;
        $APIResult = $data->APIInstance->data['result'];
        $access = new Access;

        $validation = $access->permit($module::module()->assets);

        if(!is_int($API['code'])) {
            $API['code'] = 500;
            Header::code($API['code']);
            die('API engine error, pleas contact for system administrator for website');
        }

        if($validation['validation'] === false) {
            $API['code'] = 403;
        }

       $time = microtime(true);
       $generation = round($time - TIME, 3);

        if($API['result'] === null) {
            $API['result'] = [];
        }

        if($validation['error'] !== [] && $API['error'] !== []) {
            $error = array_merge($API['error'], $validation['error']);
        } elseif($API['error'] !== []) {
            $error = $API['error'];
        } else {
            $error = $validation['error'];
        }

       $result = array_merge($nuxt, [
           'example'       => [
               'name'          =>  'API',
               'version'       => '1.0',
               'this-http-method'   => Request::method(),
               'support-method'    =>
                   Request::$method,
               'http-code'  => $API['code']
           ],
           'result'         => $APIResult,
           'error'         =>  $error,
           'info'           => [
               'access-level'  => $module::module()->assets,
               'access'        => $validation['validation'],
               'time-creating'   => $generation
           ],
           'path'   => Uri::segmentString(),
           'time-generation'   => [
               'date'   => date("j, n, Y"),
               'time'   => date("H:i:s")
           ]
       ]);

       die(json_encode($result, JSON_THROW_ON_ERROR));
    }
}