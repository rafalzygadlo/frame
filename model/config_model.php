<?php

 namespace app\model;
 
 use PDO;
 use app\core\model;
 
class config_model extends model
{

    public $items_id;

    public $parent_id;

    public $value;
 
    public function __construct()
    {
        $this->items_id = 0;
        $this->type = 0;
    }

    public function get_error($field)
    {
        return $this->errors[$field];
    }
    
    public function validate()
    {
        $field = new input();
        $field->name('items_id')->required();


        
        return false;
    }
    
    public function get_active()
    {
        return 1;
    }

}
