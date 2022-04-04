<?php


namespace app\core;

abstract class ctrl
{
   
    public $actions = array();
  
    public function add_action($action)
    {
		array_push($this->actions, $action);
    }
    
    public function get_default_ctrl()
    {
        return "account";
    }
	    
}
