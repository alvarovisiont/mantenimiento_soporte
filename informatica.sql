-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2017 a las 19:00:27
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `informatica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(3) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `descripccion` varchar(260) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(4) NOT NULL,
  `departamento_id` int(2) NOT NULL,
  `bien_mueble` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `ip_equipo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` varchar(220) COLLATE utf8_spanish_ci NOT NULL,
  `fallas` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `reporte` varchar(1100) COLLATE utf8_spanish_ci NOT NULL,
  `actualizacion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `fecha_reg_equipos` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(5) NOT NULL,
  `mensaje` varchar(1000) NOT NULL,
  `foto_tarea` varchar(100) NOT NULL,
  `usuario_id` int(2) NOT NULL,
  `departamento_id` int(2) NOT NULL,
  `fecha_reg_tarea` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(2) NOT NULL,
  `id_tarea` int(5) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(8) NOT NULL,
  `nivel` varchar(16) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '0',
  `fecha_reg` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
