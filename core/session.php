<?php

 
namespace app\core;
 
class session
{

    //GET

    public static function get_ctrl()
    {
        if(isset($_SESSION['ctrl']))
            return $_SESSION['ctrl'];
        else
            return DEFAULT_CTRL;
    }

    public static function get_lang()
    {
        if(isset($_SESSION['lang']))
            return $_SESSION['lang'];
        else{
         
         //print 'no lang';
          //e/xit;
            return 'pl';

        }
    }

    public static function get_valid_user()
    {
        if(isset($_SESSION['valid_user']))
            return $_SESSION['valid_user'];
        else
            return false;
        
    }
    
    public static function get_user()
    {
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        else
            return false;
    }
    
    public static function get_search()
    {
        if(isset($_SESSION['search']))
            return $_SESSION['search'];
        else
            return false;
    }
    
    public static function get_current_page()
    {
        if(isset($_SESSION['current_page']))
            return $_SESSION['current_page'];
        else
            return false;
    }
        
    //SET
    public static function set_default()
    {
        $_SESSION['order_column_id'] = DEFAULT_ORDER_COLUMN_ID;
        $_SESSION['page'] = DEFAULT_PAGE;
        $_SESSION['asc'] = DEFAULT_ASC;
        $_SESSION['id'] = DEFAULT_ID;
        $_SESSION['id_parent'] = DEFAULT_ID;
    }
    
    public static function set_id($value)
    {
        $_SESSION['id'] = $value;
    }

    public static function SetIdParent($value)
    {
        $_SESSION['id_parent'] = $value;
    }

    public static function SetCtrl($value)
    {
        $_SESSION['ctrl'] = $value;
    }

    public static function SetLang($value)
    {
        $_SESSION['lang'] = $value;
    }

    public static function SetAsc($value)
    {
        $_SESSION['asc'] = $value;
    }

    public static function SetPage($value)
    {
        $_SESSION['page'] = $value;
    }

    public static function SetPageTo($value)
    {
        $_SESSION['page_to'] = $value;
    }
    
    public static function SetLimit($value)
    {
        $_SESSION['limit'] = $value;
    }

    public static function set_valid_user($value)    {        $_SESSION['valid_user'] = $value;    }
    
    public static function set_user($value)
    {
        $_SESSION['user'] = $value;
    }
            
    public static function SetSearch($value)
    {
        $_SESSION['search'] = $value;
    }
    
    public static function SetCurrentPage($value)
    {
        $_SESSION['current_page'] = $value;
    }
    
    public static function SetBusiness($value)
    {
        $_SESSION['business'] = $value;
    }
}
