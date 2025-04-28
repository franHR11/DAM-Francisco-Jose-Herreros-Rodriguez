# 🚀 Guía Completa Django 2025

Esta guía está diseñada para principiantes que quieren aprender Django de manera clara y estructurada. Incluye ejemplos prácticos y explicaciones detalladas para cada paso del desarrollo web con Django.

## 📋 Índice

1. [Introducción a Django](#1-introducción-a-django)
2. [Instalación y preparación](#2-instalación-y-preparación)
3. [Estructura de un proyecto Django](#3-estructura-de-un-proyecto-django)
4. [Configuración inicial y settings.py](#4-configuración-inicial-y-settingspy)
5. [Creación y configuración de apps](#5-creación-y-configuración-de-apps)
6. [Modelos y base de datos](#6-modelos-y-base-de-datos)
7. [Sistema de administración (Admin)](#7-sistema-de-administración-admin)
8. [URLs y enrutamiento](#8-urls-y-enrutamiento)
9. [Vistas y funciones](#9-vistas-y-funciones)
10. [Templates y sistema de plantillas](#10-templates-y-sistema-de-plantillas)
11. [Archivos estáticos (CSS, JS, imágenes)](#11-archivos-estáticos-css-js-imágenes)
12. [Formularios y validacion](#12-formularios-y-validacion)
13. [Context processors](#13-context-processors)
14. [Template tags personalizados](#14-template-tags-personalizados)
15. [URLs SEO friendly con slugs](#15-urls-seo-friendly-con-slugs)
16. [CRUD completo paso a paso](#16-crud-completo-paso-a-paso)
17. [Autenticación y usuarios](#17-autenticación-y-usuarios)
18. [Despliegue y producción](#18-despliegue-y-producción)
19. [Recursos adicionales](#19-recursos-adicionales)
20. [Checklist para crear un proyecto](#20-checklist-para-crear-un-proyecto)
21. [Comandos Esenciales de Django](#21-comandos-esenciales-de-django)

## 1. Introducción a Django

Django es un framework web de alto nivel escrito en Python que fomenta el desarrollo rápido y limpio con un diseño pragmático. Desarrollado por programadores experimentados, se encarga de gran parte de las complicaciones del desarrollo web, para que puedas centrarte en escribir tu aplicación sin necesidad de reinventar la rueda.

### Ventajas de Django

- **Completo**: Django sigue la filosofía "baterías incluidas" y proporciona casi todo lo que los desarrolladores necesitan.
- **Versátil**: Sirve tanto para sitios de contenido como para aplicaciones web complejas.
- **Seguro**: Ayuda a los desarrolladores a evitar errores comunes de seguridad.
- **Escalable**: Puede manejar sitios de alto tráfico.
- **Mantenible**: El código Django es limpio, legible y sigue principios DRY (Don't Repeat Yourself).

### El patrón MTV (Model-Template-View)

Django sigue un patrón similar al MVC, pero con nombres ligeramente diferentes:

- **Model (Modelo)**: Define la estructura de datos, con lógica y restricciones. Se encarga de la interacción con la base de datos.
- **Template (Plantilla)**: Define cómo se muestran los datos al usuario (HTML, CSS, etc.).
- **View (Vista)**: Actúa como intermediario entre el modelo y la plantilla, procesa la lógica de negocio.

## 2. Instalación y preparación

### Requisitos previos

- Python 3.8 o superior
- pip (gestor de paquetes de Python)
- Entorno virtual (recomendado)

### Pasos para la instalación

1. **Crear un entorno virtual** (aísla las dependencias de cada proyecto):

```bash
# Crear el entorno virtual
python -m venv venv

# Activar el entorno virtual
# En Windows:
venv\\Scripts\\activate
# En Linux/Mac:
source venv/bin/activate
```

2. **Instalar Django** dentro del entorno virtual activado:

```bash
pip install django
```

3. **Verificar la instalación**:

```bash
python -m django --version
```

4. **Crear un nuevo proyecto Django**:

```bash
django-admin startproject nombre_proyecto .
```
El punto al final es importante: crea el proyecto en el directorio actual en lugar de crear un subdirectorio adicional.

5. **Ejecutar el servidor de desarrollo**:

```bash
python manage.py runserver
```

Visita http://127.0.0.1:8000/ en tu navegador. Si ves la página de bienvenida de Django, ¡felicidades! La instalación fue exitosa.

## 3. Estructura de un proyecto Django

Cuando creas un nuevo proyecto, Django genera automáticamente la siguiente estructura de archivos:

```
nombre_proyecto/
    manage.py                # Herramienta de línea de comandos para interactuar con el proyecto
    nombre_proyecto/         # Paquete Python real para tu proyecto
        __init__.py          # Archivo vacío que indica que es un paquete Python
        settings.py          # Configuración del proyecto
        urls.py              # Declaraciones de URLs para el proyecto
        asgi.py              # Punto de entrada para servidores web compatibles con ASGI
        wsgi.py              # Punto de entrada para servidores web compatibles con WSGI
```

### Explicación detallada

- **manage.py**: Utilidad de línea de comandos que te permite interactuar con tu proyecto Django de varias formas (ejecutar el servidor, crear migraciones, etc.).
- **__init__.py**: Archivo vacío que indica a Python que este directorio debe ser tratado como un paquete.
- **settings.py**: Configuraciones del proyecto como conexión a base de datos, zona horaria, apps instaladas, etc.
- **urls.py**: Archivo donde se definen las URLs del proyecto.
- **asgi.py y wsgi.py**: Puntos de entrada para servidores web en producción.

## 4. Configuración inicial y settings.py

El archivo `settings.py` contiene toda la configuración de tu proyecto Django. Aquí hay algunas configuraciones importantes:

### Configuraciones esenciales

```python
# Aplicaciones instaladas
INSTALLED_APPS = [
    'django.contrib.admin',          # Sistema de administración
    'django.contrib.auth',           # Sistema de autenticación
    'django.contrib.contenttypes',   # Marco de tipos de contenido
    'django.contrib.sessions',       # Marco de sesiones
    'django.contrib.messages',       # Marco de mensajería
    'django.contrib.staticfiles',    # Marco para archivos estáticos
    # Tus aplicaciones personalizadas
    'core',
    'blog',
    'services',
]

# Configuración de la base de datos
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.sqlite3',  # También: postgresql, mysql, oracle
        'NAME': BASE_DIR / 'db.sqlite3',
    }
}

# Configuración de zona horaria
TIME_ZONE = 'Europe/Madrid'
USE_TZ = True

# Configuración de idioma
LANGUAGE_CODE = 'es'
USE_I18N = True

# Archivos estáticos (CSS, JavaScript, imágenes)
STATIC_URL = '/static/'
STATICFILES_DIRS = [BASE_DIR / 'static']

# Archivos multimedia subidos por usuarios
MEDIA_URL = '/media/'
MEDIA_ROOT = BASE_DIR / 'media'
```

### Configuración de templates

```python
TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [BASE_DIR / 'templates'],  # Carpeta de templates global
        'APP_DIRS': True,                 # Buscar en carpetas 'templates' de cada app
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.debug',
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
                # Context processors personalizados
                'social.processors.ctx_dict',
            ],
        },
    },
]
```

## 5. Creación y configuración de apps

En Django, un proyecto puede contener múltiples aplicaciones. Cada app debe ser una unidad de funcionalidad específica y reutilizable.

### Crear una nueva app

```bash
python manage.py startapp nombre_app
```

Esto crea un directorio con la siguiente estructura:

```
nombre_app/
    __init__.py
    admin.py         # Configuración del admin de Django
    apps.py          # Configuración de la app
    migrations/      # Directorio para migraciones de la base de datos
        __init__.py
    models.py        # Modelos de la base de datos
    tests.py         # Tests para la app
    views.py         # Vistas y lógica de la app
```

### Registrar la app en el proyecto

Para usar la app, debes añadirla a `INSTALLED_APPS` en `settings.py`:

```python
INSTALLED_APPS = [
    # ...
    'nombre_app.apps.NombreAppConfig',  # Usar la clase de configuración
    # o simplemente
    'nombre_app',
]
```

### Organización recomendada de apps

- **core**: App principal con base.html, home, about, contact, etc.
- **services**: Para servicios o productos (si es una web empresarial).
- **blog**: Para un blog o noticias.
- **pages**: Para páginas de contenido editable desde el admin.
- **social**: Para enlaces a redes sociales u otros contenidos dinámicos.

## 6. Modelos y base de datos

Los modelos en Django son clases de Python que definen la estructura de los datos que serán almacenados en la base de datos.

### Crear un modelo básico

```python
from django.db import models
from django.utils.timezone import now
from django.contrib.auth.models import User

class Articulo(models.Model):
    titulo = models.CharField(max_length=200, verbose_name="Título")
    contenido = models.TextField(verbose_name="Contenido")
    publicado = models.DateTimeField(default=now, verbose_name="Fecha de publicación")
    imagen = models.ImageField(upload_to="blog", null=True, blank=True, verbose_name="Imagen")
    autor = models.ForeignKey(User, on_delete=models.CASCADE, verbose_name="Autor")
    
    class Meta:
        verbose_name = "Artículo"
        verbose_name_plural = "Artículos"
        ordering = ['-publicado']  # Ordenar del más reciente al más antiguo
    
    def __str__(self):
        return self.titulo
```

### Tipos de campos comunes

- **CharField**: Para textos cortos (requiere max_length).
- **TextField**: Para textos largos.
- **EmailField**: Para direcciones de correo electrónico.
- **URLField**: Para URLs.
- **IntegerField, FloatField, DecimalField**: Para diferentes tipos de números.
- **BooleanField**: Para valores verdadero/falso.
- **DateField, TimeField, DateTimeField**: Para fechas y horas.
- **ImageField, FileField**: Para imágenes y archivos.
- **ForeignKey**: Relación uno a muchos.
- **ManyToManyField**: Relación muchos a muchos.
- **OneToOneField**: Relación uno a uno.

### Opciones comunes para campos

- **null=True**: Permite valores NULL en la base de datos.
- **blank=True**: Permite valores vacíos en formularios.
- **default=valor**: Valor por defecto si no se proporciona otro.
- **choices=OPCIONES**: Lista de opciones para el campo.
- **verbose_name="Nombre"**: Nombre legible para humanos.
- **help_text="Ayuda"**: Texto de ayuda para formularios.
- **unique=True**: El valor debe ser único en toda la tabla.
- **on_delete=models.CASCADE**: Qué hacer cuando se elimina un objeto relacionado.

### Crear y aplicar migraciones

Después de definir o modificar modelos, debes crear y aplicar migraciones:

```bash
# Crear migraciones
python manage.py makemigrations

# Aplicar migraciones
python manage.py migrate
```

## 7. Sistema de administración (Admin)

Django incluye un sistema de administración automático que te permite gestionar tus modelos y datos de forma visual.

### Configuración básica

En `admin.py` de tu app:

```python
from django.contrib import admin
from .models import Articulo

@admin.register(Articulo)
class ArticuloAdmin(admin.ModelAdmin):
    list_display = ('titulo', 'autor', 'publicado')
    list_filter = ('autor', 'publicado')
    search_fields = ('titulo', 'contenido')
    date_hierarchy = 'publicado'
    ordering = ('-publicado',)
    readonly_fields = ('created', 'updated')
```

Alternativa:

```python
class ArticuloAdmin(admin.ModelAdmin):
    # configuración
    
admin.site.register(Articulo, ArticuloAdmin)
```

### Opciones comunes para ModelAdmin

- **list_display**: Campos a mostrar en la lista.
- **list_filter**: Campos para filtrar en la barra lateral.
- **search_fields**: Campos para buscar.
- **list_editable**: Campos editables directamente en la lista.
- **list_per_page**: Número de elementos por página.
- **date_hierarchy**: Campo fecha para navegación jerárquica.
- **prepopulated_fields**: Campos que se completan automáticamente (útil para slugs).
- **readonly_fields**: Campos que no se pueden editar.
- **fieldsets**: Organiza campos en grupos en el formulario.
- **inlines**: Modelos relacionados que se muestran en línea.

### Crear un superusuario

Para acceder al admin, necesitas un superusuario:

```bash
python manage.py createsuperuser
```

Luego visita http://127.0.0.1:8000/admin/ y accede con las credenciales creadas.

## 8. URLs y enrutamiento

Django utiliza un sistema de mapeo URL-a-vista para determinar qué código ejecutar según la URL solicitada.

### URLconf del proyecto

En `urls.py` del proyecto:

```python
from django.contrib import admin
from django.urls import path, include
from django.conf import settings
from django.conf.urls.static import static

urlpatterns = [
    # URLs de administración
    path('admin/', admin.site.urls),
    
    # Incluir URLs de cada app
    path('', include('core.urls')),
    path('blog/', include('blog.urls')),
    path('services/', include('services.urls')),
    path('page/', include('pages.urls')),
]

# Servir archivos multimedia durante desarrollo
if settings.DEBUG:
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
```

### URLconf de una app

En `urls.py` de cada app (debes crear este archivo):

```python
from django.urls import path
from . import views

urlpatterns = [
    path('', views.blog, name='blog'),
    path('categoria/<int:categoria_id>/', views.categoria, name='categoria'),
    path('articulo/<int:articulo_id>/<slug:articulo_slug>/', views.articulo, name='articulo'),
]
```

### Elementos del sistema de URLs

- **path**: Función para definir una URL.
- **include**: Incluye otras URLconf.
- **name**: Nombre para referenciar la URL en templates.
- **Conversores**: int, str, slug, uuid, path, etc.
- **<>**: Captura valores de la URL y los pasa a la vista.

## 9. Vistas y funciones

Las vistas son funciones o clases de Python que procesan una solicitud web y devuelven una respuesta.

### Vistas basadas en funciones

```python
from django.shortcuts import render, get_object_or_404
from .models import Articulo, Categoria

def blog(request):
    articulos = Articulo.objects.all()
    return render(request, 'blog/blog.html', {'articulos': articulos})

def categoria(request, categoria_id):
    categoria = get_object_or_404(Categoria, id=categoria_id)
    articulos = Articulo.objects.filter(categorias=categoria)
    return render(request, 'blog/categoria.html', {
        'categoria': categoria,
        'articulos': articulos
    })

def articulo(request, articulo_id, articulo_slug):
    articulo = get_object_or_404(Articulo, id=articulo_id)
    return render(request, 'blog/articulo.html', {'articulo': articulo})
```

### Vistas basadas en clases

```python
from django.views.generic import ListView, DetailView
from .models import Articulo

class ArticuloListView(ListView):
    model = Articulo
    template_name = 'blog/articulos.html'
    context_object_name = 'articulos'
    paginate_by = 10

class ArticuloDetailView(DetailView):
    model = Articulo
    template_name = 'blog/articulo_detalle.html'
    context_object_name = 'articulo'
```

En `urls.py`:

```python
from django.urls import path
from .views import ArticuloListView, ArticuloDetailView

urlpatterns = [
    path('', ArticuloListView.as_view(), name='articulos'),
    path('<int:pk>/<slug:slug>/', ArticuloDetailView.as_view(), name='articulo_detalle'),
]
```

### Funciones útiles

- **render(request, template, context)**: Renderiza un template con un contexto.
- **redirect(to)**: Redirecciona a una URL o nombre de URL.
- **get_object_or_404(Model, **kwargs)**: Obtiene un objeto o devuelve 404.
- **HttpResponse**: Respuesta HTTP básica.
- **JsonResponse**: Respuesta HTTP en formato JSON.

## 10. Templates y sistema de plantillas

Los templates son archivos HTML con marcado especial de Django que permiten la generación dinámica de contenido.

### Estructura de directorios recomendada

```
proyecto/
    templates/                # Templates globales
        base.html            # Plantilla base con estructura HTML común
    app1/
        templates/
            app1/            # Namespace para evitar conflictos
                index.html
                detail.html
    app2/
        templates/
            app2/
                index.html
                detail.html
```

### Template base (base.html)

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{% block title %}Mi Sitio{% endblock %}</title>
    {% load static %}
    <link rel="stylesheet" href="{% static 'css/styles.css' %}">
    {% block extracss %}{% endblock %}
</head>
<body>
    <header>
        {% include 'includes/navbar.html' %}
    </header>
    
    <main>
        {% block content %}{% endblock %}
    </main>
    
    <footer>
        {% include 'includes/footer.html' %}
    </footer>
    
    <script src="{% static 'js/main.js' %}"></script>
    {% block extrajs %}{% endblock %}
</body>
</html>
```

### Template que extiende la base

```html
{% extends 'base.html' %}

{% load static %}

{% block title %}Blog - Mi Sitio{% endblock %}

{% block extracss %}
<link rel="stylesheet" href="{% static 'blog/css/blog.css' %}">
{% endblock %}

{% block content %}
<h1>Blog</h1>
<div class="articulos">
    {% for articulo in articulos %}
        <article>
            <h2>{{ articulo.titulo }}</h2>
            <p>{{ articulo.contenido|truncatewords:30 }}</p>
            <a href="{% url 'articulo' articulo.id articulo.titulo|slugify %}">Leer más</a>
        </article>
    {% empty %}
        <p>No hay artículos disponibles.</p>
    {% endfor %}
</div>
{% endblock %}
```

### Etiquetas de template importantes

- **{% extends %}**: Hereda de otra plantilla.
- **{% block %}{% endblock %}**: Define un bloque que puede ser sobrescrito.
- **{% include %}**: Incluye otra plantilla.
- **{% if %}{% else %}{% endif %}**: Condicional.
- **{% for %}{% empty %}{% endfor %}**: Bucle con caso vacío.
- **{% url %}**: Genera URL a partir de nombre de vista.
- **{% load %}**: Carga bibliotecas de tags personalizadas.
- **{% static %}**: Genera URL a archivos estáticos.
- **{% csrf_token %}**: Token CSRF para formularios.

### Filtros útiles

- **{{ valor|default:"texto" }}**: Valor por defecto si es vacío.
- **{{ texto|truncatewords:n }}**: Trunca texto a n palabras.
- **{{ texto|truncatechars:n }}**: Trunca texto a n caracteres.
- **{{ lista|length }}**: Longitud de una lista.
- **{{ fecha|date:"d/m/Y" }}**: Formatea fecha.
- **{{ texto|safe }}**: Marca texto como seguro (no escapa HTML).
- **{{ texto|slugify }}**: Convierte texto a formato slug.
- **{{ numero|floatformat:2 }}**: Formatea número con 2 decimales.

## 11. Archivos estáticos (CSS, JS, imágenes)

Django maneja los archivos estáticos de forma organizada, separándolos del código Python.

### Configuración en settings.py

```python
# URL base para archivos estáticos
STATIC_URL = '/static/'

# Directorios adicionales donde buscar archivos estáticos
STATICFILES_DIRS = [
    BASE_DIR / 'static',
]

# Directorio donde collectstatic recopila archivos estáticos
STATIC_ROOT = BASE_DIR / 'staticfiles'

# URL base para archivos multimedia (subidos por usuarios)
MEDIA_URL = '/media/'

# Directorio donde se almacenan los archivos multimedia
MEDIA_ROOT = BASE_DIR / 'media'
```

### Estructura recomendada

```
proyecto/
    static/                 # Archivos estáticos globales
        css/
            styles.css
        js/
            main.js
        img/
            logo.png
    app1/
        static/
            app1/          # Namespace para evitar conflictos
                css/
                js/
                img/
```

### Uso en templates

```html
{% load static %}

<link rel="stylesheet" href="{% static 'css/styles.css' %}">
<script src="{% static 'js/main.js' %}"></script>
<img src="{% static 'img/logo.png' %}" alt="Logo">

<!-- Para archivos multimedia -->
<img src="{{ objeto.imagen.url }}" alt="{{ objeto.titulo }}">
```

### Servir archivos multimedia en desarrollo

En `urls.py` del proyecto:

```python
from django.conf import settings
from django.conf.urls.static import static

urlpatterns = [
    # Tus URLs
]

if settings.DEBUG:
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)

## 12. Formularios y validación

Los formularios en Django facilitan la recolección y validación de datos de los usuarios.

### Integración de CKEditor5 (Editor de texto enriquecido)

CKEditor5 es un editor de texto enriquecido moderno que puedes integrar en el panel de administración de Django para mejorar la experiencia al editar contenido. Sigue estos pasos para incorporarlo:

**1. Instalar el paquete de CKEditor5 para Django:**

```bash
pip install django-ckeditor-5
```

**2. Añadir la aplicación a INSTALLED_APPS en settings.py:**

```python
INSTALLED_APPS = [
    # ...
    'django_ckeditor_5',
    # ...
]
```

**3. Configurar CKEditor5 en settings.py:**

```python
CKEDITOR_5_CONFIGS = {
    'default': {
        'language': 'es',
        'toolbar': [
            'heading', '|', 'bold', 'italic', 'underline', 'strikethrough', 'link',
            'bulletedList', 'numberedList', 'blockQuote', 'code', 'codeBlock', 'insertTable',
            'imageUpload', 'mediaEmbed', 'undo', 'redo', 'alignment', 'outdent', 'indent',
            'fontColor', 'fontBackgroundColor', 'fontSize', 'fontFamily', 'highlight', 'horizontalLine',
            'removeFormat', 'subscript', 'superscript', 'specialCharacters'
        ],
        'image': {
            'toolbar': [
                'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
            ]
        },
        'table': {
            'contentToolbar': [
                'tableColumn', 'tableRow', 'mergeTableCells'
            ]
        }
    }
}
```

**4. Incluir las URLs de CKEditor5 en urls.py principal:**

```python
from django.urls import path, include

urlpatterns = [
    # ...
    path('ckeditor5/', include('django_ckeditor_5.urls')),
    # ...
]
```

**5. Usar CKEditor5Field en el modelo:**

```python
from django.db import models
from django_ckeditor_5.fields import CKEditor5Field

class Page(models.Model):
    title = models.CharField(max_length=200, verbose_name="Título")
    content = CKEditor5Field(verbose_name="Contenido")  # Usar CKEditor5Field en lugar de TextField
    # ...
```

**6. Mostrar el contenido HTML en los templates:**

Para mostrar correctamente el HTML generado por CKEditor5, usa el filtro `safe` en lugar de `linebreaks`:

```django
<div class="section-content">
    <p>{{ page.content|safe }}</p>
</div>
```

> **Importante**: El filtro `safe` marca el contenido como seguro para ser interpretado como HTML. Úsalo solo cuando confíes en la fuente del contenido, ya que podría introducir vulnerabilidades XSS si el contenido proviene de usuarios no confiables.

**7. Migrar la base de datos:**

```bash
python manage.py makemigrations
python manage.py migrate
```

**Ventajas de usar CKEditor5:**
- Interfaz moderna y responsive
- Soporte para imágenes, tablas y otros elementos multimedia
- Personalización completa de la barra de herramientas
- Genera HTML semánticamente correcto
- Facilita la creación de contenido rico a tus editores sin conocimientos técnicos

Django ofrece un potente sistema de formularios que facilita la validación y el procesamiento de datos.

### Formulario básico

## 12. Formularios y validacion


```python
# forms.py
from django import forms
from .models import Contacto

class ContactoForm(forms.ModelForm):
    class Meta:
        model = Contacto
        fields = ['nombre', 'email', 'asunto', 'mensaje']
        widgets = {
            'nombre': forms.TextInput(attrs={'class': 'form-control', 'placeholder': 'Tu nombre'}),
            'email': forms.EmailInput(attrs={'class': 'form-control', 'placeholder': 'tu@email.com'}),
            'asunto': forms.TextInput(attrs={'class': 'form-control', 'placeholder': 'Asunto'}),
            'mensaje': forms.Textarea(attrs={'class': 'form-control', 'placeholder': 'Tu mensaje', 'rows': 5}),
            'content': forms.CharField(label="Mensaje", required=True, widget=forms.Textarea(attrs={"class": "form-control", "rows": 3, "placeholder": "Escribe tu mensaje"}), min_length=10, max_length=1000),
        }
```

### Uso del formulario en la vista

```python
# views.py
from django.shortcuts import render, redirect
from django.urls import reverse
from .forms import ContactoForm
from django.core.mail import EmailMessage

def contacto(request):
    formulario = ContactoForm()
    
    if request.method == "POST":
        formulario = ContactoForm(data=request.POST)
        if formulario.is_valid():
            nombre = request.POST.get('nombre', '')
            email = request.POST.get('email', '')
            asunto = request.POST.get('asunto', '')
            mensaje = request.POST.get('mensaje', '')
            
            # Enviar email
            email = EmailMessage(
                "Mensaje desde Web",
                f"De {nombre} <{email}>\n\nAsunto: {asunto}\n\nMensaje:\n{mensaje}",
                "noreply@ejemplo.com",
                ["contacto@ejemplo.com"],
                reply_to=[email]
            )
            
            try:
                email.send()
                return redirect(reverse('contacto') + "?ok")
            except:
                return redirect(reverse('contacto') + "?error")
    
    return render(request, "core/contacto.html", {'form': formulario})
```

### Mostrar el formulario en el template

```html
{% extends 'base.html' %}

{% block content %}
<h1>Contacto</h1>

{% if 'ok' in request.GET %}
    <div class="alert alert-success">
        Su mensaje ha sido enviado correctamente.
    </div>
{% endif %}

{% if 'error' in request.GET %}
    <div class="alert alert-danger">
        Ha ocurrido un error. Inténtelo más tarde.
    </div>
{% endif %}

<form method="post">
    {% csrf_token %}
    
    <div class="form-group">
        {{ form.nombre.label_tag }}
        {{ form.nombre }}
        {% if form.nombre.errors %}
            <div class="text-danger">
                {{ form.nombre.errors }}
            </div>
        {% endif %}
    </div>
    
    <div class="form-group">
        {{ form.email.label_tag }}
        {{ form.email }}
        {% if form.email.errors %}
            <div class="text-danger">
                {{ form.email.errors }}
            </div>
        {% endif %}
    </div>
    
    <div class="form-group">
        {{ form.asunto.label_tag }}
        {{ form.asunto }}
        {% if form.asunto.errors %}
            <div class="text-danger">
                {{ form.asunto.errors }}
            </div>
        {% endif %}
    </div>
    
    <div class="form-group">
        {{ form.mensaje.label_tag }}
        {{ form.mensaje }}
        {% if form.mensaje.errors %}
            <div class="text-danger">
                {{ form.mensaje.errors }}
            </div>
        {% endif %}
    </div>
    
    <input type="submit" value="Enviar" class="btn btn-primary">
</form>
{% endblock %}
```

## 13. Context processors

Los context processors permiten añadir variables globales a todos los templates de tu proyecto Django.

### Crear un processor de contexto

```python
# social/processors.py
from .models import Link

def ctx_dict(request):
    ctx = {}
    enlaces = Link.objects.all()
    for enlace in enlaces:
        ctx[enlace.key] = enlace.url
    return ctx
```

### Registrar el processor en settings.py

```python
TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [BASE_DIR / 'templates'],
        'APP_DIRS': True,
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.debug',
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
                # Context processor personalizado
                'social.processors.ctx_dict',
            ],
        },
    },
]
```

### Usar las variables en templates

```html
{% if LINK_FACEBOOK %}
<a href="{{ LINK_FACEBOOK }}" class="social-link">Facebook</a>
{% endif %}
```

## 14. Template tags personalizados

Los template tags personalizados te permiten extender la funcionalidad del sistema de plantillas de Django.

### Crear la estructura de directorios

Dentro de tu app, crea una carpeta `templatetags` y dentro de ella los archivos:
- `__init__.py` (vacío)
- `app_extras.py` (con la lógica de tus tags)

### Definir un tag simple

```python
# pages/templatetags/pages_extras.py
from django import template
from pages.models import Page

register = template.Library()

@register.simple_tag
def get_page_list():
    return Page.objects.all()
```

### Usar el tag en una plantilla

```html
{% load pages_extras %}
{% get_page_list as pages_list %}
{% for page in pages_list %}
  <a href="{% url 'page' page.id page.title|slugify %}" class="link">{{ page.title }}</a>{% if not forloop.last %} · {% endif %}
{% endfor %}
```

### Etiquetas de control: `{% if %} ... {% endif %}`, `{% for %} ... {% endfor %}`

### Mostrar contenido solo a usuarios autenticados

Django pone a disposición la variable `user` en los templates cuando tienes activada la autenticación. Para mostrar contenido solo a usuarios autenticados puedes usar:

```django
{% if user.is_authenticated %}
    <p><a href="{% url 'admin:pages_page_change' page.id %}">Editar</a></p>
{% endif %}
```

**Explicación:**
- `user.is_authenticated` es una propiedad booleana que indica si el usuario ha iniciado sesión.
- El enlace "Editar" solo aparecerá si el usuario está autenticado (por ejemplo, administradores o editores).
- `{% url 'admin:pages_page_change' page.id %}` genera la URL para editar el objeto `page` en el panel de administración de Django.

**¿Para qué sirve esto?**
- Permite mostrar acciones administrativas solo a quienes tienen permisos, mejorando la seguridad y la experiencia de usuario.
- Es útil para mostrar botones, menús o secciones exclusivas para usuarios registrados.

**Ejemplo completo en un template:**

```django
<div class="section-content">
    <p>{{ page.content|linebreaks }}</p>
    {% if user.is_authenticated %}
    <p><a href="{% url 'admin:pages_page_change' page.id %}">Editar</a></p>
    {% endif %}
</div>
```

## 15. URLs SEO friendly con slugs

Los slugs permiten crear URLs legibles y amigables para los motores de búsqueda.

### Configurar URL con slug

```python
# pages/urls.py
from django.urls import path
from . import views

urlpatterns = [
    path('<int:page_id>/<slug:page_slug>/', views.page, name='page'),
]
```

### Modificar la vista para aceptar el slug

```python
# pages/views.py
from django.shortcuts import render, get_object_or_404
from .models import Page

def page(request, page_id, page_slug):
    page = get_object_or_404(Page, id=page_id)
    return render(request, 'pages/sample.html', {'page': page})
```

### Generar enlaces con slug en templates

```html
<a href="{% url 'page' page.id page.title|slugify %}">
    {{ page.title }}
</a>
```

## 16. CRUD completo paso a paso

CRUD (Create, Read, Update, Delete) es la funcionalidad básica para gestionar datos en una aplicación web.

### 1. Modelo

```python
# blog/models.py
from django.db import models
from django.contrib.auth.models import User

class Post(models.Model):
    title = models.CharField(max_length=200, verbose_name="Título")
    content = models.TextField(verbose_name="Contenido")
    published = models.DateTimeField(auto_now_add=True, verbose_name="Fecha de publicación")
    author = models.ForeignKey(User, on_delete=models.CASCADE, verbose_name="Autor")
    
    class Meta:
        verbose_name = "entrada"
        verbose_name_plural = "entradas"
        ordering = ["-published"]
        
    def __str__(self):
        return self.title
```

### 2. Formulario

```python
# blog/forms.py
from django import forms
from .models import Post

class PostForm(forms.ModelForm):
    class Meta:
        model = Post
        fields = ['title', 'content']
        widgets = {
            'title': forms.TextInput(attrs={'class': 'form-control'}),
            'content': forms.Textarea(attrs={'class': 'form-control'}),
        }
```

### 3. URLs

```python
# blog/urls.py
from django.urls import path
from . import views

urlpatterns = [
    path('', views.post_list, name='post_list'),
    path('create/', views.post_create, name='post_create'),
    path('<int:post_id>/', views.post_detail, name='post_detail'),
    path('<int:post_id>/update/', views.post_update, name='post_update'),
    path('<int:post_id>/delete/', views.post_delete, name='post_delete'),
]
```

### 4. Vistas

```python
# blog/views.py
from django.shortcuts import render, get_object_or_404, redirect
from django.contrib.auth.decorators import login_required
from .models import Post
from .forms import PostForm

# READ - Listar
def post_list(request):
    posts = Post.objects.all()
    return render(request, 'blog/post_list.html', {'posts': posts})

# READ - Detalle
def post_detail(request, post_id):
    post = get_object_or_404(Post, id=post_id)
    return render(request, 'blog/post_detail.html', {'post': post})

# CREATE
@login_required
def post_create(request):
    if request.method == 'POST':
        form = PostForm(request.POST)
        if form.is_valid():
            post = form.save(commit=False)
            post.author = request.user
            post.save()
            return redirect('post_detail', post_id=post.id)
    else:
        form = PostForm()
    return render(request, 'blog/post_form.html', {'form': form})

# UPDATE
@login_required
def post_update(request, post_id):
    post = get_object_or_404(Post, id=post_id)
    
    # Verificar que el usuario es el autor
    if request.user != post.author:
        return redirect('post_list')
        
    if request.method == 'POST':
        form = PostForm(request.POST, instance=post)
        if form.is_valid():
            form.save()
            return redirect('post_detail', post_id=post.id)
    else:
        form = PostForm(instance=post)
    return render(request, 'blog/post_form.html', {'form': form})

# DELETE
@login_required
def post_delete(request, post_id):
    post = get_object_or_404(Post, id=post_id)
    
    # Verificar que el usuario es el autor
    if request.user != post.author:
        return redirect('post_list')
        
    if request.method == 'POST':
        post.delete()
        return redirect('post_list')
    
    return render(request, 'blog/post_confirm_delete.html', {'post': post})
```

## 17. Autenticación y usuarios

Django incluye un potente sistema de autenticación que facilita la gestión de usuarios.

### Configuración básica

Ya está incluido por defecto en `INSTALLED_APPS`:
```python
'django.contrib.auth',
```

### URLs para autenticación

```python
# urls.py del proyecto
from django.contrib.auth import views as auth_views

urlpatterns = [
    # ...
    path('login/', auth_views.LoginView.as_view(template_name='users/login.html'), name='login'),
    path('logout/', auth_views.LogoutView.as_view(template_name='users/logout.html'), name='logout'),
    path('password-reset/', auth_views.PasswordResetView.as_view(template_name='users/password_reset.html'), name='password_reset'),
    # ...
]
```

### Restricción de acceso en vistas

```python
from django.contrib.auth.decorators import login_required

@login_required
def mi_vista_protegida(request):
    # Solo usuarios autenticados pueden acceder
    return render(request, 'mi_template.html')
```

## 18. Despliegue y producción

Al pasar a producción, hay varios aspectos importantes a considerar:

### Configuraciones para producción

```python
# settings.py
DEBUG = False
ALLOWED_HOSTS = ['midominio.com', 'www.midominio.com']

# Configurar base de datos para producción
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.postgresql',
        'NAME': 'nombre_db',
        'USER': 'usuario_db',
        'PASSWORD': 'contraseña_db',
        'HOST': 'localhost',
        'PORT': '',
    }
}

# Configuración de archivos estáticos
STATIC_ROOT = BASE_DIR / 'staticfiles'

# Configuración para seguridad
SECURE_SSL_REDIRECT = True
SESSION_COOKIE_SECURE = True
CSRF_COOKIE_SECURE = True
```

### Recolección de archivos estáticos

```bash
python manage.py collectstatic
```

## 19. Recursos adicionales

- [Documentación oficial de Django](https://docs.djangoproject.com/)
- [Tutorial de Django Girls](https://tutorial.djangogirls.org/es/)
- [Django for Beginners](https://djangoforbeginners.com/)
- [Django REST Framework](https://www.django-rest-framework.org/) para APIs
- [Canales de YouTube recomendados](https://www.youtube.com/c/DjangoWeb/)

## 20. Checklist para crear un proyecto

### Paso 1: Configuración inicial
- [ ] Crear entorno virtual
- [ ] Instalar Django
- [ ] Crear proyecto
- [ ] Configurar base de datos en settings.py
- [ ] Configurar idioma y zona horaria

### Paso 2: Estructurar el proyecto
- [ ] Crear apps necesarias (core, blog, services, etc.)
- [ ] Registrar apps en INSTALLED_APPS
- [ ] Configurar directorios de templates y estáticos

### Paso 3: Modelos y administración
- [ ] Definir modelos
- [ ] Crear migraciones
- [ ] Aplicar migraciones
- [ ] Configurar admin.py
- [ ] Crear superusuario

### Paso 4: Desarrollo
- [ ] Configurar URLs del proyecto y de cada app
- [ ] Implementar vistas
- [ ] Crear templates base y heredados
- [ ] Añadir archivos estáticos (CSS, JS)
- [ ] Implementar formularios

### Paso 5: Características adicionales
- [ ] Context processors para variables globales
- [ ] Template tags personalizados
- [ ] Sistema de autenticación
- [ ] URLs SEO friendly

### Paso 6: Pruebas y depuración
- [ ] Escribir tests
- [ ] Probar todas las funcionalidades
- [ ] Verificar responsividad
- [ ] Corregir errores

### Paso 7: Despliegue
- [ ] Configurar settings.py para producción
- [ ] Recolectar archivos estáticos
- [ ] Configurar servidor web (Nginx, Apache)
- [ ] Configurar WSGI/ASGI (Gunicorn, Daphne)

## 21. Comandos esenciales de django referencia rapida

### Proyecto y Apps
```bash
# Crear un nuevo proyecto
django-admin startproject nombre_proyecto .

# Crear una nueva aplicación
python manage.py startapp nombre_app

# Ejecutar el servidor de desarrollo
python manage.py runserver

# Ejecutar el servidor en una IP/puerto específico
python manage.py runserver 192.168.1.100:8080
```

### Base de Datos y Migraciones
```bash
# Crear migraciones a partir de los cambios en tus modelos
python manage.py makemigrations

# Aplicar migraciones pendientes
python manage.py migrate

# Ver SQL que generará una migración
python manage.py sqlmigrate app_name 0001

# Verificar si hay problemas en los modelos
python manage.py check

# Exportar dependencias
pip freeze > requirements.txt
```

### Usuarios y Autenticación
```bash
# Crear un superusuario
python manage.py createsuperuser

# Cambiar contraseña de un usuario
python manage.py changepassword nombre_usuario
```

### Shell e Interacción
```bash
# Abrir shell de Django con modelos cargados
python manage.py shell

# Abrir shell de Python normal
python manage.py shell_plus  # Requiere django-extensions
```

### Testing
```bash
# Ejecutar todas las pruebas
python manage.py test

# Ejecutar pruebas de una app específica
python manage.py test nombre_app

# Ejecutar una prueba específica
python manage.py test nombre_app.tests.TestClass.test_method
```

### Mantenimiento y Producción
```bash
# Recopilar archivos estáticos para producción
python manage.py collectstatic

# Limpiar datos antiguos de sesiones
python manage.py clearsessions

# Comprobar problemas de seguridad y rendimiento
python manage.py check --deploy
```

### Internacionalización
```bash
# Crear/actualizar archivos de mensajes para traducción
python manage.py makemessages -l es

# Compilar archivos de mensajes
python manage.py compilemessages
```

### Caché
```bash
# Limpiar toda la caché
python manage.py clear_cache

# 🚀 Guía de Deploy Django en Render

## 1. Configuración en `settings.py`

- Añadir `WhiteNoiseMiddleware` en la lista de `MIDDLEWARE`:
  ```python
  MIDDLEWARE = [
      ...
      'whitenoise.middleware.WhiteNoiseMiddleware',
      ...
  ]
  ```

- Configurar el directorio de archivos estáticos:
  ```python
  STATIC_ROOT = os.path.join(BASE_DIR, 'staticfiles')
  ```

- Añadir almacenamiento de archivos comprimidos y cacheados:
  ```python
  STATICFILES_STORAGE = 'whitenoise.storage.CompressedManifestStaticFilesStorage'
  ```

- Cambiar a modo producción:
  ```python
  DEBUG = False
  ```

- Configurar hosts permitidos:
  ```python
  ALLOWED_HOSTS = ['*'] 
  # ⚠️ En producción, reemplazar '*' por tu dominio real para mayor seguridad.
  ```

- Asegurarse de importar el módulo `os`:
  ```python
  import os
  ```

## 2. Configuración en `requirements.txt`

- Asegurarse de tener las siguientes dependencias:
  ```
  whitenoise==6.7.0
  gunicorn==23.0.0
  ```
  > Nota: `gunicorn` ya estaba previamente instalado.

## 3. Configuración en Render

### Build & Deploy

- **Repository**:  
  `https://github.com/franHR11/pcpro-webempresa-django`

- **Branch**:  
  `main`

- **Root Directory**:  
  `webempresa`

- **Build Command**:
  ```bash
  pip install -r requirements.txt && python manage.py collectstatic --noinput
  ```

- **Pre-Deploy Command** (opcional):
  *(vacío de momento)*

- **Start Command**:
  ```bash
  gunicorn webempresa.wsgi:application
  ```

## 📋 Resumen rápido

| Paso | Acción |
|:----:|:------|
| 🎯 | Configurar `settings.py` para producción |
| 📦 | Instalar `whitenoise` y asegurarse de `gunicorn` en `requirements.txt` |
| 🚀 | Configurar Build & Start Commands en Render |
| 🛡️ | Ajustar `ALLOWED_HOSTS` correctamente en producción |

## ⚠️ Recomendaciones Extra

- Configurar variables de entorno en Render para seguridad (`SECRET_KEY`, conexión a base de datos, etc.).
- Activar HTTPS (Render ofrece certificados SSL gratuitos).
- Mantener `DEBUG = False` en producción.
- Usar una base de datos externa (PostgreSQL de Render, si el proyecto crece).
- Considerar cachear con Redis para proyectos grandes.

---

# 🚀 Miniguía rápida de Deploy

1. Configura `WhiteNoiseMiddleware` en `settings.py`.
2. Ajusta `STATIC_ROOT`, `STATICFILES_STORAGE`, `DEBUG = False` y `ALLOWED_HOSTS`.
3. Añade `whitenoise` en `requirements.txt`.
4. En Render: usa `pip install` + `collectstatic` como Build Command.
5. Start Command: `gunicorn proyecto.wsgi:application`.
6. Root Directory: carpeta donde está el proyecto (ej: `webempresa`).
7. Usa `SECRET_KEY` y otros valores seguros en variables de entorno.
8. Activa HTTPS.
9. Verifica logs de Render ante errores.
10. Disfruta tu web en producción 🚀.

```

## 🚀 Flujo de Trabajo Típico para Crear un Proyecto Django

1. **Configuración inicial**
   ```bash
   # Crear entorno virtual
   python -m venv venv
   
   # Activar entorno
   source venv/bin/activate  # Linux/Mac
   venv\Scripts\activate     # Windows
   
   # Instalar Django
   pip install django
   
   # Crear proyecto
   django-admin startproject mi_proyecto .
   ```

2. **Crear estructura básica**
   ```bash
   # Crear apps
   python manage.py startapp core
   python manage.py startapp blog
   
   # Registrar apps en settings.py
   # INSTALLED_APPS = [..., 'core', 'blog']
   ```

3. **Configurar base de datos y modelos**
   ```bash
   # Editar settings.py para configurar DB
   # Crear modelos en models.py
   # Registrar modelos en admin.py
   
   # Crear y aplicar migraciones
   python manage.py makemigrations
   python manage.py migrate
   ```

4. **Crear usuario administrador**
   ```bash
   python manage.py createsuperuser
   ```

5. **Crear URLs, vistas y templates**
   ```bash
   # Crear urls.py en cada app
   # Definir vistas en views.py
   # Crear carpetas templates con archivos HTML
   ```

6. **Ejecutar y probar**
   ```bash
   python manage.py runserver
   ```
