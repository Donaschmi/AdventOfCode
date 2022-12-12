<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

$letters = array(
);

// Task code
function part01(array $input)
{
  $count = 0;
  foreach($input as $line) {
    $output = explode(' ', explode(' | ', $line)[1]);
    foreach($output as $digit) {
      if (in_array(strlen($digit), array(2,3,4,7))) {
        $count++;
      }
    }
  }
  return $count;
}

function part02(array $input)
{

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
