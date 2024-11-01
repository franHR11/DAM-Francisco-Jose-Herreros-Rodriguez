from ConectorDB import *
    
conexion1 = ConectorBD()
print(conexion1.dameTablas())
print(conexion1.leerTabla("clientes"))
print(conexion1.leerTabla("productos"))