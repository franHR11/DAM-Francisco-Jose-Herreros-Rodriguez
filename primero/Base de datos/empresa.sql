-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2024 a las 02:41:09
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
-- Base de datos: `empresa`
--

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
  `fechadenacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Identificador`, `nombre`, `apellidos`, `email`, `poblacion`, `fechadenacimiento`) VALUES
(1, 'Juan', 'Pérez García', 'juan.perez@gmail.com', 'Madrid', '1985-04-23'),
(2, 'Ana', 'López Fernández', 'ana.lopez@hotmail.com', 'Barcelona', '1992-08-15'),
(3, 'Carlos', 'Martínez Ruiz', 'carlos.martinez@yahoo.com', 'Valencia', '1988-12-05'),
(4, 'Laura', 'Gómez Sánchez', 'laura.gomez@outlook.com', 'Sevilla', '1990-07-10'),
(5, 'David', 'Fernández López', 'david.fernandez@correo.com', 'Bilbao', '1983-01-17'),
(6, 'Sofía', 'García Ortega', 'sofia.garcia@gmail.com', 'Zaragoza', '1995-11-22'),
(7, 'Miguel', 'Rodríguez Pérez', 'miguel.rodriguez@hotmail.com', 'Málaga', '1986-03-19'),
(8, 'Elena', 'Moreno Díaz', 'elena.moreno@outlook.com', 'Murcia', '1993-09-14'),
(9, 'Luis', 'Sánchez Torres', 'luis.sanchez@correo.com', 'Valladolid', '1991-05-28'),
(10, 'Marta', 'Jiménez Romero', 'marta.jimenez@gmail.com', 'Granada', '1989-06-12'),
(11, 'Pablo', 'Ruiz Castro', 'pablo.ruiz@gmail.com', 'Alicante', '1987-10-30'),
(12, 'Sara', 'Domínguez Serrano', 'sara.dominguez@hotmail.com', 'Córdoba', '1994-04-12'),
(13, 'Manuel', 'Ortega Morales', 'manuel.ortega@yahoo.com', 'Vigo', '1980-07-21'),
(14, 'Lucía', 'Santos Molina', 'lucia.santos@outlook.com', 'Santander', '1996-09-05'),
(15, 'Adrián', 'Navarro Gutiérrez', 'adrian.navarro@correo.com', 'Toledo', '1992-03-10'),
(16, 'Carmen', 'Ramos Iglesias', 'carmen.ramos@gmail.com', 'Almería', '1990-12-22'),
(17, 'Iván', 'Mendoza Sáez', 'ivan.mendoza@hotmail.com', 'Salamanca', '1984-11-11'),
(18, 'Nuria', 'Vega López', 'nuria.vega@outlook.com', 'Burgos', '1991-06-18'),
(19, 'Raúl', 'Gil Jiménez', 'raul.gil@gmail.com', 'Logroño', '1988-02-14'),
(20, 'Patricia', 'Reyes Cruz', 'patricia.reyes@correo.com', 'Huelva', '1995-05-07'),
(21, 'Jose Vicente', 'Carratalá Sanchis', 'info@josevicentecarratala.com', 'Valencia', '1978-04-14'),
(22, 'Jose Vicente', 'Carratalá Sanchis', 'info@josevicentecarratala.com', 'Valencia', '1978-04-14'),
(24, 'Jose Vicente', 'Carratalá Sanchis', 'info@josevicentecarratala.com', 'Valencia', '1978-04-14'),
(25, 'Jose Vicente', 'Carratalá Sanchis', '', '', '0000-00-00');

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
(1, 'calle valencia, 5', '46000', 'españa', 1);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones a empleados` FOREIGN KEY (`empleados_nombre`) REFERENCES `empleados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
