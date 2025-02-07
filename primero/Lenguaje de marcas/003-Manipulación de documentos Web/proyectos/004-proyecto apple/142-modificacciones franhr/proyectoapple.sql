-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2024 a las 23:55:01
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
-- Base de datos: `proyectoapple`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `Identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` mediumblob DEFAULT NULL,
  `fecha` date NOT NULL,
  `contenido` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `categoriasblog_categorias` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`Identificador`, `titulo`, `imagen`, `fecha`, `contenido`, `categoriasblog_categorias`) VALUES
(32, 'prueba', 0x6161612e6a7067, '2024-12-12', 'sadsadsadasdasd', 1),
(33, 'rtr', 0x66696c652e706e67, '2024-12-13', 'sadsadsadasdasd', 1),
(34, 'sssss', 0x6672616e687273696e666f6e646f2e706e67, '2024-12-05', 'ssss', 2),
(35, 'rtr', 0x6672616e76696b696e312e706e67, '2024-12-12', 'sadsadsadasdasd', 1),
(37, 'rtr', 0x576861747341707020496d61676520323032342d30312d30392061742031382e33332e33352e6a706567, '2024-12-08', 'sadsadsadasdasd', 1),
(38, 'ioio', NULL, '2024-12-05', 'ioio', 1),
(39, 'iiii', NULL, '0000-00-00', '', 1),
(40, 'iiii', NULL, '0000-00-00', '', 2),
(41, 'iiii', NULL, '0000-00-00', '', 2),
(42, 'iii', NULL, '0000-00-00', '', 1),
(43, 'iiii', NULL, '0000-00-00', '', 2),
(44, 'kkkkk', NULL, '0000-00-00', '', 1),
(45, 'hhhh', NULL, '0000-00-00', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloquescategorias`
--

CREATE TABLE `bloquescategorias` (
  `Identificador` int(255) NOT NULL,
  `categorias_nombre` int(255) NOT NULL,
  `tipobloque_tipo` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fondo` varchar(255) DEFAULT NULL,
  `estilo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bloquescategorias`
--

INSERT INTO `bloquescategorias` (`Identificador`, `categorias_nombre`, `tipobloque_tipo`, `titulo`, `subtitulo`, `texto`, `imagen`, `fondo`, `estilo`) VALUES
(12, 18, 6, 'rtr', 'dsadsad', 'rtr', NULL, NULL, ''),
(14, 18, 1, 'yy', 'yyy', 'yyyy', NULL, 'fhrbaner.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloquesproductos`
--

CREATE TABLE `bloquesproductos` (
  `Identificador` int(255) NOT NULL,
  `productos_titulo` int(255) NOT NULL,
  `tipobloque_tipo` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fondo` varchar(255) DEFAULT NULL,
  `estilo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bloquesproductos`
--

INSERT INTO `bloquesproductos` (`Identificador`, `productos_titulo`, `tipobloque_tipo`, `titulo`, `subtitulo`, `texto`, `imagen`, `fondo`, `estilo`) VALUES
(32, 7, 7, 'Memoria RAM', 'Las Mejores Memoria Ram para tu pc', '[{\"titulo\":\"rtr\",\"precio\":\"11\",\"imagen\":\"1735165111_fhrdibujo.jpg\"},{\"titulo\":\"prueba\",\"precio\":\"10\",\"imagen\":\"1735165129_file.png\"},{\"titulo\":\"prueba\",\"precio\":\"10\",\"imagen\":\"1735165154_fran.png\"},{\"titulo\":\"prueba\",\"precio\":\"10\",\"imagen\":\"1735165173_file.png\"},{\"titulo\":\"rtr\",\"precio\":\"10\",\"imagen\":\"1735165195_franvikin1.png\"},{\"titulo\":\"ghjg\",\"subtitulo\":\"subtitulo\",\"precio\":\"10\",\"imagen\":\"1735165948_franviking2.png\"},{\"titulo\":\"rtr\",\"subtitulo\":\"dsadsad\",\"precio\":\"\",\"imagen\":\"1735169809_fhrdibujo.jpg\"},{\"titulo\":\"rtr\",\"subtitulo\":\"dsadsad\",\"precio\":\"\",\"imagen\":\"1735169859_fhrdibujo.jpg\"},{\"titulo\":\"rtr\",\"subtitulo\":\"dsadsad\",\"precio\":\"10\",\"imagen\":\"1735172712_fran.png\"}]', '1735165111_fhrdibujo.jpg', NULL, '{     \"self\": {         \n\"background\":\"orange\",\n\"text-align\":\"center\"},\n\"h3\":{\"color\":\"green\"},\n\"h4\":{\"color\":\"blue\"}\n }'),
(47, 7, 4, '', '', '8E-XM3mufnA', '', '', ''),
(48, 7, 6, 'rtr', 'dsadsad', '[\r\n    {\"titulo\": \"Hola\", \"texto\": \"texto\",\"imagen\":\"4.png\"},\r\n    {\"titulo\": \"Hola\", \"texto\": \"texto\",\"imagen\":\"5.png\"},\r\n    {\"titulo\": \"Hola\", \"texto\": \"texto\",\"imagen\":\"6.png\"},\r\n    {\"titulo\": \"Hola\", \"texto\": \"texto\",\"imagen\":\"1.png\"},\r\n    {\"titulo\": \"Hola\", \"texto\": \"texto\",\"imagen\":\"1.png\"},\r\n    {\"titulo\": \"Hola\", \"texto\": \"texto\",\"imagen\":\"1.png\"}\r\n]', '', '', ''),
(49, 7, 5, 'rtr', 'dsadsad', '{\n    \"columna1\": \"Texto para la primera columna\",\n    \"columna2\": \"Texto para la segunda columna\"\n}', '', '', '{     \"self\": {         \n\"background\":\"orange\",\n\"text-align\":\"center\"},\n\"h3\":{\"color\":\"green\"},\n\"h4\":{\"color\":\"blue\"}\n }'),
(51, 7, 1, 'rtr', 'dsadsad', 'ggg', '', '1735174672_fhrbaner.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrusel1`
--

CREATE TABLE `carrusel1` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `textoboton` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `carrusel1`
--

INSERT INTO `carrusel1` (`id`, `titulo`, `texto`, `imagen`, `enlace`, `textoboton`) VALUES
(2, 'titulo', 'texto', 'aaa.jpg', 'https://www.youtube.com/watch?v=RCSCxDeualM', 'ver'),
(3, 'rtr', 'rtr', 'fhrbaner.jpg', 'https://www.youtube.com/watch?v=RCSCxDeualM', 'Ver ahora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrusel2`
--

CREATE TABLE `carrusel2` (
  `id` int(11) NOT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `carrusel2`
--

INSERT INTO `carrusel2` (`id`, `texto`, `imagen`, `enlace`) VALUES
(1, 'rtr', 'franvikin1.png', 'https://www.youtube.com/watch?v=RCSCxDeualM'),
(2, 'asdasd', 'fhrdibujo.jpg', 'https://www.youtube.com/watch?v=RCSCxDeualM'),
(3, 'asdasd', 'franviking2.png', 'https://www.youtube.com/watch?v=RCSCxDeualM');

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
(17, 'Servicios'),
(18, 'Tienda'),
(20, 'Nosotros'),
(22, 'Ofertas y Promociones'),
(23, 'Soporte Técnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriasblog`
--

CREATE TABLE `categoriasblog` (
  `Identificador` int(255) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriasblog`
--

INSERT INTO `categoriasblog` (`Identificador`, `categoria`) VALUES
(1, 'General'),
(2, 'Python');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `Identificador` int(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `valor` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`Identificador`, `clave`, `valor`) VALUES
(1, 'titulo', 'PCprogramacion'),
(2, 'descripcion', 'Servicios de reparación de ordenadores y desarrollo de aplicaciones multiplataforma. Soluciones personalizadas para garantizar el rendimiento de tus equipos y crear software adaptado a tus necesidades.'),
(3, 'palabrasclave', 'reparación de ordenadores, desarrollo de aplicaciones, aplicaciones multiplataforma, mantenimiento informático, desarrollo de software, soporte técnico, programación, diseño de software, reparación de PC, optimización de sistemas, desarrollo móvil, aplicaciones para escritorio, soluciones tecnológicas, reparación de portátiles, programación multiplataforma, Java, Kotlin, Python, JavaScript, C#, Swift, HTML, CSS, PHP, SQL, Flutter, React Native, Xamarin, Angular, React, Vue.js, Laravel, Django, Node.js, Spring Boot, .NET, Electron, Apache'),
(4, 'autor', 'FranHR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacados`
--

CREATE TABLE `destacados` (
  `Identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `textoboton1` varchar(255) NOT NULL,
  `textoboton2` varchar(255) NOT NULL,
  `enlace1` varchar(255) NOT NULL,
  `enlace2` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `destacados`
--

INSERT INTO `destacados` (`Identificador`, `titulo`, `texto`, `textoboton1`, `textoboton2`, `enlace1`, `enlace2`, `imagen`) VALUES
(1, 'iPad Air', 'Dos tamaños. Un chip aún más rápido. Todo vuela.', '', '', 'Más información sobre el iPad Air', 'https://www.apple.com/es/shop/buy-ipad/ipad-air', '4.png'),
(3, 'Apple La Vaguada', 'Ya hemos abierto.', '', '', 'https://www.apple.com/es/retail/lavaguada/', 'https://www.apple.com/es/retail/lavaguada/', '5.png'),
(4, 'Trade In', 'Consigue un descuento al renovar tu iPhone 12 o posterior.', 'ver mas', 'comprar', 'https://www.apple.com/es/shop/trade-in', 'https://www.apple.com/es/shop/trade-in', '6.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `heroes`
--

CREATE TABLE `heroes` (
  `Identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `textoboton1` varchar(255) NOT NULL,
  `textoboton2` varchar(255) NOT NULL,
  `enlace1` varchar(255) NOT NULL,
  `enlace2` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `heroes`
--

INSERT INTO `heroes` (`Identificador`, `titulo`, `texto`, `textoboton1`, `textoboton2`, `enlace1`, `enlace2`, `imagen`) VALUES
(1, 'Iphone 16 pro', 'Hello, Apple Intelligence.', 'ver producto', 'comprar', 'https://www.apple.com/es/iphone-16-pro/', 'https://www.apple.com/es/shop/buy-iphone/iphone-16-pro', '1.png'),
(2, 'Iphone 16', 'Hello, Apple Intelligence', '', 'comprar', 'https://www.apple.com/es/shop/buy-iphone/iphone-16', 'https://www.apple.com/es/shop/buy-iphone/iphone-16', '2.png'),
(3, 'Días especiales del Apple Store', 'Llévate una Apple Gift Card de hasta 200 € al comprar un producto en promoción. Hasta el 2/12', '', '', 'https://www.apple.com/es/shop/gifts/shopping-event', 'https://www.apple.com/es/shop/gifts/shopping-event', '3.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_enlaces`
--

CREATE TABLE `menu_enlaces` (
  `Identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `orden` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu_enlaces`
--

INSERT INTO `menu_enlaces` (`Identificador`, `nombre`, `url`, `orden`) VALUES
(2, 'Formulario contacto', 'http://localhost/DAM-Francisco-Jose-Herreros-Rodriguez/primero/Lenguaje%20de%20marcas/003-Manipulaci%C3%B3n%20de%20documentos%20Web/proyectos/004-proyecto%20apple/091-cargo%20articulo%20blog/back/panel.php', 0),
(4, 'analytic', 'http://localhost/DAM-Francisco-Jose-Herreros-Rodriguez/primero/Lenguaje%20de%20marcas/003-Manipulaci%C3%B3n%20de%20documentos%20Web/proyectos/004-proyecto%20apple/099-registrador%20de%20visitas%20sqlite/util/analytic/', 0),
(12, 'generador docu', 'http://localhost/DAM-Francisco-Jose-Herreros-Rodriguez/primero/Lenguaje%20de%20marcas/003-Manipulaci%C3%B3n%20de%20documentos%20Web/proyectos/004-proyecto%20apple/134-generador%20de%20documentacion/util/documentacion/generador.php', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_visibilidad`
--

CREATE TABLE `menu_visibilidad` (
  `Identificador` int(255) NOT NULL,
  `nombre_tabla` varchar(255) NOT NULL,
  `visible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu_visibilidad`
--

INSERT INTO `menu_visibilidad` (`Identificador`, `nombre_tabla`, `visible`) VALUES
(1, 'blog', 1),
(2, 'bloquescategorias', 1),
(3, 'bloquesproductos', 1),
(4, 'categorias', 1),
(5, 'categoriasblog', 1),
(6, 'destacados', 1),
(7, 'heroes', 1),
(8, 'menu_visibilidad', 0),
(9, 'oferta', 1),
(10, 'productos', 1),
(11, 'tipobloque', 0),
(12, 'usuarios', 0),
(13, 'menu_enlaces', 0),
(14, 'carrusel1', 1),
(15, 'carrusel2', 1),
(16, 'redessociales', 0),
(17, 'config', 0),
(18, 'paginas', 1),
(19, 'tiendas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `Identificador` int(255) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`Identificador`, `texto`, `enlace`, `fechainicio`, `fechafinal`) VALUES
(1, 'Donaremos cinco dólares al Fondo Mundial por cada compra realizada con Apple Pay en Apple. Hasta el 8/12.', 'https://www.apple.com/es/shop/goto/store', '2024-12-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `Identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`Identificador`, `titulo`, `contenido`) VALUES
(1, 'Terminos de uso', '# Términos de Uso\r\n\r\n## Introducción\r\n\r\nBienvenido a **PCprogramacion**. Este documento establece los términos y condiciones bajo los cuales puedes utilizar nuestro sitio web y servicios. Por favor, léelos detenidamente. El acceso y uso de nuestro sitio web implica la aceptación de estos términos de uso.\r\n\r\n## Objeto del Sitio Web\r\n\r\nPCprogramacion proporciona servicios relacionados con el desarrollo de aplicaciones multiplataforma, así como la venta de ordenadores y componentes de PC. Adicionalmente, ofrecemos información, recursos y servicios complementarios en el ámbito de la programación y la tecnología.\r\n\r\n## Acceso y Uso del Sitio Web\r\n\r\n1. **Condiciones de Acceso:** El acceso al sitio web es gratuito para los usuarios. Sin embargo, ciertos servicios específicos pueden estar sujetos a pago.\r\n2. **Uso Responsable:** Al utilizar este sitio web, te comprometes a:\r\n   - No emplear los contenidos para fines ilícitos o contrarios a la moral y al orden público.\r\n   - No provocar daños en los sistemas de PCprogramacion ni en los de terceros.\r\n   - No intentar acceder de forma no autorizada a las áreas restringidas del sitio.\r\n3. **Exactitud de los Datos:** Al proporcionar información a través de formularios, garantizas que los datos son exactos y actuales.\r\n\r\n## Servicios Ofrecidos\r\n\r\n1. **Desarrollo de Aplicaciones Multiplataforma:** Diseñamos y desarrollamos soluciones personalizadas para distintas plataformas.\r\n2. **Venta de Equipos y Componentes:** Comercializamos ordenadores y piezas para ensamblaje de PCs.\r\n3. **Recursos de Programación:** Ofrecemos guías, tutoriales y herramientas útiles para programadores.\r\n\r\nPCprogramacion se reserva el derecho de modificar o suspender los servicios ofrecidos en el sitio web en cualquier momento y sin previo aviso.\r\n\r\n## Propiedad Intelectual\r\n\r\nTodos los contenidos del sitio web (textos, imágenes, logotipos, diseño, código fuente, etc.) están protegidos por los derechos de propiedad intelectual e industrial de PCprogramacion o de terceros. Queda prohibida su reproducción, distribución, comunicación pública o modificación sin autorización previa y expresa del titular.\r\n\r\n## Limitación de Responsabilidad\r\n\r\n1. **Disponibilidad del Sitio Web:** PCprogramacion no garantiza que el sitio web esté disponible de forma continua ni que esté libre de errores.\r\n2. **Daños Eventuales:** No nos hacemos responsables de los daños que puedan derivarse del uso indebido del sitio web o de la imposibilidad de acceder al mismo.\r\n3. **Contenido de Terceros:** No somos responsables del contenido de los enlaces externos o de la información proporcionada por terceros en el sitio web.\r\n\r\n## Enlaces Externos\r\n\r\nEste sitio web puede contener enlaces a sitios web de terceros. PCprogramacion no controla ni asume responsabilidad alguna por el contenido, políticas de privacidad o prácticas de dichos sitios externos. La inclusión de estos enlaces no implica la aprobación o asociación con los mismos.\r\n\r\n## Modificación de los Términos de Uso\r\n\r\nPCprogramacion se reserva el derecho de modificar estos Términos de Uso en cualquier momento. Las modificaciones entrarán en vigor desde su publicación en el sitio web. Se recomienda a los usuarios revisar periódicamente este documento.\r\n\r\n## Legislación Aplicable y Jurisdicción\r\n\r\nEstos Términos de Uso se rigen por la legislación española. Cualquier controversia relacionada con el uso del sitio web será competencia de los Juzgados y Tribunales de Valencia, salvo que la normativa aplicable disponga lo contrario.\r\n\r\n## Contacto\r\n\r\nSi tienes alguna pregunta o comentario sobre estos Términos de Uso, puedes ponerte en contacto con nosotros a través del correo electrónico **info@pcprogramacion.es** o mediante el formulario de contacto disponible en el sitio web.\r\n\r\n'),
(2, 'Aviso Legal', '# Aviso Legal\r\n\r\n## Identificación del Responsable\r\n\r\nEn cumplimiento con lo dispuesto en el Artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSI-CE), se informa de los siguientes datos identificativos del responsable del sitio web:\r\n\r\n- **Titular:** PCprogramacion\r\n- **Domicilio:** Calle Principal, Silla, Valencia, 46460, España\r\n- **Correo Electrónico de Contacto:** info@pcprogramacion.es\r\n- **Teléfono de Contacto:** [Añadir teléfono]\r\n- **CIF/NIF:** [Añadir CIF/NIF]\r\n\r\n## Finalidad del Sitio Web\r\n\r\nEl sitio web **PCprogramacion** tiene como objetivo ofrecer servicios de desarrollo de aplicaciones multiplataforma, así como la venta de ordenadores y componentes de PC. Además, se proporcionan recursos e información relevante para usuarios interesados en tecnología y programación.\r\n\r\n## Condiciones de Uso\r\n\r\nEl acceso y/o uso del sitio web atribuye la condición de usuario, que acepta, desde dicho acceso y/o uso, las presentes condiciones generales de uso. Estas condiciones serán de aplicación independientemente de las condiciones generales de contratación que en su caso resulten de obligado cumplimiento.\r\n\r\n### Obligaciones del Usuario\r\n\r\nEl usuario se compromete a hacer un uso adecuado de los contenidos y servicios que PCprogramacion ofrece a través del sitio web, y con carácter enunciativo pero no limitativo, a no emplearlos para:\r\n\r\n1. Realizar actividades ilícitas, ilegales o contrarias a la buena fe y al orden público.\r\n2. Difundir contenidos o propaganda de carácter racista, xenófobo, pornográfico-ilegal, de apología del terrorismo o atentatorio contra los derechos humanos.\r\n3. Provocar daños en los sistemas físicos y lógicos de PCprogramacion, de sus proveedores o de terceras personas, introducir o difundir en la red virus informáticos o cualesquiera otros sistemas físicos o lógicos que sean susceptibles de provocar los daños anteriormente mencionados.\r\n\r\n## Propiedad Intelectual e Industrial\r\n\r\nTodos los contenidos del sitio web, incluyendo, sin carácter limitativo, textos, imágenes, gráficos, códigos fuente, logotipos, marcas, nombres comerciales o cualquier otro signo susceptible de utilización industrial y/o comercial, son propiedad del titular del sitio web o, en su caso, de terceros que han autorizado su uso. Queda prohibida la reproducción, distribución, comunicación pública, transformación o cualquier otra forma de explotación no autorizada expresamente por el titular.\r\n\r\n## Exoneración de Responsabilidad\r\n\r\nPCprogramacion no se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza que pudieran ocasionar, a título enunciativo: errores u omisiones en los contenidos, falta de disponibilidad del portal o la transmisión de virus o programas maliciosos o lesivos en los contenidos, a pesar de haber adoptado todas las medidas tecnológicas necesarias para evitarlo.\r\n\r\n## Enlaces Externos\r\n\r\nEl sitio web puede contener enlaces a otros sitios web gestionados por terceros. PCprogramacion no controla dichos sitios ni se hace responsable de sus contenidos. La presencia de enlaces en este sitio web tiene una finalidad meramente informativa y no implica ningún tipo de asociación, fusión o participación con las entidades conectadas.\r\n\r\n## Política de Privacidad\r\n\r\nEl acceso al sitio web no requiere que el usuario proporcione datos personales. No obstante, para la prestación de ciertos servicios, puede ser necesario recopilar información personal. La información recopilada será tratada de conformidad con nuestra Política de Privacidad, que puede consultarse en [enlace a la Política de Privacidad].\r\n\r\n## Legislación Aplicable y Jurisdicción\r\n\r\nLa relación entre PCprogramacion y el usuario se regirá por la normativa española vigente, y cualquier controversia se someterá a los Juzgados y Tribunales de Valencia, salvo que la legislación aplicable disponga otra cosa.\r\n\r\n## Modificaciones del Aviso Legal\r\n\r\nPCprogramacion se reserva el derecho de realizar modificaciones en este Aviso Legal en cualquier momento, siendo debidamente publicadas tal y como aquí aparecen. La vigencia de las citadas condiciones irá en función de su exposición y estarán vigentes hasta que sean modificadas por otras debidamente publicadas.\r\n\r\n'),
(3, 'Política de Cookies', '# Política de Cookies\r\n\r\n## ¿Qué son las cookies?\r\n\r\nLas cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas un sitio web. Estas permiten al sitio web recordar tus acciones y preferencias (como idioma, tamaño de fuente u otras configuraciones) durante un período de tiempo, para que no tengas que configurarlas cada vez que regreses al sitio o navegues entre páginas.\r\n\r\n## Tipos de cookies que utilizamos\r\n\r\nEn **PCprogramacion** utilizamos las siguientes categorías de cookies:\r\n\r\n1. **Cookies Esenciales:**\r\n   - Estas cookies son necesarias para que el sitio web funcione correctamente y no se pueden desactivar en nuestros sistemas. Por ejemplo, incluyen cookies que te permiten acceder a áreas seguras del sitio web o utilizar un carrito de compra.\r\n\r\n2. **Cookies de Rendimiento:**\r\n   - Estas cookies recopilan información sobre cómo los usuarios interactúan con el sitio web, como las páginas más visitadas o si se producen errores. La información recopilada es anónima y se utiliza exclusivamente para mejorar el funcionamiento del sitio web.\r\n\r\n3. **Cookies de Funcionalidad:**\r\n   - Estas cookies permiten que el sitio web recuerde tus elecciones (como tu nombre de usuario, idioma o región) y proporcionan funciones mejoradas y más personales.\r\n\r\n4. **Cookies de Marketing y Publicidad:**\r\n   - Estas cookies se utilizan para mostrar anuncios relevantes para ti y para medir la eficacia de nuestras campañas publicitarias. También pueden ser utilizadas por terceros con el mismo propósito.\r\n\r\n## ¿Cómo gestionar las cookies?\r\n\r\nPuedes gestionar y/o eliminar cookies según tus preferencias. La mayoría de los navegadores te permiten:\r\n\r\n1. Eliminar cookies existentes.\r\n2. Bloquear cookies de determinados sitios web.\r\n3. Configurar el navegador para que te avise antes de que se almacene una cookie.\r\n\r\nPor favor, ten en cuenta que si desactivas o bloqueas ciertas cookies, algunas funcionalidades de nuestro sitio web podrían no funcionar correctamente.\r\n\r\n### Configuración en los navegadores más comunes:\r\n\r\n- **Google Chrome:** [https://support.google.com/chrome/answer/95647](https://support.google.com/chrome/answer/95647)\r\n- **Mozilla Firefox:** [https://support.mozilla.org/es/kb/enable-and-disable-cookies](https://support.mozilla.org/es/kb/enable-and-disable-cookies)\r\n- **Microsoft Edge:** [https://support.microsoft.com/es-es/help/4027947/microsoft-edge-delete-cookies](https://support.microsoft.com/es-es/help/4027947/microsoft-edge-delete-cookies)\r\n- **Safari:** [https://support.apple.com/es-es/guide/safari/sfri11471/mac](https://support.apple.com/es-es/guide/safari/sfri11471/mac)\r\n\r\n## Cookies de Terceros\r\n\r\nEn algunos casos, utilizamos cookies proporcionadas por terceros. Estas cookies son gestionadas por entidades externas y se utilizan, por ejemplo, para ofrecer servicios de análisis (como Google Analytics) o publicidad personalizada.\r\n\r\n### Ejemplo de terceros utilizados:\r\n\r\n- **Google Analytics:** Utilizamos este servicio para recopilar información anónima sobre el uso del sitio y generar estadísticas que nos ayudan a mejorar la experiencia del usuario.\r\n- **Redes Sociales:** Integraciones como botones de \"Compartir\" de Facebook, Instagram o LinkedIn pueden instalar cookies para identificar a los usuarios.\r\n\r\n## Consentimiento\r\n\r\nAl acceder a nuestro sitio web por primera vez, se mostrará un aviso donde se te informará del uso de cookies y se te permitirá aceptar, rechazar o personalizar tus preferencias. Podrás cambiar tus preferencias en cualquier momento desde nuestro configurador de cookies o borrando las cookies almacenadas en tu navegador.\r\n\r\n## Actualizaciones de esta Política de Cookies\r\n\r\nPodemos actualizar esta Política de Cookies para reflejar cambios en nuestras prácticas o en la legislación aplicable. Te recomendamos que revises esta política periódicamente para estar informado sobre cómo usamos las cookies.\r\n\r\n## Contacto\r\n\r\nSi tienes preguntas sobre esta Política de Cookies, puedes contactarnos en **info@pcprogramacion.es** o a través del formulario de contacto disponible en nuestro sitio web.\r\n\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` double(6,2) NOT NULL,
  `categorias_nombre` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Identificador`, `titulo`, `descripcion`, `precio`, `categorias_nombre`) VALUES
(1, 'Desarrollo de aplicaciones\nmóviles', 'Desarrollo de aplicaciones móviles\nNos encargamos de todo. Y cuando decimos todo queremos decir todo\nDesarrollo de aplicaciones móviles\nNos encargamos de todo. Y cuando decimos todo queremos decir todo...\nDesarrollo de aplicaciones móviles\nNos encargamos de todo. Y cuando decimos todo queremos decir todo...\nDesarrollo de aplicaciones móviles\nNos encargamos de todo. Y cuando decimos todo queremos decir todo...\nDesarrollo de aplicaciones móviles\nNos encargamos de todo. Y cuando decimos todo queremos decir todo...', 99.00, 17),
(2, 'Desarrollo de aplicaciones\r\nmultiplataforma', 'Desarrollo de aplicaciones multiplataforma\r\nLos seres humanos tenemos una extraordinaria capacidad para acostumbrarnos a lo asombroso y perder de vista su enorme complejidad. Así, diariamente dedicamos horas y horas, tanto en el entorno personal como en el entorno profesional, a la explotación de infinidad de aplicaciones informáticas. Y, sin embargo, muchas personas ignoran la dificultad que plantea el desarrollo de estas aplicaciones. Desde múltiples perspectivas. Por suerte, existen empresas como PCpro capaces de desarrollar aplicaciones muy variadas y eficientes. Una empresa experta en el desarrollo de aplicaciones multiplataforma.', 100.00, 17),
(3, 'Desarrollo de apps híbridas', 'Uno de los grandes debates en el mundo de las aplicaciones tiene que ver con el mejor desarrollo\nUno de los grandes debates en el mundo de las aplicaciones tiene que ver con el mejor desarrollo pos\nUno de los grandes debates en el mundo de las aplicaciones tiene que ver con el mejor desarrollo pos\nUno de los grandes debates en el mundo de las aplicaciones tiene que ver con el mejor desarrollo pos\nUno de los grandes debates en el mundo de las aplicaciones tiene que ver con el mejor desarrollo pos', 0.00, 17),
(4, 'Ordenadores', 'Venta de ordenadores completos, listos para funcionar', 0.00, 18),
(5, 'procesadores', 'procesadores', 234.00, 18),
(6, 'placa base', 'placa base', 100.30, 18),
(7, 'memoria ram', 'asdas', 10.00, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redessociales`
--

CREATE TABLE `redessociales` (
  `Identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `redessociales`
--

INSERT INTO `redessociales` (`Identificador`, `nombre`, `icono`, `enlace`) VALUES
(1, 'Facebook', '', 'https://www.facebook.com/franhrgames/'),
(2, 'Instagram', '', 'https://www.instagram.com/franhrgames/'),
(3, 'Github', '', 'https://github.com/franHR11'),
(4, 'x', '', 'https://x.com/FranhrGames'),
(5, 'Linkedin', '', 'https://www.linkedin.com/in/franciscojoseherreros/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipobloque`
--

CREATE TABLE `tipobloque` (
  `Identificador` int(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipobloque`
--

INSERT INTO `tipobloque` (`Identificador`, `tipo`) VALUES
(1, 'completo'),
(2, 'caja'),
(3, 'mosaico'),
(4, 'bloqueyoutube'),
(5, 'Bloque 2 columnas'),
(6, 'Bloque pasa fotos'),
(7, 'bloque tienda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Identificador` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombrecompleto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Identificador`, `email`, `contrasena`, `nombrecompleto`) VALUES
(1, 'franhr1113@gmail.com', 'franHR', 'Francisco José Herreros Rodriguez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE IF NOT EXISTS `tiendas` (
  `Identificador` int(255) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(255) DEFAULT NULL,
  `fondo` varchar(255) DEFAULT NULL,
  `estilo` text,
  PRIMARY KEY (`Identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas_productos`
--

CREATE TABLE IF NOT EXISTS `tiendas_productos` (
  `tienda_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `orden` int(11) DEFAULT 0,
  PRIMARY KEY (`tienda_id`, `producto_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `fk_tienda` FOREIGN KEY (`tienda_id`) REFERENCES `tiendas` (`Identificador`) ON DELETE CASCADE,
  CONSTRAINT `fk_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`Identificador`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Añadir la tabla a menu_visibilidad si no existe
INSERT IGNORE INTO `menu_visibilidad` (`nombre_tabla`, `visible`) VALUES ('tiendas', 1);

-- --------------------------------------------------------

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `blogacategorias` (`categoriasblog_categorias`);

--
-- Indices de la tabla `bloquescategorias`
--
ALTER TABLE `bloquescategorias`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `bloquesacategorias` (`categorias_nombre`),
  ADD KEY `bloquesatipos` (`tipobloque_tipo`);

--
-- Indices de la tabla `bloquesproductos`
--
ALTER TABLE `bloquesproductos`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `bloquesatipos` (`tipobloque_tipo`),
  ADD KEY `bloquesaproductos` (`productos_titulo`);

--
-- Indices de la tabla `carrusel1`
--
ALTER TABLE `carrusel1`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrusel2`
--
ALTER TABLE `carrusel2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `categoriasblog`
--
ALTER TABLE `categoriasblog`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `destacados`
--
ALTER TABLE `destacados`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `menu_enlaces`
--
ALTER TABLE `menu_enlaces`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `menu_visibilidad`
--
ALTER TABLE `menu_visibilidad`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `productosacategoria` (`categorias_nombre`);

--
-- Indices de la tabla `redessociales`
--
ALTER TABLE `redessociales`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `tipobloque`
--
ALTER TABLE `tipobloque`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `bloquescategorias`
--
ALTER TABLE `bloquescategorias`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `bloquesproductos`
--
ALTER TABLE `bloquesproductos`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `carrusel1`
--
ALTER TABLE `carrusel1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carrusel2`
--
ALTER TABLE `carrusel2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `categoriasblog`
--
ALTER TABLE `categoriasblog`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `destacados`
--
ALTER TABLE `destacados`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `heroes`
--
ALTER TABLE `heroes`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `menu_enlaces`
--
ALTER TABLE `menu_enlaces`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `menu_visibilidad`
--
ALTER TABLE `menu_visibilidad`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `redessociales`
--
ALTER TABLE `redessociales`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipobloque`
--
ALTER TABLE `tipobloque`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blogacategorias` FOREIGN KEY (`categoriasblog_categorias`) REFERENCES `categoriasblog` (`Identificador`);

--
-- Filtros para la tabla `bloquescategorias`
--
ALTER TABLE `bloquescategorias`
  ADD CONSTRAINT `bloquesacategorias` FOREIGN KEY (`categorias_nombre`) REFERENCES `categorias` (`Identificador`),
  ADD CONSTRAINT `bloquesatipos` FOREIGN KEY (`tipobloque_tipo`) REFERENCES `tipobloque` (`Identificador`);

--
-- Filtros para la tabla `bloquesproductos`
--
ALTER TABLE `bloquesproductos`
  ADD CONSTRAINT `bloquesaproductos` FOREIGN KEY (`productos_titulo`) REFERENCES `productos` (`Identificador`),
  ADD CONSTRAINT `bloquesproductoatipobloque` FOREIGN KEY (`tipobloque_tipo`) REFERENCES `tipobloque` (`Identificador`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productosacategoria` FOREIGN KEY (`categorias_nombre`) REFERENCES `categorias` (`Identificador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
