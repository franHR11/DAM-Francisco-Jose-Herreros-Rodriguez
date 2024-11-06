import tkinter as tk

ventana = tk.Tk()

def saluda():
    print("Yo te saludo")

tk.Button(
    ventana,
    text="Pulsame",
    command = saluda
    ).pack(padx=50,pady=50)

ventana.mainloop()