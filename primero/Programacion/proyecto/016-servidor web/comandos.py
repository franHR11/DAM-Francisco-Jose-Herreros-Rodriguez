from ConectorBD import *
    
conexion1 = ConectorBD()
    
print("Programa de gestion de empresa")
print("v0.1 por Francisco Jose Herreros")
while True:
    print("Menú inicial")
    print("Tablas:")
    tablas = conexion1.dameTablas()
    for tabla in tablas:
        print(str(tablas.index(tabla)+1)+" - "+tabla['Tables_in_programacion'])
    opcion = input("Selecciona una tabla: ")

    print("Has seleccionado la opcion: "+opcion)
    print("Vamos a trabajar con la tabla:"+tablas[int(opcion)-1]['Tables_in_programacion'])

    print("Ahora escoge una opcion")
    print("1.-Insertar registros")
    print("2.-Listar registros")
    print("3.-Actualizar registros")
    print("4.-Eliminar registros")

    opcion2 = input("Selecciona una operación:")

    if opcion2 == "1":
        print("Insertaremos un registro")
    elif opcion2 == "2":
        print(conexion1.leerTabla(tablas[int(opcion)-1]['Tables_in_programacion']))
    elif opcion2 == "3":
        print("Actualizaremos un registro")
    elif opcion2 == "4":
        print("Eliminaremos un registro")