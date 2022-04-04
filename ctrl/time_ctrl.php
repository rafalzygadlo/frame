<?php


namespace app\ctrl;

use app\ctrl\auth_ctrl;
use app\view\time_view;
use app\repository\sql\time_repository;
use app\core\session;

class time_ctrl extends auth_ctrl
{


	public function edit($request)
	{
		print_r($request);
		
		//print $request->GetId();
	}

	public function index()
	{
	
		$repo = new time_repository();
		$user = session::get_user();		
			

		print_r($repo);

		$view = new time_view();
		$view->render();
	}

}