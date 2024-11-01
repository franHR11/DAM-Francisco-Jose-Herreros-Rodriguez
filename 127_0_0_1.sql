-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2024 a las 12:04:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`identificador`, `titulo`, `fecha`, `contenido`) VALUES
(1, 'primer articulo desde la base de datos', '2024-10-07', 'esta información sale de la base de datos'),
(2, 'segundo articulo desde la base de datos', '2024-10-08', 'esta información sale de la base de datos'),
(3, 'tercer articulo desde la base de datos', '2024-10-09', 'tercer articulo desde la base de datos'),
(4, 'Cuarto articulo', '2024-10-20', 'este es el contenido del cuarto articulo'),
(5, 'Cuarto articulo', '2024-10-20', 'este es el contenido del cuarto articulo'),
(6, 'Quinto articulo', '2024-10-12', 'Este es el contenido del quinto articulo'),
(7, 'fin', '2024-10-16', 'este es el ultimo articulo y final del blog'),
(8, 'fin', '2024-10-30', 'este es el ultimo articulo y final del blog');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `identificador` int(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`identificador`, `usuario`, `contrasena`) VALUES
(1, 'franHR', 'franHR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Base de datos: `empresa`
--
CREATE DATABASE IF NOT EXISTS `empresa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `empresa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Identificador` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `poblacion` varchar(255) NOT NULL,
  `fechadenacimiento` date NOT NULL,
  `pais` varchar(200) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `cp` int(255) NOT NULL,
  `comentarios` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Identificador`, `nombre`, `apellidos`, `email`, `poblacion`, `fechadenacimiento`, `pais`, `direccion`, `cp`, `comentarios`) VALUES
