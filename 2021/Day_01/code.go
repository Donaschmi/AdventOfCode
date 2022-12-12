package main

import (
	"advent-of-code/helper"
	"fmt"
	"path"
	"runtime"
	"time"
)

func main() {
	_, f, _, _ := runtime.Caller(0)
	cwd := path.Join(path.Dir(f))

	input := helper.ReadInput(cwd, helper.NewLine)
	iValues := input.Ints()

	// Execute
	start := time.Now()
	result01 := part01(iValues)
	result02 := part02(iValues)
	executionTime := helper.ExecutionTime(time.Since(start))

	fmt.Printf("Solution Part 1: %v\n", result01)
	fmt.Printf("Solution Part 2: %v\n", result02)
	fmt.Printf("Execution time: %s\n", executionTime)

	helper.SaveBenchmarkTime(executionTime, cwd)

	// Testing
	helper.TestResults(
		[]helper.TestingValue{
			helper.TestingValue{Result: result01, Expect: 1502},
			helper.TestingValue{Result: result02, Expect: 1538},
		},
	)
}

// Task code
func part01(input []int) (count int) {
  var prev int
  for i, value := range input {
    if i == 0 {
      prev = value
    } else {
      if value > prev {
        count ++
      }
      prev = value
    }
  }
  return 
}

func part02(input []int) (count int) {
  for i, value := range input {
    if i == 0 || i == 1 || i == 2 {
      continue
    }
    if value > input[i-3] {
      count ++
    }
  }
  return
}
