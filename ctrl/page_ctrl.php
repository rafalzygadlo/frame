<?php

namespace app\ctrl;

use app\core\ctrl;
use app\core\view;

class page_ctrl extends ctrl
{

    public function index($request)
    {
        
        $view = new view();
        $view->render('page/index');
              
    }

}
