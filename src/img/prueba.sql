-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2025 a las 21:40:02
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
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitacionformacion`
--

CREATE TABLE `capacitacionformacion` (
  `idcapacitacion` int(11) NOT NULL,
  `tipoformacacion` varchar(150) DEFAULT NULL,
  `tema` varchar(200) DEFAULT NULL,
  `orgcapacitacion` varchar(150) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `duracionhoras` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacionpersona`
--

CREATE TABLE `certificacionpersona` (
  `idcertipersona` int(11) NOT NULL,
  `secto` varchar(100) DEFAULT NULL,
  `actividad` varchar(150) DEFAULT NULL,
  `item` varchar(150) DEFAULT NULL,
  `norma` varchar(500) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `educacion`
--

CREATE TABLE `educacion` (
  `ideducacion` int(11) NOT NULL,
  `nivelaceademico` varchar(30) DEFAULT NULL,
  `grado` varchar(30) DEFAULT NULL,
  `centroeducativo` varchar(150) DEFAULT NULL,
  `fechatitulo` date DEFAULT NULL,
  `idpostulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esquemas`
--

CREATE TABLE `esquemas` (
  `idesquema` int(11) NOT NULL,
  `idpostulante` int(11) NOT NULL,
  `idnormaiso` int(11) NOT NULL,
  `idcapacitacion` int(11) NOT NULL,
  `idlapensayo` int(11) NOT NULL,
  `idlabcalibracion` int(11) NOT NULL,
  `idlabclinico` int(11) NOT NULL,
  `idensayoetd` int(11) NOT NULL,
  `idenayotec` int(11) NOT NULL,
  `idinspeccion` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idsisges` int(11) NOT NULL,
  `idcertipersona` int(11) NOT NULL,
  `idmateriales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experienciaaudiriat`
--

CREATE TABLE `experienciaaudiriat` (
  `idexpauditoriat` int(11) NOT NULL,
  `organizaciont` varchar(150) DEFAULT NULL,
  `orgevaluada` varchar(150) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `roldesignado` varchar(100) DEFAULT NULL,
  `normaaplicada` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `duracionhoras` int(4) DEFAULT NULL,
  `idpostulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experienciaaudiriaud`
--

CREATE TABLE `experienciaaudiriaud` (
  `idexpauditoriaud` int(11) NOT NULL,
  `organizacionad` varchar(150) DEFAULT NULL,
  `orgevaluada` varchar(150) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `roldesignado` varchar(100) DEFAULT NULL,
  `normaaplicada` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `duracionhoras` int(4) DEFAULT NULL,
  `idpostulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experienciaimpementacion`
--

CREATE TABLE `experienciaimpementacion` (
  `idexpimplementacion` int(11) NOT NULL,
  `organizacioni` varchar(150) DEFAULT NULL,
  `orgbeneficiada` varchar(150) DEFAULT NULL,
  `funcion` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `duracionhoras` int(4) DEFAULT NULL,
  `idpostulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencialaboral`
--

CREATE TABLE `experiencialaboral` (
  `idexpLaboral` int(11) NOT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `tipoOrganizacion` varchar(30) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `descripccion` varchar(500) DEFAULT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `duracion` int(5) DEFAULT NULL,
  `idpostulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infolaboral`
--

CREATE TABLE `infolaboral` (
  `idinfolaboral` int(11) NOT NULL,
  `nomempresa` varchar(150) DEFAULT NULL,
  `direccionL` varchar(150) DEFAULT NULL,
  `departamento` varchar(150) DEFAULT NULL,
  `celular` varchar(30) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `tiempopermanencia` varchar(100) DEFAULT NULL,
  `personareferencia` varchar(100) DEFAULT NULL,
  `telefonoreferencia` varchar(50) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `idpostulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratoriocalibracion`
--

CREATE TABLE `laboratoriocalibracion` (
  `idlabcalibracion` int(11) NOT NULL,
  `magnitud` varchar(200) DEFAULT NULL,
  `itemcalibracion` varchar(200) DEFAULT NULL,
  `norma` varchar(100) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorioclinico`
--

CREATE TABLE `laboratorioclinico` (
  `idlabclinico` int(11) NOT NULL,
  `area` varchar(200) DEFAULT NULL,
  `analisis` varchar(200) DEFAULT NULL,
  `tecnica` varchar(200) DEFAULT NULL,
  `muestra` varchar(299) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorioensayo`
--

CREATE TABLE `laboratorioensayo` (
  `idlapensayo` int(11) NOT NULL,
  `ensayo` varchar(250) DEFAULT NULL,
  `tecnica` varchar(250) DEFAULT NULL,
  `norma` varchar(200) DEFAULT NULL,
  `itemensato` varchar(500) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `normaiso`
--

CREATE TABLE `normaiso` (
  `idnormaiso` int(11) NOT NULL,
  `norma` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organismoinspeccion`
--

CREATE TABLE `organismoinspeccion` (
  `idinspeccion` int(11) NOT NULL,
  `campo` varchar(150) DEFAULT NULL,
  `sector` varchar(150) DEFAULT NULL,
  `iteminspeccion` varchar(200) DEFAULT NULL,
  `matodo` varchar(150) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organismoproductos`
--

CREATE TABLE `organismoproductos` (
  `idproducto` int(11) NOT NULL,
  `tipocerti` varchar(150) DEFAULT NULL,
  `producto` varchar(100) DEFAULT NULL,
  `documentos` varchar(100) DEFAULT NULL,
  `division` varchar(100) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organismosisges`
--

CREATE TABLE `organismosisges` (
  `idsisges` int(11) NOT NULL,
  `sisges` varchar(150) DEFAULT NULL,
  `norma` varchar(100) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `sector` varchar(150) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulante`
--

CREATE TABLE `postulante` (
  `idpostulante` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `apellido` varchar(150) DEFAULT NULL,
  `ci` varchar(30) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `sigep` varchar(50) DEFAULT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `seguro` varchar(50) DEFAULT NULL,
  `sriesgos` varchar(50) DEFAULT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedorensayoetd`
--

CREATE TABLE `proveedorensayoetd` (
  `idensayoetd` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `software` varchar(200) DEFAULT NULL,
  `normas` varchar(500) DEFAULT NULL,
  `tiempod` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedoriensayotec`
--

CREATE TABLE `proveedoriensayotec` (
  `idenayotec` int(11) NOT NULL,
  `ensayo` varchar(500) DEFAULT NULL,
  `tecnica` varchar(500) DEFAULT NULL,
  `norma` varchar(500) DEFAULT NULL,
  `itemensayo` varchar(200) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedormateriales`
--

CREATE TABLE `proveedormateriales` (
  `idmateriales` int(11) NOT NULL,
  `ensayo` varchar(100) DEFAULT NULL,
  `tecnica` varchar(100) DEFAULT NULL,
  `documento` varchar(200) DEFAULT NULL,
  `item` varchar(150) DEFAULT NULL,
  `norma` varchar(500) DEFAULT NULL,
  `tiempoexp` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `apellido` varchar(150) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `cargo` varchar(150) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `rol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `capacitacionformacion`
--
ALTER TABLE `capacitacionformacion`
  ADD PRIMARY KEY (`idcapacitacion`);

--
-- Indices de la tabla `certificacionpersona`
--
ALTER TABLE `certificacionpersona`
  ADD PRIMARY KEY (`idcertipersona`);

--
-- Indices de la tabla `educacion`
--
ALTER TABLE `educacion`
  ADD PRIMARY KEY (`ideducacion`),
  ADD KEY `fk_educacion_postulante` (`idpostulante`);

--
-- Indices de la tabla `esquemas`
--
ALTER TABLE `esquemas`
  ADD PRIMARY KEY (`idesquema`),
  ADD KEY `fk_esquemas_postulante` (`idpostulante`),
  ADD KEY `fk_esquemas_normaiso` (`idnormaiso`),
  ADD KEY `fk_esquemas_capacitacion` (`idcapacitacion`),
  ADD KEY `fk_esquemas_lapensayo` (`idlapensayo`),
  ADD KEY `fk_esquemas_labcalibracion` (`idlabcalibracion`),
  ADD KEY `fk_esquemas_labclinico` (`idlabclinico`),
  ADD KEY `fk_esquemas_ensayoetd` (`idensayoetd`),
  ADD KEY `fk_esquemas_enayotec` (`idenayotec`),
  ADD KEY `fk_esquemas_inspeccion` (`idinspeccion`),
  ADD KEY `fk_esquemas_producto` (`idproducto`),
  ADD KEY `fk_esquemas_sisges` (`idsisges`),
  ADD KEY `fk_esquemas_certipersona` (`idcertipersona`),
  ADD KEY `fk_esquemas_materiales` (`idmateriales`);

--
-- Indices de la tabla `experienciaaudiriat`
--
ALTER TABLE `experienciaaudiriat`
  ADD PRIMARY KEY (`idexpauditoriat`),
  ADD KEY `fk_experienciaaudiriat_postulante` (`idpostulante`);

--
-- Indices de la tabla `experienciaaudiriaud`
--
ALTER TABLE `experienciaaudiriaud`
  ADD PRIMARY KEY (`idexpauditoriaud`),
  ADD KEY `fk_experienciaaudiriaud_postulante` (`idpostulante`);

--
-- Indices de la tabla `experienciaimpementacion`
--
ALTER TABLE `experienciaimpementacion`
  ADD PRIMARY KEY (`idexpimplementacion`),
  ADD KEY `fk_experienciaimpementacion_postulante` (`idpostulante`);

--
-- Indices de la tabla `experiencialaboral`
--
ALTER TABLE `experiencialaboral`
  ADD PRIMARY KEY (`idexpLaboral`),
  ADD KEY `fk_experiencialaboral_postulante` (`idpostulante`);

--
-- Indices de la tabla `infolaboral`
--
ALTER TABLE `infolaboral`
  ADD PRIMARY KEY (`idinfolaboral`),
  ADD KEY `fk_infolaboral_postulante` (`idpostulante`);

--
-- Indices de la tabla `laboratoriocalibracion`
--
ALTER TABLE `laboratoriocalibracion`
  ADD PRIMARY KEY (`idlabcalibracion`);

--
-- Indices de la tabla `laboratorioclinico`
--
ALTER TABLE `laboratorioclinico`
  ADD PRIMARY KEY (`idlabclinico`);

--
-- Indices de la tabla `laboratorioensayo`
--
ALTER TABLE `laboratorioensayo`
  ADD PRIMARY KEY (`idlapensayo`);

--
-- Indices de la tabla `normaiso`
--
ALTER TABLE `normaiso`
  ADD PRIMARY KEY (`idnormaiso`);

--
-- Indices de la tabla `organismoinspeccion`
--
ALTER TABLE `organismoinspeccion`
  ADD PRIMARY KEY (`idinspeccion`);

--
-- Indices de la tabla `organismoproductos`
--
ALTER TABLE `organismoproductos`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `organismosisges`
--
ALTER TABLE `organismosisges`
  ADD PRIMARY KEY (`idsisges`);

--
-- Indices de la tabla `postulante`
--
ALTER TABLE `postulante`
  ADD PRIMARY KEY (`idpostulante`),
  ADD KEY `fk_postulante_usuario` (`idusuario`);

--
-- Indices de la tabla `proveedorensayoetd`
--
ALTER TABLE `proveedorensayoetd`
  ADD PRIMARY KEY (`idensayoetd`);

--
-- Indices de la tabla `proveedoriensayotec`
--
ALTER TABLE `proveedoriensayotec`
  ADD PRIMARY KEY (`idenayotec`);

--
-- Indices de la tabla `proveedormateriales`
--
ALTER TABLE `proveedormateriales`
  ADD PRIMARY KEY (`idmateriales`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `capacitacionformacion`
--
ALTER TABLE `capacitacionformacion`
  MODIFY `idcapacitacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `certificacionpersona`
--
ALTER TABLE `certificacionpersona`
  MODIFY `idcertipersona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `educacion`
--
ALTER TABLE `educacion`
  MODIFY `ideducacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `esquemas`
--
ALTER TABLE `esquemas`
  MODIFY `idesquema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experienciaaudiriat`
--
ALTER TABLE `experienciaaudiriat`
  MODIFY `idexpauditoriat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experienciaaudiriaud`
--
ALTER TABLE `experienciaaudiriaud`
  MODIFY `idexpauditoriaud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experienciaimpementacion`
--
ALTER TABLE `experienciaimpementacion`
  MODIFY `idexpimplementacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experiencialaboral`
--
ALTER TABLE `experiencialaboral`
  MODIFY `idexpLaboral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `infolaboral`
--
ALTER TABLE `infolaboral`
  MODIFY `idinfolaboral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratoriocalibracion`
--
ALTER TABLE `laboratoriocalibracion`
  MODIFY `idlabcalibracion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorioclinico`
--
ALTER TABLE `laboratorioclinico`
  MODIFY `idlabclinico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorioensayo`
--
ALTER TABLE `laboratorioensayo`
  MODIFY `idlapensayo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `normaiso`
--
ALTER TABLE `normaiso`
  MODIFY `idnormaiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `organismoinspeccion`
--
ALTER TABLE `organismoinspeccion`
  MODIFY `idinspeccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `organismoproductos`
--
ALTER TABLE `organismoproductos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `organismosisges`
--
ALTER TABLE `organismosisges`
  MODIFY `idsisges` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postulante`
--
ALTER TABLE `postulante`
  MODIFY `idpostulante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedorensayoetd`
--
ALTER TABLE `proveedorensayoetd`
  MODIFY `idensayoetd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedoriensayotec`
--
ALTER TABLE `proveedoriensayotec`
  MODIFY `idenayotec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedormateriales`
--
ALTER TABLE `proveedormateriales`
  MODIFY `idmateriales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `educacion`
--
ALTER TABLE `educacion`
  ADD CONSTRAINT `fk_educacion_postulante` FOREIGN KEY (`idpostulante`) REFERENCES `postulante` (`idpostulante`);

--
-- Filtros para la tabla `esquemas`
--
ALTER TABLE `esquemas`
  ADD CONSTRAINT `fk_esquemas_capacitacion` FOREIGN KEY (`idcapacitacion`) REFERENCES `capacitacionformacion` (`idcapacitacion`),
  ADD CONSTRAINT `fk_esquemas_certipersona` FOREIGN KEY (`idcertipersona`) REFERENCES `certificacionpersona` (`idcertipersona`),
  ADD CONSTRAINT `fk_esquemas_enayotec` FOREIGN KEY (`idenayotec`) REFERENCES `proveedoriensayotec` (`idenayotec`),
  ADD CONSTRAINT `fk_esquemas_ensayoetd` FOREIGN KEY (`idensayoetd`) REFERENCES `proveedorensayoetd` (`idensayoetd`),
  ADD CONSTRAINT `fk_esquemas_inspeccion` FOREIGN KEY (`idinspeccion`) REFERENCES `organismoinspeccion` (`idinspeccion`),
  ADD CONSTRAINT `fk_esquemas_labcalibracion` FOREIGN KEY (`idlabcalibracion`) REFERENCES `laboratoriocalibracion` (`idlabcalibracion`),
  ADD CONSTRAINT `fk_esquemas_labclinico` FOREIGN KEY (`idlabclinico`) REFERENCES `laboratorioclinico` (`idlabclinico`),
  ADD CONSTRAINT `fk_esquemas_lapensayo` FOREIGN KEY (`idlapensayo`) REFERENCES `laboratorioensayo` (`idlapensayo`),
  ADD CONSTRAINT `fk_esquemas_materiales` FOREIGN KEY (`idmateriales`) REFERENCES `proveedormateriales` (`idmateriales`),
  ADD CONSTRAINT `fk_esquemas_normaiso` FOREIGN KEY (`idnormaiso`) REFERENCES `normaiso` (`idnormaiso`),
  ADD CONSTRAINT `fk_esquemas_postulante` FOREIGN KEY (`idpostulante`) REFERENCES `postulante` (`idpostulante`),
  ADD CONSTRAINT `fk_esquemas_producto` FOREIGN KEY (`idproducto`) REFERENCES `organismoproductos` (`idproducto`),
  ADD CONSTRAINT `fk_esquemas_sisges` FOREIGN KEY (`idsisges`) REFERENCES `organismosisges` (`idsisges`);

--
-- Filtros para la tabla `experienciaaudiriat`
--
ALTER TABLE `experienciaaudiriat`
  ADD CONSTRAINT `fk_experienciaaudiriat_postulante` FOREIGN KEY (`idpostulante`) REFERENCES `postulante` (`idpostulante`);

--
-- Filtros para la tabla `experienciaaudiriaud`
--
ALTER TABLE `experienciaaudiriaud`
  ADD CONSTRAINT `fk_experienciaaudiriaud_postulante` FOREIGN KEY (`idpostulante`) REFERENCES `postulante` (`idpostulante`);

--
-- Filtros para la tabla `experienciaimpementacion`
--
ALTER TABLE `experienciaimpementacion`
  ADD CONSTRAINT `fk_experienciaimpementacion_postulante` FOREIGN KEY (`idpostulante`) REFERENCES `postulante` (`idpostulante`);

--
-- Filtros para la tabla `experiencialaboral`
--
ALTER TABLE `experiencialaboral`
  ADD CONSTRAINT `fk_experiencialaboral_postulante` FOREIGN KEY (`idpostulante`) REFERENCES `postulante` (`idpostulante`);

--
-- Filtros para la tabla `infolaboral`
--
ALTER TABLE `infolaboral`
  ADD CONSTRAINT `fk_infolaboral_postulante` FOREIGN KEY (`idpostulante`) REFERENCES `postulante` (`idpostulante`);

--
-- Filtros para la tabla `postulante`
--
ALTER TABLE `postulante`
  ADD CONSTRAINT `fk_postulante_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
