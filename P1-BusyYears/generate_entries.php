<?php

// manual data set
$entries = [
    [1930, 1958],
    [1965, 1994],
    [1982, 1999],
    [1913, 1964],
    [1912, 1987],
    [1945, 1991],
    [1902, 1999],
    [1939, 1982],
    [1922, 1988],
    [1924, 1958],
    [1959, 1990],
    [1968, 1977],
    [1970, 1989],
    [1977, 1966],
    [1978, 1978],
    [1963, 1999],
    [1943, 1957],
    [1933, 1988],
    [1910, 1968],
    [1934, 1976],
    [1922, 1944],
    [1977, 1967],
    [1955, 1999],
    [1940, 1989],
  ];

// auto generate a data set
$entries = [];

// generate a lot of entries to test speed
for($i=0; $i < 500; $i++) {
  $rand_s = rand(1900, 1970);
  $rand_e = rand(1930, 1999);
  if($rand_s > $rand_e) {
    $_t = $rand_e;
    $rand_e = $rand_s;
    $rand_s = $_t;
  }
  $entries[] = [$rand_s, $rand_e];
}

$i=0;
foreach($entries as $entry) {

  echo "[{$entry[0]},{$entry[1]}],";
  if($i && $i%6 == 0)
  {
    echo "\n";
    $i=-1;
  }

  $i++;

}

