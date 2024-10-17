'''LA BASE DE DATOS SE ENCUENTRA EN LA RAIZ PRINCIPAL'''


import sqlite3

conexion = sqlite3.connect('registros.db')
conexion.text_factory = lambda x: str(x, 'utf-8', 'replace')
cursor = conexion.cursor()

cursor.execute('''
    SELECT * FROM logs;
''')                                                           
filas = cursor.fetchall()                                      
for fila in filas:                                              
    print(fila) 