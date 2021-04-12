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


namespace Core\Service\Localization;


use Core\Service\Config\Config;
use Core\Service\Path\Path;
use DI;


/**
 * Класс для работы с локализацией проекта
 *
 * Class I18n
 */
class I18n
{
    private static $instance;

    /**
     * @return I18n
     */
    public static function instance(): I18n
    {
        if (self::$instance == null) {
            self::$instance = new I18n();
        }
        return self::$instance;
    }

    /**
     * @param string $key
     * @param array $data
     * @return string
     */
    public function get(string $key, array $data = []): string
    {
        $lang = \DI::instance()->get('lang');
        $text = isset($lang[$key]) ? $lang[$key] : '';

        if (!empty($data)) {
            $text = sprintf($text, ...$data);
        }

        return $text;
    }

    /**
     * @param string $file
     * @param string $module
     * @return I18n
     */
    public function load(string $file, string $module = '')
    {
        $path    = static::path($module) . $file . '.ini';
        $content = parse_ini_file($path, true);

        $lang = \DI::instance()->get('lang') ?: [];

        foreach ($content as $key => $value) {
            $keyLang = str_replace('/', '.', $file) . '.' . $key;

            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $lang[$keyLang . '.' . $k] = $v;
                }
            } else {
                $lang[$keyLang] = $value;
            }
        }

        \DI::instance()->set('lang', $lang);

        return $this;
    }

    /**
     * Gets all the valid modules.
     *
     * @return array
     */
    public function all(): array
    {
        /** @var Module $module */
        $module = \DI::instance()->get('module');

        $localizations = [];
        $path = path('modules') . sprintf('/%s/Language/', $module->module);

        foreach (scandir($path) as $localization) {
            // Ignore hidden directories.
            if ($localization === '.' || $localization === '..') continue;

            // Does the language have a valid lang.php?
            $local = $path . $localization . '/lang.json';
            if (is_file($local)) {
                // Add it to the lang array.
                array_push($localizations, json_decode(
                    file_get_contents($local)
                ));
            }
        }

        return $localizations;
    }

    /**
     * @return string
     * @param string $moduleName
     */
    private static function path(string $moduleName = ''): string
    {
        $activeLanguage = 'rus';

        if ($activeLanguage == '') {
            $activeLanguage = Config::item('default_lang');
        }

        /** @var Module $module */
        $module = \DI::instance()->get('module');

        $moduleModuleName = $module->module;

        if ($moduleName !== '') {
            $moduleModuleName = $moduleName;
        }

        $p = new Path();
        $path = $p->Module() . sprintf('/%s/Language/%s/', $moduleModuleName, $activeLanguage);

        return $path;
    }
}