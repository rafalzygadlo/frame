<?php

namespace app\repository\sql\user;

use PDO;
use app\repository\irepository;
use app\repository\sql;

class csv_user_repository
{

    public function __construct()
    {
        $this->sql = sql::get_instance('app\config\database\db');
    }
 
    private function insert($model)
    {
        $this->sql->insert('users', get_object_vars($model))->execute();
    }
    
    private function update_by_arbeiter_id($model)
    {
        $params = array
        (
            "arbeiter_id" => $model->arbeiter_id  
        );

        $this->sql->update('users', get_object_vars($model))->where("arbeiter_id=:arbeiter_id")->execute($params);
    }

    private function update_by_empl_id($model)
    {
        $params = array
        (
            "empl_id" => $model->empl_id  
        );


        $this->sql->update('users', get_object_vars($model))->where("empl_id=:empl_id")->execute($params);
    }



    public function save($model)
    {
        $params = array
        (
            "arbeiter_id" => $model->arbeiter_id,            
        );
        
        $exists = $this->sql->select("*")->from("users")->where("arbeiter_id=:arbeiter_id")->get_one($params);

        if($exists)
		{
            $this->update_by_arbeiter_id($model);
            print 'by arbeiter id';
            return; 
		}
		
        if($model->empl_id != null)
        {

            $params = array
            (
                "empl_id" => $model->empl_id  
            );

            $exists = $this->sql->select("*")->from("users")->where("empl_id=:empl_id")->get_one($params);
        
            if($exists)
		    {
                $this->update_by_empl_id($model);
                print 'by empl id';
                return; 
		    }
        }
        

        print 'insert new';
		$this->insert($model);
        

    }
    

}