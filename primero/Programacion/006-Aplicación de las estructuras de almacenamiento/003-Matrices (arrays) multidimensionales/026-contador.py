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
    print("3. Eliminar un contactos:")
    opcion = input("Seleciona una de las opciones:")
    
    limpiar_pantalla()

    print ("Has seleccionado la opcion:",opcion)

    if opcion == '1':
        print("vamos a insertar un nuevo contacto:")
        nombre = input("Introduce el nombre del contacto:")
        apellido = input("Introduce el apellido del contacto:")
        email = input("Introduce el email del contacto:")
        telefono = input("Introduce el telefono del contacto:")
        agenda.append([nombre,apellido,email,telefono])
    elif opcion == '2':  
            contador = 0    
            print("vamos a leer los contactos:")
            for contacto in agenda:
                print("###########################")
                print("Contacto numero",contador,":")
                print("Nombre:\t\t",contacto[0])
                print("Apellido:\t",contacto[1])
                print("Email:\t\t",contacto[2])
                print("Telefono:\t",contacto[3])
                contador =+ 1
                print("###########################")
                input("Pulsa una tecla para continuar.....")
    elif opcion == '3':
        limpiar_pantalla()
        print("vamos a eliminar un contacto:")
        opcion = input("Introduce el numero de registro del contacto a eliminar:")
        opcion = int(opcion)
        agenda.pop(opcion)
        input("Pulsa una tecla para ir al menu principal")