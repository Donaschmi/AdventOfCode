import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.List;

class AdventOfCode {

    public static int valueOf(String shape) {
        if (shape.compareTo("A") * shape.compareTo("X") == 0) {
            return 1;
        }
        else if (shape.compareTo("B") * shape.compareTo("Y") == 0) {
            return 2;
        }
        else {
            return 3;
        }
    }

    public static int score(String his, String mine) {
        int s1 = valueOf(his);
        int s2 = valueOf(mine);
        if (s1 == s2) {
            return 3 + s2;
        }
        else if (s2 - s1 == 1 || s2 - s1 == -2) {
            return 6 + s2;
        }
        return s2;
    }

    public static int part1(List<String> input)
    {
        int sum = 0;
        for (String line :
                input) {
            String[] split = line.split(" ");
            sum += score(split[0], split[1]);
        }
        return sum;
    }

    public static int part2(List<String> input)
    {
        int sum = 0;
        for (String line :
                input) {
            String[] split = line.split(" ");
            int his = valueOf(split[0]);
            int mine = valueOf(split[1]);
            if (mine == 1) {
                if (his == 1) {
                    sum += 3;
                } else {
                    sum += ((his - 1) % 3);
                }
            } else if(mine == 2) {
                sum += (his+3);
            } else {
                if (his == 2) {
                    sum += 9;
                } else {
                    sum += (((his + 1) % 3) + 6);
                }
            }
        }
        return sum;
    }

    public static void main(String[] args) throws IOException {
        List<String> input = Files.readAllLines(Paths.get("input.txt"));

        int result1 = part1(input);
        int result2 = part2(input);

        System.out.println("Solution part1: " + result1);
        System.out.println("Solution part2: " + result2);
    }
}