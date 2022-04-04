<?php


namespace app\ctrl;

use app\core\ctrl;
use Lib\Tools;
use app\core\file_log;
use app\core\file\file_receiver;
use app\core\file\file_reader;
use app\model\user\csv_user_model;
use app\repository\sql\user\csv_user_repository;
use app\repository\sql\user\user_repository;

define("FILE_USER_CSV", "../_data/users.csv");

class user_export_ctrl extends ctrl
{

    private function run()
    {
		$csv_user_repository = new csv_user_repository();
    	$this->file_reader = new file_reader(FILE_USER_CSV, 16, "\t");
		// plik

		if($this->file_reader->run())
		{
    		$counter = 0;
	    
		    // rekordy w pliku
		    foreach($this->file_reader->records as $record)
	    	{
				$user = new csv_user_model($record);
				$csv_user_repository->save($user);			
	    	}

		}
    }
    
    public function test()
    {
		$user_repository = new user_repository();
		$result = $user_repository->get_all();

		print_r($result);
    }
    
    public function index()
    {
		$start = microtime(true);
		
		print "start\n";
		$this->run();
		print "end\n";
		
		$time = microtime(true) - $start;
		print $time;
		print "\n";
    }

}
