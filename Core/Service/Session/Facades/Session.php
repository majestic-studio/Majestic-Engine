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


namespace Core\Service\Session\Facades;


use Core\Service\Session\Session as Factory;
use Core\Service\Session\SessionDriver;


/**
 * Class Session
 * @package Core\Service\Session\Facades
 */
class Session
{
    /**
	 * Экземпляр класса сеанса.
	 *
     * @var SessionDriver
     */
    protected static SessionDriver $session;

	/**
	 * Инициализация сессии
	 *
	 * @return Factory
	 */
    public static function initialize(): Factory
	{
        return static::make();
    }

    /**
     * Завершение сессии.
     *
     * @return bool
     */
    public static function finalize(): bool
	{
        return static::make()->driver()->finalize();
    }

	/**
	 * Вставка данных в сеанс.
	 *
	 * @param  string $name - название сессии.
	 * @param  mixed  $data - информация добавляемая в сессию.
	 *
	 * @return SessionDriver
	 */
    public static function put(string $name, $data): SessionDriver
	{
        return static::make()->driver()->put($name, $data);
    }

    /**
     * Получение данных из сессии.
     *
     * @param  string  $name - название сессии.
     * @return mixed
     */
    public static function get(string $name)
	{
        return static::make()->driver()->get($name);
    }

    /**
     * Проверка, существует ли эллемент в сеансе.
     *
     * @param  string  $name - название сессии.
     * @return bool
     */
    public static function has(string $name): bool
	{
        return static::make()->driver()->has($name);
    }

	/**
	 * Удаление элемента из сессии.
	 *
	 * @param  string $name - название сессии.
	 * @return SessionDriver
	 */
    public static function forget(string $name): SessionDriver
	{
        return static::make()->driver()->forget($name);
    }

	/**
	 * Удаление всех элементов сессии.
	 *
	 * @return SessionDriver
	 */
    public function flush(): SessionDriver
	{
        return static::make()->driver()->flush();
    }

    /**
     * Возвращение всех элементов сессии в виде массива.
     *
     * @return array
     */
    public function all(): array
	{
        return static::make()->driver()->all();
    }

    /**
     * Устанавливает флэш-данные, которые живут только для одного запроса, если данные не были переданы
	 * он попытается найти сохраненные данные.
     *
     * @param  string  $name - название флэш данных.
     * @param  mixed   $data - значение элемента сессии.
     * @return mixed
     */
    public function flash(string $name, $data = null)
	{
        return static::make()->driver()->flash($name, $data);
    }

	/**
	 * Сохранение флэш-данных для другого запроса.
	 *
	 * @param  string $name - имя данных для хранения.
	 *
	 * @return SessionDriver
	 */
    public function keep(string $name): SessionDriver
	{
        return static::make()->driver()->keep($name);
    }

    /**
     * Возвращает данные, сохраненные для следующего запроса.
     *
     * @return array
     */
    public function kept(): array
	{
        return static::make()->driver()->kept();
    }

	/**
	 * Создает новый экземпляр класса сеанса.
	 * @return Factory|SessionDriver
	 */
    public static function make()
	{
        return static::$session ?? new Factory;
    }

}
