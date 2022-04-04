<?php

namespace app\repository\sql;

use app\repository\irepository;
use app\repository\sql;

class item_repository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }

    public function Breadcrumb($id, $level = 0)
    {
        $params = array(':id' => $id);
        $sql = 'SELECT * FROM page WHERE id_page=:id';
                   
        $items = $this->DB->Query($sql, $params, PDO::FETCH_CLASS,__CLASS__);
             
        foreach($items as $item)
        {
            array_unshift($this->breadcrumb,$item);
        }
        
        foreach($items as $item)
        {
            $this->Breadcrumb($item->id_parent, $item,$level);
        }
		
    }

    public function get($items_id)
    {
        $params = array
        (
            "items_id" => $items_id
        );

        return $this->sql->select("*")->from("items")->where("items_id=:items_id")->get_one($params);
    
    }


    public function get_all($parent_id)
    {
        $params = array
        (
            "parent_id" => $parent_id
        );

        return $this->sql->select("*")->from("items")->where("parent_id=:parent_id")->get($params);
    
    }

    public function get_tree($item)
    {
        $params = array
        (
            "parent_id" => $item->items_id
        );

        $item->items = $this->sql->select("*")->from("items")->where("parent_id=:parent_id")->get($params);

        foreach($item->items as $item)
        {
            $this->get_tree($item);
        }    
    }
    
   
    public function save($model){}
    

}