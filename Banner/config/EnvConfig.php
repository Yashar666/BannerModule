<?php

/**
 * @package Banner\Config\EnvConfig
 */

namespace Banner\Config;

use Banner\Helper;

class EnvConfig implements Config {
	/**
	* Config file for parse settings
	* @var const CONFIG_FILE
	*/
	public const CONFIG_FILE = '~/.env';

	/**
	* Read & parse settings
	*/
	public function __construct()
	{
		$envFile = Helper::readFile(self::CONFIG_FILE);
		$this->parseEnv($envFile);
	}

	/**
	* Parse env file
	* @param string $envFile
	* @return void
	*/
	private function parseEnv(string $envFile): void
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

	/**
	* Set each setting
	* @param string $data
	* @return void
	*/
	public function set(string $data): void
	{
		putenv($data);
	}

	/**
	* Get setting
	* @param string $key
	* @return string
	*/
	public function get(string $key): string
	{
		return getenv($key) ?? '';
	}
}