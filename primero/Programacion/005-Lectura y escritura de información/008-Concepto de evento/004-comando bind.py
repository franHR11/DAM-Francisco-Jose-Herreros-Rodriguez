import tkinter as tk

ventana = tk.Tk()

def click(event):
    print("Yo te saludo")

def clickmedio(event):
    print("HAS hecho click con el boton del medio del raton")

boton = tk.Button(
    ventana,
    text="Pulsame"
    )
boton.pack(padx=50,pady=50)

boton.bind("<Button-1>",click)
boton.bind("<Button-2>",clickmedio)

ventana.mainloop()