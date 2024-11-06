import tkinter as tk

ventana = tk.Tk()

def click(event):
    print("Yo te saludo")

def clickmedio(event):
    print("HAS hecho click con el boton del medio del raton")

def clickderecho(event):
    print("HAS hecho click con el boton derecho del raton")

def dobleclick(event):
    print("HAS hecho doble click con el boton izquierdo del raton")

def entrar(event):
    print("Has entrado")

def salir(event):
    print("Has salido")

boton = tk.Button(
    ventana,
    text="Pulsame"
    )
boton.pack(padx=50,pady=50)

boton.bind("<Button-1>",click)
boton.bind("<Button-2>",clickmedio)
boton.bind("<Button-3>",clickderecho)

boton.bind("<Double-Button-1>",dobleclick)

boton.bind("<Enter>",entrar)
boton.bind("<Leave>",salir)

ventana.mainloop()