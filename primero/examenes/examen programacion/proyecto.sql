-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 16:16:23
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
-- Base de datos: `exprogramacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`identificador`, `titulo`, `texto`, `imagen`) VALUES
(1, 'Repercusión\r\n', 'La ciencia que esconde la Catedral de Burgos ha obtenido una gran repercusión, tanto institucional como a nivel mediático y de audiencia. El documental fue distinguido como mejor proyecto destacado en ComCiRed 2021, un galardón que premia los mejores trabajos de las unidades de cultura científicas de las universidades.\r\nLa serie se ha emitido en La 8 Burgos y La 2 de Televisión Española, además de en el canal de YouTube de UBUinvestiga, donde acumula más de 150.000 visitas. Su estreno concitó un enorme interés de medios locales y nacionales. 110 horas de grabación que han cristalizado en 8 episodios y disponibles de forma gratuita.', 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/comcired_2021.jpg'),
(2, 'Agentes', 'Para la creación del documental han intervenido numerosos agentes. La producción ha corrido a cargo de la UCC+i de la Universidad de Burgos con el apoyo de la Fundación Española para la Ciencia y la Tecnología – Ministerio de Ciencia e Innovación y el Cabildo de la Catedral de Burgos, además de agradecer a numerosas instituciones y colaboradores.', 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/2021-09-02_2021-09-02_presentacion_documental_catedral_017_0.jpg'),
(6, 'titulofinal', 'subtitulofinal', 'imagenfinal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
