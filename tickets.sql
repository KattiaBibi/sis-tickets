-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2022 a las 16:05:14
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

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

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, 'SOPORTE', 1, '2022-04-18 20:27:49', '2022-04-18 20:27:49'),
(2, 'DESARROLLO DE SOFTWARE', 1, '2022-04-18 20:27:49', '2022-04-18 20:27:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atenciones`
--

CREATE TABLE `atenciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuarioadmin_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `servicio_id` bigint(20) UNSIGNED NOT NULL,
  `prioridad_id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 3,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `link_zoom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_cita_id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nrodocumento` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` char(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_area_id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nrodocumento`, `nombres`, `apellidos`, `fechanacimiento`, `direccion`, `telefono`, `empresa_area_id`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, '77422337', 'Kattia', 'Cruzado', '1997-12-14', 'Av. Los Quipus 565', '979159525', 1, 1, '2022-04-18 20:27:49', '2022-04-18 20:27:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_atenciones`
--

CREATE TABLE `detalle_atenciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_colab_id` bigint(20) UNSIGNED NOT NULL,
  `atencion_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_citas`
--

CREATE TABLE `detalle_citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cita_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_colab_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `ruc`, `nombre`, `direccion`, `telefono`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, '10408842889', 'COMPUSISTEL', 'EJEMPLO', '45334534', 1, '2022-04-18 20:27:49', '2022-04-18 20:27:49'),
(2, '45353454546', 'Genexidu', 'awdrsfdd', '5345355', 1, '2022-04-19 01:03:24', '2022-04-19 01:03:24'),
(3, '34343455676', 'N LEÓN', 'GDFGDFD', '75757657', 1, '2022-04-19 01:03:40', '2022-04-19 01:03:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_areas`
--

CREATE TABLE `empresa_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa_areas`
--

INSERT INTO `empresa_areas` (`id`, `empresa_id`, `area_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-04-18 20:27:49', '2022-04-18 20:27:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_servicios`
--

CREATE TABLE `empresa_servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `servicio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa_servicios`
--

INSERT INTO `empresa_servicios` (`id`, `empresa_id`, `servicio_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-04-19 01:02:55', '2022-04-19 01:02:55'),
(2, 1, 2, '2022-04-19 01:03:01', '2022-04-19 01:03:01'),
(3, 2, 4, '2022-04-19 01:04:48', '2022-04-19 01:04:48'),
(4, 3, 6, '2022-04-19 01:04:59', '2022-04-19 01:04:59'),
(5, 1, 7, '2022-04-19 01:08:32', '2022-04-19 01:08:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` char(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'ACTIVO', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(2, 'INACTIVO', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(3, 'PENDIENTE', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(4, 'EN PROCESO', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(5, 'RESUELTO', '2022-04-18 20:27:48', '2022-04-18 20:27:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_03_22_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_15_173907_create_estados_table', 1),
(5, '2022_03_16_003138_create_empresas_table', 1),
(6, '2022_03_21_015309_create_areas_table', 1),
(7, '2022_03_21_015310_create_servicios_table', 1),
(8, '2022_03_21_141234_create_permission_tables', 1),
(9, '2022_03_21_162642_create_empresa_areas_table', 1),
(10, '2022_03_21_162643_create_empresa_servicios_table', 1),
(11, '2022_03_22_161616_create_colaboradores_table', 1),
(12, '2022_03_22_171407_alter_users_table', 1),
(13, '2022_03_22_211351_create_prioridades_table', 1),
(14, '2022_03_22_212300_create_tipo_citas_table', 1),
(15, '2022_03_22_212445_create_citas_table', 1),
(16, '2022_03_22_212723_create_detalle_citas_table', 1),
(17, '2022_03_22_220531_create_tickets_table', 1),
(18, '2022_03_22_220620_create_atenciones_table', 1),
(19, '2022_03_22_220721_create_detalle_atenciones_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Ver el tablero', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(2, 'empresa.listado', 'Listar empresas', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(3, 'empresa.crear', 'Crear empresa', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(4, 'empresa.editar', 'Editar empresa', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(5, 'empresa.desactivar', 'Desactivar empresa', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(6, 'area.listado', 'Listar áreas', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(7, 'area.crear', 'Crear área', 'web', '2022-04-18 20:27:49', '2022-04-18 20:27:49'),
(8, 'area.editar', 'Editar área', 'web', '2022-04-18 20:27:49', '2022-04-18 20:27:49'),
(9, 'area.desactivar', 'Desactivar área', 'web', '2022-04-18 20:27:49', '2022-04-18 20:27:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridades`
--

CREATE TABLE `prioridades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(2, 'AdminGerente', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48'),
(3, 'Trabajador', 'web', '2022-04-18 20:27:48', '2022-04-18 20:27:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, 'Renuévate', 1, '2022-04-19 01:00:35', '2022-04-19 01:00:35'),
(2, 'Asegúrate', 1, '2022-04-19 01:00:42', '2022-04-19 01:00:42'),
(3, 'Clientify', 1, '2022-04-19 01:00:50', '2022-04-19 01:00:50'),
(4, 'Grabación en drones', 1, '2022-04-19 01:04:00', '2022-04-19 01:04:00'),
(5, 'Fotografía digital', 1, '2022-04-19 01:04:16', '2022-04-19 01:04:16'),
(6, 'Marketing', 1, '2022-04-19 01:04:24', '2022-04-19 01:04:24'),
(7, 'Soporte', 1, '2022-04-19 01:08:15', '2022-04-19 01:08:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `problema` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_servicio_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `problema`, `detalle`, `empresa_servicio_id`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'MI COMPUTADORA ESTÁ MUY LENTA', 'ESTUVE TRABAJANDO NORMAL EN MI CPOMPUTADORA Y DE LA NADA SE APAGÓ A LOS 10 MIE\r\nGFE', 5, 1, '2022-04-19 01:09:26', '2022-04-19 01:09:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_citas`
--

CREATE TABLE `tipo_citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colaborador_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `colaborador_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kattia', 'kattia1997-@hotmail.com', NULL, '$2y$10$HYaZpBok8RfnQsAmo5K48OfXWGYcPRsjZLk5vz0swwitePEKoXkou', 1, 'Ejf4SLRq78EfPf9Kdi9qRXbsGIKN7b1WDEJaZ59ToqUk6E0Lrc86WVzPgdVH', '2022-04-18 20:27:49', '2022-04-18 20:27:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_area_estado` (`estado_id`);

--
-- Indices de la tabla `atenciones`
--
ALTER TABLE `atenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_atencion_user` (`usuarioadmin_id`),
  ADD KEY `fk_atencion_ticket` (`ticket_id`),
  ADD KEY `fk_atencion_servicio` (`servicio_id`),
  ADD KEY `fk_atencion_prioridad` (`prioridad_id`),
  ADD KEY `fk_atencion_estado` (`estado_id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cita_usuario` (`usuario_id`),
  ADD KEY `fk_cita_tipo_cita` (`tipo_cita_id`),
  ADD KEY `fk_cita_empresa` (`empresa_id`),
  ADD KEY `fk_cita_estado` (`estado_id`);

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_colaborador_empresa_area` (`empresa_area_id`),
  ADD KEY `fk_colaborador_estado` (`estado_id`);

--
-- Indices de la tabla `detalle_atenciones`
--
ALTER TABLE `detalle_atenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_atencion_user` (`usuario_colab_id`),
  ADD KEY `fk_detalle_atencion_atencion` (`atencion_id`);

--
-- Indices de la tabla `detalle_citas`
--
ALTER TABLE `detalle_citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_cita_cita` (`cita_id`),
  ADD KEY `fk_detalle_cita_user` (`usuario_colab_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empresa_estado` (`estado_id`);

--
-- Indices de la tabla `empresa_areas`
--
ALTER TABLE `empresa_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empresa_area_empresa` (`empresa_id`),
  ADD KEY `fk_empresa_area` (`area_id`);

--
-- Indices de la tabla `empresa_servicios`
--
ALTER TABLE `empresa_servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empresa_servicio_empresa` (`empresa_id`),
  ADD KEY `fk_empresa_servicio` (`servicio_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prioridad_estado` (`estado_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicio_estado` (`estado_id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ticket_empresa_servicio` (`empresa_servicio_id`),
  ADD KEY `fk_ticket_user` (`usuario_id`);

--
-- Indices de la tabla `tipo_citas`
--
ALTER TABLE `tipo_citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_cita_estado` (`estado_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_user_colaborador` (`colaborador_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `atenciones`
--
ALTER TABLE `atenciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_atenciones`
--
ALTER TABLE `detalle_atenciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_citas`
--
ALTER TABLE `detalle_citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresa_areas`
--
ALTER TABLE `empresa_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa_servicios`
--
ALTER TABLE `empresa_servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_citas`
--
ALTER TABLE `tipo_citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `fk_area_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `atenciones`
--
ALTER TABLE `atenciones`
  ADD CONSTRAINT `fk_atencion_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `fk_atencion_prioridad` FOREIGN KEY (`prioridad_id`) REFERENCES `prioridades` (`id`),
  ADD CONSTRAINT `fk_atencion_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`),
  ADD CONSTRAINT `fk_atencion_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `fk_atencion_user` FOREIGN KEY (`usuarioadmin_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_cita_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `fk_cita_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `fk_cita_tipo_cita` FOREIGN KEY (`tipo_cita_id`) REFERENCES `tipo_citas` (`id`),
  ADD CONSTRAINT `fk_cita_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `fk_colaborador_empresa_area` FOREIGN KEY (`empresa_area_id`) REFERENCES `empresa_areas` (`id`),
  ADD CONSTRAINT `fk_colaborador_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `detalle_atenciones`
--
ALTER TABLE `detalle_atenciones`
  ADD CONSTRAINT `fk_detalle_atencion_atencion` FOREIGN KEY (`atencion_id`) REFERENCES `atenciones` (`id`),
  ADD CONSTRAINT `fk_detalle_atencion_user` FOREIGN KEY (`usuario_colab_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detalle_citas`
--
ALTER TABLE `detalle_citas`
  ADD CONSTRAINT `fk_detalle_cita_cita` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `fk_detalle_cita_user` FOREIGN KEY (`usuario_colab_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_empresa_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`);

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
-- Filtros para la tabla `prioridades`
--
ALTER TABLE `prioridades`
  ADD CONSTRAINT `fk_prioridad_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `fk_servicio_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_ticket_empresa_servicio` FOREIGN KEY (`empresa_servicio_id`) REFERENCES `empresa_servicios` (`id`),
  ADD CONSTRAINT `fk_ticket_user` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tipo_citas`
--
ALTER TABLE `tipo_citas`
  ADD CONSTRAINT `fk_tipo_cita_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_colaborador` FOREIGN KEY (`colaborador_id`) REFERENCES `colaboradores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
