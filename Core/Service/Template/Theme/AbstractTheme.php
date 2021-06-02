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


namespace Core\Service\Template\Theme;


use Core\Define;

/**
 * Class Theme
 * @package Core\Service\Template
 */
abstract class AbstractTheme
{
    /**
     * @var string
     */
    public string $dir = '.';

    /**
     * @var string|null
     */
    public ?string $template		=  null;

    /**
     * @var string|null
     */
    protected ?string $copy_template = null;

    /**
     * Данные шаблона, его переменные для вывода в
     * $tpl->set('name', $name);
     * Все данные помещаются в массив и после в шаблоне доступны через
     * название объекта в фигурных скобках.
     *
     * @var array   - массив переменных шаблона
     */
    public array $data = [];

    /**
     * Содержит в себе полный список блоков шаблона
     *
     * @var array   - блоки шаблонов
     */
    public array $block_data = [];

    /**
     * Содержит в себе полный массив данных шаблона
     *
     * @var array   - результат работы шаблона
     */
    public array $result;

    /**
     * Очистка блоков шаблона.
     * Удаляет все блоки и переменные шаблона
     */
    final public function block_clear(): void
    {
        $this->data = [];
        $this->block_data = [];
        $this->copy_template = $this->template;

    }

    /**
     * Глобальная очистка шаблона, используется лишь
     * для вывода результата шаблона и последующего удаления
     * его переменных, чтобы данные не попали в встраиваемый
     * шаблон и остались лишь в своем родители
     */
    final public function global_clear(): void
    {
        $this->data = [];
        $this->block_data = [];
        $this->result = [];
        $this->copy_template = null;
        $this->template = null;
    }

    function minification(string $buffer): string
    {

        $search = [
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/', // Remove HTML comments
        ];

        $replace = [
            '>',
            '<',
            '\\1',
            ''
        ];

        return preg_replace($search, $replace, $buffer);
    }

    /**
     * Возвращение результата сборки шаблона
     * Принимает в себя один параметр - название страницы, либо название .mjt файла
     *
     * @param string $container - название страницы, либо .mjt файл
     */
    final public function return(string $container): void
    {
        /**
         * Вывод результата через echo, можно так же использовать
         * eval (' ?' . '>' . $tpl->result[$container] . '<' . '?php ');
         * для вывода данных с использованием PHP в .mjt
         *
         * Не рекомендуется к использованию.
         */

        if(Define::production === true) {
            echo $this->minification($this->result[$container]);
        } else {
            echo $this->result[$container];
        }


        /**
         * Глобальная очистка переменных шаблона, чтобы переменные и данные шаблона
         * не попали в другие места и оставались в песочнице
         */
        $this->global_clear();
    }
}