<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

function map(array $lines) {
  $res = array();
  $sum = 0;
  foreach($lines as $line) {
    if (strlen($line) == 0) {
      array_push($res, $sum);
      $sum = 0;
    }
    $sum += (int) $line;
  }
  return $res;
}

// Task code
function part01(array $input)
{
  return max(map($input));
}

function part02(array $input)
{
  $mapped = map($input);
  rsort($mapped);
  return array_sum(array_chunk($mapped, 3)[0]);
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
