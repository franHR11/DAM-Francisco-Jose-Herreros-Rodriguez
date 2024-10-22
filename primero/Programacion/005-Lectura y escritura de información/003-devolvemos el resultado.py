import mysql.connector

connection = mysql.connector.connect(
    host='localhost',   
    user='empresa',   
    password='empresa',
    database='empresa' 
)

cursor = connection.cursor()

print("Programa de gestión de empresa v0.1")
print("por Francisco Jose Herrerros Rodriguez")

print("Selecciona una tabla de la base de datos:")

peticion = "SHOW TABLES;"

cursor.execute(peticion)
filas = cursor.fetchall()
tablas = []
for fila in filas:
    tablas.append(fila[0])
contador = 0
for tabla in tablas:
    print(contador,"-",tabla)
    contador+=1