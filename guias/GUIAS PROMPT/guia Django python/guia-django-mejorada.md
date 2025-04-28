# 🚀 Guía Completa de Django

Una guía práctica, clara y estructurada para aprender y dominar Django. Desde la instalación hasta las funcionalidades avanzadas en un solo documento.

## 📋 Índice

- [Introducción](#introducción)
- [Instalación y configuración](#instalación-y-configuración)
- [Estructura de un proyecto Django](#estructura-de-un-proyecto-django)
- [Sistema de URLs y vistas](#sistema-de-urls-y-vistas)
- [Templates y archivos estáticos](#templates-y-archivos-estáticos)
- [Modelos y bases de datos](#modelos-y-bases-de-datos)
- [Panel de administración](#panel-de-administración)
- [Formularios](#formularios)
- [Autenticación y usuarios](#autenticación-y-usuarios)
- [Funcionalidades avanzadas](#funcionalidades-avanzadas)
- [Referencia rápida](#referencia-rápida)
- [Errores comunes y soluciones](#errores-comunes-y-soluciones)

## Introducción

Django es un framework web de alto nivel escrito en Python que fomenta el desarrollo rápido, limpio y pragmático. Sigue el patrón arquitectónico Modelo-Vista-Controlador (aunque Django lo llama Modelo-Vista-Template) y proporciona muchas funcionalidades listas para usar.

### Características principales

- **ORM potente**: Trabaja con datos como objetos Python en lugar de SQL
- **Panel de administración**: Interfaz CRUD ya construida y personalizable
- **Sistema de templates**: Lenguaje de plantillas con herencia y reutilización
- **Seguridad incorporada**: Protección contra vulnerabilidades comunes
- **Escalabilidad**: Arquitectura diseñada para crecer con tu proyecto

## Instalación y configuración

### Requisitos previos

- Python (recomendado 3.8 o superior)
- pip (gestor de paquetes de Python)

### Crear un entorno virtual

Es una buena práctica aislar las dependencias de cada proyecto:

```bash
# Windows
python -m venv venv
venv\Scripts\activate

# Linux/macOS
python -m venv venv
source venv/bin/activate
```

### Instalar Django

Con el entorno virtual activado:

```bash
pip install django
```

### Crear un nuevo proyecto

```bash
django-admin startproject nombre_proyecto
cd nombre_proyecto
```

### Iniciar el servidor de desarrollo

```bash
python manage.py runserver
```

Visita http://127.0.0.1:8000/ en tu navegador para ver la página de bienvenida.

## Estructura de un proyecto Django

### Estructura básica

```
nombre_proyecto/
├── manage.py              # Utilidad de línea de comandos
├── nombre_proyecto/       # Paquete Python del proyecto
│   ├── __init__.py        # Indica que es un paquete Python
│   ├── settings.py        # Configuración del proyecto
│   ├── urls.py            # Declaración de URLs del proyecto
│   ├── asgi.py            # Punto de entrada para servidores ASGI
│   └── wsgi.py            # Punto de entrada para servidores WSGI
└── db.sqlite3             # Base de datos por defecto (creada automáticamente)
```

### Crear una app

En Django, un proyecto se divide en "apps" (aplicaciones) que son módulos con funcionalidades específicas:

```bash
python manage.py startapp nombre_app
```

Esto crea una nueva carpeta con la siguiente estructura:

```
nombre_app/
├── __init__.py
├── admin.py         # Configuración del panel admin
├── apps.py          # Configuración de la app
├── migrations/      # Migraciones de la base de datos
├── models.py        # Modelos de datos
├── tests.py         # Tests unitarios
└── views.py         # Vistas (controladores)
```

### Registrar la app en el proyecto

Para que Django reconozca tu app, debes registrarla en `settings.py`:

```python
INSTALLED_APPS = [
    'django.contrib.admin',
    'django.contrib.auth',
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.messages',
    'django.contrib.staticfiles',
    'nombre_app',  # Añade tu app aquí
]
```

## Sistema de URLs y vistas

Django utiliza un sistema de mapeo URL-Vista para dirigir las solicitudes HTTP a funciones Python específicas.

### Configuración de URLs del proyecto

En `nombre_proyecto/urls.py`:

```python
from django.contrib import admin
from django.urls import path, include

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('nombre_app.urls')),  # Incluye las URLs de tu app
]
```

### Crear archivo de URLs para tu app

Primero crea un archivo `urls.py` en tu carpeta de app:

```python
# nombre_app/urls.py
from django.urls import path
from . import views

urlpatterns = [
    path('', views.home, name='home'),
    path('about/', views.about, name='about'),
    path('detail/<int:id>/', views.detail, name='detail'),  # URL con parámetro
]
```

### Crear vistas básicas

En `nombre_app/views.py`:

```python
from django.shortcuts import render, get_object_or_404
from django.http import HttpResponse
from .models import MiModelo

# Vista simple que devuelve texto
def home(request):
    return HttpResponse("Página de inicio")

# Vista que renderiza un template
def about(request):
    return render(request, 'nombre_app/about.html')

# Vista con parámetros y consulta a base de datos
def detail(request, id):
    # Obtiene el objeto o devuelve 404 si no existe
    objeto = get_object_or_404(MiModelo, pk=id)
    return render(request, 'nombre_app/detail.html', {'objeto': objeto})
```

## Templates y archivos estáticos

### Estructura recomendada

```
nombre_app/
├── templates/               # Carpeta de templates
│   └── nombre_app/          # Prefijo para evitar colisiones
│       ├── base.html        # Template base con estructura común
│       ├── home.html        # Extiende de base.html
│       └── detail.html      # Página de detalle
└── static/                  # Archivos estáticos (CSS, JS, imágenes)
    └── nombre_app/          # Prefijo para evitar colisiones
        ├── css/             # Hojas de estilo
        ├── js/              # JavaScript
        └── img/             # Imágenes
```

### Template base (herencia)

```html
<!-- templates/nombre_app/base.html -->
{% load static %}
<!DOCTYPE html>
<html>
<head>
    <title>{% block title %}Mi sitio Django{% endblock %}</title>
    <link rel="stylesheet" href="{% static 'nombre_app/css/styles.css' %}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{% url 'home' %}" {% if request.resolver_match.view_name == 'home' %}class="active"{% endif %}>Inicio</a></li>
                <li><a href="{% url 'about' %}" {% if request.resolver_match.view_name == 'about' %}class="active"{% endif %}>Acerca de</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        {% block content %}
        <!-- Aquí va el contenido específico de cada página -->
        {% endblock %}
    </main>
    
    <footer>
        &copy; {% now "Y" %} Mi Proyecto Django
    </footer>
    
    <script src="{% static 'nombre_app/js/main.js' %}"></script>
    {% block extra_js %}{% endblock %}
</body>
</html>
```

### Template que extiende del base

```html
<!-- templates/nombre_app/home.html -->
{% extends 'nombre_app/base.html' %}
{% load static %}

{% block title %}Inicio | Mi sitio Django{% endblock %}

{% block content %}
<h1>Bienvenido a mi sitio</h1>
<p>Esta es la página de inicio construida con Django.</p>

{% if items %}
    <ul>
    {% for item in items %}
        <li>{{ item.nombre }} - {{ item.descripcion }}</li>
    {% empty %}
        <li>No hay elementos disponibles.</li>
    {% endfor %}
    </ul>
{% endif %}
{% endblock %}

{% block extra_js %}
<script src="{% static 'nombre_app/js/home.js' %}"></script>
{% endblock %}
```

### Configuración de archivos estáticos

Django automáticamente busca los archivos estáticos en la carpeta `static` de cada app, pero puedes personalizar esto en `settings.py`:

```python
# Ruta URL para acceder a los estáticos
STATIC_URL = '/static/'

# Carpetas adicionales de estáticos (opcional)
STATICFILES_DIRS = [
    BASE_DIR / "static",
]

# Carpeta donde se recopilarán los estáticos para producción
STATIC_ROOT = BASE_DIR / "staticfiles"
```

### Configuración de archivos media (subidos por usuarios)

Para gestionar archivos subidos por los usuarios (imágenes, PDFs, etc.):

```python
# settings.py
MEDIA_URL = '/media/'
MEDIA_ROOT = BASE_DIR / 'media'
```

Para servir estos archivos durante el desarrollo:

```python
# urls.py principal
from django.conf import settings
from django.conf.urls.static import static

urlpatterns = [
    # Tus URLs aquí
]

if settings.DEBUG:
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
```

## Modelos y bases de datos

Los modelos son clases Python que definen la estructura de tus datos y te permiten interactuar con la base de datos.

### Definir un modelo

En `nombre_app/models.py`:

```python
from django.db import models
from django.utils import timezone
from django.contrib.auth.models import User

class Categoria(models.Model):
    nombre = models.CharField(max_length=100, verbose_name="Nombre")
    
    class Meta:
        verbose_name = "categoría"
        verbose_name_plural = "categorías"
        ordering = ["nombre"]
    
    def __str__(self):
        return self.nombre

class Articulo(models.Model):
    titulo = models.CharField(max_length=200, verbose_name="Título")
    contenido = models.TextField(verbose_name="Contenido")
    imagen = models.ImageField(upload_to="articulos", verbose_name="Imagen", null=True, blank=True)
    autor = models.ForeignKey(User, on_delete=models.CASCADE, verbose_name="Autor")
    categorias = models.ManyToManyField(Categoria, verbose_name="Categorías")
    publicado = models.BooleanField(default=False, verbose_name="Publicado")
    creado = models.DateTimeField(auto_now_add=True, verbose_name="Fecha de creación")
    actualizado = models.DateTimeField(auto_now=True, verbose_name="Fecha de actualización")
    
    class Meta:
        verbose_name = "artículo"
        verbose_name_plural = "artículos"
        ordering = ["-creado"]
    
    def __str__(self):
        return self.titulo
```

### Migraciones

Las migraciones son la forma de Django para propagar cambios en los modelos a la base de datos:

```bash
# Crear migraciones basadas en los cambios en los modelos
python manage.py makemigrations

# Aplicar esas migraciones a la base de datos
python manage.py migrate
```

### Consultas básicas

```python
# Obtener todos los artículos
articulos = Articulo.objects.all()

# Filtrar artículos
publicados = Articulo.objects.filter(publicado=True)
recientes = Articulo.objects.filter(creado__gte=timezone.now() - timezone.timedelta(days=7))

# Ordenar resultados
ordenados = Articulo.objects.order_by("-creado")

# Obtener un solo objeto
articulo = Articulo.objects.get(pk=1)  # Lanza excepción si no existe
articulo = Articulo.objects.filter(pk=1).first()  # Devuelve None si no existe

# Consultas complejas
from django.db.models import Q
resultados = Articulo.objects.filter(
    Q(titulo__icontains="django") | Q(contenido__icontains="django")
)

# Obtener objetos relacionados
articulos_categoria = Categoria.objects.get(nombre="Django").articulo_set.all()
```

## Panel de administración

Django viene con un panel de administración potente y personalizable.

### Crear superusuario

```bash
python manage.py createsuperuser
```

### Registrar modelos en el admin

En `nombre_app/admin.py`:

```python
from django.contrib import admin
from .models import Categoria, Articulo

@admin.register(Categoria)
class CategoriaAdmin(admin.ModelAdmin):
    list_display = ("nombre",)
    search_fields = ("nombre",)

@admin.register(Articulo)
class ArticuloAdmin(admin.ModelAdmin):
    list_display = ("titulo", "autor", "publicado", "get_categorias", "creado")
    list_filter = ("publicado", "autor", "categorias")
    search_fields = ("titulo", "contenido", "autor__username")
    list_editable = ("publicado",)
    date_hierarchy = "creado"
    readonly_fields = ("creado", "actualizado")
    filter_horizontal = ("categorias",)
    
    def get_categorias(self, obj):
        return ", ".join([cat.nombre for cat in obj.categorias.all()])
    get_categorias.short_description = "Categorías"
    
    # Para mostrar miniaturas de las imágenes
    def image_thumbnail(self, obj):
        if obj.imagen:
            from django.utils.html import mark_safe
            return mark_safe(f'<img src="{obj.imagen.url}" style="width:50px; height:auto;">')
        return ""
    image_thumbnail.short_description = "Miniatura"
```

### Personalizar el admin

Para cambiar el nombre del sitio, títulos y otras opciones:

```python
# admin.py
admin.site.site_header = "Panel de Administración"
admin.site.site_title = "Mi Proyecto Django"
admin.site.index_title = "Bienvenido al panel de gestión"
```

## Formularios

Django proporciona un potente sistema de formularios para validar y procesar datos.

### Formulario basado en modelo

```python
# forms.py
from django import forms
from .models import Articulo

class ArticuloForm(forms.ModelForm):
    class Meta:
        model = Articulo
        fields = ['titulo', 'contenido', 'imagen', 'categorias', 'publicado']
        widgets = {
            'titulo': forms.TextInput(attrs={'class': 'form-control', 'placeholder': 'Título'}),
            'contenido': forms.Textarea(attrs={'class': 'form-control', 'rows': 5}),
            'categorias': forms.CheckboxSelectMultiple(),
        }
```

### Vista para procesar el formulario

```python
# views.py
from django.shortcuts import render, redirect
from django.contrib.auth.decorators import login_required
from .forms import ArticuloForm

@login_required
def crear_articulo(request):
    if request.method == 'POST':
        form = ArticuloForm(request.POST, request.FILES)
        if form.is_valid():
            articulo = form.save(commit=False)  # No guardar aún
            articulo.autor = request.user       # Asignar el autor
            articulo.save()                     # Guardar
            form.save_m2m()                     # Guardar relaciones M2M
            return redirect('detalle_articulo', id=articulo.id)
    else:
        form = ArticuloForm()
    
    return render(request, 'nombre_app/crear_articulo.html', {'form': form})
```

### Template con formulario

```html
<!-- templates/nombre_app/crear_articulo.html -->
{% extends 'nombre_app/base.html' %}

{% block content %}
<h1>Crear nuevo artículo</h1>

<form method="post" enctype="multipart/form-data">
    {% csrf_token %}
    
    {% if form.non_field_errors %}
        <div class="alert alert-danger">
            {% for error in form.non_field_errors %}
                {{ error }}
            {% endfor %}
        </div>
    {% endif %}
    
    {% for field in form %}
        <div class="form-group">
            {{ field.label_tag }}
            {{ field }}
            
            {% if field.errors %}
                <div class="text-danger">
                    {% for error in field.errors %}
                        {{ error }}
                    {% endfor %}
                </div>
            {% endif %}
            
            {% if field.help_text %}
                <small class="form-text text-muted">{{ field.help_text }}</small>
            {% endif %}
        </div>
    {% endfor %}
    
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
{% endblock %}
```

## Autenticación y usuarios

Django tiene un sistema de autenticación incorporado.

### Vistas de login y logout

```python
# views.py
from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.forms import AuthenticationForm
from django.shortcuts import render, redirect

def login_view(request):
    if request.user.is_authenticated:
        return redirect('home')
        
    if request.method == 'POST':
        form = AuthenticationForm(request, data=request.POST)
        if form.is_valid():
            username = form.cleaned_data.get('username')
            password = form.cleaned_data.get('password')
            user = authenticate(username=username, password=password)
            if user is not None:
                login(request, user)
                return redirect('home')
    else:
        form = AuthenticationForm()
    
    return render(request, 'nombre_app/login.html', {'form': form})

def logout_view(request):
    logout(request)
    return redirect('login')
```

### Proteger vistas con decoradores

```python
from django.contrib.auth.decorators import login_required, permission_required

@login_required
def perfil(request):
    # Solo usuarios autenticados pueden acceder
    return render(request, 'nombre_app/perfil.html')

@permission_required('nombre_app.add_articulo')
def crear_articulo(request):
    # Solo usuarios con permiso específico pueden acceder
    # ...
```

### URLs de autenticación

```python
# urls.py
from django.urls import path
from . import views

urlpatterns = [
    path('login/', views.login_view, name='login'),
    path('logout/', views.logout_view, name='logout'),
]
```

## Funcionalidades avanzadas

### Paginación

```python
# views.py
from django.core.paginator import Paginator

def lista_articulos(request):
    articulos_list = Articulo.objects.filter(publicado=True)
    
    # Configurar paginación (10 artículos por página)
    paginator = Paginator(articulos_list, 10)
    page = request.GET.get('page')
    articulos = paginator.get_page(page)
    
    return render(request, 'nombre_app/lista_articulos.html', {'articulos': articulos})
```

En el template:

```html
<div class="paginator">
    <span class="step-links">
        {% if articulos.has_previous %}
            <a href="?page=1">&laquo; primera</a>
            <a href="?page={{ articulos.previous_page_number }}">anterior</a>
        {% endif %}

        <span class="current">
            Página {{ articulos.number }} de {{ articulos.paginator.num_pages }}
        </span>

        {% if articulos.has_next %}
            <a href="?page={{ articulos.next_page_number }}">siguiente</a>
            <a href="?page={{ articulos.paginator.num_pages }}">última &raquo;</a>
        {% endif %}
    </span>
</div>
```

### Template tags personalizados

Crear archivo `nombre_app/templatetags/nombre_app_tags.py`:

```python
from django import template
from ..models import Categoria

register = template.Library()

@register.simple_tag
def get_categorias():
    return Categoria.objects.all()

@register.filter
def recortar(texto, longitud=100):
    if len(texto) <= longitud:
        return texto
    return texto[:longitud] + '...'
```

Uso en template:

```html
{% load nombre_app_tags %}

{% get_categorias as categorias %}
<ul>
    {% for categoria in categorias %}
        <li>{{ categoria.nombre }}</li>
    {% endfor %}
</ul>

<p>{{ articulo.contenido|recortar:200 }}</p>
```

### Context processors

Crear archivo `nombre_app/context_processors.py`:

```python
def global_settings(request):
    return {
        'SITE_NAME': 'Mi Sitio Django',
        'SITE_URL': 'https://misitio.com',
    }
```

Registrar en `settings.py`:

```python
TEMPLATES = [
    {
        # ...
        'OPTIONS': {
            'context_processors': [
                # ...
                'nombre_app.context_processors.global_settings',
            ],
        },
    },
]
```

Ahora `SITE_NAME` y `SITE_URL` estarán disponibles en todos tus templates.

## Referencia rápida

### Campos de modelo más utilizados

| Campo | Descripción | Ejemplo |
|-------|-------------|---------|
| `CharField` | Texto corto | `titulo = models.CharField(max_length=100)` |
| `TextField` | Texto largo | `contenido = models.TextField()` |
| `IntegerField` | Número entero | `edad = models.IntegerField()` |
| `DecimalField` | Número decimal | `precio = models.DecimalField(max_digits=10, decimal_places=2)` |
| `BooleanField` | Booleano | `activo = models.BooleanField(default=True)` |
| `DateField` | Fecha | `fecha = models.DateField()` |
| `DateTimeField` | Fecha y hora | `creado = models.DateTimeField(auto_now_add=True)` |
| `EmailField` | Email | `email = models.EmailField()` |
| `FileField` | Archivo | `documento = models.FileField(upload_to='docs/')` |
| `ImageField` | Imagen | `imagen = models.ImageField(upload_to='images/')` |
| `ForeignKey` | Relación uno a muchos | `autor = models.ForeignKey(User, on_delete=models.CASCADE)` |
| `ManyToManyField` | Muchos a muchos | `categorias = models.ManyToManyField(Categoria)` |
| `OneToOneField` | Uno a uno | `perfil = models.OneToOneField(Perfil, on_delete=models.CASCADE)` |

### Etiquetas de template

| Etiqueta | Descripción | Ejemplo |
|----------|-------------|---------|
| `if` | Condición | `{% if user.is_authenticated %}...{% endif %}` |
| `for` | Bucle | `{% for item in items %}...{% endfor %}` |
| `block` | Bloque heredable | `{% block content %}...{% endblock %}` |
| `extends` | Herencia de template | `{% extends 'base.html' %}` |
| `include` | Incluir otro template | `{% include 'navbar.html' %}` |
| `url` | Generar URL | `{% url 'view_name' id=123 %}` |
| `static` | Ruta a archivo estático | `{% static 'css/styles.css' %}` |
| `csrf_token` | Token CSRF | `{% csrf_token %}` |
| `with` | Variable temporal | `{% with total=precio*cantidad %}...{% endwith %}` |
| `comment` | Comentario | `{% comment %}...{% endcomment %}` |

### Filtros de template

| Filtro | Descripción | Ejemplo |
|--------|-------------|---------|
| `date` | Formato de fecha | `{{ fecha|date:"d/m/Y" }}` |
| `time` | Formato de hora | `{{ hora|time:"H:i" }}` |
| `default` | Valor por defecto | `{{ valor|default:"No disponible" }}` |
| `length` | Longitud | `{{ lista|length }}` |
| `truncatechars` | Truncar caracteres | `{{ texto|truncatechars:50 }}` |
| `truncatewords` | Truncar palabras | `{{ texto|truncatewords:10 }}` |
| `lower` | Minúsculas | `{{ texto|lower }}` |
| `upper` | Mayúsculas | `{{ texto|upper }}` |
| `title` | Capitalizar palabras | `{{ texto|title }}` |
| `linebreaks` | Saltos de línea a HTML | `{{ texto|linebreaks }}` |
| `safe` | Marcar como HTML seguro | `{{ html|safe }}` |
| `join` | Unir lista | `{{ lista|join:", " }}` |

## Errores comunes y soluciones

### Error: App no encontrada

**Problema**: `No installed app with label 'nombre_app'`

**Solución**: 
1. Asegúrate de que la app está en `INSTALLED_APPS` en `settings.py`
2. Verifica que el nombre de la app es correcto (sin errores de tipeo)
3. Si usas un nombre personalizado, asegúrate de configurar `name` en `apps.py`

### Error: Template no encontrado

**Problema**: `TemplateDoesNotExist at /ruta/`

**Solución**:
1. Verifica la ruta del template (recuerda el prefijo de app: `app/template.html`)
2. Asegúrate de que la app está en `INSTALLED_APPS`
3. Comprueba que el directorio `templates` existe y está en el lugar correcto

### Error: URL no encontrada

**Problema**: `Reverse for 'nombre_vista' not found`

**Solución**:
1. Verifica que existe una URL con ese name en `urls.py`
2. Si usas namespaces, usa el formato completo: `{% url 'app:nombre_vista' %}`
3. Asegúrate de proporcionar todos los parámetros requeridos

### Error: Relación no existente

**Problema**: `FieldError: Cannot resolve keyword 'campo' into field`

**Solución**:
1. Verifica que el campo existe en el modelo
2. Comprueba la ortografía exacta (es sensible a mayúsculas/minúsculas)
3. Si es una relación, asegúrate de usar el nombre correcto (no el verbose_name)

### Error: Migración fallida

**Problema**: Errores durante `python manage.py migrate`

**Solución**:
1. Si es un error de campo no nulo, añade `null=True` o proporciona un valor por defecto
2. Si hay conflictos, considera borrar el archivo de migración problemático y recrearlo
3. En desarrollo, a veces es más fácil borrar la base de datos y empezar de nuevo

### Error: Imagen no visible

**Problema**: Las imágenes subidas no se muestran

**Solución**:
1. Verifica la configuración de `MEDIA_URL` y `MEDIA_ROOT` en `settings.py`
2. Asegúrate de haber configurado las URLs para servir archivos media en desarrollo
3. Comprueba los permisos de la carpeta de media
4. Usa `{{ objeto.imagen.url }}` (no `{{ objeto.imagen }}`) en las plantillas
