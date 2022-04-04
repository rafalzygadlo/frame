<?php

namespace app\core\checker\api\admin;

use app\core\checker;
use app\core\session;
use app\repository\sql\api\admin_login_repository;

class checker_login extends checker
{
  
  public function run($request)
  {
      $item = new admin_login_repository();
      
      if(!$item->check_token($request->get_bearer_token()))
      {
          // write Response class with Header error codes
          http_response_code(401);
          print json_encode(array("message" => "unauthorized"));
          exit;
      }

  }

}
