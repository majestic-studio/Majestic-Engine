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


namespace Core\Service\Http;


use JsonException;

/**
 * Class Input
 * @package Core\Service\Http
 */
class Input
{
    /**
     * @param bool
     * @return array
     */
    public static function get(bool $key = false): array
    {
        return $key ? static::getParam($key, $_GET) : $_GET;
    }

    /**
     * Проверка POST отправленных данных
     *
     * @param bool $key
     * @return array
     */
    public static function post(bool $key = false): array
    {
        return $key ? static::getParam($key, $_POST) : $_POST;
    }

    public static function json(bool $key = false): array
    {
        try {
            $input = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            die($e);
        }
        return $key ? static::getParam($key, $input) : $input;
    }

    /**
     * @param bool $key
     * @return mixed
     */
    public static function files(bool $key = false): mixed
    {
        return $key ? static::getParam($key, $_FILES) : $_FILES;
    }

    /**
     * @param string $key
     * @param array $array
     * @return mixed
     */
    private static function getParam(string $key, array $array): mixed
    {
        return $array[$key] ?? null;
    }
}
