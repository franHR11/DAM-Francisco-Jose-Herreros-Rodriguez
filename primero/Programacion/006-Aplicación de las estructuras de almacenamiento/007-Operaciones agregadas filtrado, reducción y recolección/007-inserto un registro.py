"""
la base de datos a sido creada en la carpeta raiz del proyecto
con el nombre de empresa.db

"""

import sqlite3

conexion = sqlite3.connect('empresa.db')
cursor = conexion.cursor()
cursor.execute('''
    CREATE TABLE 
    IF NOT EXISTS clientes
    (
        Identificador INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT,
        apellidos TEXT,
        email TEXT,
        direccion TEXT
    )                  
               ''')

cursor.execute('''
    INSERT INTO clientes
    VALUES (
        NULL,
        'Francisco Jose',
        'Herreros Rodriguez',
        'info@franciscojose.com',
        'La calle de Francisco Jose'
    )
''')
conexion.commit()
conexion.close()