

'''LA BASE DE DATOS SE ENCUENTRA EN LA RAIZ PRINCIPAL JUNTO A LAS GRAFICAS GENERADAS
INSTALAR MATPLOTLIB CON EL SIGUIENTE COMANDO EN LA TERMINAL
// WINDOWS // pip install matplotlib //LINUX //  pip3 install matplotlib

'''

import sqlite3
import matplotlib.pyplot as plt

# Conectar a la base de datos
conexion = sqlite3.connect('registros.db')
conexion.text_factory = lambda x: str(x, 'utf-8', 'replace')
cursor = conexion.cursor()

# Ejecutar consulta SQL

etiquetas = []
datos = []

cursor.execute('''
    SELECT
    COUNT(navegador) as numero
    FROM logs
    WHERE navegador LIKE '%Windows%';
''')

filas = cursor.fetchall()



etiquetas.append("Windows")
datos.append(filas[0][0])

cursor.execute('''
    SELECT
    COUNT(navegador) as numero
    FROM logs
    WHERE navegador LIKE '%Mac OS%';
''')

filas = cursor.fetchall()



etiquetas.append("Mac")
datos.append(filas[0][0])

cursor.execute('''
    SELECT
    COUNT(navegador) as numero
    FROM logs
    WHERE navegador LIKE '%Linux%';
''')

filas = cursor.fetchall()



etiquetas.append("Linux")
datos.append(filas[0][0])

print(datos)

plt.pie(datos, labels=etiquetas)

plt.savefig('ssoo.png')

plt.close()