<?php

namespace app\ctrl\admin;

use app\view\admin\home_view;
use app\core\ctrl;

class home_ctrl extends ctrl
{

    public static function index()
    {
        $view = new home_view();
        $view->render();
    }

}
