from flask import Flask                         # Importo librería Flask
from flask_cors import CORS                     # Permito entrar a todo el mundo
import mysql.connector                          # Uso el conector de MySQL

conexion = mysql.connector.connect(
    host="localhost",      
    user="landing",
    password="landing",
    database="landing"
)                                               # Me conecto al servidor con las credenciales correctas

cursor = conexion.cursor(dictionary=True)       # Creo un cursor y le digo que me lo devuelva en modo diccionario

app = Flask(__name__)                           # Creo un servidor
CORS(app)                                       # Utilizo CORS

@app.route('/damearticulos')                    # Cuando alguien llame a damearticulos
def home():                                     # Defino una funcion
    peticion = "SELECT * FROM blog"             # Le pido algo a la base de datos
    cursor.execute(peticion)                    # Ejecuto la petición en el cursor
    resultados = cursor.fetchall()              # Meto los resultados en una lista
    print(resultados)   
    return resultados, 200                      # Devuelvo los resultados como respuesta a la peticionz

if __name__ == '__main__':                      # Si estoy en el archivo principal
    app.run(debug=True)                         # Corro el servidor