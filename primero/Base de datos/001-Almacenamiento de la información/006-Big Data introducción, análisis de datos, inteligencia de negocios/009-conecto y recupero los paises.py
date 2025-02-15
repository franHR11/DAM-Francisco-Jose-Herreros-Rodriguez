

'''LA BASE DE DATOS SE ENCUENTRA EN LA RAIZ PRINCIPAL JUNTO A LAS GRAFICAS GENERADAS
INSTALAR MATPLOTLIB CON EL SIGUIENTE COMANDO EN LA TERMINAL
// WINDOWS // pip install matplotlib //LINUX //  pip3 install matplotlib

'''


import sqlite3                                                                 #Importamos la libreria sqlite3


conexion = sqlite3.connect('registros.db')                                    #Conectamos con la base de datos
conexion.text_factory = lambda x: str(x, 'utf-8', 'replace')                  #Codificacion de la base de datos
cursor = conexion.cursor()                                                    #Creamos un cursor

cursor.execute('''
    SELECT
    COUNT(extra3) as numero,
    extra3
    FROM logs
    GROUP BY extra3
    ;
''')                                                                          #Ejecutamos una consulta

filas = cursor.fetchall()                                                     #Guardamos los resultados en una variable


for fila in filas:                                                          #Recorremos los resultados
    print(fila)                                                            #Imprimimos los resultados   