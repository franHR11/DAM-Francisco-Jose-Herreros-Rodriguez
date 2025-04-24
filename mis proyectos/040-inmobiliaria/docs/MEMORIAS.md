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

### Corrección de Errores de Compilación SASS (Abril 2025)
- Identificación del error `Can't find stylesheet to import` causado por el uso incorrecto de `@forward` en `src/scss/app.scss`.
- Corrección de `src/scss/app.scss` para utilizar la directiva `@use` en lugar de `@forward`, siguiendo la estructura existente del proyecto.
- Se verificó que el archivo `src/scss/admin/_categorias.scss` utiliza la función `darken()`, pero se determinó que no era la causa principal del error de compilación. Se decidió mantenerla por el momento y corregirla solo si genera problemas específicos.
- Se aseguró que la importación de `admin/categorias` se realizara correctamente en `app.scss` para aplicar los estilos del panel de administración de categorías.

### Corrección de Errores de Variables y Deprecación SASS (Abril 2025)
- Se identificó un error `Undefined variable` para `v.$grisClaro` en `_categorias.scss`, a pesar de la importación correcta.
- La causa fue una importación duplicada de `@use 'base/variables' as v;` al final de `app.scss`, la cual fue eliminada.
- Se abordaron las advertencias de funciones deprecadas (`darken`) en `_categorias.scss`.
- Se añadió `@use 'sass:color';` al inicio de `_categorias.scss`.
- Se reemplazó `darken(v.$grisClaro, 10%)` con la alternativa moderna `color.adjust(v.$grisClaro, $lightness: -10%)`.

### Depuración de Error `Undefined variable` en SASS (Abril 2025)
- A pesar de las correcciones anteriores, el error `Undefined variable` para `variables.$grisClaro` persistió en `_categorias.scss`.
- Como paso de depuración, se modificó `_categorias.scss` para usar los namespaces por defecto de SASS en lugar de alias.
- Se cambiaron las importaciones a `@use '../base/variables';` y `@use '../base/mixins';`.
- Todas las referencias a `v.$variable` y `m.mixin()` fueron actualizadas a `variables.$variable` y `mixins.mixin()` respectivamente.
- El objetivo es descartar si el problema está relacionado con el manejo de alias (`as v`, `as m`) por parte del compilador SASS en este contexto.

### Corrección Definitiva de Error `Undefined variable` en SASS (Abril 2025)
- Se descubrió que la causa raíz del error `Undefined variable: variables.$grisClaro` no estaba relacionada con la importación o los alias, sino que la variable `$grisClaro` simplemente **no existía** en `src/scss/base/_variables.scss`.
- El archivo `_variables.scss` define `$gris: #e1e1e1;` pero no `$grisClaro`.
- Se corrigió `src/scss/admin/_categorias.scss` reemplazando todas las instancias de la variable inexistente `variables.$grisClaro` con la variable correcta `variables.$gris`.
- Esto resolvió finalmente el error de compilación.

### Mejora de Estilos para Tarjetas de Categorías (Abril 2025)
- Se aplicaron mejoras visuales al archivo `src/scss/admin/_categorias.scss` para las tarjetas de categorías en el panel de administración.
- **Título:** Se aumentó el `font-weight` a `bold` para mayor jerarquía.
- **Contador de Entradas:** Se incrementó el `font-size` a `2rem` y el `font-weight` a `black` para destacarlo.
- **Efecto Hover:** Se hizo la sombra (`box-shadow`) más pronunciada al pasar el ratón sobre la tarjeta.
- **Footer:** Se cambió el fondo a blanco (`variables.$blanco`) y se simplificó el `border-top`.
- **Botones:** Se añadió una transición y un efecto `hover` (`filter: brightness(90%)`) para mejorar la interactividad.

### Corrección de Menú Faltante en Secciones del Blog (Abril 2025)
- Se detectó que la barra de navegación del administrador (`admin-navbar`) no aparecía en las páginas de "Blog - Ver todas las entradas" (`admin/blog/ver-todas/index.php`) ni en "Blog - Gestión de Categorías" (`admin/blog/categorias/index.php`).
- La causa era que estos archivos PHP no incluían la plantilla `includes/templates/admin-menu.php`, que es la que contiene el HTML de la barra de navegación.
- Se corrigieron ambos archivos añadiendo la línea `incluirTemplate('admin-menu');` después de la línea `incluirTemplate('header');`.
- Esto aseguró que el menú de administración se muestre consistentemente en todas las secciones del panel.

