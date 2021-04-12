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
 * Абстрактный класс для работы с заголовком браузера
 *
 *
 * Class AbstractHeader
 * @package Core\Service\Http
 */
abstract class AbstractHeader
{
    /**
     * Список MIME методов для генерации ответа Header.
     * Для добавления нового типа заголовка страницы
     * необходимо поместить его в массив
     * в формате 'ключ' => 'значение', к примеру
     * 'json' => 'application/json'
     *
     * @var array - тип HTTP запроса к роутеру
     */
    protected array $type = [
        'html'      =>  'text/html',        # 	text/html           - .html
        'json'      =>  'application/json', # 	text/css            - .css
        'css'       =>  'text/css'         # 	text/css            - .css
    ];

    /**
     * @var string - кодировка страниц
     */
    protected string $charset = 'charset=utf-8';


}