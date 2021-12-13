<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

function prepareInput(array $input) {
  $paper = array();
  $instructions = array();
  foreach ($input as $line) {
    if (substr($line, 0, 1) == 'f') {
      list($d, $v) = explode('=', explode(' ', $line)[2]);
      $instructions[] = ['dir'=>$d, 'val'=>$v];
    } 
    else if ($line == ""){
      continue;
    }
    else {
      list($x, $y) = explode(',', $line);
      if (!isset($paper[$y])) {
        $paper[$y] = [];
      }
      $paper[$y][$x] = 1;
    }
  }
  return [$paper, $instructions];
}

function fold(array &$paper, $dir, $val) {
  if ($dir == 'x') {
    foreach($paper as $y => $row) {
      foreach($row as $x => $v) {
        if ($x < $val) {
          continue;
        }
        $new_x = $val - ($x-$val);
        $paper[$y][$new_x] = $v;
        unset($paper[$y][$x]);
      }
    }
  }
  else {
    foreach($paper as $y => $row) {
      if ($y < $val) {
        continue;
      }
      $new_y = $val - ($y-$val);
      if (!isset($paper[$new_y])) {
        $paper[$new_y] = [];
      }
      foreach($row as $x => $v) {
        $paper[$new_y][$x] = $v;
      }
      unset($paper[$y]);
    }
  }
}

// Task code
function part01(array $input)
{
  list($paper, $instructions) = prepareInput($input);
  fold($paper, $instructions[0]['dir'], $instructions[0]['val']);
  return array_sum(array_map(fn($v) => array_sum($v),$paper));
}

function part02(array $input)
{
  list($paper, $instructions) = prepareInput($input);
  foreach($instructions as $k => $instr) {
    fold($paper, $instr['dir'], $instr['val']);
  }
  $code = array_fill(0,6, array_fill(0, 40, '.'));
  foreach($paper as $y => $row) {
    foreach ($row as $x => $v) {
      $code[$y][$x] = '#';
    }
  }
  print_r(array_map(fn($v) => implode($v), $code));
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
