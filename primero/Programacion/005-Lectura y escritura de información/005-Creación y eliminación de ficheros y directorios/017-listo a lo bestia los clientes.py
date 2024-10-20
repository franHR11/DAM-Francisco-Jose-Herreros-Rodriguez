import pickle

class Cliente:
    def __init__(self,nuevonombre,nuevosapellidos,nuevoemail,nuevadireccion):
        self.nombre = nuevonombre
        self.apellidos = nuevosapellidos
        self.email = nuevoemail
        self.direccion = nuevadireccion

agenda = []        
print("########################################################")
print("Programa agenda v0.1 por Francisco J. Herreros Rodriguez")
print("########################################################")

while True:

    print("Menu de navegacion")
    print("1. Introduzco un registro")
    print("2. Listo un registro")  
    opcion = input("Selecciona una opcion:")
    print("Has seleccionado la opcion: ",opcion)

    if opcion == "1":
        print("Introduce los datos del cliente")
        nombre = input("Introduce el nuevo nombre:")
        apellidos = input("Introduce los nuevos apellidos:")
        email = input("Introduce el nuevo email:")
        direccion = input("Introduce la nueva direccion:")
        print("Registro guardado")
        
        nuevocliente = Cliente(nombre,apellidos,email,direccion)
        agenda.append(nuevocliente)
    elif opcion == "2":
        print("Listado de registros")
        print(agenda)         