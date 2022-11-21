<?php

/**
 * @package Banner\Provider
 */

namespace Banner;

use Banner\Enum\Providers;

class Provider {
	/**
	* Singleton self object
	* @var static self $self
	*/
	private static self $self;
	
	private function __construct()
	{
		//
	}

	/**
	* Initialization all provider packets
	* @return void
	*/
	private static function run(): void
	{
		if(empty(static::$self)) {
			static::$self = new static;
			static::$self->allProviders = Providers::cases();
		}
	}

	/**
	* Get provider class via provider name
	* @param string $provider
	* @return string
	*/
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

	/**
	* Set provider via name
	* @param string $providerName
	* @param string $provider
	* @return void
	*/
	private static function setProvider(string $providerName, string $provider): void
	{
		if(!isset(static::$self->{$providerName})) {
			$providerClass = static::getProviderClass($provider);
			static::$self->{$providerName} = new $providerClass;
		}
	}

	/**
	* Get provider via name
	* @param string $provider
	* @return object
	*/
	private static function getProvider(string $provider): object
	{
		static::run();
		$providerName = strtolower($provider);
		static::setProvider($providerName, $provider);
		return static::$self->{$providerName};
	}

	/**
	* Get provider object
	* @param string $provider
	* @return object
	*/
	public static function get(string $provider): object
	{
		return static::getProvider($provider);
	}
}