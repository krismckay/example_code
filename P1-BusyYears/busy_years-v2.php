<?php
/**
 * Problem 1 - Given a list of people with their birth and end years
 * (all between 1900 and 2000), find the year with the most number of people alive.
 *
 * A nominal optimization could be made to adjust the bounds from the set range to the 
 * earliest birth year and latest death year given.
 *
 * @author  Kris McKay
 * @version 2
 */

#include_once("./generate_entries.php");
include_once("./data.php");

echo "started...\n";
$start = microtime(true);

// count ages per year
$most_popular_years = entriesToYear($entries);

$end = microtime(true);
$diff = $end - $start;

print_r($most_popular_years);
echo "\nCompleted in {$diff} seconds\n";


##################################################
############ FUNCTION DEFINITIONS ################


/**
 * Loops through a given year range and tests against age entries
 *
 * @param $entries array Multi-dimensional array providing a series of birth/death years
 * @param $start int First year of test range
 * @param $end int Last year of test range
 * @return array
 */
function entriesToYear($entries, $start=1900, $end=2000)
{
  // used to store year counters
  $years = [];

  // loop through the target years
  for($i = $start; $i <= $end; $i++) {

    // initialialive year counter
    $years[$i] = 0;

    // loop through entries
    foreach($entries as $entry) {

        list($entry_lower, $entry_upper) = $entry;
        if($entry_lower <= $i && $entry_upper >= $i) {
          $years[$i]++;
        }

    }

  }

  // sort by array value in reverse
  arsort($years);

  do {
    $top_years[] = key($years);
    $count = current($years);
    next($years);
  } while(current($years) == $count);

  unset($years, $intersections);
  sort($top_years);

  // return the most popular years
  return $top_years;
  
}

?>