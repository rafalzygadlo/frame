<?php


namespace app\ctrl\api\admin;

use app\ctrl\api\admin\auth_ctrl;
use app\repository\sql\customer\customer_repository;

class customer_ctrl extends auth_ctrl
{
	
	public function index()
	{	
		$repo = new customer_repository();
		print json_encode($repo->get_all());
	}

}