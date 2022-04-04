<?php


namespace app\ctrl\json;

use app\ctrl\json\auth_ctrl;
use app\repository\sql\user\user_repository;

class user_ctrl extends auth_ctrl
{

	public function index()
	{
		$user = new user_repository();
		print json_encode($user->get_all());
	}

}