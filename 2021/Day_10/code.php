<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

const MATCHES = [
  ')' => ['(', 3, 1], 
  ']' => ['[', 57, 2], 
  '}' => ['{', 1197, 3],
  '>' => ['<', 25137, 4], 
];

const REVERSED_MATCHES = [
  '(' => ')',
  '[' => ']',
  '<' => '>',
  '{' => '}'
];

// Task code
function part01(array $input)
{
  $score = 0;
  foreach($input as $k=>$line) {
    if ($line == '')
      continue;
    $stack = array();
    $found = false;
    foreach(str_split($line) as $c) {
      if ($found) {
        break;
      }
      if(MATCHES[$c] ?? false) {
        if (count($stack) == 0) {
          $score += MATCHES[$c][1];
          $found = true;
        } else {
          $item = array_pop($stack);
          if ($item != MATCHES[$c][0]) {
            $score += MATCHES[$c][1];
            $found  = true;
          }
        }
      } else {
       array_push($stack, $c); 
      }
    }
  }

  return $score;
}

function part02(array $input)
{
  $score = 0;
  foreach($input as $k=>$line) {
    if ($line == '')
      continue;
    $stack = array();
    $found = false;
    foreach(str_split($line) as $c) {
      if ($found) {
        unset($input[$k]);
        break;
      }
      if(MATCHES[$c] ?? false) {
        if (count($stack) == 0) {
          $found = true;
        } else {
          $item = array_pop($stack);
          if ($item != MATCHES[$c][0]) {
            $found  = true;
          }
        }
      } else {
       array_push($stack, $c); 
      }
    }
    if (!$found) {
      $input[$k] = $stack;
    }
  }
  unset($input[102]);
  foreach($input as $k => $remaining) {
    $tot = 0;  
    foreach(array_reverse($remaining) as $c) {
      $tot *= 5;
      $tot += MATCHES[REVERSED_MATCHES[$c]][2];
    }
    $input[$k] = $tot;
  }
  sort($input);
  return $input[count($input)/2];
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
