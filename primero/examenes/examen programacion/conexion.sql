import mysql.connector                  

conexion = mysql.connector.connect(
    host="localhost",           
    user="exprogramacion",        
    password="exprogramacion",   
    database="exprogramacion"    
)

cursor = conexion.cursor(dictionary = True)

peticion = "SELECT * FROM proyecto"

cursor.execute(peticion)

filas = cursor.fetchall()

print(filas)