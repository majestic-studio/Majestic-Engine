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


namespace Core\Service\DI;


/**
 * Класс зависимостей
 *
 * Class Container
 * @package Run\DI
 */
class Container
{
    /**
     * @var mixed
     */
    protected static $instance;

    /**
     * Dependency container.
     *
     * @var array
     */
    private array $container = [];
    
    /**
     * Получение зависимости контейнера
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->has($key) ? $this->container[$key] : null;
    }

    /**
     * Добавление элементов в контейнер зависимостей
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set(string $key, mixed $value): Container
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * Просмотр, есть ли в контейнере зависимости
     *
     * @param $key
     * @return bool
     */
    public function has($key): bool
    {
        return isset($this->container[$key]);
    }

    /**
     * @return Container
     */
    public static function instance(): Container
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
