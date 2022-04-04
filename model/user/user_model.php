<?php

 namespace app\model;
 
 use PDO;
 use app\core\model;
 
class user_model extends model
{

    public $id;

    public $id_user;

    public $id_lang;

    public $id_role;

    public $nick;

    public $email;

    public $first_name;

    public $last_name;

    public $password;

    public $avatar;

    public $active;

   
}
