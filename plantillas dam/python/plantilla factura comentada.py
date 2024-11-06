'''
    Programa generador de tickets de fruteria v 0.1
    (c) 2024 Francisco Jose Herreros Rodriguez

    Este software se conecta a una base de datos para sacar un ticket
'''
import mysql.connector                          # Importo la librería de la base de datos

print("###############################")        # imprimo un separador visual en el ticket
print("FACTURA FRUTERIA")
print("###############################")

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

pedido = 2                                      # indico un número de pedido - ahora luego esto se va a hacer dinámico

######################################### DATOS DE CLIENTE ######################################################

peticion = '''
    SELECT 

    clientes.nombre,
    clientes.apellidos,
    clientes.email,
    clientes.poblacion

    FROM pedidos
    LEFT JOIN clientes
    ON pedidos.clientes_apellidos = clientes.Identificador

    WHERE pedidos.Identificador = 2
'''                                             # Preparo una petición, en este caso pido los datos de cliente

cursor = conexion.cursor()                      # Una petición en Python requiere un cursor

cursor.execute(peticion)                        # En el cursor, ejecuto la petición que he dejado preparada arriba
filas = cursor.fetchall()                       # En una variable llamadas filas, almaceno los resultados que me da la base de datos
print("")
print("###############################")
print("DATOS DEL CLIENTE:")
print("###############################")
for fila in filas:                              # Como filas representa a todas las filas, yo quiero coger una a una
    for dato in fila:
        print(dato)
        
######################################### DATOS DE CLIENTE ######################################################

######################################### DATOS DEL PEDIDO ######################################################
        
peticion = '''
    SELECT 

    pedidos.Identificador,
    pedidos.fecha

    FROM pedidos
    LEFT JOIN clientes
    ON pedidos.clientes_apellidos = clientes.Identificador

    WHERE pedidos.Identificador = 2
'''                                             # Preparo una petición

cursor = conexion.cursor()                      # Una petición en Python requiere un cursor

cursor.execute(peticion)                        # En el cursor, ejecuto la petición que he dejado preparada arriba
filas = cursor.fetchall()                       # En una variable llamadas filas, almaceno los resultados que me da la base de datos
print("")
print("###############################")
print("DATOS DEL PEDIDO:")
print("###############################")
for fila in filas:                              # Como filas representa a todas las filas, yo quiero coger una a una
    for dato in fila:
        print(dato)

######################################### DATOS DEL PEDIDO ######################################################

######################################### LINEAS DEL PEDIDO ######################################################

peticion = '''
    SELECT 
    productos.nombre,
    productos.descripcion,
    productos.precio,
    lineaspedido.cantidad,
    productos.precio*lineaspedido.cantidad
    FROM lineaspedido
    LEFT JOIN pedidos 
    ON lineaspedido.pedidos_fecha = pedidos.Identificador
    LEFT JOIN productos
    ON lineaspedido.productos_nombre = productos.Identificador
    WHERE pedidos.Identificador = 2
'''                                             # Preparo una petición

cursor = conexion.cursor()                      # Una petición en Python requiere un cursor

cursor.execute(peticion)                        # En el cursor, ejecuto la petición que he dejado preparada arriba
filas = cursor.fetchall()                       # En una variable llamadas filas, almaceno los resultados que me da la base de datos
print("")
print("###############################")
print("LINEAS DE PEDIDO:")
print("###############################")
for fila in filas:                              # Como filas representa a todas las filas, yo quiero coger una a una
    print("---------------")
    for dato in fila:
        print(dato)

######################################### LINEAS DEL PEDIDO ######################################################











    