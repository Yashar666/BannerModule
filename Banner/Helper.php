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

	public static function ip(): string
	{
		$ip = '127.0.0.1';
		if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
			$_SERVER['HTTP_CLIENT_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
		}
		if(
			!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)
		) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif(
			!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)
		) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif(
			!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE)
		) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	public static function userAgent(): string
	{
		return $_SERVER['HTTP_USER_AGENT'] ?? '';
	}

	public static function currentPage(): string
	{
		return isset($_SERVER['HTTP_REFERER']) ? basename($_SERVER['HTTP_REFERER']) : '';
	}

	public static function date(): string
	{
		return date('Y-m-d H:i:s');
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