<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__, "\n\n");

function parseInput(array $input): array 
{
  $new_input = array();
  $new_input["numbers"] = explode(',', $input[0]);
  foreach($input as $k => $v) {
    if ($k == 0)
      continue;
    $new_input["grids"][$k]["grid"] = array_map(fn ($i): array => explode(' ', str_replace('  ', ' ', trim($i))), explode(PHP_EOL, $v));
    $new_input["grids"][$k]["row"] = $new_input["grids"][$k]["col"] =  array_fill(0, 5, 0);
    $new_input["grids"][$k]["marked"] = array_fill(0, 5, array_fill(0, 5, 0));
  }
  return $new_input;
}

function sumUnmarked(array $grid): int 
{
  $sum = 0;
  foreach(range(0, 4) as $i) {
    foreach(range(0, 4) as $j) {
      $sum += $grid["marked"][$i][$j] == 0 ? $grid["grid"][$i][$j] : 0;
    }
  }
  return $sum;
}

// Task code
function part01(array $input)
{
  $parsed = parseInput($input);
  foreach ($parsed["numbers"] as $n) {
    foreach ($parsed["grids"] as $k => $grid) {
      foreach (range(0, 4) as $r) {
        if (is_int($key = array_search($n, $grid["grid"][$r]))) {
          $parsed["grids"][$k]["col"][$key] += 1;
          $parsed["grids"][$k]["row"][$r] += 1;
          $parsed["grids"][$k]["marked"][$r][$key] = 1;
          if (is_int(array_search(5, $parsed["grids"][$k]["col"])) || is_int(array_search(5, $parsed["grids"][$k]["row"]))) {
            return sumUnmarked($parsed["grids"][$k]) * $n;
          }
          break;
        }
      }
    }
  }
}

function part02(array $input)
{
  $parsed = parseInput($input);
  foreach ($parsed["numbers"] as $n) {
    foreach ($parsed["grids"] as $k => $grid) {
      foreach (range(0, 4) as $r) {
        if (is_int($key = array_search($n, $grid["grid"][$r]))) {
          $parsed["grids"][$k]["col"][$key] += 1;
          $parsed["grids"][$k]["row"][$r] += 1;
          $parsed["grids"][$k]["marked"][$r][$key] = 1;
          if (is_int(array_search(5, $parsed["grids"][$k]["col"])) || is_int(array_search(5, $parsed["grids"][$k]["row"]))) {
            if (count($parsed["grids"]) == 1) {
              return sumUnmarked(current($parsed["grids"])) * $n;
            }
            // Remove board
            unset($parsed["grids"][$k]);
          }
          break;
        }
      }
    }
  }
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
