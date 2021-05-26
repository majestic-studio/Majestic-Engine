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


/**
 * Конструктор запросов к базе данных SQL
 *
 * Class Statement
 * @package Run\Database
 */
class Statement
{

    /**
     * @var string SQL query.
     */
    protected string $sql = '';

    /**
     * @var object PDO statement.
     */
    protected object $stmt;

    /**
     * __construct запросов к базе данных SQL
     *
     * @param string $sql
     */
    public function __construct(string $sql = '')
    {
        /**
         * Продолжаем работу лишь в случаи не пустого SQL запроса
         */
        if ($sql !== '') {
            $this->prepare($sql);
        }
    }

    /**
     * Первичная подготова SQL запроса
     *
     * @param  string $sql
     * @return Statement
     */
    public function prepare(string $sql): Statement
    {
        /**
         * Подготова запроса
         */
        $this->stmt = Database::connection()->prepare($this->sql = $sql);

        /**
         * Возвращаение результата
         */
        return $this;
    }

    /**
     * Привзяка параметров к значению.
     *
     * @param  mixed  $parameter
     * @param  mixed  $value
     * @param  int    $type
     * @return Statement
     */
    public function bind(mixed $parameter, mixed $value, int $type = 0): Statement
    {
        /**
         * Определение типа запроса, если он не был установлен
         */
        if ($type === 0) {
            $type = match (strtolower(gettype($value))) {
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                'null' => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }

        /**
         * Установка значения запроса
         */
        $this->stmt->bindValue($parameter, $value, $type);

        /**
         * Возвращение результата
         */
        return $this;
    }

    /**
     * Вывод ошибок MySQL сервера
     *
     * @return bool
     */
    public function execute(): bool
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $error) {
            echo '<h1>MySQL Error</h1>';
            echo '<p>' . $error->errorInfo[2] . '</p>';
            echo '<h3>Last Query</h3>';
            echo '<p>' . $this->sql . '</p>';
            exit;
        }
    }

    /**
     * Получение результата
     *
     * @return object|bool
     */
    public function fetch(): object|bool
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Получение всех результатов
     *
     * @return array
     */
    public function all(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Получение числа результатов
     *
     * @return int
     */
    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Возвращение информации об ошибке запроса в виде массива
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->stmt->errorInfo();
    }
}
