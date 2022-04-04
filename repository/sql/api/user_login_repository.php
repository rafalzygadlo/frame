<?php

namespace app\repository\sql\api;

use app\repository\sql;
use app\core\tools;

class user_login_repository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }

    private function generate_api_token($id_user)
    {
        $params = array
        (
            ':users_id' => $id_user
        );

        $data = array
        (
            'api_token' => tools::random_string(60)
        );

        $this->sql->update("users", $data)->where("users_id=:users_id")->get_one($params);

    }


    public function get($users_id)
    {
        $params = array
        (
            "users_id" => $users_id
        );

        return  $this->sql->select("users_id, first_name, last_name, api_token")->from("users")->where("users_id=:users_id")->get_one($params);
        
    }

    public function check_token($api_token)
    {
        $params = array
        (
            ':api_token' => $api_token
        );

        return $this->sql->select("*")->from("users")->where("api_token=:api_token")->get_one($params);
    }


    public function login($email, $password)
    {
 
        $params = array
        (
            "email" => $email,
            "password" => md5($password)
        );
        
        $user = $this->sql->select("*")->from("users")->where("email=:email AND password=:password")->get_one($params);

        if($user)
        {
            $this->generate_api_token($user->users_id);
            return $this->get($user->users_id);
        }
        else
        {
            return false;
        }


    }



}