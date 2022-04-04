<?php

namespace app\core\exception;

use exception;

class my_exception extends exception
{
    private $title;
    private $text;

    public function __construct($title, $text = '')
    {
        $this->set_title($title);
        $this->set_text($text);
        include TEMPLATE_FOLDER . '/exception/index.html';
        exit;
    }

    //get
    public function  get_title()
    {
       return $this->title;
    }
    
    public function  get_text()
    {
       return $this->text;
    }
    
    //set
    public function set_title($value)
    {
        $this->title = $value;
    }
    
    public function set_text($value)
    {
        $this->text = $value;
    }
    
   
}