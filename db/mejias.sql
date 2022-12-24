-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-12-2022 a las 15:44:00
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mejias`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `cambiarDni`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarDni` (IN `dniOrigen` INT, IN `dniTarget` INT)  BEGIN

    update pacientes set pacientes.dni = dniTarget where pacientes.dni = dniOrigen;
    update turnos set turnos.dni = dniTarget where turnos.dni = dniOrigen;
    update cuentacorrientelog set ctacte_dni = dniTarget where ctacte_dni = dniOrigen;

END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `obtenerDni`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `obtenerDni` () RETURNS INT(11) BEGIN
	DECLARE proximoDni int;
    update config set progresionDni = progresionDni + 1;
	select progresionDni into proximoDni from config;
	return proximoDni;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coberturas`
--

DROP TABLE IF EXISTS `coberturas`;
CREATE TABLE IF NOT EXISTS `coberturas` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL DEFAULT 'sin datos',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `coberturas`
--

INSERT INTO `coberturas` (`id`, `nombre`) VALUES
(0, 'sin datos'),
(1, 'Osde 210'),
(2, 'Osde 310'),
(3, 'Osde 410'),
(4, 'Osde 510'),
(5, 'Poder Judicial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `progresionDNI` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`progresionDNI`) VALUES
(11111166);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentacorrientelog`
--

