<?php


namespace app\core;

class tools
{

    public function as_string()
    {
        return get_class($this);
    }    
    
    public static function random_string($len)
    {
        $string_table = "qazwsxedcrfvtgbyhnujmikolpQAZWSXEDCRFVTGBHNUJMIKOLP1234567890";
        $buffer = "";
        for ($i = 0; $i < $len; $i++)
            $buffer = $buffer . $string_table[rand(0, strlen($string_table) - 1)];

        return $buffer;
    }
    
    
    public static function directory_create($path)
    {
        if(!tools::directory_exists($path))
            mkdir($path, 0777, true);
    }
    
    public static function directory_exists($path)
    {
        if (!file_exists($path))
        {
            return false;
        }else{
     
        return true;
        }
    } 
 
  
    
}