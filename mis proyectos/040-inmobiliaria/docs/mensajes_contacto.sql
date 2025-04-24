-- Estructura para la tabla mensajes_contacto
CREATE TABLE IF NOT EXISTS `mensajes_contacto` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `mensaje` TEXT NOT NULL,
  `tipo` ENUM('compra', 'vende') NOT NULL,
  `presupuesto` DECIMAL(10,2) NULL,
  `contacto_via` ENUM('telefono', 'email') NOT NULL,
  `fecha_contacto` DATE NULL,
  `hora_contacto` TIME NULL,
  `creado` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leido` TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Nota: Para ejecutar este script, importarlo desde phpMyAdmin o ejecutarlo con MySQL CLI
-- mysql -u usuario -p nombre_de_base_de_datos < mensajes_contacto.sql 