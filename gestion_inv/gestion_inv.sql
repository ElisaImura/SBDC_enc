-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2024 a las 19:42:42
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
-- Base de datos: `gestion_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `cat_nombre` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cat_id`, `cat_nombre`, `created_at`, `updated_at`) VALUES
(2, 'Bebidas', '2024-03-12 22:57:14', '2024-03-18 21:15:20'),
(3, 'Perecederos', '2024-03-18 21:16:18', '2024-03-18 21:16:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cli_id` bigint(20) UNSIGNED NOT NULL,
  `cli_nombre` text NOT NULL,
  `cli_apellido` text NOT NULL,
  `cli_ruc` text NOT NULL,
  `cli_direccion` text NOT NULL,
  `cli_telefono` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cli_id`, `cli_nombre`, `cli_apellido`, `cli_ruc`, `cli_direccion`, `cli_telefono`, `created_at`, `updated_at`) VALUES
(1, 'Yuri', 'Imura', '833588-5', 'Encarnación', '0985985621', '2024-03-13 21:45:21', '2024-03-18 21:13:17'),
(2, 'Rosa', 'Amarilla', '5648215', 'Encarnación', '0985561489', '2024-03-14 21:56:00', '2024-03-14 23:42:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `compra_id` bigint(20) UNSIGNED NOT NULL,
  `prove_id` bigint(20) UNSIGNED NOT NULL,
  `compra_fecha` date NOT NULL,
  `compra_factura` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`compra_id`, `prove_id`, `compra_fecha`, `compra_factura`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-03-12', 666, '2024-03-12 23:42:51', '2024-03-12 23:42:51'),
(2, 2, '2024-03-18', 45544545, '2024-03-18 21:20:27', '2024-03-18 21:20:27'),
(3, 2, '2024-03-19', 21652, '2024-03-19 22:54:28', '2024-03-19 22:54:28'),
(4, 2, '2024-03-20', 16354, '2024-03-20 22:44:03', '2024-03-20 22:44:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalles`
--

CREATE TABLE `compra_detalles` (
  `dcompra_id` bigint(20) UNSIGNED NOT NULL,
  `compra_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `dcompra_precio` int(11) NOT NULL,
  `dcompra_cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compra_detalles`
--

INSERT INTO `compra_detalles` (`dcompra_id`, `compra_id`, `prod_id`, `dcompra_precio`, `dcompra_cantidad`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 4000, 100, '2024-03-12 23:42:51', '2024-03-12 23:42:51'),
(2, 1, 4, 400, 1000, '2024-03-12 23:42:51', '2024-03-12 23:42:51'),
(3, 2, 5, 5000, 12, '2024-03-18 21:20:27', '2024-03-18 21:20:27'),
(4, 3, 3, 4000, 10, '2024-03-19 22:54:28', '2024-03-19 22:54:28'),
(5, 3, 5, 4500, 10, '2024-03-19 22:54:28', '2024-03-19 22:54:28'),
(6, 4, 6, 4000, 9, '2024-03-20 22:44:03', '2024-03-20 22:44:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_18_201400_create_proveedores_table', 1),
(6, '2024_01_18_201409_create_categorias_table', 1),
(7, '2024_01_18_201456_create_clientes_table', 1),
(8, '2024_01_18_201508_create_ventas_table', 1),
(9, '2024_01_18_201521_create_compras_table', 1),
(10, '2024_01_18_201534_create_productos_table', 1),
(11, '2024_01_18_201557_create_compra_detalles_table', 1),
(12, '2024_01_18_201604_create_venta_detalles_table', 1),
(13, '2024_03_19_185708_create_stock_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_temp_venta_detalles`
--

CREATE TABLE `presupuesto_temp_venta_detalles` (
  `temp_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `dventa_precio` int(11) NOT NULL,
  `dventa_cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `presupuesto_temp_venta_detalles`
--

INSERT INTO `presupuesto_temp_venta_detalles` (`temp_id`, `prod_id`, `dventa_precio`, `dventa_cantidad`, `total`, `created_at`, `updated_at`) VALUES
(1, 4, 500, 100, 50000, '2024-03-20 23:12:03', '2024-03-20 23:12:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `prod_nombre` text NOT NULL,
  `prod_descripcion` text NOT NULL,
  `prod_cant` int(11) NOT NULL,
  `prod_precioventa` int(11) NOT NULL,
  `prod_preciocosto` int(11) NOT NULL,
  `prod_imagen` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`prod_id`, `cat_id`, `prod_nombre`, `prod_descripcion`, `prod_cant`, `prod_precioventa`, `prod_preciocosto`, `prod_imagen`, `created_at`, `updated_at`) VALUES
(3, 2, 'Fanta', 'Gaseosa', 0, 5000, 4000, '1710273523.jpg', '2024-03-12 22:58:31', '2024-03-20 22:22:57'),
(4, 2, 'Cocacola', 'Gaseosa', 880, 500, 400, NULL, '2024-03-12 23:00:30', '2024-03-19 00:09:49'),
(5, 3, 'pan felipe', 'presentación 6 unidades', 6, 5500, 4500, '1710787023.jpg', '2024-03-18 21:18:22', '2024-03-19 22:55:08'),
(6, 2, 'Sprite', 'Gaseosa', 9, 5000, 4000, NULL, '2024-03-20 22:43:41', '2024-03-20 22:44:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `prove_id` bigint(20) UNSIGNED NOT NULL,
  `prove_nombre` text NOT NULL,
  `prove_ruc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`prove_id`, `prove_nombre`, `prove_ruc`, `created_at`, `updated_at`) VALUES
(2, 'Juan', '6489643', '2024-03-12 22:59:57', '2024-03-18 21:14:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `stock_min` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_min`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, '2024-03-20 22:22:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_compra_detalles`
--

CREATE TABLE `temp_compra_detalles` (
  `temp_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `dcompra_precio` int(11) NOT NULL,
  `dcompra_pcompra` int(11) NOT NULL,
  `dcompra_pventa` int(11) NOT NULL,
  `dcompra_cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temp_compra_detalles`
--

INSERT INTO `temp_compra_detalles` (`temp_id`, `prod_id`, `dcompra_precio`, `dcompra_pcompra`, `dcompra_pventa`, `dcompra_cantidad`, `created_at`, `updated_at`) VALUES
(1, 4, 400, 400, 500, 10, '2024-03-20 23:11:27', '2024-03-20 23:11:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_venta_detalles`
--

CREATE TABLE `temp_venta_detalles` (
  `temp_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `dventa_precio` int(11) NOT NULL,
  `dventa_cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temp_venta_detalles`
--

INSERT INTO `temp_venta_detalles` (`temp_id`, `prod_id`, `dventa_precio`, `dventa_cantidad`, `total`, `created_at`, `updated_at`) VALUES
(1, 4, 500, 10, 5000, '2024-03-20 23:11:12', '2024-03-20 23:11:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$O5wqDh1ocQX0Q7C8SmX7M.J48UKm7yq4vYsA75V9jFN9pL9JWc26i', NULL, '2024-03-12 22:27:55', '2024-03-12 22:27:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `cli_id` bigint(20) UNSIGNED NOT NULL,
  `venta_fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`venta_id`, `cli_id`, `venta_fecha`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-03-13', '2024-03-13 23:10:23', '2024-03-13 23:10:23'),
(2, 2, '2024-03-14', '2024-03-14 21:56:15', '2024-03-14 21:56:15'),
(3, 2, '2024-03-18', '2024-03-18 21:22:08', '2024-03-18 21:22:08'),
(4, 1, '2024-03-18', '2024-03-19 00:03:52', '2024-03-19 00:03:52'),
(5, 2, '2024-03-18', '2024-03-19 00:09:49', '2024-03-19 00:09:49'),
(6, 1, '2024-03-19', '2024-03-19 22:25:51', '2024-03-19 22:25:51'),
(7, 2, '2024-03-19', '2024-03-19 22:48:46', '2024-03-19 22:48:46'),
(8, 2, '2024-03-19', '2024-03-19 22:55:08', '2024-03-19 22:55:08'),
(9, 1, '2024-03-20', '2024-03-20 22:22:57', '2024-03-20 22:22:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalles`
--

CREATE TABLE `venta_detalles` (
  `dventa_id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `dventa_precio` double(8,2) NOT NULL,
  `dventa_cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta_detalles`
--

INSERT INTO `venta_detalles` (`dventa_id`, `venta_id`, `prod_id`, `dventa_precio`, `dventa_cantidad`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 500.00, 10, '2024-03-13 23:10:23', '2024-03-13 23:10:23'),
(2, 1, 3, 5000.00, 10, '2024-03-13 23:10:23', '2024-03-13 23:10:23'),
(3, 2, 4, 500.00, 100, '2024-03-14 21:56:15', '2024-03-14 21:56:15'),
(4, 3, 5, 5500.00, 1, '2024-03-18 21:22:08', '2024-03-18 21:22:08'),
(5, 4, 3, 5000.00, 10, '2024-03-19 00:03:52', '2024-03-19 00:03:52'),
(6, 5, 4, 500.00, 10, '2024-03-19 00:09:49', '2024-03-19 00:09:49'),
(7, 6, 5, 5500.00, 5, '2024-03-19 22:25:51', '2024-03-19 22:25:51'),
(8, 7, 3, 5000.00, 75, '2024-03-19 22:48:46', '2024-03-19 22:48:46'),
(9, 8, 5, 5500.00, 10, '2024-03-19 22:55:08', '2024-03-19 22:55:08'),
(10, 9, 3, 5000.00, 15, '2024-03-20 22:22:57', '2024-03-20 22:22:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`compra_id`),
  ADD UNIQUE KEY `compras_compra_factura_unique` (`compra_factura`),
  ADD KEY `compras_prove_id_foreign` (`prove_id`);

--
-- Indices de la tabla `compra_detalles`
--
ALTER TABLE `compra_detalles`
  ADD PRIMARY KEY (`dcompra_id`),
  ADD KEY `compra_detalles_compra_id_foreign` (`compra_id`),
  ADD KEY `compra_detalles_prod_id_foreign` (`prod_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `presupuesto_temp_venta_detalles`
--
ALTER TABLE `presupuesto_temp_venta_detalles`
  ADD PRIMARY KEY (`temp_id`),
  ADD KEY `presupuesto_temp_venta_detalles_prod_id_foreign` (`prod_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `productos_cat_id_foreign` (`cat_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`prove_id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indices de la tabla `temp_compra_detalles`
--
ALTER TABLE `temp_compra_detalles`
  ADD PRIMARY KEY (`temp_id`),
  ADD KEY `temp_compra_detalles_prod_id_foreign` (`prod_id`);

--
-- Indices de la tabla `temp_venta_detalles`
--
ALTER TABLE `temp_venta_detalles`
  ADD PRIMARY KEY (`temp_id`),
  ADD KEY `temp_venta_detalles_prod_id_foreign` (`prod_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`venta_id`),
  ADD KEY `ventas_cli_id_foreign` (`cli_id`);

--
-- Indices de la tabla `venta_detalles`
--
ALTER TABLE `venta_detalles`
  ADD PRIMARY KEY (`dventa_id`),
  ADD KEY `venta_detalles_venta_id_foreign` (`venta_id`),
  ADD KEY `venta_detalles_prod_id_foreign` (`prod_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cli_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `compra_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra_detalles`
--
ALTER TABLE `compra_detalles`
  MODIFY `dcompra_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuesto_temp_venta_detalles`
--
ALTER TABLE `presupuesto_temp_venta_detalles`
  MODIFY `temp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `prod_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `prove_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `temp_compra_detalles`
--
ALTER TABLE `temp_compra_detalles`
  MODIFY `temp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `temp_venta_detalles`
--
ALTER TABLE `temp_venta_detalles`
  MODIFY `temp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `venta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `venta_detalles`
--
ALTER TABLE `venta_detalles`
  MODIFY `dventa_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_prove_id_foreign` FOREIGN KEY (`prove_id`) REFERENCES `proveedores` (`prove_id`);

--
-- Filtros para la tabla `compra_detalles`
--
ALTER TABLE `compra_detalles`
  ADD CONSTRAINT `compra_detalles_compra_id_foreign` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`compra_id`),
  ADD CONSTRAINT `compra_detalles_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `productos` (`prod_id`);

--
-- Filtros para la tabla `presupuesto_temp_venta_detalles`
--
ALTER TABLE `presupuesto_temp_venta_detalles`
  ADD CONSTRAINT `presupuesto_temp_venta_detalles_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `productos` (`prod_id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categorias` (`cat_id`);

--
-- Filtros para la tabla `temp_compra_detalles`
--
ALTER TABLE `temp_compra_detalles`
  ADD CONSTRAINT `temp_compra_detalles_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `productos` (`prod_id`);

--
-- Filtros para la tabla `temp_venta_detalles`
--
ALTER TABLE `temp_venta_detalles`
  ADD CONSTRAINT `temp_venta_detalles_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `productos` (`prod_id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_cli_id_foreign` FOREIGN KEY (`cli_id`) REFERENCES `clientes` (`cli_id`);

--
-- Filtros para la tabla `venta_detalles`
--
ALTER TABLE `venta_detalles`
  ADD CONSTRAINT `venta_detalles_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `productos` (`prod_id`),
  ADD CONSTRAINT `venta_detalles_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`venta_id`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `eliminar_temp_venta_detalles` ON SCHEDULE AT '2024-03-20 19:22:51' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                        DROP TABLE IF EXISTS temp_venta_detalles;
                    END$$

CREATE DEFINER=`root`@`localhost` EVENT `eliminar_temp_compra_detalles` ON SCHEDULE AT '2024-03-20 19:43:56' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                        DROP TABLE IF EXISTS temp_compra_detalles;
                    END$$

CREATE DEFINER=`root`@`localhost` EVENT `eliminar_Presupuesto_temp_venta_detalles` ON SCHEDULE AT '2024-03-20 20:12:03' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                        DROP TABLE IF EXISTS Presupuesto_temp_venta_detalles;
                    END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
