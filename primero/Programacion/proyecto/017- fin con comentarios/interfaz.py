from ConectorBD import *                                        # importo la base de datos
import tkinter as tk                                            # importo la libreria de interfaces

conexion1 = ConectorBD()                                        # Creo una nueva instancia

def damedatos(tabla):                                           # defino que ocurre cuando pulso un boton
    print(tabla)
    global texto
    datos = conexion1.leerTabla(tabla)
    textoformateado = ""
    ############################ FORMATO AL TEXTO #############################
    for dato in datos:                                          # Itera sobre las claves y valores del diccionario

        for clave, valor in dato.items():
            textoformateado += f"{clave}: {valor}\n"
        textoformateado += "---------------\n"
    ############################ FORMATO AL TEXTO #############################
    texto.delete(1.0, tk.END)                                   # Borra lo que habia antes
    texto.insert(tk.END, textoformateado)                       # Inserta 'textoformateado' correctamente formateado

ventana = tk.Tk()                                               # creo una ventana de tkinter

tablas = conexion1.dameTablas()                                 # Pido un listado de tablas

for tabla in tablas:                                            # Para cada una de las tablas
    tk.Button(
        ventana,
        text=tabla['Tables_in_programacion'],
        command=lambda t=tabla['Tables_in_programacion']: damedatos(t)
    ).pack(padx=10, pady=10)                                   # Creo un nuevo boton

texto = tk.Text(ventana)                                        # añado un nuevo elemento de texto
texto.pack(padx=10, pady=10)                                    # Lo empaqueto

ventana.mainloop()                                              # Pongo el programa en funcionamiento