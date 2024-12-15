import matplotlib.pyplot as plt
import psutil

# Obtener métricas del sistema
carga_cpu = psutil.cpu_percent(interval=1)
carga_ram = psutil.virtual_memory().percent
uso_disco = psutil.disk_usage('/').percent

# Guardar las métricas en un archivo
ruta_archivo = "C:/Users/franh/Desktop/backups/cargaampliada.txt"
with open(ruta_archivo, 'a') as archivo:
    archivo.write(f"{carga_cpu},{carga_ram},{uso_disco}\n")

# Leer y procesar el archivo para las gráficas
with open(ruta_archivo, 'r') as archivo:
    lineas = archivo.readlines()

datos_cpu, datos_ram, datos_disco = [], [], []
for linea in lineas:
    linea = linea.strip()
    if linea:
        cpu, ram, disco = map(float, linea.split(','))
        datos_cpu.append(cpu)
        datos_ram.append(ram)
        datos_disco.append(disco)

# Generar y guardar gráfica de CPU
plt.figure(figsize=(10, 6))
plt.plot(datos_cpu, label='CPU', marker='o', color='blue')
plt.grid(True)
plt.ylim(0, 100)
plt.title('Uso de CPU')
plt.xlabel('Muestras')
plt.ylabel('Porcentaje de Uso')
plt.legend()
plt.savefig("C:/Users/franh/Desktop/backups/carga_cpu.jpg")
plt.close()

# Generar y guardar gráfica de RAM
plt.figure(figsize=(10, 6))
plt.plot(datos_ram, label='RAM', marker='s', color='green')
plt.grid(True)
plt.ylim(0, 100)
plt.title('Uso de RAM')
plt.xlabel('Muestras')
plt.ylabel('Porcentaje de Uso')
plt.legend()
plt.savefig("C:/Users/franh/Desktop/backups/carga_ram.jpg")
plt.close()

# Generar y guardar gráfica de Disco
plt.figure(figsize=(10, 6))
plt.plot(datos_disco, label='Disco', marker='^', color='red')
plt.grid(True)
plt.ylim(0, 100)
plt.title('Uso de Disco')
plt.xlabel('Muestras')
plt.ylabel('Porcentaje de Uso')
plt.legend()
plt.savefig("C:/Users/franh/Desktop/backups/carga_disco.jpg")
plt.close()

print("Métricas guardadas y gráficas generadas correctamente.")