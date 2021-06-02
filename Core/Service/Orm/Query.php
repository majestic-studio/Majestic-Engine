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


namespace Core\Service\Orm;


use Core\Service\Database\Statement;
use Exception;
use RuntimeException;


/**
 * Class Query
 * @package Core\Service\Orm
 */
class Query
{
    /**
     * Название таблицы по умолчанию
     * @var  string
     */
    protected string $table = '';

    /**
     * Создание SQL запроса
     *
     * @var  string
     */
    protected string $sql = '';

    /**
     * Ссылка на модель
     *
     * @var  string
     */
    protected string $model = '';

    /**
     * Запрос INSERT приложения.
     *
     * @var  array
     */
    protected array $insert = [];

    /**
     * Запрос UPDATE приложения.
     *
     * @var  array
     */
    protected array $update = [];

    /**
     * Запрос на SELECT приложения.
     *
     * @var  array
     */
    protected array $select = [];

    /**
     * Запрос на WHERE.
     *
     * @var  array
     */
    protected array $where = [];

    /**
     * Запрос на ORDER BY.
     *
     * @var  array
     */
    protected array $orderBy = [];

    /**
     * Запуск орденатора
     *
     * @var object
     */
    protected object $stmt;

    /**
     * Возврат QUERY результата.
     *
     * @var  mixed
     */
    protected mixed $result;

    /**
     * Запрос на LIMIT.
     *
     * @var array
     */
    protected array $limit;

    /**
     * Допустимые методы запроса.
     *
     * @var array
     */
    private array $methods = [
        'create',
        'read',
        'update',
        'delete',
        'describe'
    ];

    /**
     * Конструктор
     *
     * @param  string  $table - таблица для запроса.
     * @param  string  $model - модель для использования.
     */
    public function __construct(string $table = '', string $model = '')
    {
        $this->table = $table;
        $this->model = $model;
    }

    /**
     * Устанавливает предложение INSERT.
     *
     * @param  array  $data - данные для вставки.
     * @return Query
     */
    public function insert(array $data): Query
    {
        $this->insert = array_merge($this->insert, $data);

        return $this;
    }

    /**
     * Возвращает количество элементов базы данных определенного
     * раздела
     *
     * @param array $array
     * @return int
     */
    public static function countQuery(array $array): int
    {
        return count($array);
    }

    /**
     * Устанавливает предложение UPDATE.
     *
     * @param  array  $data - данные для обновления.
     * @return Query
     */
    public function update(array $data): Query
    {
        $this->update = array_merge($this->update, $data);

        return $this;
    }

    /**
     * Удаление записи
     *
     * @return Query
     */
    public function delete(): Query
    {
        return $this;
    }

