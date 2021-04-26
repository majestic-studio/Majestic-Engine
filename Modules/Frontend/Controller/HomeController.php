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


        $this->setData('title', 'Byu Cheap: купи дешевле!');
        $this->setData('description', 'Самая большая доска объявлений и интернет магазин Кавказа.');
        $this->setData('keywords', 'объявления, магазин, кавказ, грузия, бесплатные объявления');

        return View::make('dashboard', $this->data);
    }
}