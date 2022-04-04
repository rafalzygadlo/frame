<?php

namespace app\core\validator;

class email
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
		return false;
	}
	
}