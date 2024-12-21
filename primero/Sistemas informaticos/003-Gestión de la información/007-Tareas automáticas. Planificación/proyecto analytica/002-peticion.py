import sqlite3

conexion = sqlite3.connect("registros.db")

cursor = conexion.cursor()

cursor.execute("SELECT * FROM logs LIMIT 10")

filas = cursor.fetchall()

print(filas)