<?php

namespace app\core;

class msg 
{

    private static $msg;

    public static function init()
    {
        //todo session switch
        $lang = session::get_lang();
        self::$msg = json_decode(file_get_contents("i18n/$lang.json"), true);
    }

    public static function get($const)
    {
        if(array_key_exists($const,self::$msg))
            return self::$msg[$const];
        else
            return $const.'*';        
    }

}
