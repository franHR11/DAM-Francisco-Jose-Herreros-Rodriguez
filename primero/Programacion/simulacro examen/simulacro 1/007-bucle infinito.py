class Cliente:
    def __init__(self,nuevoid,nuevonombre,nuevosapellidos,nuevoemail):
        self.id = nuevoid
        self.nombre = nuevonombre
        self.apellidos = nuevosapellidos
        self.email = nuevoemail
   
class Productos:
    def __init__(self,nuevoid,nuevonombre,nuevadescripcion,nuevoprecio):
        self.id = nuevoid
        self.nombre = nuevonombre
        self.descripcion = nuevadescripcion
        self.email = nuevoprecio  
        
clientes = [] # Lista de clientes
productos = [] # Lista de productos        
        
#cliente1 = Cliente(1,"Juan","Perez","juan@gmail.com")       # Creamos un objeto de la clase Cliente         


print("Programa de consola para gestionar clientes y productos")
print("v 1.0 BY Francisco Jose Herreros Rodriguez")

while True:
    print("########################")
    print("Selecciona una entidad")
    print("1.- Gestion de Clientes")
    print("2.- Gestion de Productos")

    entidad = input("Introduce una opcion: ")

    print("Selecciona opcion")
    print("1.-Insertar un nuevo registro")
    print("2.-Listar registros")
    print("3.-Actualizar registro")
    print("4.-Eliminar registro")

    opcion = input("Selecciona una de estas operaciones:")

    if opcion == "1":
        print("Insertamos un nuevo registro")
    elif opcion == "2":
        print("Listamos los registros")
    elif opcion == "3":
        print("Actualizamos los registros")
    elif opcion == "4":
        print("Eliminamos registros")