<?php

/**
 * @package Banner\Helper
 */

namespace Banner;

use Exception;

class Helper {

	private static array $imgTypes = [
		'image/png',
		'image/jpeg',
		'image/jpg',
		'image/bmp',
		'image/webp',
		'image/gif',
	];
	
	public static function realPath(string $path): string
	{
		return realpath(str_replace('~', getenv('DOCUMENT_ROOT'), $path));
	}

	public static function isImage(string $mime): bool
	{
		return in_array($mime, static::$imgTypes);
	}

	public static function readFile(string $file)
	{
		$file = self::realPath($file);
		if(is_file($file)) {
			return file_get_contents($file);
		}

		throw new Exception('File not found!');
	} 
}