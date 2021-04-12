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
 * Class Controller
 * @package Core\Service\Routing
 */
class Controller extends AbstractController
{
    /**
     * Массив $this->data для передачи данных из контроллера
     * в View файл
     *
     * @param string $key
     * @param $value
     */
    public function setData(string $key, $value): void
    {
        $this->data['generation'] = microtime();
        $this->data[$key] = $value;
    }
}
