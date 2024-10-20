import pickle

class Cliente:
    def __init__(self):
        self.nombre = None
        self.apellidos = None
        self.email = None
        self.direccion = None

agenda = []        
print("########################################################")
print("Programa agenda v0.1 por Francisco J. Herreros Rodriguez")
print("########################################################")

print("Menu de navegacion")
print("1. Introduzco un registro")
print("2. Listo un registro")  
opcion = input("Selecciona una opcion:")
print("Has seleccionado la opcion: ",opcion)       