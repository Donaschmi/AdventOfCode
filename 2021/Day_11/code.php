<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);
$parsed = array();

const NEIGHBOURS = [
  [0, 1],   // S
  [0, -1],  // N
  [1, 1],   // SE
  [-1, -1], // NW
  [1, 0],   // E
  [-1, 0],  // W
  [1, -1],  // NE
  [-1, 1]   // SW
];

function spread($i, $j, &$exploded) {
  global $parsed;
  if($parsed[$i][$j] == 9) {
    $parsed[$i][$j] = 0;
    array_push($exploded, $i.','.$j);
    $count = 1;
    foreach (NEIGHBOURS as $neigh) {
      $ni = $i + $neigh[0];
      $nj = $j + $neigh[1];
      if ($ni < 0 || $ni == 10 || $nj < 0 || $nj == 10) {
        continue;
      }
      $count += spread($ni, $nj, $exploded);
    }
    return $count;
    //propagate
  } 
  else if (in_array($i.','.$j, $exploded)) {
    return 0;
  }
  else {
    $parsed[$i][$j] += 1;
    return 0;
  }
}

// Task code
function part01(array $input)
{
  global $parsed;
  $parsed = array_map(fn($v) => str_split($v), $input);
  $count = 0;
  foreach(range(0, 99) as $ite) {
    $exploded = array();
    foreach ($parsed as $i => $line) {
      foreach ($line as $j => $v) {
        $count += spread($i, $j, $exploded);
      }
    }
  }
  return $count;
}

function part02(array $input)
{
  global $parsed;
  $parsed = array_map(fn($v) => str_split($v), $input);
  foreach(range(0, 1000) as $ite) {
    $exploded = array();
    foreach ($parsed as $i => $line) {
      foreach ($line as $j => $v) {
        spread($i, $j, $exploded);
      }
    }
    if (count($exploded) == 100) {
      return $ite + 1;
    }
  }
  return 0;
}

// Execute
calcExecutionTime();
$result01 = part01($input);
$result02 = part02($input);
$executionTime = calcExecutionTime();

writeln('Solution Part 1: ' . $result01);
writeln('Solution Part 2: ' . $result02);
writeln('Execution time: ' . $executionTime);

saveBenchmarkTime($executionTime, __DIR__);

// Task test
testResults(
    [], // Expected
    [$result01, $result02], // Result
);
