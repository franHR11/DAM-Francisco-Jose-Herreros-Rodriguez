from suma import suma
from resta import resta
from multiplicacion import multiplicacion
from division import division


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