### Creación de Funcionalidad para Actualizar Categorías de Blog (Abril 2025)
- Se detectó un error 404 al intentar acceder a la edición de categorías de blog (`/admin/blog/categorias/actualizar.php`).
- La causa era que el archivo `actualizar.php` no existía en ese directorio. Existía un directorio vacío llamado `actualizar/`.
- Se creó el archivo `admin/blog/categorias/actualizar.php` basándose en la lógica de actualización de otras entidades, usando la clase `App\BlogCategory`.
- Se corrigió un error inicial relacionado con el método `sincronizar()` (que no existe en `BlogCategory`), asignando los valores POST directamente al objeto.
- Se creó el archivo `admin/blog/categorias/formulario.php` con los campos `nombre` y `descripcion`, asegurando que use el objeto `$categoria` para mostrar los valores.
- Se intentó eliminar el directorio vacío `admin/blog/categorias/actualizar/`, pero la herramienta no lo encontró (posiblemente ya no existía).

### Implementación de Sección de Configuración del Sitio (Abril 2025)
- Se creó una nueva sección en el panel de administración (`/admin/configuracion/`) para gestionar configuraciones globales del sitio.
- **Base de Datos:** Se añadió la tabla `site_config` con una única fila (id=1) para almacenar `site_name`, `meta_description`, `logo_filename`, `header_image_filename`. Se actualizó `docs/CONEXIONES_BD.md`.
- **Backend:** 
    - Se creó la clase `App\SiteConfig` (heredando de `ActiveRecord`) con validaciones y métodos básicos.
    - Se creó el controlador `admin/configuracion/index.php` para cargar/guardar la configuración y manejar la subida de imágenes (logo y cabecera) usando Intervention Image. Se definió la constante `CARPETA_IMAGENES_CONFIG`.
    - Se creó el formulario `admin/configuracion/formulario.php`.
- **Frontend Admin:** Se añadió el enlace "Configuración" a `includes/templates/admin-menu.php`.
- **Integración Frontend:**
    - En `includes/templates/header.php`, se cargan los datos de `SiteConfig`. Se usan `site_name` y `meta_description` en las etiquetas `<title>` y `<meta name="description">`.
    - El logo (`<img>`) ahora carga dinámicamente desde `logo_filename` (con fallback a `logo.svg`).
    - Se define una variable CSS `--header-bg-image` con la ruta de `header_image_filename` solo en la página de inicio.
- **CSS:** Se modificó `src/scss/layout/_header.scss` para que `.header.inicio` use la variable `--header-bg-image` con una imagen de fallback.

### Corrección de Errores en ActiveRecord y Carga de Configuración (Abril 2025)
- Se detectaron advertencias `Deprecated: Using ${var}` en `classes/ActiveRecord.php`.
    - **Causa:** Uso de sintaxis obsoleta para interpolación de strings.
    - **Solución:** Se reemplazaron todas las instancias de `${var}` por `{$var}` en los métodos `limit`, `find`, `where`, y `buscar`.
- Se detectó un error `Fatal error: Call to a member function query() on null` en `ActiveRecord::consultarSQL` al intentar cargar la configuración (`SiteConfig::find(1)`) desde `header.php`.
    - **Causa:** La conexión a la base de datos (`$db`) no se estaba estableciendo en la clase base `ActiveRecord` mediante `ActiveRecord::setDB($db)`. Solo se establecía en clases hijas específicas.
    - **Solución:** Se modificó `includes/app.php` para añadir `use App\ActiveRecord;` y llamar a `ActiveRecord::setDB($db)` inmediatamente después de conectar a la base de datos. Se eliminaron las llamadas redundantes a `setDB()` en las clases hijas.

