<?php

namespace app\view;

use app\core\view;

class time_view extends view
{

    public function __construct()
    {
        parent::__construct($template = 'time/index');
    }

    public function get_title()
    {
        return __("Time");
    }

}

