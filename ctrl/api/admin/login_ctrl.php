<?php

namespace app\ctrl\api\admin;

use app\repository\sql\api\admin_login_repository;
use app\core\ctrl;

class login_ctrl extends ctrl
{
    
    public function index($request)
    {	
        
        $data = json_decode(file_get_contents("php://input"));

        $error = array("message"=>"unauthorized");
        
        if($data)
        {
            
            $model = new admin_login_repository();
            $user = $model->login($data->email, $data->password);
                                  
            if($user)
            {
                print json_encode($user);
            }
            else
            { 
                http_response_code(401);
                print json_encode($error);
            }
            
        }
        else
        {
            http_response_code(401);
            print json_encode($error);
        }

    }
    
}