### Corrección de Error Fatal en BlogEntry (Abril 2025)
- Se detectó un error `Fatal error: Call to a member function query() on null` en `classes/BlogEntry.php` al intentar cargar entradas destacadas en `index.php`.
- **Causa:** Similar al error anterior, la conexión `$db` era `null` dentro de `BlogEntry`. Se descubrió que `BlogEntry` **no** hereda de `ActiveRecord`, por lo que no recibía la conexión establecida en la clase base.
- **Solución:** Se modificó `includes/app.php` para descomentar la línea `BlogEntry::setDB($db);`, asegurando que la conexión se pase explícitamente a esta clase independiente.

### Corrección de Error Fatal `Call to undefined function s()` (Abril 2025)
- Después de las correcciones anteriores, apareció una página en blanco. Los logs de PHP revelaron el error `Fatal error: Call to undefined function s()` en `includes/templates/header.php`.
- **Causa:** Se intentaba usar una función `s()` para sanitizar HTML, pero esta función no estaba definida. Existía una función similar llamada `sanitizar()` en `includes/funciones.php`.
- **Solución:** Se reemplazaron todas las llamadas a `s()` por `sanitizar()` en los archivos afectados (`includes/templates/header.php`, `admin/configuracion/formulario.php`, `admin/blog/categorias/formulario.php`).

### Corrección de Error Fatal en Propiedad (Abril 2025)
- Se detectó un error `Fatal error: Call to a member function query() on null` en `classes/propiedad.php` al intentar cargar propiedades en `admin/index.php`.
- **Causa:** A pesar de establecer la conexión en `ActiveRecord::setDB($db)`, las clases hijas como `Propiedad` no la estaban heredando o utilizando correctamente. La suposición de que la herencia sería suficiente para la conexión estática `$db` fue incorrecta.
- **Solución:** Se revirtió la estrategia en `includes/app.php`. Se mantivo `ActiveRecord::setDB($db)` pero se descomentaron todas las llamadas explícitas a `Clase::setDB($db)` para cada clase (`Propiedad`, `Vendedor`, `Categoria`, `BlogEntry`, `BlogCategory`, `SiteConfig`) para garantizar que cada una reciba la conexión independientemente de la herencia.

### Corrección de Estilos Faltantes en Admin/Configuracion (Abril 2025)
- Se reportó que la página `/admin/configuracion/index.php` se mostraba sin estilos, header ni footer.
- **Causa:** La lógica para calcular la ruta relativa (`$rutaBase`) en `includes/templates/header.php` no contemplaba la ruta `/admin/configuracion/`. Esto rompía el enlace al archivo CSS.
- **Solución:** Se modificó `includes/templates/header.php`, añadiendo la comprobación para `/admin/configuracion/` en la condición que asigna `$rutaBase = '../../';`. Se verificó que la lógica similar en `admin-menu.php` ya era correcta.

### Adición de Soporte para SVG en Configuración (Abril 2025)
- Se solicitó permitir la subida de archivos SVG para el logo y la imagen de cabecera en `/admin/configuracion/`.
- **Problema:** La lógica existente usaba Intervention Image, que no procesa SVG.
- **Solución:**
    - Se modificó `admin/configuracion/index.php` para detectar la extensión del archivo subido.
    - Si es `.svg`, se genera un nombre único `.svg` y se usa `move_uploaded_file()` para guardar el archivo original sin procesar.
    - Si es raster (JPG, PNG, GIF), se mantiene la lógica de procesar con Intervention Image y guardar como JPG.
    - Se modificó `admin/configuracion/formulario.php` para añadir `image/svg+xml` al atributo `accept` de los inputs de archivo.

### Corrección de Error SQL Syntax en `UPDATE site_config` (Abril 2025)
- Se detectó un error `Fatal error: Uncaught mysqli_sql_exception: You have an error in your SQL syntax; check the manual ... near 'WHERE id = '1' LIMIT 1'` al guardar la configuración.
- **Causa:** La consulta `UPDATE` generada por el método `actualizar()` (llamado por `guardar()`) tenía la cláusula `SET` vacía. Esto probablemente se debía a que la sobrescritura del método `guardar()` que habíamos añadido en `SiteConfig.php` era innecesaria y/o interfería con la lógica heredada de `ActiveRecord` (que sí tiene métodos `guardar` y `actualizar` funcionales).
- **Solución:** Se eliminó la sobrescritura del método `guardar()` en `classes/SiteConfig.php`, permitiendo que utilice el método `guardar()` heredado de `ActiveRecord`.

