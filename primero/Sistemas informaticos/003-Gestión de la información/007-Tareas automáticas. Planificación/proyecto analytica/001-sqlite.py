import sqlite3

conexion = sqlite3.connect("registros.db")

cursor = conexion.cursor()

cursor.execute("SELECT * FROM logs")

