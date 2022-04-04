<?php

/**
 * ColumnText
 * 
 * @category   Libs
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */

namespace Lib\Column;


class ColumnTextValue extends Column
{

    
    public function __construct($name, $value, $visible = true)
    {
        $this->name = $name;
        $this->value = $value;
        $this->visible = $visible;
    }

    public function Render($item)
    {
        return $this->value;
    }

}

