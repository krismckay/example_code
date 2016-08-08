<?php
/**
 * Problem 1 - Given a list of people with their birth and end years
 * (all between 1900 and 2000), find the year with the most number of people alive.
 *
 * This method results in heavy memory requirements in order to store the intersections.
 *
 * @author  Kris McKay
 * @version 1
 */

//include_once("./generate_entries.php");
include_once("./data.php");

echo "started...\n";
$start = microtime(true);

// pull the list of intersections
$intersections = pullIntersections($entries);

// map and reduce intersection years to the most popular
$most_popular_years = reduceIntersectionsToYear($intersections);

$end = microtime(true);
$diff = $end - $start;

print_r($most_popular_years);
echo "\nCompleted in {$diff} seconds\n";


##################################################
############ FUNCTION DEFINITIONS ################

/**
 * Finds the intersections of all given date ranges
 *
 * @param $entries array Multi-dimensional array providing a series of birth/death years
 * @return array
 */
function pullIntersections($entries)
{
  $intersections = [];

  // loop through the birth/death ranges
  $stopInner = count($entries);
  $stopOuter = $stopInner-1;
  for($i = 0; $i < $stopOuter; $i++) {

    // split out the ranges
    list($entry_lower, $entry_upper) = $entries[$i];

    // test intersection of each
    for($j = $i+1; $j < $stopInner; $j++) {

      // split out the ranges
      list($compare_lower, $compare_upper) = $entries[$j];

      // check if the current date intersects with the current boundary
      if($entry_upper > $compare_lower)
      {
        $intersections[] = [max($entry_lower, $compare_lower), min($entry_upper, $compare_upper)];
      }
    }

  }

  unset($entries);

  return $intersections;
}

/**
 * Reduce the intersections to yaer counters
 *
 * @param $intersections array Multi-dimensional array providing a series of birth/death years
 * @return array
 */
function reduceIntersectionsToYear($intersections)
{
  // used to store year counters
  $years = [];

  // explode each of the year ranges and increment a tally
  foreach($intersections as $intersection) {
    // split out the ranges
    list($entry_lower, $entry_upper) = $intersection;
    for($i=$entry_lower; $i<=$entry_upper; $i++) {
      @$years[$i]++;
    }
  }

  // sort by array value in reverse
  arsort($years);

  // let's pull all the tied-for-top years
  do {
    $top_years[] = key($years);
    $count = current($years);
    next($years);
  } while($count && current($years) == $count);
  sort($top_years);

  // cleanup
  unset($years, $intersections);

  // return the most popular years
  return $top_years;
  
}

?>
