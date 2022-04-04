<?php


namespace app\ctrl\api\admin;

use app\ctrl\api\admin\auth_ctrl;
use app\repository\sql\user\user_repository;

class user_ctrl extends auth_ctrl
{
	
	public function store($request)
	{
		
	}

	//user working month
	public function month()
	{
		$user = new user_repository();
		print json_encode($user->get_month());
	}

	public function index()
	{	
		$user = new user_repository();
		print json_encode($user->get_all());
	}

}