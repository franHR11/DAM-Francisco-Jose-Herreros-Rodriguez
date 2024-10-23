                                                                  # importo la librería que me permite leer y escribir bloques de memoria
from importaciones.bienvenida import *
from importaciones.funcionescrud import *

    
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
        
        







        