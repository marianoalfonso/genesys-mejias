-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-12-2022 a las 10:42:20
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coberturas`
--

DROP TABLE IF EXISTS `coberturas`;
CREATE TABLE IF NOT EXISTS `coberturas` (
  `id` tinyint NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `coberturas`
--

INSERT INTO `coberturas` (`id`, `nombre`) VALUES
(1, 'Osde 210'),
(2, 'Osde 310'),
(3, 'Osde 410'),
(4, 'Osde 510');

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
  `ctaCte_importePago` decimal(10,0) NOT NULL,
  `ctacte_importeSaldo` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cuentacorrientelog`
--

INSERT INTO `cuentacorrientelog` (`ctacte_dni`, `ctacte_idTurno`, `ctacte_idProfesional`, `ctaCte_fecha`, `ctaCte_importePago`, `ctacte_importeSaldo`) VALUES
(11111145, 62, 3, '2022-11-21', '5000', '35000'),
(11111145, 59, 1, '2022-11-23', '0', '0'),
(23443445, 57, 1, '2022-11-23', '0', '0'),
(23443445, 57, 1, '2022-11-23', '0', '0'),
(23443445, 57, 1, '2022-11-23', '0', '0'),
(11111145, 70, 1, '2022-11-24', '0', '0'),
(11111145, 74, 1, '2022-12-02', '0', '0');

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
  `profesion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `saldo` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  KEY `FK_persona_cobertura_idx` (`cobertura`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `dni`, `fec_nac`, `cobertura`, `numero`, `telefono`, `direccion`, `profesion`, `saldo`) VALUES
(9, 'Messi', 'Lionel', 23544334, '1974-03-07', 4, '334556433', '0534-234238', 'paris le gaule 3254', 'deportista profesional', '175000'),
(10, 'Brown', 'Diego', 23234223, '1997-08-10', 3, '2234999827890', '011-66544566', 'santa fe 3234', 'obrero de la metalurgia', '0'),
(13, 'Lewandosky', 'Robert', 23445443, '1982-07-12', 4, '232125346235', '2343-22343211', 'sivorei 234', 'deportista profesional', '230000');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `profesionales`
--

INSERT INTO `profesionales` (`prf_id`, `prf_nombre`, `prf_bloqueo`) VALUES
(1, 'profesional A', NULL),
(2, 'profesional B', NULL),
(3, 'profesional C', NULL);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `textColor` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `backgroundColor` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` char(3) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `profesional`, `dni`, `title`, `description`, `start`, `end`, `textColor`, `backgroundColor`, `estado`) VALUES
(1, 1, 33444555, 'test', 'test', '2022-11-19 10:00:00', '2022-11-19 11:00:00', NULL, NULL, '1'),
(57, 1, 23443445, 'Martinez Laura', '', '2022-11-19 11:00:00', '2022-11-19 12:00:00', '#ffffff', '#3788d8', 'pre'),
(60, 1, 23443445, 'Martinez Laura', '', '2022-11-20 15:00:00', '2022-11-20 15:00:00', '#ffffff', '#37d757', ''),
(61, 1, 11111145, 'Martin Orlando', '', '2022-11-19 14:00:00', '2022-11-19 14:00:00', '#ffffff', '#37d74a', ''),
(62, 3, 11111145, 'Martin Orlando', 'tratamiento de conducto', '2022-11-20 12:00:00', '2022-11-20 13:00:00', '#ffffff', '#3788d8', ''),
(66, 3, 27433223, 'Messi Lionel', '', '2022-11-19 13:00:00', '2022-11-19 14:00:00', '#ffffff', '#d737c2', 'pre'),
(67, 3, 23443445, 'Martinez Laura', '', '2022-11-19 12:00:00', '2022-11-19 13:00:00', '#ffffff', '#52d737', ''),
(68, 3, 34222333, 'Perez Maria', '', '2022-11-19 14:00:00', '2022-11-19 15:00:00', '#ffffff', '#3788d8', ''),
(69, 1, 23443445, 'Martinez Laura', '', '2022-11-22 08:00:00', '2022-11-22 09:00:00', '#ffffff', '#3788d8', ''),
(70, 1, 27433223, 'Messi Lionel', '', '2022-11-25 14:00:00', '2022-11-25 15:00:00', '#ffffff', '#3788d8', 'pre'),
(71, 1, 23443445, 'Martinez Laura', '', '2022-11-25 16:00:00', '2022-11-25 17:00:00', '#ffffff', '#3788d8', ''),
(73, 1, 34222333, 'Perez Maria', '', '2022-11-25 15:00:00', '2022-11-25 16:00:00', '#ffffff', '#d74237', ''),
(75, 1, 27433223, 'Messi Lionel', '', '2022-11-28 08:00:00', '2022-11-28 09:00:00', '#ffffff', '#3788d8', ''),
(76, 1, 34222333, 'Perez Maria', '', '2022-11-30 08:00:00', '2022-11-30 09:00:00', '#ffffff', '#d7373f', ''),
(77, 1, 23443445, 'Martinez Laura', '', '2022-11-29 08:00:00', '2022-11-29 08:00:00', '#ffffff', '#3788d8', ''),
(79, 1, 11111145, 'Martin Orlando', '', '2022-11-30 09:00:00', '2022-11-30 10:00:00', '#ffffff', '#3788d8', ''),
(80, 1, 11111145, 'Martin Orlando', '', '2022-11-30 11:00:00', '2022-11-30 12:00:00', '#ffffff', '#3788d8', ''),
(81, 1, 23544334, 'Messi Lionel', '', '2022-11-30 12:00:00', '2022-11-30 13:00:00', '#ffffff', '#3788d8', ''),
(83, 1, 23544334, 'Messi Lionel', '', '2022-11-30 15:00:00', '2022-11-30 16:00:00', '#ffffff', '#7f37d7', ''),
(84, 1, 23544334, 'Messi Lionel', '', '2022-11-30 17:00:00', '2022-11-30 18:00:00', '#ffffff', '#3788d8', ''),
(85, 1, 23544334, 'Messi Lionel', '', '2022-11-30 20:00:00', '2022-11-30 21:00:00', '#ffffff', '#3788d8', ''),
(86, 1, 23544334, 'Messi Lionel', '', '2022-11-30 18:00:00', '2022-11-30 19:00:00', '#ffffff', '#d75737', ''),
(87, 1, 23544334, 'Messi Lionel', '', '2022-11-30 14:00:00', '2022-11-30 15:00:00', '#ffffff', '#3788d8', ''),
(89, 1, 23544334, 'Messi Lionel', 'sobreturno control por dolor de muelas', '2022-12-01 10:30:00', '2022-12-01 11:00:00', '#ffffff', '#d73737', ''),
(90, 1, 11111145, 'Martin Orlando', '', '2022-12-01 11:00:00', '2022-12-01 11:45:00', '#ffffff', '#3788d8', ''),
(91, 1, 11111145, 'Martin Orlando', '', '2022-12-01 12:00:00', '2022-12-01 13:00:00', '#ffffff', '#3788d8', ''),
(92, 1, 22334332, 'Serruto Maria', 'tratamiento de conducto', '2022-12-01 14:00:00', '2022-12-01 15:00:00', '#ffffff', '#d73737', ''),
(93, 1, 23234223, 'Brown Diego', '', '2022-11-29 12:00:00', '2022-11-29 13:00:00', '#ffffff', '#3788d8', ''),
(94, 1, 23234223, 'Brown Diego', '', '2022-11-28 13:00:00', '2022-11-28 14:00:00', '#ffffff', '#3788d8', ''),
(95, 1, 23234223, 'Brown Diego', '', '2022-12-06 10:00:00', '2022-12-06 11:00:00', '#ffffff', '#3788d8', ''),
(96, 1, 23234223, 'Brown Diego', '', '2022-12-06 11:00:00', '2022-12-06 12:00:00', '#ffffff', '#3788d8', ''),
(97, 1, 23234223, 'Brown Diego', '', '2022-12-02 13:00:00', '2022-12-02 14:00:00', '#ffffff', '#3788d8', ''),
(99, 3, 23445443, 'Lewandosky Robert', 'control por dolor de muela', '2022-11-30 10:00:00', '2022-11-30 11:00:00', '#ffffff', '#3788d8', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usr_dni`, `usr_nombre`, `usr_password`, `usr_tipo`) VALUES
(22925061, 'Mariano Alfonso', 'test1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tipo`
--

DROP TABLE IF EXISTS `usuarios_tipo`;
CREATE TABLE IF NOT EXISTS `usuarios_tipo` (
  `tipo_id` tinyint NOT NULL,
  `tipo_descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
