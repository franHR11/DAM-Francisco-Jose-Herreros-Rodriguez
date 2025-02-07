from tkinter import *

root = Tk()
root.title("Calculadora")
root.geometry("386x168")
root.configure(bg="#333333")

equation = StringVar()
expression_entry = Entry(root,textvariable=equation)
expression_entry.grid(row=0,columnspan=4, sticky="nswe")

btn7 = Button(root,text=" 7 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "7"))
btn7.grid(row=1,column=0, sticky="nswe")
btn8 = Button(root,text=" 8 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "8"))
btn8.grid(row=1,column=1, sticky="nswe")
btn9 = Button(root,text=" 9 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "9"))
btn9.grid(row=1,column=2, sticky="nswe")


btn4 = Button(root,text=" 4 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "4"))
btn4.grid(row=2,column=0, sticky="nswe")
btn5 = Button(root,text=" 5 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "5"))
btn5.grid(row=2,column=1, sticky="nswe")
btn6 = Button(root,text=" 6 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "6"))
btn6.grid(row=2,column=2, sticky="nswe")


btn1 = Button(root,text=" 1 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "1"))
btn1.grid(row=3,column=0, sticky="nswe")
btn2 = Button(root,text=" 2 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "2"))
btn2.grid(row=3,column=1, sticky="nswe")
btn3 = Button(root,text=" 3 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "3"))
btn3.grid(row=3,column=2, sticky="nswe")


btn3 = Button(root,text=" 0 ", fg='white',background='grey',command=lambda: equation.set(equation.get() + "0"))
btn3.grid(row=4,column=0, sticky="nswe",columnspan=2)

root.mainloop()