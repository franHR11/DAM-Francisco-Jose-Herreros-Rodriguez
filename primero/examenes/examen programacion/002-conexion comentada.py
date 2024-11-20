import mysql.connector                                  # Importo el conector de MySQL

conexion = mysql.connector.connect(
    host="localhost",           
    user="exprogramacion",        
    password="exprogramacion",   
    database="exprogramacion"   
)                                                       # Me conecto a la base de datos

cursor = conexion.cursor(dictionary = True)             # Creo un cursor y me aseguro de que la info me viene en JSON
peticion = "SELECT * FROM proyecto"                    # Pido todo de proyecto
cursor.execute(peticion)                                # Ejecuto la peticion
filas = cursor.fetchall()                               # Saco las filas
print(filas)                                            # Imprimo las filas