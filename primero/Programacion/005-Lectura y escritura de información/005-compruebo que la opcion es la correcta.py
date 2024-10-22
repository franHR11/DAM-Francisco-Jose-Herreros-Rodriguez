import mysql.connector

connection = mysql.connector.connect(
    host='localhost',   
    user='empresa',   
    password='empresa',
    database='empresa' 
)

cursor = connection.cursor()

print("Programa de gestión de empresa v0.1")                                # Mensaje de bienvenida
print("por Francisco Jose Herreros Rodriguez")

print("Selecciona una tabla de la base de datos:")                          # Se invita a seleccionar una opción

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
opcion = input("Selecciona una opcion:")
print("Vamos a trabajar con la entidad:",tablas[int(opcion)])               # Comprobación de que todo va bien# Selecciona una opción