<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

function init(string $input): array 
{
  $byDays = array_fill(0, 9, 0);
  foreach(explode(',', $input) as $day) {
    $byDays[$day]++;
  }
  return $byDays;
}

function countFishes(array $school, int $days) {
  foreach(range(0, $days-1) as $day) {
    foreach($school as $day => $fishes) {
      if ($day == 0) {
        $school[0] = 0;
        $school[6] += $fishes;
        $school[8] += $fishes;
      } 
      else {
        $school[$day] -= $fishes;
        $school[$day-1] += $fishes;
      }
    }
  }
  return array_sum($school);
}

// Task code
function part01(array $input)
{
  return countFishes(init($input[0]), 80);
}

function part02(array $input)
{
  return countFishes(init($input[0]), 256);
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
