<?php


namespace app\core\file;

use app\core\file\file;

class file_reader 
{
   
   public $records = array();
       
   function __construct($file, $column_count, $separator = ";")
   {
      $this->records = array();
      $this->separator = $separator;
      $this->file = $file;
      $this->column_count = $column_count;

   }
    
    private function read()
    {
         $file = fopen($this->file,"r");

         if($file)
         {
            while(!feof($file))
            {
               $line = fgets($file);
               
               if(!empty($line))
               {
                  $parts = explode($this->separator, $line);
                  $columns = 0;
                  
                  //policz kolumny
                  $columns = count($parts);
                           
                  if($columns == $this->column_count)
                  {
                     array_push($this->records, $parts);
                  }
                  else
                  {
                     printf("number of columns %d can be %d", $columns, $this->column_count);
		    		      return false;
                  }
               }
            }
         
            fclose($file);
	    	   return true;
         }
    }
    
    public function run()
    {
         return $this->read();
    }
    
    
}

