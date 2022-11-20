<?php

/**
 * @package Banner\Session\Session
 */

namespace Banner\Session;

interface Session {

	public function has(string $data): bool;
	
	public function set(string $key, string $value): void;

	public function get(string $data): string;	
}