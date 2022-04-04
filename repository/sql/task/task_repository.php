<?php

namespace app\repository\sql\task;

use app\repository\irepository;
use app\repository\sql;

class task_repository implements irepository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }

    public function get_all()
    {
        return $this->sql
            ->select("*")
            ->from("tasks, customers")
            ->where("tasks.customers_id = customers.customers_id")
            ->get();
    }

    public function get($id)
    {
        $params = array
        (
            "tasks_id" => $id
        );

        return $this->sql
            ->select("*")
            ->from("tasks")
            ->where("tasks_id = :tasks_id")
            ->get_one();
    
    }
    
    public function save($model)
    {

    }

}