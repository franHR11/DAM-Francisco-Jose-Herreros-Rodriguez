import mysql.connector

class ConectorBD:
    def __init__(self):
        self.conexion = mysql.connector.connect(
                host='localhost',  
                database='fruteria', 
                user='fruteria',  
                password='fruteria'  
            )
        self.cursor = self.conexion.cursor(dictionary = True)
    def dameTablas(self):      
        peticion = "SHOW TABLES"
        self.cursor.execute(peticion)
        registros = self.cursor.fetchall()
        return registros
    def leerTabla(self,tabla):
        peticion = "SELECT * FROM "+tabla
        self.cursor.execute(peticion)
        registros = self.cursor.fetchall()
        return registros
    def insertaTabla(self):
        return False
    def actualizaTabla(self):
        return False
    def eliminaTabla(self):
        return False
    