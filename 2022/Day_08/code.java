import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.Arrays;
import java.util.List;

class AdventOfCode {

    public static int part1(List<String> input)
    {

        int length = input.size();
        int[][] array = new int[length][length];
        for (int i = 0; i < input.size(); i++) {
            array[i] = Arrays.stream(input.get(i).split("")).map(Integer::parseInt).mapToInt(value -> (int) value).toArray();
        }
        for (int i = 1; i < input.size()-1; i++) {
            for (int j = 1; j < input.size()-1; j++) {
                // Left

            }
        }
        return array[2][2];
    }

    public static int part2(List<String> input){
        return 0;
    }

    public static void main(String[] args) throws IOException{
        List<String> input = Files.readAllLines(Paths.get("input.txt"));

        int result1 = part1(input);
        int result2 = part2(input);

        System.out.println("Solution part1: " + result1);
        System.out.println("Solution part2: " + result2);
    }
}