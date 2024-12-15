import os
import time
from datetime import datetime
import shutil
import subprocess
import paramiko

def upload_folder_to_sftp(sftp, local_folder, remote_folder):
    """Sube una carpeta completa al servidor SFTP"""
    try:
        # Intenta crear el directorio remoto
        sftp.mkdir(remote_folder)
        print(f"Directorio remoto creado: {remote_folder}")
    except IOError:
        print(f"El directorio remoto ya existe: {remote_folder}")
    
    # Recorre los archivos y subcarpetas en el directorio local
    for item in os.listdir(local_folder):
        local_path = os.path.join(local_folder, item)
        remote_path = f"{remote_folder}/{item}"
        
        if os.path.isfile(local_path):
            # Subir archivo
            print(f"Subiendo archivo: {item}")
            sftp.put(local_path, remote_path)
        elif os.path.isdir(local_path):
            # Subir subcarpeta
            print(f"Subiendo carpeta: {item}")
            upload_folder_to_sftp(sftp, local_path, remote_path)

try:                                                                    # Intento
    os.mkdir("/home/josevicente/backups")                               # Crear la carpeta de backups
except:                                                                 # En el caso de que de error
    print("la carpeta ya existe, continuamos...")                       # Saco un mensaje por consola

ahora = datetime.now()                                                  # Atrapo el tiempo actual
fecha = ahora.strftime("%Y-%m-%d-%H-%M-%S")                             # Lo formateo en un formato humanamente entendible
epoch = str(round(time.time()))                                         # Obtengo la era unix
fechacompuesta = fecha+"_"+epoch                                        # Creo una fecha compuesta
print(fechacompuesta)                                                   # Imprimo la fecha
os.mkdir("/home/josevicente/backups/"+fechacompuesta)                   # Creo un directorio con la fecha compuesta
origen = "/var/www/html/proyecto"                                       # Carpeta de origen
destino = "/home/josevicente/backups/"+fechacompuesta+"/programacion"   # Carpeta de destino
shutil.copytree(origen, destino)                                        # Copio la carpeta
os.mkdir("/home/josevicente/backups/"+fechacompuesta+"/basededatos")    # Creo un directorio con la fecha compuesta
servidor = "localhost"                                                  # Datos del servidor
usuario = "proyectoapple"
contrasena = "proyectoapple"
basededatos = "proyectoapple"

comando = [
        "mysqldump",
        f"--host={servidor}",
        f"--user={usuario}",
        f"--password={contrasena}",
        basededatos
    ]                                                                   # Preparo el comando de copia
archivo = open("/home/josevicente/backups/"+fechacompuesta+"/basededatos/exportacion.sql",'w')  # Creo un archivo de destino
subprocess.run(comando, stdout=archivo, check=True)                     # Ejecuto el proceso
archivo.close()                                                         # Cierro el archivo

servidorftp = 'XXXXXXX'                           # Datos de conexión al SFTP
puertoftp = 22
usuarioftp = 'XXXXXXXXX'
contrasenaftp = 'XXXX'

carpetalocal = "/home/josevicente/backups/"+fechacompuesta              # Carpeta de origen en mi ordenador
carpetaremota = ""                                                      # Carpeta de destino en el FTP

ssh = paramiko.SSHClient()                                              # Arranco un cliente SSH
ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())               # Acepto la clave de licencia
ssh.connect(
    servidorftp,
    port=puertoftp,
    username=usuarioftp,
    password=contrasenaftp)                                             # Me conecto por ssh  

sftp = ssh.open_sftp()                                                  # Abro una conexion SFTP en SSH

upload_folder_to_sftp(sftp, carpetalocal, carpetaremota)                # Subo recursivamente
sftp.close()                                                            # Cierro el SFTP
ssh.close()                                                             # Cierro el SSH















