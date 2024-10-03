'''
    Programa agenda con colecciones bidimensionales
    (c) 2024 Francisco Jose Herreros Rodriguez
'''
import platform
import os
def limpiar_pantalla():
    if platform.system() == "Windows":
        os.system("cls")
    else:
        os.system("clear")
limpiar_pantalla()
print("Programa agenda (c) 2024 Francisco Jose Herreros Rodriguez")

agenda = []

while True:
    limpiar_pantalla()
    print("selecciona una opcion:")
    print("1. Anadir contacto:")
    print("2. Listar contactos:")
    opcion = input("Seleciona una de las opciones:")
    
    limpiar_pantalla()

    print ("Has seleccionado la opcion:",opcion)

    if(opcion == '1'):
        print("vamos a insertar un nuevo contacto:")
        nombre = input("\033Introduce el nombre del contacto:\033[0m")
        apellido = input("\033Introduce el apellido del contacto:\033[0m")
        email = input("\033Introduce el email del contacto:\033[0m")
        telefono = input("\033Introduce el telefono del contacto:\033[0m")
        agenda.append([nombre,apellido,email,telefono])
    elif(opcion == '2'):
            print("vamos a leer los contactos:")
            for contacto in agenda:
                print("###########################")
                print("Nombre:\t\t",contacto[0])
                print("Apellido:\t",contacto[1])
                print("Email:\t\t",contacto[2])
                print("Telefono:\t",contacto[3])
                print("###########################")
                input("Pulsa una tecla para continuar")
    