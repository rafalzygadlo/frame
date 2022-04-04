<?php


namespace app\ctrl;

use app\ctrl\auth_ctrl;
use app\view\account_view;
use app\core\session;

class account_ctrl extends auth_ctrl
{

	public function index()
	{
		$view = new account_view();
        $view->render();
	}

}