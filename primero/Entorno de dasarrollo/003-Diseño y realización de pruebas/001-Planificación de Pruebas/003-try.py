def division(dividendo,divisor):
    try:
        if divisor == 0:
            return True
        else:
            return dividendo/divisor
    except:
        return False


for i in range(0,100):
    for j in range(0,100):
        print(division(i,j))