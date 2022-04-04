<?php

namespace app\core;

abstract class model
{
		
	protected $errors = array();

	protected $rules = array();

	public function get_id()
	{
		return 0;
	}

	public function get_active()
	{
		return 0;
	}
	
	public function load_data($data)
	{
	    foreach($data as $key => $value)
	    {
			if(property_exists($this, $key))
			{
			    $this->{$key} = $value;
		    }
		}
	}

	public function validate()
	{
		$this->set_rules();
		return $this->check_rules();
		
	}
	
	public function set_rules()
	{
		$this->rules = array();
	}
	
	private function check_rules()
	{
		$result = true;
		foreach($this->rules as $attr => $rules)
		{
			foreach($rules as $rule)
			{
				if(!$rule->run())
					$result = false;
			}
		}
		
		return $result;
	}

	public function add_error(string $attribute, string $rule)
	{
		//$this->errors[$attribute][] = 
	}
	

}
