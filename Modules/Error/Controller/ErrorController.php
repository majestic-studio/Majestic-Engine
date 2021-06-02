<?php

namespace Modules\Error\Controller;


use Controller;
use Core\Service\Http\Header;
use View;


/**
 * Class ErrorController
 * @package Modules\Frontend\Controller
 */

class ErrorController extends Controller
{
	# Шаблон страниц
	public string $layout = 'error';

    /**
     * Страница 404
     * @return View
     */
    public function page500(): View
    {
        $this->layout = '500';
        Header::code(500);
        # Данные массива $data

        return View::make('500', $this->data);
    }
}