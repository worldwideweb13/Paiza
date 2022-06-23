# ８進数から１０進数への変換 

N = int(input())


def judge_ten(n):
    return check_seven(n)
    
def judge_eight(n):
    eight_n = ""
    while n > 0:
        eight_n = str(n % 8) + eight_n
        n //= 8
    return check_seven(eight_n)
    
def check_seven(n):
    return True if "7" in str(n) else False

ans = 0
for n in range(1,N + 1):
    if judge_ten(n) or judge_eight(n):
        continue
    ans += 1

print(ans)