# Windows: pip install mysql-connector-python
# Mac: pip3 install mysql-connector-python
import mysql.connector

servidor = "localhost"
usuario = "empresa"
contrasena = "empresa"
base_de_datos = "empresa"

conexion = mysql.connector.connect(
    host=servidor,      
    database=base_de_datos,  
    user=usuario,  
    password=contrasena  
)