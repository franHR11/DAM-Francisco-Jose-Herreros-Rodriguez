# MEMORIAS DEL PROYECTO INMOBILIARIA

## Resumen del Proyecto
Sistema web de gestión de propiedades inmobiliarias desarrollado con PHP orientado a objetos, MySQL y SASS para los estilos. El proyecto sigue un patrón MVC simplificado para organizar el código y separar responsabilidades.

## Decisiones de Arquitectura

### Patrón MVC Simplificado
- **Modelos:** Clases en /classes/ que gestionan la lógica de negocio y acceso a datos
- **Vistas:** Plantillas en /includes/templates/ que se renderizan al usuario
- **Controladores:** Scripts PHP que conectan modelos y vistas

### Programación Orientada a Objetos
Se implementó POO para mejorar la organización del código:
- Clase `Propiedad`: Gestiona toda la lógica relacionada con las propiedades inmobiliarias
- Clase `Vendedor`: Gestiona la información de los vendedores
- Clase `Categoria`: Gestiona las categorías de propiedades
- Namespace `App`: Organiza las clases de la aplicación

### Front-end
- Utilización de SASS como preprocesador CSS para mejorar la mantenibilidad
- Gulp para automatizar tareas de compilación y optimización de assets
- Diseño responsive para adaptarse a diferentes dispositivos

## Historial de Desarrollo

### Fase 1: Estructura Básica
- Configuración inicial del proyecto
- Creación de la estructura de directorios
- Configuración de la base de datos

### Fase 2: Backend
- Desarrollo de la clase Propiedad para gestión de propiedades
- Implementación del sistema CRUD para propiedades
- Desarrollo del sistema de autenticación para vendedores

### Fase 3: Frontend
- Diseño de templates para el sitio web
- Implementación de las secciones principales (inicio, anuncios, blog, contacto)
- Desarrollo de estilos con SASS

### Fase 4: Optimización
- Refactorización de código
- Implementación de validaciones
- Mejoras de seguridad

### Fase 5: Gestión de Vendedores
- Implementación de la clase Vendedor
- Desarrollo del CRUD completo para vendedores
- Integración con el panel de administración
- Validación de datos de vendedores

### Fase 6: Mejoras en la Interfaz de Usuario
- Optimización de las tablas para una mejor visualización de datos
- Mejora en las rutas para detectar correctamente subfolders en la administración
- Implementación de paginación para las listas de propiedades y vendedores
- Mejora en los formularios de búsqueda con estilos modernos y mejor UX
- Implementación de botones de búsqueda y limpieza con mejor organización visual

### Fase 7: Mejoras en la Experiencia de Usuario
- Implementación de persistencia de datos en formularios tras errores de validación
- Corrección de inconsistencias en nombres de campos entre el formulario y el backend
- Optimización del proceso de actualización de propiedades
- Mejora en la gestión de errores de validación

### Fase 8: Sistema de Anuncios Destacados y Categorías
- Ampliación de la estructura de la base de datos para incluir propiedades destacadas y categorías
- Implementación de un sistema para destacar propiedades en la página principal
- Incorporación de paginación en la sección de anuncios
- Desarrollo de un sistema de búsqueda y filtrado por categorías
- Mejora del diseño responsive para los anuncios
- Implementación de un grid de 6 anuncios en la página principal
- Optimización del rendimiento con índices de bases de datos

## Decisiones Técnicas Clave

### Base de Datos
- MySQL para almacenamiento de datos
- Tablas principales: propiedades, vendedores, usuarios, categorias
- Relaciones entre propiedades y vendedores
- Relaciones entre propiedades y categorías
- Uso de restricciones de integridad referencial con claves foráneas
- Implementación de índices para optimizar búsquedas y filtros

### Sistema de Archivos
- Organización basada en funcionalidad
- Separación de código del frontend y backend
- Automatización de compilación con Gulp

### Seguridad
- Sanitización de entradas para prevenir SQL Injection
- Validación de formularios en cliente y servidor
- Sistema de autenticación para el panel de administración

### Mejoras en la Experiencia de Usuario
- Formularios de búsqueda mejorados con diseño moderno y responsivo
- Implementación de un contenedor específico para los botones de búsqueda con la clase `.botones-busqueda`
- Efectos visuales y transiciones para mejorar la interacción del usuario
- Estilos adaptados para dispositivos móviles y tablets
- Mejora en la visualización de los resultados de búsqueda
- Persistencia de datos en formularios para evitar pérdida de información tras errores de validación
- Sistema de paginación para navegar por grandes conjuntos de propiedades
- Filtrado por categorías para encontrar más fácilmente propiedades de interés
- Propiedades destacadas en la página principal para mayor visibilidad
- Estructura responsive adaptada para diferentes tamaños de pantalla

