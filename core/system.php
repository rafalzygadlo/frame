<?php

namespace app\core;

class system
{
	private static $log_folder = 'log';
		
	public static function get_log_folder()
	{
	    return self::$log_folder;
	}
}
