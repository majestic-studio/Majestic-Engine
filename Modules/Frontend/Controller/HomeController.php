<?php


namespace Modules\Frontend\Controller;


use Exception;
use View;


/**
 * Class HomeController
 * @package Modules\Frontend\Controller
 */
class HomeController extends FrontendController
{
	# Шаблон страниц
	public string $layout = 'main';

	/**
	 * @return View
	 *
	 * @throws Exception
	 */
    final public function home(): View
    {

        return View::make('dashboard', $this->data);
    }
}