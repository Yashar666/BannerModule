<?php

/**
 * @package Banner\Banner
 */

namespace Banner;

use Banner\Config\Config;

class Banner {

	public function __construct(array $providers)
	{
		$this->setProviders($providers);
	}

	private function setProviders(array $providers): void
	{
		if($providers) {
			foreach ($providers as $provider) {
				$this->{strtolower($provider->name)} = new $provider->value;
			}
		}
	}
}