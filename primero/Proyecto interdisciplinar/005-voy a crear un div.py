# pip install Flask
from flask import Flask

app = Flask(__name__)

@app.route('/')
def inicio():
    cadena = '''
        <style>
            body {color:red;}
        </style>
    
    '''
    for dia in range(1,31):
        cadena += "<div class='dia'>"+str(dia)+"</div>"
    return cadena

if __name__ == '__main__':
    app.run(debug=True)