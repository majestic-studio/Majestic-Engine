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


namespace Core\Service\Routing;

use Core\Service\Http\Header;
use Core\Service\Path\Path;
use Exception;
use Core\Service\Config\Config;
use RuntimeException;


/**
 * Class Module
 * @package Core\Service\Routing
 */
class Module
{
    /**
     * @var Controller - контроллер.
     */
    protected Controller $instance;

    /**
     * @var APIController - контроллер.
     */
    public APIController $APIinstance;

    /**
     * @var mixed - ответ действий.
     */
    protected $response;

    /**
     * @var string - активный модуль.
     */
    public string $module = '';

    /**
     * @var string - активный контроллер.
     */
    public string $controller = '';

    /**
     * @var string - активное действие.
     */
    public string $action = '';

    /**
     * @var array - активные параментры.
     */
    public array $parameters = [];

    /**
     * @var string - тема.
     */
    public string $theme = '';


    /**
     * @var string
     */
    public string $viewPath = '';

    /**
     * @var string|null - права доступа к разделу
     */
    public ?string $assets = null;

    /**
     * Конструктор
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $header = new Header();

        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
        /**
         * Если модуль - API, то удаляем ненужных переменных и выводим специальный заголовок JSON
         */
        if($config['module'] === 'API') {
            Header::allowAPI();
            $header->header('html');
        }

    }

    /**
     * Возвращает экземпляр контроллера.
     *
     * @return Controller
     */
    public function instance(): Controller
    {
        return $this->instance;
    }


    /**
     * @return string
     * @throws Exception
     */
    public function url(): string
    {
        return Config::item('base_url') . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR;
    }

    /**
     * Запускает активное действие контроллера.
     *
     * @throws Exception
     */
    public function run()
    {
        /**
         * Построение имени класса
         */
        $class = '\\Modules\\' . $this->module . '\Controller\\' . $this->controller;

        /**
         * Проверка на существование класса.
         */
        $path = new Path();
        $manifest = $path->Module() . '/' . $this->module . '/manifest.json';

        $moduleType = json_decode(file_get_contents($manifest), true, 512, JSON_THROW_ON_ERROR);


        if (class_exists($class)) {
            if($moduleType['type'] === 'API') {
                $this->APIinstance = new $class;
                $this->response = call_user_func_array([$this->APIinstance, $this->action], $this->parameters);
            } elseif($moduleType['type'] === 'module') {
                $this->instance = new $class;
                $this->response = call_user_func_array([$this->instance, $this->action], $this->parameters);
                  }

            /**
             * Возвращение ответа.
            */
             return $this->response;
        }

        throw new RuntimeException(
            sprintf('Контроллер <strong>%s</strong> не найден.', $class)
        );
    }
}
