<?php

/**
 * @package Banner\Session\PhpSession
 */

namespace Banner\Session;

class PhpSession implements Session {
	/**
	* Start Session
	*/
	public function __construct()
	{
		session_start();
	}

	/**
	* Check Session has or not
	* @param string $key
	* @return bool
	*/
	public function has(string $key): bool
	{
		return isset($_SESSION[$key]);
	}

	/**
	* Set Session
	* @param string $key
	* @param string $value
	* @return void
	*/
	public function set(string $key, string $value): void
	{
		$_SESSION[$key] = $value;
	}

	/**
	* Get Session
	* @param string $key
	* @return string
	*/
	public function get(string $key): string
	{
		return $_SESSION[$key] ?? '';
	}
}