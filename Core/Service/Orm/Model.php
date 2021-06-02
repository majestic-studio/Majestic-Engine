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


use Core\Service\Database\Database;
use Exception;
use JetBrains\PhpStorm\Pure;


/**
 *
 *
 * Class Model
 * @package Core\Service\Orm
 */
class Model extends AbstractModel
{

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return static::$table;
    }

    /**
     * Получение всех аттрибутов модели.
     *
     * @return array
     */
    public function attributes(): array
    {
        return $this->attributes;
    }

    /**
     * Получение атрибута модели.
     *
     * @param  string  $attribute - имя получаемого аттрибута.
     * @return mixed
     */
    public function getAttribute(string $attribute): mixed
    {
        return $this->attributes[$attribute] ?? false;
    }

    /**
     * Установка аттрибута модели.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return void
     */
    public function setAttribute(string $attribute, mixed $value): void
    {
        $this->attributes[$attribute] = $value;
    }

    /**
     * Проверка на существование аттрибута.
     *
     * @param  string  $attribute - имя проверяемого аттрибута.
     * @return bool
     */
    public function hasAttribute(string $attribute): bool
    {
        return isset($this->attributes[$attribute]);
    }

    /**
     *  Сохранение записи.
     *
     * @return bool
     * @throws Exception
     */
    public function save(): bool
    {
        # Получить атрибуты модели.
        $attributes = $this->attributes();

        # Удалить охраняемые атрибуты.
        foreach ($this->guarded as $guarded) {
            if (isset($attributes[$guarded])) {
                unset($attributes[$guarded]);
            }
        }

        # Создание запроса.
        $query  = static::query();

        # Если у нас есть идентификатор, обновите запись.
        if ($this->hasAttribute('id')) {
            $query  = $query->where('id', '=', $this->getAttribute('id'));
            $saved  = $query->edit($attributes);
        } else {
            $saved  = $query->create($attributes);

            # Если успешно создан, добавить идентификатор вставки.
            if ($saved) {
                $this->setAttribute('id', Database::insertId());
            }
        }

        # Возвращаем true, если успешно сохранены.
        return $saved;
    }

    /**
     * Получает все записи из таблицы.
     *
     * @return array
     * @throws Exception
     */
    public static function all(): array
    {
        $query = static::query();
        return $query->all();
    }

    /**
     * Создает модельный запрос с предложением SELECT.
     *
     * @param array $fields
     * @return Query
     */
    public static function select(array $fields = []): Query
    {
        $query = static::query();
        return $query->select($fields);
    }

    /**
     * Создает модельный запрос с предложением WHERE.
     *
     * @param  string $column - название колонки.
     * @param  string $operator - оператор предложения.
     * @param  mixed  $value - значение для проверки по столбцу.
     * @return Query
     */
    public static function where(string $column, string $operator, mixed $value): Query
    {
        if ($operator === '') {
            $group = $operator;
        } else {
            $group = '=';
        }

        $query = static::query();
        return $query->where($column, $group, $value);
    }

    /**
     * Создает новый запрос для этой таблицы.
     *
     * @return Query
     */
    #[Pure] public static function query(): Query
    {
        return new Query(static::$table, static::class);
    }
}