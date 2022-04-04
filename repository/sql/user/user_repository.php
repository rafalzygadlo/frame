<?php

namespace app\repository\sql\user;

use app\repository\irepository;
use app\repository\sql;
use app\model\admin\time_model;

class user_repository implements irepository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }

    public function get_month()
    {

        $users = $this->sql
            ->select("users.users_id, times_id, empl_id, first_name, last_name")
            ->from("times, users")
            ->where("times.users_id=users.users_id GROUP BY empl_id")
            ->get();


        foreach($users as $user)
        {
            $params = array
            (
                "users_id" => $user->users_id,
            );

            $i = 1;
            $days = array();
            
            while(true)
            {
                $time = new time_model();
                $time->day = $i;
                array_push($days, $time);
                $i++;

                if($i > 31)
                    break;
            }


            $month = $this->sql->select("users_id, times_id, pforte_ab, pforte_zu, date, time, work, IF(valid=1,'true','false') as valid")->from("times")->where("users_id =:users_id")->get($params);
            $i = 0;
            foreach($days as $day)
            {
                foreach($month as $mday)
                {
                    //print $mday->date;
                    $day_number = date('j', strtotime($mday->date));
                    if($day->day == $day_number)
                    {
                        $mday->empty = false;
                        $days[$i] = $mday;
                        
                    }
                }
                $i++;
            }
            

            $user->month = $days;
        }

        return $users;
    }

    public function get_all()
    {
        return $this->sql
            ->select("arbeiter_id, empl_id, first_name, last_name, email, api_token, begin_date, IF(status = 1, 'true', 'false') AS status")
            ->from("users")
            ->get();
    }

    public function get($id)
    {
        $params = array
        (
            "users_id" => $id
        );

        return $this->sql
            ->select("*")
            ->from("users")
            ->where("users_id = :users_id")
            ->get_one();
    
    }
    
    private function insert($model)
    {
        $this->sql->insert('users', $model->as_array());
    }
    
    private function update($model)
    {
        //$this->sql->update('users', $model->as_array());
    }

    public function save($user)
    {
        $exists = $this->sql->exists("users", "arbeiter_id", $user->arbeiter_id);

        print_r($exists);

        if($exists)
		{
			//print "UPDATE\n";
			$this->update($exists);
		}
		else
		{	
            //print "INSERT\n";
			$this->insert($user);
		}

    }
    

}