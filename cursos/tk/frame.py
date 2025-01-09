from tkinter import *

root = Tk()
root.title("Ventana de prueba")
root.geometry("500x500")


# frame = LabelFrame(root, text="login", padx=50, pady=50, borderwidth=10)
frame = Frame(root, padx=50, pady=50, borderwidth=10)
frame.pack(padx=50, pady=50)
l = Label(frame, text="Hola mundo")
btn = Button(frame, text="salir", command=root.quit)
l.pack()
btn.pack()




root.mainloop()