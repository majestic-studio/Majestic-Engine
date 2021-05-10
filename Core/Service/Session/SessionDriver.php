<?php

namespace Core\Service\Session;


class SessionDriver {

    /**
     * @var string - имя сеансового ключа.
     */
    protected string $key = 'Majestic';

    /**
     * Возвращает ключ массива, используемый для хранения данных сеанса.
     *
     * @return string
     */
    public function key(): string
	{
        return $this->key;
    }

}
