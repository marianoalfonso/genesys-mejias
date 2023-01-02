-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-12-2022 a las 13:19:38
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

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
CREATE PROCEDURE `cambiarDni` (IN `dniOrigen` INT, IN `dniTarget` INT)  BEGIN

    update pacientes set pacientes.dni = dniTarget where pacientes.dni = dniOrigen;
    update turnos set turnos.dni = dniTarget where turnos.dni = dniOrigen;
    update cuentacorrientelog set ctacte_dni = dniTarget where ctacte_dni = dniOrigen;

END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `obtenerDni`$$
CREATE FUNCTION `obtenerDni` () RETURNS INT BEGIN
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
  `id` tinyint NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL DEFAULT 'sin datos',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `coberturas`
--

INSERT INTO `coberturas` (`id`, `nombre`) VALUES
(0, 'particular'),
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
  `progresionDNI` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`progresionDNI`) VALUES
(11111187);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentacorrientelog`
--

DROP TABLE IF EXISTS `cuentacorrientelog`;
CREATE TABLE IF NOT EXISTS `cuentacorrientelog` (
  `ctacte_dni` int NOT NULL COMMENT 'dni del paciente',
  `ctacte_idTurno` int NOT NULL,
  `ctacte_idProfesional` int NOT NULL,
  `ctaCte_fecha` date NOT NULL,
  `ctacte_ingresosDeuda` decimal(10,0) NOT NULL,
  `ctaCte_importePago` decimal(10,0) NOT NULL,
  `ctacte_importeSaldo` decimal(10,0) NOT NULL,
  `ctacte_descripcion` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apellido` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `dni` int NOT NULL,
  `fec_nac` date NOT NULL,
  `cobertura` tinyint NOT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `profesion` text,
  `saldo` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  KEY `FK_persona_cobertura_idx` (`cobertura`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
CREATE TABLE IF NOT EXISTS `profesionales` (
  `prf_id` int NOT NULL AUTO_INCREMENT,
  `prf_nombre` varchar(60) NOT NULL,
  `prf_bloqueo` int DEFAULT NULL COMMENT 'dni del profesional que tiene bloqueada la agenda',
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
  `idProfesional` tinyint NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `profesional` int NOT NULL,
  `dni` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `textColor` varchar(7) CHARACTER SET utf8mb4 DEFAULT NULL,
  `backgroundColor` varchar(7) CHARACTER SET utf8mb4 DEFAULT NULL,
  `estado` char(3) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usr_dni` int NOT NULL,
  `usr_nombre` varchar(60) NOT NULL,
  `usr_password` varchar(45) NOT NULL,
  `usr_tipo` tinyint NOT NULL,
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
  `tipo_id` tinyint NOT NULL,
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
