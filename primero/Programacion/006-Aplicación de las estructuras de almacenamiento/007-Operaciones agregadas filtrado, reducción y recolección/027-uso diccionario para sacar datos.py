"""
la base de datos a sido creada en la carpeta raiz del proyecto
con el nombre de empresa.db.



    Programa agenda con SQLite
    (c) 2024 por Francisco Jose Herreros Rodriguez
    v0.1 -- Primeras pruebas con SQLite

"""

import sqlite3                                    # importo la libreria sqlite3

conexion = sqlite3.connect('empresa.db')          # creo la conexion
conexion.row_factory = sqlite3.Row                # Cambio el formato de salida a diccionario
cursor = conexion.cursor()                        # creo el cursor

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
   
        cursor.execute(f'''
            INSERT INTO clientes
            VALUES (
                NULL,
                "{nombre}",
                "{apellidos}",
                "{email}",
                "{direccion}"
            );
        ''')                                              # Inserto un registro nuevo                                                        

        conexion.commit()                                 # confirmo la transaccion
    
        print("Tu registro se ha insertado correctamente en la base de datos")
        input("Pulsa una tecla para continuar....")   
   
   
   
    elif opcion == "2":                            # si la opcion es 2
        print("Vamos a listar los registros")      # imprimo un mensaje
        cursor.execute('''
            SELECT * FROM clientes;
        ''')                                       # Ejecuto una petición de seleccion                                            
        filas = cursor.fetchall()                  # Almaceno el resultado en una lista                                    
        resultado = [dict(fila) for fila in filas] # Cambio el formato de salida a diccionario
        for fila in resultado:                     # Proceso la lista elemento a elemento                                    
            
            print("--------------") 
            print(fila['nombre'])   # Imprimo el elemento
            print(fila['apellidos']) # Imprimo el elemento
            print(fila['email'])     # Imprimo el elemento
            print(fila['direccion']) # Imprimo el elemento
            
        print("Listado correctamente devuelto.")
        input("Pulsa una tecla para continuar....")   
    
    elif opcion == "3":                            # si la opcion es 3
        print("Vamos a actualizar un registro")    # imprimo un mensaje
        identificador = input("Indica el registro que quieres actualizar (id):")  # pido el identificador del registro a actualizar
        nombre = input("Introduce un nuevo nombre:")                # pido el nombre
        apellidos = input("Introduce nuevos apellidos:")            # pido los apellidos
        email = input("Introduce un nuevo email:")                  # pido el email
        direccion = input("Introduce una nueva direccion:")         # pido la direccion

        cursor.execute(f'''
            UPDATE clientes
            SET
            nombre = '{nombre}',
            apellidos = '{apellidos}',
            email = '{email}',
            direccion = '{direccion}'
            WHERE Identificador = {identificador};
        ''')                                                           # Actualizo un registro                                                  

        conexion.commit()                                             # confirmo la transaccion
    
        print("Actualización correcta.")
        input("Pulsa una tecla para continuar....")
    
    
    
    
    elif opcion == "4":                            # si la opcion es 4
        print("Vamos a eliminar un registro")      # imprimo un mensaje 
        identificador = input("Indica el registro que quieres eliminar (id):")  # pido el identificador del registro a eliminar
        cursor.execute(f'''
            DELETE FROM clientes
            WHERE Identificador = {identificador};
        ''')                                        # Elimino un registro nuevo

        conexion.commit()                           # confirmo la transaccion
        print("Eliminación correcta.")               # imprimo un mensaje
        input("Pulsa una tecla para continuar....")    # espero a que el usuario pulse una tecla  

conexion.close()                            # cierro la conexion