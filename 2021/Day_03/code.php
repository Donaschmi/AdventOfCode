<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input)
{
  $tot = count($input);
  $l = strlen($input[0]);
  $result = array_map(function($v) use ($tot){ 
      return $v >= $tot/2 ? 1 : 0;
    }, array_reduce(
      array_map(fn($v): array => str_split($v), $input), 
      function($carry, $item) {
        foreach($item as $k => $v)
          $carry[$k] = $v + ($carry[$k] ?? 0);
        return $carry;
      }, []
    )
  );
  $gamma = bindec(implode("", $result));
  return $gamma * ($gamma ^ (int) bindec(str_repeat('1', $l)));
}

function rating(array $in, bool $bit) {
  $n = 0;
  $tot = $len = count($in);
  while ($len > 1) {
    $sum = array_sum(array_column($in, $n));
    $keep = (($sum >= $len/2) ^ !$bit);
    $in = array_filter($in, fn($v) => $v[$n] == $keep);
    $len = count($in);
    $n++;
  }
  return implode("", current($in));
}

function part02(array $input)
{
  $input = array_map(fn($v) => str_split(trim($v)), $input);
  $o2 = rating($input, 1);
  $co2 = rating($input, 0);
  return bindec($o2) * bindec($co2);
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
