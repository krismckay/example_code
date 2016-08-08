<?php
/**
 * Player class definition
 *
 * Defines the Player object and provides DB interactions
 */
namespace spin;

use spin\DB;

class Player {

  var $db;

  var $player_id;
  var $name;
  var $credits;
  var $lifetime_spins;
  var $salt_value;

  /**
   * The player contructor populates the player fields if a valid ID is provided.
   *
   * @return boolean Returns false on a db error, otherwise returns true
   */ 
  function __construct($id = 0) {
  
    $db = DB::getDB();
    if(!$db) {
      return false;
    }

    if(is_int($id) && $id) {

      $dbq = $db->query("SELECT * FROM player WHERE player_id = " . (int)$id);
      if($result = $dbq->fetch_assoc()) {

        $this->player_id      = (int)$result['player_id'];
        $this->name           = $result['name'];
        $this->credits        = (int)$result['credits'];
        $this->lifetime_spins = (int)$result['lifetime_spins'];
        $this->salt_value     = $result['salt_value'];

        $result->free();
      }

    }
    return true;

  }

  /**
   * calculate the hash by running password_hash on the player's salt value
   *
   * @return string
   */
  public function calculateHash() {

    return password_hash($this->salt_value);
  
  }

  /**
   * Attempt to find a player by ID, then validate the request by checking the hash
   *
   * @param $id   int    The player_id to search
   * @param $hash string The sent hash to be compared against
   * @return mixed Return either the player object or false
   */
  static public function findByIdAndHash($id, $hash) {

    $player = new Player($id);
    if($player->id && $hash === $player->calculateHash()) {
      return $player;
    } else {
      return false;
    }

  }

  /**
   * Calculate the lifetime average return based on current credits divided by lifetime spins
   *
   * @return float
   */
  public function getLifetimeAverageReturn() {

    $average_return = $this->credits / $this->lifetime_spins;
    return number_format($average_return, 2);    

  }

  /**
   * Update the player table with the new credits count and increment the spin value
   *
   * @return boolean
   */
  public function updateFromSpin() {

    $statement = "UPDATE player SET credits = " . $this->credits . ", lifetime_spins=lifetime_spins+1 WHERE player_id = " . $this->id;
    if($db->query($statment)) {
      $this->lifetime_spins++;
      return true;
    }

    return false;

  }

}
