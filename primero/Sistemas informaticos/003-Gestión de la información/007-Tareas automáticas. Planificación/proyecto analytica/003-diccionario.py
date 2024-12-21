import sqlite3

conexion = sqlite3.connect("registros.db")
conexion.row_factory = sqlite3.Row

cursor = conexion.cursor()

cursor.execute("SELECT * FROM logs LIMIT 10")

filas = cursor.fetchall()

for fila in filas:
    diccionario = dict(fila)