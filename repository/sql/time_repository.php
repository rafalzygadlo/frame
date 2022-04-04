<?php

namespace app\repository\sql;

use app\repository\irepository;
use app\repository\sql;
use app\model\admin\time_model;

class time_repository implements irepository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }

    public function get_all()
    {
        return $this->sql
            ->select("times_id, empl_id, first_name, last_name, pforte_ab, pforte_zu, date, time, work, IF(valid=1,'true','false') as valid")
            ->from("times, users")
            ->where("times.users_id=users.users_id")
            ->get();
    }
    
    public function get_work($id)
    {
        $params = array
        (
            "times_id" => $id,
        );

        return $this->sql
            ->select("*")
            ->from("works")
            ->where("times_id =:times_id")
            ->get($params);
    
    }
    

    public function get_for_user($id, $ym)
    {
        $params = array
        (
            "users_id" => $id,
            "ym" => $ym
        );

        return $this->sql
            ->select("*")
            ->from("times")
            ->where("users_id =:users_id AND MONTH(date)=MONTH(:ym) AND YEAR(date)=YEAR(:ym)")
            ->get($params);
    
    }

    public function get($id)
    {
        $params = array
        (
            "times_id" => $id
        );

        return $this->sql
            ->select("*")
            ->from("times")
            ->where("times_id = :times_id")
            ->get($params);
    
    }
    
    public function Save($model){}
    

}