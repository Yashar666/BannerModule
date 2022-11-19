<?php

/**
 * @package Banner\Banner
 */

namespace Banner;

use Config;

class Banner {

	private array $config; 

	public function __construct(IConfig $conf)
	{
		$this->config = $conf;
	}
}