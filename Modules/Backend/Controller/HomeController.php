<?php

namespace Modules\Backend\Controller;

use Modules\Backend\Controller\BackendController;
use View;

class HomeController extends BackendController
{
    # Шаблон страниц
    public string $layout = 'main';

    public function dashboard()
    {
        return View::make('dashboard', $this->data);
    }
}