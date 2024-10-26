from PIL import Image, ImageDraw, ImageFont
from funcionfechassemanas import *



def generaimagenes(imagenfondo,asignatura,fechas):                              # Creamos una funcion reutilizable
    for fecha in fechas:                                                        # PAra cada una de las fechas
        ################################# CREO UNA NUEVA IMAGEN #################################
        imagen = Image.new(
            'RGB',
            (1920, 1080),
            color=(255, 0, 0)
            )
        ################################# IMAGEN DE FONDO #################################
        imagencargada = Image.open(imagenfondo)                                 # Abrimos la imagen jpg de fondo
        escalada = imagencargada.resize((1920,1080))                            # La escalamos a 1920 x 1080
                                                                           # Creo una nueva imagen de fondo
        imagen.paste(
            escalada,
            (0,0)
            )                                                                   # Le pego encima el jpg de fondo que he cargado
        ################################# RECTANGULO BLANCO #################################
        dibujo = ImageDraw.Draw(imagen, "RGBA")                                 # Voy a crear un nuevo dibujo
        rectangulocoords = [(0, 800), (1920, 1080)]                             # Defino las coordenadas de un rectángulo
        negrotransparente = (255,255,255, 200)                                  # Defino un color que al final es blanco transparente
        dibujo.rectangle(rectangulocoords, fill=negrotransparente)              # En la imagen dibujo un color
        ################################# LOGOTIPO
        imagenlogo = Image.open("tame.png").convert("RGBA")                     # Cargo el logo de TAME
        imagen.paste(
            imagenlogo,
            (1450,850)
            )                                                                   # Pego el logo en la imagen
        ################################# TEXTO #################################
        try:
            fuente = ImageFont.truetype("parrafo.ttf", 60) 
        except IOError:
            fuente = ImageFont.load_default()
        texto = asignatura+" - clase "+str(fecha)
        posiciontexto = (200, 880)  
        colortexto = (0,0,0)  
        dibujo.text(posiciontexto, texto, font=fuente, fill=colortexto)
        ################################# GUARDO LA IMAGEN #################################
        ruta = 'imagenes/'+asignatura+'-'+str(fecha)+'.jpg'
        imagen.save(ruta)
        
inicio = '2024-09-01'
final = '2025-06-01'

fechas = generate_specific_weekday_dates(inicio,final,2)
generaimagenes("marcas.jpg","Lenguajes de marcas",fechas)

fechas = generate_specific_weekday_dates(inicio,final,3)
generaimagenes("marcas.jpg","Lenguajes de marcas",fechas)

fechas = generate_specific_weekday_dates(inicio,final,3)
generaimagenes("programacion.jpg","Programación",fechas)

fechas = generate_specific_weekday_dates(inicio,final,4)
generaimagenes("programacion.jpg","Programación",fechas)

fechas = generate_specific_weekday_dates(inicio,final,3)
generaimagenes("basesdedatos.jpg","Bases de datos",fechas)

fechas = generate_specific_weekday_dates(inicio,final,4)
generaimagenes("sistemas.jpg","Sistemas informáticos",fechas)

fechas = generate_specific_weekday_dates(inicio,final,3)
generaimagenes("entornos.jpg","Entornos de desarollo",fechas)

fechas = generate_specific_weekday_dates(inicio,final,4)
generaimagenes("proyecto.jpg","Proyecto intermodular",fechas)





