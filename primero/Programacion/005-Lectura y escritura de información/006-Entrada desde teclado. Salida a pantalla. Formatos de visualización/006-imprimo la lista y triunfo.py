# Windows: pip install mysql-connector-python
# Mac: pip3 install mysql-connector-python
import mysql.connector

servidor = "localhost"                        # Creo una variable en la que apunto a mi servidor
usuario = "empresa"                           # Creo una variable para definir el usuario
contrasena = "empresa"                        # Creo una variable para definir la contraseña del usuario
base_de_datos = "empresa"                     # Creo una variable para definiar la base de datos a la que me conecto

conexion = mysql.connector.connect(
    host=servidor,      
    database=base_de_datos,  
    user=usuario,  
    password=contrasena  
)                                             # Establezco una conexión con la base de datos con los datos seleccionados

peticion = "SELECT * FROM clientes;"            # Preparo una petición

cursor = conexion.cursor()                      # Una petición en Python requiere un cursor

cursor.execute(peticion)                        # En el cursor, ejecuto la petición que he dejado preparada arriba
filas = cursor.fetchall()                       # En una variable llamadas filas, almaceno los resultados que me da la base de datos

for fila in filas:                              # Como filas representa a todas las filas, yo quiero coger una a una
    print(fila)                                 # Imprimo cada fila individualmente