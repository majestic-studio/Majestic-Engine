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


namespace Core\Service\Routing;


/**
 * Class AbstractController
 * @package Core\Service\Routing
 */
abstract class AbstractController
{
    /**
     * @var string - макет для использования
     */
    public string $layout = '';

    /**
     * @var array - массив data
     */
    public array $data = [];

    /**
     * @var string
     */
    public string $theme = '';
}