# 🌐 WebPersonal - Portafolio Profesional en Django

## 📌 DESCRIPCIÓN DEL PROYECTO
WebPersonal es una aplicación web desarrollada en Django para mostrar el portafolio profesional de desarrolladores, freelancers o agencias. Permite gestionar y exponer proyectos, imágenes y descripciones de forma elegante y dinámica, ideal para atraer clientes o reclutadores.

- **¿Qué hace este proyecto?**
  - Muestra proyectos con imágenes, descripciones y enlaces.
  - Permite gestionar el contenido desde un panel de administración seguro.
- **¿Para quién está pensado?**
  - Desarrolladores web, diseñadores, freelancers, agencias y cualquier profesional que quiera mostrar su trabajo online.
- **Utilidad y enfoque comercial:**
  - Potencia la marca personal, facilita la captación de clientes y la presentación profesional en procesos de selección.

---

## ✨ CARACTERÍSTICAS PRINCIPALES
- 🛠️ Gestión de proyectos desde el admin de Django
- 📦 Subida de imágenes para cada proyecto
- 🖼️ Galería de proyectos responsive
- 🔒 Panel de administración protegido
- 📊 Listado dinámico de proyectos en la web
- 📝 Plantillas HTML personalizables
- 🗂️ Organización modular por apps (core y portfolio)
- 🌍 Preparado para despliegue en producción

---

## ⚙️ FUNCIONALIDADES
- **Módulo Portfolio:**
  - Modelo `Project` con título, descripción, imagen y URL.
  - Visualización de proyectos en la página principal de portafolio.
- **Panel de administración:**
  - Gestión CRUD de proyectos.
  - Campos de solo lectura para fechas de creación y actualización.
- **Carga y visualización de imágenes:**
  - Las imágenes se almacenan en `media/projects/` y se muestran en la web.
- **Sistema de plantillas:**
  - Uso de `base.html` y herencia de plantillas para diseño consistente.
- **Sin login público** (solo admin para gestión).
- **Base de datos SQLite por defecto** (fácil de cambiar a PostgreSQL/MySQL para producción).

---

## 🔧 TECNOLOGÍAS UTILIZADAS
- 🐍 **Python 3**
- 🌟 **Django 5.2**
- 🖼️ **Pillow** (gestión de imágenes)
- 📝 **HTML5, CSS3** (Bootstrap vía plantillas)
- 🗄️ **SQLite** (desarrollo)
- 🟩 **Gunicorn** / **Waitress** (despliegue)
- 🟦 **Nginx** (proxy inverso recomendado)
- 📦 Otras dependencias: `django-ckeditor`, `django-js-asset`, `numpy`, etc.

---

## 🧪 ESTRUCTURA DE ARCHIVOS Y CARPETAS
```
├── webpersonal/
│   ├── core/                  # App principal (páginas estáticas, base, etc)
│   │   ├── templates/core/    # Plantillas base y páginas core
│   │   └── static/core/       # Archivos estáticos (imágenes, CSS, JS)
│   ├── portfolio/             # App de portafolio
│   │   ├── templates/portfolio/ # Plantilla de portafolio
│   │   └── models.py          # Modelo Project
│   ├── media/projects/        # Imágenes subidas por el usuario
│   ├── db.sqlite3             # Base de datos (desarrollo)
│   ├── requirements.txt       # Dependencias Python
│   └── manage.py              # Script de gestión Django
├── docs/                      # Documentación interna
├── README.md                  # Este archivo
```
**Carpetas clave:**
- `core/`: Páginas base, estáticos y plantillas generales.
- `portfolio/`: Gestión y visualización de proyectos.
- `media/`: Imágenes subidas (configurado en settings).
- `docs/`: Documentación y memorias del proyecto.

---

## 🛠️ INSTRUCCIONES DE USO
1. **Clona el repositorio o sube los archivos al servidor.**
2. **Crea y activa un entorno virtual:**
   ```bash
   python -m venv venv
   source venv/bin/activate  # Linux/Mac
   venv\Scripts\activate   # Windows
   ```
3. **Instala las dependencias:**
   ```bash
   pip install -r requirements.txt
   ```
4. **Configura las variables en `webpersonal/webpersonal/settings.py`:**
   - `DEBUG = False`
   - `ALLOWED_HOSTS = ['tudominio.com', 'IP_DEL_SERVIDOR']`
   - `STATIC_ROOT = BASE_DIR / 'staticfiles'`
   - `MEDIA_ROOT = BASE_DIR / 'media'`
5. **Recopila archivos estáticos:**
   ```bash
   python manage.py collectstatic
   ```
6. **Aplica migraciones:**
   ```bash
   python manage.py migrate
   ```
7. **Crea un superusuario:**
   ```bash
   python manage.py createsuperuser
   ```
8. **Ejecuta el servidor de aplicaciones:**
   - Gunicorn (Linux):
     ```bash
     gunicorn webpersonal.wsgi:application --bind 0.0.0.0:8000
     ```
   - Waitress (Windows):
     ```bash
     waitress-serve --port=8000 webpersonal.wsgi:application
     ```
9. **Configura Nginx o Apache como proxy inverso y para servir archivos estáticos y media.**
10. **Asegura el servidor (HTTPS, firewall, etc).**

### Variables de entorno recomendadas
```env
SECRET_KEY=tu_clave_secreta
DEBUG=False
ALLOWED_HOSTS=tudominio.com,IP_DEL_SERVIDOR
```

---

## 📝 EJEMPLO DE USO
- Accede a `/portfolio/` para ver el listado de proyectos.
- Usa `/admin/` para gestionar los proyectos (login requerido).
- Las imágenes se suben automáticamente a `/media/projects/` y se muestran en la web.

---

## 🗄️ BASE DE DATOS Y CONEXIÓN
- **Tabla principal:** `Project`
  - Campos: `title`, `description`, `image`, `created`, `updated`, `url`
- **Conexión:** Por defecto SQLite (`db.sqlite3`). Para producción, configura PostgreSQL/MySQL en `settings.py`.

---

## 🚀 ¡Listo para impresionar!
Este README está diseñado para captar la atención de clientes y reclutadores, mostrando profesionalismo y claridad en cada sección. Si tienes dudas o necesitas soporte, consulta la documentación interna en `docs/`.
