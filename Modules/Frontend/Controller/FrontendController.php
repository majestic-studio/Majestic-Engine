<?php

namespace Modules\Frontend\Controller;

use Controller;
use Core\Service\Client\Client;
use Core\Service\Localization\I18n;
use Core\Service\Localization\Language;
use Core\Service\Routing\Router;
use DI;
use Modules\Frontend;
use Exception;

/**
 * Class FrontendController
 * @package Modules\Frontend\Controller
 */
class FrontendController extends Controller
{
    /**
     * FrontendController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        /**
         * Подключение языка Frontend по умолчанию.
         */
        Client::language();

        I18n::instance()->load('main/main');

        /**
         * Подключение запрошенного модуля
         */
        $module = new Router();
        $module = $module::module()->module;

        /**
         * Запись запроса в массив $data[]
         */
        $this->setData('module', $module);
    }
}
