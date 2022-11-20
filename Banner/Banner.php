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
		$this->showImage();
	}

	private function setProviders(array $providers): void
	{
		if($providers) {
			foreach ($providers as $provider) {
				$this->{strtolower($provider->name)} = new $provider->value;
			}
		}
	}

	protected function showImage(): void
	{
		$image = Helper::realPath($this->config->get('IMG_URL'));
		$imageInfo = getimagesize($image);
		if($imageInfo && !empty($imageInfo['bits']) && Helper::isImage($imageInfo['mime'])) {
			header("Content-type: {$imageInfo['mime']}");
			readfile($image);
		}
	}
}