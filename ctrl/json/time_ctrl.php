<?php


namespace app\ctrl\json;

use app\ctrl\json\auth_ctrl;
use app\repository\sql\time_repository;
use app\core\session;
use app\core\filelog;

class time_ctrl extends auth_ctrl
{

	public function Index($request)
	{	
		filelog::write(print_r($request,true));
		filelog::Write($request->ym);
		
		$repo = new time_repository();
		$user = session::get_user();	
		$times = $repo->get_for_user($user->users_id, $request->ym);
		print json_encode($times);
	}

}