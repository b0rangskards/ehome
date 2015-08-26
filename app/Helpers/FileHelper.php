<?php  namespace App\Helpers; 

use App\Household;
use File;
use Intervention\Image\Facades\Image;

class FileHelper {

	public static function generateFileName($name, $fileExtension = 'jpg')
	{
		return time() . '_' . str_slug($name, '_') . '.' . $fileExtension;
	}

	public static function getHouseholdTaskImageDir($householdId)
	{
		return Household::findOrFail($householdId)->getTaskImagesDir();
	}

	public static function uploadRaw($image, $fileName, $householdId)
	{
		/* Create Dir if doesnt exists */
		File::exists(self::getHouseholdTaskImageDir($householdId)) or File::makeDirectory(self::getHouseholdTaskImageDir($householdId), 493, true);

		$image
			->resize(null, 640, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})
			->save(self::getHouseholdTaskImageDir($householdId) . '/' . $fileName);

		return $fileName;
	}

	/**
	 * Upload Task Image.
	 *
	 * @param $name
	 * @param $householdId
	 * @param $tmpPath
	 * @param $fileExtension
	 * @return string
	 */
	public static function uploadImage($name, $householdId, $tmpPath, $fileExtension = 'jpg')
	{
		$fileName = self::generateFileName($name, $fileExtension);
		$image = Image::make($tmpPath);

		/* Prevent Image from possible upsizing and Maintain Aspect Ratio */
		return self::uploadRaw($image, $fileName, $householdId);
	}
} 