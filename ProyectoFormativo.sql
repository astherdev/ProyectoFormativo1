-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2025 a las 14:30:19
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
-- Base de datos: `sensli`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(20) NOT NULL,
  `No_Telefonico` bigint(20) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` bigint(20) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Etapa` char(50) NOT NULL,
  `Tipo_Oferta` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `Codigo_Ficha` int(11) NOT NULL,
  `Version` int(11) NOT NULL,
  `Denominacion` varchar(50) NOT NULL,
  `No_Ficha` int(11) NOT NULL,
  `Jefe_Grupo` varchar(50) NOT NULL,
  `Modalidad` varchar(50) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Aprendices` int(11) NOT NULL,
  `Etapa` varchar(50) NOT NULL,
  `Tipo_Oferta` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`Codigo_Ficha`, `Version`, `Denominacion`, `No_Ficha`, `Jefe_Grupo`, `Modalidad`, `Estado`, `Fecha_Inicio`, `Fecha_Fin`, `Aprendices`, `Etapa`, `Tipo_Oferta`) VALUES
(1, 1, 'Tecnologo', 2895664, 'Yuly Paulin Sáenz', 'Presencial', 'Activo', '2023-12-20', '2026-05-20', 30, 'Lectiva', 'Cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructores`
--

CREATE TABLE `instructores` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `No_Telefonico` bigint(20) NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` bigint(20) NOT NULL,
  `Cargo` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructores`
--

INSERT INTO `instructores` (`Nombre`, `Apellidos`, `No_Telefonico`, `Contraseña`, `Correo`, `Tipo_Documento`, `No_Documento`, `Cargo`) VALUES
('Juan', 'Pérez Gómez', 3123456789, 'MiContraseñaSegura12', 'juan.perez@example.com', 'Cédula', 1234567890, 'Transversal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juicios_evaluativos`
--

CREATE TABLE `juicios_evaluativos` (
  `No_Documento` bigint(20) NOT NULL,
  `tipo_documento` char(50) NOT NULL,
  `Nombre` char(50) NOT NULL,
  `Apellido` char(50) NOT NULL,
  `Estado` char(50) NOT NULL,
  `Competencia` text NOT NULL,
  `Resultado_Aprendizaje` text NOT NULL,
  `Juicios_Evaluativos` char(50) NOT NULL,
  `Fecha_Hora_Juicio_Evaluado` datetime NOT NULL,
  `Funcionario_Registro` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE `observaciones` (
  `Correo` varchar(50) NOT NULL,
  `tipo_documento` bigint(20) NOT NULL,
  `No_documento` bigint(20) NOT NULL,
  `No_telefonico` bigint(20) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `Observacion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observaciones`
--

INSERT INTO `observaciones` (`Correo`, `tipo_documento`, `No_documento`, `No_telefonico`, `titulo`, `Observacion`) VALUES
('', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(20) NOT NULL,
  `No_Telefonico` bigint(20) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` bigint(20) NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  `Rol` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`Nombre`, `Apellidos`, `No_Telefonico`, `Correo`, `Tipo_Documento`, `No_Documento`, `contraseña`, `Rol`) VALUES
('Yuly Paulin', 'Sáenz Agudelo', 312452452, 'yulypaulinzaen@gmail.com', 'CC', 13353252, 'admin123', 'Admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`Codigo_Ficha`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fichas`
--
ALTER TABLE `fichas`
  MODIFY `Codigo_Ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