## Próximas Mejoras
- Implementación de un sistema de búsqueda avanzada con más filtros
- Galería de múltiples imágenes por propiedad
- Integración con APIs de mapas para ubicación de propiedades
- Mejoras en el dashboard de administración 
- Sistema de favoritos para usuarios registrados

## Actualizaciones Recientes

### Mejora de Formularios de Búsqueda (Junio 2023)
- Rediseño de los formularios de búsqueda en el panel de administración
- Implementación de la clase `.botones-busqueda` para organizar mejor los botones
- Mejora en la estética y usabilidad de los inputs de búsqueda
- Optimización del diseño responsive para mejor experiencia en dispositivos móviles
- Efectos de hover y focus mejorados para una mejor interacción

### Mejora de Persistencia de Datos en Formularios (Julio 2023)
- Implementación de persistencia de datos en formularios de creación y actualización
- Corrección de inconsistencias entre nombres de campos en formularios y backend
- Optimización del proceso de validación para conservar datos ingresados
- Mejora en la experiencia de usuario al reducir la necesidad de reingresar datos tras errores

### Sistema de Anuncios Destacados y Categorización (Agosto 2023)
- Implementación de una estructura para propiedades destacadas en la página principal
- Desarrollo de un sistema de categorización de propiedades
- Incorporación de filtros de búsqueda por categoría
- Mejora de la interfaz de usuario con grid responsive para anuncios
- Optimización del rendimiento con indexación de base de datos
- Implementación de paginación en la sección de anuncios
- Reorganización de los anuncios para ocupar el ancho completo del dispositivo 

### Implementación del Panel de Administración de Categorías (Marzo 2025)
- Desarrollo completo del sistema CRUD para categorías
- Integración de categorías en el panel principal de administración
- Implementación de funciones de búsqueda y filtrado de categorías
- Visualización del número de propiedades asociadas a cada categoría
- Mejora de la usabilidad con confirmación de operaciones exitosas
- Optimización de consultas SQL para el conteo de propiedades por categoría
- Implementación de validación para evitar categorías duplicadas o sin nombre 

### Mejora de Estilos para Categorías en el Panel de Administración (Marzo 2025)
- Implementación de estilos consistentes para la sección de categorías en el panel de administración
- Diseño mejorado para formularios de creación y actualización de categorías
- Resaltado visual del contador de propiedades asociadas a cada categoría
- Efectos de hover y transiciones para mejorar la experiencia de usuario
- Optimización de espaciado y alineación de elementos
- Aplicación de efectos de sombra y elevación para botones de acción
- Mejora en la visualización de las tablas de categorías para facilitar la administración 

### Implementación de Menú de Navegación en el Panel de Administración (Marzo 2025)
- Desarrollo de un menú de navegación superior para el panel de administración
- Diseño responsivo que se adapta a diferentes tamaños de pantalla
- Indicador visual para la sección activa en el menú
- Acceso rápido a todas las secciones principales: Propiedades, Vendedores, Categorías y Blog
- Implementación de efectos visuales para mejorar la experiencia del usuario
- Integración del menú en todas las páginas del panel de administración
- Estructura preparada para la futura implementación del CRUD de Blog 

### Correcciones y Mejoras en la Navegación del Panel de Administración (Marzo 2025)
- Corrección de problemas de rutas en el menú de navegación para garantizar la funcionalidad de todos los enlaces
- Mejora de los estilos visuales del menú con efectos de elevación y transiciones suaves
- Optimización del cálculo de rutas relativas para funcionar correctamente en todas las secciones del panel
- Creación de una página placeholder para la sección de Blog con información sobre funcionalidades futuras
- Implementación de nuevos tipos de alertas (info) para mejorar la comunicación visual con el usuario
- Ajustes en el posicionamiento y espaciado del menú para mejorar la usabilidad
- Verificación de compatibilidad con todos los navegadores principales 

### Solución de Problemas de Estilo en el Menú de Administración (Marzo 2025)
- Corrección del problema de estilos no aplicados en el menú de navegación de administración
- Incorporación del archivo de estilos del menú en el archivo principal de SCSS
- Optimización de la estructura CSS para mejorar la visualización en todos los dispositivos
- Resolución de conflictos con mixins no definidos en los archivos de estilo
- Mejora en la consistencia visual del menú en todas las secciones del panel de administración
- Implementación de una solución más robusta para la gestión de estilos del menú
- Simplificación del código CSS para mejorar el mantenimiento futuro 

