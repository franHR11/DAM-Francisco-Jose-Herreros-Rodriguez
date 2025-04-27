-- Estructura para la tabla blog_categories
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT,
  UNIQUE KEY `nombre_unique` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Estructura para la tabla blog_entries
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

-- Insertar algunas categorías de ejemplo
INSERT INTO `blog_categories` (`nombre`, `descripcion`) VALUES
('Consejos', 'Consejos sobre bienes raíces y gestión de propiedades'),
('Mercado Inmobiliario', 'Noticias y tendencias del mercado inmobiliario'),
('Decoración', 'Ideas para decorar y mejorar tus espacios'),
('Inversiones', 'Consejos y estrategias para inversiones inmobiliarias');

-- Nota: Para ejecutar este script, importarlo desde phpMyAdmin o ejecutarlo con MySQL CLI
-- mysql -u usuario -p nombre_de_base_de_datos < blog_tables.sql 