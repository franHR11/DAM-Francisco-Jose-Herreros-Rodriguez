#comentario

def suma(operando1,operando2): 
    return operando1 + operando2  
def resta(operando1,operando2): 
    return operando1 - operando2 
def multiplicacion(operando1,operando2): 
    return operando1 * operando2
def division(operando1,operando2): 
    return operando1 / operando2



def calcula(operando1,operando2,operacion):
    resultado = None
    if operacion == "suma":
        resultado = suma(operando1,operando2)
    elif operacion == "resta":
        resultado = resta(operando1,operando2)
    elif operacion == "multiplicacion":
        resultado = multiplicacion(operando1,operando2)
    elif operacion == "division":
        resultado = division(operando1,operando2)

    return resultado

print(calcula(4,3,"suma"))