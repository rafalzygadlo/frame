<?php

namespace app\repository\sql\customer;

use app\repository\irepository;
use app\repository\sql;

class customer_repository implements irepository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }

    public function get_all()
    {
        return $this->sql
            ->select("*")
            ->from("customers")
            ->get();
    }

    public function get($id)
    {
        $params = array
        (
            "customers_id" => $id
        );

        return $this->sql
            ->select("*")
            ->from("customerss")
            ->where("customers_id = :customers_id")
            ->get_one();
    
    }
    
    public function save($model)
    {

    }

}