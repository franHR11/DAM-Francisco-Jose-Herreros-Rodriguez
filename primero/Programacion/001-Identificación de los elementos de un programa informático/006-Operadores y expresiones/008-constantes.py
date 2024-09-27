NOMBRE_DEL_PROGRAMA = "programa calculadora"
VERSION = "0.1"
AUTOR = "Francisco Jose Herreros Rodriguez"
print(NOMBRE_DEL_PROGRAMA,VERSION,AUTOR)

operando1 = input("introduce el primer operando: ")
operando2 = input("introduce el segundo operando: ")
operador = input ("introduce el operador (+,-,*,/): ")

operando1 = int (operando1)
operando2 = int (operando2)

if operador == "+":
    resultado = operando1 + operando2
elif operador == "-":
    resultado = operando1 - operando2
elif operador == "*":
    resultado = operando1 * operando2
elif operador == "/":
    resultado = operando1 / operando2


print("El resultado de la operacion es : ",resultado)
