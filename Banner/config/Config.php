<?php

/**
 * @package Banner\Config\Config
 */

namespace Banner\Config;

interface Config {
	/**
	* Config file for parse settings
	* @var const CONFIG_FILE
	*/
	public const CONFIG_FILE = '';

	/**
	* Set Config
	* @param string $data
	* @return void
	*/
	public function set(string $data): void;

	/**
	* Get Config
	* @param string $data
	* @return string
	*/
	public function get(string $data): string;	
}