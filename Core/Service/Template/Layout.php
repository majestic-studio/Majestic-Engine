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
use Exception;


/**
 * Class Layout
 * @package Core\Service\Template
 */
class Layout
{
	/**
	 * @var array - Макет просмотра данных.
	 */
    protected static array $data = [];

    /**
     * Вид макета страницы
     *
     * @var View
     */
    protected static View $view;

	/**
	 * Получает данные макета.
	 *
	 * @return array
	 */
	public static function data(): array
	{
		return static::$data;
	}

	/**
	 * Устанавливает данные макета.
	 *
	 * @param string $key
	 * @param $value
	 */
	public static function set(string $key, $value): void
    {
		static::$data[$key] = $value;
	}

	/**
	 * @param string $name
	 * @param array $data
	 * @return string
	 * @throws Exception
	 */

	public static function get(string $name, array $data = []): string
	{
        # Объединяем данные.
		static::$data = array_merge_recursive(static::data(), $data);

		$path = View::path() . $name . View::TEMPLATE_EXTENSION;

		# Загрузка
		return View::load($path, static::data());
	}

	/**
	 * Добавьте основной вид в макет.
	 *
	 * @param  View $view
	 *
	 * @return void
	 */
	public static function view(View $view): void
    {
		foreach ($view->data() as $key => $value) {
			static::set($key, $value);
		}

		static::$view = $view;
	}

	/**
	 * Загружает основной вид контента.
	 *
	 * @return string
	 * @throws Exception
	 */
	public static function content(): string
	{
		if (is_object(static::$view)) {
			return static::$view->render();
		}

        return '';
    }
}
