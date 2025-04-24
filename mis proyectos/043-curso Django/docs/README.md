# WebPersonal - Portafolio Django

## 📢 Sección Comercial
Proyecto web para mostrar el portafolio profesional de franHR, desarrollador web. Perfecto para compartir en redes sociales y atraer clientes o empleadores.

## 📝 Descripción y Características
- Sitio web hecho en Django.
- Gestión de proyectos con imágenes, descripciones y enlaces.
- Panel de administración para gestionar el contenido.
- Subida y visualización de imágenes en la sección de portafolio.
- Responsive y preparado para producción.

## ⚙️ Sección Técnica
### Instalación y despliegue en producción

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
4. **Configura las variables en `settings.py`:**
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

### Estructura de carpetas relevante
- `webpersonal/portfolio/templates/portfolio/portfolio.html`: Plantilla principal del portafolio.
- `webpersonal/media/projects/`: Carpeta donde se suben las imágenes de proyectos.

---

## 🚀 ¡Listo para producción!
Sigue estos pasos y tu web estará online de forma segura y profesional.
