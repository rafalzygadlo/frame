<?php


namespace app\ctrl;

use app\core\ctrl;
use app\core\view;
use app\core\session;

class logout_ctrl extends ctrl
{
    
    public function index()
    {	
        
        session_destroy();
        unset($_SESSION);
        $cookies = $_COOKIE;

        foreach($cookies as $cookie )
        {
            unset($cookie); 
        }
        
        header('Location:/'.$this->get_default_ctrl(), 400);
	   
    }
    
}

