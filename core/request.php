<?php

/**
 * Request
 * 
 * @category   lib
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2020 maxkod.pl
 * @version    1.0
 */


namespace app\core;

class request
{
    // ids of item
    public $id;
    // parent id
    public $pid;

    public $order;

    public $limit;

    public $page;

    public function __construct($argv)
    {
        $this->id = 0;
        $this->pid = 0;
        $this->order = 0;
        $this->limit = 30;
        $this->argv = $argv;
    }

    public function get_body()
    {
        return $_POST;
    }

    public function get_path()
    {
        if(isset($this->argv))
        {
            return $this->argv[1];
        }
        
        $path = $_SERVER['REQUEST_URI'];
        if(!$path)
            $path = '/';
        
        $position = strpos($path,'?');
        
        if($position == false)
        {
            return $path;
        }
        
        return substr($path, 0, $position);
        
    }
    
    public function get_method()
    {
        if(isset($_SERVER['REQUEST_METHOD']))
            return strtolower($_SERVER['REQUEST_METHOD']);
        else
            return 'get';
    }
    
    
    function get_authorization_header()
    {
        $headers = null;
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) 
        {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        }
        
        return $headers;
    }
    
    function get_bearer_token() 
    {
        
        $headers = $this->get_authorization_header();
  
        if (!empty($headers)) 
        {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) 
            {
                return $matches[1];
            }
        }
   
        return null;
    
    }

    public function redirect($url, $code = 200)
    {
        header('Location:'.$url);
        exit;
    }
    

}

