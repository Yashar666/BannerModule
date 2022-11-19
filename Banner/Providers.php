<?php

/**
 * @package Banner\Providers
 */

namespace Banner;

use Banner\Config\EnvConfig;

enum Providers: string {
	case CONFIG = EnvConfig::class;
}