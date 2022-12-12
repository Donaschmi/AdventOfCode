<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

function prepareInput(array $input): array {
  $caves = array();
  foreach($input as $line) {
    list($src, $dest) = explode('-', $line);
    if (array_key_exists($src, $caves)) {
      array_push($caves[$src], $dest);
    } else {
      $caves[$src] = array($dest);
    }
    if (array_key_exists($dest, $caves)) {
      array_push($caves[$dest], $src);
    } else {
      $caves[$dest] = array($src);
    }
  }
  return $caves;
}

function explore($cave, $adj, $visited, $twice=false, $twiceValue = '') {
  if ($cave == 'end') {
    return 1;
  }
  $count = 0;
  if (ctype_lower($cave) && $cave != 'start' && $cave != 'end') {
    if ($twice && $twiceValue == '') {
      $count += explore($dest, $adj, $visited, $twice, $cave);
    }
    else {
      array_push($visited, $cave);
    }
  }
  foreach($adj[$cave] as $dest) {
    if (!in_array($dest, $visited)) {
      $count += explore($dest, $adj, $visited);
    }
  }
  return $count;
}

// Task code
function part01(array $input)
{
  $adj = prepareInput($input);
  return explore('start', $adj, ['start']);
}

function part02(array $input)
{
  $adj = prepareInput($input);
  //return explore('start', $adj, [], $true);
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
