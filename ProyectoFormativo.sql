--
-- Base de datos: `sensli`
--

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `aprendiz`
--

DROP TABLE IF EXISTS `aprendiz`;
CREATE TABLE IF NOT EXISTS `aprendiz` (
  `Nombre` varchar(50) NOT NULL,
  `No_Telefonico` BIGINT NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` BIGINT NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Etapa` char(50) NOT NULL,
  `Tipo_Oferta` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `instructores`
--

DROP TABLE IF EXISTS `instructores`;
CREATE TABLE IF NOT EXISTS `instructores` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `No_Telefonico` BIGINT NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` BIGINT NOT NULL,
  `Cargo` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `juicios_evaluativos`
--

DROP TABLE IF EXISTS `juicios_evaluativos`;
CREATE TABLE IF NOT EXISTS `juicios_evaluativos` (
  `No_Documento` BIGINT NOT NULL,
  `tipo_documento` char(50) NOT NULL,
  `Nombre` char(50) NOT NULL,
  `Apellido` char(50) NOT NULL,
  `Estado` char(50) NOT NULL,
  `Competencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Resultado_Aprendizaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Juicios_Evaluativos` char(50) NOT NULL,
  `Fecha_Hora_Juicio_Evaluado` datetime NOT NULL,
  `Funcionario_Registro` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `observaciones`
--

DROP TABLE IF EXISTS `observaciones`;
CREATE TABLE IF NOT EXISTS `observaciones` (
  `Correo` varchar(50) NOT NULL,
  `tipo_documento` BIGINT NOT NULL,
  `No_documento` BIGINT NOT NULL,
  `No_telefonico` BIGINT NOT NULL,
  `Observacion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `Nombre` varchar(50) NOT NULL,
  `No_Telefonico` BIGINT NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(50) NOT NULL,
  `No_Documento` BIGINT NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;