import pickle

class Cliente:  # Creamos una clase Cliente
    def __init__(self, nuevoid, nuevonombre, nuevosapellidos, nuevoemail):  # Constructor con los atributos de la clase
        self.identificador = nuevoid
        self.nombre = nuevonombre
        self.apellidos = nuevosapellidos
        self.email = nuevoemail

class Productos:  # Creamos una clase Productos
    def __init__(self, nuevoid, nuevonombre, nuevadescripcion, nuevoprecio):  # Constructor con los atributos de la clase
        self.identificador = nuevoid
        self.nombre = nuevonombre
        self.descripcion = nuevadescripcion
        self.precio = nuevoprecio  

clientes = []  # Lista de clientes    
productos = []  # Lista de productos

# Muestra de la bienvenida al programa
print("Programa de consola para gestionar clientes y productos")
print("v 1.0 BY Francisco Jose Herreros Rodriguez")

#########################################  CRUD    ###########################################################

while True:  # Bucle infinito
    print("########################")
    print("Selecciona una entidad")
    print("1.- Gestion de Clientes")
    print("2.- Gestion de Productos")

    entidad = input("Introduce una opcion: ")  # Introducimos una opción

    # Gestion de clientes o productos
    if entidad == "1":  # Si elegimos "Gestion de Clientes"
        print("Selecciona una opción")
        print("1.-Insertar un nuevo clientes")
        print("2.-Listar clientes")
        print("3.-Actualizar clientes")
        print("4.-Eliminar clientes")
        print("5.-Guardar clientes")
        print("6.-Cargar clientes")

        opcion = input("Selecciona una de estas operaciones: ")  # Introducimos una opción

        #########################################  CLIENTES    ###########################################################

        if opcion == "1":  # Insertar un nuevo cliente
            print("Insertamos un nuevo registro: ")
            identificador = input("Introduce el id del nuevo cliente: ")
            nombre = input("Introduce el nombre del nuevo cliente: ")
            apellidos = input("Introduce los apellidos del nuevo cliente: ")
            email = input("Introduce el email del nuevo cliente: ")
            clientes.append(Cliente(identificador, nombre, apellidos, email))  # Añadimos el cliente a la lista

        elif opcion == "2":  # Listar los clientes
            print("Listamos los registros")
            contador = 0
            for cliente in clientes:
                print("------------------")
                print("Id de Python:" + str(contador))
                print("id: " + cliente.identificador)
                print("nombre: " + cliente.nombre)
                print("apellidos: " + cliente.apellidos)
                print("email: " + cliente.email)
                contador += 1

        elif opcion == "3":  # Actualizar los clientes
            print("Actualizamos los registros")
            idlista = input("Selecciona el elemento de la lista de Python que quieres actualizar: ")
            identificador = input("Introduce el id del cliente modificado: ")
            nombre = input("Introduce el nombre del cliente modificado: ")
            apellidos = input("Introduce los apellidos del cliente modificado: ")
            email = input("Introduce el email del cliente modificado: ")
            clientes[int(idlista)].identificador = identificador
            clientes[int(idlista)].nombre = nombre
            clientes[int(idlista)].apellidos = apellidos
            clientes[int(idlista)].email = email

        elif opcion == "4":  # Eliminar un cliente
            print("Eliminamos registros")
            idlista = input("Selecciona el elemento de la lista de Python que quieres eliminar: ")
            clientes.pop(int(idlista))
            
        elif opcion == "5":
            archivo = open("clientes.dat",'wb')
            pickle.dump(clientes,archivo)
            archivo.close()
            
        elif opcion == "6":
            archivo = open("clientes.dat",'rb')
            clientes = pickle.load(archivo)
            archivo.close()    
            
            
    #########################################  PRODUCTOS    ###########################################################
            

    elif entidad == "2":  # Si elegimos "Gestion de Productos"
        print("Selecciona una opción")
        print("1.-Insertar un nuevo registro")
        print("2.-Listar registros")
        print("3.-Actualizar registro")
        print("4.-Eliminar registro")
        print("5.-Guardar Productos")
        print("6.-Cargar Productos")

        opcion1 = input("Selecciona una de estas operaciones: ")  # Introducimos una opción



        if opcion1 == "1":  # Insertar un nuevo producto
            print("Insertamos un nuevo registro de producto: ")
            identificador = input("Introduce el id del nuevo producto: ")
            nombre = input("Introduce el nombre del nuevo producto: ")
            descripcion = input("Introduce la descripción del nuevo producto: ")
            precio = float(input("Introduce el precio del nuevo producto: "))  # Se espera un número
            productos.append(Productos(identificador, nombre, descripcion, precio))  # Añadimos el producto a la lista

        elif opcion1 == "2":  # Listar los productos
            print("Listamos los registros de productos")
            for contador, producto in enumerate(productos):
                print("------------------")
                print("Id de Python:" + str(contador))
                print("id: " + producto.identificador)
                print("nombre: " + producto.nombre)
                print("descripcion: " + producto.descripcion)
                print("precio: " + str(producto.precio))

        elif opcion1 == "3":  # Actualizar los productos
            print("Actualizamos los registros de productos")
            idlista = input("Selecciona el elemento de la lista de Python que quieres actualizar: ")
            identificador = input("Introduce el id del producto modificado: ")
            nombre = input("Introduce el nombre del producto modificado: ")
            descripcion = input("Introduce la descripción del producto modificado: ")
            precio = float(input("Introduce el precio del producto modificado: "))
            productos[int(idlista)].identificador = identificador
            productos[int(idlista)].nombre = nombre
            productos[int(idlista)].descripcion = descripcion
            productos[int(idlista)].precio = precio

        elif opcion1 == "4":  # Eliminar un producto
            print("Eliminamos registros de productos")
            idlista = input("Selecciona el elemento de la lista de Python que quieres eliminar: ")
            productos.pop(int(idlista))
            
        elif opcion1 == "5":
            archivo = open("productos.dat",'wb')
            pickle.dump(productos,archivo)
            archivo.close()
            
        elif opcion1 == "6":
            archivo = open("productos.dat",'rb')
            productos = pickle.load(archivo)
            archivo.close()      

    else:
        print("Opción no válida. Por favor, elige una opción de 1 o 2.")
