<?php // DAY08

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

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

function findUniqueNumbers($input)
{
  $ret = array_fill(0, 10, '');
  foreach($input as $number) {
    $len = strlen($number);
    if ($len == 2) {
      $ret[1] = $number;
    } else if ($len == 3) {
      $ret[7] = $number;
    } else if ($len == 4) {
      $ret[4] = $number;
    } else if ( $len == 7) {
      $ret[8] = $number;
    }
  }
  return $ret;
}

function sortStrings(array $input)
{
  $ret = array();
  foreach($input as $v) {
    $stringArray = str_split($v);
    sort($stringArray);
    array_push($ret, implode($stringArray));
  }
  return $ret;
}

function intersect(string $is, string $of)
{
  return count(array_intersect(str_split($is), str_split($of)));
}

function part02(array $input)
{
  $count = 0;
  foreach($input as $line) {
    list($in,$out) = explode(' | ', $line);
    $exploded = sortStrings(explode(' ', $in));
    $numbers = findUniqueNumbers($exploded);
    $fiveSeg = array_filter($exploded, fn($v) => strlen($v) == 5);
    $sixSeg = array_filter($exploded, fn($v) => strlen($v) == 6);
    $numbers[3] = current(array_filter($fiveSeg, fn($v) => intersect($v, $numbers[1]) == 2));
    $fiveSeg = array_filter($fiveSeg, fn($v) => $v != $numbers[3]);
    $numbers[6] = current(array_filter($sixSeg, fn($v) => intersect($v, $numbers[1]) == 1));
    $sixSeg = array_filter($sixSeg, fn($v) => $v != $numbers[6]);
    $numbers[0] = current(array_filter($sixSeg, fn($v) => intersect($v, $numbers[4]) == 3));
    $numbers[9] = current(array_filter($sixSeg, fn($v) => $v != $numbers[0]));
    $numbers[2] = current(array_filter($fiveSeg, fn($v) => intersect($v, $numbers[9]) == 4));
    $numbers[5] = current(array_filter($fiveSeg, fn($v) => $v != $numbers[2] && $v != $numbers[3]));
    $out_exploded = sortStrings(explode(' ', $out));
    for ($i=0; $i<4; $i++) {
      $count += pow(10, 3-$i) * array_search($out_exploded[$i], $numbers);
    }
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
