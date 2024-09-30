# pip install Flask
from flask import Flask

app = Flask(__name__)

@app.route('/')
def inicio():
    cadena = '''
        <style>
            
            .dia{
                border:1px solid black;
                width:50px;
                height:50px;
                display:inline-block;
                font-family:sans-serif;
                text-align:center;
            }
            #calendario{
                width:400px;
                height:300px;
            }
        </style>
        '''
    for mes in range(1,13):
        cadena +=  '''
            <h1>Mes '''+str(mes)+''' del año</h1>
            <div id="calendario">
        '''
        for dia in range(1,31):
            cadena += "<div class='dia'>"+str(dia)+"</div>"
            
        cadena += '</div>'
    return cadena

if __name__ == '__main__':
    app.run(debug=True)