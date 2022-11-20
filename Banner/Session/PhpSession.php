<?php

/**
 * @package Banner\Session\PhpSession
 */

namespace Banner\Session;

class PhpSession implements Session {

	public function __construct()
	{
		session_start();
	}

	public function has(string $key): bool
	{
		return isset($_SESSION[$key]);
	}

	public function set(string $key, string $value): void
	{
		$_SESSION[$key] = $value;
	}

	public function get(string $key): string
	{
		return isset($_SESSION[$key]) ?? '';
	}
}