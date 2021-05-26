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


namespace Core\Service\Template;


use Core\Service\Routing\Router;


/**
 * Class Engine
 * @package Core\Service\Template
 */
class Engine
{
    /**
     * @return string
     */
    public function ViewDirectory(): string
    {
        $module = Router::module();
        return sprintf('/Modules/%s/View/', $module->module);
    }
}
