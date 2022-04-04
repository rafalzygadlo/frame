<?php

namespace app\repository\sql\admin;

use PDO;
use app\repository\irepository;
use app\repository\sql;

class item_repository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
     
    }

    public function get_parent_id($parent_id)
    {
        $params = array
        (
            "parent_id" => $parent_id
        );

        return $this->sql->select("parent_id")->from("items")->where("items_id=:parent_id")->get_one($params);

    }

    public function get($id)
    {
        $params = array
        (
            "id" => $id
        );

        return $this->sql->select("*")->from("items")->where("items_id=:id")->get_one($params);

    }


    public function get_all($parent_id)
    {
        $params = array
        (
            "parent_id" => $parent_id
        );

        return $this->sql->select("*")->from("items")->where("parent_id=:parent_id")->get($params, PDO::FETCH_CLASS,'app\model\admin\item_model');

    }
    
    public function update($model)
    {
        $params = array
		(
			'items_id' => $model['items_id']
		);
        
        return $this->sql->update('items', $model)->where("items_id=:items_id")->execute($params);

    }
    

}