<?php

/**
 * @package Banner\Session\Session
 */

namespace Banner\Session;

interface Session {
	/**
	* Check has session
	* @param string $data
	* @return bool
	*/
	public function has(string $data): bool;

	/**
	* Add Session
	* @param string $key
	* @param string $value
	* @return void
	*/
	public function set(string $key, string $value): void;

	/**
	* Get Session
	* @param string $data
	* @return string
	*/
	public function get(string $data): string;	
}