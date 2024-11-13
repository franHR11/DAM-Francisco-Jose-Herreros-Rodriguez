from operaciones.opera.suma import suma
from operaciones.opera.resta import resta
from operaciones.opera.multiplicacion import multiplicacion
from operaciones.opera.division import division


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