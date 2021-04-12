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


namespace Core\Service\Session;


/**
 * Class SessionDriver
 * @package Core\Service\Session
 */
class SessionDriver {

    /**
     * @var string - имя сеансового ключа.
     */
    protected string $key = 'Majestic';

    /**
     * Возвращает ключ массива, используемый для хранения данных сеанса.
     *
     * @return string
     */
    public function key(): string
	{
        return $this->key;
    }

}
