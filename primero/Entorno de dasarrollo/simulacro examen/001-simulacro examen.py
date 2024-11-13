def calcula(aaa,bbb,operacion):
    ccc = None
    if operacion == "suma":
        ccc = aaa + bbb
    elif operacion == "resta":
        ccc = aaa - bbb
    elif operacion == "multiplicacion":
        ccc = aaa * bbb
    elif operacion == "division":
        ccc = aaa / bbb

    return ccc

print(calcula(4,3,"suma"))