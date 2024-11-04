from ConectorBD import *                                                # Importo la base de datos
from flask import Flask, jsonify, request                               # Importo flask como servidor web
from flask_cors import CORS                                             # Import cors para no tener problemas de permisos
conexion1 = ConectorBD()

app = Flask(__name__)                                                   # creo un nuevo servidor
CORS(app)                                                               # Le aplico CORS
@app.route('/dameTablas', methods=['GET'])                              # Atrapo la ruta de las tablas
def dame_tablas():                                                      # Defino lo que ocurre
    try:
        tablas = conexion1.dameTablas()                                 # Llamo al metodo de la base de datos
        return jsonify(tablas)                                          # Devuelvo el json en formato json
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@app.route('/leerTabla/<string:tabla>', methods=['GET'])                              # Atrapo la ruta de recuperar la tabla
def leer_tabla(tabla):                                                      # Defino lo que ocurre
    try:
        registros = conexion1.leerTabla(tabla)                                 # Llamo al metodo de la base de datos
        return jsonify(registros)                                          # Devuelvo el json en formato json
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)