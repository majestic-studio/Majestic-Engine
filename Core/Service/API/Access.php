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


namespace Core\Service\API;


use Core\Service\Auth\Auth;
use Core\Service\Http\Header;


/**
 * Класс разделения доступа к API систем
 *
 * Class Access
 * @package Core\Service\API
 */
class Access
{
    /**
     * Разрешено ли просматривать API страницу?
     *
     * @var bool - валидация
     */
    private bool $validation = true;

    /**
     * @var array - массив ошибок
     */
    private array $error = [];

    /**
     * Типы assets API роутера
     * auth     -   Доступно лишь для авторизированных пользователей
     * key      -   Доступно лишь по ключу
     * server   -   Внутренние запросы, доступны лишь для обращения от текущего сервера к текущему серверу
     * @param string $permit
     * @return array
     */
    public function permit(string $permit = ''): array
    {
        switch ($permit) {
            case 'server':
                $this->server();
                break;
            case 'key':
                $this->key();
                break;
            case 'auth':
                $this->auth();
                break;
        }

        return [
            'validation'    => $this->validation,
            'error'         => $this->error
        ];
    }

    /**
     * API для авторизированных пользователей
     */
    private function auth(): void
    {
        $permit = 'auth';

        if(!Auth::authorized()) {
            $this->validation = false;
            Header::code403();

            $this->error = [
                'access-method'     => $permit,
                'error'             => 'Not API access',
                'message'           => 'Unauthorized client'
            ];
        } else {
            $this->validation = true;
            $this->error = [];
        }

    }

    /**
     * Серверное API для взаимодействия на сервере
     */
    private function server(): void
    {
        $permit = 'server';
        $client = $_SERVER['REMOTE_ADDR'];
        $server = $_SERVER['SERVER_ADDR'];

        if($client !== $server) {
            $this->validation = false;
            Header::code403();

            $this->error = [
                'access-method'     => $permit,
                'error'             => 'Not API access',
                'message'           => 'Not connect server to server'
            ];
        } else {
            $this->validation = true;
            $this->error = [];
        }
    }

    /**
     * API по ключу
     *
     * TODO:: Создать доступ по ключу.
     */
    private function key(): void
    {
        $permit = 'server';
        Header::code403();
        $this->validation = false;

        $this->error = [
            'access-method'     => $permit,
            'error'             => 'Not API access',
            'message'           => 'Ищу фрилансера, работа за идею.'
        ];
    }

}