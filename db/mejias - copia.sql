-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2022 at 07:01 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mejias`
--

-- --------------------------------------------------------

--
-- Table structure for table `coberturas`
--

DROP TABLE IF EXISTS `coberturas`;
CREATE TABLE IF NOT EXISTS `coberturas` (
  `id` tinyint NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coberturas`
--

INSERT INTO `coberturas` (`id`, `nombre`) VALUES
(1, 'Osde 210'),
(2, 'Osde 310'),
(3, 'Osde 410'),
(4, 'Osde 510');

-- --------------------------------------------------------

--
-- Table structure for table `cuentacorrientelog`
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
-- Dumping data for table `cuentacorrientelog`
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
(23443445, 76, 1, '2022-12-04', '0', '5');

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `dni`, `fec_nac`, `cobertura`, `numero`, `telefono`, `direccion`, `profesion`, `saldo`) VALUES
(2, 'Perez', 'Maria', 34222333, '1984-02-12', 1, '443223451111', '011-44532345', 'san martin 3243', 'verdulera', '30000'),
(3, 'Martinez', 'Laura', 23443445, '1994-11-23', 4, '21123444443', '011-33432233', 'alvarez jonte 2344', 'docente', '5'),
(7, 'Martin', 'Orlando', 11111145, '1998-12-10', 3, '2222222222', '011-658765876', 'orcas 883', 'estudiante', '0'),
(8, 'Messi', 'Lionel', 27433223, '1992-05-03', 4, '223444543', '023-44535246', 'arco del triunfo 3425', 'deportista profesional', '50000'),
(9, 'Luter', 'Laureano', 12887663, '1957-02-04', 2, '4443221114', '011-44536556', 'olleros 1233', 'jubilado', '120000');

-- --------------------------------------------------------

--
-- Table structure for table `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
CREATE TABLE IF NOT EXISTS `profesionales` (
  `prf_id` int NOT NULL AUTO_INCREMENT,
  `prf_nombre` varchar(60) NOT NULL,
  `prf_bloqueo` int DEFAULT NULL COMMENT 'dni del profesional que tiene bloqueada la agenda',
  PRIMARY KEY (`prf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profesionales`
--

INSERT INTO `profesionales` (`prf_id`, `prf_nombre`, `prf_bloqueo`) VALUES
(1, 'profesional A', NULL),
(2, 'profesional B', NULL),
(3, 'profesional C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `turnos`
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
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turnos`
--

