<?php

define('BASE_PATH', realpath(dirname(__FILE__)));
use spin\SpinEndpoint;

$endpoint = new SpinEndpoint();
$endpoint->run();

function __autoload($class)
{
  if(!class_exists($class) && strpos($class, '\\') !== false) {
    $filename = BASE_PATH . '/src/' . str_replace('\\', '/', $class) . '.php';
    require_once($filename);
  }

}
