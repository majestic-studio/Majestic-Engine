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
        switch (strtolower($section))
        {
            case 'config':
                return $uri . '/Config';
            case 'modules':
                return $uri . '/Modules';
            case 'content':
                return $uri . '/Content';
            case 'library':
                return $uri . '/Library';
            default:
                return $uri . '/';
        }
    }

    /**
     * Возвращение значения приватной функции this->path()
     * Вывод корректного и публичного значения.
     *
     * @param string $section
     * @param bool $absolute
     * @return string
     */
    final public function getPath(string $section = '', bool $absolute = true): string
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
    final public function Content(string $section, bool $absolute = true): string
    {
        /**
         * Путь к секции Content для вывода под папок
         * @var $absolute - название под секции раздела Content
         */
        $path = $this->getPath('content', $absolute);

        /**
         * Кейсы раздела Content, в случаи пустого кейса выводим корень Content
         */
        switch (strtolower($section))
        {
            case 'themes':
                return $path . '/Themes';
            case 'frontend':
                return $path . '/Themes/Frontend';
            case 'backend':
                return $path . '/Themes/Backend';
            case 'plugins':
                return $path . '/Plugins';
            case 'vue':
                return $path . '/Resources';
            default:
                return $path;
        }
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
    final public function Module(string $section = '', bool $absolute = true): string
    {
        /**
         * Путь к секции Modules для вывода под папок
         * @var $absolute - название под секции раздела Modules
         */
        $path = $this->getPath('modules', $absolute);

        /**
         * Кейсы раздела Modules, в случаи пустого кейса выводим корень Modules
         */
        switch (strtolower($section))
        {
            case 'frontend':
                return $path . '/Frontend';
            case 'backend':
                return $path . '/Backend';
            default:
                return $path;
        }
    }

    final public function Library(string $section = '', bool $absolute = true): string
    {
        /**
         * Путь к секции Library для вывода под папок
         * @var $absolute - название под секции раздела Modules
         */
        $path = $this->getPath('library', $absolute);

        /**
         * Кейсы раздела Modules, в случаи пустого кейса выводим корень Modules
         */
        switch (strtolower($section))
        {
            case 'vendor':
                return $path . '/Vendor';
            case 'theme':
                return $path . '/Themes';
            default:
                return $path;
        }
    }
}