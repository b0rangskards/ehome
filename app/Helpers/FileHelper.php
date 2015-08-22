<?php  namespace App\Helpers; 

class FileHelper {

	public static function generateFileName($name, $file)
	{
		return time() . '_' . str_slug($name, '_') . '.' . $file->getClientOriginalExtension();
	}

	public static function generateSubtaskFileName($name, $file)
	{

	}

} 