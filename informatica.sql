-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2017 a las 20:15:47
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

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
-- Estructura de tabla para la tabla `actualizaciones`
--

CREATE TABLE `actualizaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipo_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `laboradores_id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `laboradores_id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 0, 'Alcaldia', 'alcaldeando', '2017-01-24 13:41:07', '2017-01-24 13:42:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `soporte_id` int(10) UNSIGNED NOT NULL,
  `bm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom_equipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboradores`
--

CREATE TABLE `laboradores` (
  `id` int(10) UNSIGNED NOT NULL,
  `tareas_id` int(10) UNSIGNED NOT NULL,
  `equipo_id` int(10) UNSIGNED NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_01_23_132748_create_equipos_table', 1),
('2017_01_23_133850_create_actualizaciones_table', 1),
('2017_01_24_100819_create_tareas_table', 1),
('2017_01_24_110456_create_departamentos_table', 1),
('2017_01_24_111314_create_laboradores_table', 1),
('2017_01_24_133750_create_soportes_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soportes`
--

CREATE TABLE `soportes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `tareas_id` int(10) UNSIGNED NOT NULL,
  `actualizaciones_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(10) UNSIGNED NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `equipo_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_tarea` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `apellido`, `usuario`, `password`, `nivel`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'Fran', 'Fran', 'fran', '$2y$10$1t25DYdMSmv739AyOpYjyupg3RgRxyRCgm.7IRsYlZInqA3epO1KK', '1', 'IH3VGC2JJpk7w21njJcCM2v77rtSw5DC6lpa6gd1EldnFAHUBapexvVZwMIL', '2017-01-20 18:21:22', '2017-01-23 15:00:16'),
