<?php

namespace app\core\validator;

class min
{
    
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