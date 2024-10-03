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
    opcion = input("Seleciona una de las opciones")

    print ("Has seleccionado la opcion",opcion)

    if(opcion == '1'):
        print("Has seleccionado la opcion 1")
    elif(opcion == '2'):
            print("Has seleccionado la opcion 2")
            print(agenda)

    