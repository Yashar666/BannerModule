<?php

/**
 * @package Banner\Providers
 */

namespace Banner;

use Banner\Config\EnvConfig;
use Banner\Session\PhpSession;

enum Providers: string {
	case CONFIG = EnvConfig::class;
	case SESSION = PhpSession::class;
}