'''
programa calculadora primer tema de clase
(c) 2024 Francisco Jose Herreros Rodriguez
Este programa esta hecho con python
'''
# Introducion / presentacion
NOMBRE_DEL_PROGRAMA = "programa calculadora"
VERSION = "0.1"
AUTOR = "Francisco Jose Herreros Rodriguez"
print(NOMBRE_DEL_PROGRAMA,VERSION,AUTOR)

# Toma de datos

operando1 = input("introduce el primer operando: ")
operando2 = input("introduce el segundo operando: ")
operador = input ("introduce el operador (+,-,*,/): ")

# Conversion de tipos

operando1 = int (operando1)
operando2 = int (operando2)

# Toma de decisiones y realizacion de calculos

if operador == "+":
    resultado = operando1 + operando2
elif operador == "-":
    resultado = operando1 - operando2
elif operador == "*":
    resultado = operando1 * operando2
elif operador == "/":
    resultado = operando1 / operando2       

# Ofrecer resultados

print("El resultado de la operacion es : ",resultado)
