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


namespace Core\Service\Path;


use JetBrains\PhpStorm\Pure;

/**
 * Класс для работы с путями, умеет выводить как абсолютные
 * пути к различным папкам и пакетам, так и URL пути.
 *
 * Class Path
 * @package Core\Service\Path
 */
class Path
{
    /**
     * Получение пути к определенному сегменту (папке) в корне проекта.
     * Функция создана лишь для использования и поддержки других функций класса
     * Принимает в себя два значения:
     *
     * @param string $section   -   название зарегистрированного сегмента
     * @param bool $absolute    -   абсолютный путь к папке относительно сервера.
     *                              Принимает два значения (true|false),
     *                              true - выводит абсолютный путь, false выводит
     *                              URL путь
     * @return string
     */
    private function path(string $section = '', bool $absolute = false): string
    {
        /**
         * Тип пути, абсолютный, либо URL путь от домена сайта.
         */
        $uri = $_SERVER['DOCUMENT_ROOT'];


        /**
         * Если параметр $absolute не задан, либо указан как false, то выводим URL путь
         * @var $absolute
         */
        if(!$absolute) {
            $uri = '//' . $_SERVER['HTTP_HOST'];
        }

        /**
         * Кейсы директорий проекта, выводятся в зависимости от заданной секции
         * В случаи пустой секции - выводим путь к корню.
         * @var $section
         */
        return match (strtolower($section)) {
            'config' => $uri . '/Config',
            'modules' => $uri . '/Modules',
            'content' => $uri . '/Content',
            default => $uri . '/',
        };
    }

    /**
     * Возвращение значения приватной функции this->path()
     * Вывод корректного и публичного значения.
     *
     * @param string $section
     * @param bool $absolute
     * @return string
     */
    #[Pure] final public function getPath(string $section = '', bool $absolute = true): string
    {
       return $this->path($section, $absolute);
    }


    /**
     * Вывод под разделов раздела Content (Themes и Plugins)
     *
     * @param string $section   -   Принимает название под раздела в разделе Content
     * @param bool $absolute    -   абсолютный путь к папке относительно сервера.
     *                              Принимает два значения (true|false),
     *                              true - выводит абсолютный путь, false выводит
     *                              URL путь
     * @return string
     */
    #[Pure] final public function Content(string $section, bool $absolute = true): string
    {
        /**
         * Путь к секции Content для вывода под папок
         * @var $absolute - название под секции раздела Content
         */
        $path = $this->getPath('content', $absolute);

        /**
         * Кейсы раздела Content, в случаи пустого кейса выводим корень Content
         */
        return match (strtolower($section)) {
            'themes' => $path . '/Themes',
            'frontend' => $path . '/Themes/Frontend',
            'backend' => $path . '/Themes/Backend',
            'plugins' => $path . '/Plugins',
            default => $path,
        };
    }


    /**
     * Вывод под разделов раздела Content (Themes и Plugins)
     *
     * @param string $section   -   Принимает название под раздела в разделе Content
     * @param bool $absolute    -   абсолютный путь к папке относительно сервера.
     *                              Принимает два значения (true|false),
     *                              true - выводит абсолютный путь, false выводит
     *                              URL путь
     * @return string
     */
    #[Pure] final public function Module(string $section = '', bool $absolute = true): string
    {
        /**
         * Путь к секции Modules для вывода под папок
         * @var $absolute - название под секции раздела Modules
         */
        $path = $this->getPath('modules', $absolute);

        /**
         * Кейсы раздела Modules, в случаи пустого кейса выводим корень Modules
         */
        return match (strtolower($section)) {
            'frontend' => $path . '/Frontend',
            'backend' => $path . '/Backend',
            default => $path,
        };
    }
}