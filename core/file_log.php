<?php


namespace app\core;

class file_log
{

   public static function write($data)
   {
      $fname = system::get_log_folder()."/".date("Y_m_d").".log";
      $log =  date("Y-m-d H:i:s")." ".$data."\n";
      file_put_contents($fname, $log, FILE_APPEND | LOCK_EX);
   }


}

