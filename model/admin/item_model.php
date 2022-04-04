<?php

 namespace app\model\admin;
 
 use PDO;
 use app\core\model;
 use app\core\validator\required;
 use app\core\validator\min;
 use app\core\validator\email;

class item_model extends model
{

    public $items_id;
    
    public $parent_id;
    
    public $value;

    public $img;

    public $template;

    public $label;

    public $type;
    
    public $name;

    public $price;

    public $tooltip;
 

    public function get_active()
    {
        return 1;
    }

    public function get_id()
    {
        return $this->items_id;
    }

    public function set_rules()
    {
        $this->rules =       
        [
            'firstname' => [new required(), new min(6)],
            'email'	=> [new required(), new email()]
        ];
    }
    

}
