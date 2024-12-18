# Importación de módulos necesarios
from tkinter import *  # Importa todas las clases y funciones de tkinter
from tkinter import ttk  # Importa los widgets temáticos de tkinter
import sqlite3  # Para manejar la base de datos SQLite
from tkinter import font  # Para manejar fuentes

# Crear la ventana principal
root = Tk()
root.title('Gestor de Tareas')  # Título de la ventana
root.geometry('600x600')  # Dimensiones de la ventana

# Configuración del estilo de la aplicación
style = ttk.Style()
style.theme_use('clam')  # Usa el tema 'clam' que es más moderno
style.configure(".", font=('Helvetica', 10))  # Fuente predeterminada

# Configuración de estilos para botones normales
style.configure("Custom.TButton",
                font=('Roboto', 10),
                background='#2196f3',  # Color azul material design
                foreground='white')
# Configuración del estado activo del botón
style.map("Custom.TButton",
          background=[('active', '#2196f3')],
          foreground=[('active', 'white')])

# Configuración de estilos para botones de peligro (eliminar)
style.configure("Danger.TButton",
                font=('Roboto', 10),
                background='#ff5252',  # Color rojo para acciones peligrosas
                foreground='white')
style.map("Danger.TButton",
          background=[('active', '#ff5252')],
          foreground=[('active', 'white')])

# Configuración de estilos para checkbuttons y frames
style.configure("Custom.TCheckbutton",
                font=('Open Sans', 11),
                background='white',
                foreground='#333333')
style.configure("Task.TFrame",
                background='white')

# Color de fondo de la ventana principal
root.configure(bg='#f0f0f0')

# Configuración de la base de datos
conn = sqlite3.connect('gestor.db')  # Conectar a la base de datos
c = conn.cursor()  # Crear un cursor para ejecutar comandos SQL

# Crear tabla de tareas si no existe
c.execute('''
    CREATE TABLE IF NOT EXISTS tareas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        description TEXT NOT NULL,
        completed BOOLEAN NOT NULL
    )
''')
conn.commit()

# Función para eliminar una tarea específica
def remove(id):
    def _remove():
        c.execute('DELETE FROM tareas WHERE id = ?', (id, ))
        conn.commit()
        render_todos()
    return _remove

# Función para marcar/desmarcar una tarea como completada
def complete(id):
    def _complete():
        todo = c.execute('SELECT * FROM tareas WHERE id = ?', (id, )).fetchone()
        c.execute('UPDATE tareas SET completed = ? WHERE id = ?', (not todo[3], id))
        conn.commit()
        render_todos()
    return _complete

# Función para eliminar todas las tareas completadas
def remove_completed():
    c.execute('DELETE FROM tareas WHERE completed = ?', (True, ))
    conn.commit()
    render_todos()

# Función para seleccionar/deseleccionar todas las tareas
def toggle_all():
    # Obtener una tarea para ver el estado actual
    todo = c.execute('SELECT completed FROM tareas LIMIT 1').fetchone()
    if todo:
        # Si hay al menos una tarea, usamos el opuesto de la primera tarea
        # para determinar el nuevo estado
        new_state = not todo[0]
        # Actualizar todas las tareas al nuevo estado
        c.execute('UPDATE tareas SET completed = ?', (new_state,))
        conn.commit()
        render_todos()

# Función para añadir una nueva tarea
def addTodo():
    todo = e.get()  # Obtener texto del campo de entrada
    if (todo):
        c.execute("""INSERT INTO tareas (description, completed) VALUES (?, ?)""", (todo, False))
        conn.commit()
        e.delete(0, END)  # Limpiar campo de entrada
        render_todos()
    else:
        print('No hay tarea')

# Función para mostrar todas las tareas en la interfaz
def render_todos():
    rows = c.execute('SELECT * FROM tareas').fetchall()
    
    # Limpiar el frame antes de renderizar
    for widget in frame.winfo_children():
        widget.destroy()
    
    # Crear frame con estilo para las tareas
    style_frame = ttk.Frame(frame, style="Task.TFrame")
    style_frame.pack(fill='both', expand=True)
    
    # Crear widgets para cada tarea
    for i in range(0, len(rows)):
        id = rows[i][0]
        completed = rows[i][3]
        description = rows[i][2]
        
        task_frame = ttk.Frame(style_frame)
        task_frame.pack(fill='x', padx=5, pady=2)
        
        # Crear checkbox para la tarea
        l = ttk.Checkbutton(task_frame, text=description,
                           command=complete(id),
                           style="Custom.TCheckbutton")
        l.pack(side=LEFT, padx=(10, 0))
        
        # Crear botón de eliminar
        btn = ttk.Button(task_frame, text='Eliminar',
                        command=remove(id),
                        style="Danger.TButton")
        btn.pack(side=RIGHT, padx=5)
        
        if completed:
            l.state(['selected'])

# Configuración de la interfaz principal
title_label = ttk.Label(root, text='GESTOR DE TAREAS',
                       font=('Helvetica', 16, 'bold'),
                       background='#f0f0f0',
                       foreground='#2196f3')
title_label.grid(row=0, column=0, columnspan=3, pady=10)

# Frame para la entrada de nuevas tareas
input_frame = ttk.Frame(root)
input_frame.grid(row=1, column=0, columnspan=3, pady=10)

# Elementos del frame de entrada
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

# Frame principal para la lista de tareas
frame = ttk.LabelFrame(root, text='Mis Tareas',
                      padding=10)
frame.grid(row=2, column=0, columnspan=3,
          sticky='nswe', padx=10, pady=10)

# Frame para botones de acción
action_frame = ttk.Frame(root)
action_frame.grid(row=3, column=0, columnspan=3, pady=5)

# Botón para eliminar tareas completadas
delete_completed_btn = ttk.Button(action_frame,
                                text='Eliminar Completadas',
                                command=remove_completed,
                                style="Danger.TButton")
delete_completed_btn.pack(side=LEFT, padx=5)

# Nuevo botón para seleccionar/deseleccionar todas las tareas
select_all_btn = ttk.Button(action_frame,
                           text='Seleccionar Todas',
                           command=toggle_all,
                           style="Custom.TButton")
select_all_btn.pack(side=LEFT, padx=5)

# Nuevo frame para los créditos
credits_frame = ttk.Frame(root)
credits_frame.grid(row=4, column=0, columnspan=3, pady=10)

credits_label = ttk.Label(credits_frame, 
                         text='Hecho con ♥ por franHR',
                         font=('Helvetica', 9),
                         background='#f0f0f0',
                         foreground='#666666')
credits_label.pack()

# Configuración del grid para que sea responsive
root.grid_rowconfigure(2, weight=1)
root.grid_columnconfigure(0, weight=1)

# Configuración final
e.focus()  # Poner el foco en el campo de entrada
root.bind('<Return>', lambda x: addTodo())  # Vincular la tecla Enter para añadir tarea
render_todos()  # Mostrar las tareas existentes
root.mainloop()  # Iniciar el bucle principal de la aplicación