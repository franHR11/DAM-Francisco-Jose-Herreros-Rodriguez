def division(dividendo,divisor):
    if divisor == 0:
        return False
    else:
        return True

for i in range(0,100):
    for j in range(0,100):
        print(division(i,j))