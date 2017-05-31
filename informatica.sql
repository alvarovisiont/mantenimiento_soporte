-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2017 a las 02:50:58
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

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
  `equipos_id` int(10) UNSIGNED NOT NULL,
  `soportes_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `characteristic_computers`
--

CREATE TABLE `characteristic_computers` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `characteristic_computers`
--

INSERT INTO `characteristic_computers` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Tarjeta madre intel, procesador cuad core, 4gb de ram, 8 capacitadores, fuente de poder 600GHZ', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Informática', 'Encargados del area del sistema de la alcaldía', '2017-03-06 02:43:50', '2017-03-06 02:43:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `bm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom_equipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `monitor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_monitor` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `raton` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_raton` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `teclado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_teclado` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caracteristicas_extras` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `bm`, `nom_equipo`, `ip`, `monitor`, `descripcion_monitor`, `raton`, `descripcion_raton`, `teclado`, `descripcion_teclado`, `tipo`, `caracteristicas_extras`, `color`, `status`, `created_at`, `updated_at`) VALUES
(3, 'bm-001', 'Máquina Catastro', '190.121.228.139', 'Bm-002528', 'asdasd', 'bm-213454', 'qweqwe', 'bm-321353434', '2qwdsd', '1', '', 'Gris', 1, '2017-03-06 12:36:17', '2017-03-06 12:39:24'),
(4, 'bm-003', 'Máquina de despacho', '190.121.0.128', 'Bm-002527', 'adsadsads', 'bm-0034', 'asdasdasd', 'bm-32135', 'adsasdasdasd', '', 'asdhasjdhkajdshkjads', 'Blanco', 1, '2017-03-14 13:29:52', '2017-04-13 22:12:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fallas`
--

CREATE TABLE `fallas` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipos_id` int(10) UNSIGNED NOT NULL,
  `trabajador_id` int(10) UNSIGNED NOT NULL,
  `departamento_id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `soporte_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fallas`
--

INSERT INTO `fallas` (`id`, `equipos_id`, `trabajador_id`, `departamento_id`, `descripcion`, `status`, `soporte_id`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 1, 'Mi computadora se esta reiniciando sola, necesito que me la formateen por favor', 1, 3, '2017-03-06 14:03:03', '2017-04-13 00:50:54'),
(3, 3, 2, 1, 'Otra vez mi computadora jodiendo, esta vez me dice que estoy loco, vamos a formatearla ', 0, NULL, '2017-03-07 00:59:04', '2017-03-07 00:59:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mails`
--

CREATE TABLE `mails` (
  `id` int(10) UNSIGNED NOT NULL,
  `soporte_id` int(10) UNSIGNED NOT NULL,
  `trabajadores_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `sent_by` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `files` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mails`
--

INSERT INTO `mails` (`id`, `soporte_id`, `trabajadores_id`, `subject`, `message`, `sent_by`, `nivel`, `status`, `files`, `eliminado`, `created_at`, `updated_at`) VALUES
(11, 2, 2, 'Nueva Falla Impresora', 'La impresora me dice que tiene un error de exceso de memoria, requiero atención inmediata', 2, 1, 0, '', 0, '2017-03-09 17:01:52', '2017-03-10 14:14:03'),
(12, 2, 2, 'Respuesta', 'Ya vamos para allá ', 2, 2, 0, '', 0, '2017-03-09 17:17:56', '2017-03-09 23:35:54'),
(13, 2, 2, 'Vente ya', 'Vente coñoetupepa', 2, 1, 0, '', 0, '2017-03-09 17:48:10', '2017-03-09 23:35:19'),
(14, 2, 2, 'Deja el fastidio', 'por favor estoy ocupado, deja de buscarme', 2, 2, 0, 'Desert.jpg,Koala.jpg', 0, '2017-03-10 13:49:10', '2017-03-10 14:01:26'),
(15, 1, 2, 'Cartuchos de impresora', 'Ya vamos a atenderle la impresora dennos un chance', 1, 2, 0, '', 0, '2017-03-10 19:28:38', '2017-03-17 18:18:58'),
(21, 1, 2, 'sadasdq', 'wdasdads', 1, 2, 1, 'Desert.jpg,Faro.jpg,Hydrangeas.jpg,Koala.jpg,Penguins.jpg,Tulips.jpg', 2, '2017-03-13 13:01:33', '2017-03-13 13:01:58'),
(22, 1, 2, 'respuesta', 'asidfhadhaisdh', 2, 1, 1, 'cpu.gif,listas.jpg,monitor.jpg,muser2-160x160.jpg,raton.jpg', 0, '2017-03-17 18:19:44', '2017-03-17 18:19:44'),
(23, 1, 2, 'recargas', 'asdasdasd', 2, 1, 0, 'Chrysanthemum.jpg,Desert.jpg', 0, '2017-04-13 00:32:48', '2017-04-13 00:34:39');

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
('2017_01_24_110456_create_departamentos_table', 1),
('2017_01_24_133750_create_soportes_table', 1),
('2017_01_24_230434_create_trabajadores_table', 1),
('2017_01_24_230623_create_actualizaciones_table', 1),
('2017_02_13_210256_create_fallas_table', 1),
('2017_02_20_141854_create_characteristic_computers_table', 1),
('2017_02_21_213041_create_works_table', 1),
('2017_03_02_224408_create_reports_table', 1),
('2017_03_07_092654_create_mails_table', 2);

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
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `falla_id` int(11) NOT NULL,
  `soporte_id` int(11) NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `cuerpo_reporte` text COLLATE utf8_unicode_ci NOT NULL,
  `imagenes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reports`
--

INSERT INTO `reports` (`id`, `falla_id`, `soporte_id`, `trabajador_id`, `cuerpo_reporte`, `imagenes`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 'Bueno para tenerla lista va a tener que esperar un poco porque se le quemo todo.', 'Faro.jpg,Penguins.jpg', '2017-03-06 14:06:10', '2017-03-06 14:06:10'),
(2, 2, 2, 2, 'Si efectivamente como dijo el compañero edwin se quemo todo', 'Chrysanthemum.jpg,Jellyfish.jpg', '2017-03-06 14:17:00', '2017-03-06 14:17:00'),
(3, 2, 2, 2, 'se quemo esa broma', 'Koala.jpg,Penguins.jpg', '2017-03-09 13:13:29', '2017-03-09 13:13:29'),
(4, 2, 1, 2, 'kuyfkuytryteyjtetrh', 'Faro.jpg,Hydrangeas.jpg,Penguins.jpg', '2017-03-09 16:55:42', '2017-03-09 16:55:42'),
(5, 2, 1, 2, 'Espere por favor estamos trabajando para arreglar eso lo más pronto posible', 'Desert.jpg,Faro.jpg,Hydrangeas.jpg,Penguins.jpg,Tulips.jpg', '2017-03-13 12:35:12', '2017-03-13 12:35:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soportes`
--

CREATE TABLE `soportes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `soportes`
--

INSERT INTO `soportes` (`id`, `nombre_completo`, `cedula`, `created_at`, `updated_at`) VALUES
(1, 'Edwin Lopez', 10789547, '2017-03-06 12:37:14', '2017-03-06 12:37:14'),
(2, 'Julio Cardenas', 13896492, '2017-03-06 12:37:27', '2017-03-06 12:37:27'),
(3, 'Juan Carlos', 12765349, '2017-03-06 12:37:38', '2017-03-06 12:37:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipos_id` int(10) UNSIGNED DEFAULT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `departamento_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `equipos_id`, `nombre_completo`, `cedula`, `telefono`, `departamento_id`, `email`, `created_at`, `updated_at`) VALUES
(2, 3, 'Alvaro Antonio Guedez Crespo', 21202500, '04124362753', 1, 'alvarovisiont@gmail.com', '2017-03-06 12:39:24', '2017-03-06 12:39:24'),
(3, 4, 'ggg', 16028060, '04124362753', 1, 'sheylert@gmail.com', '2017-04-13 22:12:43', '2017-04-13 22:12:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `trabajadores_id` int(11) NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `online` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `trabajadores_id`, `usuario`, `password`, `nivel`, `tipo`, `online`, `remember_token`, `created_at`, `updated_at`) VALUES
(19, 0, 'alvaro', '$2y$10$1t25DYdMSmv739AyOpYjyupg3RgRxyRCgm.7IRsYlZInqA3epO1KK', '1', 0, 0, 'IQxqZ1DCvUkG389GR8oktvACBx68yqp17UCKLiAEetNKSG94WyCCobkNQGI2', '2017-01-20 18:21:22', '2017-03-17 18:10:34'),
(22, 2, 'admin', '$2y$10$QT9IEk/monjAsfuyj.Nq0edpoUEUuERlvTvX68j3zlZHbpBrTgANW', '1', 1, 1, 'Ii3vfBUCVeBTGjA3WXQWXU1QpsG3cXJhDM8LmZ3gzmtmbWB5Inb6vMREfGpi', '2017-03-06 13:45:31', '2017-04-13 21:48:25'),
(23, 1, 'edwin', '$2y$10$1DRuw3tnsL6sNZKsH3XWn.MV/CiIWKS4VZeG7wLd2eYZADIln6G.G', '2', 2, 0, '46UZJpzkkYaUdjDNjwWC04xgA2QkVDi3oxcuZTjyK2nIkSR8ZmAVYs0AkZgf', '2017-03-06 14:03:52', '2017-04-13 00:49:34'),
(24, 2, 'julio', '$2y$10$Ke4UMc7Ip4GZXOME2hm.0uTJfwSz8lzASMWCYfDN6fbyjFKO9Nzby', '2', 2, 0, 'ttg7mW8jLCkkBIaTu84Fhg7g0kRpFyFz4sJ30ROsLDtNISb8s2DFcWLieMVt', '2017-03-06 14:16:27', '2017-03-13 12:34:20'),
(25, 3, 'juan', '$2y$10$2g98g05CG.tACP82.OVQ4eNKkYjjNRYJOBi8HMTf4X3HB7EqtQVD6', '2', 2, 0, 'cPbacgE7V9xzgvcZINNvsYQ4VXM5taX81bXzaXnkmuxTOcqmQPBtZ7XLpHTF', '2017-03-09 13:23:04', '2017-04-13 00:52:27');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `works`
--

CREATE TABLE `works` (
  `id` int(10) UNSIGNED NOT NULL,
  `falla_id` int(10) UNSIGNED NOT NULL,
  `trabajadores_id` int(11) NOT NULL,
  `soporte_id` int(10) UNSIGNED NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_tarea` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `works`
--

INSERT INTO `works` (`id`, `falla_id`, `trabajadores_id`, `soporte_id`, `equipo_id`, `descripcion`, `fecha_tarea`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 3, 3, 'Mi computadora se esta reiniciando sola, necesito que me la formateen por favor', '2017-03-06 10:03:03', 1, '2017-03-06 14:03:12', '2017-04-13 00:50:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actualizaciones_equipos_id_foreign` (`equipos_id`),
  ADD KEY `actualizaciones_soportes_id_foreign` (`soportes_id`);

--
-- Indices de la tabla `characteristic_computers`
--
ALTER TABLE `characteristic_computers`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `fallas`
--
ALTER TABLE `fallas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fallas_equipos_id_foreign` (`equipos_id`),
  ADD KEY `fallas_trabajador_id_foreign` (`trabajador_id`);

--
-- Indices de la tabla `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soportes`
--
ALTER TABLE `soportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajadores_departamento_id_foreign` (`departamento_id`),
  ADD KEY `trabajadores_equipos_id_foreign` (`equipos_id`);

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
-- Indices de la tabla `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `works_falla_id_foreign` (`falla_id`),
  ADD KEY `works_soporte_id_foreign` (`soporte_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `characteristic_computers`
--
ALTER TABLE `characteristic_computers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `fallas`
--
ALTER TABLE `fallas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `soportes`
--
ALTER TABLE `soportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `users1`
--
ALTER TABLE `users1`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `works`
--
ALTER TABLE `works`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  ADD CONSTRAINT `actualizaciones_equipos_id_foreign` FOREIGN KEY (`equipos_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `actualizaciones_soportes_id_foreign` FOREIGN KEY (`soportes_id`) REFERENCES `soportes` (`id`);

--
-- Filtros para la tabla `fallas`
--
ALTER TABLE `fallas`
  ADD CONSTRAINT `fallas_equipos_id_foreign` FOREIGN KEY (`equipos_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fallas_trabajador_id_foreign` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `trabajadores_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `trabajadores_equipos_id_foreign` FOREIGN KEY (`equipos_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_falla_id_foreign` FOREIGN KEY (`falla_id`) REFERENCES `fallas` (`id`),
  ADD CONSTRAINT `works_soporte_id_foreign` FOREIGN KEY (`soporte_id`) REFERENCES `soportes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
