<?php


namespace app\ctrl;

use app\core\ctrl;
use app\core\checker\checker_login;


class auth_ctrl extends ctrl
{

    public function __construct()
    {
    	$this->add_action(new checker_login());
    }

}



