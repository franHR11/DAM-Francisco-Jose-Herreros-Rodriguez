class Cliente:                                                                                   # Creamos una clase Cliente
    def __init__(self,nuevoid,nuevonombre,nuevosapellidos,nuevoemail):                           # Creamos un constructor con los atributos de la clase
        self.identificador = nuevoid
        self.nombre = nuevonombre
        self.apellidos = nuevosapellidos
        self.email = nuevoemail
   
class Productos:                                                                                 # Creamos una clase Productos
    def __init__(self,nuevoid,nuevonombre,nuevadescripcion,nuevoprecio):                         # Creamos un constructor con los atributos de la clase
        self.identificador = nuevoid
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
              
        clientes.append(Cliente(identificador,nombre,apellidos,email))                                              # Añadimos el objeto a la lista de clientes
        
    elif opcion == "2":
        print("Listamos los registros")
        contador = 0
        for cliente in clientes:                                                    # Para cada uno de los clientes en la lista de clientes
            print("------------------")                                             # Pongo un separador
            print("Id de Python:"+str(contador))
            print("id: "+cliente.identificador)                                     # Imprimo cada una de las caracteristicas
            print("nombre: "+cliente.nombre)
            print("apellidos: "+cliente.apellidos)
            print("email: "+cliente.email)
            contador+= 1
    elif opcion == "3":
        print("Actualizamos los registros")
        idlista = input("Selecciona el elemento de la lista de Python que quieres actualizar:")
        identificador = input("Introduce el id del cliente modificado: ")                  # Introduzco los datos que pido para la clase
        nombre = input("Introduce el nombre del cliente modificado: ")
        apellidos = input("Introduce los apellidos del cliente modificado: ")
        email = input("Introduce el email del cliente modificado ")
        clientes[int(idlista)].identificador = identificador
        clientes[int(idlista)].nombre = nombre
        clientes[int(idlista)].apellidos = apellidos
        clientes[int(idlista)].email = email
    elif opcion == "4":
        print("Eliminamos registros")