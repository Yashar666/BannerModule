<?php
/**
* @package Banner\Session\CookieSession
*/
namespace Banner\Session;

class CookieSession implements Session {
	/**
	* @var const COOKIE_TIME
	*/
	public const COOKIE_TIME = 86400 * 30;

	/**
	* Check Cookie has or not
	* @param string $key
	* @return bool
	*/
	public function has(string $key): bool
	{
		return isset($_COOKIE[$key]);
	}

	/**
	* Set cookie
	* @param string $key
	* @param string $value
	* @return void
	*/
	public function set(string $key, string $value): void
	{
		setcookie($key, $value, time() + self::COOKIE_TIME, '/');
	}

	/**
	* Get Cookie
	* @param string $key
	* @return string
	*/
	public function get(string $key): string
	{
		return $_COOKIE[$key] ?? '';
	}
}