INSERT INTO `turnos` (`id`, `profesional`, `dni`, `title`, `description`, `start`, `end`, `textColor`, `backgroundColor`, `estado`) VALUES
(1, 1, 33444555, 'test', 'test', '2022-11-19 10:00:00', '2022-11-19 11:00:00', NULL, NULL, '1'),
(57, 1, 23443445, 'Martinez Laura', '', '2022-11-19 11:00:00', '2022-11-19 12:00:00', '#ffffff', '#3788d8', 'pre'),
(59, 1, 11111145, 'Martin Orlando', '', '2022-11-20 14:00:00', '2022-11-20 15:00:00', '#ffffff', '#d7374f', 'aSa'),
(60, 1, 23443445, 'Martinez Laura', '', '2022-11-20 15:00:00', '2022-11-20 15:00:00', '#ffffff', '#37d757', 'pre'),
(61, 1, 11111145, 'Martin Orlando', '', '2022-11-19 14:00:00', '2022-11-19 14:00:00', '#ffffff', '#37d74a', 'aSa'),
(62, 3, 11111145, 'Martin Orlando', '', '2022-11-20 12:00:00', '2022-11-20 13:00:00', '#ffffff', '#3788d8', ''),
(66, 3, 27433223, 'Messi Lionel', '', '2022-11-19 13:00:00', '2022-11-19 14:00:00', '#ffffff', '#d737c2', 'pre'),
(67, 3, 23443445, 'Martinez Laura', '', '2022-11-19 12:00:00', '2022-11-19 13:00:00', '#ffffff', '#52d737', 'pre'),
(68, 3, 34222333, 'Perez Maria', '', '2022-11-19 14:00:00', '2022-11-19 15:00:00', '#ffffff', '#3788d8', ''),
(69, 1, 23443445, 'Martinez Laura', '', '2022-11-22 08:00:00', '2022-11-22 09:00:00', '#ffffff', '#3788d8', ''),
(70, 1, 27433223, 'Messi Lionel', '', '2022-11-25 14:00:00', '2022-11-25 15:00:00', '#ffffff', '#3788d8', 'pre'),
(71, 1, 23443445, 'Martinez Laura', '', '2022-11-25 16:00:00', '2022-11-25 17:00:00', '#ffffff', '#3788d8', 'pre'),
(73, 1, 34222333, 'Perez Maria', '', '2022-11-25 15:00:00', '2022-11-25 16:00:00', '#ffffff', '#d74237', 'pre'),
(74, 1, 11111145, 'Martin Orlando', '', '2022-11-25 17:00:00', '2022-11-25 18:00:00', '#ffffff', '#62d737', ''),
(75, 1, 27433223, 'Messi Lionel', '', '2022-11-24 12:00:00', '2022-11-24 13:00:00', '#ffffff', '#3788d8', 'pre'),
(76, 1, 23443445, 'Martinez Laura', '', '2022-11-25 11:00:00', '2022-11-25 12:00:00', '#ffffff', '#3788d8', 'aSa'),
(77, 1, 34222333, 'Perez Maria', '', '2022-12-05 09:00:00', '2022-12-05 10:00:00', '#ffffff', '#d73747', 'pre'),
(79, 1, 34222333, 'Perez Maria', 'toma de muestra maxilar inferior', '2022-12-05 10:00:00', '2022-12-05 11:00:00', '#ffffff', '#d7d237', 'pre'),
(80, 0, 27433223, 'Messi Lionel', '', '2022-11-29 13:00:00', '2022-11-29 14:00:00', '#ffffff', '#3788d8', ''),
(81, 1, 27433223, 'Messi Lionel', '', '2022-11-29 11:00:00', '2022-11-29 12:00:00', '#ffffff', '#3788d8', 'pre'),
(82, 1, 27433223, 'Messi Lionel', '', '2022-11-29 12:00:00', '2022-11-29 13:00:00', '#ffffff', '#3788d8', 'pre'),
(83, 1, 27433223, 'Messi Lionel', '', '2022-11-29 13:00:00', '2022-11-29 14:00:00', '#ffffff', '#3788d8', 'pre'),
(84, 1, 27433223, 'Messi Lionel', '', '2022-11-29 15:00:00', '2022-11-29 16:00:00', '#ffffff', '#3788d8', 'pre'),
(85, 1, 27433223, 'Messi Lionel', '', '2022-11-29 16:00:00', '2022-11-29 17:00:00', '#ffffff', '#3788d8', 'pre'),
(86, 1, 27433223, 'Messi Lionel', '', '2022-11-29 17:00:00', '2022-11-29 18:00:00', '#ffffff', '#3788d8', 'pre'),
(88, 2, 12887663, 'Luter Laureano', 'inicio tratamiento implante segundo molar', '2022-12-05 10:00:00', '2022-12-05 11:00:00', '#ffffff', '#3788d8', ''),
(89, 1, 12887663, 'Luter Laureano', 'control de rutina', '2022-11-30 14:00:00', '2022-11-30 15:00:00', '#ffffff', '#3788d8', ''),
(90, 2, 23443445, 'Martinez Laura', 'dolor de muelas (sobreturno)', '2022-12-06 11:00:00', '2022-12-06 12:00:00', '#ffffff', '#d73737', ''),
(91, 1, 27433223, 'Messi Lionel', '', '2022-11-30 15:00:00', '2022-11-30 16:00:00', '#ffffff', '#3788d8', '');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
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
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`usr_dni`, `usr_nombre`, `usr_password`, `usr_tipo`) VALUES
(22925061, 'Mariano Alfonso', 'test1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_tipo`
--

DROP TABLE IF EXISTS `usuarios_tipo`;
CREATE TABLE IF NOT EXISTS `usuarios_tipo` (
  `tipo_id` tinyint NOT NULL,
  `tipo_descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios_tipo`
--

INSERT INTO `usuarios_tipo` (`tipo_id`, `tipo_descripcion`) VALUES
(1, 'administrador'),
(2, 'administrativo'),
(3, 'profesional');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `FK_persona_cobertura` FOREIGN KEY (`cobertura`) REFERENCES `coberturas` (`id`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`usr_tipo`) REFERENCES `usuarios_tipo` (`tipo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
