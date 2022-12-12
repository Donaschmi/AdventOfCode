import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.*;
import java.util.stream.Stream;
import java.util.stream.StreamSupport;

class AdventOfCode {

    public static Stack<Character>[] prepareInput(List<String> input) {
        Stack<Character>[] stacks = (Stack<Character>[]) new Stack[9];
        for(int i=0; i < 9 ; i++) {
            stacks[i] = new Stack<>();
        }
        Stack<String> inputs = new Stack<>();
        for (String line:
             input) {
            if (line.charAt(1) == '1')
                break;
            inputs.push(line);
        }
        while(!inputs.isEmpty()) {
            String s = inputs.pop();
            for(int i=0; i < 9 ; i++) {
                char c = s.charAt((i*4)+1);
                if (c != ' ') {
                    stacks[i].push(c);
                }
            }
        }
        return stacks;
    }

    public static String part1(List<String> input)
    {
        Stack<Character>[] stacks = prepareInput(input);
        boolean doNothing = true;
        for (String line:
                input) {
            if (doNothing) {
                doNothing = line.compareTo("") != 0;
                continue;
            }
            String[] split = line.split(" ");

            for(int i = 0; i<Integer.parseInt(split[1]); i++) {
                char c = stacks[Integer.parseInt(split[3])-1].pop();
                stacks[Integer.parseInt(split[5])-1].push(c);
            }
        }

        return Stream.of(stacks)
                .map(Stack::peek).map(Object::toString).reduce("", String::concat);
    }

    public static String part2(List<String> input)
    {
        Stack<Character>[] stacks = prepareInput(input);
        boolean doNothing = true;
        for (String line:
                input) {
            if (doNothing) {
                doNothing = line.compareTo("") != 0;
                continue;
            }
            String[] split = line.split(" ");
            Stack<Character> list= new Stack<>();
            for(int i = 0; i<Integer.parseInt(split[1]); i++) {
                char c = stacks[Integer.parseInt(split[3])-1].pop();
                list.push(c);
            }
            while(!list.isEmpty()){
                stacks[Integer.parseInt(split[5])-1].push(list.pop());
            }
        }

        return Stream.of(stacks)
                .map(Stack::peek).map(Object::toString).reduce("", String::concat);
    }

    public static void main(String[] args) throws IOException{
        List<String> input = Files.readAllLines(Paths.get("input.txt"));

        String result1 = part1(input);
        String result2 = part2(input);

        System.out.println("Solution part1: " + result1);
        System.out.println("Solution part2: " + result2);
    }
}