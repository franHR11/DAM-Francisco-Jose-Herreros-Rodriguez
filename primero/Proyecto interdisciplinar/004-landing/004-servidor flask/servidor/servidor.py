from flask import Flask                         # Importo librería Flask
from flask_cors import CORS                     # Permito entrar a todo el mundo

app = Flask(__name__)                           # Creo un servidor
CORS(app)                                       # Utilizo CORS

@app.route('/damearticulos')                    # Cuando alguien llame a damearticulos
def home():                                     # Defino una funcion
    return '{"mensaje":"ok"}', 200              # Devuelvo un mensaje

if __name__ == '__main__':                      # Si estoy en el archivo principal
    app.run(debug=True)                         # Corro el servidor