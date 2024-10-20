import pickle

class Cliente:
    def __init__(self,nuevonombre,nuevosapellidos,nuevoemail,nuevadireccion):
        self.nombre = None
        self.apellidos = None
        self.email = None
        self.direccion = None

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
    elif opcion == "2":
        print("Listado de registros")
        for cliente in agenda:
            print("Nombre:",cliente.nombre)
            print("Apellidos:",cliente.apellidos)
            print("Email:",cliente.email)
            print("Direccion:",cliente.direccion)           