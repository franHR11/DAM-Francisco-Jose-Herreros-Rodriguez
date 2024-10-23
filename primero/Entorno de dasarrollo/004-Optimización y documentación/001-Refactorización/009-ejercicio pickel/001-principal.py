import pickle                                                                   # importo la librería que me permite leer y escribir bloques de memoria

class Cliente:                                                                  # Creo una clase
    def __init__(self,nuevonombre,nuevosapellidos,nuevoemail,nuevadireccion):   # Creo un constructor con parametros
        self.nombre = nuevonombre                                               # A las propiedades les paso los parametros del constructor
        self.apellidos = nuevosapellidos
        self.email = nuevoemail
        self.direccion = nuevadireccion

agenda = []                                                                     # Creo una agenda que de momento esta vacia

print("###############################################")                        # Creo un mensaje de bienvenida
print("Programa agenda v0.1 por Francisco Jose Herreros")
print("###############################################")

while True:                                                                     # Escribo un bucle infinito
    
    print("Menú de navegación")                                                 # Imprimo un menu de navegacion
    print("1.-Introduce un registro")
    print("2.-Listado de registros")
    print("3.-Guardar registros")
    print("4.-Leer registros")

    opcion = input("Selecciona una opcion:")                                    # Atrapo la opcion del usuario
    print("Has cogido la opcion: ",opcion)                                      # Le digo al usuario la opcion que ha escogido

    if opcion == "1":                                                           # En el caso de que el usuario haya escogido la opcion 1
        print("Vamos a insertar un nuevo cliente")                              # Le digo que vamos a insertar un cliente
        
        nombre = input("Introduce el nuevo nombre:")                            # Atrapo los datos que me proporciona el usuario
        apellidos = input("Introduce los nuevos apellidos:")
        email = input("Introduce el nuevo email:")
        direccion = input("Introduce la nueva direccion:")

        nuevocliente = Cliente(nombre,apellidos,email,direccion)                # Creo una nueva instancia de la clase Cliente

        agenda.append(nuevocliente)                                             # La anexo a la agenda

    elif opcion == "2":                                                         # En el caso de que el usuario haya escogido la opcion 2
        for cliente in agenda:                                                  # PAra cada uno de los clientes de la agenda
            print("-----------------------")                                    # Imprimo cada uno de los clientes pero en formato bonito
            print("nombre:",cliente.nombre)
            print("apellidos:",cliente.apellidos)
            print("email:",cliente.email)
            print("direccion:",cliente.direccion)
            

    elif opcion == "3":                                                         # En el caso de que el usuario elija la opcion 3
        
        archivo = open("agenda.bin",'wb')                                       # Abro un archivo binario en modo escritura binaria
        pickle.dump(agenda,archivo)                                             # Vierto el contenido de la agenda en el interior de ese archivo
        print("La agenda ha sido guardada en un archivo")                       # Imprimo un mensaje de aviso
        archivo.close()                                                         # Cierro el archivo
        
    elif opcion == "4":                                                         # En el caso de que el usuario elija la opcion 4
        
        archivo = open("agenda.bin",'rb')                                       # Abro un archivo binario en modo de lectura binaria
        agenda = pickle.load(archivo)                                           # En la agenda vierto de vuelta el contenido del archivo del disco duro
        archivo.close()                                                         # Cierro el archivo
        
        







        