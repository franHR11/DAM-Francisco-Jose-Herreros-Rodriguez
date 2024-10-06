'''
    Programa CRUD completo
    v0.1 Francisco Jose Herreros Rodriguez
    El objetivo de este programa es construir el CRUD completo contra MySQL
'''

print("###############################")
print("Bienvenido al programa CRUD completo")
print("###############################")


print("Selecciona una opcion")
print("1.Crear nuevo cliente")
print("2.Leer clientes Existente")
print("3.Actualizar clientes Existente")
print("3.Eliminar clientes")

opcion = input("Introduce el numero de la opcion deseada: ")
print("Has seleccionado la opcion: ", opcion)


if opcion == "1":
    print("vamos a crear un nuevo cliente")
elif opcion == "2":
    print("vamos a leer los clientes existentes")
elif opcion == "3":
    print("vamos a actualizar los clientes existentes")
elif opcion == "4":
        print("vamos a eliminar los clientes existentes")
else:
    print("Opción incorrecta")                