### Mejora de Seguridad y Consistencia en el Panel de Administración (Marzo 2025)
- Reforzamiento del sistema de autenticación para el panel de administración
- Corrección en la función estaAutenticado() para redirigir correctamente a usuarios no autenticados
- Implementación consistente del menú de navegación en todas las secciones del panel
- Unificación de la experiencia de usuario en las diferentes áreas de administración
- Aseguramiento de que todas las páginas administrativas requieren autenticación
- Mejora en la estructura de navegación para mantener coherencia visual en todo el panel
- Optimización de la redirección de usuarios no autorizados con mensajes informativos
- Corrección de problemas de visualización en la sección de blog y otras áreas 

### Corrección de la Sección de Blog en el Panel de Administración (Marzo 2025)
- Solución de problemas de rutas en los archivos de header y footer para la sección de blog
- Actualización de la lógica de detección de rutas para reconocer correctamente la estructura del directorio blog
- Unificación de la inclusión de plantillas en todas las secciones administrativas
- Mejora en la visualización de la página placeholder del blog con estilos consistentes
- Corrección de problemas con los estilos CSS que no se aplicaban correctamente
- Optimización de la estructura de navegación para ofrecer una experiencia unificada
- Implementación de mensajes informativos sobre el estado de desarrollo de la sección
- Ajuste de los cálculos de rutas relativas para garantizar que los assets se carguen correctamente 

### Mejora de Portabilidad del Sistema de Autenticación (Marzo 2025)
- Implementación de rutas relativas en el sistema de redirección de usuarios no autenticados
- Optimización del cálculo dinámico de rutas para funcionar correctamente en cualquier entorno de servidor
- Corrección del problema de redirección a URLs absolutas que causaba errores en diferentes configuraciones
- Mejora en la detección de la profundidad de directorios para calcular correctamente las rutas relativas
- Implementación de un sistema que funciona correctamente tanto en servidores Windows como Linux
- Compatibilidad garantizada con diferentes configuraciones de alojamiento y URLs personalizadas
- Mejora en la experiencia de usuario al mantener mensajes informativos sobre acceso denegado
- Soporte para instalación del proyecto en subdirectorios o en raíz del dominio 

### Reorganización de la Interfaz de Administración y Propiedades Destacadas (Marzo 2025)
- Rediseño del formulario de búsqueda para ubicarlo a la derecha junto a los botones de acción
- Mejora en la estructura de la interfaz para un uso más eficiente del espacio
- Implementación de una sección para mostrar las 6 propiedades destacadas en el panel de administración
- Presentación de propiedades destacadas en un grid responsive con información detallada
- Reorganización de los componentes en el panel de administración para mejorar la usabilidad
- Adición de iconos para visualizar rápidamente las características de cada propiedad
- Mejora en los estilos visuales de las tarjetas de propiedades con efectos de elevación y transiciones
- Optimización del diseño para adaptarse a diferentes tamaños de pantalla 

### Corrección de Estilos en el Formulario de Búsqueda y Estructura de Iconos (Marzo 2025)
- Solución del problema de estilos no aplicados en el formulario de búsqueda
- Integración correcta del archivo SCSS `_busqueda.scss` en el archivo principal `app.scss`
- Optimización de la estructura HTML de los iconos en las propiedades destacadas
- Cambio de la estructura de iconos de `<div>` a `<ul><li>` para mantener coherencia y accesibilidad
- Aplicación de estilos consistentes en todas las secciones de administración
- Unificación del diseño de cabeceras de sección con clases como `admin-header con-busqueda`
- Reorganización del código para mejor mantenimiento y consistencia visual
- Mejora global de la experiencia de usuario al garantizar que todos los elementos tengan estilos correctos 

### Optimización del Formulario de Búsqueda (Marzo 2025)
- Redimensionamiento del formulario de búsqueda para hacerlo más compacto y eficiente
- Alineación del formulario a la derecha de la pantalla para mejorar el equilibrio visual
- Reducción del tamaño de fuente y espaciado interno para un diseño más elegante
- Optimización de los botones de búsqueda para ocupar menos espacio vertical
- Mejora de la disposición de elementos en móvil para mantener una apariencia coherente
- Ajuste de bordes y sombras para un aspecto más moderno y sutil
- Limitación del ancho máximo para evitar que domine visualmente la interfaz
- Simplificación del diseño para agilizar la experiencia del usuario 

