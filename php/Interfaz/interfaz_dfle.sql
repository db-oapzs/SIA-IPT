-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2024 a las 21:59:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `interfaz_dfle`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidades_alumnos`
--

CREATE TABLE `cantidades_alumnos` (
  `ID_Registro` int(11) NOT NULL,
  `Desc_Hombres` int(11) DEFAULT 0,
  `Desc_Mujeres` int(11) DEFAULT 0,
  `id_UnidadAcademica` int(11) DEFAULT NULL,
  `id_Competencia` int(11) DEFAULT NULL,
  `id_Idioma` int(11) DEFAULT NULL,
  `id_TipoPoblacion` int(11) DEFAULT NULL,
  `id_NivelEducativo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cantidades_alumnos`
--

INSERT INTO `cantidades_alumnos` (`ID_Registro`, `Desc_Hombres`, `Desc_Mujeres`, `id_UnidadAcademica`, `id_Competencia`, `id_Idioma`, `id_TipoPoblacion`, `id_NivelEducativo`) VALUES
(1, 5, 9, 2, 1, 11, 1, 2),
(2, 4, 10, 2, 1, 11, 1, 5),
(3, 0, 6, 2, 1, 11, 1, 3),
(4, 4, 11, 2, 1, 11, 2, 4),
(5, 6, 13, 2, 2, 7, 1, 2),
(6, 13, 20, 2, 2, 7, 1, 5),
(7, 0, 1, 2, 2, 7, 1, 3),
(8, 12, 11, 2, 2, 7, 2, 4),
(9, 1, 3, 2, 3, 7, 1, 2),
(10, 4, 9, 2, 3, 7, 1, 5),
(11, 3, 4, 2, 3, 7, 2, 4),
(12, 1, 7, 2, 1, 12, 1, 1),
(13, 5, 28, 2, 1, 12, 1, 2),
(14, 11, 23, 2, 1, 12, 1, 5),
(15, 5, 59, 2, 1, 12, 2, 4),
(16, 15, 13, 4, 1, 1, 1, 2),
(17, 142, 101, 3, 1, 1, 1, 1),
(18, 3, 8, 3, 1, 1, 1, 2),
(19, 2, 3, 3, 1, 1, 1, 3),
(20, 57, 82, 3, 1, 1, 2, 4),
(21, 38, 23, 3, 2, 1, 1, 1),
(22, 1, 0, 3, 2, 1, 1, 3),
(23, 34, 31, 3, 2, 1, 2, 4),
(24, 17, 9, 3, 3, 1, 1, 1),
(25, 10, 13, 3, 3, 1, 1, 2),
(26, 20, 24, 3, 3, 1, 2, 4),
(27, 284, 174, 4, 1, 1, 1, 1),
(28, 15, 13, 4, 1, 1, 1, 2),
(29, 2, 3, 4, 1, 1, 1, 3),
(30, 38, 64, 4, 1, 1, 2, 4),
(31, 51, 37, 4, 2, 1, 1, 1),
(32, 19, 12, 4, 2, 1, 1, 2),
(33, 1, 2, 4, 2, 1, 1, 3),
(34, 6, 19, 4, 2, 1, 2, 4),
(35, 16, 17, 4, 3, 1, 1, 1),
(36, 35, 9, 4, 3, 1, 1, 2),
(37, 2, 0, 4, 3, 1, 1, 3),
(38, 6, 8, 4, 3, 1, 2, 4),
(39, 4, 8, 4, 1, 2, 1, 1),
(40, 0, 1, 4, 1, 2, 1, 2),
(41, 2, 1, 4, 2, 2, 1, 1),
(42, 206, 137, 5, 1, 1, 1, 1),
(43, 36, 43, 5, 1, 1, 1, 2),
(44, 1, 0, 5, 1, 1, 1, 3),
(45, 317, 384, 5, 1, 1, 2, 4),
(46, 75, 80, 5, 2, 1, 1, 1),
(47, 35, 29, 5, 2, 1, 1, 2),
(48, 1, 0, 5, 2, 1, 1, 5),
(49, 79, 136, 5, 2, 1, 2, 4),
(50, 43, 40, 5, 3, 1, 1, 1),
(51, 29, 19, 5, 3, 1, 1, 2),
(52, 2, 3, 5, 3, 1, 1, 5),
(53, 55, 63, 5, 3, 1, 2, 4),
(54, 142, 101, 3, 1, 1, 1, 1),
(55, 3, 8, 3, 1, 1, 1, 2),
(56, 2, 3, 3, 1, 1, 1, 3),
(57, 57, 82, 3, 1, 1, 2, 4),
(58, 38, 23, 3, 2, 1, 1, 1),
(59, 1, 0, 3, 2, 1, 1, 3),
(60, 34, 31, 3, 2, 1, 2, 4),
(61, 17, 9, 3, 3, 1, 1, 1),
(62, 10, 13, 3, 3, 1, 1, 2),
(63, 20, 24, 3, 3, 1, 2, 4),
(64, 284, 174, 4, 1, 1, 1, 1),
(65, 1, 2, 2, 2, 2, 1, 3),
(66, 13, 30, 2, 2, 2, 2, 4),
(67, 1, 0, 2, 3, 2, 1, 1),
(68, 3, 8, 2, 3, 2, 1, 2),
(69, 10, 14, 2, 3, 2, 1, 5),
(70, 3, 6, 2, 3, 2, 2, 4),
(71, 17, 13, 2, 1, 3, 1, 1),
(72, 94, 129, 2, 1, 3, 1, 2),
(73, 1, 3, 2, 1, 3, 1, 6),
(74, 95, 66, 2, 1, 3, 1, 5),
(75, 2, 5, 2, 1, 3, 1, 3),
(76, 98, 97, 2, 1, 3, 2, 4),
(77, 0, 1, 2, 2, 3, 1, 1),
(78, 4, 6, 2, 2, 3, 1, 2),
(79, 4, 5, 2, 2, 3, 1, 5),
(80, 2, 2, 2, 2, 3, 2, 4),
(81, 1, 2, 2, 3, 3, 1, 2),
(82, 1, 0, 2, 3, 3, 1, 6),
(83, 8, 8, 2, 3, 3, 1, 5),
(84, 0, 1, 2, 3, 3, 1, 3),
(85, 2, 2, 2, 3, 3, 2, 4),
(86, 4, 11, 2, 1, 4, 1, 1),
(87, 24, 43, 2, 1, 4, 1, 2),
(88, 0, 1, 2, 1, 4, 1, 6),
(89, 19, 35, 2, 1, 4, 1, 5),
(90, 2, 5, 2, 1, 4, 1, 3),
(91, 32, 74, 2, 1, 4, 2, 4),
(92, 2, 1, 2, 2, 4, 1, 1),
(93, 9, 18, 2, 2, 4, 1, 2),
(94, 11, 20, 2, 2, 4, 1, 5),
(95, 5, 18, 2, 2, 4, 2, 4),
(96, 1, 3, 2, 3, 4, 1, 2),
(97, 3, 6, 2, 3, 4, 1, 5),
(98, 0, 5, 2, 3, 4, 2, 4),
(99, 14, 9, 2, 1, 5, 1, 1),
(100, 39, 42, 2, 1, 5, 1, 2),
(101, 0, 1, 2, 1, 5, 1, 6),
(102, 47, 36, 2, 1, 5, 1, 5),
(103, 1, 2, 2, 1, 5, 1, 3),
(104, 49, 47, 2, 1, 5, 2, 4),
(105, 1, 2, 2, 1, 7, 1, 1),
(106, 11, 13, 2, 1, 7, 1, 2),
(107, 0, 1, 2, 1, 7, 1, 6),
(108, 17, 25, 2, 1, 7, 1, 5),
(109, 2, 1, 2, 1, 7, 1, 3),
(110, 13, 14, 2, 1, 7, 2, 4),
(111, 1, 0, 5, 1, 1, 1, 3),
(112, 317, 384, 5, 1, 1, 2, 4),
(113, 75, 80, 5, 2, 1, 1, 1),
(114, 35, 29, 5, 2, 1, 1, 2),
(115, 1, 0, 5, 2, 1, 1, 5),
(116, 79, 136, 5, 2, 1, 2, 4),
(117, 43, 40, 5, 3, 1, 1, 1),
(118, 29, 19, 5, 3, 1, 1, 2),
(119, 2, 3, 5, 3, 1, 1, 5),
(120, 55, 63, 5, 3, 1, 2, 4),
(121, 2, 6, 18, 1, 1, 1, 1),
(122, 77, 50, 18, 1, 1, 1, 2),
(123, 36, 20, 18, 1, 1, 1, 5),
(124, 3, 0, 18, 1, 1, 1, 3),
(125, 29, 31, 18, 1, 1, 2, 4),
(126, 2, 1, 18, 2, 1, 1, 1),
(127, 58, 38, 18, 2, 1, 1, 2),
(128, 38, 24, 18, 2, 1, 1, 5),
(129, 3, 0, 18, 2, 1, 1, 3),
(130, 14, 8, 18, 2, 1, 2, 4),
(131, 2, 0, 18, 3, 1, 1, 1),
(132, 45, 28, 18, 3, 1, 1, 2),
(133, 22, 25, 18, 3, 1, 1, 5),
(134, 2, 1, 18, 3, 1, 1, 3),
(135, 9, 6, 18, 3, 1, 2, 4),
(136, 3, 2, 19, 1, 1, 1, 1),
(137, 15, 19, 19, 1, 1, 1, 2),
(138, 3, 0, 19, 1, 1, 1, 6),
(139, 1, 0, 19, 1, 1, 1, 5),
(140, 0, 1, 19, 1, 1, 1, 3),
(141, 10, 23, 19, 1, 1, 2, 4),
(142, 22, 13, 19, 2, 1, 1, 2),
(143, 0, 1, 19, 2, 1, 1, 6),
(144, 0, 1, 19, 2, 1, 1, 5),
(145, 0, 1, 19, 2, 1, 1, 3),
(146, 1, 4, 19, 2, 1, 2, 4),
(147, 15, 6, 19, 3, 1, 1, 2),
(148, 2, 1, 19, 3, 1, 1, 5),
(149, 2, 5, 19, 3, 1, 2, 4),
(150, 94, 150, 2, 1, 1, 1, 1),
(151, 320, 627, 2, 1, 1, 1, 2),
(152, 4, 7, 2, 1, 1, 1, 6),
(153, 161, 222, 2, 1, 1, 1, 5),
(154, 11, 18, 2, 1, 1, 1, 3),
(155, 490, 798, 2, 1, 1, 2, 4),
(156, 33, 49, 2, 2, 1, 1, 1),
(157, 175, 367, 2, 2, 1, 1, 2),
(158, 4, 2, 2, 2, 1, 1, 6),
(159, 106, 151, 2, 2, 1, 1, 5),
(160, 1, 4, 2, 2, 1, 1, 3),
(161, 137, 194, 2, 2, 1, 2, 4),
(162, 27, 22, 2, 3, 1, 1, 1),
(163, 123, 155, 2, 3, 1, 1, 2),
(164, 1, 6, 2, 3, 1, 1, 6),
(165, 104, 125, 2, 3, 1, 1, 5),
(166, 2, 3, 2, 3, 1, 1, 3),
(167, 97, 122, 2, 3, 1, 2, 4),
(168, 4, 2, 2, 4, 1, 1, 1),
(169, 25, 44, 2, 4, 1, 1, 2),
(170, 0, 3, 2, 4, 1, 1, 6),
(171, 32, 38, 2, 4, 1, 1, 5),
(172, 1, 1, 2, 4, 1, 1, 3),
(173, 19, 26, 2, 4, 1, 2, 4),
(174, 10, 21, 2, 1, 2, 1, 1),
(175, 52, 145, 2, 1, 2, 1, 2),
(176, 0, 2, 2, 1, 2, 1, 6),
(177, 82, 97, 2, 1, 2, 1, 5),
(178, 2, 1, 2, 1, 2, 1, 3),
(179, 90, 163, 2, 1, 2, 2, 4),
(180, 1, 5, 2, 2, 2, 1, 1),
(181, 22, 40, 2, 2, 2, 1, 2),
(182, 23, 32, 2, 2, 2, 1, 5),
(183, 2, 3, 4, 1, 1, 1, 3),
(184, 38, 64, 4, 1, 1, 2, 4),
(185, 51, 37, 4, 2, 1, 1, 1),
(186, 19, 12, 4, 2, 1, 1, 2),
(187, 1, 2, 4, 2, 1, 1, 3),
(188, 6, 19, 4, 2, 1, 2, 4),
(189, 16, 17, 4, 3, 1, 1, 1),
(190, 35, 9, 4, 3, 1, 1, 2),
(191, 2, 0, 4, 3, 1, 1, 3),
(192, 6, 8, 4, 3, 1, 2, 4),
(193, 4, 8, 4, 1, 2, 1, 1),
(194, 0, 1, 4, 1, 2, 1, 2),
(195, 2, 1, 4, 2, 2, 1, 1),
(196, 206, 137, 5, 1, 1, 1, 1),
(197, 36, 43, 5, 1, 1, 1, 2),
(198, 0, 1, 2, 2, 7, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidades_formato_11`
--

