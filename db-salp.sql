-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2024 a las 18:28:35
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
(1, 'Osvaldo José Villalobos Cortina', 'osvicor', 'osvicor@hotmail.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MjI2MTQ0NDEsImV4cCI6MTcyMjcwMDg0MSwiZGF0YSI6eyJpZCI6MSwiZW1haWwiOiJvc3ZpY29yQGhvdG1haWwuY29tIn19.h3nW5UGOrll34Z8yzYyIOtaVQqEfYmgj_dMXmdvmg1I', '1722700841', 'Administradores', '1.jpg', 'Afghanistan', 'Santa Marta', 'Urb. San Lorenzo Mz J Cs 34', '93_3153153153', 'direct', '2024-06-17', '2024-06-17 18:47:27', 1, 0),
(7, 'Jorge Villalobos', 'jorgito', 'jorge@gmail.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', NULL, NULL, 'Usuarios', '7.png', 'Algeria', 'Varsobia', 'LA QUE SEA', '+213_3153153153', 'direct', '2024-06-22', '2024-06-22 14:18:30', 1, 1),
(31, 'Juan Prueto', '', 'prueba@mail.com', '', NULL, NULL, '1', NULL, 'Afghanistan', 'Otra', 'calle 1', '+93_3253253325', 'direct', '2024-06-25', '2024-06-25 20:10:46', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `concepts`
--
ALTER TABLE `concepts`
  ADD PRIMARY KEY (`id_concept`);

--
-- Indices de la tabla `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id_delivery`);

--
-- Indices de la tabla `itemdeliveries`
--
ALTER TABLE `itemdeliveries`
  ADD PRIMARY KEY (`id_itemdelivery`);

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id_resource`);

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
-- AUTO_INCREMENT de la tabla `concepts`
--
ALTER TABLE `concepts`
  MODIFY `id_concept` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id_delivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `itemdeliveries`
--
ALTER TABLE `itemdeliveries`
  MODIFY `id_itemdelivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `id_resource` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
