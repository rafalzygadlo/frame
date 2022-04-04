<?php


namespace app\ctrl\api\admin;

use app\ctrl\api\admin\auth_ctrl;
use app\repository\sql\task\task_repository;

class task_ctrl extends auth_ctrl
{
	
	public function index()
	{	
		$repo = new task_repository();
		print json_encode($repo->get_all());
	}

}