import requests
import time

url = "http://localhost/dam/Primero/Lenguajes%20de%20marcas%20y%20sistemas%20de%20gesti%C3%B3n%20de%20informaci%C3%B3n/003-Manipulaci%C3%B3n%20de%20documentos%20Web/proyectos/004-proyecto%20Apple/040-enrutador/front/"
for _ in range(0,1000):
    try:
        response = requests.get(url)
        # Verificar si la solicitud fue exitosa
        if response.status_code == 200:
            #print("Contenido de la página:")
            #print(response.text)  # Imprime el contenido de la página
            print("ok")
            #pass
        else:
            print(f"Error en la solicitud: {response.status_code}")
    except requests.exceptions.RequestException as e:
        print(f"Error al cargar la URL: {e}")

    #time.sleep(1)