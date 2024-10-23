import pickle                                                                   # importo la librería que me permite leer y escribir bloques de memoria
from clasecliente import *
from bienvenida import *
agenda = []                                                                     # Creo una agenda que de momento esta vacia



def inserto():
    print("Vamos a insertar un nuevo cliente")                              # Le digo que vamos a insertar un cliente
        
    nombre = input("Introduce el nuevo nombre:")                            # Atrapo los datos que me proporciona el usuario
    apellidos = input("Introduce los nuevos apellidos:")
    email = input("Introduce el nuevo email:")
    direccion = input("Introduce la nueva direccion:")
    nuevocliente = Cliente(nombre,apellidos,email,direccion)                # Creo una nueva instancia de la clase Cliente
    agenda.append(nuevocliente) 
    
def listo():
    for cliente in agenda:                                                  # PAra cada uno de los clientes de la agenda
        print("-----------------------")                                    # Imprimo cada uno de los clientes pero en formato bonito
        print("nombre:",cliente.nombre)
        print("apellidos:",cliente.apellidos)
        print("email:",cliente.email)
        print("direccion:",cliente.direccion)  
        
def guardar():           
        archivo = open("agenda.bin",'wb')                                       # Abro un archivo binario en modo escritura binaria
        pickle.dump(agenda,archivo)                                             # Vierto el contenido de la agenda en el interior de ese archivo
        print("La agenda ha sido guardada en un archivo")                       # Imprimo un mensaje de aviso
        archivo.close()  
         
def leer():        
        archivo = open("agenda.bin",'rb')                                       # Abro un archivo binario en modo de lectura binaria
        agenda = pickle.load(archivo)                                           # En la agenda vierto de vuelta el contenido del archivo del disco duro
        archivo.close() 
        
            
bienvenida()


while True:                                                                     # Escribo un bucle infinito
    
    menu()

    opcion = input("Selecciona una opcion:")                                    # Atrapo la opcion del usuario
    print("Has cogido la opcion: ",opcion)                                      # Le digo al usuario la opcion que ha escogido

    if opcion == "1":                                                           # En el caso de que el usuario haya escogido la opcion 1
        inserto()                               # La anexo a la agenda

    elif opcion == "2":                                                         # En el caso de que el usuario haya escogido la opcion 2
        listo()

    elif opcion == "3":                                                         # En el caso de que el usuario elija la opcion 3
        
         guardar()                                             # Cierro el archivo
        
    elif opcion == "4":                                                         # En el caso de que el usuario elija la opcion 4
        
        leer()                                                # Cierro el archivo
        
        







        