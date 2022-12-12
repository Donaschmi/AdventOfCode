# day10
matching = {")":"(",
            ">":"<",
            "}":"{",
            "]":"[" }
points = {  ")": 3,
            "]": 57,
            "}": 1197,
            ">": 25137}
auto_complete = {
    "(": 1 ,
    "[": 2 ,
    "{": 3 ,
    "<": 4
}
with open("day10.txt") as f :
    data = f.read()
errors = {char:0 for char in matching.keys()}
acscores = []
for line in data.strip().split("\n"):
    opened   = {char:0 for char in matching.values()}
    last_opened = ['x']
    for char in line :
        if char in matching.values() :
            opened[char] += 1
            last_opened.append(char)
        else :
            if last_opened[-1] == matching[char] and opened[matching[char]] >= 1:
                opened[matching[char]] -= 1
                last_opened = last_opened[:-1]
            else :
                print(f"{char}")
                errors[char] += 1
                break
    else:
        acscore = 0
        while last_opened[-1] != 'x' :
            acscore*=5
            acscore+=auto_complete[last_opened[-1]]
            last_opened = last_opened[:-1]
        acscores.append(acscore)
cnt = sum(n*points[char] for char,n in errors.items())
print(cnt)
print(sorted(acscores))
print(sorted(acscores)[len(acscores)//2])
