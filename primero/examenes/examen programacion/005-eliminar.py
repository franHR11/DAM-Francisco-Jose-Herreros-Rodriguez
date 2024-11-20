import mysql.connector                                  # Importo el conector de MySQL

conexion = mysql.connector.connect(
    host="localhost",           
    user="exprogramacion",        
    password="exprogramacion",   
    database="exprogramacion"   
)                                                       # Me conecto a la base de datos

while True:
    print("Escoge una opcion")
    print("1.-Listar los Proyectos")
    print("2.-Insertar un Proyectos")
    print("3.-Eliminar un registro")
    print("4.-Actualizar un registro")
    opcion = input("Escoge una opcion:")

    if opcion == "1":
        cursor = conexion.cursor(dictionary = True)                              # Creo un cursor y me aseguro de que la info me viene en JSON
        peticion = "SELECT * FROM proyecto"                                      # Pido todo de proyecto
        cursor.execute(peticion)                                                 # Ejecuto la peticion
        filas = cursor.fetchall()                                                # Saco las filas
        print(filas)                                                             # Imprimo las filas
    elif opcion == "2":
        cursor = conexion.cursor(dictionary = True)                              # Creo un cursor y me aseguro de que la info me viene en JSON
        Titulo = input("Introduce el Titulo del proyecto:")                      # Le pido un nuevo Titulo al usuario
        Texto = input("Introduce el texto del proyecto:")                        # Le pido un nuevo Texto al usuario
        Imagen = input("Introduce el Imagen del proyecto:")                      # Le pido un nuevo Imagen al usuario
        peticion = f"""
        INSERT INTO proyecto
        VALUES (
            NULL,
            '{Titulo}',
            '{Texto}',
            '{Imagen}'
        )"""                                                                      # Pido todo de el proyecto
        cursor.execute(peticion)                                                  # Ejecuto la peticion
        filas = cursor.fetchall()                                                 # Saco las filas
        print(filas)                                                              # Imprimo las filas
        conexion.commit()
    elif opcion == "3":
        cursor = conexion.cursor(dictionary = True)                                          # Creo un cursor y me aseguro de que la info me viene en JSON
        Identificador = input("Introduce el Identificador del proyecto a eliminar:")         # Le pido un nuevo Titulo al usuario
        peticion = f"""
        DELETE FROM proyecto
        WHERE Identificador = {Identificador}
        """     
        cursor.execute(peticion)                                # Ejecuto la peticion
        filas = cursor.fetchall()                               # Saco las filas
        print(filas)                                            # Imprimo las filas
        conexion.commit()
    elif opcion == "4":
        cursor = conexion.cursor(dictionary = True)                 # Creo un cursor y me aseguro de que la info me viene en JSON
        Identificador = input("Introduce el Identificador del capítulo a actualizar:")
        Titulo = input("Introduce el nuevo Titulo del capítulo (en blanco para no modificar):")         # Le pido un nuevo Titulo al usuario
        Texto = input("Introduce el nuevo Subtitulo del capítulo (en blanco para no modificar):")   # Le pido un nuevo Subtitulo al usuario
        Imagen = input("Introduce el nuevo Imagen del capítulo (en blanco para no modificar):")         # Le pido un nuevo Imagen al usuario    
        peticion = f"""
        UPDATE capitulos
        SET 
            Titulo = '{Titulo}',
            Texto  = '{Texto}',
            Imagen = '{Imagen}'
        WHERE
        Identificador = {Identificador}
        """                                                    # Inserto un nuevo capítulo
        cursor.execute(peticion)                                # Ejecuto la peticion
        filas = cursor.fetchall()                               # Saco las filas
        print(filas)                                            # Imprimo las filas
        conexion.commit()    
    