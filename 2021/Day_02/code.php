<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input)
{
  $x = $y = 0;
  foreach($input as $v){
    list($dir, $dist) = explode(' ', $v);
    switch ($dir) {
      case 'forward':
        $x += $dist;
        break;
      case 'up':
        $y -= $dist;
        break;
      case 'down':
        $y += $dist;
        break;
      default:
        break;
    }
  }
  return $x * $y;
}

function part02(array $input)
{
  $x = $y = $aim= 0;
  foreach($input as $v){
    list($dir, $dist) = explode(' ', $v);
    switch ($dir) {
      case 'forward':
        $x += $dist;
        $y += $dist * $aim;
        break;
      case 'up':
        $aim -= $dist;
        break;
      case 'down':
        $aim += $dist;
        break;
      default:
        break;
    }
  }
  return $x * $y;
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
