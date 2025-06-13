-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-06-2025 a las 22:42:42
-- Versión del servidor: 8.0.39
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoformativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

DROP TABLE IF EXISTS `aprendiz`;
CREATE TABLE IF NOT EXISTS `aprendiz` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `No_Telefonico` int NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` int NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Etapa` char(50) NOT NULL,
  `Tipo_Oferta` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `contenido` longtext,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

DROP TABLE IF EXISTS `fichas`;
CREATE TABLE IF NOT EXISTS `fichas` (
  `Codigo_Ficha` int NOT NULL AUTO_INCREMENT,
  `Version` int NOT NULL,
  `Denominacion` varchar(50) NOT NULL,
  `No_Ficha` int NOT NULL,
  `Jefe_Grupo` varchar(50) NOT NULL,
  `Modalidad` varchar(50) NOT NULL,
  `Estado` int NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Aprendices` int NOT NULL,
  `Etapa` varchar(50) NOT NULL,
  `Tipo_Oferta` varchar(50) NOT NULL,
  PRIMARY KEY (`Codigo_Ficha`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructores`
--

DROP TABLE IF EXISTS `instructores`;
CREATE TABLE IF NOT EXISTS `instructores` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `No_Telefonico` int NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` int NOT NULL,
  `Cargo` varchar(30) NOT NULL,
  `tipoContrato` enum('Planta','Contratista') NOT NULL DEFAULT 'Contratista',
  `fechaIniContrato` date DEFAULT NULL,
  `fechaFinContrato` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juicios_evaluativos`
--

DROP TABLE IF EXISTS `juicios_evaluativos`;
CREATE TABLE IF NOT EXISTS `juicios_evaluativos` (
  `No_Documento` int NOT NULL,
  `tipo_documento` char(50) NOT NULL,
  `Nombre` char(50) NOT NULL,
  `Apellido` char(50) NOT NULL,
  `Estado` char(50) NOT NULL,
  `Competencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Resultado_Aprendizaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Juicios_Evaluativos` char(50) NOT NULL,
  `Fecha_Hora_Juicio_Evaluado` datetime NOT NULL,
  `Funcionario_Registro` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

DROP TABLE IF EXISTS `observaciones`;
CREATE TABLE IF NOT EXISTS `observaciones` (
  `Correo` varchar(50) NOT NULL,
  `tipo_documento` int NOT NULL,
  `No_documento` int NOT NULL,
  `No_telefonico` int NOT NULL,
  `Observacion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `No_Telefonico` bigint NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`Nombre`, `Apellidos`, `No_Telefonico`, `Correo`, `Tipo_Documento`, `No_Documento`) VALUES
('Isaac', 'Echeverry Garcia', 3217251299, 'isaacecheverry53@gmail.com', 'CC', 1088829637);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
