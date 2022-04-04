<?php

namespace app\core\render\column;

abstract class column
{

    public $name;

    public $field_name;

    public $visible = true;

    public function __construct($name, $fieldname, $visible = true)
    {
        $this->name = $name;
        $this->field_name = $fieldname;
        $this->visible = $visible;
    }

}
