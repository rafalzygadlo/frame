<?php


namespace app\core\file;

use app\core\file\file;

class file_item_writer extends file
{
    
   function __construct($file, $folder, $items, $columns, $separator)
   {
         parent::__construct($file, $folder, $separator);
         $this->items = $items;
         $this->columns = $columns;

         // separator na 0 - bedzie na końcu
         // separator na 1 - nie bedzie na końcu
         $this->separator = SEPARATOR_AT_THE_END;
   }

   private function items()
   {
	
   	  $count_items = count($this->items);
   	  $counter = 1;
      
        foreach ($this->items as $item)
         {
         $this->separator = SEPARATOR_AT_THE_END;
         $count = count($this->columns);

         foreach($this->columns as $column)
         {

            if($column->visible)
            {
               $this->write_item($column->render($item));
            }

            if ($this->separator < $count)
               $this->write_separator();

            $this->Separator++;
         }

         if($count_items > $counter)
         	$this->write_eol();

		$counter++;
      }
    }
    
    public function run()
    {
         //delete old file
         $this->delete();
         $this->items();
         //$this->Rename();
    }
    
    
}

