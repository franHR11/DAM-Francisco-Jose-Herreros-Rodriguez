from PIL import Image

imagencargada = Image.open('a.jpg')

width, height = 1920, 1080
imagen = Image.new(
    'RGB',
    (width, height),
    color=(255, 0, 0)
    )

imagen.paste(
    imagencargada,
    (0,0)
    )

ruta = 'imagen.jpg'

imagen.save(ruta)