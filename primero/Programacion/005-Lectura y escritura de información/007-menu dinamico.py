import mysql.connector

connection = mysql.connector.connect(
    host='localhost',   
    user='empresa',   
    password='empresa',
    database='empresa' 
)

cursor = connection.cursor()

#################################### INTRODUCCIÓN ###########################################

print("Programa de gestión de empresa v0.1")                                # Mensaje de bienvenida
print("por Francisco Jose Herreros Rodriguez")

print("Selecciona una tabla de la base de datos:")                          # Se invita a seleccionar una opción

#################################### MENÚ NIVEL 1: ENTIDADES ###########################################

peticion = "SHOW TABLES;"                                                   # Selecciono de forma dinámica todas las tablas de la base de datos

cursor.execute(peticion)                                                    # Ejecuto la petición en el servidor de MySQL
filas = cursor.fetchall()                                                   # Recupero los datos
tablas = []                                                                 # Como los datos vienen raros, creo una lista vacia
for fila in filas:                                                          # Para cada una de las filas
    tablas.append(fila[0])                                                  # Meto el dato limpio en la lista
contador = 0                                                                # Creo un contador en cero
for tabla in tablas:                                                        # Para cada una de las tablas en la lista
    print(contador,"-",tabla)                                               # La saco por pantalla y le asigno un número
    contador+=1                                                             # Cada vez que paso por aquí subo un número
opcion = input("Selecciona una opcion:")                                    # Selecciona una opción


peticion = "SELECT * FROM "+tablas[int(opcion)]
print("La petición que voy a tirar contra la base de datos es: "+peticion)


#################################### MENÚ NIVEL 2: CRUD DENTRO DE UNA ENTIDAD ###########################################


print("Vamos a trabajar con la entidad:",tablas[int(opcion)])               # Comprobación de que todo va bien
print("1.-Introduce un nuevo "+tablas[int(opcion)]+":")
print("2.-Listar "+tablas[int(opcion)]+":")
print("3.-Actualizar "+tablas[int(opcion)]+":")
print("4.-Eliminar "+tablas[int(opcion)]+":")

