import tkinter as tk

ventana = tk.Tk()

def saluda():
    print("Yo te saludo")

boton = tk.Button(
    ventana,
    text="Pulsame"
    )
boton.pack(padx=50,pady=50)

ventana.mainloop()