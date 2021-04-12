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


/**
 * Class Theme
 * @package Core\Service\Template\Theme
 */
class Theme extends AbstractTheme
{

    /**
     * Конструктор переменных, замена определенного текста {var_name} на переменную
     * @param $name
     * @param $var
     */
    public function set($name, $var): void
    {
        if(is_array($var) && count($var)) {
            foreach ($var as $key => $key_var) {
                $this->set( $key, $key_var );
            }
        }

        $var = str_replace(array("{", "["),array("_&#123;_", "_&#91;_"), $var);

        $this->data[$name] = $var;
    }

    /**
     * Конструктор блоков.
     *
     * @param $name
     * @param $var
     */
    public function set_block($name, $var): void
    {
        if(is_array($var)) {
            if(count($var)) {
                foreach ($var as $key => $key_var) {
                    $this->set_block($key, $key_var);
                }
            }
            return;
        }

        $var = str_replace(array("{", "["),array("_&#123;_", "_&#91;_"), $var);
        $this->block_data[$name] = $var;
    }

    /**
     * Загрузка шаблона.
     *
     * @param $mjt_name
     * @return bool|string
     */
    public function load_template($mjt_name)
    {

        $mjt_name = str_replace(chr(0), '', (string)$mjt_name);

        $file_path = dirname($mjt_name);

        $url = parse_url( $mjt_name );
        $mjt_name = pathinfo($url['path']);
        $mjt_name = $mjt_name['basename'];
        $type = explode( ".", $mjt_name );
        $type = strtolower( end( $type ) );

        if ($type !== "mjt") {
            $this->template = "Не разрешено имя шаблона: "
                . str_replace(ROOT_DIR, '', $this->dir)
                . "/" . $mjt_name;

            $this->copy_template = $this->template;

            return "";
        }

        if ($file_path && $file_path !== ".") {
            $mjt_name = $file_path . "/" . $mjt_name;
        }

        if(stripos($mjt_name, ".php") !== false) {
            $this->template = "Недопустимое имя шаблона: "
                . str_replace(ROOT_DIR, '', $this->dir)
                . "/" . $mjt_name;
            $this->copy_template = $this->template;

            return "";
        }

        if($mjt_name === '' || !file_exists($this->dir . "/" . $mjt_name)) {
            $this->template = "Шаблон не найден: "
                . str_replace(ROOT_DIR, '', $this->dir)
                . "/" . $mjt_name;
            $this->copy_template = $this->template;

            return "";
        }

        $this->template = file_get_contents($this->dir . "/" . $mjt_name);

        if (str_contains($this->template, "{*")) {
            $this->template = preg_replace("'{\\*(.*?)\\*}'si", '', $this->template);
        }


        $this->copy_template = $this->template;

        return true;
    }

    /**
     * @param array $matches
     * @return false|mixed|string
     */
    public function load_file($matches = [])
    {
        $name = $matches[1];

        $name = str_replace([chr(0), '..', '/', '\\'], ["", '', '/', '/'], $name);

        $url = @parse_url ($name);
        $type = explode(".", $url['path']);
        $type = strtolower(end( $type ));

        if ($type === "mjt") {
            return $this->sub_load_template($name);
        }

        return $matches[0];
    }

    /**
     * @param $mjt_name
     * @return false|string
     */
    public function sub_load_template($mjt_name)
    {
        if ($mjt_name === '' || !file_exists($this->dir . DIRECTORY_SEPARATOR . $mjt_name)) {
            die ("Невозможно загрузить шаблон: " . $mjt_name);
        }


        return file_get_contents($this->dir . DIRECTORY_SEPARATOR . $mjt_name);
    }

    /**
     * @param string $container
     * @return mixed
     */
    public function result(string $container)
    {
        $find = [];
        $replace = [];
        $find_preg = [];
        $replace_preg = [];

        foreach ($this->data as $key_find => $key_replace) {
            $find[] = $key_find;
            $replace[] = $key_replace;
        }

        $this->copy_template = str_ireplace($find, $replace, $this->copy_template);


        if(str_contains($this->template, "{component")) {
            $this->copy_template = preg_replace_callback(
                "#{component (.+?)}#i",
                [&$this, 'load_file']
                , $this->copy_template);

        }

        $this->copy_template = str_replace(["_&#123;_", "_&#91;_"], ["{", "["], $this->copy_template);

        $result = str_replace($find, $replace, $this->copy_template);
        if (count($this->block_data)) {
            foreach ($this->block_data as $key_find => $key_replace) {
                $find_preg[] = $key_find;
                $replace_preg[] = $key_replace;
            }

            $result = preg_replace($find_preg, $replace_preg, $result);
        }

        if (isset($this->result[$container])) {
            $this->result[$container] .= $result;
        } else {
            $this->result[$container] = $result;
        }

        $this->block_clear();


        return isset($container) ? $this->return($container) : "Ошибка вывода";
    }

}