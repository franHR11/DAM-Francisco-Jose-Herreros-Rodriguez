from PIL import Image, ImageDraw, ImageFont
from funcionfechassemanas import *



def generaimagenes(imagenfondo,asignatura,fechas,curso):                              # Creamos una funcion reutilizable
    for fecha in fechas:                                                        # PAra cada una de las fechas
        ################################# CREO UNA NUEVA IMAGEN #################################
        imagen = Image.new(
            'RGB',                                                         # Defino el modo de color
            (1920, 1080),                                                  # Defino el tamaño de la imagen
            color=(255, 0, 0)                                              # Defino el color de fondo (rojo
            )
        ################################# IMAGEN DE FONDO #################################
        imagencargada = Image.open(imagenfondo)                                 # Abrimos la imagen jpg de fondo
        escalada = imagencargada.resize((1920,1080))                            # La escalamos a 1920 x 1080
                                                                                # Creo una nueva imagen de fondo
        imagen.paste(
            escalada,                                                           # Pego la imagen escalada
            (0,0)
            )                                                                   # Le pego encima el jpg de fondo que he cargado
        ################################# RECTANGULO BLANCO #################################
        dibujo = ImageDraw.Draw(imagen, "RGBA")                                 # Voy a crear un nuevo dibujo
        rectangulocoords = [(0, 800), (1920, 1080)]                             # Defino las coordenadas de un rectángulo
        negrotransparente = (255,255,255, 200)                                  # Defino un color que al final es blanco transparente
        dibujo.rectangle(rectangulocoords, fill=negrotransparente)              # En la imagen dibujo un color
        ################################# LOGOTIPO
        imagenlogo = Image.open("tame.png").convert("RGBA")                     # Cargo el logo de la empresa
        imagen.paste(
            imagenlogo,
            (1450,850)                                                          # Pego el logo en la imagen
            )                                                                   # Pego el logo en la imagen
        ################################# TEXTO 1 #################################
        try:
            fuente = ImageFont.truetype("parrafo.ttf", 50)                       # Cargo la fuente
        except IOError:
            fuente = ImageFont.load_default()
        texto = asignatura+" - clase "+str(fecha)
        posiciontexto = (200, 910)                                                # Posicion del texto
        colortexto = (0,0,0)                                                      # Color del texto
        dibujo.text(posiciontexto, texto, font=fuente, fill=colortexto)
        ################################# TEXTO 2 #################################
        try:
            fuente = ImageFont.truetype("parrafo.ttf", 50) 
        except IOError:
            fuente = ImageFont.load_default()
        texto = curso
        posiciontexto = (200, 850)                                                # Posicion del texto
        colortexto = (0,0,0)                                                       # Color del texto
        dibujo.text(posiciontexto, texto, font=fuente, fill=colortexto)
        ################################# GUARDO LA IMAGEN #################################
        ruta = 'imagenes/'+asignatura+'-'+str(fecha)+'.jpg'                        # Defino la ruta de la imagen
        imagen.save(ruta)
        
        
        ################################# RANGO DE FECHAS #################################
        
inicio = '2024-09-01'                                                        # Defino la fecha de inicio
final = '2025-06-01'                                                         # Defino la fecha de final

################################# DIAS DE LA SEMANA #################################
"""
    INICIO = fecha de inicio  / FINAL = fecha de final  / 2 = dia de la semana - 1 lunes, 2 martes, 3 miercoles, 4 jueves, 5 viernes, 6 sabado, 7 domingo
dessactivar el codigo de abajo no necesario con un comentario #
"""

fechas = generate_specific_weekday_dates(inicio,final,2)
generaimagenes("marcas.jpg","Lenguajes de marcas",fechas,"Primer curso de DAM")

#fechas = generate_specific_weekday_dates(inicio,final,3)
#generaimagenes("marcas.jpg","Lenguajes de marcas",fechas,"Primer curso de DAM")

#fechas = generate_specific_weekday_dates(inicio,final,3)
#generaimagenes("programacion.jpg","Programación",fechas,"Primer curso de DAM")

#fechas = generate_specific_weekday_dates(inicio,final,4)
#generaimagenes("programacion.jpg","Programación",fechas,"Primer curso de DAM")

#fechas = generate_specific_weekday_dates(inicio,final,3)
#generaimagenes("basesdedatos.jpg","Bases de datos",fechas,"Primer curso de DAM")

#fechas = generate_specific_weekday_dates(inicio,final,4)
#generaimagenes("sistemas.jpg","Sistemas informáticos",fechas,"Primer curso de DAM")

#fechas = generate_specific_weekday_dates(inicio,final,3)
#generaimagenes("entornos.jpg","Entornos de desarollo",fechas,"Primer curso de DAM")

#fechas = generate_specific_weekday_dates(inicio,final,4)
#generaimagenes("proyecto.jpg","Proyecto intermodular",fechas,"Primer curso de DAM")





