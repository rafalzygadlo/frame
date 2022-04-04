<?php


namespace app\ctrl;

use view\user_view;

class user_ctrl extends auth_ctrl
{

	public function index()
	{
		$user_view = new user_view();
        $user_view->render();
	}

}