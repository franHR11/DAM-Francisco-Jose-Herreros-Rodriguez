import tkinter as tk

ventana = tk.Tk()
ventana.geometry("500x500+200+200")
ventana.title("El programa de francisco Jose")

def ejecutaAlgo():
    print("ok veo que has pulsado el boton")
    global texto                                                    # Meto la variable externa dentro de la funcion
    texto.config(text="Este texto te lo estoy escribiendo desde Python")

texto = tk.Label(
    ventana,
    text="Hola a todos este es mi primer programa"
    )                                                               # Aquí creo un texto en memoria
texto.pack(padx=10,pady=10)                                         # Ahora añado el texto a la interfaz

tk.Entry(ventana).pack(padx=10,pady=10)

tk.Button(
    ventana,
    text="Pulsame si te atreves",
    command=ejecutaAlgo
    ).pack(padx=10,pady=10)

ventana.mainloop()