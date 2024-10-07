from flask import Flask
from flask_cors import CORS

aplicacion = Flask(__name__)
CORS(aplicacion)
@aplicacion.route('/')
def inicio():
    entradas = []
    entradas.append({
        "titulo":"Mi primera entrada",
        "fecha":"2024-09-26",
        "contenido":"Este es el contenido de mi primera entrada con python"
    })
    entradas.append({
        "titulo":"Mi segunda entrada",
        "fecha":"2024-09-26",
        "contenido":"Este es el contenido de mi segunda entrada con python"
    })
    entradas.append({
        "titulo":"Mi tercera entrada",
        "fecha":"2024-09-26",
        "contenido":"Este es el contenido de mi tercera entrada con python"
    })
    return entradas

if __name__ == '__main__':
    aplicacion.run()