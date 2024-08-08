-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2024 a las 19:48:51
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
-- Base de datos: `db-salp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classes`
--

CREATE TABLE `classes` (
  `id_class` bigint(20) NOT NULL,
  `name_class` text NOT NULL,
  `life_class` decimal(10,2) NOT NULL,
  `status_class` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_class` date DEFAULT NULL,
  `date_updated_class` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `classes`
--

INSERT INTO `classes` (`id_class`, `name_class`, `life_class`, `status_class`, `date_created_class`, `date_updated_class`) VALUES
(1, 'LUMINARIAS', 3.50, 'Activo', '2024-08-04', '2024-08-04 17:36:23'),
(2, 'POSTES', 20.00, 'Activo', '2024-08-02', '2024-08-06 14:45:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepts`
--

CREATE TABLE `concepts` (
  `id_concept` bigint(20) NOT NULL,
  `name_concept` text NOT NULL,
  `title_concept` varchar(2) NOT NULL,
  `total_concept` varchar(2) NOT NULL,
  `tax_concept` varchar(2) NOT NULL,
  `percent_concept` decimal(15,2) NOT NULL,
  `date_created_concept` date DEFAULT NULL,
  `date_updated_concept` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crews`
--

CREATE TABLE `crews` (
  `id_crew` bigint(20) NOT NULL,
  `name_crew` text NOT NULL,
  `driver_crew` text NOT NULL,
  `tecno_crew` text NOT NULL,
  `assist_crew` text NOT NULL,
  `status_crew` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_crew` date DEFAULT NULL,
  `date_updated_crew` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `crews`
--

INSERT INTO `crews` (`id_crew`, `name_crew`, `driver_crew`, `tecno_crew`, `assist_crew`, `status_crew`, `date_created_crew`, `date_updated_crew`) VALUES
(1, 'CUADRILLA BASE', 'JUAN', 'PEDRO', 'JACOBO', 'Activo', '2024-08-03', '2024-08-03 21:09:01'),
(2, 'CUADRILLA PESADA', 'ALBERTO', 'SANTIAGO', 'RENE', 'Activo', '2024-08-03', '2024-08-03 21:09:01'),
(3, 'OTRA CUADRILLA PESADA A', 'MARIA B F', 'CAMILA C FG', 'SOFIA D', 'Activo', '2024-08-04', '2024-08-03 23:29:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deliveries`
--

CREATE TABLE `deliveries` (
  `id_delivery` bigint(20) NOT NULL,
  `id_typedelivery_delivery` bigint(20) NOT NULL,
  `id_itemdelivery_delivery` bigint(20) NOT NULL,
  `number_delivery` varchar(15) NOT NULL,
  `date_delivery` date NOT NULL,
  `id_resources_delivery` bigint(20) NOT NULL,
  `date_created_delivery` date DEFAULT NULL,
  `date_updated_delivery` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `deliveries`
--

INSERT INTO `deliveries` (`id_delivery`, `id_typedelivery_delivery`, `id_itemdelivery_delivery`, `number_delivery`, `date_delivery`, `id_resources_delivery`, `date_created_delivery`, `date_updated_delivery`) VALUES
(1, 1, 1, 'INI-001', '2024-08-01', 2, '2024-08-02', '2024-08-02 16:18:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elements`
--

CREATE TABLE `elements` (
  `id_element` bigint(20) NOT NULL,
  `id_class_element` bigint(20) NOT NULL,
  `code_element` varchar(15) NOT NULL,
  `name_element` text NOT NULL,
  `life_element` text NOT NULL,
  `address_element` text NOT NULL,
  `id_minute_element` bigint(20) DEFAULT NULL,
  `id_resource_element` bigint(20) NOT NULL,
  `id_roud_element` bigint(20) NOT NULL,
  `id_technology_element` bigint(20) DEFAULT NULL,
  `id_power_element` bigint(20) DEFAULT NULL,
  `id_material_element` bigint(20) DEFAULT NULL,
  `id_height_element` bigint(20) DEFAULT NULL,
  `altitud_element` float DEFAULT NULL,
  `latitude_element` float NOT NULL,
  `longitude_element` float NOT NULL,
  `id_dispose_element` bigint(20) DEFAULT NULL,
  `value_element` decimal(15,2) NOT NULL,
  `gallery_element` text NOT NULL,
  `status_element` varchar(8) NOT NULL,
  `date_created_element` date DEFAULT NULL,
  `date_updated_element` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elements`
--

INSERT INTO `elements` (`id_element`, `id_class_element`, `code_element`, `name_element`, `life_element`, `address_element`, `id_minute_element`, `id_resource_element`, `id_roud_element`, `id_technology_element`, `id_power_element`, `id_material_element`, `id_height_element`, `altitud_element`, `latitude_element`, `longitude_element`, `id_dispose_element`, `value_element`, `gallery_element`, `status_element`, `date_created_element`, `date_updated_element`) VALUES
(1, 1, '2514', 'prueba', 'nada', 'casa', 1, 1, 1, 1, 1, 0, NULL, 1.252, 10.2547, 74.2561, 0, 15000.00, '', 'Activo', '2024-08-08', '2024-08-08 16:11:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `heights`
--

CREATE TABLE `heights` (
  `id_height` bigint(20) NOT NULL,
  `name_height` text NOT NULL,
  `status_height` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_height` date DEFAULT NULL,
  `date_updated_height` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `heights`
--

INSERT INTO `heights` (`id_height`, `name_height`, `status_height`, `date_created_height`, `date_updated_height`) VALUES
(1, '9 mts', 'Activo', '2024-08-01', '2024-08-06 19:06:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemdeliveries`
--

CREATE TABLE `itemdeliveries` (
  `id_itemdelivery` bigint(20) NOT NULL,
  `code_itemdelivery` varchar(2) NOT NULL,
  `id_typedelivery_itemdelivery` bigint(20) NOT NULL,
  `name_itemdelivery` text NOT NULL,
  `status_itemdelivery` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_itemdelivery` date DEFAULT NULL,
  `date_updated_itemdelivery` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itemdeliveries`
--

INSERT INTO `itemdeliveries` (`id_itemdelivery`, `code_itemdelivery`, `id_typedelivery_itemdelivery`, `name_itemdelivery`, `status_itemdelivery`, `date_created_itemdelivery`, `date_updated_itemdelivery`) VALUES
(1, '01', 1, 'INICIAL', 'Activo', '2024-08-02', '2024-08-02 16:17:03'),
(2, '02', 2, 'EXPANSION', 'Activo', '2024-08-02', '2024-08-02 16:17:03'),
(3, '03', 2, 'MODERNIZACION', 'Activo', '2024-08-02', '2024-08-02 16:17:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

CREATE TABLE `materials` (
  `id_material` bigint(20) NOT NULL,
  `name_material` text NOT NULL,
  `status_material` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_material` date DEFAULT NULL,
  `date_updated_material` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materials`
--

INSERT INTO `materials` (`id_material`, `name_material`, `status_material`, `date_created_material`, `date_updated_material`) VALUES
(1, 'MADERA', 'Activo', '2024-08-05', '2024-08-05 15:12:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `powers`
--

CREATE TABLE `powers` (
  `id_power` bigint(20) NOT NULL,
  `name_power` text NOT NULL,
  `status_power` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_power` date DEFAULT NULL,
  `date_updated_power` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `powers`
--

INSERT INTO `powers` (`id_power`, `name_power`, `status_power`, `date_created_power`, `date_updated_power`) VALUES
(1, '30W', 'Activo', '2024-08-04', '2024-08-04 15:46:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqrs`
--

CREATE TABLE `pqrs` (
  `id_pqr` bigint(20) NOT NULL,
  `name_pqr` text NOT NULL,
  `email_pqr` text NOT NULL,
  `address_pqr` text NOT NULL,
  `message_pqr` text NOT NULL,
  `id_element_pqr` bigint(20) NOT NULL,
  `date_asign_pqr` date DEFAULT NULL,
  `id_creq_pqr` bigint(20) NOT NULL,
  `date_solution_pqr` date DEFAULT NULL,
  `latitud_pqr` float NOT NULL,
  `longitud_pqr` float NOT NULL,
  `name_address_pqr` text NOT NULL,
  `status_pqr` varchar(8) NOT NULL,
  `date_created_pqr` date DEFAULT NULL,
  `date_updated_pqr` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

CREATE TABLE `resources` (
  `id_resource` bigint(20) NOT NULL,
  `name_resource` text NOT NULL,
  `status_resource` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_resource` date DEFAULT NULL,
  `date_updated_resource` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id_resource`, `name_resource`, `status_resource`, `date_created_resource`, `date_updated_resource`) VALUES
(1, 'INVERIONISTA', 'Activo', '2024-08-02', '2024-08-02 16:20:18'),
(2, 'RECURSOS PROPIOS', 'Activo', '2024-08-02', '2024-08-02 16:20:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rouds`
--

CREATE TABLE `rouds` (
  `id_roud` bigint(20) NOT NULL,
  `code_roud` varchar(4) NOT NULL,
  `name_roud` text NOT NULL,
  `status_roud` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_roud` date DEFAULT NULL,
  `date_updated_roud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rouds`
--

INSERT INTO `rouds` (`id_roud`, `code_roud`, `name_roud`, `status_roud`, `date_created_roud`, `date_updated_roud`) VALUES
(1, 'M1', 'AUTOPISTAS Y CARRETERAS', 'Activo', '2024-08-05', '2024-08-04 22:02:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `technologies`
--

CREATE TABLE `technologies` (
  `id_technology` bigint(20) NOT NULL,
  `name_technology` text NOT NULL,
  `status_technology` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_technology` date DEFAULT NULL,
  `date_updated_technology` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `technologies`
--

INSERT INTO `technologies` (`id_technology`, `name_technology`, `status_technology`, `date_created_technology`, `date_updated_technology`) VALUES
(1, 'LED', 'Activo', '2024-08-05', '2024-08-05 15:35:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typedeliveries`
--

CREATE TABLE `typedeliveries` (
  `id_typedelivery` bigint(20) NOT NULL,
  `code_typedelivery` varchar(2) NOT NULL,
  `name_typedelivery` text NOT NULL,
  `status_typedelivery` varchar(8) NOT NULL DEFAULT 'Activo',
  `date_created_typedelivery` date DEFAULT NULL,
  `date_updated_typedelivery` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `typedeliveries`
--

INSERT INTO `typedeliveries` (`id_typedelivery`, `code_typedelivery`, `name_typedelivery`, `status_typedelivery`, `date_created_typedelivery`, `date_updated_typedelivery`) VALUES
(1, '01', 'INVENTARIO INICIAL', 'Activo', '2024-08-02', '2024-08-02 16:14:39'),
(2, '02', 'INVERSION', 'Activo', '2024-08-02', '2024-08-02 16:14:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) NOT NULL,
  `fullname_user` varchar(60) NOT NULL,
  `username_user` varchar(15) NOT NULL,
  `email_user` varchar(200) NOT NULL,
  `password_user` varchar(200) NOT NULL,
  `token_user` varchar(200) DEFAULT NULL,
  `token_exp_user` varchar(200) DEFAULT NULL,
  `id_rol_user` text NOT NULL,
  `picture_user` text DEFAULT NULL,
  `country_user` text NOT NULL,
  `city_user` text NOT NULL,
  `address_user` text NOT NULL,
  `phone_user` text NOT NULL,
  `method_user` varchar(10) NOT NULL,
  `date_created_user` date DEFAULT NULL,
  `date_updated_user` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_user` int(1) NOT NULL DEFAULT 1,
  `verification_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `fullname_user`, `username_user`, `email_user`, `password_user`, `token_user`, `token_exp_user`, `id_rol_user`, `picture_user`, `country_user`, `city_user`, `address_user`, `phone_user`, `method_user`, `date_created_user`, `date_updated_user`, `status_user`, `verification_user`) VALUES
(1, 'Osvaldo José Villalobos Cortina', 'osvicor', 'osvicor@hotmail.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MjMxMjk5MDcsImV4cCI6MTcyMzIxNjMwNywiZGF0YSI6eyJpZCI6MSwiZW1haWwiOiJvc3ZpY29yQGhvdG1haWwuY29tIn19.EnXmP9a3qSQyH0u7RZijnYMKc6Ol_2o41C1cXf7jllw', '1723216307', 'Administradores', '1.jpg', 'Afghanistan', 'Santa Marta', 'Urb. San Lorenzo Mz J Cs 34', '93_3153153153', 'direct', '2024-06-17', '2024-06-17 18:47:27', 1, 0),
(7, 'Jorge Villalobos', 'jorgito', 'jorge@gmail.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', NULL, NULL, 'Usuarios', '7.png', 'Algeria', 'Varsobia', 'LA QUE SEA', '+213_3153153153', 'direct', '2024-06-22', '2024-06-22 14:18:30', 1, 1),
(31, 'Juan Prueto', '', 'prueba@mail.com', '', NULL, NULL, '1', NULL, 'Afghanistan', 'Otra', 'calle 1', '+93_3253253325', 'direct', '2024-06-25', '2024-06-25 20:10:46', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_class`);

--
-- Indices de la tabla `concepts`
--
ALTER TABLE `concepts`
  ADD PRIMARY KEY (`id_concept`);

--
-- Indices de la tabla `crews`
--
ALTER TABLE `crews`
  ADD PRIMARY KEY (`id_crew`);

--
-- Indices de la tabla `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id_delivery`);

--
-- Indices de la tabla `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id_element`);

--
-- Indices de la tabla `heights`
--
ALTER TABLE `heights`
  ADD PRIMARY KEY (`id_height`);

--
-- Indices de la tabla `itemdeliveries`
--
ALTER TABLE `itemdeliveries`
  ADD PRIMARY KEY (`id_itemdelivery`);

--
-- Indices de la tabla `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `powers`
--
ALTER TABLE `powers`
  ADD PRIMARY KEY (`id_power`);

--
-- Indices de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  ADD PRIMARY KEY (`id_pqr`);

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id_resource`);

--
-- Indices de la tabla `rouds`
--
ALTER TABLE `rouds`
  ADD PRIMARY KEY (`id_roud`);

--
-- Indices de la tabla `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id_technology`);

--
-- Indices de la tabla `typedeliveries`
--
ALTER TABLE `typedeliveries`
  ADD PRIMARY KEY (`id_typedelivery`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_rol_user` (`id_rol_user`(768));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `classes`
--
ALTER TABLE `classes`
  MODIFY `id_class` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `concepts`
--
ALTER TABLE `concepts`
  MODIFY `id_concept` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `crews`
--
ALTER TABLE `crews`
  MODIFY `id_crew` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id_delivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `elements`
--
ALTER TABLE `elements`
  MODIFY `id_element` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `heights`
--
ALTER TABLE `heights`
  MODIFY `id_height` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `itemdeliveries`
--
ALTER TABLE `itemdeliveries`
  MODIFY `id_itemdelivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id_material` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `powers`
--
ALTER TABLE `powers`
  MODIFY `id_power` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  MODIFY `id_pqr` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `id_resource` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rouds`
--
ALTER TABLE `rouds`
  MODIFY `id_roud` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id_technology` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `typedeliveries`
--
ALTER TABLE `typedeliveries`
  MODIFY `id_typedelivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
