'''
Hola Jose Vicente, en visual studio code la carpeta la crea en la raiz, dentro de la carpeta
DAM,para que puedas verla.dentro de la carpeta basededatospython se crea el archivo diario.txt

'''
import os                                                           # Importamos la librería que nos permite interactuar con el sistema operativo
try:                                                                # Intento realizar una operacion
    os.makedirs("basededatospython")                                # Intento crear la carpeta de base de datos
except:                                                             # en el caso de que no pueda
    print("La carpeta base de datos ya existe, continuamos.....")   # No des error y solo contina
    
print("Bienvenidos a Mi Diario v0.2")                               # imprimo un mensaje de bienvenida
while True:                                                         # Bucle infinito             
    print("Selecciona una de las siguiente opciones")               # informo al usuario de que va a tener que elegir una opcion
    print("1.-Introducir un nuevo registro")                        # Opcion 1
    print("2.-Leer registros existentes")                           # Opcion 2 
    opcion = input("Selecciona una de las opciones anteriores:")    # Atrapo su opción elegida y la meto en una variable
    print("La opción que has seleccionado es:",opcion)              # Imprimo la opción elegida
    
    if opcion == "1":                                               # Si es cierto que el usuario ha cogido la opcion 1
        print("Has seleccionado Introducir un nuevo registro")      # Le informo de que ha cogido la opcion 1
        archivo = open("basededatospython/diario.txt","a")          # # Abro la base de datos en modo añadir
        fecha = input("Introduce la fecha del registro:")           # Le pido la fecha
        mensaje = input("Introduce el mensaje del registro:")       # Le pido el mensaje
        archivo.write(fecha+"|"+mensaje+"\n")                       # Escribo la fecha y el mensaje en el archivo  
        archivo.close()                                             # Y cierro la base de datos
    elif opcion == "2":                                             # Si es cierto que el usuario ha cogido la opcion 2
        print("Has seleccionado Leer registros existentes")         # Le informo de que ha cogido la opcion 2
        archivo = open("basededatospython/diario.txt","r")          # Cargo la base de datos en modo lectura
        lineas = archivo.readlines()                                # Cargo las lineas del archivo
        for linea in lineas:                                        # Separo las lineas en lineas independientes
            print(linea)                                            # Imprimo las lineas una a una
    else:                                                           # En el caso de que ninguna opcion sea la correcta
        print("Opción no válida")                                   # Le aviso al usuario de que no ha escogido una opcion correcta
    