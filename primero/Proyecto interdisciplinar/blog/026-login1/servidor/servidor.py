from flask import Flask, request                                            # Importamos la librería Flask para hacer un micro servidor web
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

@aplicacion.route('/toma')                                                  # Creo una nueva ruta
def toma():                                                                 # Defino una funcion
    titulo = request.args.get('titulo')                                     # atrapo el parametro get llamado titulo
    fecha = request.args.get('fecha')                                       # Atrapo el parámetro get llamado fecha
    contenido = request.args.get('contenido')                               # Atrapo el parámetro get llamado contenido
    
    peticion = f"""
        INSERT INTO entradas 
        VALUES (
            NULL,
            '{titulo}',
            '{fecha}',
            '{contenido}'
        );"""                                                               # Formateo  una peticion INSERT de SQL
    cursor = conexion.cursor()                                              # Creo un cursor
    cursor.execute(peticion)                                                # Ejecuto la peticioń
    conexion.commit()                                                       # Lanzo la petición a la conexión
    return "ok"                                                             # Devuelvo algo aunque no sea nada

@aplicacion.route('/login')                                                 # Creo una nueva ruta para el login
def login():                                                                # Creo una función
    usuario = request.args.get('usuario')                                   # Atrapo el parametro de url llamado usuario
    contrasena = request.args.get('contrasena')                             # Atrapo el parametro de url llamado contrasena
    peticion = f"""
        SELECT * FROM usuarios
        WHERE
        usuario = '{usuario}'
        AND
        contrasena = '{contrasena}'
        ;"""                                                                # Creo una peticion de select con where con parametros
    cursor = conexion.cursor(dictionary=True)                               # creo un cursor
    cursor.execute(peticion)                                                # Ejecuto la peticion
    filas = cursor.fetchall()                                               # Recupero el resultado de la base de datos
    if len(filas) == 0:                                                     # Si no hay resultado
        return '{"resultado":"falso"}'                                      # Devuelvo un json que dice falso
    else:                                                                   # En caso contrario
        return '{"resultado":"verdadero"}'                                  # DEvuelvo un json que dice que verdadero
aplicacion.run()                                                            # Ejecuto la aplicación