### Corrección de Error Fatal `Class "Intervention\Image\ImageManagerStatic" not found` (Abril 2025)
- Al intentar guardar la configuración con una imagen raster (JPG/PNG), se produjo el error `Fatal error: Class Intervention\Image\ImageManagerStatic not found`.
- **Causa:** La librería `intervention/image`, necesaria para procesar las imágenes rasterizadas en `admin/configuracion/index.php`, no estaba instalada en el proyecto.
- **Solución:** Se instaló la librería ejecutando `composer require intervention/image` en la terminal del proyecto.

## [17/05/2024] Corrección del guardado de contenido HTML en entradas de blog

### Problema detectado
Al implementar el editor SunEditor para el blog, se encontró que el contenido HTML generado no se estaba guardando correctamente en la base de datos al crear o editar entradas de blog. Mientras que el editor funcionaba visualmente, al enviar el formulario el contenido no se transfiere al elemento `textarea` antes del envío.

### Causa
El problema se debía a que el evento `submit` del formulario se procesaba antes de que el contenido del editor SunEditor se pudiera transferir al campo `textarea` que es el que realmente se envía al servidor. En particular, para el editor de blog (campo `contenido`), el proceso de transferencia no estaba siendo completado a tiempo.

### Solución implementada
1. Se modificó el archivo `build/js/suneditor-config.js` para mejorar el manejo del evento `submit` en los formularios:
   - Para el campo de blog, se previene temporalmente el envío automático del formulario con `e.preventDefault()`
   - Se transfiere explícitamente el contenido del editor al campo `textarea` usando `editor.getContents()`
   - Se implementa un pequeño retraso (100ms) mediante `setTimeout()` antes de enviar el formulario manualmente, asegurando que el contenido HTML se haya transferido correctamente
   - Se añadieron mensajes de depuración en la consola para verificar que el contenido se está transfiriendo correctamente

2. Estas modificaciones aseguran que:
   - El contenido HTML completo se guarde correctamente en la base de datos
   - No se pierda el formato aplicado en el editor (negritas, listas, enlaces, etc.)
   - La experiencia de usuario no se vea afectada durante el proceso

### Beneficios
- Funcionamiento completo del editor SunEditor en las entradas de blog
- Preservación del contenido formateado en HTML al guardar o actualizar entradas
- Mayor fiabilidad en la transferencia de datos entre el editor y el servidor
- Mejora en la experiencia de creación de contenido para los administradores del sitio

Esta corrección complementa la implementación inicial del editor SunEditor, asegurando que funcione correctamente tanto en propiedades como en entradas de blog.

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

### [26/06/2024] - Lógica mejorada para mostrar propiedades en la página principal

**Problema:**  
La sección "Casas y Departamentos en Venta" de la página principal solo mostraba hasta 6 propiedades destacadas. Si había menos de 6, el espacio no se aprovechaba.

**Cambios realizados:**
1. Se añadió un nuevo método estático `getRecientesNoDestacados(\$limite, \$exclude_ids = [])` a la clase `Propiedad` (`classes/Propiedad.php`). Este método recupera las propiedades más recientes que no están marcadas como destacadas y permite excluir un conjunto de IDs.
2. Se modificó la lógica en `index.php`:\n   - Primero se obtienen hasta 6 propiedades destacadas (`getDestacados`).\n   - Si el número de destacadas es menor a 6, se calcula cuántas faltan.\n   - Se llama al nuevo método `getRecientesNoDestacados` para obtener las propiedades recientes no destacadas necesarias para completar el total de 6, asegurándose de excluir las IDs de las destacadas ya obtenidas.\n   - Se combinan ambos conjuntos de propiedades usando `array_merge()`.\n   - El grid siempre se renderiza con el array final, que contiene una mezcla de destacadas y recientes hasta un máximo de 6.

**Resultado:**  \nLa sección de propiedades en la página principal ahora siempre muestra 6 anuncios. Se da prioridad a las propiedades marcadas como destacadas, y si hay menos de 6, el espacio se completa automáticamente con las propiedades añadidas más recientemente, optimizando la visibilidad y el uso del espacio en la página de inicio.

