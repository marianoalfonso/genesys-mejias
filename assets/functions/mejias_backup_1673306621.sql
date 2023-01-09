

CREATE TABLE `coberturas` (
  `id` tinyint NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL DEFAULT 'sin datos',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO coberturas VALUES("0","particular");
INSERT INTO coberturas VALUES("1","Osde 210");
INSERT INTO coberturas VALUES("2","Osde 310");
INSERT INTO coberturas VALUES("3","Osde 410");
INSERT INTO coberturas VALUES("4","Osde 510");
INSERT INTO coberturas VALUES("5","Poder Judicial");



CREATE TABLE `config` (
  `progresionDNI` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO config VALUES("11111188");



CREATE TABLE `cuentacorrientelog` (
  `ctacte_dni` int NOT NULL COMMENT 'dni del paciente',
  `ctacte_idTurno` int NOT NULL,
  `ctacte_idProfesional` int NOT NULL,
  `ctaCte_fecha` date NOT NULL,
  `ctacte_ingresosDeuda` decimal(10,0) NOT NULL,
  `ctaCte_importePago` decimal(10,0) NOT NULL,
  `ctacte_importeSaldo` decimal(10,0) NOT NULL,
  `ctacte_descripcion` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




CREATE TABLE `pacientes` (
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
  KEY `FK_persona_cobertura_idx` (`cobertura`),
  CONSTRAINT `FK_persona_cobertura` FOREIGN KEY (`cobertura`) REFERENCES `coberturas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO pacientes VALUES("2","test","test","11111188","2023-01-02","1","","","","","0");



CREATE TABLE `profesionales` (
  `prf_id` int NOT NULL AUTO_INCREMENT,
  `prf_nombre` varchar(60) NOT NULL,
  `prf_bloqueo` int DEFAULT NULL COMMENT 'dni del profesional que tiene bloqueada la agenda',
  PRIMARY KEY (`prf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO profesionales VALUES("4","Megias Gustavo","");
INSERT INTO profesionales VALUES("6","Carbajales Ariel","");
INSERT INTO profesionales VALUES("7","Campuzano Sara","");
INSERT INTO profesionales VALUES("8","Stochyk Guillermina","");
INSERT INTO profesionales VALUES("9","Boragina Pamela","");
INSERT INTO profesionales VALUES("10","Cenizo Antonella","");
INSERT INTO profesionales VALUES("11","Caligiuri Martina","");



CREATE TABLE `profesionaleshorarios` (
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

INSERT INTO profesionaleshorarios VALUES("1","08:00:00","19:00:00","08:00:00","19:00:00","08:00:00","19:00:00","08:00:00","19:00:00","08:00:00","19:00:00");



CREATE TABLE `turnos` (
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO turnos VALUES("13","4","11111188","test test","","2023-01-04 09:00:00","2023-01-04 10:00:00","#ffffff","#3788d8","");
INSERT INTO turnos VALUES("16","4","11111188","test test","","2023-01-04 12:00:00","2023-01-04 13:00:00","#ffffff","#3788d8","");



CREATE TABLE `usuarios` (
  `usr_dni` int NOT NULL,
  `usr_nombre` varchar(60) NOT NULL,
  `usr_password` varchar(45) NOT NULL,
  `usr_tipo` tinyint NOT NULL,
  PRIMARY KEY (`usr_dni`),
  KEY `fk_usuario_tipo_idx` (`usr_tipo`),
  CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`usr_tipo`) REFERENCES `usuarios_tipo` (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO usuarios VALUES("20883029","Gabriela","20883029","1");
INSERT INTO usuarios VALUES("22925061","Mariano Alfonso","test1234","1");
INSERT INTO usuarios VALUES("28709126","Andrea","28709126","1");
INSERT INTO usuarios VALUES("37064958","Yamila","37064958","1");
INSERT INTO usuarios VALUES("41745543","Sol","41745543","1");
INSERT INTO usuarios VALUES("44451719","Malena","44451719","1");



CREATE TABLE `usuarios_tipo` (
  `tipo_id` tinyint NOT NULL,
  `tipo_descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO usuarios_tipo VALUES("1","administrador");
INSERT INTO usuarios_tipo VALUES("2","administrativo");
INSERT INTO usuarios_tipo VALUES("3","profesional");

