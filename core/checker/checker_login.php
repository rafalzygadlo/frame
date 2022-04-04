<?php

namespace app\core\checker;

use app\core\checker;
use app\core\session;

class checker_login extends checker
{
  
  public function run($request)
  {
      if(!session::get_valid_user())
	  {  
       		$request->redirect('login');   
	  }
		
  }

}
