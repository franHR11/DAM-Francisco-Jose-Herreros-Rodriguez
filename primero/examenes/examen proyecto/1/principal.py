from funciones import *

while True:
    print("Escoge una opcion")
    print("1.-Listar los Proyectos")
    print("2.-Insertar un Proyectos")
    print("3.-Actualizar un Proyectos")
    print("4.-Eliminar un Proyectos")
    print("5.-Cerrar el programa")
    opcion = input("Escoge una opcion:")

    if opcion == "1":
        print(seleccionaProyecto())
                                                                                                        # Imprimo las filas
    elif opcion == "2":                                                    # Creo un cursor y me aseguro de que la info me viene en JSON
        Titulo = input("Introduce el Titulo del proyecto:")                                             # Le pido un nuevo Titulo al usuario
        Texto = input("Introduce el texto del proyecto:")                                               # Le pido un nuevo Texto al usuario
        Imagen = input("Introduce la Imagen del proyecto:")                                             # Le pido un nuevo Imagen al usuario
        print(insertaProyecto(Titulo,Texto,Imagen))                                                     # Inserto un nuevo proyecto
    
    elif opcion == "4":
        Identificador = input("Introduce el Identificador del capítulo a eliminar:")         # Le pido un nuevo Titulo al usuario
        print(eliminaProyecto(Identificador))
    elif opcion == "3":
        Identificador = input("Introduce el Identificador del capítulo a actualizar:")
        campos = seleccionaProyecto(Identificador)
        if campos != False:
            print(campos)
            Titulo = input(f"Introduce el nuevo Titulo del capítulo (en blanco para no modificar) (antes era: {campos[0]['Titulo']}):")         # Le pido un nuevo Titulo al usuario
            Texto = input(f"Introduce el nuevo Subtitulo del capítulo (en blanco para no modificar) (antes era: {campos[0]['Texto']}):")   # Le pido un nuevo Subtitulo al usuario
            Imagen = input(f"Introduce el nuevo Imagen del capítulo (en blanco para no modificar) (antes era: {campos[0]['Imagen']}):")         # Le pido un nuevo Imagen al usuario
                    
            print(actualizaProyecto(Identificador,Titulo,Texto,Imagen))
        else:
            print("El identificador introducido no es valido")
        
    elif opcion == "5":
        conexion.close()
        break

print("El programa ha finalizado") 
    