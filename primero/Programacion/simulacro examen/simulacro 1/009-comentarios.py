class Cliente:                                                                                   # Creamos una clase Cliente
    def __init__(self,nuevoid,nuevonombre,nuevosapellidos,nuevoemail):                           # Creamos un constructor con los atributos de la clase
        self.id = nuevoid
        self.nombre = nuevonombre
        self.apellidos = nuevosapellidos
        self.email = nuevoemail
   
class Productos:                                                                                 # Creamos una clase Productos
    def __init__(self,nuevoid,nuevonombre,nuevadescripcion,nuevoprecio):                         # Creamos un constructor con los atributos de la clase
        self.id = nuevoid
        self.nombre = nuevonombre
        self.descripcion = nuevadescripcion
        self.email = nuevoprecio  
        
clientes = [] # Lista de clientes    
productos = [] # Lista de productos        
        
#cliente1 = Cliente(1,"Juan","Perez","juan@gmail.com")       # Creamos un objeto de la clase Cliente         


print("Programa de consola para gestionar clientes y productos")
print("v 1.0 BY Francisco Jose Herreros Rodriguez")

while True:                                                                                  # Bucle infinito
    print("########################")
    print("Selecciona una entidad")
    print("1.- Gestion de Clientes")
    print("2.- Gestion de Productos")

    entidad = input("Introduce una opcion: ")                                            # Introducimos una opcion

    print("Selecciona opcion")
    print("1.-Insertar un nuevo registro")
    print("2.-Listar registros")
    print("3.-Actualizar registro")
    print("4.-Eliminar registro")

    opcion = input("Selecciona una de estas operaciones:")                             # Introducimos una opcion

    if opcion == "1":                                                                   # Si la opcion es 1
        print("Insertamos un nuevo registro: ")                                         # Mostramos un mensaje)
        identificador = input("Introduce el id del nuevo cliente: ")                # Introducimos los datos del cliente
        nombre = input("Introduce el nombre del nuevo cliente: ")                 # Introducimos los datos del cliente
        apellidos = input("Introduce los apellidos del nuevo cliente: ")          # Introducimos los datos del cliente
        email = input("Introduce el email del nuevo cliente: ")                   # Introducimos los datos del cliente
        cliente = Cliente(identificador,nombre,apellidos,email)                 # Creamos un objeto de la clase Cliente
        clientes.append(cliente)                                              # Añadimos el objeto a la lista de clientes
        
    elif opcion == "2":
        print("Listamos los registros")
    elif opcion == "3":
        print("Actualizamos los registros")
    elif opcion == "4":
        print("Eliminamos registros")