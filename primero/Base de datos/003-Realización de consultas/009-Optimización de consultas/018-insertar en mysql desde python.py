import mysql.connector                          # Importo la librería de la base de datos


servidor = "localhost"                                          # Creo una variable en la que apunto a mi servidor
usuario = "empresa"                                           # Creo una variable para definir el usuario
contrasena = "empresa"                                        # Creo una variable para definir la contraseña del usuario
base_de_datos = "empresa"                                     # Creo una variable para definiar la base de datos a la que me conecto

conexion = mysql.connector.connect(
    host=servidor,      
    database=base_de_datos,  
    user=usuario,  
    password=contrasena  
)                                                               # Establezco una conexión con la base de datos con los datos seleccionados

print("Creador de clientes v0.1 por Francisco Jose Herreros Rodriguez")    # Mensaje de bienvenida
nombre = input("Introduce el nombre del cliente:")              # Pregunto por el nombre de cliente
apellidos = input("Introduce los apellidos del cliente:")       # Pregunto por los apellidos del cliente
email = input("Introduce el email del cliente:")                # Pregunto por el email del cliente
poblacion = input("Introduce la poblacion del cliente:")        # Pregunto por la población del cliente
nacimiento = input("Introduce la fecha de nacimiento del cliente:") # Pregunto por la fecha de nacimiento del cliente

peticion = '''
    INSERT INTO clientes
    VALUES (
        NULL,
        "'''+nombre+'''",
        "'''+apellidos+'''",
        "'''+email+'''",
        "'''+poblacion+'''",
        "'''+nacimiento+'''"
    )
'''                                             # Preparo una petición, es una inserción de un nuevo cliente

cursor = conexion.cursor()                      # Una petición en Python requiere un cursor

cursor.execute(peticion)                        # En el cursor, ejecuto la petición que he dejado preparada arriba
conexion.commit()                               # Cuando no realizo un select sino cualquie otro tipo de operacion, tengo que hacer un commit












    