<?php

/**
 * @package Banner\Config\Config
 */

namespace Banner\Config;

interface Config {

	public const CONFIG_FILE = '';

	public function set(string $data): void;

	public function get(string $data): string;	
}