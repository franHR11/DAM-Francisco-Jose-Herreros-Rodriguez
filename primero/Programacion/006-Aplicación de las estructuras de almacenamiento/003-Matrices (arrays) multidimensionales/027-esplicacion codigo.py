'''
    Programa agenda con colecciones bidimensionales
    (c) 2024 Francisco Jose Herreros Rodriguez
'''

import platform                                                             # Importo la libreria plataforma para poder detectar en que navegador estoy
import os                                                                   # Importo la libreria os para poder hacer operaciones de sistema operativo

def limpiaPantalla():                                                       # Creo una función para luego poder reutilizarla
    if platform.system() == "Windows":                                      # Si el sistema es Windows
        os.system("cls")                                                    # el comando de windows es cls
    else:                                                                   # si el sistema es mac o linux (o unix)
        os.system("clear")                                                  # el comando entonces es clear

limpiaPantalla()                                                            # llamo a la funcion y limpio la pantalla al iniciar el programa
print("Programa agenda (c) 2024 Francisco Jose Herreros Rodriguez")         # Imprimo un mensaje de bienvenida

agenda = []                                                                 # creo una lista vacia como estructura para guardar toda mi informacion

while(True):                                                                # entro en un bucle infinito
    limpiaPantalla()                                                        # Limpio de nuevo la pantalla
    print("Selecciona una de las siguientes opciones")                      # Imprimo las opciones del menu
    print("1.-Insertar un nuevo registro")
    print("2.-Listar los registros")
    print("3.-Eliminar un registro")
    selecciona_opcion = input("Selecciona una de las opciones:")            # Le permito al usuario escoger su opcion
    
    limpiaPantalla()                                                        # Limpio la pantalla como para pasar a una nueva pantalla
    print("La opcion que has escogido es:",selecciona_opcion)

    if selecciona_opcion == "1":                                            # En el caso de que el usuario haya escogido la opcion 1
        print("Vamos a insertar un registro")                               # Le informo de la operacion que se va a realizar
        nombre = input("\033[32mIntroduce tu nombre:\033[0m")               # Le pido una serie de datos que introduzco en inputs
        apellidos = input("\033[32mIntroduce tus apellidos:\033[0m")
        email = input("\033[32mIntroduce tu email:\033[0m")
        telefono = input("\033[32mIntroduce tu teléfono:\033[0m")
        agenda.append([nombre,apellidos,email,telefono])                    # Y esto es muy importante porque añado esos datos a la agenda, aqui aumento la memoria RAM consumida
    elif selecciona_opcion == "2":                                          # En el caso de que el usuario haya escogido la opcion 2
        contador = 0                                                        # creo un contador y le doy un valor inicial de cero
        print("Vamos a leer registros")                                     # Aviso al usuario de que los registros van a ser leidos
        for registro in agenda:                                             # Para cada uno de los registros que esten contenidos en la agenda
            #print("######################")                                 # imprimo una barra estetica
            print("Registro numero",contador,"---------------")             # Indico el numero de registro usando el contador
            print("\033[31mnombre:\t\t\033[0m",registro[0])                 # Imprimo el nombre, que es el elemento 0 de la lista
            print("\033[32mapellidos:\t\033[0m",registro[1])                # imprimo los apellidos que son el elemento 1 de la lista
            print("\033[33memail:\t\t\033[0m",registro[2])                  # imprimi el email que es el elemento 2 de la lista
            print("\033[34mtelefono:\t\033[0m",registro[3])                 # imprimo el telefono que es el elemento 3 de la lista
            contador += 1                                                   # Le sumo un valor al contador usando un operador aritmetico abreviado
        print("######################")                                     # imprimo una barra estetica
        input("Pulsa una tecla para continuar...")                          # paro la ejecucion para que no se me borre la pantalla por accidente
    elif selecciona_opcion == "3":                                          # en el caso de que el usuario haya escogido la opcion
        limpiaPantalla()                                                    # borro la pantalla
        print("Vamos a eliminar un registro")                               # le aviso al usuario de la operacion que se va a realizar
        opcion = input("Introduce el numero de registro que quieres eliminar:") # Le permito al usuario introducir el numero de regisro que va a eliminar
        opcion = int(opcion)                                                # como la entrada es un string, lo convierto a numero entero
        agenda.pop(opcion)                                                  # elimino ese registro de la agenda (aqui estoy vaciando la RAM)
        input("Pulsa una tecla para volver al menu principal...")           # pulsa una tecla para no borrar la pantalla por accidente
            


    