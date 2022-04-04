<?php

namespace app\view;

use app\core\view;

class login_view extends view
{

    private $login_error = false;

    public function __construct($error)
    {
        $values = array
        (
            'render' => new \app\core\render()
        );

        parent::__construct($template = 'login/index', $values);
        $this->login_error = $error;
    }

    public function get_title()
    {
        return __("Login");
    }
    
    public function get_login_error()
    {
        return $this->login_error;
    }

}

