<?php

namespace app\core;

use ZipArchive;

class zip
{
    	
	public function compress_folder($folder_name, $archive_name)
	{
		$folder = new folder($folder_name);
		$files = $folder->get_files($folder_name);
				
		$zip = new ZipArchive();
		if($zip->open(getcwd(). DIRECTORY_SEPARATOR. $archive_name, ZipArchive::CREATE | ZipArchive::OVERWRITE))
		{
			foreach($files as $file)
			{	
				
				$zip->addFile($file->path, $file->relpath);
			}
				$zip->close();
				
				return true;
		}
		else
		{
			return false;
		}
	
	}
	


}