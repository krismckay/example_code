<?php
/**
 * SpinEndpoint class definition
 *
 * This class defines a SpinEndpoint object capable of updating a player spin result.
 */
namespace spin;

use spin\Player;

class SpinEndpoint {

  /**
   * Run executes the attempt to process the incoming data and sends output to the client
   */
  public function run() {

    $incoming_params = $_POST;
    if(!$this->validateInput($incoming_params)) {
      $this->sendError("Posted data does not validate.");
    }

    $player = spin\Player::findByIdAndHash($incoming_params['player_id'], $incoming_params['hash']);
    if(!$player) {
      $this->sendError("Unknown player");
    }

    $player->credits += ($incoming_params['coins_won'] - $incoming_params['coins_bet']);

    if(!$player->updateFromSpin()) {
      $this->sendError("There was a problem updating this player.");
    }
    
    $returnData = [
      'player_id'               =>  $player->id,
      'name'                    =>  $player->name,
      'credits'                 =>  $player->credits,
      'lifetime_spins'          =>  $player->lifetime_spins,
      'lifetime_average_return' =>  $player->getLifetimeAverageReturn(),
    ];
    $this->sendResponse($returnData);

  }

  /**
   * Validate the incoming parameters against their expected patterns
   *
   * @param $params array
   * @return boolean
   */
  private function validateInput($params) {

    $expectedValues = [
      'hash'  =>  '/^[0-9a-z]{32}$/',
      'coins_won'  =>  '/^\d+$/',
      'coins_bet'  =>  '/^\d+$/',
      'player_id'  =>  '/^\d+$/',
    ];

    foreach($expectedValues as $var=>$type) {

      if(!isset($params[$var]) || !preg_match($type, $params[$var])) {
        return false;
      }
      return true;

    }

  }

  /**
   * Sends an error message, or if no message is given defaults to "Unknown error"
   *
   * @param $message string
   */
  private function sendError($message = "") {

    if(!$message) $message = "Unknown error";

    $this->sendResponse(['message' => $message]);

  }

  /**
   * Sends a provided response to the client in JSON format
   *
   * @param $params array
   */
  private function sendResponse($params) {

    header('Content-Type: application/json');
    echo json_encode($params);
    die;

  }

}
