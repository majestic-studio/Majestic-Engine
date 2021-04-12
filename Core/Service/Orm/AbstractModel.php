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
 * Class AbstractModel
 * @package Core\Service\Orm
 */
abstract class AbstractModel
{
    /**
     * Название таблицы.
     *
     * @var  string
     */
    protected static string $table = '';

    /**
     * Аттрибуты модели.
     *
     * @var array
     */
    protected array $attributes = [];

    /**
     * Защищенные атрибуты, которые не будут переданы методом сохранения.
     *
     * @var array
     */
    protected array $guarded = ['id'];
}