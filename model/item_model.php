<?php

 namespace app\model;
 
 use PDO;
 use app\core\model;
 
class item_model extends model
{

    public $items_id = 0;
    
    public $parent_id;
    
    public $label;

    public $value;

    public $type = 0;

    public $tooltip = '';

    public $template = 'grid_view';

    public $items = array();
 
    
}
