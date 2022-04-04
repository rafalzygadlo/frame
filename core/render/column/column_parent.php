<?php


namespace app\core\render\column;


class column_parent extends column
{

    public function render($item, $table)
    {
        $name = $this->field_name;
        
        return  '<a class="text-decoration-none" href="'.$table->ctrl_name.'?pid='.$item->get_id().'" > ' . $item->$name . '</a>';
        
    }

}

