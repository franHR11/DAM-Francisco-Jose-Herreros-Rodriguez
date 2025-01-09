primero = input("Ingrese el primer número: ")

try:
    primero = int(primero)
except:
    primero = 'chanchito feliz' 
    
if primero == 'chanchito feliz':
    print("Ingresaste mal un número, por favor ingresa un número")    
    exit()       

segundo = input("Ingrese el segundo número: ")

if segundo == 'chanchito feliz':
    print("Ingresaste mal un número, por favor ingresa un número")    
    exit()   

try:
    segundo = int(segundo)
except:
    segundo = 'chanchito feliz'  
    
if primero == 'chanchito feliz' or segundo == 'chanchito feliz':
    print("Ingresaste mal un número, por favor ingresa un número")      
else:
    suma = primero + segundo
    print("La suma de los dos números es:", suma)