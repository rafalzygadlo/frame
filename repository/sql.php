<?php

namespace app\repository;

use PDO;


class sql extends PDO
{

    private $sth;
    private static $instance;
    private $sql;
  

    public function __construct($type, $host, $name, $user, $password)
    {

        try
        {
            parent::__construct($type . ':host=' . $host . ';dbname=' . $name, $user, $password);
            $this->sth = $this->prepare('SET NAMES utf8');
            $this->sth->execute();

        } catch (\Exception $ex)
        {
            die($ex);
            error_log($ex);
            exit;
        }
        
    }

    public static function get_instance($config)
    {
        if (!self::$instance)
        {
            self::$instance = new Sql($config::type, $config::host, $config::name, $config::user, $config::password);
            //print '<br><br><div class="alert alert-info">Database instance</div>';
        }
        return self::$instance;
    }

    public function row($sql, $params)
    {
        $this->sth = $this->prepare($sql);
        if ($this->sth)
        {
            if ($this->sth->execute($params))
            {
                $this->sth->setFetchMode(PDO::FETCH_OBJ);        
                return $this->sth->fetch();
            }
            else
            {  
                die($this->sth->errorInfo( )[2]);
                error_log($this->sth->errorInfo( )[2]);
            }
        }
        else
        {
            return false;
        }

    }

    public function max($field,$table,$fetchMode = PDO::FETCH_CLASSTYPE)
    {
        $sql = "SELECT MAX($field) as Max FROM $table";
        $this->sth = $this->prepare($sql);
        if ($this->sth)
        {
            error_log($this->sth->errorInfo( )[2]);                      
        }
        else
        {
            return false;
        }

    }

    public function sql()
    {
        return $this->sql;
    }
    
    public function exists($table, $id, $key, $fetchMode = PDO::FETCH_OBJ)
    {
        $params = array
        (
            $id => $key
        );
        
        return $this->select("*")->from($table)->where("$id =:$id")->get_one($params, $fetchMode);
    }

    public function select($fields)
    {
        $this->sql = "SELECT ".$fields;
        return $this;
    }

    public function from($table)
    {
        $this->sql.= " FROM ".$table;
        $this->table = $table;

        return $this;
    }

    public function where($where)
    {
        $this->sql.= " WHERE ".$where;
        return $this;
    }

	public function update($table, $fields)
    {
        $this->sql = "UPDATE ".$table." SET ";
        
        foreach($fields as $key => $value)
        {
            $this->sql.= $key."='".$value."'";
            $this->sql.=",";
        }
        
        $this->sql = substr($this->sql, 0, -1);

        return $this;
    }

	public function set($fields)
    {
        $this->sql .= $fields;
        return $this;
    }


    public function insert($table, $fields)
    {
        $this->sql = "INSERT INTO ".$table." SET ";
	
	    foreach($fields as $key => $value)
        {
            $this->sql.= $key."='".$value."'";
            $this->sql.=",";
        }

        $this->sql = substr($this->sql, 0, -1);
        
        return $this;
    }

    public function execute($params = null)
    {
        
        $this->sth = $this->prepare($this->sql);
        if ($this->sth)
        {
            if ($this->sth->execute($params))
	        {                
                return $this;
            }
	        else
	        {
                die($this->sth->errorInfo( )[2]);
                error_log($this->sth->errorInfo( )[2]);
		        error_log($this->sql);
		        exit;
	        }
            
        }
        else
        {
            return false;
        }

    }

    public function get($params = null, $fetchMode = PDO::FETCH_OBJ, $class = null)
    {
        if($this->execute($params))
            return  $this->fetch($fetchMode, $class);
         
    }

    public function get_one($params = null, $fetchMode = PDO::FETCH_OBJ, $class = null)
    {
        if($this->execute($params))
            return  $this->fetch_one($fetchMode, $class);
         
    }
    
    private function fetch($fetchMode = PDO::FETCH_OBJ, $class = null)
    {
        if ($class == null)
            return $this->sth->fetchAll($fetchMode);
        else
            return $this->sth->fetchAll($fetchMode, $class);
    }

    public function fetch_one($fetchMode = PDO::FETCH_OBJ)
    {
        return $this->sth->fetch($fetchMode);   
    }

    private function row_count()
    {
        return $this->sth->rowCount();
    }

    private function count($sql, $params)
    {
        $this->sth = $this->prepare($sql);
        $this->sth->execute($params);
        return $this->sth->fetchColumn();
    }

    
}
