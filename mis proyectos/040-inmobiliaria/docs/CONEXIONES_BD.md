# CONEXIONES A BASE DE DATOS

## Configuración de Conexión

La conexión a la base de datos se establece en el archivo `includes/config/database.php` mediante la función `conectarDB()`:

```php
function conectarDB(){
    $db = new mysqli("localhost", "franhr", "franhr", "proyectoinmobiliaria");
    if(!$db){
        echo "Error no se pudo conectar a la Base de Datos";
        exit;
    }
    return $db;
}
```

## Estructura de la Base de Datos

### Tabla: propiedades

Almacena la información de las propiedades inmobiliarias.

| Campo          | Tipo         | Descripción                               |
|----------------|--------------|-------------------------------------------|
| id             | INT          | Identificador único (clave primaria)      |
| titulo         | VARCHAR(100) | Título de la propiedad                    |
| precio         | DECIMAL(10,2)| Precio de la propiedad                    |
| imagen         | VARCHAR(200) | Nombre del archivo de imagen              |
| descripcion    | LONGTEXT     | Descripción detallada de la propiedad     |
| habitaciones   | INT          | Número de habitaciones                    |
| wc             | INT          | Número de baños                           |
| estacionamiento| INT          | Número de plazas de estacionamiento       |
| creado         | DATE         | Fecha de creación del registro            |
| vendedorId     | INT          | ID del vendedor (clave foránea)           |

### Tabla: vendedores

Almacena la información de los vendedores.

| Campo          | Tipo         | Descripción                               |
|----------------|--------------|-------------------------------------------|
| id             | INT          | Identificador único (clave primaria)      |
| nombre         | VARCHAR(100) | Nombre del vendedor                       |
| apellido       | VARCHAR(100) | Apellido del vendedor                     |
| telefono       | VARCHAR(15)  | Teléfono de contacto                      |

### Tabla: usuarios

Almacena los usuarios para acceso al panel de administración.

| Campo          | Tipo         | Descripción                               |
|----------------|--------------|-------------------------------------------|
| id             | INT          | Identificador único (clave primaria)      |
| email          | VARCHAR(100) | Email/usuario para login                  |
| password       | CHAR(60)     | Contraseña hasheada                       |

## Tablas del Blog

### blog_categories
```sql
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT,
  UNIQUE KEY `nombre_unique` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

- `id`: Identificador único de la categoría
- `nombre`: Nombre de la categoría (único)
- `descripcion`: Descripción opcional de la categoría

### blog_entries
```sql
CREATE TABLE IF NOT EXISTS `blog_entries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(200) NOT NULL,
  `imagen` VARCHAR(200) NOT NULL,
  `contenido` TEXT NOT NULL,
  `extracto` VARCHAR(250),
  `categoria_id` INT,
  `destacado` TINYINT(1) NOT NULL DEFAULT 0,
  `creado` DATE NOT NULL,
  `autor_id` INT,
  FOREIGN KEY (`categoria_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

- `id`: Identificador único de la entrada
- `titulo`: Título de la entrada
- `imagen`: Ruta a la imagen principal
- `contenido`: Contenido completo en HTML
- `extracto`: Extracto opcional para mostrar en listados
- `categoria_id`: Clave foránea a la categoría
- `destacado`: Indica si la entrada debe destacarse (0 o 1)
- `creado`: Fecha de creación
- `autor_id`: Clave foránea al autor (si existe)

### Consultas principales

Obtener todas las entradas ordenadas por fecha:
```sql
SELECT * FROM blog_entries ORDER BY creado DESC
```

Obtener entradas por categoría:
```sql
SELECT * FROM blog_entries WHERE categoria_id = {id_categoria} ORDER BY creado DESC
```

Obtener entradas destacadas:
```sql
SELECT * FROM blog_entries WHERE destacado = '1' ORDER BY creado DESC LIMIT 3
```

Buscar entradas por texto:
```sql
SELECT * FROM blog_entries WHERE titulo LIKE '%{termino}%' OR contenido LIKE '%{termino}%' ORDER BY creado DESC
```

## Consultas SQL Importantes

### Propiedades

#### Consulta: Obtener todas las propiedades

```sql
SELECT * FROM propiedades;
```

Esta consulta se utiliza en la clase Propiedad, método `all()` para listar todas las propiedades.

#### Consulta: Insertar nueva propiedad

```sql
INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
```

Implementada en la clase Propiedad, método `guardar()`.

#### Consulta: Actualizar propiedad existente

```sql
UPDATE propiedades SET titulo = ?, precio = ?, imagen = ?, descripcion = ?, 
habitaciones = ?, wc = ?, estacionamiento = ?, vendedorId = ? 
WHERE id = ?;
```

#### Consulta: Eliminar propiedad

```sql
DELETE FROM propiedades WHERE id = ?;
```

#### Consulta: Obtener propiedades limitadas (para página de inicio)

```sql
SELECT * FROM propiedades LIMIT 3;
```

#### Consulta: Obtener propiedad específica

```sql
SELECT * FROM propiedades WHERE id = ?;
```

### Vendedores

#### Consulta: Obtener todos los vendedores

```sql
SELECT * FROM vendedores;
```

Esta consulta se utiliza en la clase Vendedor, método `all()` para listar todos los vendedores.

#### Consulta: Insertar nuevo vendedor

```sql
INSERT INTO vendedores (nombre, apellido, telefono) 
VALUES (?, ?, ?);
```

Implementada en la clase Vendedor, método `guardar()`.

#### Consulta: Actualizar vendedor existente

```sql
UPDATE vendedores SET nombre = ?, apellido = ?, telefono = ? 
WHERE id = ? LIMIT 1;
```

Implementada en la clase Vendedor, método `actualizar()`.

#### Consulta: Eliminar vendedor

```sql
DELETE FROM vendedores WHERE id = ? LIMIT 1;
```

Implementada en la clase Vendedor, método `eliminar()`.

#### Consulta: Obtener vendedor específico

```sql
SELECT * FROM vendedores WHERE id = ?;
```

Esta consulta se utiliza en la clase Vendedor, método `find()` para obtener un vendedor específico.

## Modelo de Datos

El sistema utiliza las siguientes clases para interactuar con la base de datos:

### Clase Propiedad

Ubicada en el namespace `App`, implementa métodos para:

- Crear nuevas propiedades
- Leer propiedades existentes
- Actualizar propiedades
- Eliminar propiedades
- Validar datos antes de guardar

### Clase Vendedor

Ubicada en el namespace `App`, implementa métodos para:

- Crear nuevos vendedores
- Leer vendedores existentes
- Actualizar vendedores
- Eliminar vendedores
- Validar datos antes de guardar

La conexión a la base de datos se establece mediante el método estático `setDB()` que recibe la conexión y la almacena en una propiedad estática para su uso en los métodos de la clase. 