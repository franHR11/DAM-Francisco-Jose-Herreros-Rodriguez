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
    opcion = input("Escoge una opcion:")

    if opcion == "1":
        cursor = conexion.cursor(dictionary = True)                              # Creo un cursor y me aseguro de que la info me viene en JSON
        peticion = "SELECT * FROM proyecto"                                      # Pido todo de proyecto
        cursor.execute(peticion)                                                 # Ejecuto la peticion
        filas = cursor.fetchall()                                                # Saco las filas
        print(filas)                                                             # Imprimo las filas
    elif opcion == "2":
        cursor = conexion.cursor(dictionary = True)                              # Creo un cursor y me aseguro de que la info me viene en JSON
        Titulo = input("Introduce el Titulo del proyecto:")
        Texto = input("Introduce el texto del proyecto:")
        Imagen = input("Introduce el Imagen del proyecto:")
        peticion = f"""
        INSERT INTO capitulos
        VALUES (
            NULL,
            '{Titulo}',
            '{Texto}',
            '{Imagen}',
        )"""                                                                      # Pido todo de el proyecto
        cursor.execute(peticion)                                                  # Ejecuto la peticion
        filas = cursor.fetchall()                                                 # Saco las filas
        print(filas)                                                              # Imprimo las filas
        conexion.commit()