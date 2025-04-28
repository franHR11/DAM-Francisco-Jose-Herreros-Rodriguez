
# 🐍 Guía de comandos útiles con `venv` en Python

Esta guía recopila los comandos más útiles cuando trabajas con entornos virtuales (`venv`) en Python, incluyendo instalación, activación, gestión de paquetes y más.

---

## 🧱 Crear un entorno virtual

```bash
python -m venv venv
```

> Crea una carpeta llamada `venv` con el entorno virtual.

---

## 🚀 Activar el entorno virtual

### En Windows (CMD o PowerShell)
```bash
venv\Scripts\activate
```

### En macOS/Linux
```bash
source venv/bin/activate
```

---

## 🛑 Desactivar el entorno virtual

```bash
deactivate
```

---

## 📦 Instalar paquetes

```bash
pip install nombre_paquete
```

Ejemplo:
```bash
pip install django
```

---

## 🧹 Desinstalar paquetes

```bash
pip uninstall nombre_paquete
```

---

## 📋 Ver paquetes instalados

```bash
pip list
```

---

## 🔍 Ver información de un paquete específico

```bash
pip show nombre_paquete
```

---

## 🧊 Congelar dependencias

```bash
pip freeze > requirements.txt
```

Esto guarda las versiones exactas de todos los paquetes instalados en el entorno.

---

## 📂 Instalar dependencias desde un archivo

```bash
pip install -r requirements.txt
```

---

## 🔄 Actualizar pip

```bash
python -m pip install --upgrade pip
```

---

## 🧠 Equivalencias comunes con Pipenv

| Acción | pipenv | venv |
|--------|--------|------|
| Crear entorno | `pipenv install` | `python -m venv venv` |
| Activar entorno | `pipenv shell` | `source venv/bin/activate` o `venv\Scripts\activate` |
| Instalar paquete | `pipenv install paquete` | `pip install paquete` |
| Ejecutar script | `pipenv run python` | `python` |
| Guardar dependencias | `Pipfile` / `Pipfile.lock` | `requirements.txt` |

---
