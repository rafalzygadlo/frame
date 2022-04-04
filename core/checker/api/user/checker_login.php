<?php

namespace app\core\checker\api\user;

use app\core\checker;
use app\core\session;
use app\repository\sql\api\user_login_repository;

class checker_login extends checker
{
  
  public function run($request)
  {
      $user = new user_login_repository();
                
      if(!$user->check_token($request->get_bearer_token()))
      {
          // write Response class with Header error codes
          http_response_code(401);
          print json_encode(array("message" => "unauthorized"));
          exit;
      }

  }

}
