# Code Example: Problem 1

## Description
Given a list of people with their birth and end years (all between 1900 and 2000), find the year with the most number of people alive.

## Note
These scripts require at least PHP v5.4 as I use the short array syntax.

There are 2 versions I've included here:

1. The first version (busy_years-v1.php) identifies the intersections of years, followed by counting the individual year instances within the intersections.
2. The second version (busy_years-v2.php) simply loops through the provided year range (1900-2000) and for each year checks the given year entries for a match.

I've used an example data set of 500 entries to test.

## Output
The output for each of the versions is the same however the script timer would show a a different run speed:

    started...
    Array
    (
      [0] => 1949
    )

    Completed in 0.0085690021514893 seconds

## Conclusions
Version 1 uses much more memory on the example data set and runs slower, however this method should be more efficient if there were a smaller data set spread over a much longer period of time.

Version 2 comparably runs very fast and can handle a much larger data set within the provided parameters, however would be very inefficient given a small data set spread over a longer period of time.
