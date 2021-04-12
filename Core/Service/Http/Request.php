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


/**
 * Class Request
 * @package Core\Service\Http
 */
class Request
{
    public static array $method = [
        'GET',  'POST',
        'HEAD', 'PUT',
        'PATH', 'DELETE',
    ];
    /**
     * Проверка, является ли запрос определенным методом.
     *
     * @param  string  $method - Метод запроса для проверки.
     * @return bool
     */
    public static function is(string $method = ''): bool
	{
        switch (strtolower($method)) {
            case 'https':
                return self::https();
            case 'ajax':
                return self::ajax();
            case 'cli':
                return self::cli();
            default:
                return $method === self::method();
        }
    }

    /**
     * Получение текущего запроса.
     *
     * @return string
     */
    public static function method(): string
	{
        return strtolower($_SERVER['REQUEST_METHOD'] ?? 'get');
    }

    /**
     * Проверьте, если запрос через соединение https.
     *
     * @return bool
     */
    public static function https(): bool
	{
        return ($_SERVER['HTTPS'] ?? '') === 'on';
    }

    /**
     * Проверка, является ли запрос AJAX-запросом.
     *
     * @return bool
     */public static function ajax(): bool
    {
        return ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';
    }

    /**
     * Проверка, является ли запрос запросом CLI.
     *
     * @return bool
     */
    public static function cli(): bool
	{
        return (PHP_SAPI === 'cli' || defined('STDIN'));
    }
}
