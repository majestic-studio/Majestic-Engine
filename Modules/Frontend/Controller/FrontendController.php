<?php

namespace Modules\Frontend\Controller;

use Controller;
use Core\Service\Localization\I18n;
use Core\Service\Routing\Router;
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
        I18n::instance()
        ->load('main/main');

        echo_lang('main.main.heading');
        $module = new Router();
        $module = $module::module()->module;

        $this->setData('module', $module);
    }
}
