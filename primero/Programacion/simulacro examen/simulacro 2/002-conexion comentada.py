import mysql.connector                                  # Importo el conector de MySQL

conexion = mysql.connector.connect(
    host="localhost",           
    user="examenprogramacion",        
    password="examenprogramacion",   
    database="examenprogramacion"    
)                                                       # Me conecto a la base de datos

cursor = conexion.cursor(dictionary = True)             # Creo un cursor y me aseguro de que la info me viene en JSON
peticion = "SELECT * FROM capitulos"                    # Pido todo de capitulos
cursor.execute(peticion)                                # Ejecuto la peticion
filas = cursor.fetchall()                               # Saco las filas
print(filas)                                            # Imprimo las filas