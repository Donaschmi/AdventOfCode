<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input)
{
  $grid = array(array());
  foreach ($input as $line) {
    if($line == '') {
      continue;
    }
    $points = explode(' -> ', $line);
    $points = array_map(fn($v): array => explode(',', $v), $points);
    sort($points);
    list($p1, $p2) = $points;
    list($x1 , $y1) = $p1;
    list($x2 , $y2) = $p2;
    if ($x1 == $x2) {
      foreach(range($y1, $y2) as $y) {
        $curr = $grid[$x1][$y]; 
        $grid[$x1][$y] = $curr ? $curr+1 : 1; // Ugly but prevents from zero-ing the array
      }
    }
    if ($y1 == $y2) {
      foreach(range($x1, $x2) as $x) {
        $curr = $grid[$x][$y1]; 
        $grid[$x][$y1] = $curr ? $curr+1 : 1; // Ugly but prevents for zero-ing the array
      }
    }
  }
  $sum = 0;
  foreach($grid as $row) {
    $sum += count(array_filter($row, fn($v): bool => $v>1));
  }
  return $sum;
}

function part02(array $input)
{
  $grid = array(array());
  foreach ($input as $line) {
    if($line == '') {
      continue;
    }
    $points = explode(' -> ', $line);
    $points = array_map(fn($v): array => explode(',', $v), $points);
    sort($points);
    list($p1, $p2) = $points;
    list($x1 , $y1) = $p1;
    list($x2 , $y2) = $p2;
    if ($x1 == $x2) {
      foreach(range($y1, $y2) as $y) {
        $curr = $grid[$x1][$y]; 
        $grid[$x1][$y] = $curr ? $curr+1 : 1; // Ugly but prevents from zero-ing the array
      }
    }
    else if ($y1 == $y2) {
      foreach(range($x1, $x2) as $x) {
        $curr = $grid[$x][$y1]; 
        $grid[$x][$y1] = $curr ? $curr+1 : 1; // Ugly but prevents for zero-ing the array
      }
    }
    else if ($y1-$y2 == $x1-$x2) {
      foreach(range(0, $x2-$x1) as $i) {
        $curr = $grid[$x1+$i][$y1+$i]; 
        $grid[$x1+$i][$y1+$i] = $curr ? $curr+1 : 1; // Ugly but prevents for zero-ing the array
      }
    }
    else if ($y1-$y2 == $x2-$x1) {
      foreach(range(0, $x2-$x1) as $i) {
        $curr = $grid[$x1+$i][$y1-$i]; 
        $grid[$x1+$i][$y1-$i] = $curr ? $curr+1 : 1; // Ugly but prevents for zero-ing the array
      }
    
    }
  }
  $sum = 0;
  foreach($grid as $row) {
    $sum += count(array_filter($row, fn($v): bool => $v>1));
  }
  return $sum;
}

// Execute
calcExecutionTime();
$result01 = @part01($input);
$result02 = @part02($input);
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
