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

print("###############################")        # Lanzamos un mensaje de bienvenida en la pantalla
print("Bienvenido al programa CRUD completo")
print("###############################")

while True:                                     # Entramos en un bucle infinito

    print("Selecciona una opcion")              # Invitamos al usuario a esgoger una opcion
    print("1.Crear nuevo cliente")
    print("2.Leer clientes Existente")
    print("3.Actualizar clientes Existente")
    print("4.Eliminar clientes")
    print("5.Salir del programa")

    opcion = input("Introduce el numero de la opcion deseada: ")        # Tomamos una opción por parte del usuario
    print("Has seleccionado la opcion: ", opcion)                       # Le informamos al usuario de la opción que ha escogido


    if opcion == "1":                                                   # En el caso de que haya escogido la opción de insertar
        print("vamos a crear un nuevo Usuario")                         # Aviso al usuario de la operación que voy a realizar
        nombre = input("Introduce el nombre del Usuario: ")             # Le pido el nombre y lo meto en una variable
        apellidos = input("Introduce los apellidos del Usuario: ")      # Le pido los apellidos y los meto en una variable
        email = input("Introduce el email del Usuario: ")               # Le pido el email y lo meto en una variable
        poblacion = input("Introduce la poblacion del Usuario: ")       # Le pido la población y la meto en una variable
        fechadenacimiento = input("Introduce la fecha de nacimiento del Usuario: ")     # Le pido la fecha de nacimiento y la meto en una variable
        peticion = "INSERT INTO clientes VALUES (NULL,'"+nombre+"','"+apellidos+"','"+email+"','"+poblacion+"','"+fechadenacimiento+"');"                                # Preparo una petición de inserción a la base de datos
        cursor = conexion.cursor()                                          # Una petición en Python requiere un cursor
        cursor.execute(peticion)                                            # En el cursor, ejecuto la petición que he dejado preparada arriba
        conexion.commit()                                                   # Por último, proceso la petición en el servidor
    elif opcion == "2":
        print("vamos a listar los Usuarios existentes")
        peticion = "SELECT * FROM clientes;"                                # Preparo una petición de inserción a la base de datos
        cursor = conexion.cursor()                                          # Una petición en Python requiere un cursor
        cursor.execute(peticion)                                            # En el cursor, ejecuto la petición que he dejado preparada arriba
        filas = cursor.fetchall()                                           # En una variable llamadas filas, almaceno los resultados que me da la base de datos
        for fila in filas:                                                  # Como filas representa a todas las filas, yo quiero coger una a una
                                                               # Imprimo cada fila individualmente
            print("########################")                               # Separador totalmente cosmético
            print("El identificador es:",fila[0])                           # cada uno de los datos es un elemento de colección de la tupla
            print("El nombre es:",fila[1])
            print("El apellido es:",fila[2])
            print("El email es:",fila[3])
            print("La localidad es:",fila[4])
            print("La fecha de nacimiento es:",fila[5])
            
    elif opcion == "3":
        print("vamos a actualizar los Usuarios existentes")
    elif opcion == "4":
            print("vamos a eliminar los Usuarios existentes")
    elif opcion == "5":
            exit()
    else:
        print("Opción incorrecta")                
