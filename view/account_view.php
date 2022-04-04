<?php

namespace app\view;

use app\core\view;
use app\core\session;

class account_view extends view
{

    public function __construct()
    {
        parent::__construct('account/index', array("user" => session::get_user()));
    }

    public function get_title()
    {
        return __("Account");
    }
    
    
}

