'''
programa que permite listar, insertar, actualizar
y eliminar registros de una tabla de una base de datos MySQL.

'''

#################### IMPORTACION DE LIBRERIAS ####################                  

import mysql.connector                                  # Importo el conector de MySQL


#################### CONEXION A LA BASE DE DATOS ####################

conexion = mysql.connector.connect(
    host="localhost",           
    user="exprogramacion",        
    password="exprogramacion",   
    database="exprogramacion"   
)                                                       # Me conecto a la base de datos

#################### FUNCIONES ####################

def seleccionar():
    cursor = conexion.cursor(dictionary = True)             # Creo un cursor y me aseguro de que la info me viene en JSON
    peticion = "SELECT * FROM proyecto"                    # Pido todo de proyecto
    cursor.execute(peticion)                                # Ejecuto la peticion
    filas = cursor.fetchall()                               # Saco las filas
    return filas 

def insertaProyecto():
    cursor = conexion.cursor(dictionary = True)                                                      # Creo un cursor y me aseguro de que la info me viene en JSON
    Titulo = input("Introduce el Titulo del proyecto:")                                             # Le pido un nuevo Titulo al usuario
    Texto = input("Introduce el texto del proyecto:")                                               # Le pido un nuevo Texto al usuario
    Imagen = input("Introduce la Imagen del proyecto:")                                             # Le pido un nuevo Imagen al usuario
    peticion = f"""
        INSERT INTO proyecto
        VALUES (
            NULL,
            '{Titulo}',
            '{Texto}',
            '{Imagen}'
        )"""                                                                                        # Pido todo de el proyecto
    cursor.execute(peticion)                                                                        # Ejecuto la peticion
    filas = cursor.fetchall()                                                                       # Saco las filas
    print(filas)                                                                                    # Imprimo las filas
    return True

def eliminaProyecto():
    cursor = conexion.cursor(dictionary = True)                                                     # Creo un cursor y me aseguro de que la info me viene en JSON
    Identificador = input("Introduce el Identificador del proyecto a eliminar:")                    # Le pido un nuevo Titulo al usuario
    peticion = f"""
    DELETE FROM proyecto
    WHERE Identificador = {Identificador}
    """     
    cursor.execute(peticion)                                                                        # Ejecuto la peticion
    filas = cursor.fetchall()                                                                       # Saco las filas
    print(filas)                                                                                    # Imprimo las filas
    return True

def actualizaProyecto():
    
    cursor = conexion.cursor(dictionary = True)                                                     # Creo un cursor y me aseguro de que la info me viene en JSON
    Identificador = input("Introduce el Identificador del proyecto a actualizar:")
    Titulo = input("Introduce el nuevo Titulo del proyecto (en blanco para no modificar):")         # Le pido un nuevo Titulo al usuario
    Texto = input("Introduce el nuevo Texto del proyecto (en blanco para no modificar):")           # Le pido un nuevo Subtitulo al usuario
    Imagen = input("Introduce la nuevo Imagen del proyecto (en blanco para no modificar):")         # Le pido una nueva Imagen al usuario    
    if Titulo != "":
        peticion = f"""
        UPDATE proyecto
        SET 
            Titulo = '{Titulo}'
            
        WHERE
        Identificador = {Identificador};
        """                                                    # Inserto un nuevo proyecto
        cursor.execute(peticion)                                # Ejecuto la peticion
        filas = cursor.fetchall()                               # Saco las filas
        print(filas)                                            # Imprimo las filas
        conexion.commit()
    if Texto != "":
        peticion = f"""
        UPDATE proyecto
        SET 
            Texto = '{Texto}'
            
        WHERE
        Identificador = {Identificador};
        """                                                    # Inserto un nuevo proyecto
        cursor.execute(peticion)                                # Ejecuto la peticion
        filas = cursor.fetchall()                               # Saco las filas
        print(filas)                                            # Imprimo las filas
        conexion.commit()
    if Imagen != "":
        peticion = f"""
        UPDATE proyecto
        SET 
            Imagen = '{Imagen}'
            
        WHERE
        Identificador = {Identificador};
        """                                                    # Inserto un nuevo proyecto
        cursor.execute(peticion)                                # Ejecuto la peticion
        filas = cursor.fetchall()                               # Saco las filas
        print(filas)                                            # Imprimo las filas
        conexion.commit()
    if  Identificador == "":
        print("No has introducido un Identificador")
    return True
    
    
            #################### BUCLE PRINCIPAL ####################
while True:
    print("Escoge una opcion")
    print("1.-Listar los Proyectos")
    print("2.-Insertar un Proyectos")
    print("3.-Actualizar un registro")
    print("4.-Eliminar un registro")
    print("5.-Cerrar el programa")
    opcion = input("Escoge una opcion:")

            #################### SELECCION DE OPCIONES ####################

    if opcion == "1":                                               # Si la opcion es 1
        print(seleccionar())                                        # Imprimo las filas
    elif opcion == "2":                                             # Si la opcion es 2
        print(insertaProyecto())                                    # Inserto un nuevo proyecto
    elif opcion == "3":                                             # Si la opcion es 3
        print(actualizaProyecto())                                  # Actualizo un proyecto
    elif opcion == "4":                                             # Si la opcion es 4
         print(eliminaProyecto())                                   # Elimino un proyecto
    elif opcion == "5":                                              # Si la opcion es 5
        conexion.close()                                            # Cierro la conexion
        break                                                       # Salgo del bucle

                #################### FIN DEL PROGRAMA ####################

print("El programa ha finalizado")                                  # Imprimo que el programa ha finalizado  
    