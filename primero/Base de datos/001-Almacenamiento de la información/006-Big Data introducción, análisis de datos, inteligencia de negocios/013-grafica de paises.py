

'''LA BASE DE DATOS SE ENCUENTRA EN LA RAIZ PRINCIPAL JUNTO A LAS GRAFICAS GENERADAS
INSTALAR MATPLOTLIB CON EL SIGUIENTE COMANDO EN LA TERMINAL
// WINDOWS // pip install matplotlib //LINUX //  pip3 install matplotlib

'''


import sqlite3                                                                 #Importamos la libreria sqlite3
import matplotlib.pyplot as plt                                  #Importamos la libreria matplotlib

conexion = sqlite3.connect('registros.db')                                    #Conectamos con la base de datos
conexion.text_factory = lambda x: str(x, 'utf-8', 'replace')                  #Codificacion de la base de datos
cursor = conexion.cursor()                                                    #Creamos un cursor

# Ejecutar consulta SQL
cursor.execute('''
    SELECT
    COUNT(extra3) as numero,
    extra3
    FROM logs
    WHERE (
        extra3 != ''
        AND
        extra3 != 'es'
    )
    GROUP BY extra3
    ORDER BY numero DESC
    LIMIT 20
    ;
''')

filas = cursor.fetchall()

etiquetas = []
datos = []

for fila in filas:
    etiquetas.append(fila[1])
    datos.append(fila[0])

plt.pie(datos, labels=etiquetas)

plt.savefig('paises.png')

plt.close()