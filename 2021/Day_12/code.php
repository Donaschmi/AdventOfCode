<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);
$paths = [];

function prepareInput(array $input): array {
  $caves = array();
  foreach($input as $line) {
    list($src, $dest) = explode('-', $line);
    if (!array_key_exists($src, $caves)) {
      $caves[$src] = [];
    }
    if (!array_key_exists($dest, $caves)) {
      $caves[$dest] = [];
    }
    if ($src != 'start') {
      $caves[$dest][] = $src;
    }
    if ($dest != 'start') {
      $caves[$src][] = $dest;
    }
  }
  return $caves;
}

function explore($cave, $adj, $path, $twice=false) {
  if ($cave == "end") {
    return 1;
  }
  if (ctype_lower($cave) && in_array($cave, $path)) {
    if (!$twice) {
      return 0;
    }
    $twice = false;
  }

  $path[] = $cave;
  $count = 0;

  foreach($adj[$cave] as $dest) {
    $count += explore($dest, $adj, $path, $twice);
  }
  return $count;
}

// Task code
function part01(array $input)
{
  $adj = prepareInput($input);
  $count = 0;
  foreach($adj['start'] as $to) {
   $count += explore($to, $adj, ['start']);
  }
  return $count;
}

function part02(array $input)
{
  $adj = prepareInput($input);
  $count = 0;
  foreach($adj['start'] as $to) {
   $count += explore($to, $adj, ['start'], true);
  }
  return $count;
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
