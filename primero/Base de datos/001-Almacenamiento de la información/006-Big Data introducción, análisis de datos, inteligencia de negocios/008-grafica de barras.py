

'''LA BASE DE DATOS SE ENCUENTRA EN LA RAIZ PRINCIPAL JUNTO A LAS GRAFICAS GENERADAS
INSTALAR MATPLOTLIB CON EL SIGUIENTE COMANDO EN LA TERMINAL
// WINDOWS // pip install matplotlib //LINUX //  pip3 install matplotlib

'''


import sqlite3                                                                 #Importamos la libreria sqlite3
import matplotlib.pyplot as plt                                                #Importamos la libreria matplotlib

conexion = sqlite3.connect('registros.db')                                    #Conectamos con la base de datos
conexion.text_factory = lambda x: str(x, 'utf-8', 'replace')                  #Codificacion de la base de datos
cursor = conexion.cursor()                                                    #Creamos un cursor

cursor.execute('''
    SELECT
    COUNT(anio) as año,
    anio
    FROM logs
    GROUP BY anio
    ;
''')                                                                          #Ejecutamos una consulta

filas = cursor.fetchall()                                                     #Obtenemos los datos de la consulta

etiquetas = []                                                               #Creamos una lista vacia para las etiquetas
datos = []                                                                   #Creamos una lista vacia para los datos

for fila in filas:                                                           #Iteramos los datos                                    
    etiquetas.append(fila[1])                                                #Agregamos los datos a la lista años
    datos.append(fila[0])                                                    #Agregamos los datos a la lista cantidad de años


# Crear gráfico de barras
plt.bar(etiquetas, datos)

# Etiquetas y título del gráfico
plt.xlabel('Año')
plt.ylabel('Cantidad')
plt.title('Cantidad de registros por año')

# Guardar gráfico
plt.savefig('barras_bigdata.png')

# Cerrar el gráfico
plt.close()