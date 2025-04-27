# Gestor de Tareas

Una aplicación de escritorio moderna para gestionar tareas diarias, desarrollada con Python y ttkbootstrap.

## Características

- Interfaz moderna con tema Bootstrap
- Calendario para selección de fechas
- Selección de hora para las tareas
- Filtrado de tareas por fecha
- Paginación de tareas (10 por página)
- Añadir nuevas tareas con fecha y hora
- Marcar tareas como completadas
- Eliminar tareas individuales
- Eliminar todas las tareas completadas
- Seleccionar/deseleccionar todas las tareas
- Almacenamiento persistente con SQLite

## Requisitos Previos

- Python 3.x instalado
- ttkbootstrap (para la interfaz moderna)
- tkcalendar (para el selector de fechas)
- SQLite3 (viene incluido con Python)

## Instalación

1. Clona o descarga este repositorio
2. Navega hasta el directorio del proyecto
3. (Opcional) Crea un entorno virtual:
   ```bash
   python -m venv venv
   source venv/bin/activate  # En Windows: venv\Scripts\activate
   ```
4. Instala las dependencias:
   ```bash
   pip install -r requirements.txt
   ```

## Uso

1. Ejecuta el script:
   ```bash
   python db.py
   ```

2. Para usar la aplicación:
   - Selecciona una fecha en el calendario
   - Establece la hora para la tarea
   - Escribe una descripción y presiona "Agregar" o Enter
   - Usa el botón "Filtrar" para ver tareas de una fecha específica
   - Navega entre páginas con los botones "Anterior" y "Siguiente"
   - Usa "Mostrar Todo" para ver todas las tareas
   - Marca las tareas como completadas usando los checkboxes
   - Elimina tareas individuales con el botón "Eliminar"

## Estructura de Archivos

- `db.py`: Script principal de la aplicación
- `gestor.db`: Base de datos SQLite (se crea automáticamente)
- `requirements.txt`: Lista de dependencias
- `README.md`: Este archivo


## Creado por franHR
