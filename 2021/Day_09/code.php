<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);
$map = array();

const NEIGHBOURS = [
  [-1, 0],
  [1, 0],
  [0, -1],
  [0, 1]
];

function prepareInput(array $input) {
  unset($input[count($input)-1]);
  return array_map(fn($v) => str_split($v), $input);
}

function findLowPoints(array $map)
{
  $rows = count($map);
  $cols = count($map[0]);
  $res = array();
  foreach($map as $i => $row) {
    foreach($row as $j => $n) {
      if ($n ==9)
        continue;
      $smallest = true;
      foreach(NEIGHBOURS as $neigh) {
        if(($i+$neigh[0]) == $rows || ($i+$neigh[0]) == -1 || ($j+$neigh[1]) == $cols || ($j+$neigh[1]) == -1) {
          continue;
        }
        $v = $map[$i+$neigh[0]][$j+$neigh[1]];
        if ($v < $n)
          $smallest = false;
      }
      if($smallest) {
        array_push($res, implode(',', array($n, $i, $j)));
      }
    }
  }
  return $res;
}

// Task code
function part01(array $input)
{
  $parsed = prepareInput($input);
  $lowPoints = findLowPoints($parsed);
  $tot = 0;
  foreach($lowPoints as $p) {
    $tot += (explode(',', $p)[0]+1);
  }
  return $tot;
}

function explore($i, $j, &$visited)
{
  global $map;
  $n = $map[$i][$j];
  $tot = 1;
  foreach(NEIGHBOURS as $neigh) {
    $ni = $i + $neigh[0];
    $nj = $j + $neigh[1];
    if (in_array($ni.','.$nj, $visited) || $ni < 0 || $ni == count($map) || $nj < 0 || $nj == count($map[0]))
      continue;
    if ($map[$ni][$nj] == 9)
      continue;
    array_push($visited, $ni.','.$nj);
    $tot += explore($ni, $nj, $visited);
  }
  return $tot;
}

function part02(array $input)
{
  global $map;
  $map = prepareInput($input);

  $lowPoints = findLowPoints($map);
  $tot = 0;
  $res = array();
  foreach($lowPoints as $p) {
    list($n, $i, $j) = explode(',', $p);
    $visited = array($i.','.$j);
    $size = explore($i, $j, $visited);
    array_push($res, $size);
  }
  rsort($res);
  return $res[0] * $res[1] * $res[2];
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
