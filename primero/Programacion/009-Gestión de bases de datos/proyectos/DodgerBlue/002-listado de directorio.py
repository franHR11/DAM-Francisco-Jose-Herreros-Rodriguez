import os

ruta = "E:/xampp/htdocs/DAM-Francisco-Jose-Herreros-Rodriguez/primero"

carpetas = os.listdir(ruta)

for carpeta in carpetas:
    print(carpeta)