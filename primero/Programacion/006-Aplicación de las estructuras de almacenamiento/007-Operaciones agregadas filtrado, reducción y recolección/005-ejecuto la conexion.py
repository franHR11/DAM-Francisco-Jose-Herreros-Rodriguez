"""
la base de datos a sido creada en la carpeta raiz del proyecto
con el nombre de empresa.db

"""

import sqlite3

conexion = sqlite3.connect('empresa.db')
cursor = conexion.cursor()
cursor.execute('''
    CREATE TABLE clientes
    IF NOT EXISTS
    (
        Identificador INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT,
        apellidos TEXT,
        email TEXT,
        direccion TEXT
    )                  
               ''')
conexion.commit()