### [26/06/2024] - Corrección de estilos para los iconos de características en la página principal

**Problema:**  
Después de implementar el grid de 3x2 para las propiedades destacadas en la página principal, se identificó que los iconos de características (baños, estacionamiento, habitaciones) no se mostraban correctamente. Esto ocurría porque en el template original `includes/templates/anuncios.php` se usaba la clase `anuncios` mientras que en la nueva implementación directa en `index.php` se utilizaba la clase `anuncio` (singular).

**Cambios realizados:**
1. Se modificó el `index.php` para utilizar la clase correcta `anuncios` en lugar de `anuncio`, manteniendo consistencia con el template original.
2. Se actualizaron los estilos en `src/scss/layout/_anuncios.scss` para:
   - Aplicar los mismos estilos a `.anuncio` y `.anuncios` (usando la sintaxis `.anuncio, .anuncios { ... }`)
   - Asegurar que los ajustes específicos para las tarjetas en la página principal aplican a ambas clases
   - Mantener las características de diseño responsivo y visualización compacta

**Resultado:**  
Los iconos de características ahora se muestran correctamente en la página principal, con el mismo estilo y espaciado que en otras secciones del sitio. Se ha mantenido la estructura de 3 columnas y 2 filas para las propiedades destacadas, pero con una visualización consistente y correcta de todos los elementos. 

### [26/06/2024] - Ajuste final de estilos para iconos en propiedades destacadas

**Problema:**  
A pesar de las correcciones anteriores, los iconos de características (`.iconos-caracteristicas`) en la sección de propiedades destacadas de la página principal seguían presentando problemas de alineación o desbordamiento intermitentes.

**Cambios realizados:**
1. Se identificó que el problema persistía debido a las dimensiones fijas de las imágenes de los iconos (`width: 3rem`, `height: 3rem`, `margin-right: 1rem`) que no se adaptaban bien al espacio más compacto de las tarjetas en `.contenedor-anuncios-destacados`.
2. Se aplicó un ajuste específico en `src/scss/layout/_anuncios.scss` para las imágenes de los iconos *solo* dentro del contenedor destacado:
   - Se redujo el `width` y `height` a `2.5rem`.
   - Se redujo el `margin-right` a `0.5rem`.
   - Se ajustó el `flex-basis` a `2.5rem`.

**Resultado:**  
Los iconos de características ahora se muestran correctamente y de forma estable en las propiedades destacadas de la página principal. El ajuste fino del tamaño y margen de los iconos en este contexto específico resolvió el conflicto de layout, asegurando una visualización consistente y estéticamente agradable. 

### [26/06/2024] - Solución final al corte de iconos de características

**Problema:**  
Los iconos de características (`.iconos-caracteristicas > li > img`) se veían ligeramente cortados en los bordes superior/inferior y/o laterales, tanto en la sección de destacados como en la vista general de anuncios, a pesar de los intentos previos de añadir padding o ajustar tamaños.

**Diagnóstico:**  
Tras inspeccionar los elementos, se observó que el `height` calculado del `li` y el `padding` interactuaban de forma imprecisa con el `align-items: center` y el tamaño fijo de la imagen, causando problemas de renderizado de subpíxeles o espacio insuficiente.

**Cambios realizados:**
1. Se adoptó un enfoque diferente en `src/scss/layout/_anuncios.scss` para el estilo general de `.iconos-caracteristicas`:
   - Se eliminó el `padding` de los elementos `li`.
   - Se añadió `object-fit: contain;` a las imágenes (`img`) para asegurar que se escalen correctamente dentro de su contenedor.
   - Se estableció explícitamente `line-height: 1;` en los párrafos (`p`) para minimizar su altura vertical y tener un control más predecible.
   - Se mantuvo el `align-items: center;` en los `li` para el centrado vertical.
2. Se conservaron los ajustes específicos de tamaño (`width`, `height`, `margin-right`, `flex`) para `img` y `font-size` para `p` dentro de `.contenedor-anuncios-destacados` para mantener la compacidad visual en la página principal.