(18, 'Fran', 'Hernandez', 'francis', '$2y$10$KXUP7qBesT5lnaLY9BDzpuoae5m86A9R.ZP2fGOurlAYodMsJNQpO', '3', 'j9guBu9XXMHjPQX7DSEol2pRjIX5rb5EMt7rkCnqrUlzXXjSOcCIXahfuIA5', '2017-01-20 18:31:20', '2017-01-20 18:31:24'),
(19, 'Zulima', 'Cordero', 'kaka', '$2y$10$pZkYNa/Qe4Z2nlIwruk.O.sw23mtrcyr0SiIiJ2s58ncAGCINYWN6', '2', '2lrEgGQP2UXI8cUdFFt0McvOnlbeFLivdGMB862AHLhfAW8JZdKzxgaPc1VR', '2017-01-20 18:56:33', '2017-01-20 18:56:33'),
(20, 'Manu', 'manu', 'manu', '$2y$10$5pbmNiolqTm4krn7pTIkVeCh.sz7.VGewF0iz92wBfgwxbJrjayeq', '1', 'RRmARsXwrHBdbbvHnAFrgCIXxIOcGHTJxu9CC5PjKhZFAnNIDhqd5c1Q3o14', '2017-01-20 19:01:49', '2017-01-20 19:05:03'),
(21, 'zulima', 'zulima', 'zuli', '$2y$10$HRPN38Q6k6FXlJ.7k0fi4u1flbnVuxrXaFW1B2Nya5rtJSa6gOdhi', '1', 'DKrI9umlXkQgGcpPFL6TwR7c8Xd8uutCzhWVCw8nIRilKqxd8prfCDWVT1Us', '2017-01-23 12:09:43', '2017-01-23 12:27:34'),
(22, 'fran', 'fran', 'ronaldo', '$2y$10$.6nx1PW02kFDxJm857PNSOXUT0tPk2iHw0Kp.eRlTuIQjva5JaftG', '1', 'JxrT6NGWErG1xZF87XqPbN6WIjZAetBXAJIA6drfPbU27tiAFtsiaS2LW9gd', '2017-01-23 13:08:01', '2017-01-23 13:08:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users1`
--

CREATE TABLE `users1` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_tarea` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users1`
--

INSERT INTO `users1` (`id_user`, `id_tarea`, `cedula`, `name`, `apellido`, `usuario`, `password`, `nivel`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, '', '20990397', 'Fran', 'Fran', 'fran', '$2y$10$1t25DYdMSmv739AyOpYjyupg3RgRxyRCgm.7IRsYlZInqA3epO1KK', '1', 'IH3VGC2JJpk7w21njJcCM2v77rtSw5DC6lpa6gd1EldnFAHUBapexvVZwMIL', '2017-01-20 18:21:22', '2017-01-23 15:00:16'),
(18, '', '0', 'Fran', 'Hernandez', 'francis', '$2y$10$KXUP7qBesT5lnaLY9BDzpuoae5m86A9R.ZP2fGOurlAYodMsJNQpO', '3', 'j9guBu9XXMHjPQX7DSEol2pRjIX5rb5EMt7rkCnqrUlzXXjSOcCIXahfuIA5', '2017-01-20 18:31:20', '2017-01-20 18:31:24'),
(19, '', '', 'Zulima', 'Cordero', 'kaka', '$2y$10$pZkYNa/Qe4Z2nlIwruk.O.sw23mtrcyr0SiIiJ2s58ncAGCINYWN6', '2', '2lrEgGQP2UXI8cUdFFt0McvOnlbeFLivdGMB862AHLhfAW8JZdKzxgaPc1VR', '2017-01-20 18:56:33', '2017-01-20 18:56:33'),
(20, '', '', 'Manu', 'manu', 'manu', '$2y$10$5pbmNiolqTm4krn7pTIkVeCh.sz7.VGewF0iz92wBfgwxbJrjayeq', '1', 'RRmARsXwrHBdbbvHnAFrgCIXxIOcGHTJxu9CC5PjKhZFAnNIDhqd5c1Q3o14', '2017-01-20 19:01:49', '2017-01-20 19:05:03'),
(21, '', '', 'zulima', 'zulima', 'zuli', '$2y$10$HRPN38Q6k6FXlJ.7k0fi4u1flbnVuxrXaFW1B2Nya5rtJSa6gOdhi', '1', 'DKrI9umlXkQgGcpPFL6TwR7c8Xd8uutCzhWVCw8nIRilKqxd8prfCDWVT1Us', '2017-01-23 12:09:43', '2017-01-23 12:27:34'),
(22, '', '', 'fran', 'fran', 'ronaldo', '$2y$10$.6nx1PW02kFDxJm857PNSOXUT0tPk2iHw0Kp.eRlTuIQjva5JaftG', '1', 'JxrT6NGWErG1xZF87XqPbN6WIjZAetBXAJIA6drfPbU27tiAFtsiaS2LW9gd', '2017-01-23 13:08:01', '2017-01-23 13:08:47');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actualizaciones_equipo_id_foreign` (`equipo_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboradores`
--
ALTER TABLE `laboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laboradores_departamento_id_foreign` (`departamento_id`),
  ADD KEY `laboradores_tareas_id_foreign` (`tareas_id`),
  ADD KEY `laboradores_equipo_id_foreign` (`equipo_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `soportes`
--
ALTER TABLE `soportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soportes_tareas_id_foreign` (`tareas_id`),
  ADD KEY `soportes_actualizaciones_id_foreign` (`actualizaciones_id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tareas_equipo_id_foreign` (`equipo_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`);

--
-- Indices de la tabla `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `laboradores`
--
ALTER TABLE `laboradores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `soportes`
--
ALTER TABLE `soportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `users1`
--
ALTER TABLE `users1`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  ADD CONSTRAINT `actualizaciones_equipo_id_foreign` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `laboradores`
--
ALTER TABLE `laboradores`
  ADD CONSTRAINT `laboradores_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `laboradores_equipo_id_foreign` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `laboradores_tareas_id_foreign` FOREIGN KEY (`tareas_id`) REFERENCES `tareas` (`id`);

--
-- Filtros para la tabla `soportes`
--
ALTER TABLE `soportes`
  ADD CONSTRAINT `soportes_actualizaciones_id_foreign` FOREIGN KEY (`actualizaciones_id`) REFERENCES `actualizaciones` (`id`),
  ADD CONSTRAINT `soportes_tareas_id_foreign` FOREIGN KEY (`tareas_id`) REFERENCES `tareas` (`id`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_equipo_id_foreign` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
