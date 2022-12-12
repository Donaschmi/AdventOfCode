import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.List;

class AdventOfCode {

    public static int score(char c) {
        int a = (int) c - 96;
        return a < 0 ? a + 58 : a;
    }

    public static int part1(List<String> input)
    {
        List<Character> chars = new ArrayList<>();
        for (String line :
                input) {
            final int mid = line.length() / 2; //get the middle of the String
            String[] parts = {line.substring(0, mid),line.substring(mid)};
            for (char c :
                    parts[0].toCharArray()) {
                if (parts[1].indexOf(c) != -1) {
                    chars.add(c);
                    break;
                }
            }
        }
        return chars.stream().map(AdventOfCode::score).reduce(0, Integer::sum);
    }

    public static int part2(List<String> input)
    {
        List<Character> chars = new ArrayList<>();
        List<String> lines = new ArrayList<>();
        for (String line :
                input) {
            lines.add(line);
            if (lines.size() == 3) {
                for (char c :
                        lines.get(0).toCharArray()) {
                    if (lines.get(1).indexOf(c) != -1 && lines.get(2).indexOf(c) != -1) {
                        chars.add(c);
                        break;
                    }
                }
                lines = new ArrayList<>();
            }
        }
        return chars.stream().map(AdventOfCode::score).reduce(0, Integer::sum);
    }

    public static void main(String[] args) throws IOException{
        List<String> input = Files.readAllLines(Paths.get("input.txt"));

        int result1 = part1(input);
        int result2 = part2(input);

        System.out.println("Solution part1: " + result1);
        System.out.println("Solution part2: " + result2);
    }
}