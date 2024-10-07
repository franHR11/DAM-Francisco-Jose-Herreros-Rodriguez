from flask import Flask
from flask_cors import CORS
import mysql.connector                                                      # Importo la librería para poder conectarme a MySQL

aplicacion = Flask(__name__)
CORS(aplicacion)

servidor = "localhost"                                                      # Creo una variable en la que apunto a mi servidor
usuario = "blog"                                                            # Creo una variable para definir el usuario
contrasena = "blog"                                                         # Creo una variable para definir la contraseña del usuario
base_de_datos = "blog"                                                      # Creo una variable para definiar la base de datos a la que me conecto

conexion = mysql.connector.connect(
    host=servidor,      
    database=base_de_datos,  
    user=usuario,  
    password=contrasena  
)                              


@aplicacion.route('/')
def inicio():
    entradas = []
    peticion = "SELECT * FROM entradas;"                                # Preparo una petición de inserción a la base de datos
    cursor = conexion.cursor(dictionary=True)                           # Una petición en Python requiere un cursor
    cursor.execute(peticion)                                            # En el cursor, ejecuto la petición que he dejado preparada arriba
    filas = cursor.fetchall()                                           # En una variable llamadas filas, almaceno los resultados que me da la base de datos
    for fila in filas:                                                  # Como filas representa a todas las filas, yo quiero coger una a una
        entradas.append(fila)
    return entradas

if __name__ == '__main__':
    aplicacion.run()