### Implementación de Sistema de Blog y Editor Avanzado (Marzo 2025)
- Instalación e integración del editor de texto SunEditor mediante npm para una experiencia de edición mejorada
- Creación de la estructura básica para el sistema de blog con secciones para entradas y categorías
- Desarrollo de la estructura de clases para la gestión de entradas de blog (BlogEntry) y categorías (BlogCategory)
- Implementación de un diseño consistente en todas las secciones del blog utilizando los patrones establecidos
- Preparación para la futura implementación de funcionalidades CRUD completas para entradas y categorías
- Integración del editor avanzado en los formularios de creación y edición de contenido
- Configuración de los campos de descripción para soportar contenido HTML enriquecido
- Mejora en la presentación y usabilidad de los formularios de gestión de contenido 

### Refinamiento de Estilos en Propiedades Destacadas (Marzo 2025)
- Corrección de problemas con los iconos de características en las propiedades destacadas
- Actualización de la estructura HTML de las propiedades destacadas para usar clases más específicas
- Implementación de clases como `propiedad-destacada` y `grid-propiedades` para mejorar la especificidad de estilos
- Mejora en la visualización de los iconos de baños, estacionamiento y habitaciones
- Reorganización de la disposición de botones de edición y eliminación con la clase `acciones`
- Ajuste del espaciado y alineación de elementos para una presentación más profesional
- Optimización de tamaños de fuente y colores para mejorar la legibilidad
- Refinamiento de efectos de hover y transiciones para una experiencia más interactiva
- Corrección del problema de posicionamiento de botones en la sección de categorías
- Reporte y corrección de errores visuales en secciones específicas del panel de administración 

# Registro de Cambios y Decisiones

## Sistema de Autenticación (Febrero 2024)
- Implementación del sistema de login con sesiones PHP
- Protección de rutas administrativas
- Encriptación de contraseñas con password_hash y password_verify
- Mensajes de error para credenciales inválidas

## Implementación del Panel Administrativo (Febrero 2024)
- Creación del CRUD completo para propiedades
- Implementación de subida y validación de imágenes
- Creación de sistema de vendedores
- Navegación intuitiva entre secciones

## Mejora de Portabilidad del Sistema de Autenticación (Marzo 2025)
- Se mejoró la redirección de usuarios utilizando cálculos dinámicos de rutas
- Se implementó un sistema para determinar automáticamente la URL base
- Se corrigieron problemas con las rutas relativas para garantizar compatibilidad en diferentes entornos de servidor
- Se agregó validación de sesiones más robusta

## Reorganización de la Interfaz de Administración y Propiedades Destacadas (Marzo 2025)
- Rediseño del formulario de búsqueda para mejorar la experiencia de usuario
- Implementación de una sección para mostrar 6 propiedades destacadas
- Mejora en la visualización de información de propiedades con iconos
- Botones de edición y eliminación más accesibles
- Optimización del espacio y mejora visual general

## Sección de Blog y Categorías (Marzo 2025)
- Creación de clases para gestionar entradas de blog y categorías
- Implementación del CRUD completo para el blog
- Diseño de interfaz específica para el blog en el panel de administración
- Nuevo sistema de visualización de entradas con imágenes destacadas
- Funcionalidad para marcar entradas como destacadas
- Sistema de categorización de entradas con conteo de artículos
- Estilos específicos para la visualización del blog tanto en la parte administrativa como pública
- Implementación de búsqueda por título y contenido para las entradas de blog 

### Corrección del Sistema de Blog (Marzo 2023)
- Corrección de error en las consultas SQL del blog que utilizaban una columna inexistente "fecha" en lugar de "creado"
- Actualización de las propiedades y constructor de la clase BlogEntry para reflejar correctamente la estructura de la base de datos
- Actualización del esquema SQL de las tablas del blog para incluir el campo "destacado"
- Implementación completa de la funcionalidad de creación de entradas en el panel de administración
- Eliminación de mensajes "en desarrollo" y "próximamente" en la sección del blog
- Actualización de la documentación técnica para reflejar la estructura correcta de la base de datos del blog

### Implementación de las Vistas del Blog (Marzo 2023)
- Corrección de la visualización de entradas en la página principal de administración de blog
- Implementación de la vista para mostrar las entradas del blog en la página principal del sitio
- Mejora en la gestión de imágenes para las entradas del blog con soporte para la biblioteca Intervention Image
- Implementación de funcionalidad para destacar entradas en la página principal 