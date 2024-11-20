-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 18:16:15
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
-- Base de datos: `examenbasededatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliografía`
--

CREATE TABLE `bibliografía` (
  `identificador` int(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `autor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bibliografía`
--

INSERT INTO `bibliografía` (`identificador`, `imagen`, `texto`, `autor`) VALUES
(1, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/10.jpg', 'La Catedral de Burgos. Ocho siglos de historia y arte.', 'René Jesús Payo Hernanz'),
(2, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/1.jpg', 'La Catedral de Burgos: patrimonio del mundo.', 'Marcos Rico'),
(3, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/2-1.jpg', 'Catedral de Burgos: la belleza recobrada: 25 años de restauraciones', 'René Jesús Payo Hernanz\r\nJuan Ruiz Carcedo'),
(4, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/2-1.jpg', 'La Catedral de Burgos : imagen, percepción y emblema de un templo patrimonio de la humanidad.', 'José Matesanz del Barrio'),
(5, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/3.png', 'La Catedral y Burgos: pulcra es et decora : como nunca antes te lo han contado.', 'Rafael Pampliega Pampliega\r\nColabora Enrique Hernando Arnáiz'),
(6, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/3.png', 'La Catedral y Burgos: pulcra es et decora : como nunca antes te lo han contado.', 'Rafael Pampliega Pampliega\r\nColabora Enrique Hernando Arnáiz'),
(7, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/3.png', 'Tesoros matemáticos de la catedral de Burgos', 'Sociedad Castellana y Leonesa de Educación Matemática «Miguel de Guzmán».'),
(8, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/3.png', 'Tesoros matemáticos de la catedral de Burgos', 'Sociedad Castellana y Leonesa de Educación Matemática «Miguel de Guzmán».'),
(9, 'Arte completo del constructor de órgano.', 'Arte completo https://libros.ubu.es/servpubu-acceso-abierto/catalog/book/37del constructor de órgano.', 'Mariano Tafall'),
(10, 'John Fitchen', 'https://libros.ubu.es/servpubu-acceso-abierto/catalog/book/37', 'John Fitchen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliografía_header`
--

CREATE TABLE `bibliografía_header` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bibliografía_header`
--

INSERT INTO `bibliografía_header` (`identificador`, `nombre`, `subtitulo`, `texto`) VALUES
(1, 'Bibliografía', 'Los libros, guardianes del conocimiento científico', 'La documentación y obtención de conocimiento es fundamental para hablar de los aspectos científicos que aparecen en La Catedral de Burgos. Se realizó una amplia lectura y entre estas destacamos cuales fueron las principales fuentes de información. También añadimos un libro publicado por la Universidad de Burgos con todas las actuaciones entorno a la catedral.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos`
--

CREATE TABLE `capitulos` (
  `identificador` int(255) NOT NULL,
  `numerador` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `capitulos`
--

INSERT INTO `capitulos` (`identificador`, `numerador`, `titulo`, `subtitulo`, `imagen`, `video`, `texto`) VALUES
(1, 'Capítulo I:', 'La arquitectura', 'Nos acercaremos a los orígenes de la Catedral de Burgos, sus momentos clave, su milenario archivo y la revolución del gótico. Los historiadores René Payo y José Matesanz sitúan los hitos más importantes de su construcción. El archivero Matías Vicario abre', 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-arquitectura-min.jpg', 'https://www.youtube.com/watch?v=N-OBoksb9oQ&t=1s', 'La Catedral de Burgos ha visto pasar 800 años. Generación tras generación, este edificio tan singular ha visto pasar guerras, pandemias, temporales y miles de vidas que han continuado asombrándose con su figura.\r\n\r\nEn el año 1221 se colocó la primera piedra de un proyecto ideado por el Obispo Mauricio y Fernando III el Santo. La nueva catedral, de orden gótico, estaba llamada a sustituir la antigua construcción románica y marcar un hito en el Camino de Santiago y en la historia del arte, inspirándose en las basílicas francesas. La llegada del gótico permitió aligerar los muros y comenzar a construir en altura, buscando el cielo y permitir el paso de la luz.\r\n\r\nEn este primer capítulo, dos profesores de la Universidad de Burgos nos guiarán por las fórmulas de construcción del templo. René Payo y José Matesanz nos introducen en la técnica empleada para levantar las paredes de la catedral, un prodigio científico y tecnológico aún en nuestros días y con la dificultad adicional de los medios empleados por parte de obreros y canteros.\r\n\r\nAdemás, nos adentramos en el Archivo de la seo burgalesa con Matías Vicario, canónigo archivero, para recorrer la memoria de la catedral, con cientos de documentos que no sólo recogen textos eclesiásticos, sino multitud de documentación sobre la vida en la ciudad, la economía, medicina… además de toda la producción documental de la propia Catedral. Una auténtica joya conservada por siglos.\r\n\r\nSin embargo, la construcción de la basílica burgalesa fue todo un desafío que se extendió durante siglos. Las agujas, el cimborrio y algunas de las capillas más emblemáticas son construcciones posteriores que conjugan estilos y técnicas de diferentes épocas. Es precisamente esta unión de estilos, como el gótico, el renacimiento, el barroco y el neoclásico lo que convierte a la catedral de Burgos en un monumento único. Para comprender las particularidades de su construcción, Javier Garabito, arquitecto de la catedral y profesor de la Universidad de Burgos, nos enseña los fundamentos del gótico y la importancia de sus bóvedas, arcos y arbotantes.\r\n\r\nAdemás, la ciencia de la época se basaba, en buena parte, en el ensayo y el error. Prueba de ello fue la caída del cimborrio original ya que, a pesar del enorme conocimiento de los constructores, su técnica podía fallar en ocasiones. Por otro lado, la posición de la seo, construida en cuesta, supone un desafío adicional para su construcción.'),
(2, 'Capítulo II', 'La piedra', 'La piel de la catedral', 'https://www.youtube.com/watch?v=vIDIP3gjGcY', 'https://www.youtube.com/watch?v=vIDIP3gjGcY', 'La piel de la catedral de Burgos es especial. El revestimiento pétreo de caliza, extraído de las proximidades de Burgos, en la cantera de Hontoria, le da un color muy característico, mientras ha permitido que su estructura y su belleza se mantengan hasta nuestros días.\r\n\r\nLa llegada del gótico a las catedrales supone comenzar a dar importancia a la luz. Los muros suben hacia el cielo, las paredes se abren con vidrieras de colores y la luminosidad de la piedra comienza a ser más importante que nunca. Gabriel García Agudo, uno de los responsables de Patrimonio de la Luz, responsables de la gestión de las canteras en la actualidad, nos acerca a lo que supuso extraer la piedra de la roca viva con herramientas artesanales. Para conocer las técnicas de extracción y labrado recurrimos a José Javier Barrio, restaurador y tallista, que nos enseña los secretos de la talla, tanto para los sillares como para los elementos decorativos.\r\n\r\nLa piedra blanca de Hontoria otorga un brillo muy especial a la basílica, tanto en el exterior como en su interior. René Payo y José Matesanz, profesores de la Universidad de Burgos, nos señalan sus características: una piedra maleable, que gana en resistencia con el paso del tiempo. Sin embargo, toda piedra necesita mantenimiento y restauración. Los trabajos en la catedral, como señala José Javier Barrio, son constantes y se realizan con métodos artesanales para respetar al máximo el espíritu y la estética de la catedral.\r\n\r\nQuizá la actuación más visible haya sido, precisamente, la realizada sobre la fachada de la seo burgalesa. La limpieza del exterior volvió a mostrar el color blanco de sus paredes, dejando atrás el gris que durante tanto tiempo habíamos conocido. No solo se realizó la limpieza, sino que se aplicaron técnicas de conservación que, sin alterar su aspecto, protegen la piel de la basílica.\r\n\r\nLos cambios no fueron solo estéticos. La piedra supone el principal elemento estructural de toda la catedral y su cuidado debe ser constante. Aplicar los conocimientos de física, química, ingeniería y arquitectura resulta fundamental para protegerla de la oxidación, de gelifracción (la ruptura por el hielo), la contaminación… La Catedral de Burgos goza de una excelente salud tras las restauraciones llevadas a cabo los últimos años, pero los cuidados deben ser constantes y delicados para mantener su magnífico aspecto y la firmeza que ha mantenido durante sus 800 años de historia.              '),
(3, 'Capítulo III\r\n', 'Las matemáticas', 'Geometrías sagradas', 'https://www.youtube.com/watch?v=AMpqREfzuCk', 'https://www.youtube.com/watch?v=AMpqREfzuCk', 'La catedral de Burgos está hecha de piedra… y matemáticas. Alberga multitud de proporciones, relaciones y figuras geométricas que no sólo hacen que se mantenga en pie, sino que nos parezca armónica y bella.\r\n\r\nEn palabras de René Payo, profesor de la Universidad de Burgos, los constructores de las catedrales, los canteros, estaban “obsesionados” con la geometría y las proporciones matemáticas. Estas proporciones armónicas nos transmiten, por un lado, una sensación de belleza, pero también con un sentimiento religioso relacionado con la idea de paz y perfección. Para acercarnos a estos conceptos entrevistamos a Constantino de la Fuente, matemático y catedrático de matemáticas del instituto cardenal López de Mendoza. De la Fuente nos relata los procesos utilizados para el diseño y creación de la Catedral de Burgos basada en la proporción, la relación entre dos magnitudes.\r\n\r\nAl medir en función de proporciones, no importa tanto el dato numérico de una de las cantidades, sino la relación entre las dos. Si miramos bajo este prisma, las matemáticas surgen por todas partes en la basílica. Esta geometría permite crear patrones y adaptarlos en los diferentes diseños ornamentales. Uno de los diseños más presentes en la Catedral de Burgos es la vesica piscis, el símbolo del pez usado por los primeros cristianos y que corresponde a la zona común entre dos círculos. Esta figura permite mantener armonía y ritmo en los diseños.\r\n\r\nTampoco podía faltar el número más famoso si hablamos de proporciones: phi, el número áureo. La proporción áurea, conocida en multitud de animales y plantas, está presente en la catedral de Burgos en el cimborrio y la Escalera Dorada, dos de los elementos más reconocibles del interior de la seo, especialmente en la escalera. Diseñada en el Renacimiento, Diego de Siloé conocía, a buen seguro, la proporción áurea y la aplicó en su diseño, además de incluir el llamado “triángulo dorado”, que sigue la misma proporción que las agujas de la catedral.\r\n\r\nAdemás de todas estas proporciones, existen muchas otras relaciones geométricas en la Catedral, como el número de plata o la proporción cordobesa, muy ligada al arte mudéjar, formando un conjunto de hibridación y unión de estilos y culturas.\r\n\r\nComo señala el profesor de la Universidad de Burgos, José Matesanz, estas proporciones eran bien conocidas por los constructores de la catedral y le otorgan buena parte de la belleza presente en el edificio, tanto en su exterior como en su luminoso interior.'),
(4, 'Capítulo IV', 'La Pintura', 'Pigmentos desvelados', 'https://www.youtube.com/watch?v=IixHnL_Ml8w', 'https://www.youtube.com/watch?v=IixHnL_Ml8w', 'Dentro de la Catedral de Burgos encontramos innumerables tesoros. Algunos de ellos poseen vivos colores que hablan de belleza y espiritualidad desde los cuadros, retablos y esculturas que adornan el interior del templo. En este episodio hablaremos de la pintura que habita en la Catedral.\r\n\r\nSin embargo, como señala José Matesanz, profesor de la Universidad de Burgos, el arte mueble, estos conjuntos de pinturas y esculturas, no solo servían para decorar, sisno para enseñar. Estas figuras hablaban a los fieles del culto, las historias de la biblia, las virtudes a seguir y, por supuesto, los pecados a evitar. En la misma línea, Francisco Jesús del Hoyo, pintor y restaurador, señala la gran cantidad de arte que posee la catedral, con una gran tradición de pintores italianos y flamencos, sin contar la gran cantidad de figuras y esculturas repartidas por todos los rincones. No obstante, esta pintura, realizadas en muy diferentes técnicas, necesita mantenimiento y restauración.\r\n\r\nEn nuestra entrevista, del Hoyo nos describe los procesos físicos y químicos que sufren las pinturas al estar en contacto con el paso del tiempo y nuestra propia presencia. Por ejemplo, el uso de incensarios somete a las tallas al contacto con el humo, que va alterando su color y sus propiedades y son ya irrecuperables. También el uso de determinados barnices ha provocado oxidaciones sobre las pinturas, o las variaciones que, directamente, se han realizado sobre las obras.\r\n\r\nEl proceso técnico de la restauración nace de un conocimiento científico profundo de estos problemas. La restauración no sólo es una intervención física, sino que requiere, en muchas ocasiones, de un análisis químico previo para ver qué elementos contiene la capa de pintura y, después, decidir la mejor forma de actuar.\r\n\r\nPara conocer mejor estos procesos en materiales tan delicados como la madera, Itsaso Artexte y Mercedes Chico, restauradoras de Fénix Conservación, nos hablan de las técnicas utilizadas en la restauración de once retablos de la catedral de Burgos. Para las expertas, la humedad es uno de los principales problemas para la madera presente en la seo burgalesa. Tanto desde el uso de productos químicos como con instrumentos como bisturís, escalpelos o tornos, actúan sobre las obras de arte más delicadas. Además, nuevas tecnologías, como el láser, pueden ser útiles en algunos elementos.\r\n\r\nTodos los trabajos sobre el interior de la catedral han permitido que los colores, las texturas y los detalles de la decoración vuelvan a ver la luz. Ahora es importante mantener la conservación para evitar su deterioro y poder seguir disfrutando de la magia de los colores en el interior del templo burgalés.'),
(5, 'Capítulo V', 'Las vidrieras', 'Los colores de la luz', 'https://www.youtube.com/watch?v=LlxPVOYg6Ug&t=1s', 'https://www.youtube.com/watch?v=LlxPVOYg6Ug&t=1s', 'Gracias al estilo gótico, la Catedral de Burgos gana el altura, ligereza y esbeltez. Al aligerar los muros, se hizo posible la apertura de grandes ventanales que se decoraron con auténticas obras de arte: las vidrieras. Proyecciones de luz de todos los colores que inundan el interior del templo, decoran los ventanales y nos cuentan historias sobre la fe y el propio templo.\r\n\r\nEn las vidrieras se unen ciencia, técnica y arte en un proceso complejo. Los cristales, pintados primero, se ensamblan mediante varillas de plomo. Para conocer los detalles entrevistamos a Pilar Alonso, profesora de la Universidad de Burgos, que nos detalla las características del vidrio, su creación y su transformación en pequeños fragmentos coloreados de arte. Además, contamos con Enrique Barrio, vidriero y pintor, que se ha encargado tanto de restauración como creación de nuevas vidrieras para la catedral de Burgos. El artista nos enseña el proceso final de pintura, la composición de los colores y la forma de fijarlos al vidrio.\r\n\r\nLa Catedral de Burgos es uno de los mejores exponentes del arte de la vidriera española. Tanto en la Edad Media, como en los siglos XVI y XVIII, la seo alberga impresionantes ejemplos artísticos. Incluso podemos encontrar un color único en el mundo: el “rojo Burgos”, un vidrio laminado con diferentes capas de rojo sobre una base verde y que, hasta ahora, sólo se ha encontrado en la catedral y en el Monasterio de las Huelgas.\r\n\r\nA finales del siglo XV y principios del XVI llegan a Burgos numerosos maestros flamencos de la vidriera que dotan de aún más luz y color espacios tan únicos como la Capillas de los Condestables. Como toda obra artística, las vidrieras necesitan mucho mantenimiento, conservación y atención. Alteraciones físicas y químicas, agentes externos como el clima o la contaminación e, incluso, actos vandálicos. Actualmente, las tareas de restauración se realizan de forma tradicional y artesanal, trasladado la pieza al taller del artista para realizar las actuaciones químicas o físicas necesarias sobre la pieza.\r\n\r\nEn definitiva, las vidrieras de la Catedral de Burgos son mucho más que un elemento decorativo en las ventanas. Suponen toda una tradición artística y técnica compleja condensada en fragmentos de vidrio sin los que sería imposible entender las esbeltas catedrales góticas.'),
(6, 'Capítulo VI', 'La música', 'Sonidos en armonía', 'https://www.youtube.com/watch?v=WoZRpJTP0XI', 'https://www.youtube.com/watch?v=WoZRpJTP0XI', 'La Catedral de Burgos es un espacio de recogimiento y espiritualidad. Cuando se van los turistas y en las horas de culto, las paredes del templo reflejan los rezos… y la música. Como bien señala José Matesanz, profesor de la Universidad de Burgos, la música, y los cantorales han sido siempre una parte fundamental del culto en la Catedral.\r\n\r\nPara dotar de sonoridad a un edificio tan grande como la basílica burgalesa es necesario un instrumento de gran tamaño: el órgano. Instrumento monumental por sí mismo, gracias a su enorme tamaño, es capaz de reproducir toda la escala de sonidos que puede percibir el ser humano. La Catedral de Burgos tiene varios de estos instrumentos, algunos de ellos muy antiguos y singulares, en palabras de René Payo, profesor de la Universidad de Burgos.\r\n\r\nÓscar Laguna, organero de la catedral nos introduce, literalmente, en el interior de estos instrumentos. Como organero, se encarga del mantenimiento y restauración de estos grandes creadores de música. Además de su parte técnica para poder generar música, nos adentramos en el interior de estos gigantes para contemplar de cerca sus mecanismos, todos sus tubos y funcionamiento. Los órganos son instrumentos fascinantes que, con un buen mantenimiento, pueden funcionar sin problemas durante cientos de años.\r\n\r\nAdemás de los órganos, las campanas de la catedral tienen una doble función: musical y de comunicación con la ciudad. Antonio Cano, relojero y campanero de la seo burgalesa, nos lleva a las alturas de las agujas para contemplar de cerca el toque de campanas. Las más antiguas, la mayor y la campana Mauricio, se unen a las modernas, la última del año 2010, todas ellas de bronce. Tamaño y materiales son las claves para su sonido, afinado con precisión. Junto a ellas descansa la gran carraca, recuperada recientemente tras casi un siglo de silencio y que, en Semana Santa, reemplazaba el repicar de campanas.\r\n\r\nLa presencia de los instrumentos seguirá siendo parte de la esencia de la catedral. En su interior, los órganos acompañarán a los cantos y las liturgias, mientras las campanas seguirán siendo el lenguaje del templo para comunicarse con la ciudad.'),
(7, 'Capítulo VII', 'Las tecnologías modernas', 'Mecanismos y sistemas eléctricos', 'https://www.youtube.com/watch?v=KngumYLL3H0', 'https://www.youtube.com/watch?v=KngumYLL3H0', 'La Catedral de Burgos acumuló, tanto en su planteamiento como en su realización, todo el saber técnico, científico y tecnológico de la época. Sin embargo, el templo ha sido un edificio vivo que ha buscado incorporar nuevas innovaciones a su conjunto.\r\n\r\nEl ejemplo más claro fue la adquisición de reloj mecánico en 1384. El reloj se colocó en la fachada y funcionaba mediante un sistema de contrapesos y bloqueos, llamado escape de varillas. Su funcionamiento y conservación dependen de Antonio Cano, relojero y campanero, que nos guía por el pasado y futuro de los mecanismos. Este reloj utiliza la misma tecnología que el que tiene actualmente el Papamoscas, un encantador autómata que marca las horas abriendo su boca, ayudado por el pequeño Martinillo, otro autómata que marca los cuartos.\r\n\r\nA pesar de su precisión, el sistema de pesas ha quedado ampliamente superado. En la actualidad, tanto el Papamoscas como el Martinillo mantienen toda su estructura original, pero se manejan por ordenador para garantizar que no haya desajustes con la hora. Mantener las estructuras originales exige mucho mantenimiento, pero conserva todo el encanto que ha fascinado a niños y mayores durante siglos.\r\n\r\nLo mismo ocurre con el toque de campanas. El mecanismo antiguo utilizaba dos tambores de cadenas para tocar las campanas “a volteo” con un sistema de pedales. Al igual que el Papamoscas, las campanas se manejan mediante un ordenador y motores electrónicos que, incluso, están conectados a la red para poder manejarlo sin estar allí. Sin embargo, el reto sigue siendo el mantenimiento.  Pese a toda la automatización, las reparaciones siguen realizándose in situ y no es fácil subir hasta las agujas.\r\n\r\nTambién la calefacción y la iluminación se han modernizado. Dotar de una temperatura constante en una ciudad tan fría y con cambios tan extremos como Burgos es fundamental, no solo para los visitantes, sino para la correcta conservación del patrimonio de la catedral. El sistema de climatización ha aprovechado una antigua canalización del templo, por lo que no se ha alterado lo más mínimo la estructura del edificio. La iluminación, actualizada a luces LED para minimizar su consumo, además de un sistema de alimentación que mantiene activo un sistema de seguridad contra robos e incendios incluso con cortes de suministro eléctrico.\r\n\r\nTodos estos sistemas, junto con una protección contra rayos, permiten asegurar que, pese a sus 800 años, la Catedral de Burgos tiene mejor salud que nunca y su seguridad y continuidad está más que garantizada.'),
(8, 'Capítulo VIII', 'La conservación', 'Presente y futuro de la catedral', 'https://www.youtube.com/watch?v=LdC_cyh_hD8', 'https://www.youtube.com/watch?v=LdC_cyh_hD8', 'La Catedral de Burgos es un edificio vivo. Como recuerda René Payo, profesor de la Universidad de Burgos, las catedrales deben empezar a mantenerse y conservarse desde que se coloca la primera piedra. Es inevitable que en un edificio tan grande y complejo haya que realizar mejoras y reparaciones. Payo data las primeras restauraciones, tal y como las entendemos hoy comienzan en el siglo XIX.\r\n\r\nPara comprender el alcance de estas restauraciones, Javier Garabito, arquitecto de la catedral y profesor de la UBU, realiza un recorrido por las principales intervenciones, desde la demolición del Palacio Arzobispal hasta la retirada de las escaleras de las agujas, que ponían en peligro su estabilidad.\r\n\r\nUna vez asegurada su estructura se produjo la que, probablemente, sea la intervención más visible de todas: la limpieza de la fachada. Después, se comenzó a trabajar en elementos internos, como pinturas y bóvedas, para terminar con bienes muebles como retablos, cuadros o esculturas. Más recientemente se ha actuado sobre el trasaltar del altar mayor, una actuación pendiente desde hacía mucho.\r\n\r\nLa Catedral de Burgos es, hoy en día, un monumento en un excelente estado. Nuestros expertos la colocan como uno de los monumentos mejor preservados de Europa y se ha convertido en un símbolo de la ciudad, no sólo para los creyentes, sino para todos los burgaleses. Tras décadas de intervenciones decididas, la seo burgalesa luce espléndida y afronta los siguientes 800 años con salud renovada.\r\n\r\nEl futuro es prometedor para el monumento. Es un edificio vivo y debe seguir incorporando aportaciones, bajo un criterio de calidad muy estricto y que no altere el espíritu del templo. Todas las ciencias, técnicas y tecnologías que hemos visto a lo largo de nuestro documental forman parte del ADN del edificio. Todas ellas colaboraron en su creación y siguen haciéndolo para mantener su majestuosidad.\r\n\r\nJosé Matesanz, profesor de la Universidad de Burgos, corrobora que la catedral debe ser un elemento identitario para las próximas generaciones de la ciudad, que además han de aportar al monumento su propia experiencia y conocimiento para que sea un edificio Patrimonio de la Humanidad.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos_expertos`
--

CREATE TABLE `capitulos_expertos` (
  `identificador` int(255) NOT NULL,
  `capitulos_nombre` int(255) NOT NULL,
  `expertos_nombre` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `capitulos_expertos`
--

INSERT INTO `capitulos_expertos` (`identificador`, `capitulos_nombre`, `expertos_nombre`) VALUES
(1, 6, 1),
(2, 7, 1),
(3, 3, 2),
(4, 8, 2),
(5, 5, 3),
(6, 4, 4),
(7, 8, 4),
(8, 2, 5),
(9, 4, 6),
(10, 1, 7),
(11, 8, 7),
(12, 2, 8),
(13, 1, 9),
(14, 2, 9),
(15, 3, 9),
(16, 4, 9),
(17, 6, 9),
(18, 8, 9),
(19, 5, 10),
(20, 1, 11),
(21, 7, 12),
(22, 6, 12),
(23, 7, 13),
(24, 6, 13),
(25, 6, 14),
(26, 1, 15),
(27, 2, 15),
(28, 3, 15),
(29, 4, 15),
(30, 8, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos_header`
--

CREATE TABLE `capitulos_header` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `capitulos_header`
--

INSERT INTO `capitulos_header` (`identificador`, `titulo`, `subtitulo`, `texto`) VALUES
(1, 'Capítulos', 'Ocho episodios para conocer la catedral\r\n\r\n', '¿Qué hace grandiosa a una catedral? ¿Por qué la de Burgos es única? ¿Qué convierte a una acumulación de piedras y maderas labradas en una obra de arte de fama mundial? Detrás de la construcción, de la mística y la restauración se encuentran multitud de aspectos científicos, técnicos y tecnológicos presentes en cada rincón.\r\n\r\nEn los ocho episodios que componen la serie La ciencia que esconde la Catedral de Burgos recorreremos cada uno de los aspectos más importantes para la construcción, mantenimiento y conservación de la seo burgalesa, pero también en aquellos aspectos artísticos singulares que la convierten en una de las joyas del gótico y uno de los edificios más singulares del mundo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos_contenido`
--

CREATE TABLE `creditos_contenido` (
  `identificador` int(255) NOT NULL,
  `Producido` varchar(255) NOT NULL,
  `colaboración` text NOT NULL,
  `Entrevistados` text NOT NULL,
  `Equipo` text NOT NULL,
  `documentales` text NOT NULL,
  `imágenes` varchar(255) NOT NULL,
  `Música` text NOT NULL,
  `Bibliografía` text NOT NULL,
  `Agradecimientos` text NOT NULL,
  `Grabado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `creditos_contenido`
--

INSERT INTO `creditos_contenido` (`identificador`, `Producido`, `colaboración`, `Entrevistados`, `Equipo`, `documentales`, `imágenes`, `Música`, `Bibliografía`, `Agradecimientos`, `Grabado`) VALUES
(1, 'UNIDAD DE CULTURA CIENTÍFICA E INNOVACIÓN de la UNIVERSIDAD DE BURGOS', 'Fundación Española para la Ciencia y Tecnología (FECYT) – MINISTERIO DE CIENCIA E INNOVACIÓN\r\n\r\nCabildo Metropolitano de la Catedral de Burgos', 'ANTONIO CANO\r\nCONSTANTINO DE LA FUENTE MARTÍNEZ\r\nENRIQUE BARRIO\r\nFRANCISCO JESÚS DEL HOYO\r\nGABRIEL GARCÍA AGUDO\r\nITSASO ARTETXE\r\nJAVIER GARABITO\r\nJOSÉ JAVIER BARRIO\r\nJOSÉ MATESANZ\r\nMª PILAR ALONSO ABAD\r\nMATÍAS VICARIO SANTAMARÍA\r\nMERCEDES CHICO\r\nMIGUEL ÁNGEL ORTEGA\r\nÓSCAR LAGUNA\r\nRENÉ JESÚS PAYO HERNANZ', 'PRODUCCIÓN EJECUTIVA – JORDI ROVIRA CARBALLIDO\r\nDIRECCIÓN – SAMUEL PÉREZ GUTIÉRREZ\r\nGUION – SAMUEL PÉREZ GUTIÉRREZ y VALERIA CIMADEVILLA TEJERO\r\nREALIZACIÓN – FERNANDO MUÑOZ CIFUENTES\r\nDIRECCIÓN DE FOTOGRAFÍA – ERIC VIZCAYA\r\nDISEÑO Y ANIMACIÓN – DAVID SERRANO FERNÁNDEZ\r\n\r\nOPERADORES DE CÁMARAS – FERNANDO MUÑOZ CIFUENTES y CRISTIAN DE LAS HERAS PARA\r\nDIRECTOR DE PRODUCCIÓN – SAMUEL PÉREZ GUTIÉRREZ\r\nAYUDANTES DE PRODUCCIÓN – ISABEL SOTO MUÑOZ y ZULEMA ARENAS CONGOSTO\r\nAUXILIAR DE PRODUCCIÓN – MARÍA IZARBE GRACIA MARTA\r\nEDICIÓN – FERNANDO MUÑOZ CIFUENTES y ERIC VIZCAYA\r\nDOCUMENTACIÓN GRÁFICA – DAVID SERRANO FERNÁNDEZ\r\n\r\nLOCUCIÓN – SAMUEL PÉREZ GUTIÉRREZ\r\nSONIDO – ERIC VIZCAYA y DAVID SERRANO FERNÁNDEZ\r\nTIMELAPSE E HIPERLAPSE – FERNANDO MUÑOZ CIFUENTES\r\nOPERADOR DE DRON – ANDRÉS MENÉNDEZ\r\nSEGUNDO OPERADOR DE DRON – ERIC VIZCAYA\r\nESTUDIO AERONÁUTICO Y SEGURIDAD AÉREA – FERNANDO FEIJOO\r\nDIBUJOS TÉCNICOS – LUIS MARÍA MARTÍN CORRALES\r\n\r\nREDACTOR DE CONTENIDOS – RODRIGO GARCIA APARICIO\r\nDISEÑO WEB – DAVID SERRANO FERNÁNDEZ\r\nDESARROLLADOR WEB – EDUARDO CAMARA NUÑEZ', 'Archivo Municipal de Burgos\r\nBiblioteca Digital de Castilla y León\r\nBiblioteca Digital del Patrimonio Iberoamericano\r\nRed Digital de Colecciones de Museos de España\r\nReal Academia de Bellas Artes de San Fernando\r\nFototeca del Patrimonio Histórico\r\nInstituto Geográfico Nacional\r\nBiblioteca Nacional de España\r\nBiblioteca Nacional de Austria\r\nPortal de Archivos Españoles\r\nMuseo Nacional del Prado\r\nFundación Wikimedia\r\nBiblioteca Gallica\r\nDiario de Burgos\r\nInternet Archive\r\nEuropeana', 'Fernando Sánchez de la Rosa – Bicomunicación\r\nLa Cabaña Real de Carreteros\r\nJunta de Castilla y León\r\nFundación Cajacírculo\r\nJosé Javier Barrio\r\nRodrigo Castro\r\nJavier Garabito\r\nLa 8 Burgos\r\nEnerganova\r\nSelim Dincer\r\nAusín Sáinz\r\nGeocisa\r\nAibur', 'Juan de la Rubia\r\nEnrique Martín-Laguna\r\n\r\nSoundstripe Productions\r\n\r\nAcreage – Interim. Washed away. Caleb Etheridge – Don’t blink. Mirage. This corner of the world. Cody Martin – Moonstone. Jupiter rising. Old magic. Preservation of arts. The Price of Freedom.Colossus – The deep blue. Touch of light. Height of the mountain. Losing hope. Cloud atlas. Craig Allen – Fravel the spirit spring. Elision – Solfege. EVOE – Slow rise. Glacier. Lincoln Davis – Right of passage. Skeptical. Marie – Winter Magic. Markus Huber – Light inside. Moments – Life in wonder. Am I dreaming. It’s been a while. Outside the sky – Inside the hidden forest. Painted Modern Orchestra – Movement of the morning. Phillip Mount – The aura of glory.Shimmer – With love. Third Age – Frozen in time. Third Age – Tuatha de Danann. Wild Wonder – High class Klaus. Try as you might. Wicked Cinema – Kings and queens. Nobility.', 'La Catedral de Burgos. Ocho siglos de historia y arte – Diario de Burgos. René Jesús Payo Hernanz.\r\nLa Catedral de Burgos: patrimonio del mundo – Marcos Rico.\r\nCatedral de Burgos: la belleza recobrada: 25 años de restauraciones (1994-2019) – René Jesús Payo Hernanz / Juan Ruiz Carcedo.\r\nLa Catedral de Burgos : imagen, percepción y emblema de un templo patrimonio de la humanidad – José Matesanz del Barrio.\r\nLa Catedral y Burgos: pulcra es et decora : como nunca antes te lo han contado – Rafael Pampliega Pampliega; colabora, Enrique Hernando Arnáiz.\r\nLas vidrieras de la Catedral de Burgos – Mª Pilar Alonso Abad.\r\nTesoros matemáticos de la catedral de Burgos – Sociedad Castellana y Leonesa de Educación Matemática «Miguel de Guzmán».\r\nCathedral : the story of its construction – David Macaulay.\r\nArte completo del constructor de órgano – Mariano Tafall.\r\nCathedral: The Story of Its Construction – David Macaulay.\r\nGuide to the construction of Gothic details – F. Roesling.\r\nConstruction of Gothic Cathedrals – John Fitchen.', 'Cabildo Catedral de Burgos\r\nJuan Álvarez Quevedo\r\nÁlvaro Miguel\r\nIdoia larreachechu Gárate\r\nCarlos Izquierdo Yusta\r\nIsrael Pascual\r\nGonzalo Letona\r\nPatrimonio Nacional\r\nPolicía Local de Burgos\r\nMinisterio del Interior\r\nPrecisiondrone y Nokal Tech\r\nTaller de Restauración Fénix\r\nAibur\r\nVidrieras Barrio\r\nAntonio Canepa Oneto\r\nIsmael de la Iglesia\r\nCipriano Santidrián de la Granja\r\nÁrea de Comunicación Audiovisual UBU\r\nTVUBU\r\nEventos Galerías Exclusivas\r\nÁlvaro Platero Alonso\r\nTamara Valderas Pulgar\r\nJavier Barinagarrementería Eguía\r\nSociedad Castellana y Leonesa de Educación Matemática «Miguel de Guzmán»\r\nColegio el Círculo', 'Catedral de Burgos\r\nPalacio de Huérmeces. Fénix Restauración\r\nCanteras de Hontoria-Cubillo\r\nTaller Vidrieras Barrio\r\nIglesia del Hospital del Rey');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos_header`
--

CREATE TABLE `creditos_header` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `creditos_header`
--

INSERT INTO `creditos_header` (`identificador`, `titulo`, `subtitulo`, `texto`) VALUES
(1, 'Créditos y reconocimiento', 'La divulgación científica de la Catedral de Burgos', 'En este proyecto han participado varias instituciones, asociaciones, individuos y creativos….');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentaciongrafica`
--

CREATE TABLE `documentaciongrafica` (
  `identificador` int(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `documentaciongraficacategoria_nombrecategoria` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `documentaciongrafica`
--

INSERT INTO `documentaciongrafica` (`identificador`, `imagen`, `texto`, `documentaciongraficacategoria_nombrecategoria`) VALUES
(3, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_0000C529-400x284.jpg', 'La_Catedral_de_Burgos_0000C529', 1),
(4, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_0000C529-400x284.jpg', 'La_Catedral_de_Burgos_0001B8D1', 1),
(5, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_1820_Palacio_en_grabado-400x284.jpg', 'La_Catedral_de_Burgos_30-1', 1),
(6, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_1820_Palacio_en_grabado-400x284.jpg', 'La_Catedral_de_Burgos_1820_Palacio_en_grabado', 1),
(7, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_Vista_meridional_de_la_Catedral_de_Burgos_Material_grafico.jpg', 'La_Catedral_de_Burgos_Vista_panorámica_de_Burgos', 2),
(8, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_Vista_meridional_de_la_Catedral_de_Burgos_Material_grafico.jpg', 'La_Catedral_de_Burgos_Vista_panorámica_de_Burgos', 2),
(11, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_VISTA_EXTERIOR_DEL_CRUZERO_Material_grafico_de_la_Catedral_de_Burgos.jpg', 'La_Catedral_de_Burgos_VISTA_EXTERIOR_DEL_CRUZERO_Material_gráfico_de_la_Catedral_de_Burgos', 2),
(12, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_VISTA_EXTERIOR_DEL_CRUZERO_Material_grafico_de_la_Catedral_de_Burgos.jpg', 'La_Catedral_de_Burgos_VISTA_EXTERIOR_DEL_CRUZERO_Material_gráfico_de_la_Catedral_de_Burgos', 2),
(13, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_va_bcyl_normal_av-10089_0001.jpg', 'La_Catedral_de_Burgos_va_bcyl_normal_av-10089_0001', 3),
(14, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_va_bcyl_normal_av-10089_0001.jpg', 'La_Catedral_de_Burgos_va_bcyl_normal_av-10089_0001', 3),
(19, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/MNADMFFD12889_P.jpg', 'Cuadro de la catedral de Burgos', 4),
(20, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/MNADMFFD12889_P.jpg', 'Cuadro de la catedral de Burgos', 4),
(21, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/2022709_oai_fototeca_mcu_es_fototeca_CABRE_CABRE_2620-1.jpg', 'Interior de la catedral', 5),
(22, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/2022709_oai_fototeca_mcu_es_fototeca_CABRE_CABRE_2620-1.jpg', 'Interior de la catedral', 5),
(23, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/DCP-A-2527_P-400x284.jpg', 'Blanco y negro catedral de Burgos', 6),
(24, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/DCP-A-2527_P-400x284.jpg', 'Blanco y negro catedral de Burgos', 6),
(25, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/icon1083773-400x284.jpg', 'icon1083773', 7),
(26, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/icon1083773-400x284.jpg', 'icon1083773', 7),
(27, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/imgonline-com-ua-CompressToSize-XicVIGpLEy-400x284.jpg', 'Plano de Burgos antiguo', 8),
(28, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/imgonline-com-ua-CompressToSize-XicVIGpLEy-400x284.jpg', 'Plano de Burgos antiguo', 8),
(29, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/imgonline-com-ua-CompressToSize-XicVIGpLEy-400x284.jpg', 'Fachada de la Catedral de Burgos', 9),
(30, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/imgonline-com-ua-CompressToSize-XicVIGpLEy-400x284.jpg', 'Fachada de la Catedral de Burgos', 9),
(31, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/37156678-400x284.jpg', 'Gobierno de España. Ministerio de Educación, Cultura y Deporte.Archivo General de la Administración.', 10),
(32, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/37156678-400x284.jpg', 'Gobierno de España. Ministerio de Educación, Cultura y Deporte.Archivo General de la Administración.', 10),
(33, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/Andrea-del-Sarto-La-Sagrada-Familia-min-400x284.jpg', 'Andrea del Sarto – La Sagrada Familia', 11),
(34, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2021/09/Andrea-del-Sarto-La-Sagrada-Familia-min-400x284.jpg', 'Andrea del Sarto – La Sagrada Familia', 11),
(37, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_00000159-400x284.jpg', 'La_Catedral_de_Burgos_00000159', 12),
(38, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/La_Catedral_de_Burgos_00000159-400x284.jpg', 'La_Catedral_de_Burgos_00000159', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentaciongrafica_categorias`
--

CREATE TABLE `documentaciongrafica_categorias` (
  `identificador` int(255) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `documentaciongrafica_categorias`
--

INSERT INTO `documentaciongrafica_categorias` (`identificador`, `nombre_categoria`) VALUES
(1, 'Archivo Municipal de Burgos'),
(2, 'Biblioteca nacional'),
(3, 'bibliotecadigital.jcyl'),
(4, 'ceres'),
(5, 'Europeana'),
(6, 'Fototeca del Patrimonio Histórico'),
(7, 'Biblioteca Digital del Patrimonio Iberoamericano'),
(8, 'Instituto Geográfico Nacional'),
(9, 'Museo del Prado'),
(10, 'Portal de Archivos Españoles (PARES)'),
(11, 'Wikimedia Commons'),
(12, 'Österreichische Nationalbibliothek');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentaciongrafica_header`
--

CREATE TABLE `documentaciongrafica_header` (
  `identificador` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `documentaciongrafica_header`
--

INSERT INTO `documentaciongrafica_header` (`identificador`, `titulo`, `subtitulo`, `texto`) VALUES
(1, 'DOCUMENTACIÓN GRÁFICA', 'Fotos, ilustraciones, documentos,  planos y vídeos', 'Se realizó una profunda búsqueda de documentos, ilustraciones, fotos, planos y vídeos que consiguieran explicar los hitos del documental. A continuación se pueden ver algunos de los encontrados en los fondos y archivos documentales públicos.\r\n\r\nTodos están referenciados, el título enlaza con la institución correspondiente y propietaria. De esta manera más personas podrán disfrutar de los documentos.');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `examenbasededatos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `examenbasededatos` (
`numerador` varchar(255)
,`titulo` varchar(255)
,`subtitulo` varchar(255)
,`nombre` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expertos`
--

CREATE TABLE `expertos` (
  `identificador` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `resumen` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `expertos`
--

INSERT INTO `expertos` (`identificador`, `nombre`, `resumen`, `imagen`, `video`, `texto`) VALUES
(1, 'Antonio Cano', 'Campanero y relojero en la catedral de Burgos', 'https://www.youtube.com/watch?v=AH2BsxIB2ys', 'https://www.youtube.com/watch?v=AH2BsxIB2ys', 'Antonio Cano es campanero y relojero en la catedral de Burgos. Por sus manos han pasado muchas de las campanas y relojes de las iglesias de la provincia burgalesa, pero también de Canarias, donde ha pasado buen parte de su vida.\r\n\r\nA pesar de los cambios que ha sufrido su profesión, tanto por la automatización como porque muchas iglesias han dejado de tocar, sigue haciéndose cargo de las campanas y los relojes que siguen requiriendo mantenimiento, afinación y precisión.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos nos muestra algunos de los secretos más escondidos de El Papamoscas, el genial autómata del templo que abre y cierra la boca a las horas, acompañado de El Martinillo, su ayudante a los carrillones. Cano nos enseña los mecanismos de estos ingenios mecánicos, que necesitan de conservación y mantenimiento, además de ayudarnos a comprender cómo se sincronizan con los relojes del templo.\r\n\r\n Además, en su labor como campanero nos acompaña a la cima de la catedral para ver cómo se tocan las campanas, hoy ya automatizadas, su estado y mantenimiento y su futuro.'),
(2, 'Constantino de la Fuente', 'Catedrático de secundaria y doctor en matemáticas', 'https://www.youtube.com/watch?v=RHI6dUOBeVM', 'https://www.youtube.com/watch?v=RHI6dUOBeVM', 'Constantino de la Fuente es catedrático de secundaria y doctor en matemáticas, además de presidente fundador de la Sociedad Castellana y Leonesa de Educación matemática Miguel de Guzmán.\r\n\r\nHa desarrollado una intensa carrera investigadora con numerosos artículos en revistas científicas, además de conferencias en jornadas y congresos, todo ello mientras desarrollaba su actividad docente en el IES Cardenal López de Mendoza.  De la Fuente es autor de dos libros sobre matemáticas en la catedral de Burgos y ha destacado por su implicación en la divulgación de la cultura científica y matemática entre los más jóvenes.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos, De la Fuente nos guía por los secretos matemáticos que esconde el templo, tanto en su construcción como en su decoración. Proporciones como el número áureo, el rectángulo de plata o la proporción cordobesa se encuentran en algunos de los lugares más emblemáticos de la catedral, como el rosetón del Sarmental, la escalera dorada y el cimborrio la combinación de sus octógonos. \r\n\r\nEstas proporciones también pueden albergar un significado religioso, como en la vesica piscis, la intersección entre dos círculos que se utilizó como símbolo de Cristo entre los primeros creyentes. Todas estas proporciones, formas geométricas y algebraicas revelan una comprensión de las matemáticas muy precisa que llega a su punto más alto con la Escalera dorada. La obra de Diego de Siloé está inspirada en el renacimiento italiano y en su construcción alberga un sinfín de proporciones relacionadas que le permiten ser una solución arquitectónica brillante y, al mismo tiempo, una obra armónica que ha deslumbrado a arquitectos de todo el mundo.\r\n\r\nPor último, nos enseña que en las proporciones también puede haber ecos de otras culturas, como en el Cimborrio de la catedral, donde el arte mozárabe está presente en algunas de las relaciones y proporciones que conforman esta obra de arte barroca.'),
(3, 'Enrique Barrio', 'Maestro vidriero. Ha restaurado y recreado vidrieras en la catedral', 'https://www.youtube.com/watch?v=fQ_t4d-z7vM', 'https://www.youtube.com/watch?v=fQ_t4d-z7vM', 'Enrique Barrio es maestro vidriero y ha colaborado en la restauración y recreación de varias vidrieras en la catedral de Burgos. Con formación tanto en la técnica de las vidrieras como en estudios históricos sobre el vidrio, colabora habitualmente en publicaciones y proyectos científicos, así como en la difusión de su trabajo a través de conferencias para dar a conocer la importancia del mantenimiento y la conservación del patrimonio artístico.\r\n\r\nAdemás de en la catedral de Burgos, ha realizado actuaciones en las catedrales de Astorga, Mallorca, Orense y Cienfuegos (Cuba) y mantiene formas de trabajo tradicionales para la creación y conservación de los vitrales. Para realizar las labores de conservación, Enrique Barrio realiza un estudio de las características físicas y químicas de cada vidrio completo, sus materiales y los problemas de degradación y deterioro que presenta.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos, Barrio nos muestra su trabajo en el taller, en el que mantiene las formas de creación, pintura, corte y emplomado tradicionales y que resultan fundamentales para que se mantenga la esencia y el aspecto de las vidrieras tradicionales del templo, que, además, suponen una enorme muestra del recorrido histórico del arte de la vidriera a lo largo de los siglos. Además, nos enseña los criterios a la hora del mantenimiento y sustitución de los vitrales.'),
(4, 'Francisco del Hoyo', 'Restaurador de pinturas y policromías', 'https://www.youtube.com/watch?v=fQ_t4d-z7vM', 'https://www.youtube.com/watch?v=fQ_t4d-z7vM', 'Francisco Jesús del Hoyo es licenciado en Bellas Artes y restaurador de pinturas y policromías. Con una amplia experiencia de trabajo dentro de la Catedral de Burgos. Especialista en policromías de piedra y madera, lleva varios años trabajando en el interior de la seo burgalesa, además de mantener una intensa actividad como artista plástico.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos nos enseña la técnica de la policromía, el pintado sobre madera o piedra, y cómo se ha utilizado para ennoblecer materiales, hacerlos destacar o embellecer la decoración. Este proceso, diferente a la pintura sobre lienzo o el fresco, requiere de mucha atención y cuidados para evitar su deterioro.\r\n\r\nLos diferentes procesos químicos, la presencia de los humos de incienso y el propio paso del tiempo deterioran estas capas de pintura, muchas veces de tal forma que es imposible recuperar los colores originales. Sin embargo, un trabajo detallado permite sacar de nuevo a la luz la riqueza cromática de la catedral de Burgos.\r\n\r\nEl proceso de restauración de las obras va desde los análisis químicos hasta procesos de recuperación físicos y químicos, llegando incluso a utilizar el láser para limpiar la piedra no pintada o mezclas de componentes químicos para las superficies policromadas, muchas veces con una mezcla hecha a medida para cada detalle de la obra.\r\n\r\nDel Hoyo nos lleva de la mano por un proceso que une arte y ciencia en el que el restaurador trata de ser invisible y cubrir sus huellas para mantener la esencia original de cada pintura y escultura. '),
(5, 'Gabriel García Agudo', 'Experto en turismo', 'https://www.youtube.com/watch?v=1CeWkrwcLRY', 'https://www.youtube.com/watch?v=1CeWkrwcLRY', 'Gabriel García Agudo es el responsable del proyecto Patrimonio de la Luz y experto en turismo. Su empresa gestiona las canteras de las que se extrajo la piedra de la catedral de Burgos, convertidas ahora en un monumento natural que cada vez atrae a más turistas. García Aguado ha realizado trabajo de investigación sobre las canteras de Hontoria, que sirvieron de materia prima para muchas construcciones en la provincia de Burgos y conoce al detalle la forma de extracción y de trabajo dentro de estas canteras.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos nos muestra los lugares de extracción de esa piedra blanca tan característica de la seo burgalesa, guiándonos a través de las marcas de las picas de la extracción. Además, nos describe el transporte desde la sierra burgalesa hasta el templo, donde los diferentes talleres de cantería tallaban los bloques y los ornamentos necesarios.'),
(6, 'Itsaso Artetxe', 'Restauradora de arte', 'https://www.youtube.com/watch?v=1CeWkrwcLRY', 'https://www.youtube.com/watch?v=1CeWkrwcLRY', 'Itsaso Artetxe es restauradora de arte en la empresa Fénix Restauración, especializada en trabajo sobre madera. Lleva varios años trabajando en los bienes muebles de la catedral de Burgos, manteniendo y restaurando los elementos de madera.\r\n\r\nLa restauradora nos relata cómo la humedad de la catedral puede ser un gran enemigo de los bienes del templo. Junto a Mercedes Chico nos muestra los procesos de restauración y conservación que se llevan a cabo sobre los elementos artísticos de madera y los procesos químicos y físicos que se aplican sobre los mismos. Los procesos deben ser muy delicados y cuidados al detalle, con mucho respeto a las obras, a su valor y su delicado estado.'),
(7, 'Javier Garabito', 'Arquitecto de la catedral de Burgos y especialista en restauración del patrimonio', 'https://www.youtube.com/watch?v=HIXji4n0DbM', 'https://www.youtube.com/watch?v=HIXji4n0DbM', 'Javier Garabito López es profesor de la Universidad de Burgos y arquitecto de la catedral de Burgos y especialista en restauración del patrimonio y de bienes monumentales. Se ha encargado de diferentes proyectos de restauración en el templo burgalés, así como numerosas publicaciones y estudios científicos   a propósito de la restauración y conservación patrimonial.\r\n\r\nJunto a José Álvarez Cuesta, ha diseñado las obras de restauración de la catedra, estudiando su estructura, sus problemas potenciales y las necesidades de actuación sobre los muros, las torres y los diferentes elementos arquitectónicos que necesitaban una intervención.\r\n\r\nEn La ciencia que estudia la Catedral de Burgos nos describe las particularidades del estilo gótico, un estilo muy innovador con una aplicación sorprendente de la física y las cargas de peso sobre muros y arbotantes. Por ejemplo, nos describe las bóvedas como un “alarde” técnico, además de los medios de construcción disponibles durante el proceso de la catedral, medios muy limitados y de enorme riesgo, pero tremendamente efectivos.\r\n\r\nGarabito nos habla también de la caída del primer cimborrio, producida, seguramente, por problemas en la estructura. Así, el nuevo cimborrio, ya de estilo renacentista, refuerza esa estructura con unas columnas especialmente gruesas. Además, nos explica una de las grandes particularidades de la catedral de Burgos, que está construida en cuesta. Este desafío genera, además, un problema a la hora de acceder a la calle Fernán González resuelto con la Escalera dorada, además de otros problemas, como las humedades.\r\n\r\nEn definitiva, desde la arquitectura, la catedral de Burgos supone un prodigio, no sólo por su esbeltez sino también por los numerosos retos y desafíos que entraña su localización.\r\n\r\n '),
(8, 'José Javier Barrio', 'Restaurador y cantero en tallas de piedra y madera', 'https://www.youtube.com/watch?v=HIXji4n0DbM', 'https://www.youtube.com/watch?v=HIXji4n0DbM', 'Restaurador y fundador de Rehabilitaciones Aibur, trabaja como restaurador en la catedral de Burgos. Es especialista en la restauración y conservación de iglesias y catedrales, se ha especializado en el trabajo sobre piedra, tanto en su limpieza y restauración como en la consolidación de estructuras.\r\n\r\nTambién actúa como cantero en tallas de piedra y madera, además de realizar reproducciones de elementos que necesiten sustituciones. Se ha especializado en técnicas tradicionales de trabajo sobre piedra para mantener el aspecto y espíritu tanto de los elementos nuevos como de los restaurados. Además, lleva más de 20 años trabajando en la catedral de Burgos en tareas de restauración en torno a la piedra.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos, Javier Barrio nos guía en un recorrido por la extracción, transporte y colocación de los grandes sillares. Además, conoceremos las particularidades de la piedra de Hontoria, la utilizada en la construcción del templo, sus cualidades para su conservación y los peligros físicos y químicos, desde la climatología hasta la contaminación.\r\n\r\nAdemás, aprenderemos cómo se mantiene la catedral de Burgos en la actualidad, desde las técnicas tradicionales para sustituir elementos que mantienen todo el proceso y esencia utilizados para labrar la piedra original hasta las más modernas tecnologías para su limpieza y mantenimiento, tanto desde la física como desde la química.'),
(9, 'José Matesanz', 'Profesor en la Universidad de Burgos, historiador del arte y académico', 'https://www.youtube.com/watch?v=5EIj1CvdfAQ&t=1s', 'https://www.youtube.com/watch?v=5EIj1CvdfAQ&t=1s', 'José Matesanz es profesor en la Universidad de Burgos, historiador del arte y académico de la Institución Fernán González con numerosos trabajos vinculados al arte presente en la catedral de Burgos, sobre lo que ha escrito numerosos libros y artículos, además de ser especialista en patrimonio artístico.\r\n\r\nJunto a su compañero en la Universidad de Burgos, René Payo nos hará de guía en los diferentes capítulos de La ciencia que esconde la Catedral de Burgos, centrándose en el patrimonio artístico y religioso que alberga el templo burgalés. Como especialista, Matesanz nos explica las principales innovaciones arquitectónicas y artísticas que se van incorporando en la seo.\r\n\r\nDurante la serie, el profesor presenta cómo la catedral va más allá del culto religioso, y que debemos entender que se trata de un “monumento, un Patrimonio Mundial de la cultura y del arte”. Además, para Matesanz, la catedral es un símbolo de Burgos y no puede entenderse la ciudad sin su monumento más representativo.'),
(10, 'Mª Pilar Alonso', 'Especialista en el estudio de vidrieras y decoración en vidrio', 'https://www.youtube.com/watch?v=5EIj1CvdfAQ&t=1s', 'https://www.youtube.com/watch?v=5EIj1CvdfAQ&t=1s', 'Pilar Alonso es historiadora del arte, investigadora de la Universidad de Burgos, especialista en el estudio del patrimonio cultural y, especialmente, en el estudio de vidrieras y decoración en vidrio. Es doctora en Humanidades y profesora en Historia del Arte en la misma universidad. Ha publicado más de 60 trabajos centrados en temáticas tan variadas como las vidrieras de las catedrales, con especial atención a la de Burgos, la arquitectura religiosa o el patrimonio cultural del Camino de Santiago.\r\n\r\nHa recibido varios premios por la calidad y prestigio de sus investigaciones, como el reconocimiento del Consejo Social de la Universidad de Burgos, que premia el esfuerzo y la excelencia en la investigación, o el Premio Internacional Grupo Compostela-Xunta de Galicia por su contribución en la difusión de los valores del Camino de Santiago. Además, es directora de cursos internacionales de la Universidad de Burgos y de la Unidad Asociada de I+D+i al CSIC Vidrio y Materiales del Patrimonio Cultural (VIMPAC).\r\n\r\nEn La ciencia que esconde la Catedral de Burgos, Pilar Alonso nos acerca a la realidad de las vidrieras, un elemento que, más allá de ser meramente decorativo, supuso todo un cambio para la construcción de los edificios. Las catedrales góticas, al aligerar sus muros, abrieron grandes ventanales para dejar el paso de la luz y permitir que el interior de los templos se llenara de luminosidad. Las vidrieras fueron una solución técnica para cerrar estos ventanales, pero también albergan un enorme conocimiento científico en su creación y artístico y cultural que llenó de color los templos y que, además, albergaba historias de santos, virtudes y advertencias sobre los pecados. Además, nos explica en qué consiste el color llamado «Rojo Burgos», presente en la catedral y también en el monasterio de Las Huelgas.'),
(11, 'Matías Vicario', 'Archivero de la catedral de Burgos', '\r\n\r\n\r\nhttps://www.youtube.com/watch?v=kpY5zUkzSZM', 'https://www.youtube.com/watch?v=kpY5zUkzSZM', 'Matías Vicario Santamaría es el archivero de la catedral de Burgos. Como responsable del archivo se encarga de la catalogación, conservación y organización de todo el fondo documental del templo, que sigue incrementándose año tras año con la incorporación de nuevos documentos.\r\n\r\nComo archivero de la diócesis de Burgos, Matías Vicario es responsable de, por un lado, mantener el archivo organizado y en perfectas condiciones para que siga sirviendo como la memoria de la catedral, no sólo con documentos religiosos, sino con todo un registro de la vida civil a lo largo de los siglos.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos, Vicario nos introduce en los laberínticos pasillos del archivo catedralicio, para mostrarnos algunos de sus tesoros. Custodiados durante siglos, se guardan documentos desde el inicio de la diócesis de Burgos, en el año 1075.\r\n\r\nPara Vicario, la labor del archivo debe ser conservar toda esa documentación, pero también garantizar su acceso a la sociedad, especialmente a los investigadores. No sólo se conservan documentos relacionados con la diócesis y las prácticas religiosas, sino que se guardan documentos sobre economía, medicina y la vida en la ciudad, por lo que supone una rica fuente documental que su archivero lleva conservando durante los últimos 40 años.'),
(12, 'Mercedes Chico', 'Especialista en restauración de bienes culturales', 'https://www.youtube.com/watch?v=kpY5zUkzSZM', 'https://www.youtube.com/watch?v=kpY5zUkzSZM', 'Mercedes Chico es restauradora en la empresa Fénix Conservación. Junto a su compañera Itsaso Artexe, trabaja en la restauración y conservación de elementos de madera en la catedral de Burgos. Licenciada en Bellas Artes, se ha especializado en la restauración de bienes culturales y ha trabajado en varios templos de la provincia de Burgos. Además, desarrolla una intensa actividad artística al margen de su trabajo en restauración y conservación.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos nos habla sobre los problemas que entraña la humedad para la madera de los bienes muebles en el templo, especialmente ante los cambios de temperatura entre invierno y verano, provocando movimientos en la fibra y haciendo que la pintura se agriete, se deteriore y se caiga.\r\n\r\nEn la misma línea, nos explica cómo se realiza el proceso de restauración de una obra policromada de madera, con diferentes tratamientos físicos y químicos, no solo para recuperar su aspecto y propiedades, sino para tratar de que se mantenga en buenas condiciones durante más tiempo y haciéndolas más resistentes.\r\n\r\nChico nos enseña algunos de estos procesos, sus dificultades y cuándo son más adecuadas unas u otras intervenciones. Tras años trabajando en la catedral, considera que lo más importante al acometer un trabajo de restauración es conservar lo que ya tenemos, frenar el deterioro y mantener el original todo lo posible.'),
(13, 'Ángel Ortega', 'Arquitecto técnico y restaurador', 'https://www.youtube.com/watch?v=BHB9AAZVKPw', 'https://www.youtube.com/watch?v=BHB9AAZVKPw', 'Miguel Ángel Ortega es arquitecto técnico y licenciado en Bellas Artes con especialidad en restauración de obras de arte. Trabaja en la catedral de Burgos desde el año 2008 en diferentes obras, restauraciones y mejoras.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos explica cómo funciona el sistema de climatización y calefacción del templo, fundamental para los turistas, pero sobre todo para la conservación de todo el patrimonio interior. Mantener una temperatura constante y una humedad regulada es muy importante para evitar el deterioro de retablos, tallas, esculturas y cuadros, pero la implantación del sistema no fue nada fácil.\r\n\r\nComo relata Ortega, el sistema combina el suelo radiante con convectores de aire caliente que conectan con una caldera de agua caliente. La dificultad fue implantar este último sistema sin dañar o alterar el patrimonio. La solución llegó con la reutilización de un antiguo sistema de túneles ya existente y en el que se han podido introducir estos convectores de aire. Esta solución permite que la actuación sea reversible.\r\n\r\nPor último, nos enseña la solución que han encontrado para instalar un sistema anti incendios que, sin dañar el patrimonio ni a las personas que puedan encontrarse dentro del templo, elimina el oxigeno del ambiente para impedir que se propague el fuego.'),
(14, 'Óscar Laguna', 'Organero de la catedral de Burgos', 'https://www.youtube.com/watch?v=BHB9AAZVKPw', 'https://www.youtube.com/watch?v=BHB9AAZVKPw', 'Óscar Laguna es organero de la catedral de Burgos y, por tanto, responsable de los cuidados y la conservación de los diferentes órganos que se encuentran en el interior del templo. Se ha especializado en armonización y restauración de estos enormes instrumentos musicales y ha trabajado en varias catedrales e iglesias de todo el mundo.\r\n\r\nAdemás, ejerce como asesor en proyectos de restauración y conservación, es un experto en el funcionamiento del órgano a todos los niveles, desde el musical hasta los diferentes materiales con los que está construido.             \r\n\r\nEn La ciencia que esconde la Catedral de Burgos nos introduce en el interior de algunos de los grandes órganos de la seo burgalesa para que veamos muy de cerca cómo funcionan los enormes tubos que producen el sonido, los diferentes tipos en función de su forma, tamaño y materiales, además de las posibilidades de conservación que ofrecen los grandes órganos que, con un mantenimiento adecuado, pueden sonar durante siglos.\r\n\r\nAdemás, Laguna nos explica las características del sonido del órgano desde sus orígenes, así como el desarrollo científico que se esconde detrás de sus armonías y posibilidades acústicas, modificando sus acordes y armónicos para llenar el templo con su sonoridad, acompañar los coros y celebrar las liturgias de una manera más potente y completa.'),
(15, 'René Payo', 'Historiador del arte y profesor de la Universidad de Burgos', 'https://www.youtube.com/watch?v=LtriQdqWWqM', 'https://www.youtube.com/watch?v=LtriQdqWWqM', 'René Payo es profesor e investigador de la Universidad de Burgos, además de una de las máximas autoridades en lo que a la catedral de Burgos se refiere. Junto a José Matesanz es uno de los guías a lo largo de los capítulos, contextualizando cada una de las partes y señalando la complejidad de la catedral de Burgos.\r\n\r\nCatedrático en Historia del Arte, es director de la Institución Fernán González, dedicada al estudio de la historia, el patrimonio y el arte burgaleses. Con 24 libros y 45 artículos científicos publicados, lleva muchos años vinculado e investigando de la catedral de Burgos.\r\n\r\nEn La ciencia que esconde la Catedral de Burgos, Payo aparece en muchos de los capítulos para introducir, guiar y conducir los diferentes aspectos científicos de los que se dará cuenta en el episodio, gracias a un conocimiento global sobre el templo. Paso a paso, iremos descubriendo todo el conocimiento científico, técnico y tecnológico presente en el templo, un compendio de arte y ciencia que se ha ido actualizando y completando a lo largo de los siglos, reflejando un saber en piedra que quedará para las generaciones posteriores.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expertos_header`
--

CREATE TABLE `expertos_header` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `expertos_header`
--

INSERT INTO `expertos_header` (`identificador`, `titulo`, `subtitulo`, `texto`) VALUES
(0, 'Expertos', 'Los mejores guías', 'Quince expertos nos acompañan en la aventura de descubrir los misterios científicos y tecnológicos de la Catedral de Burgos. Profesores universitarios, profesionales de enorme prestigio, restauradoras, artesanos e, incluso, el archivero de la propia Catedral serán nuestros guías, aunandoun gran nivel de conocimientos con un lenguaje sencillo y para todos los públicos.\r\n\r\nEn los ocho episodios que conforman la serie, las entrevistas a los especialistas nos sirven tanto de hilo conductor como de fuente de conocimientos y explicaciones de materias tan diferentes como la arquitectura, los materiales, las vidrieras, las matemáticas presentes en el diseño y la decoración, la música, las más modernas tecnologías o el estado de conservación y futuro de la Catedral de Burgos. Un reparto de lujo para conocer al detalle la ciencia y la tecnología presentes en cada rincón del templo. ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expertos_main`
--

CREATE TABLE `expertos_main` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `expertos_main`
--

INSERT INTO `expertos_main` (`identificador`, `titulo`, `texto`) VALUES
(1, 'Nuestros expertos', 'Para este documental hemos contado con los mejores especialistas de cada campo. Algunos de ellos han dedicado toda una vida a desentrañar cada detalle del templo y su construcción, mientras otros trabajan a diario en el mantenimiento, conservación y restauración de la seo. Todos ellos contribuyen al excelente estado actual del monumento burgalés, que durante 800 años ha permanecido impasible y que, gracias a los cuidados y el cariño de los expertos, seguirá así muchos siglos más.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio`
--

CREATE TABLE `inicio` (
  `identificador` int(255) NOT NULL,
  `titulo_header` varchar(255) NOT NULL,
  `titulo_contenido` varchar(255) NOT NULL,
  `texto_contenido` text NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `video` varchar(500) NOT NULL,
  `titulo_contenidosecundario` varchar(255) NOT NULL,
  `texto_contenidosecundario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `inicio`
--

INSERT INTO `inicio` (`identificador`, `titulo_header`, `titulo_contenido`, `texto_contenido`, `imagen`, `video`, `titulo_contenidosecundario`, `texto_contenidosecundario`) VALUES
(1, 'La ciencia\r\nque esconde la\r\nCatedral de Burgos', 'La unión del arte y la ciencia', 'Durante 800 años, la Catedral de Burgos ha acumulado misterios, saberes y artes en su interior que son muestra de algunos de los avances científicos, técnicos y tecnológicos de diferentes épocas, desde la revolución del gótico hasta las más modernas tecnologías aplicadas a la seguridad y la restauración para mantener el edificio en la mejor de las condiciones.\r\n\r\nEn La Ciencia que esconde la Catedral de Burgos nos adentramos en los secretos de la construcción, decoración, mantenimiento y restauración de uno de los templos más bellos y reconocibles del mundo de la mano de quince especialistas que nos mostrarán cómo las diferentes ciencias y artes se han dado cita en el interior y exterior de la seo burgalesa, quince expertos que nos guiarán en este viaje gracias a sus conocimientos en matemáticas, física, química, historia del arte y los procesos de restauración aplicados en el exterior y el interior del templo.\r\n\r\nEste documental, producido por la Unidad de Cultura Científica e Innovación de la Universidad de Burgos (UCC+i) con la colaboración de la Fundación Española para la Ciencia y la Tecnología (FECYT) y el apoyo del Cabildo de Burgos quiere, además de celebrar el 800 cumpleaños del templo, mostrar la complejidad técnica de la construcción de la Catedral y la precisión en su construcción y desarrollo.', 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-arquitectura-min.jpg', 'https://youtu.be/nZKNranpFGw?si=biSYW8akglDLc1E5', 'La serie\r\nLa serie completa,\r\ndisponible aquí', 'A lo largo de los ocho capítulos conoceremos una de las partes que conforman el templo gótico, desde sus paredes hasta sus obras de arte, sus vidrieras, la música que llena la seo, las proporciones ocultas en su construcción y decoración o El Papamoscas, el autómata que abre la boca con las horas.\r\n\r\nToda la serie está disponible al completo y, además, en este sitio web podremos encontrar buena parte de la documentación gráfica, bibliografía, referencias y entrevistas utilizadas en su grabación, todas las entidades y colaboradores que han hecho posible su realización.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio_blog`
--

CREATE TABLE `inicio_blog` (
  `identificador` int(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `inicio_blog`
--

INSERT INTO `inicio_blog` (`identificador`, `imagen`, `titulo`, `subtitulo`) VALUES
(1, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-arquitectura-min.jpg', '\r\nCapítulo I: LA ARQUITECTURA', 'De los cimientos a las agujas'),
(2, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-piedra-min.jpg', 'Capítulo II: LA PIEDRA', 'La piel de la catedral'),
(3, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-Las-matematicas-min-1.jpg', 'Capítulo III: LAS MATEMÁTICAS', 'Geometrías sagradas'),
(4, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-pintura-min.jpg', 'Capítulo IV: LA PINTURA', 'Pigmentos desvelados'),
(5, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-Las-vidrieras-min.jpg', 'Capítulo V: LAS VIDRIERAS', 'Los colores de la luz'),
(6, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-musica-min.jpg', 'Capítulo VI: LA MÚSICA', 'Sonidos en armonía'),
(7, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-Las-tecnologias-modernas-min.jpg', 'Capítulo VII: LAS TECNOLOGÍAS MODERNAS', 'Mecanismos y sistemas eléctricos'),
(8, 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/06/La-ciencia-que-esconde-la-catedral-de-Burgos-La-conservacion-min.jpg', '\r\nCapítulo VIII: LA CONSERVACIÓN', 'Presente y futuro de la catedral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio_heroe`
--

CREATE TABLE `inicio_heroe` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagen_fondo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `inicio_heroe`
--

INSERT INTO `inicio_heroe` (`identificador`, `titulo`, `subtitulo`, `texto`, `imagen_fondo`) VALUES
(1, 'La ciencia\r\nque esconde la', 'Catedral de Burgos\r\n', 'https://ubuinvestiga.es/', 'https://ubuinvestiga.es/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_contenido`
--

CREATE TABLE `proyecto_contenido` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_contenido`
--

INSERT INTO `proyecto_contenido` (`identificador`, `titulo`, `texto`, `imagen`) VALUES
(1, 'Repercusión', 'La ciencia que esconde la Catedral de Burgos ha obtenido una gran repercusión, tanto institucional como a nivel mediático y de audiencia. El documental fue distinguido como mejor proyecto destacado en ComCiRed 2021, un galardón que premia los mejores trabajos de las unidades de cultura científicas de las universidades.\r\nLa serie se ha emitido en La 8 Burgos y La 2 de Televisión Española, además de en el canal de YouTube de UBUinvestiga, donde acumula más de 150.000 visitas. Su estreno concitó un enorme interés de medios locales y nacionales. 110 horas de grabación que han cristalizado en 8 episodios y disponibles de forma gratuita.', 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/comcired_2021.jpg'),
(2, 'Agentes', '\r\nPara la creación del documental han intervenido numerosos agentes. La producción ha corrido a cargo de la UCC+i de la Universidad de Burgos con el apoyo de la Fundación Española para la Ciencia y la Tecnología – Ministerio de Ciencia e Innovación y el Cabildo de la Catedral de Burgos, además de agradecer a numerosas instituciones y colaboradores.', 'https://cienciaycatedral.ubuinvestiga.es/wp-content/uploads/sites/14/2022/07/2021-09-02_2021-09-02_presentacion_documental_catedral_017_0.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_header`
--

CREATE TABLE `proyecto_header` (
  `identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura para la vista `examenbasededatos`
--
DROP TABLE IF EXISTS `examenbasededatos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `examenbasededatos`  AS SELECT `capitulos`.`numerador` AS `numerador`, `capitulos`.`titulo` AS `titulo`, `capitulos`.`subtitulo` AS `subtitulo`, `expertos`.`nombre` AS `nombre` FROM ((`capitulos_expertos` left join `capitulos` on(`capitulos_expertos`.`capitulos_nombre` = `capitulos`.`identificador`)) left join `expertos` on(`capitulos_expertos`.`expertos_nombre` = `expertos`.`identificador`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bibliografía`
--
ALTER TABLE `bibliografía`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `bibliografía_header`
--
ALTER TABLE `bibliografía_header`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `capitulos_expertos`
--
ALTER TABLE `capitulos_expertos`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `capitulosexperto_capitulos` (`capitulos_nombre`),
  ADD KEY `capitulosexpertos_expertos` (`expertos_nombre`);

--
-- Indices de la tabla `capitulos_header`
--
ALTER TABLE `capitulos_header`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `creditos_contenido`
--
ALTER TABLE `creditos_contenido`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `creditos_header`
--
ALTER TABLE `creditos_header`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `documentaciongrafica`
--
ALTER TABLE `documentaciongrafica`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `documentaciongraficaacategoria` (`documentaciongraficacategoria_nombrecategoria`);

--
-- Indices de la tabla `documentaciongrafica_categorias`
--
ALTER TABLE `documentaciongrafica_categorias`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `documentaciongrafica_header`
--
ALTER TABLE `documentaciongrafica_header`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `expertos`
--
ALTER TABLE `expertos`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `expertos_main`
--
ALTER TABLE `expertos_main`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `inicio`
--
ALTER TABLE `inicio`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `inicio_blog`
--
ALTER TABLE `inicio_blog`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `inicio_heroe`
--
ALTER TABLE `inicio_heroe`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `proyecto_contenido`
--
ALTER TABLE `proyecto_contenido`
  ADD PRIMARY KEY (`identificador`);

--
-- Indices de la tabla `proyecto_header`
--
ALTER TABLE `proyecto_header`
  ADD PRIMARY KEY (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bibliografía`
--
ALTER TABLE `bibliografía`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `bibliografía_header`
--
ALTER TABLE `bibliografía_header`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `capitulos_expertos`
--
ALTER TABLE `capitulos_expertos`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `capitulos_header`
--
ALTER TABLE `capitulos_header`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `creditos_contenido`
--
ALTER TABLE `creditos_contenido`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `creditos_header`
--
ALTER TABLE `creditos_header`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documentaciongrafica`
--
ALTER TABLE `documentaciongrafica`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `documentaciongrafica_categorias`
--
ALTER TABLE `documentaciongrafica_categorias`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `documentaciongrafica_header`
--
ALTER TABLE `documentaciongrafica_header`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `expertos`
--
ALTER TABLE `expertos`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `expertos_main`
--
ALTER TABLE `expertos_main`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inicio`
--
ALTER TABLE `inicio`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inicio_blog`
--
ALTER TABLE `inicio_blog`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `inicio_heroe`
--
ALTER TABLE `inicio_heroe`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proyecto_contenido`
--
ALTER TABLE `proyecto_contenido`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proyecto_header`
--
ALTER TABLE `proyecto_header`
  MODIFY `identificador` int(255) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capitulos_expertos`
--
ALTER TABLE `capitulos_expertos`
  ADD CONSTRAINT `capitulosexperto_capitulos` FOREIGN KEY (`capitulos_nombre`) REFERENCES `capitulos` (`identificador`),
  ADD CONSTRAINT `capitulosexpertos_expertos` FOREIGN KEY (`expertos_nombre`) REFERENCES `expertos` (`identificador`);

--
-- Filtros para la tabla `documentaciongrafica`
--
ALTER TABLE `documentaciongrafica`
  ADD CONSTRAINT `documentaciongraficaacategoria` FOREIGN KEY (`documentaciongraficacategoria_nombrecategoria`) REFERENCES `documentaciongrafica_categorias` (`identificador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
