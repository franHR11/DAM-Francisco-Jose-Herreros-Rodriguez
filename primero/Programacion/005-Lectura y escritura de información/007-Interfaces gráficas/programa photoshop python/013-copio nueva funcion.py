from PIL import Image, ImageDraw, ImageFont
from funcionfechassemanas import *



def generaimagenes(imagenfondo, asignatura, fechas):
    for fecha in fechas:
        # Open the background image and resize it
        imagencargada = Image.open(imagenfondo)
        escalada = imagencargada.resize((1920, 1080))
        
        # Create a new image with RGBA mode to support transparency
        imagen = Image.new('RGBA', (1920, 1080))
        
        # Paste the background image onto the new image
        imagen.paste(escalada, (0, 0))
        
        # Open the logo image with transparency
        imagenlogo = Image.open("tame.png").convert("RGBA")
        
        # Paste the logo onto the image (ensure it retains transparency)
        imagen.paste(imagenlogo, (1550, 100), imagenlogo)
        
        # Create a drawing context with transparency
        dibujo = ImageDraw.Draw(imagen, "RGBA")
        
        # Draw a semi-transparent black rectangle at the bottom
        rectangulocoords = [(0, 800), (1920, 1080)]
        negrotransparente = (0, 0, 0, 200)
        dibujo.rectangle(rectangulocoords, fill=negrotransparente)
        
        # Load the font, or use a default if not found
        try:
            fuente = ImageFont.truetype("parrafo.ttf", 80)
        except IOError:
            fuente = ImageFont.load_default()
        
        # Add text on top of the rectangle
        texto = asignatura + " - clase " + str(fecha)
        posiciontexto = (200, 860)
        colortexto = (255, 255, 255)
        dibujo.text(posiciontexto, texto, font=fuente, fill=colortexto)
        
        # Save the image
        ruta = 'imagenes/' + asignatura + '-' + str(fecha) + '.jpg'  # Save as PNG to keep transparency
        imagen.save(ruta)
        
inicio = '2024-09-01'
final = '2024-10-01'

fechas = generate_specific_weekday_dates(inicio,final,2)
generaimagenes("marcas.jpg","Lenguajes de marcas",fechas)