**Resultado:**  
El problema del corte de los iconos se ha resuelto de forma definitiva. Al eliminar la dependencia del `padding` para el espaciado vertical y controlar explícitamente las alturas y el ajuste de la imagen, se logra una alineación y visualización correcta y estable en todos los contextos. 

### [18/05/2024] - Mejora del menú de categorías en el blog

**Problema:**  
El menú de categorías en la página de blog (`blog.php`) carecía de estilos adecuados debido a una inconsistencia entre el nombre de la clase utilizada en el HTML (`categorias-blog`) y la definida en el archivo SCSS (`categorias`).

**Cambios realizados:**
1. Se modificó el archivo `src/scss/internas/_blog.scss` para usar la clase correcta `.categorias-blog` en lugar de `.categorias`.
2. Se mejoró significativamente el diseño visual del menú con las siguientes características:
   - Título de sección "Categorías" con mayor presencia (color verde, borde inferior, tamaño de fuente mejorado)
   - Botones con bordes redondeados y sombras ligeras para efecto de elevación
   - Efecto de animación al pasar el cursor: elevación suave y flecha de indicación visual
   - Transición de color con fondo verde al hacer hover, mejorando la experiencia interactiva
   - Espaciado optimizado entre elementos para mejor legibilidad

**Resultado:**  
El menú de categorías del blog ahora tiene una apariencia moderna y atractiva, con animaciones suaves que mejoran la experiencia del usuario e invitan a la interacción. La consistencia visual con el resto del sitio se mantiene mediante el uso de la paleta de colores principal y los estilos generales de la aplicación. 

### [19/05/2024] - Mejora del diseño de filtros en anuncios.php

**Problema:**  
La sección de filtros en la página de anuncios (`anuncios.php`) presentaba un diseño en columnas que no optimizaba el espacio en dispositivos móviles y dificultaba la visualización en algunos dispositivos.

**Cambios realizados:**
1. Se modificó el archivo `src/scss/layout/_anuncios.scss` para convertir el diseño de los filtros de búsqueda de columnas a filas:
   - Se reemplazó el grid de columnas por un contenedor flex con dirección de columna.
   - Se limitó el ancho del formulario de búsqueda en pantallas grandes para mejorar la legibilidad.
   - Se centró el formulario en pantallas grandes para una apariencia más equilibrada.
   
2. Se mejoró el diseño visual de la sección de categorías:
   - Se actualizó el título "Categorías" con estilos más prominentes (color verde, borde inferior, centrado).
   - Se implementó un diseño flexible para las categorías que se adapta a diferentes tamaños de pantalla.
   - Se dispusieron las categorías en filas horizontales flexibles, permitiendo un mejor uso del espacio disponible.
   - Se añadieron márgenes y espaciados optimizados usando la propiedad gap.

**Resultado:**  
La sección de filtros de búsqueda en `anuncios.php` ahora presenta un diseño más limpio y responsivo, con el buscador en una fila y las categorías distribuidas uniformemente en otra fila debajo. Esta organización mejora la experiencia del usuario en dispositivos móviles y aprovecha mejor el espacio en pantallas grandes, manteniendo la coherencia visual con el resto del sitio. 

### [19/05/2024] - Añadir información de empresa a la configuración y footer

**Problema:**  
No existía una sección para gestionar la información básica de la empresa (nombre, dirección, horario) ni se mostraba esta información en el footer del sitio. Inicialmente, estos campos se hicieron obligatorios.

**Cambios realizados:**
1.  **Base de Datos:** Se añadieron las columnas `company_name`, `address`, `city`, `zip_code`, `opening_hours`, `closing_hours` a la tabla `site_config`.
2.  **Clase `SiteConfig`:**
    *   Se añadieron las propiedades correspondientes en `classes/SiteConfig.php`.
    *   Se actualizó `$columnasDB` para incluir las nuevas columnas.
    *   Se eliminaron las validaciones básicas que hacían obligatorios los campos de la empresa en el método `validar()`. **Los campos de empresa son ahora opcionales**.
