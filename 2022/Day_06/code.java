import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.Arrays;
import java.util.List;
import java.util.stream.Collectors;

class AdventOfCode {

    public static int soluce(String s, int n) {
        for (int i=0; i<s.length()-n; i++) {
            String ss = s.substring(i, i+n);
            if ( Arrays.asList(ss.split(""))
                    .stream()
                    .distinct()
                    .collect(Collectors.joining()).length() == n) {
                return i+n;
            }
        }
        return 0;
    }

    public static int part1(List<String> input)
    {
        return soluce(input.get(0), 4);
    }

    public static int part2(List<String> input)
    {
        return soluce(input.get(0), 14);
    }

    public static void main(String[] args) throws IOException{
        List<String> input = Files.readAllLines(Paths.get("input.txt"));

        int result1 = part1(input);
        int result2 = part2(input);

        System.out.println("Solution part1: " + result1);
        System.out.println("Solution part2: " + result2);
    }
}