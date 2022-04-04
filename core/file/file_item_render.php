<?php


namespace app\core\file;

class file_item_render
{
    
    function __construct($items, $columns)
    {
        $this->items = $items;
        $this->columns = $columns;
    }
    
    private function items()
    {
        
        foreach ($this->items as $item)
        {
            foreach($this->columns as $column)
            {
        
                if($column->visible)
                {
                    print $column->render($item);
                }
                
                print ';';
            
            }
            
            print '<br>';
        }
    }
    
    public function run()
    {
        $this->items();
    }
    
    
}