3.  **Formulario de Configuración:** Se añadió un nuevo `fieldset` en `admin/configuracion/formulario.php` con campos para editar la información de la empresa.
4.  **Footer:**
    *   Se modificó `includes/templates/footer.php` para cargar la configuración del sitio (`SiteConfig::find(1)`) si no estaba ya disponible.
    *   Se añadió una nueva sección (`div.info-empresa`) para mostrar los datos de la empresa (nombre, dirección, ciudad, CP, horario) en el footer.
5.  **Estilos CSS:**
    *   Se añadieron estilos en `src/scss/layout/_footer.scss` para el nuevo `div.info-empresa`.
    *   Se ajustaron los estilos del `.contenedor-footer` para usar `flexbox`, permitiendo que la navegación y la información de la empresa se muestren en columnas en pantallas de tablet y escritorio, y en filas en móvil.
    *   Se compiló el archivo CSS (`npx gulp css`).
6.  **Persistencia de Datos:** Se modificó `admin/configuracion/index.php` para usar `$config->sincronizar($_POST)` antes de llamar a `$config->validar()`. Esto asegura que si hay un error de validación (p. ej., el campo obligatorio "Nombre del Sitio" está vacío), los datos ya introducidos en los campos opcionales de la empresa se mantengan visibles en el formulario.
7.  **Documentación:** Se actualizaron `docs/CONEXIONES_BD.md` y `docs/MEMORIAS.md` para reflejar estos cambios.

**Resultado:**  
Ahora es posible gestionar la información básica de la empresa desde el panel de administración (`/admin/configuracion/`). Esta información es opcional y se muestra de forma clara y estructurada en el footer del sitio si se proporciona. Los datos introducidos se conservan en el formulario en caso de errores de validación en otros campos. 

### [19/05/2024] - Reorganización del Footer en dos columnas

**Problema:**  
La información de la empresa en el footer se mostraba en una sola columna, lo que podía ocupar mucho espacio vertical en pantallas grandes.

**Cambios realizados:**
1.  **HTML:** Se modificó `includes/templates/footer.php`, dividiendo el contenido de `div.info-empresa` en dos `div`s: `div.columna-datos` (Nombre, Dirección, Ciudad, CP) y `div.columna-horario` (Horario).
2.  **CSS:** Se actualizaron los estilos en `src/scss/layout/_footer.scss`:
    *   Se aplicó `display: flex` a `div.info-empresa`.
    *   En pantallas de tablet y superiores, se estableció `flex-direction: row` para colocar las columnas una al lado de la otra, alineadas a la derecha (`justify-content: flex-end`) y con espacio (`gap`) entre ellas.
    *   En pantallas móviles, se mantuvo `flex-direction: column` para apilar la información.
    *   Se ajustaron los estilos de los títulos (`h4`, `h5`) y párrafos dentro de las columnas para una mejor presentación.
3.  **Compilación:** Se compiló el CSS (`npx gulp css`).

**Resultado:**  
En pantallas grandes (tablet y escritorio), la información de la empresa en el footer ahora se muestra en dos columnas (datos a la izquierda, horario a la derecha), optimizando el espacio y mejorando la legibilidad. En pantallas móviles, la información se apila verticalmente como antes. 

### [30/05/2024] - Implementación del Sistema de Mensajes de Contacto

**Problema:**  
El formulario de contacto no procesaba los datos enviados ni existía un sistema para gestionar los mensajes recibidos desde el panel de administración.

**Cambios realizados:**
1. **Base de Datos:**
   * Creación de la tabla `mensajes_contacto` para almacenar todos los mensajes del formulario de contacto.
   * Implementación de campos para tipo de operación (compra/vende), preferencia de contacto y seguimiento.
2. **Frontend:**
   * Corrección del formulario de contacto (`contacto.php`) añadiendo atributos `method="POST"`, `action` y `name` a todos los campos.
   * Implementación de persistencia de datos y validación en el formulario.
   * Adición de JavaScript para mostrar/ocultar campos de fecha/hora según preferencia de contacto.
3. **Backend:**
   * Creación de la clase `App\Contacto` extendiendo `ActiveRecord` para gestionar los mensajes.
   * Implementación de métodos específicos como `mensajesNoLeidos()` y `marcarComoLeido()`.
