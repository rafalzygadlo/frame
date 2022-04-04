<?php


namespace app\core\column;


class column_date extends column
{

    public function render($item)
    {
        $name = $this->field_name;
        return date("Y-m-d",strtotime($item->$name));
    }

}

