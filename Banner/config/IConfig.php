<?php

/**
 * @package Banner\Config\IConfig
 */

namespace Banner\Config;

interface IConfig {

	public const ENV_DIR;

	public function setConfig(): void;

	public function getConfig(): string;	
}