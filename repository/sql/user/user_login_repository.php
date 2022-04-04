<?php

namespace app\repository\sql\user;

use app\repository\sql;

class user_login_repository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('\app\config\database\db');
    }

    public function get_user($empl_id, $password)
    {
        $params = array
        (
            "empl_id" => $empl_id,
            "password" => $password
        );
       
        return $this->sql
            ->select("*")
            ->from("users")
            ->where("md5(empl_id)=:empl_id AND password=:password AND status=1")
            ->get_one($params);
    }

}