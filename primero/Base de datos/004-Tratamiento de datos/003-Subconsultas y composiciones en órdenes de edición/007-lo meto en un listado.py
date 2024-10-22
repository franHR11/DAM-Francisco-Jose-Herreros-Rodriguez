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
        cursor.execute("SHOW COLUMNS IN clientes")
        filas = cursor.fetchall()
        campos = []
        for fila in filas:
            campos.append(fila['Field'])
        for campo in campos:
            input("Introduce el valor para el campo "+campo+":")
        
    elif opcion == "2":
        print("Vamos a listar los clientes")