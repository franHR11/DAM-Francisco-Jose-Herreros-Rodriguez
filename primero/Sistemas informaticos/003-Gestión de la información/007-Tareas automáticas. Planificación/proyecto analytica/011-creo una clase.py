import sqlite3
import matplotlib.pyplot as plt

class JVAnaliticas:
    def __init__(self):
        self.conexion = sqlite3.connect("registros.db")
        self.conexion.row_factory = sqlite3.Row
        self.cursor = self.conexion.cursor()
        
    def graficaTarta(self,peticion, salida):
        self.cursor.execute(peticion)
        filas = self.cursor.fetchall()
        valores = []
        numeros = []
        for fila in filas:
            diccionario = dict(fila)
            valores.append(diccionario['valor'])
            numeros.append(diccionario['numero'])

        # Crear gráfico de pastel
        plt.figure()  # Crear una nueva figura para evitar sobreescritura
        plt.pie(numeros, labels=valores, autopct='%1.1f%%')  # Añadir porcentajes al gráfico
        plt.title('Distribución de Datos')  # Título opcional
        plt.savefig(salida)
        plt.close()  # Cerrar la figura para evitar superposición
        

sesion = JVAnaliticas()
sesion.graficaTarta(
    """
    SELECT 
    COUNT(extra3) AS numero,
    extra3 as valor
    FROM logs
    WHERE extra3 != ""
    GROUP BY extra3
    ORDER BY numero DESC
    LIMIT 20;
    """, "paises.jpg"
)

sesion.graficaTarta(
    """
    SELECT 
    COUNT(referencia) AS numero,
    referencia as valor
    FROM logs
    WHERE referencia != ""
    GROUP BY referencia
    ORDER BY numero DESC
    LIMIT 20;
    """, "idiomas.jpg"
)