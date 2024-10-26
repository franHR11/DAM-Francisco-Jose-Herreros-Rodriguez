from PIL import Image

width, height = 1920, 1080     # Tamaño de la imagen
imagen = Image.new(
    'RGB',                     # Formato de la imagen
    (width, height),  
    color=(255, 0, 0)          # Color de la imagen
    )

ruta = 'imagen.jpg'            # Ruta de la imagen
imagen.save(ruta)              # Guardar la imagen