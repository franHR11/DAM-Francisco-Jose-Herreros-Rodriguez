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
        
    def graficaBarras(self, peticion, salida):
        self.cursor.execute(peticion)
        filas = self.cursor.fetchall()
        valores = []
        numeros = []
        for fila in filas:
            diccionario = dict(fila)
            valores.append(diccionario['valor'])
            numeros.append(diccionario['numero'])

        # Crear gráfico de barras
        plt.figure()  # Crear una nueva figura para evitar sobreescritura
        plt.bar(valores, numeros)  # Usar valores como etiquetas en el eje x y números como alturas de barras
        plt.xlabel('Categorías')  # Etiqueta para el eje x
        plt.ylabel('Frecuencia')  # Etiqueta para el eje y
        plt.title('Distribución de Datos')  # Título opcional
        plt.xticks(rotation=45, ha='right')  # Rotar etiquetas del eje x para mayor legibilidad
        plt.tight_layout()  # Ajustar el diseño para evitar superposición
        plt.savefig(salida)
        plt.close()  # Cerrar la figura para evitar superposición