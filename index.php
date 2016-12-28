<?php

/*
 * Define path constants
*/
define('APPLICATION', dirname(__FILE__) . '/application/');
define('CORE', dirname(__FILE__) . '/application/core/');

/*
 * Start out application from rounting process
 */
require CORE . 'route.php';