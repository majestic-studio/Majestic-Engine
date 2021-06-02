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


namespace Core\Service\Config;


use RuntimeException;


/**
 * Class Config
 * @package Run\Config
 */
final class Config
{
    /**
     * Получение значения в конфигурации по ключу.
     * Принимает два значения:
     * $key - ключ для вывода его значения
     * $group - группа, либо же файл относительного пути в папке Config
     *
     * @param string $key
     * @param string $group
     * @return mixed
     * @throws RuntimeException
     */
    public static function item(string $key, string $group = 'main'): mixed
    {
        if (!Repository::retrieve($group, $key)) {
            self::file($group);
        }

        return Repository::retrieve($group, $key);
    }

    /**
     * Извлечение элементов конфигурации группы (файла)
     *
     * @param string $group
     * @return mixed
     * @throws RuntimeException
     */
    public static function group(string $group): mixed
    {
        if (!Repository::retrieveGroup($group)) {
            self::file($group);
        }

        return Repository::retrieveGroup($group);
    }

    /**
     * Получение файла для его анализа в item() и group()
     *
     * @param string $group
     * @return void
     * @throws RuntimeException
     */
    private static function file(string $group = 'main'): void
    {
        $path = ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $group . '.php';

        /**
         * Проверка, действительно ли существует файл
         */
        if (file_exists($path)) {
            /**
             * Получение элементов массива из файла
             */
            $items = include $path;

            /**
             * Конечный файл должен быть массивом
             */
            if (is_array($items)) {
                /**
                 * Проверяем $key и $value массива
                 */
                foreach ($items as $key => $value) {
                    Repository::store($group, $key, $value);
                }

                /**
                 * Возвращаем конечный результат
                 */
                return;
            }

            throw new RuntimeException(
                sprintf(
                    'Конфигурационный файл <strong>%s</strong> не является массивом.',
                    $path
                )
            );
        }

        throw new RuntimeException(
            sprintf(
                'Невозможно загрузить файл конфигурации <strong>%s</strong>, возможно его не существует.',
                $path
            )
        );
    }
}
