from tkinter import *

root = Tk()
root.title("Ventana de prueba")
root.geometry("500x500")
e = Entry(root, width=50)
e.pack()
e.insert(0, "Ingresa tu nombre")
 
def click():
    texto = e.get()
    texvariable.set(texto)
    # l = Label(root, text="Hola mundo")
    # l.pack()
    e.delete(0, END)
    # l.configure(text=texto)
  



btn = Button(root, text="Clickeame", command=click, fg="#ffffff", bg="blue")
btn.pack()


texvariable = StringVar()

l = Label(root, textvariable=texvariable)
l.pack()


root.mainloop()