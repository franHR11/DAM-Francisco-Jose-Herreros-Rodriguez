'''
Programa agenda
(c) 2024 Francisco Jose Herreros Rodriguez

'''
# Bienvenida #########################################

TITULO = "Programa Agenda"
AUTOR = "Francisco Jose Herreros Rodriguez"
print(TITULO,"por",AUTOR)


# Estructura de control de ejecucion infinita ########

while (True):



    # Menu principal  ####################################

    print("Escoge una opcion")
    print("1.-Insertar")
    print("2.-Listar")
    print("3.-Actualizar")
    print("4.-Eliminar")
    print("5.-Salir del programa")

    # El usuario escoge una opcion #######################

    opcion = input ("Seleciona una opcion (1-5):")
    print("Has seleccionado la opcion:",opcion)

    # Seleciono la operacion a realizar ##################

    if opcion == "1":
        print("Vamos a insertar un nuevo cliente")
    elif opcion == "2":
        print("Vamos a listar los cliente") 
    elif opcion == "3":
        print("Vamos a actualizar un cliente")          
    elif opcion == "4":
        print("Vamos a Eliminar un cliente")      
    elif opcion == "5":
        print("Salimos")
        exit()     