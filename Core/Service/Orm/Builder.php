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


/**
 * Class Builder
 * @package Core\Service\Orm
 */
class Builder
{

    /**
     * Создает предложение INSERT.
     *
     * @param  string  $table - таблица для вставки данных.
     * @param  array   $insert - поля и значения для вставки
     * @return string
     */
    public static function insert(string $table, array $insert): string
    {
        $set    = [];
        $values = [];

        foreach (array_keys($insert) as $column) {
            $set[] = $column;
            $values[] = ':' . $column;
        }

        return 'INSERT INTO ' . $table . ' (' . implode(', ', $set) . ') VALUES (' . implode(', ', $values) . ') ';
    }

    /**
     * Создает предложение UPDATE.
     *
     * @param  string  $table - таблица для вставки данных.
     * @param  array   $attributes - поля и значения для обновления.
     * @return string
     */
    public static function update(string $table, array $attributes): string
    {
        $set = [];

        foreach (array_keys($attributes) as $column) {
            $set[] = '`' . $column . '` = :' . $column;
        }

        return 'UPDATE ' . $table . ' SET ' . implode(', ', $set);
    }

    /**
     * Создает предложение DELETE.
     *
     * @param  string  $table - имя таблицы.
     * @return string
     */
    public static function delete(string $table): string
    {
        return 'DELETE FROM ' . $table;
    }

    /**
     * Создает предложение SELECT.
     *
     * @param  array  $fields - поля для выбора.
     * @return string
     */
    public static function select(array $fields = []): string
    {
        if (empty($fields)) {
            return 'SELECT * ';
        }

        return 'SELECT ' . implode(', ', $fields) . ' ';
    }

    /**
     * Создает предложение FROM.
     *
     * @param  string  $table - имя таблицы для получения данных.
     * @return string
     */
    public static function from(string $table): string
    {
        return ' FROM ' . $table;
    }

    /**
     * Создает предложение WHERE.
     *
     * @param  array  $where -Параметры предложения WHERE.
     * @return string
     */
    public static function where(array $where = []): string
    {
        # Ничего не вернуть, если $where пустой.
        if (empty($where)) {
            return '';
        }

        $clause = ' WHERE ';
        $first  = true;

        foreach ($where as $w) {
            $value = ':' . $w['column'];

            if ($first === false) {
                $clause .= ' AND ';
            }
            $clause .= $w['column'] . ' ' . $w['operator'] . ' ' . $value;

            $first = false;
        }

        return $clause;
    }

    /**
     * @param array $orderBy
     * @return string
     */
    public static function orderBy(array $orderBy): string
    {
        # Ничего не вернуть, если $orderBy пустой.
        if (empty($orderBy)) {
            return '';
        }

        $clause = ' ORDER BY ';

        foreach ($orderBy as $key => $order) {
            if (array_key_exists($key + 1, $orderBy)) {
                $clause .= $order['column'] . ' ' . $order['direction'] . ', ';
            } else {
                $clause .= $order['column'] . ' ' . $order['direction'];
            }
        }

        return $clause;
    }

    /**
     * Создает предложение DESCRIBE.
     *
     * @param  string  $table  The table name.
     * @return string
     */
    public static function describe(string $table): string
    {
        return 'DESCRIBE ' . $table;
    }
}
