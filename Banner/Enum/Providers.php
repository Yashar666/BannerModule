<?php

/**
 * @package Banner\Enum\Providers
 */

namespace Banner\Enum;

use Banner\Config\EnvConfig;
use Banner\Session\{PhpSession, CookieSession};
use Banner\Database\{PdoDatabase, Model};

/**
* Enum list for Providers
* @var string{CONFIG, SESSION, DB, MODEL, COOKIE} Providers
*/
enum Providers: string {
	case CONFIG = EnvConfig::class;
	case SESSION = PhpSession::class;
	case DB = PdoDatabase::class;
	case MODEL = Model::class;
	case COOKIE = CookieSession::class;
}