    /**
     * Устанавливает предложение SELECT.
     *
     * @param  array  $fields - поля для выбора
     * @return Query
     */
    public function select(array $fields = []): Query
    {
        $this->select = array_merge($this->select, $fields);

        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @return $this
     */
    public function where(string $column, string $operator, mixed $value): Query
    {
        if (!$operator) {
            $operator = '=';
        }
        $this->where[] = compact('column', 'operator', 'value');

        return $this;
    }

    /**
     * Устанавливает предложение ORDER BY.
     *
     * @param  string  $column - столбец для заказа.
     * @param  string  $direction - направление заказа.
     * @return Query
     */
    public function orderBy(string $column, string $direction = 'asc'): Query
    {
        $this->orderBy[] = compact('column', 'direction');

        return $this;
    }

    /**
     * Вывод определенных данных начиная с Limit и заканчивая Value
     * Используется при выводе с лимитом вместо all(), либо first()
     *
     * @param int $limit - начало вывода данных
     * @param int $value - конец вывода данных
     * @return array
     */
    public function all_limit (int $limit, int $value): array
    {
        $array = [];

        for( $i = $limit; $i < $value; $i++ ) {
            try {
                if (isset($this->all()[$i])) {
                    $array[$i + 1] = $this->all()[$i];
                }
            } catch (Exception $e) {
                exit($e);
            }
        }

        return $array;
    }

    /**
     * Вывод определенного количества записей.
     *
     * @param string $limit
     * @param string $value
     * @return $this
     */
    public function limit(string $limit, string $value): self
    {
        $this->limit[] = compact('limit', 'value');

        return $this;
    }

    /**
     * Запускает запрос
     *
     * @param  string  $method - QUERY метод.
     * @throws Exception
     * @return Query
     */
    public function run(string $method = 'read'): Query
    {
        # Нормализовать метод.
        $method = strtolower($method);

        # Убедитесь, что это правильный метод запроса.
        if (!in_array($method, $this->methods, true)) {
            throw new RuntimeException(
                sprintf('Invalid query method: %s', $method)
            );
        }

        # Убедитесь, что SQL очищен.
        $this->sql = '';

        # Методы построителя, которые мы запускаем, зависят от метода запроса.
        switch ($method) {
            case 'read':
                $this->sql .= Builder::select($this->select);
                $this->sql .= Builder::from($this->table);
                $this->sql .= Builder::where($this->where);
                $this->sql .= Builder::orderBy($this->orderBy);
                break;
            case 'create':
                $this->sql .= Builder::insert($this->table, $this->insert);
                break;
            case 'update':
                $this->sql .= Builder::update($this->table, $this->update);
                $this->sql .= Builder::where($this->where);
                break;
            case 'delete':
                $this->sql .= Builder::delete($this->table);
                $this->sql .= Builder::where($this->where);
                break;
            case 'describe':
                $this->sql .= Builder::describe($this->table);
                break;
        }

        # Создание заявления.
        $this->stmt = new Statement($this->sql);

        # Привязать WHERE к значению.
        foreach ($this->where as $where) {
            $this->stmt->bind(':' . $where['column'], $where['value']);
        }

        # Нужно ли нам связывать значения INSERT?
        if ($method === 'create' || $method === 'update') {
            $property = $method === 'create' ? 'insert' : 'update';
            foreach ($this->$property as $key => $value) {
                $this->stmt->bind(':' . $key, $value);
            }
        }

        # Выполнить заявление.
        $this->result = $this->stmt->execute();

        # Возвращение объекта.
        return $this;
    }

    /**
     * @param string $sql
     * @return array
     */
    public static function result(string $sql): array
    {
        /**
         * Создание экземпляра оператора
         */
        $stmt = new Statement($sql);
        $stmt->execute();

        return $stmt->all();
    }

    /**
     * Создание записи
     *
     * @param  array $attributes - аттрибут для вставки записи.
     * @return bool
     * @throws Exception
     */
    public function create(array $attributes = []): bool
    {
        if (!empty($attributes)) {
            $this->insert($attributes);
        }

        return (bool)$this->run('create');
    }

    /**
     * Обновление записи.
     *
     * @param  array $attributes - аттрибут для вставки записи.
     * @return bool
     * @throws Exception
     */
    public function edit(array $attributes = []): bool
    {
        if (!empty($attributes)) {
            $this->update($attributes);
        }

        return (bool)$this->run('update');
    }

    /**
     * Получение всех рузультатов.
     *
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        /**
         * Метод выполнения запроса
         */
        $this->run();

        /**
         * Получение результата
         */
        $fetched = $this->stmt->all();

        /**
         * Проверка, нужно ли присваивать результаты по модели.
         */
        if ($this->model !== null) {
            $records = [];
            foreach ($fetched as $record) {
                $model = new $this->model;

                foreach ($record as $attribute => $value) {
                    $model->$attribute = $value;
                }

                $records[] = $model;
            }
        } else {
            $records = $fetched;
        }

        /**
         * Получение результата.
         */
        return $records;
    }

    /**
     * Получение всех элементов в json
     *
     * @return mixed
     * @throws Exception
     */
    public function allJson(): mixed
    {
        /**
         * Метод выполнения запроса
         */
        $this->run();

        /**
         * Получение результата
         */
        return $this->stmt->all();
    }

    /**
     * Вывод последней записи в таблице
     *
     * @return bool|object
     * @throws Exception
     */
    public function first(): object|bool
    {
        /**
         * Тип запроса
         */
        $this->run();

        /**
         * Результат запроса
         */
        $fetched = $this->stmt->fetch();

        /**
         * Не продолжать, если значение выполнения равно нулю
         */
        if ($fetched === false) {
            return false;
        }

        /**
         * Возвращение результата
         */
        return $fetched;
    }

    /**
     * Получает информацию о столбце в таблице.
     *
     * @return array
     * @throws Exception
     */
    public function describe(): array
    {
        if ($this->run('describe')) {
            return $this->stmt->all();
        }

        return [];
    }

    /**
     * Выбор таблицы для запроса, по умолчанию таблица указывается в protected методе в начале класса модели.
     *
     * @param  string  $table - таблица для запросов.
     * @param  string  $model - модель для использования.
     * @return Query
     */
    public static function table(string $table, string $model = ''): Query
    {
        $class = static::class;

        if ($model === '') {
            $model = $class;
        }

        return new $class($table, $model);
    }
}