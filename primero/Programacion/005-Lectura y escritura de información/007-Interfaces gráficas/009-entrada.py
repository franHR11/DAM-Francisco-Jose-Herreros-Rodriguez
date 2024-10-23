import tkinter as tk

ventana = tk.Tk()
ventana.geometry("500x500+200+200")
ventana.title("El programa de francisco Jose")

tk.Label(ventana, text="Hola mundo desde tkinter").pack(padx=10, pady=10)
tk.Entry(ventana).pack(padx=10, pady=10)

ventana.mainloop()