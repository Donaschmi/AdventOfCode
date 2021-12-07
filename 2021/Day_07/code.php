<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__, ',');

// Task code
function part01(array $input)
{
  return min(array_map(function ($v) use ($input){
    return array_sum(array_map(function ($c_r_a_b_o_i_d_b_e_r_g) use ($v) {
      return abs($c_r_a_b_o_i_d_b_e_r_g - $v);
    }, $input));
  }, range(min($input), max($input)))
  );
}

function part02(array $input)
{
  return min(array_map(function ($v) use ($input){
    return array_sum(array_map(function ($c_r_a_b_o_i_d_b_e_r_g) use ($v) {
      return (abs($c_r_a_b_o_i_d_b_e_r_g - $v) * (abs($c_r_a_b_o_i_d_b_e_r_g - $v )+1)) / 2;
    }, $input));
  }, range(min($input), max($input)))
  );
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
