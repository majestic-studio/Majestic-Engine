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


namespace Core\Service\Encryption;


use Exception;
use RuntimeException;


/**
 * Хеширование данных пользователя
 *
 * Class Hash
 * @package Core\Service\Encryption
 */
class Hash
{

    /**
     * Проверка валидации хеширования
     *
     * @param string $algo
     * @return bool
     */
    public static function validAlgo(string $algo): bool
    {
        return in_array($algo, hash_algos(), true);
    }

    /**
     * Генерация хеша пользователя
     *
     * TODO:: Добавить прочие хеши
     *
     * @param string $data
     * @param string $algo
     * @return string
     * @throws Exception
     */
    public static function make(string $data, string $algo = 'md5'): string
    {
        /**
         * Проверка валидности алгоритма для использования
         */
        if (!self::validAlgo($algo)) {
            throw new RuntimeException(
                sprintf('Invalid hashing algorithm: %s.', $algo)
            );
        }

        return hash($algo, $data);
    }

}
