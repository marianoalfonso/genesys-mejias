-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-12-2022 a las 23:25:38
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
(27433223, 66, 3, '2022-11-21', '5000', '35000'),
(11111145, 59, 1, '2022-11-23', '0', '0'),
(23443445, 57, 1, '2022-11-23', '0', '0'),
(23443445, 57, 1, '2022-11-23', '0', '0'),
(23443445, 57, 1, '2022-11-23', '0', '0'),
(27433223, 70, 1, '2022-11-24', '0', '0'),
(34222333, 79, 1, '2022-12-04', '5000', '45000'),
(34222333, 73, 1, '2022-12-04', '7000', '38000'),
(27433223, 83, 1, '2022-12-04', '5000', '55000'),
(27433223, 84, 1, '2022-12-04', '15000', '40000'),
(27433223, 85, 1, '2022-12-04', '20000', '80000'),
(27433223, 86, 1, '2022-12-04', '30000', '50000'),
(23443445, 60, 1, '2022-12-04', '0', '0'),
(23443445, 67, 3, '2022-12-04', '5', '5'),
(11111145, 61, 1, '2022-12-04', '0', '0'),
(23443445, 71, 1, '2022-12-04', '0', '5'),
(23443445, 71, 1, '2022-12-04', '0', '5'),
(34222333, 77, 1, '2022-12-04', '10000', '30000'),
(23443445, 76, 1, '2022-12-04', '0', '5'),
(11111145, 62, 3, '2022-12-05', '0', '0'),
(11111145, 74, 1, '2022-12-05', '0', '0'),
(34222333, 68, 3, '2022-12-05', '0', '30000'),
(12887663, 89, 1, '2022-12-05', '20000', '100000'),
(12887663, 88, 2, '2022-12-05', '50000', '50000'),
(34222333, 77, 1, '2022-12-05', '10000', '20000');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `dni`, `fec_nac`, `cobertura`, `numero`, `telefono`, `direccion`, `profesion`, `saldo`) VALUES
(2, 'Perez', 'Maria', 34222333, '1984-02-12', 1, '443223451111', '011-44532345', 'san martin 3243', 'verdulera', '20000'),
(3, 'Martinez', 'Laura', 23443445, '1994-11-23', 4, '21123444443', '011-33432233', 'alvarez jonte 2344', 'docente', '5'),
(7, 'Martin', 'Orlando', 11111145, '1998-12-10', 3, '2222222222', '011-658765876', 'orcas 883', 'estudiante', '0'),
(8, 'Messi', 'Lionel', 27433223, '1992-05-03', 4, '223444543', '023-44535246', 'arco del triunfo 3425', 'deportista profesional', '170000'),
(9, 'Luter', 'Laureano', 12887663, '1957-02-04', 2, '4443221114', '011-44536556', 'olleros 1233', 'jubilado', '50000'),
(12, 'Eleno', 'Mariel', 22332445, '1972-09-05', 2, '223454443564', '011-55211125', 'Superi 2342', 'peluquera', '0'),
(13, 'Brown', 'Lorena', 87658658, '1984-08-10', 2, '8675865875', '01187658765', 'cramer 234', 'docente', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `profesional`, `dni`, `title`, `description`, `start`, `end`, `textColor`, `backgroundColor`, `estado`) VALUES
(1, 1, 33444555, 'test', 'test', '2022-11-19 10:00:00', '2022-11-19 11:00:00', NULL, NULL, '1'),
(57, 1, 23443445, 'Martinez Laura', '', '2022-11-19 11:00:00', '2022-11-19 12:00:00', '#ffffff', '#3788d8', 'pre'),
(59, 1, 11111145, 'Martin Orlando', '', '2022-11-20 14:00:00', '2022-11-20 15:00:00', '#ffffff', '#d7374f', 'aSa'),
(60, 1, 23443445, 'Martinez Laura', '', '2022-11-20 15:00:00', '2022-11-20 15:00:00', '#ffffff', '#37d757', 'pre'),
(61, 1, 11111145, 'Martin Orlando', '', '2022-11-19 14:00:00', '2022-11-19 14:00:00', '#ffffff', '#37d74a', 'aSa'),
(62, 3, 11111145, 'Martin Orlando', '', '2022-11-20 12:00:00', '2022-11-20 13:00:00', '#ffffff', '#3788d8', 'aCa'),
(66, 3, 27433223, 'Messi Lionel', '', '2022-11-19 13:00:00', '2022-11-19 14:00:00', '#ffffff', '#d737c2', 'pre'),
(67, 3, 23443445, 'Martinez Laura', '', '2022-11-19 12:00:00', '2022-11-19 13:00:00', '#ffffff', '#52d737', 'pre'),
(68, 3, 34222333, 'Perez Maria', '', '2022-11-19 14:00:00', '2022-11-19 15:00:00', '#ffffff', '#3788d8', 'aCa'),
(70, 1, 27433223, 'Messi Lionel', '', '2022-11-25 14:00:00', '2022-11-25 15:00:00', '#ffffff', '#3788d8', 'pre'),
(71, 1, 23443445, 'Martinez Laura', '', '2022-11-25 16:00:00', '2022-11-25 17:00:00', '#ffffff', '#3788d8', 'pre'),
(73, 1, 34222333, 'Perez Maria', '', '2022-11-25 15:00:00', '2022-11-25 16:00:00', '#ffffff', '#d74237', 'pre'),
(74, 1, 11111145, 'Martin Orlando', '', '2022-11-25 17:00:00', '2022-11-25 18:00:00', '#ffffff', '#62d737', 'pre'),
(75, 1, 27433223, 'Messi Lionel', '', '2022-11-24 12:00:00', '2022-11-24 13:00:00', '#ffffff', '#3788d8', 'pre'),
(76, 1, 23443445, 'Martinez Laura', '', '2022-11-25 11:00:00', '2022-11-25 12:00:00', '#ffffff', '#3788d8', 'aSa'),
(79, 1, 34222333, 'Perez Maria', 'toma de muestra maxilar inferior', '2022-12-05 10:00:00', '2022-12-05 11:00:00', '#ffffff', '#d7d237', 'pre'),
(80, 0, 27433223, 'Messi Lionel', '', '2022-11-29 13:00:00', '2022-11-29 14:00:00', '#ffffff', '#3788d8', ''),
(81, 1, 27433223, 'Messi Lionel', '', '2022-11-29 11:00:00', '2022-11-29 12:00:00', '#ffffff', '#3788d8', 'pre'),
(82, 1, 27433223, 'Messi Lionel', '', '2022-11-29 12:00:00', '2022-11-29 13:00:00', '#ffffff', '#3788d8', 'pre'),
(83, 1, 27433223, 'Messi Lionel', '', '2022-11-29 13:00:00', '2022-11-29 14:00:00', '#ffffff', '#3788d8', 'pre'),
(84, 1, 27433223, 'Messi Lionel', '', '2022-11-29 15:00:00', '2022-11-29 16:00:00', '#ffffff', '#3788d8', 'pre'),
(85, 1, 27433223, 'Messi Lionel', '', '2022-11-29 16:00:00', '2022-11-29 17:00:00', '#ffffff', '#3788d8', 'pre'),
(86, 1, 27433223, 'Messi Lionel', '', '2022-11-29 17:00:00', '2022-11-29 18:00:00', '#ffffff', '#3788d8', 'pre'),
(88, 2, 12887663, 'Luter Laureano', 'inicio tratamiento implante segundo molar', '2022-12-05 10:00:00', '2022-12-05 11:00:00', '#ffffff', '#3788d8', 'pre'),
(89, 1, 12887663, 'Luter Laureano', 'control de rutina', '2022-11-30 14:00:00', '2022-11-30 15:00:00', '#ffffff', '#3788d8', 'pre'),
(90, 2, 23443445, 'Martinez Laura', 'dolor de muelas (sobreturno)', '2022-12-06 11:00:00', '2022-12-06 12:00:00', '#ffffff', '#d73737', ''),
(91, 1, 27433223, 'Messi Lionel', '', '2022-11-30 15:00:00', '2022-11-30 16:00:00', '#ffffff', '#3788d8', ''),
(95, 1, 22332445, 'Eleno Mariel', 'control por dolor de muela', '2022-12-06 11:00:00', '2022-12-06 12:00:00', '#ffffff', '#3788d8', ''),
(96, 2, 11111145, 'Martin Orlando', '', '2022-11-30 10:00:00', '2022-11-30 11:00:00', '#ffffff', '#3788d8', ''),
(97, 1, 12887663, 'Luter Laureano', 'control de rutina', '2022-12-06 12:00:00', '2022-12-06 11:00:00', '#ffffff', '#3788d8', ''),
(98, 1, 87658658, 'Brown Lorena', 'control por dolor de muleas', '2022-12-07 12:00:00', '2022-12-07 13:00:00', '#ffffff', '#d74237', ''),
(99, 3, 87658658, 'Brown Lorena', '', '2022-12-06 09:00:00', '2022-12-06 10:00:00', '#ffffff', '#3788d8', ''),
(100, 1, 27433223, 'Messi Lionel', 'tratamiento de conducto', '2022-12-07 10:00:00', '2022-12-07 11:00:00', '#ffffff', '#3788d8', ''),
(105, 2, 22332445, 'Eleno Mariel', '', '2022-12-07 10:00:00', '2022-12-07 10:00:00', '#ffffff', '#3788d8', ''),
(106, 2, 23443445, 'Martinez Laura', '', '2022-12-09 09:00:00', '2022-12-09 09:00:00', '#ffffff', '#3788d8', ''),
(107, 2, 22332445, 'Eleno Mariel', '', '2022-12-07 12:00:00', '2022-12-07 12:00:00', '#ffffff', '#3788d8', ''),
(108, 2, 87658658, 'Brown Lorena', '', '2022-12-08 12:00:00', '2022-12-08 12:00:00', '#ffffff', '#3788d8', ''),
(112, 2, 87658658, 'Brown Lorena', '', '2022-12-07 09:00:00', '2022-12-07 09:00:00', '#ffffff', '#3788d8', ''),
(113, 1, 22332445, 'Eleno Mariel', '', '2022-12-06 20:00:00', '2022-12-06 20:00:00', '#ffffff', '#3788d8', '');

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
