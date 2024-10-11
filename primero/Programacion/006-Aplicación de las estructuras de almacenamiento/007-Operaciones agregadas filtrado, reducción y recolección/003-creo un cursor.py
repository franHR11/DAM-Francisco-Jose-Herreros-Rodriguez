"""
la base de datos a sido creada en la carpeta raiz del proyecto
con el nombre de empresa.db

"""

import sqlite3

conexion = sqlite3.connect('empresa.db')
cursor = conexion.cursor()