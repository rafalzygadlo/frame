<?php

 namespace app\model\admin;
 
 use PDO;
 use app\core\model;
 
class time_model extends model
{
    
    public $users_id; 
    
    public $times_id;
    
    public $pforte_ab; 
    
    public $pforte_zu;
    
    public $date; 
    
    public $time; 
    
    public $work;

    public $day;
    
    public $valid = false;
    
    public $empty = true;

}
