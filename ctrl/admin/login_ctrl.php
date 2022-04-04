<?php

namespace app\ctrl\admin;

use app\core\ctrl;
use app\core\session;
use app\core\checker\checker_login;
use app\repository\sql\user\user_login_repository;
use app\view\admin\login_view;

class login_ctrl extends ctrl
{
    
	private function read()
    {
        // dane z formularza
        $this->empl_id = filter_input(INPUT_POST, "empl_id");
        $this->password = filter_input(INPUT_POST, "password");
        $this->rememberMe = filter_input(INPUT_POST, "remember_me");
    		        
    }

    private function check()
    {
        if(empty($this->empl_id))
            return false;

        if(empty($this->password))
            return false;            

        $this->empl_id = md5($this->empl_id);
        $this->password = md5($this->password);

        
		$user_login_repository = new user_login_repository();
        $user = $user_login_repository->get_user($this->empl_id, $this->password);
            

        if ($user)
        {
            session::set_valid_user(true);
            session::set_user($user);     
			return true;
        }
        else
        {
            session::set_valid_user(false);
			return false;
        }
    
		return false;
    }

    public function do()
	{
		$this->read();
		
		if($this->check())
		{
			header('Location:/'.$this->get_default_ctrl());	
		}
        
        $view = new login_view();
        $view->set_login_error(__("LoginError"));
        $view->render();
		
	}
	
    public function index()
    {	
        
        if(session::get_valid_user())
	    {
		    header('Location:/'.$this->get_default_ctrl());
	    }
	    else
	    {
            $view = new login_view();
            $view->render();
	    }
	   
    }
    
}