CREATE TABLE `cantidades_formato_11` (
  `ID_Registro_11` int(11) NOT NULL,
  `Desc_Hombres` int(11) DEFAULT 0,
  `Desc_Mujeres` int(11) DEFAULT 0,
  `id_UnidadCenlex` int(11) DEFAULT NULL,
  `id_Idioma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `ID_Cargo` int(11) NOT NULL,
  `Desc_Cargo` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`ID_Cargo`, `Desc_Cargo`) VALUES
(1, 'Directora'),
(2, 'SUBDIRECTOR DE APOYO Y EXTENSIÓN'),
(3, 'SUBDIRECTORA DE APOYO Y EXTENSIÓN'),
(4, 'Coordinadora de CELEX'),
(5, 'Director'),
(6, 'Coordinador Académico de CELEX'),
(7, 'Coordinadora Administrativa de los CELEX'),
(8, 'Coordinador de CELEX'),
(9, 'Coordinadora Académica de los CELEX'),
(10, 'Encargado de los CELEX'),
(11, 'Director Interino'),
(12, 'UPIS'),
(13, 'Coordinadora de los CELEX'),
(14, 'Jefa de la UPIS'),
(15, 'Coordinador Administrativo de los CELEX'),
(16, 'Coordinador de los CELEX'),
(17, 'Directora Interina'),
(18, 'Encargada de los CELEX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrasena_hash`
--

CREATE TABLE `contrasena_hash` (
  `ID_ContrasenaHash` int(11) NOT NULL,
  `Desc_Contrasena_Hash` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrasena_hash`
--

INSERT INTO `contrasena_hash` (`ID_ContrasenaHash`, `Desc_Contrasena_Hash`) VALUES
(1, 'AAaa11@@'),
(2, 'AAaa11@@'),
(3, 'AAaa11@@'),
(4, 'AAaa11@@'),
(5, 'AAaa11@@'),
(6, 'AAaa11@@'),
(7, 'AAaa11@@'),
(8, 'AAaa11@@'),
(9, 'AAaa11@@'),
(10, 'AAaa11@@'),
(11, 'AAaa11@@'),
(12, 'AAaa11@@'),
(13, 'AAaa11@@'),
(14, 'AAaa11@@'),
(15, 'AAaa11@@'),
(16, 'AAaa11@@'),
(17, 'AAaa11@@'),
(18, 'AAaa11@@'),
(19, 'AAaa11@@'),
(20, 'AAaa11@@'),
(21, 'AAaa11@@'),
(22, 'AAaa11@@'),
(23, 'AAaa11@@'),
(24, 'AAaa11@@'),
(25, 'AAaa11@@'),
(26, 'AAaa11@@'),
(27, 'AAaa11@@'),
(28, 'AAaa11@@'),
(29, 'AAaa11@@'),
(30, 'AAaa11@@');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo_electronico`
--

CREATE TABLE `correo_electronico` (
  `ID_CorreoElectronico` int(11) NOT NULL,
  `Desc_Correo_Electronico` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `correo_electronico`
--

INSERT INTO `correo_electronico` (`ID_CorreoElectronico`, `Desc_Correo_Electronico`) VALUES
(1, 'asolanop@ipn.mx;'),
(2, 'msandovaln@ipn.mx;'),
(3, 'apgarcia@ipn.mx;'),
(4, 'migarcias@ipn.mx;'),
(5, 'helen_ponce@hotmail.com;'),
(6, 'mgarciasu@ipn.mx;'),
(7, 'tyshcecyt2@gmail.com;'),
(8, 'jlmoralesg@ipn.mx;'),
(9, 'marosasmv3@gmail.com; celex.academica.cecyt3@gmail.com;'),
(10, 'jdaguila@ipn.mx;'),
(11, 'maryvs_195@hotmail.com;'),
(12, 'cecyt7@ipn.mx;'),
(13, 'br.floresc@gmail.com;'),
(14, 'cecyt10@ipn.mx; emartinezde@ipn.mx;'),
(15, 'lydia.barragan@gmail.com;'),
(16, 'cgarciaj@ipn.mx;'),
(17, 'kohlerthania@gmail.com;'),
(18, 'cecyt13direccion@ipn.mx;'),
(19, 'jvelascod@ipn.mx; janettvel@yahoo.com.mx'),
(20, 'rmezav@ipn.mx;'),
(21, 'celex.cecyt17@ipn.mx;'),
(22, 'gvilledam@ipn.mx;'),
(23, 'celexaccecyt19@gmail.com;'),
(24, 'cecyt19@ipn.mx; emaciasm@ipn.mx;'),
(25, 'celexesimezacatenco@gmail.com;'),
(26, 'mencisoa@ipn.mx;'),
(27, 'amateosc@ipn.mx;'),
(28, 'druizd@ipn.mx;'),
(29, 'celexazc@ipn.mx;'),
(30, 'hbautista@ipn.mx;'),
(31, 'smartinezb2@gmail.com'),
(32, 'searroyo@ipn.mx;'),
(33, 'upis_esiatec@ipn.mx;'),
(34, 'ccisnerosa@gmail.com; direc_esiatec@ipn.mx;'),
(35, 'celex_esiqie@hotmail.com;'),
(36, 'gsilvao@ipn.mx; direccion_esiqie@ipn.mx'),
(37, 'abasurtoh@ipn.mx; celex.esfm@yahoo.com; celexesfm@ipn.mx; coord.celexesfm@gmail.com'),
(38, 'mnerir@ipn.mx;'),
(39, 'celexescom@hotmail.com; gely1206@hotmail.com;'),
(40, 'aortigoza@ipn.mx;'),
(41, 'celex_upiicsa3@hotmail.com;'),
(42, 'egonzalezro@ipn.mx;'),
(43, 'celex.upiita@ipn.mx; asalinasg@ipn.mx;'),
(44, 'rhavila@ipn.mx; dir.upiita@ipn.mx;'),
(45, 'aarcem@ipn.mx; upis_upiig@ipn.mx;'),
(46, 'rohernandezs@ipn.mx;'),
(47, 'celexzacatecas@gmail.com;'),
(48, 'ffloresm@ipn.mx;'),
(49, 'svaras@ipn.mx; celex.upiih@ipn.mx;'),
(50, 'ggarciaga@ipn.mx;'),
(51, 'nallek_15lac@hotmail.com; celexencb22@gmail.com;'),
(52, 'ilunar@ipn.mx;'),
(53, 'norma_aguilera@hotmail.com;'),
(54, 'arojasro@ipn.mx;'),
(55, 'jmvargasg@ipn.mx;'),
(56, 'jfomperosa@ipn.mx;'),
(57, 'victorlopezcisneros@gmail.com;'),
(58, 'mortegah@ipn.mx;'),
(59, 'coordinacion.celex.est@gmail.com; migaybe@gmail.com;'),
(60, 'malonso@ipn.mx;');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_bloqueado`
--

CREATE TABLE `estatus_bloqueado` (
  `ID_EstatusBloqueo` int(11) NOT NULL,
  `Desc_Estatus_Bloqueo` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estatus_bloqueado`
--

INSERT INTO `estatus_bloqueado` (`ID_EstatusBloqueo`, `Desc_Estatus_Bloqueo`) VALUES
(1, b'1'),
(2, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_deshabilitado`
--

CREATE TABLE `estatus_deshabilitado` (
  `ID_EstatusDeshabilitado` int(11) NOT NULL,
  `Desc_Estatus_Deshabilitado` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estatus_deshabilitado`
--

INSERT INTO `estatus_deshabilitado` (`ID_EstatusDeshabilitado`, `Desc_Estatus_Deshabilitado`) VALUES
(1, b'0'),
(2, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE `idiomas` (
  `ID_Idioma` int(11) NOT NULL,
  `Desc_Idioma` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`ID_Idioma`, `Desc_Idioma`) VALUES
(1, 'INGLÉS'),
(2, 'FRANCÉS'),
(3, 'ALEMÁN'),
(4, 'ITALIANO'),
(5, 'JAPONÉS'),
(6, 'CHINO-MANDARÍN'),
(7, 'PORTUGUÉS'),
(8, 'RUSO'),
(9, 'NÁHUATL'),
(10, 'ESPAÑOL'),
(11, 'SEÑAS MEXICANAS'),
(12, 'COREANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_competencia`
--

CREATE TABLE `niveles_competencia` (
  `ID_Competencia` int(11) NOT NULL,
  `Desc_Nivel_De_Competencia` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `niveles_competencia`
--

INSERT INTO `niveles_competencia` (`ID_Competencia`, `Desc_Nivel_De_Competencia`) VALUES
(1, 'BASICO'),
(2, 'INTERMEDIO'),
(3, 'AVANZADO'),
(4, 'SUPERIOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_educativo`
--

CREATE TABLE `nivel_educativo` (
  `ID_NivelEducativo` int(11) NOT NULL,
  `Desc_NivelEducativo` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nivel_educativo`
--

INSERT INTO `nivel_educativo` (`ID_NivelEducativo`, `Desc_NivelEducativo`) VALUES
(1, 'MEDIO SUPERIOR'),
(2, 'SUPERIOR'),
(3, 'EMPLEADOS'),
(4, 'No aplica'),
(5, 'EGRESADOS'),
(6, 'POSGRADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombres_titulares`
--

CREATE TABLE `nombres_titulares` (
  `ID_NombreTitular` int(11) NOT NULL,
  `Desc_Nombre_Titular` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nombres_titulares`
--

INSERT INTO `nombres_titulares` (`ID_NombreTitular`, `Desc_Nombre_Titular`) VALUES
(1, 'Ing. María de los Ángeles Sandoval Negrete'),
(2, 'Lic. Minerva García Silva'),
(3, 'DRA. MARÍA DEL ROSARIO GARCÍA SUÁREZ'),
(4, 'M. EN E. JOSE LUIS MORALES GASPAR'),
(5, 'M. EN E. JOSÉ DIEGO RUBÉN AGUILA CHÁVEZ'),
(6, 'DR. ABELARDO RIVERA CORSI'),
(7, 'Mtro. Emilio Martinez Delfín'),
(8, 'DR. CARLOS GARCÍA JAIME'),
(9, 'C.P. PATRICIA BALTAZAR TRUJILLO'),
(10, 'DR. RAFAEL ALFONSO MEZA VILLANUEVA'),
(11, 'DR. GABRIEL VILLEDA MUÑOZ'),
(12, 'M. EN C. ENRIQUE MACÍAS MAYA'),
(13, 'DR. MAURO ALBERTO ENCISO AGUILAR'),
(14, 'MTRA. DALIA RUÍZ DOMÍNGUEZ'),
(15, 'MTRO. HILARIO BAUTISTA MORALES'),
(16, 'M. EN A. SERGIO CÉSAR ARROYO TREJO'),
(17, 'M. EN A. CARLOS CISNEROS ARAUJO'),
(18, 'DRA. GUADALUPE SILVA OLIVER'),
(19, 'DR. MIGUEL NERI ROSAS'),
(20, 'M. EN C. ANDRÉS ORTIGOZA CAMPOS'),
(21, 'M. EN C. EMMANUEL GONZÁLEZ ROGEL'),
(22, 'M. EN C. RAMÓN HERRERA ÁVILA'),
(23, 'DRA. ROSA HERNÁNDEZ SOTO'),
(24, 'DR. FERNANDO FLORES MEJÍA'),
(25, 'DR. GILBERTO ALEJANDRO GARCÍA GUERRA'),
(26, 'DR. ISAAC JUAN LUNA ROMERO'),
(27, 'MTRO. ALONSO ROJAS RODRÍGUEZ'),
(28, 'M. EN F. JUDITH MARINA FOMPEROSA MEZA'),
(29, 'MTRO. MANUEL FRANCISCO ORTEGA HERNÁNDEZ'),
(30, 'DRA. MARISSA ALONSO MARBÁN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombre_usuarios`
--

CREATE TABLE `nombre_usuarios` (
  `ID_NombreUsuario` int(11) NOT NULL,
  `Desc_Nombre_Usuario` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nombre_usuarios`
--

INSERT INTO `nombre_usuarios` (`ID_NombreUsuario`, `Desc_Nombre_Usuario`) VALUES
(1, 'M. en T. Adrian Solano Palma'),
(2, 'Lic. Ana Paula García Palma'),
(3, 'M. en E. Helen Marlene Ponce Velázquez'),
(4, 'M. en D. y G.E. Tania Ytzel Silva Hernández'),
(5, 'Lic. Marco Antonio Rosas de Jesús'),
(6, 'Dra. María Luisa Velasco Sánchez'),
(7, 'Lic. Brenda Jazmín Corona Flores'),
(8, 'Lic. Lydia Carol Barragán Torres'),
(9, 'Mtra. Rosa Thania Kohler Maldonado'),
(10, 'Mtra. Janett Velasco De la Peña'),
(11, 'Mtro. Ángel Gustavo Rodríguez Gómez '),
(12, 'M. en D. Rocío Sánchez López'),
(13, 'Profa. Ana Laura Diaz Barroso'),
(14, 'Lic. Alejandro Mateos Chavez'),
(15, 'Lic. Martha Teresa Longoria Dosamantes'),
(16, 'Dra. Sonia Martínez Balboa'),
(17, 'Ing. Arq. Edgar Hernández Constantino'),
(18, 'Dr. Francisco Ernesto Velasco Hernández'),
(19, 'Lic. Andrea Jacqueline Basurto Hernández'),
(20, 'Lic. Angélica Pérez Beltrán'),
(21, 'Mtra. Ana Lilia Rodelas Flores'),
(22, 'Lic. Alejandra Teresa Salinas Gómez'),
(23, 'Ing. Adriana Edith Arce Martínez'),
(24, 'Lic. Erika Quirino Calderón'),
(25, 'Lic. Soraida Victoria Varas Domínguez'),
(26, 'LRC. Nallely Kavanagh Luna'),
(27, 'Profa. Norma Julia Aguilera Celis'),
(28, 'Mtro. Juan Manuel Vargas García'),
(29, 'Lic. Víctor López Cisneros'),
(30, 'Mtra. Rebeca Mirafuentes Cabrera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numero_telefono`
--

CREATE TABLE `numero_telefono` (
  `ID_NumeroTelefono` int(11) NOT NULL,
  `Desc_Numero_Telefono` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `numero_telefono`
--

INSERT INTO `numero_telefono` (`ID_NumeroTelefono`, `Desc_Numero_Telefono`) VALUES
(1, '55-5729-6000 ext. 54722'),
(2, '5729 6000 EXT. 54746'),
(3, '55-5729-6000 ext. 61852'),
(4, '5729 6000 EXT. 46240'),
(5, '55-5729-6000 ext. 71556, 71504'),
(6, '57-29-60-00 ext. 71501'),
(7, '55-5729-6000 ext. 67032'),
(8, '57-29-60-00 ext. 71501'),
(9, '55-5729-6000 ext. 74014'),
(10, '57-29-60-00 ext. 74004'),
(11, '55-5729-6000 ext. 72007'),
(12, '57296000 ext. 42021'),
(13, '55-5729-6000 ext. 71025'),
(14, '57-29-60-00 ext. 42080'),
(15, '55-5729-6000 ext. 66682'),
(16, '57-29-60-00 ext. 66301'),
(17, '55-5729-6000 ext. 72303'),
(18, '57-29-60-00 ext. 42048'),
(19, '55-5729-6000 ext. 72511'),
(20, '57-29-60-00 ext. 72500'),
(21, '477 252 1600'),
(22, '57-29-60-00 ext. 42060'),
(23, '5572140085'),
(24, '57-29-60-00 ext. 84001'),
(25, '55-5729-6000 ext. 54557'),
(26, ' 57296000 ext. 46170, 54512/54513'),
(27, '55-5729-6000 ext. 73014, 73047'),
(28, '5624 200 EXT 42031, 73000, 73081'),
(29, '55-5729-6000 ext. 64309'),
(30, '57296000 EXT. 64382, 64383'),
(31, '55-5729-6000 ext. 53087'),
(32, '57-29-60-00 EXT. 53102'),
(33, '55-5729-6000 ext. 68064'),
(34, '57296000 ext. 46334, 46335, 68030 y 68031'),
(35, '55-5729-6000 ext. 54219'),
(36, '5729-6000 ext 46140'),
(37, '55-5729-6000 ext. 55423'),
(38, '57296000 Ext.55343'),
(39, '55-5729-6000 ext. 52008'),
(40, '57296000 EXT 46188,. 52000'),
(41, '5624-2000 ext, 70032, 70034'),
(42, '56242000 EXT 42001, 70076'),
(43, '55-5729-6000 ext. 56871'),
(44, '5729-6000   EXT. 46305'),
(45, '55-5729-6000 ext. 81414'),
(46, '01 (55) 57 29 60 00 Ext.81301, 81310'),
(47, '55-5729-6000 ext. 83551'),
(48, '57296000 Ext. 83501, 83502, 83555'),
(49, '59296000 ext. 83907'),
(50, '57296000 ext. 83902'),
(51, '55-5729-6000 ext. 62542, 62448'),
(52, '57296300  ext. 46268'),
(53, '55-5729-6000 ext.61535'),
(54, '5729-6000 EXT.  46235, 61578'),
(55, '55-5729-6000 ext. 73616'),
(56, '57296000 EXT. 42039, 73500'),
(57, '55-5729-6000 ext. 62044'),
(58, '57296000 EXT. 46251,  62013, 62075'),
(59, '55-5729-6000 ext. 55775'),
(60, '5729-6000 EXT. 46105, 55765');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabra_aleatoria`
--

CREATE TABLE `palabra_aleatoria` (
  `ID_PalabraAleatoria` int(11) NOT NULL,
  `Desc_Palabra_Aleatoria` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `palabra_aleatoria`
--

INSERT INTO `palabra_aleatoria` (`ID_PalabraAleatoria`, `Desc_Palabra_Aleatoria`) VALUES
(1, 'PalabraAleatoria'),
(2, 'PalabraAleatoria'),
(3, 'PalabraAleatoria'),
(4, 'PalabraAleatoria'),
(5, 'PalabraAleatoria'),
(6, 'PalabraAleatoria'),
(7, 'PalabraAleatoria'),
(8, 'PalabraAleatoria'),
(9, 'PalabraAleatoria'),
(10, 'PalabraAleatoria'),
(11, 'PalabraAleatoria'),
(12, 'PalabraAleatoria'),
(13, 'PalabraAleatoria'),
(14, 'PalabraAleatoria'),
(15, 'PalabraAleatoria'),
(16, 'PalabraAleatoria'),
(17, 'PalabraAleatoria'),
(18, 'PalabraAleatoria'),
(19, 'PalabraAleatoria'),
(20, 'PalabraAleatoria'),
(21, 'PalabraAleatoria'),
(22, 'PalabraAleatoria'),
(23, 'PalabraAleatoria'),
(24, 'PalabraAleatoria'),
(25, 'PalabraAleatoria'),
(26, 'PalabraAleatoria'),
(27, 'PalabraAleatoria'),
(28, 'PalabraAleatoria'),
(29, 'PalabraAleatoria'),
(30, 'PalabraAleatoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacioncontra`
--

CREATE TABLE `recuperacioncontra` (
  `id` int(11) NOT NULL,
  `id_correo` int(11) DEFAULT NULL,
  `clave_temporal` varchar(255) NOT NULL,
  `palabra_random` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `hora_creacion` varchar(255) NOT NULL,
  `hora_vencimiento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_dentro_del_sistema`
--

CREATE TABLE `rol_dentro_del_sistema` (
  `ID_Rol` int(11) NOT NULL,
  `Desc_Rol` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_dentro_del_sistema`
--

INSERT INTO `rol_dentro_del_sistema` (`ID_Rol`, `Desc_Rol`) VALUES
(1, 'Rol1'),
(2, 'Rol2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_poblacion`
--

CREATE TABLE `tipo_poblacion` (
  `ID_TipoPoblacion` int(11) NOT NULL,
  `Desc_TipoPoblacion` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_poblacion`
--

INSERT INTO `tipo_poblacion` (`ID_TipoPoblacion`, `Desc_TipoPoblacion`) VALUES
(1, 'Población IPN'),
(2, 'Población General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titular_unidad`
--

CREATE TABLE `titular_unidad` (
  `ID_Titular` int(11) NOT NULL,
  `id_NombreTitular` int(11) DEFAULT NULL,
  `id_Cargo` int(11) DEFAULT NULL,
  `id_NumeroTelefono` int(11) DEFAULT NULL,
  `id_CorreoElectronico` int(11) DEFAULT NULL,
  `id_UnidadAcademica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `titular_unidad`
--

INSERT INTO `titular_unidad` (`ID_Titular`, `id_NombreTitular`, `id_Cargo`, `id_NumeroTelefono`, `id_CorreoElectronico`, `id_UnidadAcademica`) VALUES
(1, 1, 1, 2, 2, 1),
(2, 2, 1, 4, 4, 2),
(3, 3, 1, 6, 6, 3),
(4, 4, 5, 6, 8, 4),
(5, 5, 5, 10, 10, 5),
(6, 6, 5, 12, 12, 6),
(7, 7, 5, 14, 14, 7),
(8, 8, 5, 16, 16, 8),
(9, 9, 1, 18, 18, 9),
(10, 10, 5, 20, 20, 10),
(11, 11, 5, 22, 22, 11),
(12, 12, 5, 24, 24, 12),
(13, 13, 5, 26, 26, 13),
(14, 14, 1, 28, 28, 14),
(15, 15, 5, 30, 30, 15),
(16, 16, 5, 32, 32, 16),
(17, 17, 11, 34, 34, 17),
(18, 18, 1, 36, 36, 18),
(19, 19, 5, 38, 38, 19),
(20, 20, 5, 40, 40, 20),
(21, 21, 5, 42, 42, 21),
(22, 22, 5, 44, 44, 22),
(23, 23, 1, 46, 46, 23),
(24, 24, 5, 48, 48, 24),
(25, 25, 11, 50, 50, 25),
(26, 26, 5, 52, 52, 26),
(27, 27, 11, 54, 54, 27),
(28, 28, 1, 56, 56, 28),
(29, 29, 5, 58, 58, 29),
(30, 30, 17, 60, 60, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_academicas`
--

CREATE TABLE `unidades_academicas` (
  `ID_UnidadAcademica` int(11) NOT NULL,
  `Desc_Nombre_Unidad_Academica` varchar(255) DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades_academicas`
--

INSERT INTO `unidades_academicas` (`ID_UnidadAcademica`, `Desc_Nombre_Unidad_Academica`) VALUES
(1, 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD ZACATENCO'),
(2, 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD SANTO TOMÁS'),
(3, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 1 \"GONZALO VÁZQUEZ VELA\"'),
(4, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 2 \"MIGUEL BERNARD\"'),
(5, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 3 \"ESTANISLAO RAMÍREZ RUIZ\"'),
(6, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 7 \"CUAUHTÉMOC\"'),
(7, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 10 \"CARLOS VALLEJO MÁRQUEZ\"'),
(8, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 12 \"JOSÉ MA. MORELOS\"'),
(9, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 13 \"RICARDO FLORES MAGÓN\"'),
(10, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 15 \"DIÓDORO ANTÚNEZ ECHEGARAY\"'),
(11, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 17 \"LEÓN GTO\"'),
(12, 'CENTRO DE ESTUDIOS CIENTIFICOS Y TECNOLÓGICOS NO. 19 \"LEONA VICARIO\" TECÁMAC'),
(13, 'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA, UNIDAD ZACATENCO'),
(14, 'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA, UNIDAD CULHUACÁN'),
(15, 'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA, UNIDAD AZCAPOTZALCO'),
(16, 'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA, UNIDAD ZACATENCO'),
(17, 'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA, UNIDAD TECAMACHALCO'),
(18, 'ESCUELA SUPERIOR DE INGENIERÍA QUÍMICA E INDUSTRIAS EXTRACTIVAS'),
(19, 'ESCUELA SUPERIOR DE FÍSICA Y MATEMÁTICAS'),
(20, 'ESCUELA SUPERIOR DE CÓMPUTO'),
(21, 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA Y CIENCIAS SOCIALES Y ADMINISTRATIVAS'),
(22, 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA Y TECNOLOGÍAS AVANZADAS'),
(23, 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA CAMPUS GUANAJUATO'),
(24, 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA CAMPUS ZACATECAS'),
(25, 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA CAMPUS HIDALGO'),
(26, 'ESCUELA NACIONAL DE CIENCIAS BIOLÓGICAS'),
(27, 'ESCUELA SUPERIOR DE COMERCIO Y ADMINISTRACIÓN, UNIDAD SANTO TOMÁS'),
(28, 'ESCUELA SUPERIOR DE COMERCIO Y ADMINISTRACIÓN, UNIDAD TEPEPAN'),
(29, 'ESCUELA SUPERIOR DE ECONOMÍA'),
(30, 'ESCUELA SUPERIOR DE TURISMO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_general`
--

CREATE TABLE `usuarios_general` (
  `ID_Usuario` int(11) NOT NULL,
  `id_NombreUsuario` int(11) DEFAULT NULL,
  `id_ContrasenaHash` int(11) DEFAULT NULL,
  `id_PalabraAleatoria` int(11) DEFAULT NULL,
  `id_EstatusBloqueo` int(11) DEFAULT NULL,
  `id_EstatusDeshabilitado` int(11) DEFAULT NULL,
  `id_CorreoElectronico` int(11) DEFAULT NULL,
  `id_UnidadAcademica` int(11) DEFAULT NULL,
  `id_Cargo` int(11) DEFAULT NULL,
  `id_NumeroTelefono` int(11) DEFAULT NULL,
  `id_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_general`
--

INSERT INTO `usuarios_general` (`ID_Usuario`, `id_NombreUsuario`, `id_ContrasenaHash`, `id_PalabraAleatoria`, `id_EstatusBloqueo`, `id_EstatusDeshabilitado`, `id_CorreoElectronico`, `id_UnidadAcademica`, `id_Cargo`, `id_NumeroTelefono`, `id_Rol`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 2),
(2, 2, 2, 2, 1, 1, 3, 2, 3, 3, 2),
(3, 3, 3, 3, 1, 1, 5, 3, 4, 5, 2),
(4, 4, 4, 4, 1, 1, 7, 4, 4, 7, 2),
(5, 5, 5, 5, 1, 1, 9, 5, 6, 9, 2),
(6, 6, 6, 6, 1, 1, 11, 6, 7, 11, 2),
(7, 7, 7, 7, 1, 1, 13, 7, 4, 13, 2),
(8, 8, 8, 8, 1, 1, 15, 8, 4, 15, 2),
(9, 9, 9, 9, 1, 1, 17, 9, 4, 17, 2),
(10, 10, 10, 10, 1, 1, 19, 10, 4, 19, 2),
(11, 11, 11, 11, 1, 1, 21, 11, 8, 21, 2),
(12, 12, 12, 12, 1, 1, 23, 12, 9, 23, 2),
(13, 13, 13, 13, 1, 1, 25, 13, 4, 25, 2),
(14, 14, 14, 14, 1, 1, 27, 14, 10, 27, 2),
(15, 15, 15, 15, 1, 1, 29, 15, 4, 29, 2),
(16, 16, 16, 16, 1, 1, 31, 16, 4, 31, 2),
(17, 17, 17, 17, 1, 1, 33, 17, 12, 33, 2),
(18, 18, 18, 18, 1, 1, 35, 18, 8, 35, 2),
(19, 19, 19, 19, 1, 1, 37, 19, 13, 37, 2),
(20, 20, 20, 20, 1, 1, 39, 20, 13, 39, 2),
(21, 21, 21, 21, 1, 1, 41, 21, 13, 41, 2),
(22, 22, 22, 22, 1, 1, 43, 22, 4, 43, 2),
(23, 23, 23, 23, 1, 1, 45, 23, 14, 45, 2),
(24, 24, 24, 24, 1, 1, 47, 24, 4, 47, 2),
(25, 25, 25, 25, 1, 1, 49, 25, 9, 49, 2),
(26, 26, 26, 26, 1, 1, 51, 26, 4, 51, 2),
(27, 27, 27, 27, 1, 1, 53, 27, 4, 53, 2),
(28, 28, 28, 28, 1, 1, 55, 28, 15, 55, 2),
(29, 29, 29, 29, 1, 1, 57, 29, 16, 57, 2),
(30, 30, 30, 30, 1, 1, 59, 30, 18, 59, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vigencia`
--

CREATE TABLE `vigencia` (
  `ID_Vigencia` int(11) NOT NULL,
  `Desc_Vigencia` varchar(255) DEFAULT ' ',
  `id_Idioma` int(11) DEFAULT NULL,
  `id_UnidadAcademica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cantidades_alumnos`
--
ALTER TABLE `cantidades_alumnos`
  ADD PRIMARY KEY (`ID_Registro`),
  ADD KEY `id_UnidadAcademica` (`id_UnidadAcademica`),
  ADD KEY `id_Competencia` (`id_Competencia`),
  ADD KEY `id_Idioma` (`id_Idioma`),
  ADD KEY `id_TipoPoblacion` (`id_TipoPoblacion`),
  ADD KEY `id_NivelEducativo` (`id_NivelEducativo`);

--
-- Indices de la tabla `cantidades_formato_11`
--
ALTER TABLE `cantidades_formato_11`
  ADD PRIMARY KEY (`ID_Registro_11`),
  ADD KEY `id_UnidadCenlex` (`id_UnidadCenlex`),
  ADD KEY `id_Idioma` (`id_Idioma`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`ID_Cargo`);

--
-- Indices de la tabla `contrasena_hash`
--
ALTER TABLE `contrasena_hash`
  ADD PRIMARY KEY (`ID_ContrasenaHash`);

--
-- Indices de la tabla `correo_electronico`
--
ALTER TABLE `correo_electronico`
  ADD PRIMARY KEY (`ID_CorreoElectronico`);

--
-- Indices de la tabla `estatus_bloqueado`
--
ALTER TABLE `estatus_bloqueado`
  ADD PRIMARY KEY (`ID_EstatusBloqueo`);

--
-- Indices de la tabla `estatus_deshabilitado`
--
ALTER TABLE `estatus_deshabilitado`
  ADD PRIMARY KEY (`ID_EstatusDeshabilitado`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`ID_Idioma`);

--
-- Indices de la tabla `niveles_competencia`
--
ALTER TABLE `niveles_competencia`
  ADD PRIMARY KEY (`ID_Competencia`);

--
-- Indices de la tabla `nivel_educativo`
--
ALTER TABLE `nivel_educativo`
  ADD PRIMARY KEY (`ID_NivelEducativo`);

--
-- Indices de la tabla `nombres_titulares`
--
ALTER TABLE `nombres_titulares`
  ADD PRIMARY KEY (`ID_NombreTitular`);

--
-- Indices de la tabla `nombre_usuarios`
--
ALTER TABLE `nombre_usuarios`
  ADD PRIMARY KEY (`ID_NombreUsuario`);

--
-- Indices de la tabla `numero_telefono`
--
ALTER TABLE `numero_telefono`
  ADD PRIMARY KEY (`ID_NumeroTelefono`);

--
-- Indices de la tabla `palabra_aleatoria`
--
ALTER TABLE `palabra_aleatoria`
  ADD PRIMARY KEY (`ID_PalabraAleatoria`);

--
-- Indices de la tabla `recuperacioncontra`
--
ALTER TABLE `recuperacioncontra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_correo` (`id_correo`);

--
-- Indices de la tabla `rol_dentro_del_sistema`
--
ALTER TABLE `rol_dentro_del_sistema`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `tipo_poblacion`
--
ALTER TABLE `tipo_poblacion`
  ADD PRIMARY KEY (`ID_TipoPoblacion`);

--
-- Indices de la tabla `titular_unidad`
--
ALTER TABLE `titular_unidad`
  ADD PRIMARY KEY (`ID_Titular`),
  ADD KEY `id_NombreTitular` (`id_NombreTitular`),
  ADD KEY `id_Cargo` (`id_Cargo`),
  ADD KEY `id_NumeroTelefono` (`id_NumeroTelefono`),
  ADD KEY `id_CorreoElectronico` (`id_CorreoElectronico`),
  ADD KEY `id_UnidadAcademica` (`id_UnidadAcademica`);

--
-- Indices de la tabla `unidades_academicas`
--
ALTER TABLE `unidades_academicas`
  ADD PRIMARY KEY (`ID_UnidadAcademica`);

--
-- Indices de la tabla `usuarios_general`
--
ALTER TABLE `usuarios_general`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `id_NombreUsuario` (`id_NombreUsuario`),
  ADD KEY `id_ContrasenaHash` (`id_ContrasenaHash`),
  ADD KEY `id_PalabraAleatoria` (`id_PalabraAleatoria`),
  ADD KEY `id_EstatusBloqueo` (`id_EstatusBloqueo`),
  ADD KEY `id_EstatusDeshabilitado` (`id_EstatusDeshabilitado`),
  ADD KEY `id_CorreoElectronico` (`id_CorreoElectronico`),
  ADD KEY `id_UnidadAcademica` (`id_UnidadAcademica`),
  ADD KEY `id_Cargo` (`id_Cargo`),
  ADD KEY `id_NumeroTelefono` (`id_NumeroTelefono`),
  ADD KEY `id_Rol` (`id_Rol`);

--
-- Indices de la tabla `vigencia`
--
ALTER TABLE `vigencia`
  ADD PRIMARY KEY (`ID_Vigencia`),
  ADD KEY `id_Idioma` (`id_Idioma`),
  ADD KEY `id_UnidadAcademica` (`id_UnidadAcademica`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cantidades_alumnos`
--
ALTER TABLE `cantidades_alumnos`
  MODIFY `ID_Registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `cantidades_formato_11`
--
ALTER TABLE `cantidades_formato_11`
  MODIFY `ID_Registro_11` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `ID_Cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `contrasena_hash`
--
ALTER TABLE `contrasena_hash`
  MODIFY `ID_ContrasenaHash` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `correo_electronico`
--
ALTER TABLE `correo_electronico`
  MODIFY `ID_CorreoElectronico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `estatus_bloqueado`
--
ALTER TABLE `estatus_bloqueado`
  MODIFY `ID_EstatusBloqueo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estatus_deshabilitado`
--
ALTER TABLE `estatus_deshabilitado`
  MODIFY `ID_EstatusDeshabilitado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `ID_Idioma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `niveles_competencia`
--
ALTER TABLE `niveles_competencia`
  MODIFY `ID_Competencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `nivel_educativo`
--
ALTER TABLE `nivel_educativo`
  MODIFY `ID_NivelEducativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nombres_titulares`
--
ALTER TABLE `nombres_titulares`
  MODIFY `ID_NombreTitular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `nombre_usuarios`
--
ALTER TABLE `nombre_usuarios`
  MODIFY `ID_NombreUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `numero_telefono`
--
ALTER TABLE `numero_telefono`
  MODIFY `ID_NumeroTelefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `palabra_aleatoria`
--
ALTER TABLE `palabra_aleatoria`
  MODIFY `ID_PalabraAleatoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `recuperacioncontra`
--
ALTER TABLE `recuperacioncontra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol_dentro_del_sistema`
--
ALTER TABLE `rol_dentro_del_sistema`
  MODIFY `ID_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_poblacion`
--
ALTER TABLE `tipo_poblacion`
  MODIFY `ID_TipoPoblacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `titular_unidad`
--
ALTER TABLE `titular_unidad`
  MODIFY `ID_Titular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `unidades_academicas`
--
ALTER TABLE `unidades_academicas`
  MODIFY `ID_UnidadAcademica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios_general`
--
ALTER TABLE `usuarios_general`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `vigencia`
--
ALTER TABLE `vigencia`
  MODIFY `ID_Vigencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cantidades_alumnos`
--
ALTER TABLE `cantidades_alumnos`
  ADD CONSTRAINT `cantidades_alumnos_ibfk_1` FOREIGN KEY (`id_UnidadAcademica`) REFERENCES `unidades_academicas` (`ID_UnidadAcademica`),
  ADD CONSTRAINT `cantidades_alumnos_ibfk_2` FOREIGN KEY (`id_Competencia`) REFERENCES `niveles_competencia` (`ID_Competencia`),
  ADD CONSTRAINT `cantidades_alumnos_ibfk_3` FOREIGN KEY (`id_Idioma`) REFERENCES `idiomas` (`ID_Idioma`),
  ADD CONSTRAINT `cantidades_alumnos_ibfk_4` FOREIGN KEY (`id_TipoPoblacion`) REFERENCES `tipo_poblacion` (`ID_TipoPoblacion`),
  ADD CONSTRAINT `cantidades_alumnos_ibfk_5` FOREIGN KEY (`id_NivelEducativo`) REFERENCES `nivel_educativo` (`ID_NivelEducativo`);

--
-- Filtros para la tabla `cantidades_formato_11`
--
ALTER TABLE `cantidades_formato_11`
  ADD CONSTRAINT `cantidades_formato_11_ibfk_1` FOREIGN KEY (`id_UnidadCenlex`) REFERENCES `unidades_academicas` (`ID_UnidadAcademica`),
  ADD CONSTRAINT `cantidades_formato_11_ibfk_2` FOREIGN KEY (`id_Idioma`) REFERENCES `idiomas` (`ID_Idioma`);

--
-- Filtros para la tabla `recuperacioncontra`
--
ALTER TABLE `recuperacioncontra`
  ADD CONSTRAINT `recuperacioncontra_ibfk_1` FOREIGN KEY (`id_correo`) REFERENCES `correo_electronico` (`ID_CorreoElectronico`);

--
-- Filtros para la tabla `titular_unidad`
--
ALTER TABLE `titular_unidad`
  ADD CONSTRAINT `titular_unidad_ibfk_1` FOREIGN KEY (`id_NombreTitular`) REFERENCES `nombres_titulares` (`ID_NombreTitular`),
  ADD CONSTRAINT `titular_unidad_ibfk_2` FOREIGN KEY (`id_Cargo`) REFERENCES `cargos` (`ID_Cargo`),
  ADD CONSTRAINT `titular_unidad_ibfk_3` FOREIGN KEY (`id_NumeroTelefono`) REFERENCES `numero_telefono` (`ID_NumeroTelefono`),
  ADD CONSTRAINT `titular_unidad_ibfk_4` FOREIGN KEY (`id_CorreoElectronico`) REFERENCES `correo_electronico` (`ID_CorreoElectronico`),
  ADD CONSTRAINT `titular_unidad_ibfk_5` FOREIGN KEY (`id_UnidadAcademica`) REFERENCES `unidades_academicas` (`ID_UnidadAcademica`);

--
-- Filtros para la tabla `usuarios_general`
--
ALTER TABLE `usuarios_general`
  ADD CONSTRAINT `usuarios_general_ibfk_1` FOREIGN KEY (`id_NombreUsuario`) REFERENCES `nombre_usuarios` (`ID_NombreUsuario`),
  ADD CONSTRAINT `usuarios_general_ibfk_10` FOREIGN KEY (`id_Rol`) REFERENCES `rol_dentro_del_sistema` (`ID_Rol`),
  ADD CONSTRAINT `usuarios_general_ibfk_2` FOREIGN KEY (`id_ContrasenaHash`) REFERENCES `contrasena_hash` (`ID_ContrasenaHash`),
  ADD CONSTRAINT `usuarios_general_ibfk_3` FOREIGN KEY (`id_PalabraAleatoria`) REFERENCES `palabra_aleatoria` (`ID_PalabraAleatoria`),
  ADD CONSTRAINT `usuarios_general_ibfk_4` FOREIGN KEY (`id_EstatusBloqueo`) REFERENCES `estatus_bloqueado` (`ID_EstatusBloqueo`),
  ADD CONSTRAINT `usuarios_general_ibfk_5` FOREIGN KEY (`id_EstatusDeshabilitado`) REFERENCES `estatus_deshabilitado` (`ID_EstatusDeshabilitado`),
  ADD CONSTRAINT `usuarios_general_ibfk_6` FOREIGN KEY (`id_CorreoElectronico`) REFERENCES `correo_electronico` (`ID_CorreoElectronico`),
  ADD CONSTRAINT `usuarios_general_ibfk_7` FOREIGN KEY (`id_UnidadAcademica`) REFERENCES `unidades_academicas` (`ID_UnidadAcademica`),
  ADD CONSTRAINT `usuarios_general_ibfk_8` FOREIGN KEY (`id_Cargo`) REFERENCES `cargos` (`ID_Cargo`),
  ADD CONSTRAINT `usuarios_general_ibfk_9` FOREIGN KEY (`id_NumeroTelefono`) REFERENCES `numero_telefono` (`ID_NumeroTelefono`);

--
-- Filtros para la tabla `vigencia`
--
ALTER TABLE `vigencia`
  ADD CONSTRAINT `vigencia_ibfk_1` FOREIGN KEY (`id_Idioma`) REFERENCES `idiomas` (`ID_Idioma`),
  ADD CONSTRAINT `vigencia_ibfk_2` FOREIGN KEY (`id_UnidadAcademica`) REFERENCES `unidades_academicas` (`ID_UnidadAcademica`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
