<?php

/**
 * @package Banner\Provider
 */

namespace Banner;

use Banner\Enum\Providers;

class Provider {
	/**
    * Providers
    * @var Config $config
    * @var Session $session
    * @var Database $model
    */

	private static $self;

	private function __construct()
	{
		//
	}

	private static function run(): void
	{
		if(!static::$self) {
			static::$self = new static;
			static::$self->allProviders = Providers::cases();
		}
	}

	private static function getProviderClass(string $provider): string
	{
		$providerClass = array_values(
			array_filter(static::$self->allProviders, fn($val) => $val->name == $provider)
		);
		if(!$providerClass) {
			throw new Exception("Provider not found!");
		}
		return $providerClass[0]?->value;
	}

	private static function setProvider(string $providerName, string $provider): void
	{
		if(!isset(static::$self->{$providerName})) {
			$providerClass = static::getProviderClass($provider);
			static::$self->{$providerName} = new $providerClass;
		}
	}
	
	private static function getProvider(string $provider): object
	{
		static::run();
		$providerName = strtolower($provider);
		static::setProvider($providerName, $provider);
		return static::$self->{$providerName};
	}

	public static function get(string $provider): object
	{
		return static::getProvider($provider);
	}
}