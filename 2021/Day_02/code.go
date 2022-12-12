package main

import (
	"advent-of-code/helper"
	"fmt"
	"path"
	"runtime"
	"strconv"
	"strings"
	"time"
)

func main() {
	_, f, _, _ := runtime.Caller(0)
	cwd := path.Join(path.Dir(f))

	input := helper.ReadInput(cwd, helper.NewLine)
	iValues := input.Strings()

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
			helper.TestingValue{Result: result01, Expect: 1561344},
			helper.TestingValue{Result: result02, Expect: 1848454425},
		},
	)
}

// Task code
func part01(input []string) int {
	x, y := 0, 0
	for _, v := range input {
		s := strings.Split(v, " ")
		n, _ := strconv.Atoi(s[1])
		switch s[0] {
		case "forward":
			x += n
			break
		case "up":
			y -= n
			break
		case "down":
			y += n
			break
		}
	}
	return x * y
}

func part02(input []string) int {
	x, y, aim := 0, 0, 0
	for _, v := range input {
		s := strings.Split(v, " ")
		n, _ := strconv.Atoi(s[1])
		switch s[0] {
		case "forward":
			x += n
			y += n * aim
			break
		case "up":
			aim -= n
			break
		case "down":
			aim += n
			break
		}
	}
	return x * y
}
