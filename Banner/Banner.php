<?php

/**
 * @package Banner\Banner
 */

namespace Banner;

class Banner {

	/**
	* @var Banner\Config\Config $config
	*/

	public function __construct()
	{
		$this->config = Provider::get('CONFIG');
		$this->model = Provider::get('MODEL');
		$this->session = Provider::get('SESSION');
		$this->cookie = Provider::get('COOKIE');
		$this->changeData();
		$this->showImage();
	}

	protected function changeData(): void
	{
		$ip = Helper::ip();
		$page = Helper::currentPage();
		if(!$this->session->has('user.' . $page)) {
			if($this->model->add()) {
				$this->session->set('user.' . $page, $ip);
			}
		} else {
			$this->model->update($ip, $page);
		}
	}

	protected function showImage(): void
	{
		$image = Helper::realPath($this->config->get('IMG_URL'));
		$imageInfo = $this->cookie->has('banner_mime') ? json_decode($this->cookie->get('banner_mime'), true) : getimagesize($image);
		if($imageInfo && !empty($imageInfo['bits']) && Helper::isImage($imageInfo['mime'])) {
			$this->cookie->set('banner_mime', json_encode($imageInfo));
			header("Content-type: {$imageInfo['mime']}");
			readfile($image);
		}
	}
}