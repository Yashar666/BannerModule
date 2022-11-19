<?php
/**
 * @author Jafar Sharifov <sharifov@programmer.net>
 */

// Turn strick mode 
declare(strict_types = 1);

use Banner\Banner;

// Turn Errors
ini_set('display_errors', '1');
error_reporting(E_ALL);


// Load used classes automatically
spl_autoload_register(function($class) {
    include_once(str_replace('\\', '/', $class) . '.php');
});
 
new Banner;
