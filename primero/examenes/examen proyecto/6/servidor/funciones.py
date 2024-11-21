import mysql.connector  

conexion = mysql.connector.connect(
    host="localhost",           
    user="examenproyecto",        
    password="examenproyecto",   
    database="examenproyecto"   
)                                                       # Me conecto a la base de datos

def seleccionaProyecto():
    cursor = conexion.cursor(dictionary = True)             # Creo un cursor y me aseguro de que la info me viene en JSON
    peticion = "SELECT * FROM proyecto"                    # Pido todo de capitulos
    cursor.execute(peticion)                                # Ejecuto la peticion
    filas = cursor.fetchall()                               # Saco las filas
    return filas   

def seleccionaproyecto(Identificador):
    try:
        Identificador = int(Identificador)
        cursor = conexion.cursor(dictionary = True)             # Creo un cursor y me aseguro de que la info me viene en JSON
        peticion = f"SELECT * FROM proyecto WHERE Identificador = {Identificador}"                    # Pido todo de capitulos
        cursor.execute(peticion)                                # Ejecuto la peticion
        filas = cursor.fetchall()                               # Saco las filas
        if filas != []:
            return filas                                            # Imprimo las filas
        else:
            return False
    except:
        return False

def insertaProyecto(Titulo,Texto,Imagen):
        cursor = conexion.cursor(dictionary = True)                 # Creo un cursor y me aseguro de que la info me viene en JSON
        peticion = f"""
        INSERT INTO proyecto
        VALUES (
            NULL,
            '{Titulo}',
            '{Texto}',
            '{Imagen}'
        )"""                                                    # Inserto un nuevo capítulo
        cursor.execute(peticion)                                # Ejecuto la peticion
        filas = cursor.fetchall()                               # Saco las filas
        conexion.commit()
        return True

def eliminaProyecto(Identificador):
    cursor = conexion.cursor(dictionary = True)                 # Creo un cursor y me aseguro de que la info me viene en JSON
    peticion = f"""
    DELETE FROM proyecto
    WHERE Identificador = {Identificador}
    """     
    cursor.execute(peticion)                                # Ejecuto la peticion
    filas = cursor.fetchall()                               # Saco las filas
    conexion.commit()
    return True

def actualizaCampo(cadena,valor,Identificador):
    cursor = conexion.cursor(dictionary = True) 
    peticion = f"""
        UPDATE proyecto
        SET 
            {cadena} = '{valor}'
                
        WHERE
        Identificador = {Identificador};
        """                                                    # Inserto un nuevo capítulo
    cursor.execute(peticion)                                # Ejecuto la peticion
    filas = cursor.fetchall()                               # Saco las filas
    print(filas)                                            # Imprimo las filas
    conexion.commit()
        
def actualizaProyecto(Identificador,Titulo,Texto,Imagen):
                        # Creo un cursor y me aseguro de que la info me viene en JSON
    if Titulo != "":
        actualizaCampo("Titulo",Titulo,Identificador)
    if Texto != "":
        actualizaCampo("Texto",Texto,Identificador)
    if Imagen != "":
        actualizaCampo("Imagen",Imagen,Identificador)
    return True

            