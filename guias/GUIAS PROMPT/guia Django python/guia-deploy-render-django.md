# Guía Completa: Deploy Django en Render con Archivos Estáticos

## 1. Requisitos previos
- Proyecto Django funcional.
- Cuenta en [Render](https://render.com/) y repositorio en GitHub.

---

## 2. Estructura recomendada de archivos

```
webempresa/
├── core/
│   └── static/
│       └── core/
│           ├── vendor/
│           └── img/
├── staticfiles/   # Se genera con collectstatic
├── requirements.txt
└── webempresa/
    └── settings.py
```

---

## 3. Configuración en `settings.py`

```python
STATIC_URL = 'static/'
STATIC_ROOT = BASE_DIR / 'staticfiles'
STATICFILES_STORAGE = 'whitenoise.storage.CompressedManifestStaticFilesStorage'

MIDDLEWARE = [
    'whitenoise.middleware.WhiteNoiseMiddleware',
    'django.middleware.security.SecurityMiddleware',
    # ... resto del middleware
]
```

---

## 4. Añadir dependencias en `requirements.txt`

```
gunicorn
whitenoise
```

---

## 5. Referencias correctas en plantillas

```django
{% load static %}
<link rel="stylesheet" href="{% static 'core/vendor/bootstrap/css/bootstrap.min.css' %}">
<script src="{% static 'core/vendor/jquery/jquery.min.js' %}"></script>
<img src="{% static 'core/img/intro.jpg' %}" alt="Intro">
```

---

## 6. Comandos de build y start en Render

- **Build Command:**
  ```
  pip install -r requirements.txt && python manage.py collectstatic --noinput
  ```
- **Start Command:**
  ```
  gunicorn webempresa.wsgi:application
  ```

---

## 7. Deploy en Render (Web Service)
- Elige tu repo y rama.
- Usa la carpeta raíz correcta (`webempresa` si es necesario).
- Render ejecutará los comandos de build y start automáticamente.

---

## 8. Servir archivos estáticos en producción
- Render Web Service **NO tiene sección de rutas estáticas**.
- **Solución estándar:** usar WhiteNoise.
- WhiteNoise servirá `/static/` desde `staticfiles` automáticamente.

---

## 9. Verifica en producción
- Accede a tu dominio Render (`https://<tu-app>.onrender.com`).
- Los archivos estáticos deben cargar correctamente.
- Si ves errores 404, asegúrate de que:
  - `collectstatic` copió los archivos.
  - Las rutas en las plantillas son correctas.
  - WhiteNoise está en el middleware y en requirements.txt.

---

## 10. Consejos útiles
- En local, usa `DEBUG=True` para pruebas.
- En producción, pon `DEBUG=False`.
- Haz commit y push tras cada cambio importante.
- Consulta logs en Render si hay errores.

---

## Recursos
- [Documentación WhiteNoise](https://whitenoise.evans.io/en/stable/)
- [Documentación Render](https://render.com/docs/deploy-django)
- [Django: Archivos estáticos](https://docs.djangoproject.com/en/5.2/howto/static-files/)
