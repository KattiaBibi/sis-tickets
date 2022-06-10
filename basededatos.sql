-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-06-2022 a las 20:25:59
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'GERENTE GENERAL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(2, 'GERENTE  DE PROYECTOS', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(3, 'JEFE DE ARQUITECTURA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(4, 'ASISTENTE DE ARQUITECTURA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(5, 'ING ESTRUCTURAL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(6, 'ARQUITECTA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(7, 'INGENIERO CIVIL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(8, 'DISEÑADORA DE INTERIORES', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(9, 'PROYECTISTA DISEÑADOR', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(10, 'ASISTENTE DE OPERACIONES', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(11, 'JEFE DE OPERACIONES', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(12, 'ASISTENTE DE LOGISTICA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(13, 'ASISTENTE DE LIMPIEZA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(14, 'DIRECTORA CONTABLE', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(15, 'JEFE DE AREA DE MARKETING', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(16, 'COMUNICADORA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(17, 'REALIZADOR AUDIOVISUALES', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(18, 'JEFE DE AREA DE DISEÑO', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(19, 'PRODUCTOR AUDIOVISUAL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(20, 'DISEÑADOR GRAFICO', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(21, 'JEFE DE AREA AUDIOVISUAL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(22, 'GERENTE DE MARKETING', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(23, 'COMMUNITY MANAGER', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(24, 'ASISTENTE AUDIOVISUALES', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(25, 'GERENTE ADMINISTRATIVO', 1, '2022-05-26 21:27:18', '2022-05-26 20:21:11'),
(26, 'SUPERVISOR COMERCIAL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(27, 'AGENTE COMERCIAL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(28, 'ASISTENTE ADMINISTRATIVO', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(29, 'GERENTE', 1, '2022-05-26 21:27:18', '2022-05-26 21:01:39'),
(30, 'JEFE DE AREA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(31, 'ASISTENTE DE COMPUTACION E INFORMATICA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(32, 'ASISTENTE DE SISTEMAS', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(33, 'PROGRAMADOR JUNIOR', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(34, 'ASISTENTE LEGAL', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(35, 'JEFE DE RRHH Y LOGISTICA', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(36, 'ASISTENTE DE RRHH', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(37, 'ASISTENTE CONTABLE', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(38, 'CONTADORA GENERAL', 1, '2022-05-26 21:27:18', '2022-05-26 20:20:53'),
(39, 'PUBLICIDAD', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(40, 'JEFE DE CAPACITACIONES', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(41, 'SUPERVISOR DE CUENTAS', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(42, 'PRACTICANTE', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(43, 'Practicantes', 1, '2022-05-26 19:20:08', '2022-05-26 19:23:06'),
(45, 'GERENTE ADMINISTRATIVO', 1, '2022-05-26 21:09:35', '2022-05-26 21:09:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `link_reu` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lugarreu` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipocita` enum('presencial','virtual') COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('pendiente','concluida','cancelada') COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cita_usuario` (`usuario_id`),
  KEY `fk_cita_empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `titulo`, `descripcion`, `fecha`, `hora_inicio`, `hora_fin`, `link_reu`, `lugarreu`, `tipocita`, `estado`, `usuario_id`, `empresa_id`, `created_at`, `updated_at`) VALUES
(8, 'REUNIÓN PRESENTACIÓN DEL SOFTWARE ', 'REUNIÓN PARA PRESENTAR ', '2022-06-01 00:00:00', '19:00:00', '21:00:00', NULL, NULL, 'presencial', 'pendiente', 1, 5, '2022-06-01 22:25:09', '2022-06-01 22:25:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
CREATE TABLE IF NOT EXISTS `colaboradores` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nrodocumento` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` char(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `empresa_area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_colaborador_empresa_area` (`empresa_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nrodocumento`, `nombres`, `apellidos`, `fechanacimiento`, `direccion`, `telefono`, `estado`, `empresa_area_id`, `created_at`, `updated_at`) VALUES
(1, '', 'JOHON ALEXANDER', 'SALAZAR BAYGORRIA', '1980-11-25', '', '952982232', 1, 1, '2022-05-26 21:27:19', '2022-05-26 20:17:47'),
(2, '', 'MARCO ANTONIO', 'GORDILLO ALCANTARA', '1982-08-16', '', '932400433', 1, 2, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(3, '', 'JOHNY', 'FACHO POLO', '1967-11-16', '', '979947695', 1, 3, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(4, '', 'ELIANA JUDITH', 'CHAPILLIQUEN ROJAS', '1998-07-01', '', '984970399', 1, 4, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(5, '', 'KAREN MELANYTH', 'NUÑEZ CUSMA', '1992-11-03', '', '951088624', 1, 5, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(6, '', 'HARUMI DE MARIA', 'YAMPUFE YABE', '1996-01-12', '', '978123791', 1, 6, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(7, '', 'ESWIN NOEL', 'PEREZ PEREZ', '1991-02-21', '', '947007552', 1, 7, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(8, '', 'LAURA IRENE', 'YACILA NAVARRO', '1999-06-11', '', '949108981', 1, 8, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(9, '', 'XIOMY LUSMIT', 'VILLEGAS ALCALDE', '1994-05-06', '', '960399866', 1, 8, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(10, '', 'LUIS JESUS', 'UCHOFEN GARCIA', '1995-11-16', '', '959688375', 1, 9, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(11, '', 'ABEL CRISTIAN', 'SANTISTEBAN CHUMACERO', '1992-10-08', '', '936783242', 1, 9, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(12, '', 'EDWIN ROBERT', 'RODRIGUEZ RODAS', '1969-09-21', '', '917810803', 1, 34, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(13, '', 'JUAN JOSE', 'RODRIGUEZ RODAS', '1982-06-24', '', '900769044', 1, 10, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(14, '', 'FRANK ALEXANDER', 'RODRIGUEZ ZEVALLOS', '1993-12-01', '', '948832277', 1, 10, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(15, '', 'ANGEL MODESTO', 'RODRIGUEZ ZEVALLOS', '1994-12-19', '', '948832277', 1, 11, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(16, '', 'VICTOR EDUARDO', 'MERA ANDONAIRE', '1961-05-07', '', '9029840098', 1, 10, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(17, '', 'BRAYAN ALONSO', 'PISFIL SALAZAR', '1999-03-19', '', '927659628', 1, 12, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(18, '', 'DARWIN WILFORD', 'VILLANUEVA LEON', '2002-06-15', '', '912535409', 1, 13, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(19, '', 'MARY NANCY', 'LEON CHAVEZ', '1982-08-16', '', '939766046', 1, 14, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(20, '', 'JORGE RAMSET', 'COELLO MALPARTIDA', '1987-01-21', '', '915235773', 1, 15, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(21, '', 'VANNESA JAZMIN', 'BURGA ARCE', '1994-03-22', '', '942430270', 1, 16, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(22, '', 'OLGA ROSALIA', 'MONTEZA PAZ', '1994-02-25', '', '901820881', 1, 17, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(23, '', 'LUIS DAVID', 'LOPEZ VASQUEZ', '1996-07-12', '', '924643975', 1, 18, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(24, '', 'HECTOR', 'VASQUEZ RAMIREZ', '1987-07-06', '', '944601873', 1, 19, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(25, '', 'ALEX JUNIOR', 'ODAR NAVARRO', '1992-02-17', '', '935720245', 1, 20, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(26, '', 'JOSE LUIS', 'PAICO YPANAQUE', '1992-03-19', '', '943911174', 1, 20, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(27, '', 'ANGIELY JERALDINE', 'FLORES MEDINA', '2000-05-31', '', '948919980', 1, 20, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(28, '', 'JUNIOR', 'PASACHE BUSTAMANTE', '2001-01-09', '', '918618539', 1, 20, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(29, '', 'MARCO AIRTON', 'CABANILLAS GALVEZ', '1993-06-01', '', '930281506', 1, 20, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(30, '', 'GUSTAVO ADOLFO', 'CAICEDO SUYON', '1992-01-24', '', '902165570', 1, 21, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(31, '', 'BRAYN XAVIER', 'CORTEZ LINARES', '1994-08-14', '', '930775939', 1, 22, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(32, '', 'MARCO MAURICIO', 'SEMINARIO CHAVARRY', '1994-08-17', '', '9790199991', 1, 23, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(33, '', 'CESAR AUGUSTO', 'TELLO HUANAMBAL', '1997-12-02', '', '964722835', 1, 24, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(34, '', 'LISBETH YANARI', 'RIVERA ROJAS', '1991-10-11', '', '993099352', 1, 25, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(35, '', 'KENNY BRYAN', 'AGUIRRE ZEVALLOS', '1993-04-23', '', '970404047', 1, 26, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(36, '', 'FIORELLA MEDALY', 'HUAMAN SANCHEZ', '1992-02-13', '', '952699045', 1, 26, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(37, '', 'RAMIRO EDGARDO', 'TICERAN PEREZ', '1992-07-04', '', '943694270', 1, 26, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(38, '', 'PIERRE AUGUSTO', 'FIGUEROA GONZALES', '1987-08-02', '', '973452011', 1, 26, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(39, '', 'VANESSA', 'CHUMACERO TORRES', '1987-08-02', '', '957400508', 1, 26, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(40, '', 'ANTHONY ARNOLD', 'SANDOVAL VALENZUELA', '1994-05-17', '', '930457563', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(41, '', 'KELLIE', 'MONTERO CARRASCO', '1994-05-17', '', '', 1, 28, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(42, '', 'NANLU YASMIN', 'PALACIOS CLAVIJO', '1984-10-31', '', '979447884', 1, 28, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(43, '', 'ISABEL DEL MILAGRO', 'CHAVEZ DELGADO', '1998-10-04', '', '926608588', 1, 28, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(44, '', 'SANDRO', 'CHAVEZ LOPEZ', '1994-05-03', '', '902955045', 1, 26, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(45, '', 'DANTE', 'PORRAS DELGADO', '1988-02-12', '', '963046270', 1, 26, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(46, '', 'OSCAR REMIGIO', 'SALAZAR BAIGORRIA', '1971-06-17', '', '934845616', 1, 29, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(47, '', 'JANINA MARICRUZ', 'RIVAS CABREJOS', '1995-12-16', '', '914845464', 1, 30, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(48, '', 'MARYOEI YASLITD', 'TEJADA ISUIZA', '1997-02-28', '', '9708544239', 1, 31, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(49, '', 'DAVID', 'MANAYALLE CACHAY', '1996-10-30', '', '991817883', 1, 32, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(50, '77422337', 'KATTIA BIBIANA', 'CRUZADO CHAVEZ', '1997-12-14', NULL, '995092702', 1, 31, '2022-05-26 21:27:19', '2022-05-26 21:28:02'),
(51, '', 'JUAN MIGUEL', 'DIAZ HERNANDEZ', '1992-03-16', '', '978998786', 1, 33, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(52, '', 'ALBERTO', 'RODRIGUEZ CABREJOS', '1994-04-03', '', '937817789', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(53, '', 'CRISTIAN BRAYAN', 'JESUS VERA ROMERO', '1999-06-15', '', '923636417', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(54, '', 'JUNIOR', 'CARRASCO HUAMAN', '1999-03-19', '', '958521164', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(55, '', 'ROCIO', 'VILLEGAS YALLE', '1999-03-19', '', '958521164', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(56, '', 'Erika Elizabeth', 'Ramos Patazca', '1988-05-28', '', '918664667', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(57, '', 'Brian', 'Galindo Idrogo', '1992-12-29', '', '965180378', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(58, '', 'Bhrayan', 'Castañeda Sampen', '2000-04-17', '', '991525779', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(59, '', 'Alejandra', 'Zevallos Rimarachin', '2000-04-17', '', '945315210', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(60, '', 'Ivan', 'Zambrano Tripul', '1985-02-26', '', '942324888', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(61, '', 'Neyze', 'Rea Patazca', '1988-10-08', '', '924703978', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(62, '', 'Amelia', 'Nevado Villalobos', '1968-04-26', '', '955657726', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(63, '', 'Diojana', 'Bustamante Asalde', '1986-07-02', '', '920689837', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(64, '', 'Sergio', 'Peña Fernandez', '1999-05-31', '', '978546660', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(65, '', 'Lidia', 'Granados Chafloque', '1992-03-14', '', '937638783', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(66, '', 'Fabrizio', 'Boulanger Sosa', '2001-09-12', '', '996824777', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(67, '', 'Sebastian', 'Delgado Agreda', '1999-12-01', '', '968035258', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(68, '', 'Jonatan', 'Manay Pineda', '1999-12-01', '', '943966121', 1, 27, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(69, '', 'NAYSHA STEFANY', 'CUEVA GUERRA', '1998-02-16', '', '970228478', 1, 35, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(70, '', 'NANCY DEL PILAR', 'SALAZAR BAYGORRIA', '1998-02-16', '', '950035256', 1, 36, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(71, '', 'FLOR VANESSA', 'BARRANTES BAZAN', '1991-11-22', '', '972770433', 1, 37, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(72, '', 'FARRONAY FLORES', 'JHON CARLOS', '1992-07-25', '', '966690947', 1, 38, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(73, '', 'JUANA ROSA', 'MECHAN TÚLLUME', '1993-03-06', '', '979000154', 1, 39, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(74, '', 'JARUMY LISSETH', 'DELGADO CHERO', '1998-03-08', '', '968731876', 1, 38, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(75, '', 'ESTEFANY MIRELLA', 'SECLEN PUSE', '1999-02-02', '', '977880102', 1, 38, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(76, '', 'YHASMIN YSABEL', 'ZAPATA GUERREO', '1999-01-10', '', '947839818', 1, 38, '2022-05-26 21:27:19', '2022-05-26 21:27:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_citas`
--

DROP TABLE IF EXISTS `detalle_citas`;
CREATE TABLE IF NOT EXISTS `detalle_citas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cita_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_colab_id` bigint(20) UNSIGNED NOT NULL,
  `confirmation` tinyint(4) DEFAULT NULL,
  `confirmation_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detalle_cita_cita` (`cita_id`),
  KEY `fk_detalle_cita_user` (`usuario_colab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_citas`
--

INSERT INTO `detalle_citas` (`id`, `cita_id`, `usuario_colab_id`, `confirmation`, `confirmation_at`) VALUES
(13, 8, 50, 1, '2022-06-01 17:59:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_requerimientos`
--

DROP TABLE IF EXISTS `detalle_requerimientos`;
CREATE TABLE IF NOT EXISTS `detalle_requerimientos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_colab_id` bigint(20) UNSIGNED NOT NULL,
  `requerimiento_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detalle_requerimiento_user` (`usuario_colab_id`),
  KEY `fk_detalle_requerimiento_requerimiento` (`requerimiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_requerimientos`
--

INSERT INTO `detalle_requerimientos` (`id`, `usuario_colab_id`, `requerimiento_id`) VALUES
(5, 67, 1),
(6, 66, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ruc` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empresas_color_unique` (`color`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `ruc`, `nombre`, `direccion`, `telefono`, `color`, `estado`, `created_at`, `updated_at`) VALUES
(1, '98756320125', 'JM DESARROLLADOR', 'CALLE ARIZOLA #130 - B', '123789', '#082338', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(2, '96306520369', 'N LEÓN', 'AV. TEST #213', '123789', '#cceb34', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(3, '78423233232', 'GENEXIDU', 'CALLE ARIZOLA #130 - B', '123789', '#00e0ba', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(4, '90365202158', 'JM INMOBILIARIAS', 'AV. TEST #123', '123789', '#C42929', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(5, '10408842889', 'COMPUSISTEL', 'AV. SANTA VICTORIA #452', '123456', '#0000ff', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(6, '12546454564', 'JM HOLDING', 'AV. TEST #321', '987654', '#ff7a11', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(7, '78023696520', 'RUEDA DE NEGOCIOS', 'CALLE ARIZOLA #130 - B', '123789', '#F8BA0A', 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_areas`
--

DROP TABLE IF EXISTS `empresa_areas`;
CREATE TABLE IF NOT EXISTS `empresa_areas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresa_area_empresa` (`empresa_id`),
  KEY `fk_empresa_area` (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `empresa_areas`
--

INSERT INTO `empresa_areas` (`id`, `empresa_id`, `area_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(2, 1, 2, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(3, 1, 3, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(4, 1, 4, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(5, 1, 5, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(6, 1, 6, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(7, 1, 7, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(8, 1, 8, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(9, 1, 9, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(10, 2, 10, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(11, 2, 11, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(12, 2, 12, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(13, 2, 13, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(14, 2, 14, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(15, 3, 15, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(16, 3, 16, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(17, 3, 17, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(18, 3, 18, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(19, 3, 19, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(20, 3, 20, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(21, 3, 21, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(22, 3, 22, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(23, 3, 23, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(24, 3, 24, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(25, 4, 25, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(26, 4, 26, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(27, 4, 27, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(28, 4, 28, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(29, 5, 29, '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(30, 5, 30, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(31, 5, 31, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(32, 5, 32, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(33, 5, 33, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(34, 2, 1, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(35, 6, 34, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(36, 6, 35, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(37, 6, 36, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(38, 6, 37, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(39, 6, 38, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(40, 5, 43, '2022-05-26 19:20:08', '2022-05-26 19:20:08'),
(42, 5, 45, '2022-05-26 21:09:35', '2022-05-26 21:09:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_servicios`
--

DROP TABLE IF EXISTS `empresa_servicios`;
CREATE TABLE IF NOT EXISTS `empresa_servicios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `servicio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresa_servicio_empresa` (`empresa_id`),
  KEY `fk_empresa_servicio` (`servicio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `empresa_servicios`
--

INSERT INTO `empresa_servicios` (`id`, `empresa_id`, `servicio_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2022-05-26 21:27:30', '2022-05-26 17:24:12'),
(2, 3, 2, '2022-05-26 21:27:30', '2022-05-26 21:27:30'),
(3, 6, 3, '2022-05-26 16:55:45', '2022-05-26 17:24:21'),
(4, 3, 4, '2022-05-26 16:56:33', '2022-05-26 16:56:33'),
(5, 3, 5, '2022-05-26 16:56:58', '2022-05-26 16:56:58'),
(6, 3, 6, '2022-05-26 16:57:15', '2022-05-26 16:57:15'),
(7, 6, 7, '2022-05-26 16:57:16', '2022-05-26 17:24:36'),
(8, 3, 8, '2022-05-26 16:57:25', '2022-05-26 16:57:25'),
(9, 6, 9, '2022-05-26 16:57:41', '2022-05-26 17:24:43'),
(10, 3, 10, '2022-05-26 16:57:44', '2022-05-26 16:57:44'),
(11, 6, 11, '2022-05-26 16:57:57', '2022-05-26 17:24:49'),
(12, 3, 12, '2022-05-26 16:58:15', '2022-05-26 16:58:15'),
(13, 3, 13, '2022-05-26 16:58:31', '2022-05-26 16:58:31'),
(14, 6, 14, '2022-05-26 16:58:38', '2022-05-26 17:24:55'),
(15, 6, 15, '2022-05-26 17:01:46', '2022-05-26 17:25:01'),
(16, 6, 16, '2022-05-26 17:02:00', '2022-05-26 17:24:29'),
(17, 3, 17, '2022-05-26 17:03:44', '2022-05-26 17:03:44'),
(18, 3, 18, '2022-05-26 17:04:01', '2022-05-26 17:04:01'),
(19, 3, 19, '2022-05-26 17:06:08', '2022-05-26 17:06:08'),
(20, 7, 20, '2022-05-26 17:12:39', '2022-05-26 17:12:39'),
(21, 7, 21, '2022-05-26 17:13:07', '2022-05-26 17:13:07'),
(22, 7, 22, '2022-05-26 17:13:26', '2022-05-26 17:13:26'),
(23, 7, 23, '2022-05-26 17:14:15', '2022-05-26 17:14:15'),
(24, 7, 24, '2022-05-26 17:14:25', '2022-05-26 17:14:25'),
(25, 2, 25, '2022-05-26 17:15:11', '2022-05-26 17:15:11'),
(26, 2, 26, '2022-05-26 17:15:19', '2022-05-26 17:15:19'),
(27, 2, 27, '2022-05-26 17:15:29', '2022-05-26 17:15:29'),
(28, 2, 28, '2022-05-26 17:15:41', '2022-05-26 17:15:41'),
(29, 2, 29, '2022-05-26 17:15:56', '2022-05-26 17:15:56'),
(30, 2, 30, '2022-05-26 17:16:11', '2022-05-26 17:16:11'),
(31, 4, 31, '2022-05-26 17:19:03', '2022-05-26 17:19:03'),
(32, 4, 32, '2022-05-26 17:19:21', '2022-05-26 17:19:21'),
(33, 4, 33, '2022-05-26 17:20:56', '2022-05-26 17:20:56'),
(34, 1, 34, '2022-05-26 17:25:42', '2022-05-26 17:25:42'),
(35, 1, 35, '2022-05-26 17:26:25', '2022-05-26 17:26:25'),
(36, 1, 36, '2022-05-26 17:27:14', '2022-05-26 17:27:14'),
(37, 5, 37, '2022-05-26 17:29:40', '2022-05-26 17:29:40'),
(38, 5, 38, '2022-05-26 17:29:49', '2022-05-26 17:29:49'),
(39, 5, 39, '2022-05-26 17:29:54', '2022-05-26 17:29:54'),
(40, 5, 40, '2022-05-26 17:30:00', '2022-05-26 17:30:00'),
(41, 5, 41, '2022-05-26 17:30:06', '2022-05-26 17:30:06'),
(42, 5, 42, '2022-05-26 17:30:59', '2022-05-26 17:30:59'),
(43, 5, 43, '2022-05-26 17:31:04', '2022-05-26 17:31:04'),
(44, 5, 44, '2022-05-26 17:31:19', '2022-05-26 17:31:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_requerimientos`
--

DROP TABLE IF EXISTS `historial_requerimientos`;
CREATE TABLE IF NOT EXISTS `historial_requerimientos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechahoraprogramada` datetime NOT NULL,
  `motivo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle_requerimiento_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historial_requerimiento_detalle` (`detalle_requerimiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_03_22_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_16_003138_create_empresas_table', 1),
(5, '2022_03_21_015309_create_areas_table', 1),
(6, '2022_03_21_015310_create_servicios_table', 1),
(7, '2022_03_21_141234_create_permission_tables', 1),
(8, '2022_03_21_162642_create_empresa_areas_table', 1),
(9, '2022_03_21_162643_create_empresa_servicios_table', 1),
(10, '2022_03_22_161616_create_colaboradores_table', 1),
(11, '2022_03_22_171407_alter_users_table', 1),
(12, '2022_03_22_212445_create_citas_table', 1),
(13, '2022_03_22_212723_create_detalle_citas_table', 1),
(14, '2022_04_19_192231_create_requerimientos_table', 1),
(15, '2022_04_19_195048_create_detalle_requerimientos_table', 1),
(16, '2022_05_05_141600_create_requerimiento_encargados', 1),
(17, '2022_05_28_195048_create_detalle_requerimientos_table', 2),
(18, '2022_05_29_164241_create_historial_requerimientos', 2),
(19, '2022_05_29_164242_create_historial_requerimientos', 3),
(20, '2022_03_22_212442_create_citas_table', 4),
(21, '2022_03_22_212729_create_detalle_citas_table', 4),
(22, '2022_05_31_104802_create_jobs_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3),
(3, 'App\\User', 4),
(3, 'App\\User', 5),
(3, 'App\\User', 6),
(3, 'App\\User', 7),
(3, 'App\\User', 8),
(3, 'App\\User', 9),
(3, 'App\\User', 10),
(3, 'App\\User', 11),
(2, 'App\\User', 12),
(3, 'App\\User', 13),
(3, 'App\\User', 14),
(3, 'App\\User', 15),
(3, 'App\\User', 16),
(3, 'App\\User', 17),
(3, 'App\\User', 18),
(3, 'App\\User', 19),
(3, 'App\\User', 20),
(3, 'App\\User', 21),
(3, 'App\\User', 22),
(3, 'App\\User', 23),
(3, 'App\\User', 24),
(3, 'App\\User', 25),
(3, 'App\\User', 26),
(3, 'App\\User', 27),
(3, 'App\\User', 28),
(3, 'App\\User', 29),
(3, 'App\\User', 30),
(3, 'App\\User', 31),
(3, 'App\\User', 32),
(3, 'App\\User', 33),
(2, 'App\\User', 34),
(3, 'App\\User', 35),
(3, 'App\\User', 36),
(3, 'App\\User', 37),
(3, 'App\\User', 38),
(3, 'App\\User', 39),
(3, 'App\\User', 40),
(3, 'App\\User', 41),
(3, 'App\\User', 42),
(3, 'App\\User', 43),
(3, 'App\\User', 44),
(3, 'App\\User', 45),
(3, 'App\\User', 46),
(3, 'App\\User', 47),
(3, 'App\\User', 48),
(3, 'App\\User', 49),
(3, 'App\\User', 50),
(3, 'App\\User', 51),
(3, 'App\\User', 52),
(3, 'App\\User', 53),
(3, 'App\\User', 54),
(3, 'App\\User', 55),
(3, 'App\\User', 56),
(3, 'App\\User', 57),
(3, 'App\\User', 58),
(3, 'App\\User', 59),
(3, 'App\\User', 60),
(3, 'App\\User', 61),
(3, 'App\\User', 62),
(2, 'App\\User', 63),
(2, 'App\\User', 64),
(3, 'App\\User', 65),
(3, 'App\\User', 66),
(3, 'App\\User', 67),
(3, 'App\\User', 68),
(2, 'App\\User', 69),
(3, 'App\\User', 70),
(3, 'App\\User', 71),
(3, 'App\\User', 72),
(3, 'App\\User', 73),
(3, 'App\\User', 74),
(3, 'App\\User', 75),
(3, 'App\\User', 76);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `estado`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin.home', 'Ver el tablero', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(2, 'admin.reuniones', 'Listar reunión', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(3, 'admin.reuniones.agregar', 'Crear reunión', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(4, 'admin.reuniones.editar', 'Editar reunión', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(5, 'admin.reuniones.eliminar', 'Eliminar reunión', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(6, 'admin.requerimientos.filtros', 'Buscar por filtros', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 20:03:42'),
(7, 'admin.requerimientos', 'Listar requerimiento', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(8, 'admin.requerimientos.agregar', 'Crear requerimiento', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(9, 'admin.requerimientos.editar', 'Editar requerimiento', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(10, 'admin.requerimientos.desactivar', 'Desactivar requerimiento', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(11, 'admin.servicio.listado', 'Listar servicios', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(12, 'admin.servicio.crear', 'Crear servicio', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(13, 'admin.servicio.editar', 'Editar servicio', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(14, 'admin.servicio.desactivar', 'Desactivar servicio', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(15, 'admin.colaborador.listado', 'Listar colaboradores', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(16, 'admin.colaborador.crear', 'Crear colaborador', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(17, 'admin.colaborador.editar', 'Editar colaborador', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(18, 'admin.colaborador.desactivar', 'Desactivar colaborador', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(19, 'admin.empresa.listado', 'Listar empresas', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(20, 'admin.empresa.crear', 'Crear empresa', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(21, 'admin.empresa.editar', 'Editar empresa', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(22, 'admin.empresa.desactivar', 'Desactivar empresa', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(23, 'admin.area.listado', 'Listar áreas', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(24, 'admin.area.crear', 'Crear área', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(25, 'admin.area.editar', 'Editar área', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(26, 'admin.area.desactivar', 'Desactivar área', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(27, 'admin.empresa_area.listado', 'Listar empresas con áreas', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(28, 'admin.empresa_area.crear', 'Crear empresas con área', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(29, 'admin.empresa_area.editar', 'Editar empresas con área', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(30, 'admin.empresa_area.desactivar', 'Desactivar empresas con área', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(31, 'admin.empresa_servicio.listado', 'Listar empresas con servicios', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(32, 'admin.empresa_servicio.crear', 'Crear empresa con servicio', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(33, 'admin.empresa_servicio.editar', 'Editar empresa con servicio', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(34, 'admin.empresa_servicio.desactivar', 'Desactivar empresa con servicio', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(35, 'admin.usuario.listado', 'Listar usuarios', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(36, 'admin.usuario.crear', 'Crear usuario', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(37, 'admin.usuario.editar', 'Editar usuario', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(38, 'admin.usuario.desactivar', 'Desactivar usuario', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(39, 'admin.rol.listado', 'Listar roles', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(40, 'admin.rol.crear', 'Crear rol', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(41, 'admin.rol.editar', 'Editar rol', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(42, 'admin.rol.desactivar', 'Desactivar rol', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(43, 'admin.permiso.listado', 'Listar permisos', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(44, 'admin.permiso.crear', 'Crear permiso', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(45, 'admin.permiso.editar', 'Editar permiso', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(46, 'admin.permiso.desactivar', 'Desactivar permiso', 1, 'web', '2022-05-26 21:27:18', '2022-05-26 21:27:18'),
(47, 'teemo.rol', 'Ver todo, todito todo...', 1, 'web', '2022-05-26 19:30:26', '2022-05-26 19:30:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientos`
--

DROP TABLE IF EXISTS `requerimientos`;
CREATE TABLE IF NOT EXISTS `requerimientos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avance` int(11) NOT NULL,
  `prioridad` enum('alta','media','baja') COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('pendiente','en espera','en proceso','culminado','cancelado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_servicio_id` bigint(20) UNSIGNED NOT NULL,
  `usuarioregist_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresa_servicios_requerimientos` (`empresa_servicio_id`),
  KEY `fk_requerimientos_usersregist` (`usuarioregist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `requerimientos`
--

INSERT INTO `requerimientos` (`id`, `titulo`, `descripcion`, `avance`, `prioridad`, `estado`, `imagen`, `archivo`, `empresa_servicio_id`, `usuarioregist_id`, `created_at`, `updated_at`) VALUES
(1, 'prfgfg', 'vxcbc', 0, 'media', 'pendiente', 'requerimiento1654789685.jpg', 'archivo_1654790115INFORME Nº 001-2022.docx', 39, 1, '2022-06-06 14:16:30', '2022-06-09 15:55:15'),
(2, 'ghgd', 'hdfg', 0, 'media', 'pendiente', 'requerimiento1654796461.jpg', '0', 43, 1, '2022-06-09 17:15:21', '2022-06-09 17:41:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimiento_encargados`
--

DROP TABLE IF EXISTS `requerimiento_encargados`;
CREATE TABLE IF NOT EXISTS `requerimiento_encargados` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `requerimiento_id` bigint(20) UNSIGNED NOT NULL,
  `usuarioencarg_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_requerimiento_encargado:requerimiento` (`requerimiento_id`),
  KEY `fk_requerimientos_usersencarg` (`usuarioencarg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `requerimiento_encargados`
--

INSERT INTO `requerimiento_encargados` (`id`, `requerimiento_id`, `usuarioencarg_id`) VALUES
(1, 1, 1),
(2, 1, 63),
(3, 1, 64),
(4, 2, 1),
(5, 2, 63);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `estado`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(2, 'AdminGerente', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(3, 'Trabajador', 1, 'web', '2022-05-26 21:27:17', '2022-05-26 21:27:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(1, 3),
(7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ASESORÍA CONTABLE', 1, '2022-05-26 21:27:17', '2022-05-26 20:18:02'),
(2, 'FOTOGRAFÍA DIGITAL', 1, '2022-05-26 21:27:17', '2022-05-26 21:27:17'),
(3, ' ASISTENCIA Y ASESORAMIENTO TRIBUTARIO', 1, '2022-05-26 16:55:45', '2022-05-26 16:55:45'),
(4, 'BRANDING', 1, '2022-05-26 16:56:33', '2022-05-26 16:56:33'),
(5, 'REBRANDING', 1, '2022-05-26 16:56:58', '2022-05-26 16:56:58'),
(6, 'SOCIAL MEDIA - PAQUETE JUNIOR', 1, '2022-05-26 16:57:15', '2022-05-26 17:01:47'),
(7, 'ASESORÍA LABORAL', 1, '2022-05-26 16:57:16', '2022-05-26 16:57:16'),
(8, 'SOCIAL MEDIA - PAQUETE EMPRENDEDOR', 1, '2022-05-26 16:57:25', '2022-05-26 17:01:57'),
(9, 'ASESORÍA FINANCIERA', 1, '2022-05-26 16:57:41', '2022-05-26 16:57:41'),
(10, 'SOCIAL MEDIA - PAQUETE INNOVADOR', 1, '2022-05-26 16:57:44', '2022-05-26 17:02:07'),
(11, 'ASESORÍA PERSONA JURÍDICA', 1, '2022-05-26 16:57:57', '2022-05-26 16:57:57'),
(12, 'SOCIAL MEDIA - PAQUETE EMPRESARIAL', 1, '2022-05-26 16:58:15', '2022-05-26 17:02:18'),
(13, 'SOCIAL MEDIA - PAQUETE CORPORATIVO', 1, '2022-05-26 16:58:31', '2022-05-26 17:02:31'),
(14, 'ASESORÍA DE ELABORACIÓN DE CONTRATOS PRIVADOS', 1, '2022-05-26 16:58:38', '2022-05-26 16:58:38'),
(15, 'SERVICIOS EN GESTIONES NOTARIALES', 1, '2022-05-26 17:01:46', '2022-05-26 17:01:46'),
(16, 'ASESORÍA REGISTRAL Y NOTARIAL', 1, '2022-05-26 17:02:00', '2022-05-26 17:02:00'),
(17, 'AUDIVISUAL - FOTOGRAFÍA PERSONAL', 1, '2022-05-26 17:03:44', '2022-05-26 17:03:44'),
(18, 'AUDIVISUAL - FOTOGRAFÍA DE EVENTOS', 1, '2022-05-26 17:04:01', '2022-05-26 17:04:01'),
(19, 'COMMUNITY MANAGER', 1, '2022-05-26 17:06:08', '2022-05-26 17:06:08'),
(20, 'ENCUENTRO DE NEGOCIOS', 1, '2022-05-26 17:12:39', '2022-05-26 17:12:39'),
(21, 'CROWDFUNDING', 1, '2022-05-26 17:13:07', '2022-05-26 17:13:07'),
(22, 'CONSULTORÍA EMPRESARIAL', 1, '2022-05-26 17:13:26', '2022-05-26 17:13:26'),
(23, 'GENERADOR DE EMPLEOS', 1, '2022-05-26 17:14:15', '2022-05-26 17:14:15'),
(24, 'MUSAS MODELS', 1, '2022-05-26 17:14:25', '2022-05-26 17:14:25'),
(25, 'RESANADO Y PINTURA', 1, '2022-05-26 17:15:11', '2022-05-26 17:15:11'),
(26, 'TRABAJOS EN DRYWALL', 1, '2022-05-26 17:15:19', '2022-05-26 17:15:19'),
(27, 'CARPINTERIA EN MELAMINE', 1, '2022-05-26 17:15:29', '2022-05-26 17:15:29'),
(28, 'ELECTRICIDAD', 1, '2022-05-26 17:15:41', '2022-05-26 17:15:41'),
(29, 'SERVICIO TÉCNICO', 1, '2022-05-26 17:15:56', '2022-05-26 17:15:56'),
(30, 'MERCHANDISING', 1, '2022-05-26 17:16:11', '2022-05-26 17:16:11'),
(31, 'VENTA DE HABILITACIONES URBANAS', 1, '2022-05-26 17:19:03', '2022-05-26 17:20:29'),
(32, 'PLAN AHORRO CASA', 1, '2022-05-26 17:19:21', '2022-05-26 17:19:21'),
(33, 'CORRETAJE INMOBILIARIO (COMPRA, VENTA Y ALQUILER)', 1, '2022-05-26 17:20:56', '2022-05-26 17:20:56'),
(34, 'GERENCIAMIENTO DE PROYECTOS', 1, '2022-05-26 17:25:42', '2022-05-26 17:25:42'),
(35, 'EJECUCIÓN Y SUPERVISIÓN DE OBRAS', 1, '2022-05-26 17:26:25', '2022-05-26 17:26:25'),
(36, 'DISEÑO DE INTERIORES Y PERSONALIZADO', 1, '2022-05-26 17:27:14', '2022-05-26 17:27:14'),
(37, 'ASEGÚRA-T', 1, '2022-05-26 17:29:40', '2022-05-26 17:29:40'),
(38, 'RENUÉVA-T', 1, '2022-05-26 17:29:49', '2022-05-26 17:29:49'),
(39, 'CREACIÓN DE PÁGINAS WEB\'S', 1, '2022-05-26 17:29:54', '2022-05-26 17:29:54'),
(40, 'TELVOIPER', 1, '2022-05-26 17:30:00', '2022-05-26 17:30:00'),
(41, 'RED SISTEL', 1, '2022-05-26 17:30:06', '2022-05-26 17:30:06'),
(42, 'TARJETAS SPOT', 1, '2022-05-26 17:30:59', '2022-05-26 17:30:59'),
(43, 'WIFI LIKE', 1, '2022-05-26 17:31:04', '2022-05-26 17:31:04'),
(44, 'DESARROLLO DE SOFTWARE', 1, '2022-05-26 17:31:19', '2022-05-26 17:31:19'),
(45, 'AAA', 1, '2022-05-26 19:14:24', '2022-05-26 19:14:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colaborador_id` bigint(20) UNSIGNED NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_colaborador_id_unique` (`colaborador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `colaborador_id`, `imagen`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'gerencia', 'gerencia@jmdesarrollador.com', NULL, '$2y$10$UIyFsbMhcVgYZ8YXJCvVQ.hQ7fPEfUBj7jp/7oOvVqN8Gf4rosIb.', 1, NULL, 1, 'Hfz6OnPYBfdhGhdG2ANBcpSeVrQgVb05rwsFThe4SR78SLGHpf4C9dPmnu60', '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(2, 'MGORDILLO', 'mgordillo@jmdesarrollador.com', NULL, '$2y$10$/H/zNms4uNeEv9bwcR6LPODt/6WJi6iISkOjzO4JbCPhYY7lGjHT.', 2, NULL, 1, NULL, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(3, 'JOHNY', 'jfacho@jmdesarrollador.com', NULL, '$2y$10$BxEtGdaBfxspQ7bnEFwk0.eYC9vnD3M.tJEfWkjMGjXYWN7wgFesq', 3, NULL, 1, NULL, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(4, 'ELIANA', 'echapilliquen@jmdesarrollador.com', NULL, '$2y$10$8U8ACaYbFK76OrjNaSKZG.bvc76PWRVIotpWMlOmt/DwwXykkjoni', 4, NULL, 1, NULL, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(5, 'KAREN', 'knunez@jmdesarrollador.com', NULL, '$2y$10$kANSlzKPAeTI0EvPJ9.JIeGT9Ln6Ra8SzvHNVArQfgIu0Kwu25nlC', 5, NULL, 1, NULL, '2022-05-26 21:27:19', '2022-05-26 21:27:19'),
(6, 'HARUMI DE MARIA', 'hyampufe@jmdesarrollador.com', NULL, '$2y$10$rx.snTPahMVDS2zjIjyPU.mOg73iuy0AFkewNs51H1WkIBTQK/rkK', 6, NULL, 1, NULL, '2022-05-26 21:27:20', '2022-05-26 21:27:20'),
(7, 'ESWIN', 'eperez@jmdesarrollador.com', NULL, '$2y$10$H3KZ6R9LMQAwfWmdThIh7epdxsZcCABYaMyLYqTC6exTe5ejbwv.C', 7, NULL, 1, NULL, '2022-05-26 21:27:20', '2022-05-26 21:27:20'),
(8, 'LAURA', 'Lyacila@jmdesarrollador.com', NULL, '$2y$10$f2/jZ3seET6D980nB77jXeNQcvoYSoy2eDzvTHNhhWvAFNgDRL9GC', 8, NULL, 1, NULL, '2022-05-26 21:27:20', '2022-05-26 21:27:20'),
(9, 'XIOMY', 'xvillegas@jmdesarrollador.com', NULL, '$2y$10$UIyOL3OoJgdJhvYUqVfM/uivKjnaQ/mSBgw0FqPUQpKltouDbQWMy', 9, NULL, 1, NULL, '2022-05-26 21:27:20', '2022-05-26 21:27:20'),
(10, 'LUCHOFEN', 'luchofen@jmdesarrollador.com', NULL, '$2y$10$M02u46/BQkZsQjQT1c.tCeNHGQ8bLxLLDvfNqXlSGgy.YkDpHUDqe', 10, NULL, 1, NULL, '2022-05-26 21:27:20', '2022-05-26 21:27:20'),
(11, 'ABEL', 'asantistebam@jmdesarrollador.com', NULL, '$2y$10$Rv3TRusG6JqtSAlDPQS0VubthHa6rGLc4zfutMW9ACkg4Mdp7KM1G', 11, NULL, 1, NULL, '2022-05-26 21:27:20', '2022-05-26 21:27:20'),
(12, 'EDWIN', 'erodriguez@nleonsac.com', NULL, '$2y$10$S8WxJa7iqaJbrf.0AqYkxuLdZcjITSX2Gew6mbC50xWibQzfOoN92', 12, NULL, 1, NULL, '2022-05-26 21:27:21', '2022-05-26 21:27:21'),
(13, 'JRODRIGUEZ', 'jrodriguez@nleonsac.com', NULL, '$2y$10$GRcHyaTWRiufATZq19DS7O8qSLqqFpkwMasqIfpROuJCHsY9IacBm', 13, NULL, 1, NULL, '2022-05-26 21:27:21', '2022-05-26 21:27:21'),
(14, 'FRANK', 'frodriguez@nleonsac.com', NULL, '$2y$10$ZMUXwcC6koGt47ZC7Piuo.sWl3X3Ge2oiwb/QEKO6Jzd7wVRO3smq', 14, NULL, 1, NULL, '2022-05-26 21:27:21', '2022-05-26 21:27:21'),
(15, 'ANGEL', 'arodriguez@nleonsac.com', NULL, '$2y$10$4xbILDCYZgbISueqFj3VXulsp2L6DKov6GfvPNSh9sFkbroHD0s5i', 15, NULL, 1, NULL, '2022-05-26 21:27:21', '2022-05-26 21:27:21'),
(16, 'VICTOR', 'emera@nleonsac.com', NULL, '$2y$10$LrgpnG15wQyLqU/LdiuPIubBxk5kvYhvaeyxwkZt4dcHElS/L/XQ6', 16, NULL, 1, NULL, '2022-05-26 21:27:21', '2022-05-26 19:13:11'),
(17, 'BRAYAN', 'bpisfil@nleonsac.com', NULL, '$2y$10$RZ0n55XbEaLT6HiO7STti.hFSG4zQyDiN9b8u1GM92b1lKRpyQGO6', 17, NULL, 1, NULL, '2022-05-26 21:27:21', '2022-05-26 21:27:21'),
(18, 'DARWIN', 'dvillanueva@nleonsac.com', NULL, '$2y$10$QMhE.U2/XNkjzmMYdGD4ROVd8ilWv76Ol0DpScOWngxj1/sb0eRsy', 18, NULL, 1, NULL, '2022-05-26 21:27:21', '2022-05-26 21:27:21'),
(19, 'MARY', 'nleon@jmholding.org', NULL, '$2y$10$R0ODAQ1O0/43qLe5zdPDE.rJGz5rMNmkKzBa3JBR535.w4S1WcZwC', 19, NULL, 1, NULL, '2022-05-26 21:27:22', '2022-05-26 21:27:22'),
(20, 'JORGE', 'jcoello@genexidu.com', NULL, '$2y$10$W/jrTOmUmrZgqwFbEaIve.oLZA7pRpdhQ0hof2TsnUePP5qGENMxW', 20, NULL, 1, NULL, '2022-05-26 21:27:22', '2022-05-26 21:27:22'),
(21, 'VANNESA', 'vburga@genexidu.com', NULL, '$2y$10$4mmFv.MHY2ubxEDzTltKrOgLZ0RWjoAtMwhivSQ64bax0mS3LDTSW', 21, NULL, 1, NULL, '2022-05-26 21:27:22', '2022-05-26 21:27:22'),
(22, 'OLGA', 'lpaz@genexidu.com', NULL, '$2y$10$.bQhjoW17dAiTiugc5NwP.0xD1NjRvPGmcOYQt85oWK7Ds.m43yHi', 22, NULL, 1, NULL, '2022-05-26 21:27:22', '2022-05-26 21:27:22'),
(23, 'LLOPEZ', 'llopez@genexidu.com', NULL, '$2y$10$Y8fHKGKL9NtqapvfyzcL0.onJC/DkBGbuNxETBmJz7oRaTxtzRYMO', 23, NULL, 1, NULL, '2022-05-26 21:27:22', '2022-05-26 21:27:22'),
(24, 'HECTOR', 'hvasquez@genexidu.com', NULL, '$2y$10$YV1To2T6.ORhgdvs59AhA.HlfH/aYzSuC2zA35odVwJfERK0VKak.', 24, NULL, 1, NULL, '2022-05-26 21:27:22', '2022-05-26 21:27:22'),
(25, 'ALEX', 'aodar@genexidu.com', NULL, '$2y$10$oWrKM1pvVN0lk62tPfE7o.c3eX6MtWHRAQkrqXUgh4U4OxxN3Slu6', 25, NULL, 1, NULL, '2022-05-26 21:27:23', '2022-05-26 21:27:23'),
(26, 'JOSE', 'jpaico@genexidu.com', NULL, '$2y$10$qloGyvMVF/3szFNYbyyVmOdFe2qSRrM17LwFr2JX9Df3ONRFExaey', 26, NULL, 1, NULL, '2022-05-26 21:27:23', '2022-05-26 21:27:23'),
(27, 'ANGIELY', 'aflores@genexidu.com', NULL, '$2y$10$wLcyLtnD1IMfVWI1TwQ91OaOH4Dw2MyKwxT.DKmOP0FvtVIw9/yJ2', 27, NULL, 1, NULL, '2022-05-26 21:27:23', '2022-05-26 21:27:23'),
(28, 'JPASACHE', 'jpasache@genexidu.com', NULL, '$2y$10$IHOLwZYjpFpTK4RQ3XaraOL9cRqT2WEzNwxickuNbhMVQoOn.bUDS', 28, NULL, 1, NULL, '2022-05-26 21:27:23', '2022-05-26 21:27:23'),
(29, 'MCABANILLAS', 'mcabanillas@genexidu.com', NULL, '$2y$10$Eltc4A8glWv32dNP2l2SZ.ip5gJxAuJ3fCn03hNlBPXJuL0wn.7DW', 29, NULL, 1, NULL, '2022-05-26 21:27:23', '2022-05-26 21:27:23'),
(30, 'GUSTAVO', 'gcaicedo@genexidu.com', NULL, '$2y$10$n1zhO1//i7WjV9bZuHZDq.pnSkxK.Hjbq1yjX8LelI2yCy1E/eL.K', 30, NULL, 1, NULL, '2022-05-26 21:27:23', '2022-05-26 21:27:23'),
(31, 'BRAYN', 'xlinares@genexidu.com', NULL, '$2y$10$3Yk3yBffwVwL1X9L7xOyEe/zFezKPkwm56VaLr6JV8FMOSLYqkB.O', 31, NULL, 1, NULL, '2022-05-26 21:27:23', '2022-05-26 21:27:23'),
(32, 'MSEMINARIO', 'mseminario@genexidu.com', NULL, '$2y$10$bWFJ4esGWO7IRtAH35OJfeXcOEM8vmda5cKlP/I8.D9kEliz4YTOa', 32, NULL, 1, NULL, '2022-05-26 21:27:24', '2022-05-26 21:27:24'),
(33, 'CESAR', 'ctello@genexidu.com', NULL, '$2y$10$QVeSLzARuR5pHVrpUNgLkuDv/fr.y46bolfEkrKsfOnnW7qlhDODq', 33, NULL, 1, NULL, '2022-05-26 21:27:24', '2022-05-26 21:27:24'),
(34, 'LISBETH', 'lrivera@jminmobiliarias.com', NULL, '$2y$10$/97dQBNTpKTFYnqe8r77suQg.FP3Crc87HOJerAnh6FwUVdU.4HS6', 34, NULL, 1, NULL, '2022-05-26 21:27:24', '2022-05-26 21:27:24'),
(35, 'KENNY', 'kaguirre@jminmobiliarias.com', NULL, '$2y$10$Y7R9EmVW0/gxy9fMR/O8O.VtPvdJFpvY3edkTtSqtRdBXw6wc8oZ2', 35, NULL, 1, NULL, '2022-05-26 21:27:24', '2022-05-26 21:27:24'),
(36, 'FIORELLA', 'fhuaman@jminmobiliarias.com', NULL, '$2y$10$CZHiT85aN9fiWQm48evJnuJmMGhTcuTBaLrpJB8W2gDjI7XR4p6ci', 36, NULL, 1, NULL, '2022-05-26 21:27:24', '2022-05-26 21:27:24'),
(37, 'RAMIRO', 'rticeran@jminmobiliarias.com', NULL, '$2y$10$pT7AnxcbMqgiu5QciqF9YOye3kRurgfgmviYFpPHF2.pv6RWJll2K', 37, NULL, 1, NULL, '2022-05-26 21:27:24', '2022-05-26 21:27:24'),
(38, 'PIERRE', 'pfigueroa@jminmobiliarias.com', NULL, '$2y$10$1jKft4oMoqt15ycAZ1W9reiMQ8g7Sp7p.qtTn0GM2KmGKpUz7CzOO', 38, NULL, 1, NULL, '2022-05-26 21:27:25', '2022-05-26 21:27:25'),
(39, 'VANESSA', 'vchumacero@jminmobiliarias.com', NULL, '$2y$10$TBSqazbkHjv8Y1GhBEvooOuPoXepWlrblYtVxE2u.p4lIO2MQWITe', 39, NULL, 1, NULL, '2022-05-26 21:27:25', '2022-05-26 21:27:25'),
(40, 'ANTHONY', 'asandoval@jminmobiliarias.com', NULL, '$2y$10$hYkI2uWkz4qokpDS1jOjGOc9PkHCkHhE9xjqhYZ81VOG0Mc7wI7z6', 40, NULL, 1, NULL, '2022-05-26 21:27:25', '2022-05-26 21:27:25'),
(41, 'KELLIE', 'test@test.com', NULL, '$2y$10$Pui7.sDA381sICQS0hxlSOri0pIoLqiPdJZwzsgWt6GThgu3WykMG', 41, NULL, 1, NULL, '2022-05-26 21:27:25', '2022-05-26 21:27:25'),
(42, 'NANLU', 'npalacios@jminmobiliarias.com', NULL, '$2y$10$tVlhz.2xR.DF1Zb3ZymnzOEuxBUhk0i0rMQhaS3Dvr.fVb7KJo0by', 42, NULL, 1, NULL, '2022-05-26 21:27:25', '2022-05-26 21:27:25'),
(43, 'ISABEL DEL MILAGRO', 'ichavez@jminmobiliarias.com', NULL, '$2y$10$EtFm/LNTS4vsIY/WWqqwd.5nQdgS/7F7SQPD30.0BlgM5s55LAocG', 43, NULL, 1, NULL, '2022-05-26 21:27:25', '2022-05-26 21:27:25'),
(44, 'SANDRO', 'schavez@jminmobiliarias.com', NULL, '$2y$10$hinMbYzJ3xW0.m/jxX1hSeSEtHp5QQt4TgJRbXtgH3nVqLUwaN1ku', 44, NULL, 1, NULL, '2022-05-26 21:27:25', '2022-05-26 21:27:25'),
(45, 'DANTE', 'dporras@jminmobiliarias.com', NULL, '$2y$10$JKTSeaK3pw6vSUXQOT83HuPD/pI/3a584mwUXfFucgZ9CTXRI5rN6', 45, NULL, 1, NULL, '2022-05-26 21:27:26', '2022-05-26 21:27:26'),
(46, 'ALBERTO', 'aerc.rodriguez20@gmail.com', NULL, '$2y$10$yqrGMQD6QBWQ3W.Yuck2suv6ZmoYgJrnWFiiRhorsM9m44IRdtSKq', 52, NULL, 1, NULL, '2022-05-26 21:27:26', '2022-05-26 21:27:26'),
(47, 'CRISTIAN', 'cristhian_vera_129@hotmail.com', NULL, '$2y$10$UMLW7vNGatRg0cauLKow1.j16EXyzf17hyncJG.MGqE/nhxnDdbPm', 53, NULL, 1, NULL, '2022-05-26 21:27:26', '2022-05-26 21:27:26'),
(48, 'JUJOCAHU019', 'jujocahu019@gmail.com', NULL, '$2y$10$vxSHJN/H05DCTGMX/52IIusKHLvI6He5Q7uAkTYcGEmGLfAAUw28.', 54, NULL, 1, NULL, '2022-05-26 21:27:26', '2022-05-26 21:27:26'),
(49, 'villegasrocio433', 'villegasrocio433@icloud.com', NULL, '$2y$10$5QoLw3wkhtEwJ/1ort10NuI0aVr4e/IS8RL9.B90lxS9xO8TURcxG', 55, NULL, 1, NULL, '2022-05-26 21:27:26', '2022-05-26 21:27:26'),
(50, 'kobet2819', 'kobet2819@hotmail.com', NULL, '$2y$10$VDP1fkExq4NWvypAbu.hbezmItG8ZwePfCtKm7B4ATGom72WEDq.e', 56, NULL, 1, NULL, '2022-05-26 21:27:26', '2022-05-26 21:27:26'),
(51, 'bgalindoidrogo', 'bgalindoidrogo@gmail.com', NULL, '$2y$10$7ko9gHNM01bK3995yuyZ7eAVozSWvdvCMhq.sSSg29jsi7Jn9.N02', 57, NULL, 1, NULL, '2022-05-26 21:27:27', '2022-05-26 21:27:27'),
(52, 'bhrayan926', 'bhrayan926@gmail.com', NULL, '$2y$10$r/O8gAAgqFCjeoTJTw6FRuq8NH1XL8Zb06ByzC4F2OMPKX/K1gLbS', 58, NULL, 1, NULL, '2022-05-26 21:27:27', '2022-05-26 21:27:27'),
(53, 'alezevallos.26', 'alezevallos.26@gmail.com', NULL, '$2y$10$5YtZCPO4fzYMAZNHq6fR6eVTCU8RBXkxT0MIkcFJLsJLuCP./5U12', 59, NULL, 1, NULL, '2022-05-26 21:27:27', '2022-05-26 21:27:27'),
(54, 'evasandriano0430', 'evasandriano0430@gmail.com', NULL, '$2y$10$ZJD9FMoTRdFxtjTM9t6mJ.I75dRveGn.3BwK/lI01nQMqrJyTCovC', 60, NULL, 1, NULL, '2022-05-26 21:27:27', '2022-05-26 21:27:27'),
(55, 'rneyze', 'rneyze@gmail.com', NULL, '$2y$10$dURVm2jeycpMKk5BU2Qx3uAuVbO5p73A2veaqMz7nXM6l6L0pZBNy', 61, NULL, 1, NULL, '2022-05-26 21:27:27', '2022-05-26 21:27:27'),
(56, 'tauroabril1968', 'tauroabril1968@gmail.com', NULL, '$2y$10$1JC9BJ2LUeKb7933cH4vTOCrr392Wngm0AaKZT7GXUJq6TQNdfpY2', 62, NULL, 1, NULL, '2022-05-26 21:27:27', '2022-05-26 21:27:27'),
(57, 'diojana.Gladisender', 'diojana.Gladisender@gmail.com', NULL, '$2y$10$9zkv1jP8J6baWDLdgDdN/eZw.F2069BW/IrXeKqsouIcAAXT/94Tu', 63, NULL, 1, NULL, '2022-05-26 21:27:27', '2022-05-26 21:27:27'),
(58, 'sergiojorpef', 'sergiojorpef@gmail.com', NULL, '$2y$10$LEg8rpp0zBNTKq3loBTnMecJg2FvXT8HPkskTKGY0xeeBehD3PyLK', 64, NULL, 1, NULL, '2022-05-26 21:27:28', '2022-05-26 21:27:28'),
(59, 'granadoslidia.14.lgc', 'granadoslidia.14.lgc@gmail.com', NULL, '$2y$10$L1/KT32nk77idAhf4Zk0ruymO/.WLYmbgyJnNXdmOCZVL7JqccMcu', 65, NULL, 1, NULL, '2022-05-26 21:27:28', '2022-05-26 21:27:28'),
(60, 'ricardo_fabriziob120901', 'ricardo_fabriziob120901@hotmail.com', NULL, '$2y$10$eGnbW5fTFR8cJKP7ozwCQeAlyW/sszVeo/.cM05iuGrMI3PU8RJwG', 66, NULL, 1, NULL, '2022-05-26 21:27:28', '2022-05-26 21:27:28'),
(61, 'sebastiandelgadoagreda', 'sebastiandelgadoagreda@gmail.com', NULL, '$2y$10$op/mGzESk4I0zRHCqXVwge/17DCkzeVySo6VJHGCCczH6jCfH.3sW', 67, NULL, 1, NULL, '2022-05-26 21:27:28', '2022-05-26 21:27:28'),
(62, 'jonatan.manay', 'jonatan.manay@gmail.comcom', NULL, '$2y$10$jJ..jH3GvwexfNKqHApQMuzloUZsE2oS7AqL7C8CSTv/zyRQsAbVG', 68, NULL, 1, NULL, '2022-05-26 21:27:28', '2022-05-26 21:27:28'),
(63, 'OSCAR', 'osalazar@compusistel.com', NULL, '$2y$10$QaWTix1YBHH0x4L1Ndq.5u/G40R1KRngZHiy9/O10RoFql7o0uybG', 46, NULL, 1, NULL, '2022-05-26 21:27:28', '2022-05-26 21:27:28'),
(64, 'JANINA', 'jrivas@compusistel.com', NULL, '$2y$10$oatJRjlExyrkN0yY7pRwGuMMHq1/DBpYfJrgD3rVFOLy/UswgWs6.', 47, NULL, 1, 'zeNFoBMXzeK2YwO3AswVFX6YY1tnhYw8nz08bRoRHrcG8Sau8yWCva8yA0Ly', '2022-05-26 21:27:29', '2022-05-26 21:27:29'),
(65, 'MARYOEI', 'mtejada@compusistel.com', NULL, '$2y$10$Q4V20vhR7g0rYVAMG9hRmOVzy9qtJDsasCjzsjFNVZ2MdQRnnXRXS', 48, NULL, 1, NULL, '2022-05-26 21:27:29', '2022-05-26 21:27:29'),
(66, 'DAVID', 'dmanayalle@compusistel.com', NULL, '$2y$10$p.CZP3kk.bwmrOAf9l8x6.FCPIZPwOxSxRjrthdcU4QMgVYOazUtm', 49, NULL, 1, NULL, '2022-05-26 21:27:29', '2022-05-26 21:27:29'),
(67, 'KATTIA', 'bibianacruzado@compusistel.com', NULL, '$2y$10$Nm/C7hCBi3ZEeGK7x7Dpwuoe07CYgLCNtcdTOx4a7vva0ObNfbTQG', 50, NULL, 1, 'NtwSzNghMlVwYlvyjKtJZzt6H1wLHdn0uwOPpiPtpMTqyx5lZKHZqHLFNtn2', '2022-05-26 21:27:29', '2022-05-28 18:52:15'),
(68, 'JDIAS', 'jdias@compusistel.com', NULL, '$2y$10$69rZ7yLNcZaqlgU8UAv.f.Km9kCLvic1JoUmnPDWT4pmUr1a7nrle', 51, NULL, 1, '3X8c4HK572EAHMcy7flCXUYpmIA9QA4OwPgsPTiLSppJf2Unf4zqMmHg6VVA', '2022-05-26 21:27:29', '2022-05-26 21:27:29'),
(69, 'ecueva', 'ecueva@jmholding.org', NULL, '$2y$10$pZQx5iJJKiPo1c2T9sixYOOh.Ka7jW.q11oJbz12Y9Kfh9cvFs2Nu', 69, NULL, 1, NULL, '2022-05-26 21:27:29', '2022-05-26 21:27:29'),
(70, 'nsalazar', 'nsalazar@jmholding.org', NULL, '$2y$10$6ZKi/l4MYQ5CDNqnRHwED.NhxQeb51lIS2dTfKVzNqNkxIOvSJAjW', 70, NULL, 1, NULL, '2022-05-26 21:27:29', '2022-05-26 21:27:29'),
(71, 'fbarrantes', 'fbarrantes@jmholding.org', NULL, '$2y$10$JjLgo4UKP45ZrBalH9NbiuN8eiehfrHkiWuI1MrFLyJXdo4uRkg86', 71, NULL, 1, NULL, '2022-05-26 21:27:30', '2022-05-26 21:27:30'),
(72, 'jfarronay', 'jfarronay@jmholding.org', NULL, '$2y$10$47otW846sx/0QwTupg20FO4CiNnOqOCck.l32BRFHakZ2Y0Jjw0Ae', 72, NULL, 1, NULL, '2022-05-26 21:27:30', '2022-05-26 21:27:30'),
(73, 'jmechan', 'jmechan@jmholding.org', NULL, '$2y$10$r9QDcoykX5D2yBnQmNMN6eC/VjbTfuYfvaJpWpOPNSZkRygyZSv9m', 73, NULL, 1, NULL, '2022-05-26 21:27:30', '2022-05-26 21:27:30'),
(74, 'jdelgado', 'jdelgado@jmholding.org', NULL, '$2y$10$tUjP1mQEOF3lT81/9uMgmu6K9qkQwgiwjSL9A1bgvR9cpEJujn5fa', 74, NULL, 1, NULL, '2022-05-26 21:27:30', '2022-05-26 21:27:30'),
(75, 'eseclen', 'eseclen@jmholding.org', NULL, '$2y$10$TOvwXPyc6Pv6Wmmygq5MXevI22CvafxyTjZAxii/sCZI6kUz8QXiS', 75, NULL, 1, NULL, '2022-05-26 21:27:30', '2022-05-26 21:27:30');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_cita_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `fk_cita_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `fk_colaborador_empresa_area` FOREIGN KEY (`empresa_area_id`) REFERENCES `empresa_areas` (`id`);

--
-- Filtros para la tabla `detalle_citas`
--
ALTER TABLE `detalle_citas`
  ADD CONSTRAINT `fk_detalle_cita_cita` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `fk_detalle_cita_user` FOREIGN KEY (`usuario_colab_id`) REFERENCES `colaboradores` (`id`);

--
-- Filtros para la tabla `detalle_requerimientos`
--
ALTER TABLE `detalle_requerimientos`
  ADD CONSTRAINT `fk_detalle_requerimiento_requerimiento` FOREIGN KEY (`requerimiento_id`) REFERENCES `requerimientos` (`id`),
  ADD CONSTRAINT `fk_detalle_requerimiento_user` FOREIGN KEY (`usuario_colab_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `empresa_areas`
--
ALTER TABLE `empresa_areas`
  ADD CONSTRAINT `fk_empresa_area` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `fk_empresa_area_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `empresa_servicios`
--
ALTER TABLE `empresa_servicios`
  ADD CONSTRAINT `fk_empresa_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`),
  ADD CONSTRAINT `fk_empresa_servicio_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `historial_requerimientos`
--
ALTER TABLE `historial_requerimientos`
  ADD CONSTRAINT `fk_historial_requerimiento_detalle` FOREIGN KEY (`detalle_requerimiento_id`) REFERENCES `detalle_requerimientos` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  ADD CONSTRAINT `fk_empresa_servicios_requerimientos` FOREIGN KEY (`empresa_servicio_id`) REFERENCES `empresa_servicios` (`id`),
  ADD CONSTRAINT `fk_requerimientos_usersregist` FOREIGN KEY (`usuarioregist_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `requerimiento_encargados`
--
ALTER TABLE `requerimiento_encargados`
  ADD CONSTRAINT `fk_requerimiento_encargado:requerimiento` FOREIGN KEY (`requerimiento_id`) REFERENCES `requerimientos` (`id`),
  ADD CONSTRAINT `fk_requerimientos_usersencarg` FOREIGN KEY (`usuarioencarg_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_colaborador` FOREIGN KEY (`colaborador_id`) REFERENCES `colaboradores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
