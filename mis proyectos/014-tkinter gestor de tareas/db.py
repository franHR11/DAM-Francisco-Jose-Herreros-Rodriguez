from tkinter import *
from tkinter import ttk
import sqlite3
from tkinter import font

root = Tk()
root.title('Gestor de Tareas')
root.geometry('600x600')

# Configurar un tema personalizado con ttk.Style
style = ttk.Style()
style.theme_use('clam')  # Usar el tema 'clam' que viene por defecto
style.configure(".", font=('Helvetica', 10))

# Configurar estilos de botones con estados
style.configure("Custom.TButton",
                font=('Roboto', 10),
                background='#2196f3',
                foreground='white')
style.map("Custom.TButton",
          background=[('active', '#2196f3')],
          foreground=[('active', 'white')])

style.configure("Danger.TButton",
                font=('Roboto', 10),
                background='#ff5252',
                foreground='white')
style.map("Danger.TButton",
          background=[('active', '#ff5252')],
          foreground=[('active', 'white')])

style.configure("Custom.TCheckbutton",
                font=('Open Sans', 11),
                background='white',
                foreground='#333333')
style.configure("Task.TFrame",
                background='white')

root.configure(bg='#f0f0f0')  # Color de fondo suave

conn = sqlite3.connect('gestor.db')
c = conn.cursor()
c.execute('''
    CREATE TABLE IF NOT EXISTS tareas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        description TEXT NOT NULL,
        completed BOOLEAN NOT NULL
    )
''')

conn.commit()

def remove(id):
    def _remove():
        c.execute('DELETE FROM tareas WHERE id = ?', (id, ))
        conn.commit()
        render_todos()
    
    return _remove

def complete(id):
    def _complete():
        todo = c.execute('SELECT * FROM tareas WHERE id = ?', (id, )).fetchone()
        c.execute('UPDATE tareas SET completed = ? WHERE id = ?', (not todo[3], id))  
        conn.commit() 
        render_todos()
    
    return _complete

def remove_completed():
    c.execute('DELETE FROM tareas WHERE completed = ?', (True, ))
    conn.commit()
    render_todos()

def addTodo():
    todo = e.get()
    if (todo):
        c.execute("""INSERT INTO tareas (description, completed) VALUES (?, ?)""", (todo, False))
        conn.commit()
        e.delete(0, END)
        render_todos()
    else:
        print('No hay tarea')

def render_todos():
    rows = c.execute('SELECT * FROM tareas').fetchall()
    
    for widget in frame.winfo_children():
        widget.destroy()
    
    # Añadir estilo al frame
    style_frame = ttk.Frame(frame, style="Task.TFrame")
    style_frame.pack(fill='both', expand=True)
    
    for i in range(0, len(rows)):
        id = rows[i][0]
        completed = rows[i][3]
        description = rows[i][2]
        
        # Crear un frame para cada tarea
        task_frame = ttk.Frame(style_frame)
        task_frame.pack(fill='x', padx=5, pady=2)
        
        l = ttk.Checkbutton(task_frame, text=description,
                           command=complete(id),
                           style="Custom.TCheckbutton")
        l.pack(side=LEFT, padx=(10, 0))
        
        btn = ttk.Button(task_frame, text='Eliminar',
                        command=remove(id),
                        style="Danger.TButton")
        btn.pack(side=RIGHT, padx=5)
        
        if completed:
            l.state(['selected'])

# Actualizar widgets a ttk
title_label = ttk.Label(root, text='GESTOR DE TAREAS',
                       font=('Helvetica', 16, 'bold'),
                       background='#f0f0f0',
                       foreground='#2196f3')
title_label.grid(row=0, column=0, columnspan=3, pady=10)

# Contenedor para entrada de tareas
input_frame = ttk.Frame(root)
input_frame.grid(row=1, column=0, columnspan=3, pady=10)

l = ttk.Label(input_frame, text='Nueva Tarea:',
              font=('Open Sans', 11),
              background='#f0f0f0')
l.pack(side=LEFT, padx=5)

e = ttk.Entry(input_frame, width=50,
              font=('Open Sans', 11))
e.pack(side=LEFT, padx=5)

btn = ttk.Button(input_frame, text='Agregar',
                 command=addTodo,
                 style="Custom.TButton")
btn.pack(side=LEFT, padx=5)

# Frame principal
frame = ttk.LabelFrame(root, text='Mis Tareas',
                      padding=10)
frame.grid(row=2, column=0, columnspan=3,
          sticky='nswe', padx=10, pady=10)

# Frame para botones de acción
action_frame = ttk.Frame(root)
action_frame.grid(row=3, column=0, columnspan=3, pady=5)

delete_completed_btn = ttk.Button(action_frame,
                                text='Eliminar Completadas',
                                command=remove_completed,
                                style="Danger.TButton")
delete_completed_btn.pack(side=LEFT, padx=5)

# Configurar expansión del grid
root.grid_rowconfigure(2, weight=1)
root.grid_columnconfigure(0, weight=1)

e.focus()
root.bind('<Return>', lambda x: addTodo())
render_todos()
root.mainloop()