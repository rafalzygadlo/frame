<?php

namespace app\core\validator;

class required
{
    	
	private $errors = array();
	
	private $name;

	private $value;

	public function name($name)
	{
		$this->name = $name;
		return $this;		
	}
	
	public function run()
	{        
	
		return true;
		
	}
	
	

}