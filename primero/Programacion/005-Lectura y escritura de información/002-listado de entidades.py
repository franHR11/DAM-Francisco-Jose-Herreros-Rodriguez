import mysql.connector

connection = mysql.connector.connect(
    host='localhost',   
    user='empresa',   
    password='empresa',
    database='empresa' 
)

cursor = connection.cursor(dictionary=True)

print("Programa de gestión de empresa v0.1")
print("por Francisco Jose Herreros Rodriguez")

print("Selecciona una tabla de la base de datos:")

peticion = "SHOW TABLES;"
cursor.execute(peticion)