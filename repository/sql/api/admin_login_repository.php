<?php

namespace app\repository\sql\api;

use app\repository\sql;
use app\core\tools;

class admin_login_repository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }

    private function generate_api_token($admins_id)
    {
        $params = array
        (
            ':admins_id' => $admins_id
        );

        $data = array
        (
            'api_token' => tools::random_string(60)
        );

        $this->sql->update("admins", $data)->where("admins_id=:admins_id")->get_one($params);

    }


    public function get($admins_id)
    {
        $params = array
        (
            "admins_id" => $admins_id
        );

        return  $this->sql->select("admins_id, first_name, last_name, api_token")->from("admins")->where("admins_id=:admins_id")->get_one($params);
        
    }

    public function check_token($api_token)
    {
    
        $params = array
        (
            ':api_token' => $api_token
        );

        return $this->sql->select("*")->from("admins")->where("api_token=:api_token")->get_one($params);
    }


    public function login($email, $password)
    {
 
        $params = array
        (
            "email" => $email,
            "password" => md5($password)
        );
        
        
        $item = $this->sql->select("*")->from("admins")->where("email=:email AND password=:password")->get_one($params);

        if($item)
        {
            $this->generate_api_token($item->admins_id);
            return $this->get($item->admins_id);
        }
        else
        {
            return false;
        }


    }



}