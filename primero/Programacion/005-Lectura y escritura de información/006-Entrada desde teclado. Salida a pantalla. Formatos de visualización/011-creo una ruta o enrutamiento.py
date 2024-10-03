# Windows: pip install flask
# Mac: pip3 install flask
from flask import Flask                                 # Importo la librería que me permite crear un miniservidor web

aplicacion = Flask(__name__)                            # Creo el servidor web

@aplicacion.route('/')                                  # Creo un escuchador para que esté pendiente de cuando alguien entre en la raiz
def inicio():                                           # Defino una funcion - se puede llamar como yo quiera
    contenido = '<p>Esta es la página de inicio</p>'    # Preparo un contenido
    return contenido                                    # Lanzo el contenido al navegador web          

aplicacion.run(debug=True)                              # Arranco el servidor

mensaje = {"resultado":"ok"}
print(mensaje)