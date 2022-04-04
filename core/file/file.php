<?php


namespace app\core\file;

use app\core\file_log;

class file
{
   
   private     $separator = FILE_DATA_SEPARATOR;
   //protected   $Folder = DEFAULT_FILE_FOLDER;
   public      $file;
   public      $new_file;   //new file name after md5 and rename
    
   function __construct($file, $folder, $separator)
   {
      $this->file = $folder.'/'.$file;
      $this->new_file = $file;
      $this->folder = $folder;
		$this->separator = $separator;
   }
   
   public function md5()
   {
      return md5_file($this->File); 
   }
   
   public function rename()
   {
      $this->new_file = $this->md5($this->file);
      $new_file_path = $this->folder.'/'.$this->new_file;
      
      if(rename($this->file, $new_file_path))
         $this->file = $new_file_path;
   }
   
   public function delete()
   {
      @unlink($this->file);
   } 
   
   public function write_separator()
   {
      file_put_contents($this->file, $this->separator, FILE_APPEND | LOCK_EX);
   }
   
   public function write_item($item)
   {
      $pos = strpos($item,";");
      if($pos)
      {
         $item = str_replace(";","",$item);
         file_log::Write(" ; replaced with: ".$item);
      }

      $pos = strpos($item,"\n");
      if($pos)
      {
         $item = str_replace("\n"," ",$item);
         file_log::Write("newline replaced");
      }

      $pos = strpos($item,"\r");
      if($pos)
      {
         $item = str_replace("\r"," ",$item);
         file_log::Write("newline replaced");
      }


      $data = @iconv("UTF-8","Windows-1250//TRANSLIT", $item);

      file_put_contents($this->file, $data, FILE_APPEND | LOCK_EX);
   }

   public function write_eol()
   {
      file_put_contents($this->file, "\n", FILE_APPEND | LOCK_EX);
   }

}

