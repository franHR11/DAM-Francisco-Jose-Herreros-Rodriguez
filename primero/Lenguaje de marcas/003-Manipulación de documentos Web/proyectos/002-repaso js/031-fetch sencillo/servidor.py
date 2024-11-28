from flask import Flask                                             # Importo la librería para un microservidor web
from flask_cors import CORS                                         # Importo CORS para elegir a quien dejo entrar

app = Flask(__name__)                                               # Creo un microservidor web
CORS(app)                                                           # Le aplico CORS en modo totalmente abierto

@app.route("/")                                                     # Cuando alguien llame a la raiz (127.0.0.1:5000/)
def home():                                                         # Declaro una funcion
    return "Si estas leyendo esto es que te lo da Python"           # Imprimo un mensaje de demostracion

if __name__ == "__main__":                                          # Si este es el archivo principal
    app.run()                                                       # Pon en marcha el servidor