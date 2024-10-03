'''
    Programa agenda con colecciones bidimensionales
    (c) 2024 Francisco Jose Herreros Rodriguez
'''

print("Programa agenda (c) 2024 Francisco Jose Herreros Rodriguez")

agenda = []

while True:
    print("selecciona una opcion:")
    print("1. Anadir contacto")
    print("2. Listar contactos")
    opcion = input("Seleciona una de las opciones:")

    print ("Has seleccionado la opcion",opcion)

    if(opcion == '1'):
        print("vamos a insertar un nuevo contacto")
        nombre = input("Introduce el nombre del contacto")
        apellido = input("Introduce el apellido del contacto")
        email = input("Introduce el email del contacto")
        telefono = input("Introduce el telefono del contacto")
        agenda.append([nombre,apellido,email,telefono])
    elif(opcion == '2'):
            print("vamos a leer los contactos")
            for contacto in agenda:
                print("###########################")
                print("Nombre:",contacto[0])
                print("Apellido:",contacto[1])
                print("Email:",contacto[2])
                print("Telefono:",contacto[3])
                print("###########################")
    