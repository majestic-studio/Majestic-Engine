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


namespace Core\Service\Template;


use Core;
use Core\Service\Routing\Router;
use Exception;
use RuntimeException;


/**
 * Class View
 * @package Core\Service\Template
 */
class View
{
    /**
     * @var string The view file.
     */
    protected string $file = '';

    /**
     * @var array The view data.
     */
    protected array $data = [];

    /**
     * @var string
     */
    protected string $pathTemplates = '';
	public const TEMPLATE_EXTENSION = '.php';
	protected static Engine $engine;

	/**
	 * View constructor.
	 */
	public function __construct()
	{
		static::$engine = new Engine();
	}


    /**
     * @return Engine
     */
	public static function engine(): Engine
	{
        return static::$engine ?? new Engine();
    }


    /**
     * Возвращает данные просмотра.
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

	public static function theme(): string
	{
		return static::engine()->detectViewDirectory();
	}

	/**
	 * @return string
	 */
	public static function pathTemplates(): string
    {
        return Router::module()->viewPath;
    }

	/**
	 * @return string
     * @throws Exception
	 */
	public function respond()
    {
		# Получить экземпляр действия модуля.
		$instance = Router::module()->instance();

		# Если у нас нет макета, то напрямую выводим представление.
		if (is_object($instance) && isset($instance->layout) && $instance->layout === '') {
            echo $this->render();
        } else {
		    Layout::view($this);
        }
        return '';
	}


    /**
     * @return string
     */
    public static function path(): string
    {
        return ROOT_DIR . static::engine()->detectViewDirectory();
    }

    /**
     * @return string
     */
    public static function pathVue(): string
    {
        return ROOT_DIR . static::engine()->detectVueDirectory();
    }


	/**
	 * @return string
	 * @throws Exception
	 */
	public function render(): string
	{
		# Получение путь для просмотров.
		$path = static::path() . $this->file . self::TEMPLATE_EXTENSION;

		# Возвращение View.
		return self::load($path, $this->data);
	}

	public static function make(string $file, array $data = []): View
	{
		# Экземпляр класса.
		$name           = static::class;
		$class          = new $name;
		$class->file    = $file;
		$class->data    = $data;

		# Возвращеие нового объекта.
		return $class;
	}

    public static function load(string $path, array $data = []): string
    {
        # Проверка, что данные доступны в виде переменных.
        extract($data, null);
        # Проверка, существует ли файл.
        if (is_file($path)) {

            # Загрузите компонент в переменную.
            ob_start();
            # Подключение файла
            include $path;

            # Вернуть загруженный компонент.
            return ob_get_clean();
        }

        throw new RuntimeException(
            sprintf('View файл <strong>%s</strong> не найден!', $path)
        );
    }
}
