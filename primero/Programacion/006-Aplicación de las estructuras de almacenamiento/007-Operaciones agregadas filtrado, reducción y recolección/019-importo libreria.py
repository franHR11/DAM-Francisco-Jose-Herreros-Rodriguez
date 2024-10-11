"""
la base de datos a sido creada en la carpeta raiz del proyecto
con el nombre de empresa.db.



    Programa agenda con SQLite
    (c) 2024 por Francisco Jose Herreros Rodriguez
    v0.1 -- Primeras pruebas con SQLite

"""

import sqlite3                                    # importo la libreria sqlite3


print("############################")
print("       Programa agenda       ")
print(" por Francisco Jose Herreros")
print("############################")

while True:                                        # inicio un bucle infinito
    print("Menú principal")                        # imprimo el menu
    print("1.-Crear un nuevo registro")            # imprimo las opciones   
    print("2.-Listado de registros")               # imprimo las opciones
    print("3.-Actualización de registros")         # imprimo las opciones
    print("4.-Eliminación de registros")           # imprimo las opciones

    opcion = input("Selecciona una opcion:")       # pido una opcion

    if opcion == "1":                              # si la opcion es 1
        print("Vamos a insertar un registro")      # imprimo un mensaje 
        nombre = input("Introduce tu nombre:")                  # pido el nombre
        apellidos = input("Introduce tus apellidos:")            # pido los apellidos
        email = input("Introduce tu email:")                    # pido el email
        direccion = input("Introduce tu direccion:")            # pido la direccion 
    elif opcion == "2":                            # si la opcion es 2
        print("Vamos a listar los registros")      # imprimo un mensaje
    elif opcion == "3":                            # si la opcion es 3
        print("Vamos a actualizar un registro")    # imprimo un mensaje
    elif opcion == "4":                            # si la opcion es 4
        print("Vamos a eliminar un registro")      # imprimo un mensaje 
