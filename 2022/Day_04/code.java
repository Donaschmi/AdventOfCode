import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.Arrays;
import java.util.List;

class AdventOfCode {

    public static int part1(List<String> input)
    {
        int count = 0;
        for (String line :
                input) {
            String[] split = line.split(",");
            int[] left = Arrays.stream(split[0].split("-")).mapToInt(Integer::parseInt).toArray();
            int[] right = Arrays.stream(split[1].split("-")).mapToInt(Integer::parseInt).toArray();
            if ((left[0] >= right[0] && left[1] <= right[1]) || (left[0] <= right[0] && left[1] >= right[1]))
                count++;
        }
        return count;
    }

    public static int part2(List<String> input)
    {
        int count = 0;
        for (String line :
                input) {
            String[] split = line.split(",");
            int[] left = Arrays.stream(split[0].split("-")).mapToInt(Integer::parseInt).toArray();
            int[] right = Arrays.stream(split[1].split("-")).mapToInt(Integer::parseInt).toArray();
            if (!(left[0] > right[1] || left[1] < right[0]))
                count++;
        }
        return count;
    }

    public static void main(String[] args) throws IOException{
        List<String> input = Files.readAllLines(Paths.get("input.txt"));

        int result1 = part1(input);
        int result2 = part2(input);

        System.out.println("Solution part1: " + result1);
        System.out.println("Solution part2: " + result2);
    }

}