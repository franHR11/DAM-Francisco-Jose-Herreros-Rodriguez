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
    