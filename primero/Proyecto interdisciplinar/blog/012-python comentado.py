from flask import Flask                                                     # Importamos la librería Flask para hacer un micro servidor web
from flask_cors import CORS                                                 # Importo CORS para no tener problemas de conexiónde un lado a otro
import mysql.connector                                                      # Importo la librería para poder conectarme a MySQL

aplicacion = Flask(__name__)                                                # Creo una aplicación Flask
CORS(aplicacion)                                                            # Le aplico CORS para no tener esos problemas de conexión

servidor = "localhost"                                                      # Creo una variable en la que apunto a mi servidor
usuario = "blog"                                                            # Creo una variable para definir el usuario
contrasena = "blog"                                                         # Creo una variable para definir la contraseña del usuario
base_de_datos = "blog"                                                      # Creo una variable para definiar la base de datos a la que me conecto

conexion = mysql.connector.connect(
    host=servidor,      
    database=base_de_datos,  
    user=usuario,  
    password=contrasena  
)                                                                           # Establezco una conexión con la base de datos con los datos seleccionados

@aplicacion.route('/')                                                      # Defino la ruta en la que el servidor va a escuchar
def inicio():                                                               # Defino lo que se ejecuta en esa ruta
    entradas = []                                                           # Creo una lista de entradas que de momento está vacía
    peticion = "SELECT * FROM entradas ORDER BY fecha DESC;"                # Preparo una petición de inserción a la base de datos (quiero todas las entradas=
    cursor = conexion.cursor(dictionary=True)                               # Una petición en Python requiere un cursor - y además quiero el resultado como diccionario
    cursor.execute(peticion)                                                # En el cursor, ejecuto la petición que he dejado preparada arriba
    filas = cursor.fetchall()                                               # En una variable llamadas filas, almaceno los resultados que me da la base de datos
    for fila in filas:                                                      # Como filas representa a todas las filas, yo quiero coger una a una
        entradas.append(fila)                                               # A la lista de entradas, le añado una entrada
    return entradas                                                         # Devuelvo la lista de entradas, ahora con las entradas correctas

    
aplicacion.run()                                                            # Ejecuto la aplicación