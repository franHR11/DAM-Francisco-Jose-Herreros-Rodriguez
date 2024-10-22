def division(dividendo,divisor):
    try:
        if divisor == 0:
            return True
        else:
            return True
    except:
        return False

pasas = True

for i in range(0,100):
    for j in range(0,100):
        if division(i,j) == False:
            pasas = False
            print("i:",i,"j:",j)

if pasas == True:
    print("prueba superada")
else:
    print("prueba no superada")

