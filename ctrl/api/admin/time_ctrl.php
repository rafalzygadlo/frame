<?php


namespace app\ctrl\api\admin;

use app\ctrl\api\admin\auth_ctrl;
use app\repository\sql\time_repository;

class time_ctrl extends auth_ctrl
{

	public function work($id)
	{
		$repo = new time_repository();
		print json_encode($repo->get_work($id));
	}

	public function index()
	{	
		$repo = new time_repository();
		print json_encode($repo->get_all());
	}

}