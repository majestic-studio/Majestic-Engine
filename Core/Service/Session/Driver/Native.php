<?php

namespace Core\Service\Session\Driver;

use Core\Service\Session\SessionDriver;
use Core\Service\Session\SessionInterface;


class Native extends SessionDriver implements SessionInterface
{

    /**
     * @var array - флэш-данные, чтобы сохранить для следующего запроса.
     */
    protected array $keep = [];

	/**
	 * @return bool
	 */
    public function initialize(): bool
	{
        # Начало сеанса, если заголовки еще не были отправлены.
        if (!headers_sent())
            session_start();

        # Инициализируйте основной массив сессии, если он не был установлен.
        if (!isset($_SESSION[$this->key]))
            $_SESSION[$this->key] = [];

        # Выполнить сеанс с ключом данных флэш.
        if (!isset($_SESSION['flash']))
            $_SESSION['flash'] = [];

        # Успешно инициализирован.
        return true;
    }

	/**
	 * @return bool
	 */
    public function finalize(): bool
	{
        # Удалить флэш-данные, которые не сохраняются.
        foreach (array_keys($this->kept()) as $name) {
            if (!in_array($name, $this->keep, true))
                unset($_SESSION['flash'][$name]);

        }

        # Успешно завершено.
        return true;
    }

	/**
	 * @param string $name
	 * @param mixed  $data
	 *
	 * @return SessionDriver
	 */
    public function put(string $name, mixed $data): SessionDriver
	{
		# Вставить данные сеанса.
        $_SESSION[$this->key][$name] = $data;

        # Возвращаем экземпляр класса.
        return $this;
    }

	/**
	 * @param string $name
	 * @return mixed
	 */
    public function get(string $name): mixed
    {
        return $_SESSION[$this->key][$name] ?? false;
    }

	/**
	 * @param string $name
	 * @return bool
	 */
    public function has(string  $name): bool
	{
        return isset($_SESSION[$this->key][$name]);
    }

	/**
	 * @param string $name
	 * @return SessionDriver
	 */
    public function forget(string $name): SessionDriver
	{
        if ($this->has($name))
            unset($_SESSION[$this->key][$name]);

        return $this;
    }

	/**
	 * @return SessionDriver
	 */
    public function flush(): SessionDriver
	{
        $_SESSION[$this->key] = [];

        return $this;
    }

	/**
	 * @return array
	 */
    public function all(): array
	{
        return $_SESSION[$this->key] ?? [];
    }

	/**
	 * @param string $name
	 * @param array|null $data
	 * @return mixed
	 */
    public function flash(string $name, array $data = null): mixed
    {
        # Если данные нулевые, вернуть то, что сохранено
        if ($data === null)
            return $_SESSION['flash'][$name] ?? false;

        else
			# Сохраняем это для следующего запроса.
            $this->keep($name);

			# Хранить данные.
            return $_SESSION['flash'][$name] = $data;
    }

	/**
	 * @param string $name
	 * @return SessionDriver
	 */
    public function keep(string $name): SessionDriver
	{
        # Сохранить в массиве keep, если его там еще нет.
        if (!in_array($name, $this->keep, true))
            array_push($this->keep, $name);

        # Возвращаем объект сеанса.
        return $this;
    }

	/**
	 * @return array
	 */
    public function kept(): array
    {
        return $this->keep;
    }

}
