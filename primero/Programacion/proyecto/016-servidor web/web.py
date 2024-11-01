from ConectorBD import *
from flask import Flask, jsonify, request
from flask_cors import CORS

conexion1 = ConectorBD()

app = Flask(__name__)
CORS(app)
@app.route('/dameTablas', methods=['GET'])
def dame_tablas():
    try:
        tablas = conexion1.dameTablas()
        return jsonify(tablas)
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@app.route('/leerTabla/<string:tabla>', methods=['GET'])
def leer_tabla(tabla):
    try:
        registros = conexion1.leerTabla(tabla)
        return jsonify(registros)
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)