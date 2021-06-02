<?php

namespace Modules\Frontend\Controller;


use Core\Service\Http\Header;
use View;


/**
 * Class ErrorController
 * @package Modules\Frontend\Controller
 */

class ErrorController extends FrontendController
{
	# Шаблон страниц
	public string $layout = 'main';

    /**
     * Страница 404
     * @return View
     */
    public function page404(): View
    {
        Header::code(404);
        # Данные массива $data
        $this->setData('title', 'Ошибка 404, страница не найдена');
        $this->setData('description', 'Ошибка 404, страница не найдена!');
        $this->setData('keywords', 'Ошикбка 404, страница не найдена, воспользуйтесь поиском');

        return View::make('404', $this->data);
    }

    /**
     * Страница 404
     * @return View
     */
    public function page500(): View
    {
        $this->layout = 'error500';
        Header::code(500);
        # Данные массива $data

        return View::make('500', $this->data);
    }
}