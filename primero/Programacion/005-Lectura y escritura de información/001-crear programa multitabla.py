import mysql.connector

connection = mysql.connector.connect(
    host='localhost',   
    user='empresa',   
    password='empresa',
    database='empresa' 
)

print("Programa de gestión de empresa v0.1")
print("por Francisco Jose Herreros Rodriguez")