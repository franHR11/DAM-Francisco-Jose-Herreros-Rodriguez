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
        cursor.execute("SHOW COLUMNS IN clientes")                                                      # En primer lugar quiero un informe de qué columnas tiene esta tabla
        filas = cursor.fetchall()                                                                       # Las meto en una lista
        columnas = []                                                                                   # Creo un listado de columnas
        valores = []                                                                                    # Creo un listado de valores
        for fila in filas:                                                                              # Para cada una de las columnas
            if fila['Key'] != "PRI":                                                                    # Me salto la columna que sea clave primaria
                columnas.append(fila['Field'])                                                          # Añado la columna a la lista de columnas
                valores.append(input("Introduce el valor para el campo "+fila['Field']+":"))            # Permito al usuario introducir un nuevo valor y lo pongo en la lista de valores
        peticion = "INSERT INTO clientes ("                                                             # Empiezo a formatear una peticion
        for columna in columnas:                                                                        # Para cada una de las columnas
            peticion += columna+","                                                                     # Le añado a la peticion el nombre de la columna
        peticion = peticion[:-1]                                                                        # Le quito la última coma al listado de campos
        peticion += ") VALUES ("                                                                        # Le añado el anticipo de los valores
        for valor in valores:                                                                           # Para cada uno de los valores
            peticion += "'"+valor+"',"                                                                  # Le añado a la peticion el valor
        peticion = peticion[:-1]                                                                        # Le quito la última coma al listado de valores
        peticion += ")"                                                                                 # Cierro el ultimo paréntesis
        
        print(peticion) 
            
        
    elif opcion == "2":
        print("Vamos a listar los clientes")