<?php

namespace app\ctrl;

use app\core\view;
use app\core\ctrl;

class home_ctrl extends ctrl
{

    public static function index()
    {
        $view = new view('home/index');
        $view->render();
    }

}
