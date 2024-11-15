from funciones import *
from flask import Flask, request
from flask_cors import CORS
        
aplicacion = Flask(__name__)
CORS(aplicacion)

servidor = "localhost"                                                      # Creo una variable en la que apunto a mi servidor
usuario = "examenprogramacion"                                                            # Creo una variable para definir el usuario
contrasena = "examenprogramacion"                                                         # Creo una variable para definir la contraseña del usuario
base_de_datos = "examenprogramacion"                                                      # Creo una variable para definiar la base de datos a la que me conecto

@aplicacion.route('/damearticulos')                                                      # Defino la ruta en la que el servidor va a escuchar
def inicio():                                                               # Defino lo que se ejecuta en esa ruta
    return seleccionaCapitulos()                                                         # Devuelvo la lista de entradas, ahora con las entradas correctas

aplicacion.run() 