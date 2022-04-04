<?php


namespace app\core\render\column;


class column_text extends column
{
    public function render($item)
    {
        $name = $this->field_name;
        return $item->$name;
    }

}