DROP TABLE IF EXISTS `cuentacorrientelog`;
CREATE TABLE IF NOT EXISTS `cuentacorrientelog` (
  `ctacte_dni` int(11) NOT NULL COMMENT 'dni del paciente',
  `ctacte_idTurno` int(11) NOT NULL,
  `ctacte_idProfesional` int(11) NOT NULL,
  `ctaCte_fecha` date NOT NULL,
  `ctaCte_importePago` decimal(10,0) NOT NULL,
  `ctacte_importeSaldo` decimal(10,0) NOT NULL,
  `ctacte_descripcion` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentacorrientelog`
--

INSERT INTO `cuentacorrientelog` (`ctacte_dni`, `ctacte_idTurno`, `ctacte_idProfesional`, `ctaCte_fecha`, `ctaCte_importePago`, `ctacte_importeSaldo`, `ctacte_descripcion`) VALUES
(342223342, 0, 0, '2022-10-10', '0', '0', 'test'),
(342223342, 0, 0, '2022-12-19', '0', '0', 'test'),
(342223342, 0, 0, '2022-12-19', '0', '99', 'test'),
(342223342, 0, 0, '2022-12-19', '55', '0', 'ooo'),
(342223342, 0, 0, '2022-12-19', '645', '0', 'hola'),
(88888881, 0, 0, '2022-12-19', '100000', '0', 'implante premolar anterior'),
(11111145, 0, 0, '2022-12-19', '50000', '0', 'limpieza de sarro'),
(88888881, 0, 0, '2022-12-19', '10000', '0', 'test'),
(11111145, 0, 0, '2022-12-19', '150000', '0', 'implante premolar anterior');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `dni` int(11) NOT NULL,
  `fec_nac` date NOT NULL,
  `cobertura` tinyint(4) NOT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `profesion` text,
  `saldo` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  KEY `FK_persona_cobertura_idx` (`cobertura`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `dni`, `fec_nac`, `cobertura`, `numero`, `telefono`, `direccion`, `profesion`, `saldo`) VALUES
(2, 'Perez', 'Maria', 342223342, '1984-02-12', 1, '443223451111', '011-44532345', 'san martin 3243', 'verdulera', '21949'),
(3, 'Martinez', 'Laura', 23443445, '1994-11-23', 4, '21123444443', '011-33432233', 'alvarez jonte 2344', 'docente', '5'),
(7, 'Martin', 'Orlando', 11111145, '1998-12-10', 3, '2222222222', '011-658765876', 'orcas 883', 'estudiante', '150000'),
(8, 'Messi', 'Lionel', 88888881, '1992-05-03', 4, '223444543', '023-44535246', 'arco del triunfo 3425', 'deportista profesional', '180000'),
(9, 'Luter', 'Laureano', 12887663, '1957-02-04', 2, '4443221114', '011-44536556', 'olleros 1233', 'jubilado', '50000'),
(12, 'Eleno', 'Mariel', 22332445, '1972-09-05', 2, '223454443564', '011-55211125', 'Superi 2342', 'peluquera', '0'),
(13, 'Brown', 'Lorena', 87658658, '1984-08-10', 2, '8675865875', '01187658765', 'cramer 234', 'docente', '0'),
(14, 'Olaguer', 'Rita', 34554334, '0000-00-00', 1, '', '', '', '', '0'),
(15, 'Di Maria', 'Angel', 11111152, '1987-02-10', 1, '', '', '', '', '0'),
(17, 'Tifani', 'Rita', 11111165, '2022-12-19', 1, '', '', '', '', '0'),
(18, '', '', 11111166, '2022-12-19', 0, '', '', '', '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
CREATE TABLE IF NOT EXISTS `profesionales` (
  `prf_id` int(11) NOT NULL AUTO_INCREMENT,
  `prf_nombre` varchar(60) NOT NULL,
  `prf_bloqueo` int(11) DEFAULT NULL COMMENT 'dni del profesional que tiene bloqueada la agenda',
  PRIMARY KEY (`prf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesionales`
--

INSERT INTO `profesionales` (`prf_id`, `prf_nombre`, `prf_bloqueo`) VALUES
(4, 'Megias Gustavo', NULL),
(6, 'Carbajales Ariel', NULL),
(7, 'Campuzano Sara', NULL),
(8, 'Stochyk Guillermina', NULL),
(9, 'Boragina Pamela', NULL),
(10, 'Cenizo Antonella', NULL),
(11, 'Caligiuri Martina', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionaleshorarios`
--

DROP TABLE IF EXISTS `profesionaleshorarios`;
CREATE TABLE IF NOT EXISTS `profesionaleshorarios` (
  `idProfesional` tinyint(4) NOT NULL,
  `lunesDesde` time NOT NULL DEFAULT '08:00:00',
  `lunesHasta` time NOT NULL DEFAULT '19:00:00',
  `martesDesde` time NOT NULL DEFAULT '08:00:00',
  `martesHasta` time NOT NULL DEFAULT '19:00:00',
  `miercolesDesde` time NOT NULL DEFAULT '08:00:00',
  `miercolesHasta` time NOT NULL DEFAULT '19:00:00',
  `juevesDesde` time NOT NULL DEFAULT '08:00:00',
  `juevesHasta` time NOT NULL DEFAULT '19:00:00',
  `viernesDesde` time NOT NULL DEFAULT '08:00:00',
  `viernesHasta` time NOT NULL DEFAULT '19:00:00',
  PRIMARY KEY (`idProfesional`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesionaleshorarios`
--

INSERT INTO `profesionaleshorarios` (`idProfesional`, `lunesDesde`, `lunesHasta`, `martesDesde`, `martesHasta`, `miercolesDesde`, `miercolesHasta`, `juevesDesde`, `juevesHasta`, `viernesDesde`, `viernesHasta`) VALUES
(1, '08:00:00', '19:00:00', '08:00:00', '19:00:00', '08:00:00', '19:00:00', '08:00:00', '19:00:00', '08:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

DROP TABLE IF EXISTS `turnos`;
CREATE TABLE IF NOT EXISTS `turnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profesional` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `textColor` varchar(7) CHARACTER SET utf8mb4 DEFAULT NULL,
  `backgroundColor` varchar(7) CHARACTER SET utf8mb4 DEFAULT NULL,
  `estado` char(3) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `profesional`, `dni`, `title`, `description`, `start`, `end`, `textColor`, `backgroundColor`, `estado`) VALUES
(114, 6, 11111145, 'Martin Orlando', '', '2022-12-20 11:00:00', '2022-12-20 12:00:00', '#ffffff', '#3788d8', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usr_dni` int(11) NOT NULL,
  `usr_nombre` varchar(60) NOT NULL,
  `usr_password` varchar(45) NOT NULL,
  `usr_tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`usr_dni`),
  KEY `fk_usuario_tipo_idx` (`usr_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usr_dni`, `usr_nombre`, `usr_password`, `usr_tipo`) VALUES
(20883029, 'Gabriela', '20883029', 1),
(22925061, 'Mariano Alfonso', 'test1234', 1),
(28709126, 'Andrea', '28709126', 1),
(37064958, 'Yamila', '37064958', 1),
(41745543, 'Sol', '41745543', 1),
(44451719, 'Malena', '44451719', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tipo`
--

DROP TABLE IF EXISTS `usuarios_tipo`;
CREATE TABLE IF NOT EXISTS `usuarios_tipo` (
  `tipo_id` tinyint(4) NOT NULL,
  `tipo_descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_tipo`
--

INSERT INTO `usuarios_tipo` (`tipo_id`, `tipo_descripcion`) VALUES
(1, 'administrador'),
(2, 'administrativo'),
(3, 'profesional');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `FK_persona_cobertura` FOREIGN KEY (`cobertura`) REFERENCES `coberturas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`usr_tipo`) REFERENCES `usuarios_tipo` (`tipo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
