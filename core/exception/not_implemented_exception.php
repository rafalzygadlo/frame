<?php

class not_implemented_exception extends my_exception
{
  
    public function __construct($function)
    {
        parent::__construct('NOT IMPLEMENTED',$function);
    }

   
}