import requests

url = "https://jocarsa.com"
try:
    response = requests.get(url)
    # Verificar si la solicitud fue exitosa
    if response.status_code == 200:
        #print("Contenido de la página:")
        #print(response.text)  # Imprime el contenido de la página
        print("ok")
    else:
        print(f"Error en la solicitud: {response.status_code}")
except requests.exceptions.RequestException as e:
    print(f"Error al cargar la URL: {e}")