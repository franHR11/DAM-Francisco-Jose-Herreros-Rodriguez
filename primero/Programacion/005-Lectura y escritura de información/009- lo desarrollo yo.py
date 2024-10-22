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

opcionnivel2 = input("Selecciona una opcion:")                                    # Selecciona una opción

if opcionnivel2 == "1":
    print("Vamos a insertar un nuevo ",tablas[int(opcion)])
    
    
        # Obtener las columnas de la tabla seleccionada
    peticion_columnas = "SHOW COLUMNS FROM " + tablas[int(opcion)]
    cursor.execute(peticion_columnas)  # Ejecuto la consulta para obtener las columnas
    columnas = cursor.fetchall()  # Obtengo las columnas

    valores = []  # Lista para almacenar los valores que vamos a insertar
    for columna in columnas:
        valor = input(f"Introduce el valor para {columna[0]}: ")  # Pregunto al usuario el valor de cada columna
        valores.append(valor)  # Guardo el valor en la lista de valores

    # Crear una consulta INSERT dinámica usando las columnas y los valores proporcionados
    columnas_str = ', '.join([columna[0] for columna in columnas])  # Convertir las columnas a formato SQL
    valores_placeholder = ', '.join(['%s'] * len(valores))  # Crear los placeholders para el INSERT

    peticion_insert = f"INSERT INTO {tablas[int(opcion)]} ({columnas_str}) VALUES ({valores_placeholder})"

    cursor.execute(peticion_insert, valores)  # Ejecuto el INSERT con los valores
    connection.commit()  # Confirmo la inserción de los datos
    print("Registro insertado correctamente.")
    
    
    
    
    
elif opcionnivel2 == "2":
    print("Vamos a listar ",tablas[int(opcion)])
    peticion = "SELECT * FROM "+tablas[int(opcion)]                         # Creo una peticion DINÁMICA ###################################
    cursor.execute(peticion)                                                # Ejecuto la petición                                   
    filas = cursor.fetchall()                                               # Cargo el resultado
    for fila in filas:                                                      # Repaso las filas
        print(fila)                                                         # Imprimo la fila

elif opcionnivel2 == "3":
    print("Vamos a actualizar ",tablas[int(opcion)])

elif opcionnivel2 == "4":
    print("Vamos a eliminar ",tablas[int(opcion)])
    
    
    