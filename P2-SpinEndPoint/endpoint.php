<?php
/**
 * This is the endpoint file for spin results to be posted to.
 */

// define the basepath for use in the autoloader
define('BASEPATH', realpath(dirname(__FILE__)));

// setup a new endpoint and run it
$endpoint = new spin\SpinEndpoint();
$endpoint->run();

/**
 * Provide the autoloading of namespaced class files
 */
function __autoload($class)
{
  if(!class_exists($class) && strpos($class, '\\') !== false) {
    require_once(BASEPATH . '/src/' . str_replace('\\', '/', $class) . '.php');
  }
}
