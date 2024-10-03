import os
try:
    os.makedirs("basededatospython")
except:
    print("La carpeta base de datos ya existe, continuamos.....")
    
print("Bienvenidos a Mi Diario v0.2")
print("Selecciona una de las siguiente opciones")
print("1.-Introducir un nuevo registro")
print("2.-Leer registros existentes")
opcion = input("Selecciona una de las opciones anteriores:")
print("La opción que has seleccionado es:",opcion)
if opcion == "1":
    print("Has seleccionado Introducir un nuevo registro")
    archivo = open("basededatospython/diario.txt","a")
    fecha = input("Introduce la fecha del registro:")
    mensaje = input("Introduce el mensaje del registro:")
    archivo.write(fecha+"|"+mensaje+"\n")
    archivo.close()
elif opcion == "2":
    print("Has seleccionado Leer registros existentes")
    archivo = open("basededatospython/diario.txt","r")
    lineas = archivo.readlines()
    for linea in lineas:
        print(linea)
else:
    print("Opción no válida")
    