(1, 'Juan', 'Pérez García', 'juan.perez@gmail.com', 'Madrid', '1985-04-23', '', '', 0, ''),
(2, 'Ana', 'López Fernández', 'ana.lopez@hotmail.com', 'Barcelona', '1992-08-15', '', '', 0, ''),
(3, 'Carlos', 'Martínez Ruiz', 'carlos.martinez@yahoo.com', 'Valencia', '1988-12-05', '', '', 0, ''),
(4, 'Laura', 'Gómez Sánchez', 'laura.gomez@outlook.com', 'Sevilla', '1990-07-10', '', '', 0, ''),
(5, 'David', 'Fernández López', 'david.fernandez@correo.com', 'Bilbao', '1983-01-17', '', '', 0, ''),
(6, 'Sofía', 'García Ortega', 'sofia.garcia@gmail.com', 'Zaragoza', '1995-11-22', '', '', 0, ''),
(7, 'Miguel', 'Rodríguez Pérez', 'miguel.rodriguez@hotmail.com', 'Málaga', '1986-03-19', '', '', 0, ''),
(8, 'Elena', 'Moreno Díaz', 'elena.moreno@outlook.com', 'Murcia', '1993-09-14', '', '', 0, ''),
(9, 'Luis', 'Sánchez Torres', 'luis.sanchez@correo.com', 'Valladolid', '1991-05-28', '', '', 0, ''),
(10, 'Marta', 'Jiménez Romero', 'marta.jimenez@gmail.com', 'Granada', '1989-06-12', '', '', 0, ''),
(11, 'Pablo', 'Ruiz Castro', 'pablo.ruiz@gmail.com', 'Alicante', '1987-10-30', '', '', 0, ''),
(12, 'Sara', 'Domínguez Serrano', 'sara.dominguez@hotmail.com', 'Córdoba', '1994-04-12', '', '', 0, ''),
(13, 'Manuel', 'Ortega Morales', 'manuel.ortega@yahoo.com', 'Vigo', '1980-07-21', '', '', 0, ''),
(14, 'Lucía', 'Santos Molina', 'lucia.santos@outlook.com', 'Santander', '1996-09-05', '', '', 0, ''),
(15, 'Adrián', 'Navarro Gutiérrez', 'adrian.navarro@correo.com', 'Toledo', '1992-03-10', '', '', 0, ''),
(16, 'Carmen', 'Ramos Iglesias', 'carmen.ramos@gmail.com', 'Almería', '1990-12-22', '', '', 0, ''),
(17, 'Iván', 'Mendoza Sáez', 'ivan.mendoza@hotmail.com', 'Salamanca', '1984-11-11', '', '', 0, ''),
(18, 'Nuria', 'Vega López', 'nuria.vega@outlook.com', 'Burgos', '1991-06-18', '', '', 0, ''),
(19, 'Raúl', 'Gil Jiménez', 'raul.gil@gmail.com', 'Logroño', '1988-02-14', '', '', 0, ''),
(20, 'Patricia', 'Reyes Cruz', 'patricia.reyes@correo.com', 'Huelva', '1995-05-07', '', '', 0, ''),
(21, 'fran', 'herreros', 'fran@gmail.com', 'cardenete', '2024-02-06', '', '', 0, ''),
(22, 'german', 'tejeda', 'belmonte', 'cuenca', '2024-05-06', '', '', 0, ''),
(24, 'xus', 'machiran', 'jesus@jesus.com', 'cuenca', '2024-02-02', '', '', 0, ''),
(25, 'lucia', 'fernandez', 'lucia@lucia.com', 'cuenca', '2024-02-02', '', '', 0, ''),
(27, 'desde python', 'desde python', 'desde python', 'desde python', '2024-10-10', '', '', 0, ''),
(32, 'fran', 'herreros', 'fran@gmail.com', 'silla', '2024-02-02', 'españa', 'la calle de fran', 46460, 'esta es la  nueva entrada de fran');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(10) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `codigopostal` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `empleados_nombre` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `calle`, `codigopostal`, `pais`, `empleados_nombre`) VALUES
(1, 'calle valencia, 5', '46000', 'españa', 1),
(2, '2 calle del cliente', '45095', 'españa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` int(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `telefono`, `email`) VALUES
(1, 'Francisco Jose', 'Herreros Rodriguez', 628639354, 'franhr1113@gmail.com'),
(4, 'Francisco Jose', 'Herreros Rodriguez', 628639354, 'franhr1113@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedido`
--

CREATE TABLE `lineaspedido` (
  `identificador` int(255) NOT NULL,
  `pedidos_fecha` int(10) NOT NULL,
  `productos_nombre` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineaspedido`
--

INSERT INTO `lineaspedido` (`identificador`, `pedidos_fecha`, `productos_nombre`, `cantidad`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 2),
(3, 3, 2, 5),
(4, 3, 2, 5),
(5, 4, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `identificador` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `clientes_apellidos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`identificador`, `fecha`, `clientes_apellidos`) VALUES
(1, '2024-09-25', 1),
(2, '2024-10-05', 21),
(3, '2024-10-16', 2),
(4, '2024-10-09', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`identificador`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'pepinos', 'pepinos verdes', 1.00),
(2, 'manzanas', 'manzanas', 2.00),
(3, 'pepinos', 'esto son pepinos', 5.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `identificador` int(255) NOT NULL,
  `nombreprovincia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direcciones a empleados` (`empleados_nombre`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `lineasapedidos` (`pedidos_fecha`),
  ADD KEY `lineasaproductos` (`productos_nombre`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `pedidos a clientes` (`clientes_apellidos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `identificador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones a empleados` FOREIGN KEY (`empleados_nombre`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD CONSTRAINT `lineasapedidos` FOREIGN KEY (`pedidos_fecha`) REFERENCES `pedidos` (`identificador`),
  ADD CONSTRAINT `lineasaproductos` FOREIGN KEY (`productos_nombre`) REFERENCES `productos` (`identificador`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos a clientes` FOREIGN KEY (`clientes_apellidos`) REFERENCES `clientes` (`Identificador`);
--
-- Base de datos: `fruteria`
--
CREATE DATABASE IF NOT EXISTS `fruteria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fruteria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_Cliente` int(11) NOT NULL,
  `NombreCliente` varchar(255) NOT NULL,
  `Teléfono` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Dirección` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_Cliente`, `NombreCliente`, `Teléfono`, `Correo`, `Dirección`) VALUES
(1, 'Juan Pérez', '555-1234', 'juan.perez@email.com', 'Calle Principal 123, Ciudad A'),
(2, 'María García', '555-5678', 'maria.garcia@email.com', 'Avenida Central 456, Ciudad B'),
(3, 'Carlos López', '555-8765', 'carlos.lopez@email.com', 'Calle Secundaria 789, Ciudad C'),
(4, 'Ana Martínez', '555-4321', 'ana.martinez@email.com', 'Avenida Norte 234, Ciudad D'),
(5, 'Luis Rodríguez', '555-6543', 'luis.rodriguez@email.com', 'Calle Sur 567, Ciudad E'),
(6, 'Laura González', '555-0987', 'laura.gonzalez@email.com', 'Avenida Este 890, Ciudad F'),
(7, 'Javier Hernández', '555-3456', 'javier.hernandez@email.com', 'Calle Oeste 345, Ciudad G'),
(8, 'Sofía Sánchez', '555-7890', 'sofia.sanchez@email.com', 'Avenida Los Campos 678, Ciudad H'),
(9, 'Fernando Ramírez', '555-2109', 'fernando.ramirez@email.com', 'Calle Jardín 901, Ciudad I'),
(10, 'Lucía Fernández', '555-5670', 'lucia.fernandez@email.com', 'Avenida Las Flores 123, Ciudad J'),
(11, 'Diego Torres', '555-3210', 'diego.torres@email.com', 'Calle Primavera 456, Ciudad K'),
(12, 'Paula Romero', '555-6541', 'paula.romero@email.com', 'Avenida Verano 789, Ciudad L'),
(13, 'Hugo Castillo', '555-9876', 'hugo.castillo@email.com', 'Calle Invierno 234, Ciudad M'),
(14, 'Elena Morales', '555-0989', 'elena.morales@email.com', 'Avenida Otoño 567, Ciudad N'),
(15, 'Ricardo Ortiz', '555-4323', 'ricardo.ortiz@email.com', 'Calle Roca 890, Ciudad O'),
(16, 'Valeria Vargas', '555-6789', 'valeria.vargas@email.com', 'Avenida Colina 345, Ciudad P'),
(17, 'Andrés Flores', '555-3459', 'andres.flores@email.com', 'Calle Cumbre 678, Ciudad Q'),
(18, 'Carolina Méndez', '555-7891', 'carolina.mendez@email.com', 'Avenida Río 901, Ciudad R'),
(19, 'Pablo Herrera', '555-6542', 'pablo.herrera@email.com', 'Calle Valle 123, Ciudad S'),
(20, 'Gabriela Castro', '555-4322', 'gabriela.castro@email.com', 'Avenida Nube 456, Ciudad T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `ID_DetallePedido` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioUnidad` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`ID_DetallePedido`, `ID_Pedido`, `ID_Producto`, `Cantidad`, `PrecioUnidad`) VALUES
(1, 1, 1, 10, 1.50),
(2, 1, 3, 5, 1.20),
(3, 2, 2, 20, 1.40),
(4, 2, 4, 10, 1.10),
(5, 3, 5, 3, 3.00),
(6, 3, 6, 8, 1.60),
(7, 4, 7, 1, 4.00),
(8, 4, 8, 1, 3.50),
(9, 5, 9, 5, 2.80),
(10, 5, 10, 2, 2.50),
(11, 6, 11, 7, 1.70),
(12, 6, 12, 6, 1.00),
(13, 7, 13, 4, 4.50),
(14, 7, 14, 3, 3.20),
(15, 8, 15, 10, 2.10),
(16, 8, 16, 3, 2.90),
(17, 9, 17, 2, 5.00),
(18, 9, 18, 2, 5.50),
(19, 10, 19, 3, 3.00),
(20, 10, 20, 1, 3.80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID_Pedido` int(11) NOT NULL,
  `FechaPedido` date NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `ID_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`ID_Pedido`, `FechaPedido`, `Total`, `ID_Cliente`) VALUES
(1, '2024-10-01', 35.50, 1),
(2, '2024-10-02', 42.00, 2),
(3, '2024-10-03', 15.75, 3),
(4, '2024-10-04', 55.90, 4),
(5, '2024-10-05', 23.50, 5),
(6, '2024-10-06', 60.25, 6),
(7, '2024-10-07', 45.80, 7),
(8, '2024-10-08', 28.30, 8),
(9, '2024-10-09', 38.40, 9),
(10, '2024-10-10', 50.00, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `PrecioUnidad` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `ID_Proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Producto`, `Nombre`, `PrecioUnidad`, `Stock`, `ID_Proveedor`) VALUES
(1, 'Manzana Roja', 1.50, 100, 1),
(2, 'Manzana Verde', 1.40, 150, 1),
(3, 'Plátano', 1.20, 200, 2),
(4, 'Naranja', 1.10, 180, 2),
(5, 'Fresa', 3.00, 50, 3),
(6, 'Pera', 1.60, 120, 1),
(7, 'Sandía', 4.00, 30, 4),
(8, 'Melón', 3.50, 40, 4),
(9, 'Uva', 2.80, 80, 5),
(10, 'Mango', 2.50, 60, 5),
(11, 'Kiwi', 1.70, 90, 3),
(12, 'Limón', 1.00, 140, 2),
(13, 'Cereza', 4.50, 45, 6),
(14, 'Piña', 3.20, 55, 4),
(15, 'Melocotón', 2.10, 100, 6),
(16, 'Papaya', 2.90, 70, 5),
(17, 'Arándano', 5.00, 30, 6),
(18, 'Frambuesa', 5.50, 25, 6),
(19, 'Coco', 3.00, 20, 4),
(20, 'Granada', 3.80, 50, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID_Proveedor` int(11) NOT NULL,
  `NombreProveedor` varchar(255) NOT NULL,
  `Teléfono` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Dirección` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`ID_Proveedor`, `NombreProveedor`, `Teléfono`, `Correo`, `Dirección`) VALUES
(1, 'Frutas del Valle', '555-1234', 'contacto@frutasdelvalle.com', 'Calle Principal 123, Ciudad A'),
(2, 'Agrícola Norte', '555-5678', 'ventas@agricolanorte.com', 'Avenida Los Campos 456, Ciudad B'),
(3, 'Frutas y Verduras Tropicales', '555-8765', 'info@frutastropicales.com', 'Calle Secundaria 789, Ciudad C'),
(4, 'Proveedores del Sur', '555-4321', 'soporte@provsur.com', 'Avenida Central 234, Ciudad D'),
(5, 'Distribuidora El Jardín', '555-6543', 'contacto@jardindistribuidora.com', 'Camino Rural 567, Ciudad E'),
(6, 'Frutales Andinos', '555-0987', 'info@frutalesandinos.com', 'Calle Montaña 890, Ciudad F'),
(7, 'Productos Naturales', '555-3456', 'ventas@productosnaturales.com', 'Avenida Bosques 345, Ciudad G'),
(8, 'Exportaciones del Trópico', '555-7890', 'export@tropicoexport.com', 'Carretera Nacional 678, Ciudad H'),
(9, 'Frutas Fina', '555-2109', 'ventas@frutasfina.com', 'Calle Central 901, Ciudad I'),
(10, 'Distribuciones Hortofrutícolas', '555-5670', 'contacto@hortodistribuciones.com', 'Avenida Las Flores 123, Ciudad J');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`ID_DetallePedido`),
  ADD KEY `detallepedidoaproducto` (`ID_Producto`),
  ADD KEY `detallepedidoapedido` (`ID_Pedido`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `pedidosaclientes` (`ID_Cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `productoaproveedor` (`ID_Proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `ID_DetallePedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedidoapedido` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`),
  ADD CONSTRAINT `detallepedidoaproducto` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedidosaclientes` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `productoaproveedor` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedor` (`ID_Proveedor`);
--
-- Base de datos: `futbol`
--
CREATE DATABASE IF NOT EXISTS `futbol` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `futbol`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisiones`
--

CREATE TABLE `divisiones` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `divisiones`
--

INSERT INTO `divisiones` (`identificador`, `nombre`) VALUES
(1, 'Primera'),
(2, 'Segunda'),
(3, 'Primera Federación'),
(4, 'Segunda Federación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `divisiones_nombre` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`identificador`, `nombre`, `divisiones_nombre`) VALUES
(1, 'silla', 1),
(2, 'mislata', 2),
(3, 'Mislata Club de Futbol', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichajes`
--

CREATE TABLE `fichajes` (
  `Identificador` int(11) NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `jugador_nombre` int(11) NOT NULL,
  `equipo_nombre` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichajes`
--

INSERT INTO `fichajes` (`Identificador`, `valor`, `jugador_nombre`, `equipo_nombre`, `fechainicio`, `fechafinal`) VALUES
(1, 1000.00, 1, 1, '2024-10-01', '2024-10-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `Identificador` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `divisiones_nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `Identificador` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `fechadenacimiento` date NOT NULL,
  `paises_nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`Identificador`, `nombre`, `apellidos`, `fechadenacimiento`, `paises_nombre`) VALUES
(1, 'makelele', 'gurdov', '2024-10-15', 114),
(3, 'iker', 'herreros', '2024-10-01', 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores_copia`
--

CREATE TABLE `jugadores_copia` (
  `Identificador` int(11) NOT NULL DEFAULT 0,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `fechadenacimiento` date NOT NULL,
  `paises_nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores_copia`
--

INSERT INTO `jugadores_copia` (`Identificador`, `nombre`, `apellidos`, `fechadenacimiento`, `paises_nombre`) VALUES
(1, 'makelele', 'gurdov', '2024-10-15', 114),
(3, 'iker', 'herreros', '2024-10-01', 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`identificador`, `nombre`) VALUES
(1, 'Afganistán'),
(2, 'Albania'),
(3, 'Alemania'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua y Barbuda'),
(7, 'Arabia Saudita'),
(8, 'Argelia'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Australia'),
(12, 'Austria'),
(13, 'Azerbaiyán'),
(14, 'Bahamas'),
(15, 'Bangladés'),
(16, 'Barbados'),
(17, 'Baréin'),
(18, 'Belice'),
(19, 'Benín'),
(20, 'Bielorrusia'),
(21, 'Birmania'),
(22, 'Bolivia'),
(23, 'Bosnia y Herzegovina'),
(24, 'Botsuana'),
(25, 'Brasil'),
(26, 'Brunéi'),
(27, 'Bulgaria'),
(28, 'Burkina Faso'),
(29, 'Burundi'),
(30, 'Bután'),
(31, 'Bélgica'),
(32, 'Cabo Verde'),
(33, 'Camboya'),
(34, 'Camerún'),
(35, 'Canadá'),
(36, 'Catar'),
(37, 'Chad'),
(38, 'Chile'),
(39, 'China'),
(40, 'Chipre'),
(41, 'Ciudad del Vaticano'),
(42, 'Colombia'),
(43, 'Comoras'),
(44, 'Corea del Norte'),
(45, 'Corea del Sur'),
(46, 'Costa de Marfil'),
(47, 'Costa Rica'),
(48, 'Croacia'),
(49, 'Cuba'),
(50, 'Dinamarca'),
(51, 'Dominica'),
(52, 'Ecuador'),
(53, 'Egipto'),
(54, 'El Salvador'),
(55, 'Emiratos Árabes Unidos'),
(56, 'Eritrea'),
(57, 'Eslovaquia'),
(58, 'Eslovenia'),
(59, 'España'),
(60, 'Estados Unidos'),
(61, 'Estonia'),
(62, 'Etiopía'),
(63, 'Filipinas'),
(64, 'Finlandia'),
(65, 'Fiyi'),
(66, 'Francia'),
(67, 'Gabón'),
(68, 'Gambia'),
(69, 'Georgia'),
(70, 'Ghana'),
(71, 'Granada'),
(72, 'Grecia'),
(73, 'Guatemala'),
(74, 'Guinea'),
(75, 'Guinea Ecuatorial'),
(76, 'Guinea-Bisáu'),
(77, 'Guyana'),
(78, 'Haití'),
(79, 'Honduras'),
(80, 'Hungría'),
(81, 'India'),
(82, 'Indonesia'),
(83, 'Irak'),
(84, 'Irlanda'),
(85, 'Irán'),
(86, 'Islandia'),
(87, 'Islas Marshall'),
(88, 'Islas Salomón'),
(89, 'Israel'),
(90, 'Italia'),
(91, 'Jamaica'),
(92, 'Japón'),
(93, 'Jordania'),
(94, 'Kazajistán'),
(95, 'Kenia'),
(96, 'Kirguistán'),
(97, 'Kiribati'),
(98, 'Kuwait'),
(99, 'Laos'),
(100, ' Lesoto'),
(101, '  Letonia'),
(102, '  Liberia'),
(103, '  Libia'),
(104, '  Liechtenstein'),
(105, '  Lituania'),
(106, '  Luxemburgo'),
(107, '  Líbano'),
(108, '  Macedonia del Norte'),
(109, '  Madagascar'),
(110, '  Malasia'),
(111, '  Malaui'),
(112, '  Maldivas'),
(113, '  Malta'),
(114, '  Malí'),
(115, '  Marruecos'),
(116, '  Mauricio'),
(117, '  Mauritania'),
(118, '  Micronesia'),
(119, '  Moldavia'),
(120, '  Mongolia'),
(121, '  Montenegro'),
(122, '  Mozambique'),
(123, '  México'),
(124, '  Mónaco'),
(125, '  Namibia'),
(126, '  Nauru'),
(127, '  Nepal'),
(128, '  Nicaragua'),
(129, '  Nigeria'),
(130, '  Noruega'),
(131, '  Nueva Zelanda'),
(132, '  Níger'),
(133, '  Omán'),
(134, '  Pakistán'),
(135, '  Palaos'),
(136, '  Panamá'),
(137, '  Papúa Nueva Guinea'),
(138, '  Paraguay'),
(139, '  Países Bajos'),
(140, '  Perú'),
(141, '  Polonia'),
(142, '  Portugal'),
(143, '  Reino Unido'),
(144, '  República Centroafricana'),
(145, '  República Checa'),
(146, '  República del Congo'),
(147, '  República Democrática del Congo'),
(148, '  República Dominicana'),
(149, '  Ruanda'),
(150, '  Rumanía'),
(151, '  Rusia'),
(152, '  Samoa'),
(153, '  San Cristóbal y Nieves'),
(154, '  San Marino'),
(155, '  San Vicente y las Granadinas'),
(156, '  Santa Lucía'),
(157, '  Santo Tomé y Príncipe'),
(158, '  Senegal'),
(159, '  Serbia'),
(160, '  Seychelles'),
(161, '  Sierra Leona'),
(162, '  Singapur'),
(163, '  Siria'),
(164, '  Somalia'),
(165, '  Sri Lanka'),
(166, '  Suazilandia'),
(167, '  Sudáfrica'),
(168, '  Sudán'),
(169, '  Sudán del Sur'),
(170, '  Suecia'),
(171, '  Suiza'),
(172, '  Surinam'),
(173, '  Tailandia'),
(174, '  Taiwán'),
(175, '  Tanzania'),
(176, '  Tayikistán'),
(177, '  Timor Oriental'),
(178, '  Togo'),
(179, '  Tonga'),
(180, '  Trinidad y Tobago'),
(181, '  Turkmenistán'),
(182, '  Turquía'),
(183, '  Tuvalu'),
(184, '  Túnez'),
(185, '  Ucrania'),
(186, '  Uganda'),
(187, '  Uruguay'),
(188, '  Uzbekistán'),
(189, '  Vanuatu'),
(190, '  Venezuela'),
(191, '  Vietnam'),
(192, '  Yemen'),
(193, '  Yibuti'),
(194, '  Zambia'),
(195, '  Zimbabue');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `divisionesaequipos` (`divisiones_nombre`);

--
-- Indices de la tabla `fichajes`
--
ALTER TABLE `fichajes`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `divisionesajornadas` (`divisiones_nombre`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `paisesajugadores` (`paises_nombre`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fichajes`
--
ALTER TABLE `fichajes`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `divisionesaequipos` FOREIGN KEY (`divisiones_nombre`) REFERENCES `divisiones` (`identificador`);

--
-- Filtros para la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD CONSTRAINT `divisionesajornadas` FOREIGN KEY (`divisiones_nombre`) REFERENCES `divisiones` (`identificador`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `paisesajugadores` FOREIGN KEY (`paises_nombre`) REFERENCES `paises` (`identificador`);
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Volcado de datos para la tabla `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\",\"relation_lines\":\"true\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"fruteria\",\"table\":\"Pedido\"},{\"db\":\"fruteria\",\"table\":\"detallepedido\"},{\"db\":\"fruteria\",\"table\":\"pedido\"},{\"db\":\"fruteria\",\"table\":\"cliente\"},{\"db\":\"fruteria\",\"table\":\"producto\"},{\"db\":\"fruteria\",\"table\":\"proveedor\"},{\"db\":\"empresa\",\"table\":\"clientes\"},{\"db\":\"programacion\",\"table\":\"productos\"},{\"db\":\"programacion\",\"table\":\"clientes\"},{\"db\":\"futbol\",\"table\":\"jugadores_copia\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('fruteria', 'producto', 'Nombre'),
('futbol', 'jugadores', 'nombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-10-30 11:03:32', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"es\",\"NavigationWidth\":0}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `programacion`
--
CREATE DATABASE IF NOT EXISTS `programacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `programacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Identificador` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Identificador`, `nombre`) VALUES
(1, 'Camisetas'),
(2, 'Pantalones'),
(3, 'Sudaderas'),
(4, 'Sombreros'),
(5, 'Calzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`identificador`, `nombre`, `apellidos`, `email`) VALUES
(1, 'Cecilia', 'Blanes', 'cabezasasdrubal@hotmail.com'),
(2, 'Ximena', 'Luján', 'colomerligia@gmail.com'),
(3, 'Felipa', 'Gutierrez', 'bsobrino@garate-pujol.com'),
(4, 'Jose Angel', 'Garriga', 'taboadapascual@yahoo.com'),
(5, 'Esperanza', 'Pereira', 'jose-franciscorocha@porcel.com'),
(6, 'Régulo', 'Castro', 'maxirodriguez@gmail.com'),
(7, 'Consuela', 'Chamorro', 'curro69@jaume.es'),
(8, 'Adoración', 'Fernandez', 'mirandafabian@gmail.com'),
(9, 'Joaquín', 'Ferrándiz', 'nicolauanselmo@torrens.org'),
(10, 'Sara', 'Jordán', 'noemi52@herranz.net'),
(11, 'Milagros', 'Izaguirre', 'hernan18@yahoo.com'),
(12, 'Manu', 'Cabañas', 'dieguezluis@plana-cano.es'),
(13, 'Leonor', 'Ramírez', 'hernan55@gmail.com'),
(14, 'Teodosio', 'Codina', 'luis18@calderon.es'),
(15, 'Nidia', 'Alfonso', 'albina96@calleja-cordero.es'),
(16, 'Cándido', 'Flor', 'rita76@gmail.com'),
(17, 'Angelita', 'Pulido', 'eligiocordero@yahoo.com'),
(18, 'Curro', 'Julián', 'miguelfatima@yahoo.com'),
(19, 'Paz', 'Seguí', 'navarretemargarita@yahoo.com'),
(20, 'Curro', 'Linares', 'rosa-mariaizaguirre@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`identificador`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'Inventore sudadera', 'Inventore sudadera de alta calidad para uso casual', 86.95),
(2, 'Recusandae camiseta', 'Recusandae camiseta de alta calidad para uso casual', 49.66),
(3, 'Quibusdam sandalias', 'Quibusdam sandalias de alta calidad para uso casual', 69.99),
(4, 'Id sombrero', 'Id sombrero de alta calidad para uso casual', 87.99),
(5, 'Corporis sandalias', 'Corporis sandalias de alta calidad para uso casual', 90.37),
(6, 'Nobis chaqueta', 'Nobis chaqueta de alta calidad para uso casual', 14.68),
(7, 'Veniam sombrero', 'Veniam sombrero de alta calidad para uso casual', 67.42),
(8, 'Quaerat sudadera', 'Quaerat sudadera de alta calidad para uso casual', 39.30),
(9, 'Pariatur pantalón', 'Pariatur pantalón de alta calidad para uso casual', 94.49),
(10, 'Odit pantalón', 'Odit pantalón de alta calidad para uso casual', 99.82),
(11, 'Distinctio chaqueta', 'Distinctio chaqueta de alta calidad para uso casual', 41.17),
(12, 'Voluptatum sandalias', 'Voluptatum sandalias de alta calidad para uso casual', 40.22),
(13, 'Iusto camiseta', 'Iusto camiseta de alta calidad para uso casual', 63.27),
(14, 'Sapiente sudadera', 'Sapiente sudadera de alta calidad para uso casual', 72.08),
(15, 'Quo zapatos', 'Quo zapatos de alta calidad para uso casual', 96.52),
(16, 'Perspiciatis sudadera', 'Perspiciatis sudadera de alta calidad para uso casual', 70.47),
(17, 'Reiciendis gorra', 'Reiciendis gorra de alta calidad para uso casual', 66.13),
(18, 'Voluptas gorra', 'Voluptas gorra de alta calidad para uso casual', 15.28),
(19, 'Assumenda bufanda', 'Assumenda bufanda de alta calidad para uso casual', 75.46),
(20, 'Temporibus sombrero', 'Temporibus sombrero de alta calidad para uso casual', 71.92);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
