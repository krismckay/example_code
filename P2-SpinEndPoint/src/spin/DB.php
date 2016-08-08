<?php
/**
 * Database class definition
 *
 * Defines a MySQLi database class 
 */
namespace spin;

class DB {

  static $db = null;
  var $connect_errno = 0;

  /**
   * The constructor function attempts to setup a connection to the DB
   *
   * @return mixed Retuns either a mysqli connection handle or false on failure
   */
  public function __construct() {
    if($this::$db !== null) {
      return $this::$db;
    } else {
      if($config = parse_ini_file(dirname(__FILE__)."/config.ini"))
      {
        $this::$db = new \mysqli(
          $config['db_host'],
          $config['db_user'],
          $config['db_pass'],
          $config['db_name'],
          $config['db_port']
        );
        $this->connect_errno = $this::$db->connect_errno;
      } else {
        $this->connect_errno = 2002;
      }
      return $this::$db;
    }
  }

  /**
   * The getDB static function allows for a quick way to return a DB connection handle
   *
   * @return mixed Retuns either a mysqli connection handle or false on failure
   */
  static public function getDB() {
    $db = new DB();
    return $db::$db;
  }

}
