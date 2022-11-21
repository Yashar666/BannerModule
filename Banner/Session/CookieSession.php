<?php

/**
 * @package Banner\Session\CookieSession
 */

namespace Banner\Session;

class CookieSession implements Session {

	public const COOKIE_TIME = 86400 * 30;

	public function has(string $key): bool
	{
		return isset($_COOKIE[$key]);
	}

	public function set(string $key, string $value): void
	{
		setcookie($key, $value, time() + self::COOKIE_TIME, '/');
	}

	public function get(string $key): string
	{
		return $_COOKIE[$key] ?? '';
	}
}