4. **Panel de Administración:**
   * Creación de nueva sección "Mensajes" en el menú de administración con contador de mensajes no leídos.
   * Implementación de listado paginado de mensajes con indicador visual de mensajes no leídos.
   * Pantalla de detalle para ver y gestionar cada mensaje.
   * Funcionalidad para marcar mensajes como leídos y eliminarlos.
5. **Estilos:**
   * Estilos específicos para los mensajes en el panel de administración.
   * Indicador visual (badge) para mostrar el número de mensajes no leídos.
   * Diseño responsivo para la visualización de mensajes.

**Resultado:**  
La implementación permite a los usuarios enviar mensajes a través del formulario de contacto y al administrador gestionar estos mensajes desde el panel de administración. El sistema proporciona información clara sobre el estado de los mensajes (leídos/no leídos) y permite responder directamente por email o teléfono según la preferencia indicada por el usuario.

### [31/05/2024] - Corrección de alineación de botones en las tarjetas de anuncios

**Problema:**  
En las tarjetas de anuncios tanto en la página principal (`index.php`) como en la página de anuncios (`anuncios.php`), los botones "Ver Propiedad" aparecían a diferentes alturas dependiendo de la longitud del título o descripción de cada propiedad, lo que causaba un efecto visual inconsistente.

**Cambios realizados:**
1. Se modificó el archivo `src/scss/layout/_anuncios.scss` para implementar una estructura flexbox que garantiza la uniformidad de la altura de las tarjetas:
   - Se aplicó `display: flex` y `flex-direction: column` a las tarjetas (`.anuncio, .anuncios`) para crear un contenedor flexible.
   - Se estableció `height: 100%` para asegurar que todas las tarjetas tengan la misma altura dentro del grid.
   - Se convirtió `.contenido-anuncio` en un contenedor flex con `flex-grow: 1` para que ocupe todo el espacio disponible.
   - Se añadió `min-height: 3.5rem` al título (`h3`) para proporcionar un espacio consistente.
   - Se aplicó `margin-top: auto` al botón `.boton-amarillo-block` para asegurar que siempre se posicione al final del contenedor.

**Resultado:**  
Las tarjetas de anuncios ahora presentan una apariencia uniforme con todos los botones "Ver Propiedad" alineados a la misma altura, independientemente de la longitud del título o la descripción. Esta mejora proporciona una experiencia visual más coherente y profesional, sin necesidad de truncar los títulos o descripciones de las propiedades.

### [31/05/2024] - Mejora en la alineación de elementos en tarjetas de anuncios

**Problema:**  
Aunque los botones "Ver Propiedad" se alinearon correctamente al final de las tarjetas de anuncios, los precios y los iconos de características (baños, estacionamientos, habitaciones) no mantenían una posición uniforme, apareciendo a diferentes alturas dependiendo de la longitud del contenido de cada tarjeta.

**Cambios realizados:**
1. Se perfeccionó la estructura flexbox en `src/scss/layout/_anuncios.scss` para garantizar que todos los elementos tengan una posición consistente:
   - Se asignó `flex-grow: 1` a la descripción para que ocupe todo el espacio disponible y empuje el resto de elementos hacia abajo.
   - Se utilizó la propiedad `order` para determinar el orden de apilamiento de los elementos dentro del contenedor flex:
     - `.precio` con `order: 1` para que aparezca primero en la parte inferior
     - `.iconos-caracteristicas` con `order: 2` para colocarlo después del precio
     - `.boton-amarillo-block` con `order: 3` para que siempre sea el último elemento
   - Se agregó `margin-top: auto` al precio para empujarlo hasta el final del espacio disponible.
   - Se definieron márgenes específicos entre estos elementos para un espaciado consistente.

**Resultado:**  
Las tarjetas de anuncios ahora presentan una estructura visual completamente uniforme, donde independientemente del contenido:
1. La descripción ocupa el espacio variable necesario.
2. El precio siempre aparece en la misma posición relativa respecto al final de la tarjeta.
3. Los iconos de características se muestran consistentemente entre el precio y el botón.
4. El botón "Ver Propiedad" siempre es el último elemento, a una distancia fija de los iconos.

Esta mejora eleva significativamente la calidad visual de las tarjetas, proporcionando una experiencia de usuario más profesional y coherente en todas las páginas del sitio.