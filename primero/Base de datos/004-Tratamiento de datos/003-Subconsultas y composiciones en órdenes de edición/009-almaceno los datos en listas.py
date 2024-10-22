import mysql.connector

connection = mysql.connector.connect(
    host='localhost',   
    user='empresa',   
    password='empresa',
    database='empresa' 
)

cursor = connection.cursor(dictionary = True)

while True:
    print("Programa de gestión de clientes")
    print("1.-Insertar un cliente")
    print("2.-Listado de clientes")
    print("3.-...")
    opcion = input("Selecciona una opcion:")
    print("La opción que has escogido es:"+opcion)

    if opcion == "1":
        print("Vamos a insertar un cliente")
        cursor.execute("SHOW COLUMNS IN clientes")                                      # En primer lugar quiero un informe de qué columnas tiene esta tabla
        filas = cursor.fetchall()                                                       # Las meto en una lista
        columnas = []                                                                   # Creo una lista vacía para las columnas
        valores = []                                                                    # Creo una lista vacía para los valores
        for fila in filas:                                                              # Para cada una de las columnas
            if fila['Key'] != "PRI":                                                    # Me salto la columna que sea clave primaria
                columnas.append(fila['Field'])                                          # Añado el nombre de la columna a la lista de columnas
                valores.append(input("Introduce el valor para el campo "+fila['Field']+":"))            # Permito al usuario introducir un nuevo valor
        print(columnas)
        print(valores)
            
        
    elif opcion == "2":
        print("Vamos a listar los clientes")