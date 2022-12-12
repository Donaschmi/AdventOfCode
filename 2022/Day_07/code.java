import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.*;

class AdventOfCode {

    private static class Directory {
        private final Directory parent;
        private final Map<String, Directory> children;
        private final Map<String, Integer> files;
        int size;


        public Directory(String name) {
            this(name, null);
        }

        public Directory(String name, Directory parent) {
            this.parent = parent;
            this.children = new HashMap<>();
            this.files = new HashMap<>();
            this.size = 0;
        }

        public void addSize(int size) {
            this.size += size;
            if (parent != null) {
                parent.addSize(size);
            }
        }
    }

    public static int totalScore(Directory root) {
        if (root.size < 100000){
            if (root.children.size() == 0) {
                return root.size;
            } else {
                return root.children.values().stream().map(AdventOfCode::totalScore).reduce(root.size, Integer::sum);
            }
        } else {
            if (root.children.size() == 0) {
                return 0;
            } else {
                return root.children.values().stream().map(AdventOfCode::totalScore).reduce(0, Integer::sum);
            }
        }
    }

    public static Directory parse(List<String> input) {
        Directory root =  new Directory("/");
        Directory current = root;
        for (String s :
                input) {
            if (s.charAt(0) == '$') {
                if (s.substring(2,4).compareTo("cd") == 0) {
                    if (s.substring(5).compareTo("..") == 0) {
                        current = current.parent;
                    } else {
                        String dirname = s.substring(5);
                        if(!current.children.containsKey(dirname)) {
                            current.children.put(dirname, new Directory(dirname, current));
                        }
                        current = current.children.get(dirname);
                    }
                }
            } else {
                String[] split = s.split(" ");
                if (split[0].compareTo("dir") == 0) {
                    current.children.put(split[1], new Directory(split[1], current));
                } else {
                    current.files.put(split[1], Integer.valueOf(split[0]));
                    current.addSize(Integer.parseInt(split[0]));
                }
            }
        }
        return root;
    }

    public static int part1(List<String> input)
    {
        Directory root =  parse(input);
        return totalScore(root);
    }

    public static int smallest(Directory root, int toDelete) {
        if (root.size >= toDelete) {
            if (root.children.size() == 0) {
                return root.size;
            } else {
                return Math.min(root.size, root.children.values().stream().map(directory -> smallest(directory, toDelete)).min(Comparator.naturalOrder()).get());
            }
        } else {
            if (root.children.size() == 0) {
                return Integer.MAX_VALUE;
            } else {
                return root.children.values().stream().map(directory -> smallest(directory, toDelete)).min(Comparator.naturalOrder()).get();
            }
        }
    }

    public static int part2(List<String> input)
    {
        Directory root =  parse(input);
        int toDelete = 30000000 - (70000000 - root.size);
        return smallest(root, toDelete);
    }

    public static void main(String[] args) throws IOException{
        List<String> input = Files.readAllLines(Paths.get("input.txt"));

        int result1 = part1(input);
        int result2 = part2(input);

        System.out.println("Solution part1: " + result1);
        System.out.println("Solution part2: " + result2);
    }
}