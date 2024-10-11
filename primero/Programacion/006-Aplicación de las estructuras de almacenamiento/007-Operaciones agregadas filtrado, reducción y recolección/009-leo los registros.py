"""
la base de datos a sido creada en la carpeta raiz del proyecto
con el nombre de empresa.db

"""

import sqlite3                                  # importo la libreria sqlite3

conexion = sqlite3.connect('empresa.db')        # creo la conexion con la base de datos
cursor = conexion.cursor()                      # creo el cursor
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
               ''')                             # ejecuto la sentencia

cursor.execute('''                              
    INSERT INTO clientes
    VALUES (
        NULL,
        'Francisco Jose',
        'Herreros Rodriguez',
        'info@franciscojose.com',
        'La calle de Francisco Jose'
    )
''')                                             # ejecuto la sentencia
conexion.commit()                                # confirmo la transaccion

cursor.execute('''
    SELECT * FROM clientes;
''')                                             # Ejecuto una petición de seleccion

filas = cursor.fetchall()                        # Almaceno el resultado en una lista

for fila in filas:                               # Proceso la lista elemento a elemento
    print(fila)                                  # Imprimo el elemento






conexion.close()                                 # cierro la conexion