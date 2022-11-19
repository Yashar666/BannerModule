<?php

/**
 * @package Banner\Config\EnvConfig
 */

namespace Banner\Config;

use Banner\Helper;

class EnvConfig implements Config {

	public const CONFIG_FILE = '~/.env';

	public function __construct()
	{
		$envFile = Helper::readFile(self::CONFIG_FILE);
		$this->parseEnv($envFile);
	}

	private function parseEnv(string $envFile)
	{
		$arrayData = explode("\n", $envFile);

		if($arrayData) {
			foreach($arrayData as $data) {
				$data = trim($data);
				if($data) {
					$this->set($data);
				}
			}
		}
	}

	public function set(string $data): void
	{
		putenv($data);
	}

	public function get(string $key): string
	{
		return getenv($key);
	}
}