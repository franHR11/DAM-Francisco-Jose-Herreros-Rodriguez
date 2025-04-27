# 📊 Gestor de Clientes

Una aplicación de escritorio moderna para gestionar información de clientes, desarrollada con Python y mejorada visualmente con ttkbootstrap.

## ✨ Características

- Interfaz gráfica moderna y atractiva
- Gestión completa de clientes (Crear, Editar y Eliminar)
- Búsqueda en tiempo real de clientes
- Base de datos SQLite integrada
- Diseño responsive y amigable
- Validación de campos obligatorios
- Soporte para selección múltiple en eliminación

## 🔧 Requisitos Previos

- Python 3.x instalado
- Pip (gestor de paquetes de Python)

## 📥 Instalación

1. Clona el repositorio:
```bash
git clone <url-del-repositorio>
cd gestor-clientes
```

2. Instala las dependencias:
```bash
pip install -r requirements.txt
```

## 🚀 Uso

1. Ejecuta la aplicación:
```bash
python libreta-clientes.py
```

2. Funcionalidades principales:
   - Para añadir un cliente: Click en "Nuevo Cliente" (botón verde)
   - Para editar un cliente: Selecciona el cliente y click en "Editar Cliente" (botón amarillo)
   - Para eliminar cliente(s): Selecciona uno o más clientes y click en "Eliminar Cliente" (botón rojo)
   - Para buscar: Usa la barra de búsqueda en la parte superior

## 📝 Estructura del Proyecto

```
gestor-clientes/
│
├── libreta-clientes.py    # Archivo principal
├── requirements.txt       # Dependencias
├── README.md             # Documentación
└── crm.db               # Base de datos SQLite
```

## 📚 Campos de Cliente

- **Nombre**: Nombre del cliente (requerido)
- **Teléfono**: Número de contacto (requerido)
- **Empresa**: Nombre de la empresa (requerido)
- **Email**: Correo electrónico (opcional)

## 🎨 Interfaz

- Tema moderno con ttkbootstrap
- Botones con colores intuitivos
- Barra de búsqueda integrada
- Lista de clientes con scroll
- Mensajes de confirmación y error

## 🛠️ Tecnologías Utilizadas

- Python 3
- Tkinter
- ttkbootstrap
- SQLite3

## 🤝 Contribuciones

Las contribuciones son bienvenidas:

1. Haz un Fork del proyecto
2. Crea una rama para tu función
3. Realiza tus cambios
4. Envía un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👥 Autor

FranHR

## 📞 Soporte

Si tienes alguna pregunta o problema, por favor abre un issue en el repositorio.
