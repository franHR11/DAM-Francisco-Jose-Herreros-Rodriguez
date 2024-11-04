from flask import Flask

app = Flask(__name__)

@app.route('/')
def inicio():
    return '<h1>Inicio</h1>'

@app.route('/sobremi')
def sobremi():
    return '<h1>Sobre mi</h1>'

@app.route('/contacto')
def contacto():
    return '<h1>Contacto</h1>'

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)