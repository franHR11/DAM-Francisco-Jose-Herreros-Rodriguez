def calcula(aaa,bbb,operacion):
    resultado = None
    if operacion == "suma":
        resultado = aaa + bbb
    elif operacion == "resta":
        resultado = aaa - bbb
    elif operacion == "multiplicacion":
        resultado = aaa * bbb
    elif operacion == "division":
        resultado = aaa / bbb

    return resultado

print(calcula(4,3,"suma"))