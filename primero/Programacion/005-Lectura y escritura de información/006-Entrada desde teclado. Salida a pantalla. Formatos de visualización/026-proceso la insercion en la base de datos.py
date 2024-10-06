'''
    Programa CRUD completo
    v0.1 Francisco Jose Herreros Rodriguez
    El objetivo de este programa es construir el CRUD completo contra MySQL
'''
import mysql.connector                          # Importo la librería para poder conectarme a MySQL

servidor = "localhost"                          # Creo una variable en la que apunto a mi servidor
usuario = "empresa"                           # Creo una variable para definir el usuario
contrasena = "empresa"                        # Creo una variable para definir la contraseña del usuario
base_de_datos = "empresa"                     # Creo una variable para definiar la base de datos a la que me conecto

conexion = mysql.connector.connect(
    host=servidor,      
    database=base_de_datos,  
    user=usuario,  
    password=contrasena  
)                                               # Establezco una conexión con la base de datos con los datos seleccionados

print("###############################")
print("Bienvenido al programa CRUD completo")
print("###############################")

while True:

    print("Selecciona una opcion")
    print("1.Crear nuevo cliente")
    print("2.Leer clientes Existente")
    print("3.Actualizar clientes Existente")
    print("4.Eliminar clientes")
    print("5.Salir del programa")

    opcion = input("Introduce el numero de la opcion deseada: ")
    print("Has seleccionado la opcion: ", opcion)


    if opcion == "1":
        print("vamos a crear un nuevo cliente")
        nombre = input("Introduce el nombre del cliente: ")
        apellidos = input("Introduce los apellidos del cliente: ")
        email = input("Introduce el email del cliente: ")
        poblacion = input("Introduce la poblacion del cliente: ")
        fechadenacimiento = input("Introduce la fecha de nacimiento del cliente: ")
        peticion = "INSERT INTO clientes VALUES (NULL,'','','','','');"                                # Preparo una petición de inserción a la base de datos
        cursor = conexion.cursor()                                          # Una petición en Python requiere un cursor
        cursor.execute(peticion)                                            # En el cursor, ejecuto la petición que he dejado preparada arriba
        conexion.commit()
    elif opcion == "2":
        print("vamos a leer los clientes existentes")
    elif opcion == "3":
        print("vamos a actualizar los clientes existentes")
    elif opcion == "4":
            print("vamos a eliminar los clientes existentes")
    elif opcion == "5":
            exit()
    else:
        print("Opción incorrecta")                
