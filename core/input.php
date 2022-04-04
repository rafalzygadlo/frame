<?php

namespace app\core;


class input
{
	private $errors = array();
	
	private $name;

	private $value;

	public function name($name)
	{
		$this->name = $name;
	}
	
	public function required()
	{        
		if($this->value == '' || $this->value == null)
		{
			array_push($this->errors = 'Campo '.$this->name.' obbligatorio.';
		}            
		
		return $this;
		
	}

}



class validator
{
	
	

}