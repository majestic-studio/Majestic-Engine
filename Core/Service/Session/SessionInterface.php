<?php

namespace Core\Service\Session;


interface SessionInterface
{

    /**
     * Инициализирует сессию.
     *
     * @return bool
     */
    public function initialize(): bool;

    /**
     * Завершает сессию.
     *
     * @return bool
     */
    public function finalize(): bool;

	/**
	 * Вставляет данные в сеанс.
	 *
	 * @param  string  $name - название сессии.
	 * @param  mixed   $data - данные для добавления в сеанс.
	 *
	 * @return mixed
	 */
    public function put(string $name, mixed $data): mixed;

    /**
     * Получает элемент из сеанса.
     *
     * @param  string  $name - название сессии.
     * @return mixed
     */
    public function get(string $name): mixed;

    /**
     * Проверяет, существует ли элемент в сеансе.
     *
     * @param  string  $name - название сессии.
     * @return bool
     */
    public function has(string $name): bool;

	/**
	 * Удаляет элемент из сессии.
	 *
	 * @param  string  $name - название сессии.
	 * @return mixed
	 */
    public function forget(string $name): mixed;

	/**
	 * Удаляет все элементы из сеанса.
	 *
	 * @return mixed
	 */
    public function flush(): mixed;

    /**
     * Возвращает все элементы в сеансе.
     *
     * @return array
     */
    public function all(): array;

    /**
	 * Устанавливает флэш-данные, которые живут только для одного запроса, если данные не были переданы
	 * он попытается найти сохраненные данные.
     *
     * @param  string  $name  The name of the flash data.
     * @param array|null $data  The data to store in the session.
     * @return mixed
     */
    public function flash(string $name, array $data = null): mixed;

	/**
	 * Сохраните флэш-данные для другого запроса.
	 *
	 * @param string $name
	 * @return mixed
	 */
    public function keep(string $name): mixed;

    /**
     * Возвращает данные, сохраненные для следующего запроса.
     *
     * @return array
     */
    public function kept(): array;

}
