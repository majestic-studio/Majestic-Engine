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


namespace Core\Service\Database;


use PDO;
use PDOException;
use Core\Service\Config\Config;
use Exception;
use RuntimeException;


/**
 * Class Database
 * @package Flexi\Database
 */
class Database
{

    /**
     * @var $connection
     */
    protected static mixed $connection;

    /**
     * @return PDO
     */
    public static function connection(): PDO
    {
        return static::$connection;
    }

    /**
     * Инициализация и подключенеи к базе данных
     *
     * @return void
     * @throws Exception
     */
    public static function initialize(): void
    {
        /**
         * Подключение к базе данных
         */
        static::$connection = static::connect();
    }

    /**
     * Отключение от базы данных
     *
     * @return void
     */
    public static function finalize(): void
    {
        /**
         * Закрытие соеденения
         */
        static::$connection = null;
    }

    /**
     * Подключение к базе данных
     *
     * @return null|PDO
     * @throws Exception
     */
    private static function connect(): ?PDO
    {
        /**
         * Стартовые данные для подключения
         */
        $driver     = Config::item('driver', 'database');
        $host       = Config::item('host', 'database');
        $username   = Config::item('username', 'database');
        $password   = Config::item('password', 'database');
        $name       = Config::item('db_name', 'database');
        $charset    = Config::item('charset', 'database');

        $dsn        = sprintf('%s:host=%s;dbname=%s;charset=%s', $driver, $host, $name, $charset);
        $options    = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];

        /**
         * Возвращаем null, если у нас не указано какое либо из полей подключения
         * к базе данных
         */
        if ($driver === '' || $username === '' || $name === '') {
            return null;
        }


        /**
         * Пытаемся подключится к базе данных
         * В случаи неудачи возвращаем Exception
         */
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $error) {
            throw new RuntimeException($error->getMessage());
        }

        /**
         * Возвращаем соеденение к базе данных, либо же null в случаи неудачи
         */
        return $connection ?? null;
    }

    /**
     * Получение индефикатора последней вставленной записи в базу данных
     *
     * @return int
     */
    public static function insertId(): int
    {
        return (int) static::$connection->lastInsertId();
    }
}
