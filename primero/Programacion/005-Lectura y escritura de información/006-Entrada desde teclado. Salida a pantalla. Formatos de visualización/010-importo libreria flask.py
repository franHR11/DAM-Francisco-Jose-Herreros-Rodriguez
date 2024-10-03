# Windows: pip install flask
# Mac: pip3 install flask
from flask import Flask                     # Importo la librería que me permite crear un miniservidor web

aplicacion = Flask(__name__)                # Creo el servidor web

mensaje = {"resultado":"ok"}
print(mensaje)