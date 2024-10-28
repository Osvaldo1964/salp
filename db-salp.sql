-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2024 a las 21:24:48
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
  `id_resource_delivery` bigint(20) NOT NULL,
  `date_created_delivery` date DEFAULT NULL,
  `date_updated_delivery` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `deliveries`
--

INSERT INTO `deliveries` (`id_delivery`, `id_typedelivery_delivery`, `id_itemdelivery_delivery`, `number_delivery`, `date_delivery`, `id_resource_delivery`, `date_created_delivery`, `date_updated_delivery`) VALUES
(1, 1, 1, 'INI-001', '2024-08-01', 2, '2024-08-02', '2024-08-02 16:18:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id_department` bigint(20) NOT NULL,
  `name_department` text NOT NULL,
  `code_department` varchar(2) NOT NULL,
  `date_created_department` date DEFAULT NULL,
  `date_updated_department` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id_department`, `name_department`, `code_department`, `date_created_department`, `date_updated_department`) VALUES
(1, 'ANTIOQUIA', '05', '2024-09-09', '2024-09-09 19:13:55'),
(2, 'ATLANTICO', '08', '2024-09-09', '2024-09-09 19:13:55'),
(3, 'BOGOTA', '11', '2024-09-09', '2024-09-09 19:13:55'),
(4, 'BOLIVAR', '13', '2024-09-09', '2024-09-09 19:13:55'),
(5, 'BOYACA', '15', '2024-09-09', '2024-09-09 19:13:55'),
(6, 'CALDAS', '17', '2024-09-09', '2024-09-09 19:13:55'),
(7, 'CAQUETA', '18', '2024-09-09', '2024-09-09 19:13:55'),
(8, 'CAUCA', '19', '2024-09-09', '2024-09-09 19:13:55'),
(9, 'CESAR', '20', '2024-09-09', '2024-09-09 19:13:55'),
(10, 'CORDOBA', '23', '2024-09-09', '2024-09-09 19:13:55'),
(11, 'CUNDINAMARCA', '25', '2024-09-09', '2024-09-09 19:13:55'),
(12, 'CHOCO', '27', '2024-09-09', '2024-09-09 19:13:55'),
(13, 'HUILA', '41', '2024-09-09', '2024-09-09 19:13:55'),
(14, 'LA GUAJIRA', '44', '2024-09-09', '2024-09-09 19:13:55'),
(15, 'MAGDALENA', '47', '2024-09-09', '2024-09-09 19:13:55'),
(16, 'META', '50', '2024-09-09', '2024-09-09 19:13:55'),
(17, 'NARIÑO', '52', '2024-09-09', '2024-09-09 19:13:55'),
(18, 'N. DE SANTANDER', '54', '2024-09-09', '2024-09-09 19:13:55'),
(19, 'QUINDIO', '63', '2024-09-09', '2024-09-09 19:13:55'),
(20, 'RISARALDA', '66', '2024-09-09', '2024-09-09 19:13:55'),
(21, 'SANTANDER', '68', '2024-09-09', '2024-09-09 19:13:55'),
(22, 'SUCRE', '70', '2024-09-09', '2024-09-09 19:13:55'),
(23, 'TOLIMA', '73', '2024-09-09', '2024-09-09 19:13:55'),
(24, 'VALLE DEL CAUCA', '76', '2024-09-09', '2024-09-09 19:13:55'),
(25, 'ARAUCA', '81', '2024-09-09', '2024-09-09 19:13:55'),
(26, 'CASANARE', '85', '2024-09-09', '2024-09-09 19:13:55'),
(27, 'PUTUMAYO', '86', '2024-09-09', '2024-09-09 19:13:55'),
(28, 'SAN ANDRES', '88', '2024-09-09', '2024-09-09 19:13:55'),
(29, 'AMAZONAS', '91', '2024-09-09', '2024-09-09 19:13:55'),
(30, 'GUAINIA', '94', '2024-09-09', '2024-09-09 19:13:55'),
(31, 'GUAVIARE', '95', '2024-09-09', '2024-09-09 19:13:55'),
(32, 'VAUPES', '97', '2024-09-09', '2024-09-09 19:13:55'),
(33, 'VICHADA', '99', '2024-09-09', '2024-09-09 19:13:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `details`
--

CREATE TABLE `details` (
  `id_detail` bigint(20) NOT NULL,
  `id_delivery_detail` bigint(20) NOT NULL,
  `name_detail` text NOT NULL,
  `unit_detail` varchar(6) NOT NULL,
  `quantity_detal` decimal(15,2) NOT NULL,
  `price_detail` decimal(15,2) NOT NULL,
  `amount_detail` decimal(15,2) NOT NULL,
  `status_detail` varchar(8) NOT NULL,
  `date_created_detail` date DEFAULT NULL,
  `date_updated_detail` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `details`
--

INSERT INTO `details` (`id_detail`, `id_delivery_detail`, `name_detail`, `unit_detail`, `quantity_detal`, `price_detail`, `amount_detail`, `status_detail`, `date_created_detail`, `date_updated_detail`) VALUES
(1, 1, 'LUMINARIAS LED 30W', 'Und', 10.00, 15600.00, 156000.00, '1', '2024-10-07', '2024-10-07 17:05:47');

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
  `qty_element` decimal(15,2) NOT NULL,
  `value_element` decimal(15,2) NOT NULL,
  `gallery_element` text NOT NULL,
  `status_element` varchar(8) NOT NULL,
  `date_created_element` date DEFAULT NULL,
  `date_updated_element` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elements`
--

INSERT INTO `elements` (`id_element`, `id_class_element`, `code_element`, `name_element`, `life_element`, `address_element`, `id_minute_element`, `id_resource_element`, `id_roud_element`, `id_technology_element`, `id_power_element`, `id_material_element`, `id_height_element`, `altitud_element`, `latitude_element`, `longitude_element`, `id_dispose_element`, `qty_element`, `value_element`, `gallery_element`, `status_element`, `date_created_element`, `date_updated_element`) VALUES
(1, 1, '2514', 'prueba', 'nada', 'casa', 1, 1, 1, 1, 1, 0, NULL, 1.252, 10.2547, 74.2561, 0, 0.00, 15000.00, '', 'Activo', '2024-08-08', '2024-08-08 16:11:31'),
(2, 1, '212524', 'MADERA AZUL', '<p>prueba</p>', 'CASSSS', 0, 2, 1, 1, 1, 0, 185, 0, 1.23524, 20.2522, 0, 0.00, 15000.00, '[\"26704.png\",\"54816.jpg\",\"13486.png\"]', 'Activo', '2024-08-08', '2024-08-08 19:02:44'),
(3, 1, 'cls95878', 'MADERA VERDE', '                                <p>otra peurba</p>                                ', 'LA DIRECCION VERDE', 0, 2, 1, 1, 2, 1, 1, 0, 10.4525, 74.2536, 0, 0.00, 16000.00, '[\"16605.jpg\",\"78349.jpg\"]', 'Activo', '2024-08-08', '2024-08-08 19:06:07'),
(4, 1, 'hj2515', 'LUMINARIA DE SODIO 100W', '<p>ALGO</p>', 'CARRERA 11', 0, 2, 1, 2, 3, 0, 277, 0, 10.2652, 14.2522, 0, 0.00, 1500.00, '[\"22450.png\",\"94025.png\"]', 'Activo', '2024-10-05', '2024-10-06 00:43:21'),
(5, 1, 'LED1452', 'LUMINARIA LED 30W', '                                <p>INGRESO AL INVENTARIO 2024-10-09</p>                                ', 'CARRERA 17A CALLE 22', 0, 2, 1, 1, 1, 1, 1, 0, 10.2523, 74.1525, 0, 0.00, 0.00, '[\"43789.jpg\",\"17801.jpg\"]', 'Activo', '2024-10-09', '2024-10-09 13:46:25'),
(6, 1, 'LED1453', 'LUMINARIA LED 30W', '                                                                                                                                <p>prueba</p>                                                                                                                                ', 'CARRERA 22 CALLE 5', 0, 1, 1, 1, 2, 1, 1, 0, 10.2523, 74.1525, 0, 1.00, 250252.00, '[\"61356.jpg\",\"40155.jpg\"]', 'Activo', '2024-10-09', '2024-10-09 13:49:48'),
(7, 2, 'POS1520', 'POSTE DE MADERA 9 MTS', '                                                                                                <p>PRUEBA 2</p>                                                                                                ', 'CALLE 11 CARRERA 16', 1, 2, 1, 1, 1, 1, 1, 0, 10.2523, -74.1525, 0, 1.00, 258652.00, '[\"78204.jpg\"]', 'Activo', '2024-10-09', '2024-10-09 14:23:23'),
(8, 1, 'LED1454', 'LUMINARIA LED 30W', '<p>OTRO</p>', 'CALLE 1 CARRERA 1', 1, 1, 1, 1, 3, 0, 0, 0, 10.2523, -74.1525, 0, 1.00, 1525000.00, '[\"error\"]', 'Activo', '2024-10-09', '2024-10-09 14:44:46');

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
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id_image` bigint(20) NOT NULL,
  `id_element_image` bigint(20) NOT NULL,
  `name_image` text NOT NULL,
  `date_created_image` date DEFAULT NULL,
  `date_updated_image` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, '03', 2, 'MODERNIZACION', 'Activo', '2024-08-02', '2024-08-02 16:17:22'),
(4, '04', 2, 'ACTA DE BAJA dos', 'Activo', '2024-08-15', '2024-08-15 14:28:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `luminaries`
--

CREATE TABLE `luminaries` (
  `id_luminary` bigint(20) NOT NULL,
  `id_delivery_luminary` bigint(20) NOT NULL,
  `code_luminary` text NOT NULL,
  `id_technology_luminary` bigint(20) NOT NULL,
  `id_power_luminary` bigint(20) NOT NULL,
  `id_pole_luminary` bigint(20) NOT NULL,
  `id_transformer_luminary` bigint(20) NOT NULL,
  `id_roud_luminary` bigint(20) NOT NULL,
  `address_luminary` text NOT NULL,
  `latitude_luminary` float NOT NULL,
  `longitude_luminary` float NOT NULL,
  `cost_luminary` decimal(15,2) NOT NULL,
  `life_luminary` mediumtext NOT NULL,
  `gallery_luminary` text NOT NULL,
  `status_luminary` varchar(8) NOT NULL,
  `date_created_luminary` date DEFAULT NULL,
  `date_updated_luminary` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `luminaries`
--

INSERT INTO `luminaries` (`id_luminary`, `id_delivery_luminary`, `code_luminary`, `id_technology_luminary`, `id_power_luminary`, `id_pole_luminary`, `id_transformer_luminary`, `id_roud_luminary`, `address_luminary`, `latitude_luminary`, `longitude_luminary`, `cost_luminary`, `life_luminary`, `gallery_luminary`, `status_luminary`, `date_created_luminary`, `date_updated_luminary`) VALUES
(2, 1, 'led-525', 1, 2, 1, 2, 1, 'CARRERA 11 CALLE 17', 1.23524, 74.2536, 444.00, '<p>PREUBA</p>', '[\"led-525-5553112.jpg\",\"led-525-5252210.jpg\"]', 'Activo', '2024-10-18', '2024-10-18 17:26:48');

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
-- Estructura de tabla para la tabla `municipalities`
--

CREATE TABLE `municipalities` (
  `id_municipality` bigint(20) NOT NULL,
  `name_municipality` text NOT NULL,
  `code_municipality` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_department_municipality` bigint(20) DEFAULT NULL,
  `date_created_municipality` timestamp NULL DEFAULT NULL,
  `date_updated_municipality` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `municipalities`
--

INSERT INTO `municipalities` (`id_municipality`, `name_municipality`, `code_municipality`, `id_department_municipality`, `date_created_municipality`, `date_updated_municipality`) VALUES
(1, 'MEDELLÍN', '5001', 1, NULL, 0),
(2, 'ABEJORRAL', '5002', 1, NULL, 0),
(3, 'ABRIAQUÍ', '5004', 1, NULL, 0),
(4, 'ALEJANDRÍA', '5021', 1, NULL, 0),
(5, 'AMAGÁ', '503', 1, NULL, 0),
(6, 'AMALFI', '5031', 1, NULL, 0),
(7, 'ANDES', '5034', 1, NULL, 0),
(8, 'ANGELÓPOLIS', '5036', 1, NULL, 0),
(9, 'ANGOSTURA', '5038', 1, NULL, 0),
(10, 'ANORÍ', '504', 1, NULL, 0),
(11, 'TUNUNGUÁ', '15832', 5, NULL, 0),
(12, 'ANZA', '5044', 1, NULL, 0),
(13, 'APARTADÓ', '5045', 1, NULL, 0),
(14, 'ARBOLETES', '5051', 1, NULL, 0),
(15, 'ARGELIA', '5055', 1, NULL, 0),
(16, 'ARMENIA', '5059', 1, NULL, 0),
(17, 'BARBOSA', '5079', 1, NULL, 0),
(18, 'BELLO', '5088', 1, NULL, 0),
(19, 'BETANIA', '5091', 1, NULL, 0),
(20, 'BETULIA', '5093', 1, NULL, 0),
(21, 'CIUDAD BOLÍVAR', '5101', 1, NULL, 0),
(22, 'BRICEÑO', '5107', 1, NULL, 0),
(23, 'BURITICÁ', '5113', 1, NULL, 0),
(24, 'CÁCERES', '512', 1, NULL, 0),
(25, 'CAICEDO', '5125', 1, NULL, 0),
(26, 'CALDAS', '5129', 1, NULL, 0),
(27, 'CAMPAMENTO', '5134', 1, NULL, 0),
(28, 'CAÑASGORDAS', '5138', 1, NULL, 0),
(29, 'CARACOLÍ', '5142', 1, NULL, 0),
(30, 'CARAMANTA', '5145', 1, NULL, 0),
(31, 'CAREPA', '5147', 1, NULL, 0),
(32, 'MOTAVITA', '15476', 5, NULL, 0),
(33, 'CAROLINA', '515', 1, NULL, 0),
(34, 'CAUCASIA', '5154', 1, NULL, 0),
(35, 'CHIGOROD?', '5172', 1, NULL, 0),
(36, 'CISNEROS', '519', 1, NULL, 0),
(37, 'COCORNÁ', '5197', 1, NULL, 0),
(38, 'CONCEPCIÓN', '5206', 1, NULL, 0),
(39, 'CONCORDIA', '5209', 1, NULL, 0),
(40, 'COPACABANA', '5212', 1, NULL, 0),
(41, 'DABEIBA', '5234', 1, NULL, 0),
(42, 'DON MATÍAS', '5237', 1, NULL, 0),
(43, 'EB?JICO', '524', 1, NULL, 0),
(44, 'EL BAGRE', '525', 1, NULL, 0),
(45, 'ENTRERRIOS', '5264', 1, NULL, 0),
(46, 'ENVIGADO', '5266', 1, NULL, 0),
(47, 'FREDONIA', '5282', 1, NULL, 0),
(48, 'SAN BERNARDO DEL VIENTO', '23675', 10, NULL, 0),
(49, 'GIRALDO', '5306', 1, NULL, 0),
(50, 'GIRARDOTA', '5308', 1, NULL, 0),
(51, 'G?MEZ PLATA', '531', 1, NULL, 0),
(52, 'ISTMINA', '27361', 12, NULL, 0),
(53, 'GUADALUPE', '5315', 1, NULL, 0),
(54, 'GUARNE', '5318', 1, NULL, 0),
(55, 'GUATAPÉ', '5321', 1, NULL, 0),
(56, 'HELICONIA', '5347', 1, NULL, 0),
(57, 'HISPANIA', '5353', 1, NULL, 0),
(58, 'ITAGUI', '536', 1, NULL, 0),
(59, 'ITUANGO', '5361', 1, NULL, 0),
(60, 'BELMIRA', '5086', 1, NULL, 0),
(61, 'JERIC?', '5368', 1, NULL, 0),
(62, 'LA CEJA', '5376', 1, NULL, 0),
(63, 'LA ESTRELLA', '538', 1, NULL, 0),
(64, 'LA PINTADA', '539', 1, NULL, 0),
(65, 'LA UNIÓN', '54', 1, NULL, 0),
(66, 'LIBORINA', '5411', 1, NULL, 0),
(67, 'MACEO', '5425', 1, NULL, 0),
(68, 'MARINILLA', '544', 1, NULL, 0),
(69, 'MONTEBELLO', '5467', 1, NULL, 0),
(70, 'MURIND?', '5475', 1, NULL, 0),
(71, 'MUTAT?', '548', 1, NULL, 0),
(72, 'NARIÑO', '5483', 1, NULL, 0),
(73, 'NECOCL?', '549', 1, NULL, 0),
(74, 'NECH?', '5495', 1, NULL, 0),
(75, 'OLAYA', '5501', 1, NULL, 0),
(76, 'PEÑOL', '5541', 1, NULL, 0),
(77, 'PEQUE', '5543', 1, NULL, 0),
(78, 'PUEBLORRICO', '5576', 1, NULL, 0),
(79, 'PUERTO BERRÍO', '5579', 1, NULL, 0),
(80, 'PUERTO NARE', '5585', 1, NULL, 0),
(81, 'PUERTO TRIUNFO', '5591', 1, NULL, 0),
(82, 'REMEDIOS', '5604', 1, NULL, 0),
(83, 'RETIRO', '5607', 1, NULL, 0),
(84, 'RIONEGRO', '5615', 1, NULL, 0),
(85, 'SABANALARGA', '5628', 1, NULL, 0),
(86, 'SABANETA', '5631', 1, NULL, 0),
(87, 'SALGAR', '5642', 1, NULL, 0),
(88, 'CIÉNEGA', '15189', 5, NULL, 0),
(89, 'SANTACRUZ', '52699', 17, NULL, 0),
(90, 'SAN FRANCISCO', '5652', 1, NULL, 0),
(91, 'SAN JER?NIMO', '5656', 1, NULL, 0),
(92, 'PUERTO WILCHES', '68575', 21, NULL, 0),
(93, 'PUERTO PARRA', '68573', 21, NULL, 0),
(94, 'SAN LUIS', '566', 1, NULL, 0),
(95, 'SAN PEDRO', '5664', 1, NULL, 0),
(96, 'SAN RAFAEL', '5667', 1, NULL, 0),
(97, 'SAN ROQUE', '567', 1, NULL, 0),
(98, 'SAN VICENTE', '5674', 1, NULL, 0),
(99, 'SANTA B?RBARA', '5679', 1, NULL, 0),
(100, 'SANTO DOMINGO', '569', 1, NULL, 0),
(101, 'EL SANTUARIO', '5697', 1, NULL, 0),
(102, 'SEGOVIA', '5736', 1, NULL, 0),
(103, 'SOPETR?N', '5761', 1, NULL, 0),
(104, 'URIBE', '5037', 16, NULL, 0),
(105, 'T?MESIS', '5789', 1, NULL, 0),
(106, 'TARAZ?', '579', 1, NULL, 0),
(107, 'TARSO', '5792', 1, NULL, 0),
(108, 'TITIRIB?', '5809', 1, NULL, 0),
(109, 'TOLEDO', '5819', 1, NULL, 0),
(110, 'TURBO', '5837', 1, NULL, 0),
(111, 'URAMITA', '5842', 1, NULL, 0),
(112, 'URRAO', '5847', 1, NULL, 0),
(113, 'VALDIVIA', '5854', 1, NULL, 0),
(114, 'VALPARAÍSO', '5856', 1, NULL, 0),
(115, 'VEGACHÍ', '5858', 1, NULL, 0),
(116, 'VENECIA', '5861', 1, NULL, 0),
(117, 'YAL?', '5885', 1, NULL, 0),
(118, 'YARUMAL', '5887', 1, NULL, 0),
(119, 'YOLOMB?', '589', 1, NULL, 0),
(120, 'YONDÓ', '5893', 1, NULL, 0),
(121, 'ZARAGOZA', '5895', 1, NULL, 0),
(122, 'BARRANQUILLA', '8001', 2, NULL, 0),
(123, 'BARANOA', '8078', 3, NULL, 0),
(124, 'CANDELARIA', '8141', 2, NULL, 0),
(125, 'GALAPA', '8296', 2, NULL, 0),
(126, 'LURUACO', '8421', 2, NULL, 0),
(127, 'MALAMBO', '8433', 2, NULL, 0),
(128, 'MANAT?', '8436', 2, NULL, 0),
(129, 'PIOJÓ', '8549', 2, NULL, 0),
(130, 'POLONUEVO', '8558', 2, NULL, 0),
(131, 'SABANAGRANDE', '8634', 2, NULL, 0),
(132, 'SABANALARGA', '8638', 2, NULL, 0),
(133, 'SANTA LUC?A', '8675', 2, NULL, 0),
(134, 'SANTO TOM?S', '8685', 2, NULL, 0),
(135, 'SOLEDAD', '8758', 2, NULL, 0),
(136, 'SUAN', '877', 2, NULL, 0),
(137, 'TUBAR?', '8832', 2, NULL, 0),
(138, 'USIACURÍ', '8849', 2, NULL, 0),
(139, 'ACHÍ', '13006', 4, NULL, 0),
(140, 'ARENAL', '13042', 4, NULL, 0),
(141, 'ARJONA', '13052', 4, NULL, 0),
(142, 'ARROYOHONDO', '13062', 4, NULL, 0),
(143, 'CALAMAR', '1314', 4, NULL, 0),
(144, 'CANTAGALLO', '1316', 4, NULL, 0),
(145, 'CICUCO', '13188', 4, NULL, 0),
(146, 'CÓRDOBA', '13212', 4, NULL, 0),
(147, 'CLEMENCIA', '13222', 4, NULL, 0),
(148, 'EL GUAMO', '13248', 4, NULL, 0),
(149, 'MAGANGU?', '1343', 4, NULL, 0),
(150, 'MAHATES', '13433', 4, NULL, 0),
(151, 'MARGARITA', '1344', 4, NULL, 0),
(152, 'MONTECRISTO', '13458', 4, NULL, 0),
(153, 'MOMP?S', '13468', 4, NULL, 0),
(154, 'MORALES', '13473', 4, NULL, 0),
(155, 'NOROS?', '1349', 4, NULL, 0),
(156, 'PINILLOS', '13549', 4, NULL, 0),
(157, 'REGIDOR', '1358', 4, NULL, 0),
(158, 'R?O VIEJO', '136', 4, NULL, 0),
(159, 'SAN ESTANISLAO', '13647', 4, NULL, 0),
(160, 'SAN FERNANDO', '1365', 4, NULL, 0),
(161, 'SAN JUAN NEPOMUCENO', '13657', 4, NULL, 0),
(162, 'SANTA CATALINA', '13673', 4, NULL, 0),
(163, 'SANTA ROSA', '13683', 4, NULL, 0),
(164, 'SIMIT?', '13744', 4, NULL, 0),
(165, 'SOPLAVIENTO', '1376', 4, NULL, 0),
(166, 'TALAIGUA NUEVO', '1378', 4, NULL, 0),
(167, 'TIQUISIO', '1381', 4, NULL, 0),
(168, 'TURBACO', '13836', 4, NULL, 0),
(169, 'TURBAN?', '13838', 4, NULL, 0),
(170, 'VILLANUEVA', '13873', 4, NULL, 0),
(171, 'TUNJA', '15001', 5, NULL, 0),
(172, 'ALMEIDA', '15022', 5, NULL, 0),
(173, 'AQUITANIA', '15047', 5, NULL, 0),
(174, 'ARCABUCO', '15051', 5, NULL, 0),
(175, 'BERBEO', '1509', 5, NULL, 0),
(176, 'BET?ITIVA', '15092', 5, NULL, 0),
(177, 'BOAVITA', '15097', 5, NULL, 0),
(178, 'BOYACÁ', '15104', 5, NULL, 0),
(179, 'BRICEÑO', '15106', 5, NULL, 0),
(180, 'BUENA VISTA', '15109', 5, NULL, 0),
(181, 'BUSBANZÁ', '15114', 5, NULL, 0),
(182, 'CALDAS', '15131', 5, NULL, 0),
(183, 'CAMPOHERMOSO', '15135', 5, NULL, 0),
(184, 'CERINZA', '15162', 5, NULL, 0),
(185, 'CHINAVITA', '15172', 5, NULL, 0),
(186, 'CHIQUINQUIRÁ', '15176', 5, NULL, 0),
(187, 'CHISCAS', '1518', 5, NULL, 0),
(188, 'CHITA', '15183', 5, NULL, 0),
(189, 'CHITARAQUE', '15185', 5, NULL, 0),
(190, 'CHIVATÁ', '15187', 5, NULL, 0),
(191, 'CÓMBITA', '15204', 5, NULL, 0),
(192, 'COPER', '15212', 5, NULL, 0),
(193, 'CORRALES', '15215', 5, NULL, 0),
(194, 'COVARACH?A', '15218', 5, NULL, 0),
(195, 'CUBAR?', '15223', 5, NULL, 0),
(196, 'CUCAITA', '15224', 5, NULL, 0),
(197, 'CU?TIVA', '15226', 5, NULL, 0),
(198, 'CH?QUIZA', '15232', 5, NULL, 0),
(199, 'CHIVOR', '15236', 5, NULL, 0),
(200, 'DUITAMA', '15238', 5, NULL, 0),
(201, 'EL COCUY', '15244', 5, NULL, 0),
(202, 'EL ESPINO', '15248', 5, NULL, 0),
(203, 'FIRAVITOBA', '15272', 5, NULL, 0),
(204, 'FLORESTA', '15276', 5, NULL, 0),
(205, 'GACHANTIVÁ', '15293', 5, NULL, 0),
(206, 'GAMEZA', '15296', 5, NULL, 0),
(207, 'GARAGOA', '15299', 5, NULL, 0),
(208, 'GUACAMAYAS', '15317', 5, NULL, 0),
(209, 'GUATEQUE', '15322', 5, NULL, 0),
(210, 'GUAYAT?', '15325', 5, NULL, 0),
(211, 'G?IC?N', '15332', 5, NULL, 0),
(212, 'IZA', '15362', 5, NULL, 0),
(213, 'JENESANO', '15367', 5, NULL, 0),
(214, 'JERIC?', '15368', 5, NULL, 0),
(215, 'LABRANZAGRANDE', '15377', 5, NULL, 0),
(216, 'LA CAPILLA', '1538', 5, NULL, 0),
(217, 'LA VICTORIA', '15401', 5, NULL, 0),
(218, 'MACANAL', '15425', 5, NULL, 0),
(219, 'MARIP?', '15442', 5, NULL, 0),
(220, 'MIRAFLORES', '15455', 5, NULL, 0),
(221, 'MONGUA', '15464', 5, NULL, 0),
(222, 'MONGU?', '15466', 5, NULL, 0),
(223, 'MONIQUIRÁ', '15469', 5, NULL, 0),
(224, 'MUZO', '1548', 5, NULL, 0),
(225, 'NOBSA', '15491', 5, NULL, 0),
(226, 'NUEVO COL?N', '15494', 5, NULL, 0),
(227, 'OICAT?', '155', 5, NULL, 0),
(228, 'OTANCHE', '15507', 5, NULL, 0),
(229, 'PACHAVITA', '15511', 5, NULL, 0),
(230, 'PÁEZ', '15514', 5, NULL, 0),
(231, 'PAIPA', '15516', 5, NULL, 0),
(232, 'PAJARITO', '15518', 5, NULL, 0),
(233, 'PANQUEBA', '15522', 5, NULL, 0),
(234, 'PAUNA', '15531', 5, NULL, 0),
(235, 'PAYA', '15533', 5, NULL, 0),
(236, 'PESCA', '15542', 5, NULL, 0),
(237, 'PISBA', '1555', 5, NULL, 0),
(238, 'PUERTO BOYACÁ', '15572', 5, NULL, 0),
(239, 'QU?PAMA', '1558', 5, NULL, 0),
(240, 'RAMIRIQUÁ', '15599', 5, NULL, 0),
(241, 'R?QUIRA', '156', 5, NULL, 0),
(242, 'ROND?N', '15621', 5, NULL, 0),
(243, 'SABOYÁ', '15632', 5, NULL, 0),
(244, 'S?CHICA', '15638', 5, NULL, 0),
(245, 'SAMAC?', '15646', 5, NULL, 0),
(246, 'SAN EDUARDO', '1566', 5, NULL, 0),
(247, 'SAN MATEO', '15673', 5, NULL, 0),
(248, 'SANTANA', '15686', 5, NULL, 0),
(249, 'SANTA MAR?A', '1569', 5, NULL, 0),
(250, 'SANTA SOF?A', '15696', 5, NULL, 0),
(251, 'SATIVANORTE', '1572', 5, NULL, 0),
(252, 'SATIVASUR', '15723', 5, NULL, 0),
(253, 'SIACHOQUE', '1574', 5, NULL, 0),
(254, 'SOAT?', '15753', 5, NULL, 0),
(255, 'SOCOT?', '15755', 5, NULL, 0),
(256, 'SOCHA', '15757', 5, NULL, 0),
(257, 'SOGAMOSO', '15759', 5, NULL, 0),
(258, 'SOMONDOCO', '15761', 5, NULL, 0),
(259, 'SORA', '15762', 5, NULL, 0),
(260, 'SOTAQUIR?', '15763', 5, NULL, 0),
(261, 'SORAC?', '15764', 5, NULL, 0),
(262, 'SUSAC?N', '15774', 5, NULL, 0),
(263, 'SUTAMARCH?N', '15776', 5, NULL, 0),
(264, 'SUTATENZA', '15778', 5, NULL, 0),
(265, 'TASCO', '1579', 5, NULL, 0),
(266, 'TENZA', '15798', 5, NULL, 0),
(267, 'TIBAN?', '15804', 5, NULL, 0),
(268, 'TINJAC?', '15808', 5, NULL, 0),
(269, 'TIPACOQUE', '1581', 5, NULL, 0),
(270, 'TOCA', '15814', 5, NULL, 0),
(271, 'T?PAGA', '1582', 5, NULL, 0),
(272, 'TOTA', '15822', 5, NULL, 0),
(273, 'TURMEQU?', '15835', 5, NULL, 0),
(274, 'TUTAZ?', '15839', 5, NULL, 0),
(275, 'UMBITA', '15842', 5, NULL, 0),
(276, 'VENTAQUEMADA', '15861', 5, NULL, 0),
(277, 'VIRACACH?', '15879', 5, NULL, 0),
(278, 'ZETAQUIRA', '15897', 5, NULL, 0),
(279, 'MANIZALES', '17001', 6, NULL, 0),
(280, 'AGUADAS', '17013', 6, NULL, 0),
(281, 'ANSERMA', '17042', 6, NULL, 0),
(282, 'ARANZAZU', '1705', 6, NULL, 0),
(283, 'BELALCÁZAR', '17088', 6, NULL, 0),
(284, 'CHINCHINÁ', '17174', 6, NULL, 0),
(285, 'FILADELFIA', '17272', 6, NULL, 0),
(286, 'LA DORADA', '1738', 6, NULL, 0),
(287, 'LA MERCED', '17388', 6, NULL, 0),
(288, 'MANZANARES', '17433', 6, NULL, 0),
(289, 'MARMATO', '17442', 6, NULL, 0),
(290, 'MARULANDA', '17446', 6, NULL, 0),
(291, 'NEIRA', '17486', 6, NULL, 0),
(292, 'NORCASIA', '17495', 6, NULL, 0),
(293, 'P?CORA', '17513', 6, NULL, 0),
(294, 'PALESTINA', '17524', 6, NULL, 0),
(295, 'PENSILVANIA', '17541', 6, NULL, 0),
(296, 'RIOSUCIO', '17614', 6, NULL, 0),
(297, 'RISARALDA', '17616', 6, NULL, 0),
(298, 'SALAMINA', '17653', 6, NULL, 0),
(299, 'SAMANÁ', '17662', 6, NULL, 0),
(300, 'SAN JOSÉ', '17665', 6, NULL, 0),
(301, 'SUP?A', '17777', 6, NULL, 0),
(302, 'VICTORIA', '17867', 6, NULL, 0),
(303, 'VILLAMAR?A', '17873', 6, NULL, 0),
(304, 'VITERBO', '17877', 6, NULL, 0),
(305, 'FLORENCIA', '18001', 7, NULL, 0),
(306, 'ALBANIA', '18029', 7, NULL, 0),
(307, 'CURILLO', '18205', 7, NULL, 0),
(308, 'EL DONCELLO', '18247', 7, NULL, 0),
(309, 'EL PAUJIL', '18256', 7, NULL, 0),
(310, 'MORELIA', '18479', 7, NULL, 0),
(311, 'PUERTO RICO', '18592', 7, NULL, 0),
(312, 'SOLANO', '18756', 7, NULL, 0),
(313, 'SOLITA', '18785', 7, NULL, 0),
(314, 'VALPARAÍSO', '1886', 7, NULL, 0),
(315, 'POPAYÁN', '19001', 8, NULL, 0),
(316, 'ALMAGUER', '19022', 8, NULL, 0),
(317, 'ARGELIA', '1905', 8, NULL, 0),
(318, 'BALBOA', '19075', 8, NULL, 0),
(319, 'BOLÍVAR', '191', 8, NULL, 0),
(320, 'BUENOS AIRES', '1911', 8, NULL, 0),
(321, 'CAJIB?O', '1913', 8, NULL, 0),
(322, 'CALDONO', '19137', 8, NULL, 0),
(323, 'CALOTO', '19142', 8, NULL, 0),
(324, 'CORINTO', '19212', 8, NULL, 0),
(325, 'EL TAMBO', '19256', 8, NULL, 0),
(326, 'FLORENCIA', '1929', 8, NULL, 0),
(327, 'GUACHEN?', '193', 8, NULL, 0),
(328, 'GUAPI', '19318', 8, NULL, 0),
(329, 'INZ?', '19355', 8, NULL, 0),
(330, 'JAMBAL?', '19364', 8, NULL, 0),
(331, 'LA SIERRA', '19392', 8, NULL, 0),
(332, 'LA VEGA', '19397', 8, NULL, 0),
(333, 'LÓPEZ', '19418', 8, NULL, 0),
(334, 'MERCADERES', '1945', 8, NULL, 0),
(335, 'MIRANDA', '19455', 8, NULL, 0),
(336, 'MORALES', '19473', 8, NULL, 0),
(337, 'PADILLA', '19513', 8, NULL, 0),
(338, 'PAT?A', '19532', 8, NULL, 0),
(339, 'PIAMONTE', '19533', 8, NULL, 0),
(340, 'PIENDAM?', '19548', 8, NULL, 0),
(341, 'PUERTO TEJADA', '19573', 8, NULL, 0),
(342, 'PURAC?', '19585', 8, NULL, 0),
(343, 'ROSAS', '19622', 8, NULL, 0),
(344, 'SANTA ROSA', '19701', 8, NULL, 0),
(345, 'SILVIA', '19743', 8, NULL, 0),
(346, 'SOTARA', '1976', 8, NULL, 0),
(347, 'SU?REZ', '1978', 8, NULL, 0),
(348, 'SUCRE', '19785', 8, NULL, 0),
(349, 'TIMB?O', '19807', 8, NULL, 0),
(350, 'TIMBIQU?', '19809', 8, NULL, 0),
(351, 'TORIBIO', '19821', 8, NULL, 0),
(352, 'TOTOR?', '19824', 8, NULL, 0),
(353, 'VILLA RICA', '19845', 8, NULL, 0),
(354, 'VALLEDUPAR', '20001', 9, NULL, 0),
(355, 'AGUACHICA', '20011', 9, NULL, 0),
(356, 'AGUSTÍN CODAZZI', '20013', 9, NULL, 0),
(357, 'ASTREA', '20032', 9, NULL, 0),
(358, 'BECERRIL', '20045', 9, NULL, 0),
(359, 'BOSCONIA', '2006', 9, NULL, 0),
(360, 'CHIMICHAGUA', '20175', 9, NULL, 0),
(361, 'CHIRIGUANÁ', '20178', 9, NULL, 0),
(362, 'CURUMANÍ', '20228', 9, NULL, 0),
(363, 'EL COPEY', '20238', 9, NULL, 0),
(364, 'EL PASO', '2025', 9, NULL, 0),
(365, 'GAMARRA', '20295', 9, NULL, 0),
(366, 'GONZÁLEZ', '2031', 9, NULL, 0),
(367, 'LA GLORIA', '20383', 9, NULL, 0),
(368, 'MANAURE', '20443', 9, NULL, 0),
(369, 'PAILITAS', '20517', 9, NULL, 0),
(370, 'PELAYA', '2055', 9, NULL, 0),
(371, 'PUEBLO BELLO', '2057', 9, NULL, 0),
(372, 'LA PAZ', '20621', 9, NULL, 0),
(373, 'SAN ALBERTO', '2071', 9, NULL, 0),
(374, 'SAN DIEGO', '2075', 9, NULL, 0),
(375, 'SAN MARTÍN', '2077', 9, NULL, 0),
(376, 'TAMALAMEQUE', '20787', 9, NULL, 0),
(377, 'MONTER?A', '23001', 10, NULL, 0),
(378, 'AYAPEL', '23068', 10, NULL, 0),
(379, 'BUENAVISTA', '23079', 10, NULL, 0),
(380, 'CANALETE', '2309', 10, NULL, 0),
(381, 'CERETÉ', '23162', 10, NULL, 0),
(382, 'CHIM?', '23168', 10, NULL, 0),
(383, 'CHIN?', '23182', 10, NULL, 0),
(384, 'COTORRA', '233', 10, NULL, 0),
(385, 'LORICA', '23417', 10, NULL, 0),
(386, 'LOS CÓRDOBAS', '23419', 10, NULL, 0),
(387, 'MOMIL', '23464', 10, NULL, 0),
(388, 'MO?ITOS', '235', 10, NULL, 0),
(389, 'PLANETA RICA', '23555', 10, NULL, 0),
(390, 'PUEBLO NUEVO', '2357', 10, NULL, 0),
(391, 'PUERTO ESCONDIDO', '23574', 10, NULL, 0),
(392, 'PURÍSIMA', '23586', 10, NULL, 0),
(393, 'SAHAGÚN', '2366', 10, NULL, 0),
(394, 'SAN ANDRÉS SOTAVENTO', '2367', 10, NULL, 0),
(395, 'SAN ANTERO', '23672', 10, NULL, 0),
(396, 'SAN PELAYO', '23686', 10, NULL, 0),
(397, 'TIERRALTA', '23807', 10, NULL, 0),
(398, 'TUCH?N', '23815', 10, NULL, 0),
(399, 'VALENCIA', '23855', 10, NULL, 0),
(400, 'ANAPOIMA', '25035', 11, NULL, 0),
(401, 'ARBELÁEZ', '25053', 11, NULL, 0),
(402, 'BELTRÁN', '25086', 11, NULL, 0),
(403, 'BITUIMA', '25095', 11, NULL, 0),
(404, 'BOJACÁ', '25099', 11, NULL, 0),
(405, 'CABRERA', '2512', 11, NULL, 0),
(406, 'CACHIPAY', '25123', 11, NULL, 0),
(407, 'CAJIC?', '25126', 11, NULL, 0),
(408, 'CAPARRAPÍ', '25148', 11, NULL, 0),
(409, 'CAQUEZA', '25151', 11, NULL, 0),
(410, 'CHAGUAN?', '25168', 11, NULL, 0),
(411, 'CHIPAQUE', '25178', 11, NULL, 0),
(412, 'CHOACH?', '25181', 11, NULL, 0),
(413, 'CHOCONTÁ', '25183', 11, NULL, 0),
(414, 'COGUA', '252', 11, NULL, 0),
(415, 'COTA', '25214', 11, NULL, 0),
(416, 'CUCUNUB?', '25224', 11, NULL, 0),
(417, 'EL COLEGIO', '25245', 11, NULL, 0),
(418, 'EL ROSAL', '2526', 11, NULL, 0),
(419, 'FOMEQUE', '25279', 11, NULL, 0),
(420, 'FOSCA', '25281', 11, NULL, 0),
(421, 'FUNZA', '25286', 11, NULL, 0),
(422, 'F?QUENE', '25288', 11, NULL, 0),
(423, 'GACHALA', '25293', 11, NULL, 0),
(424, 'GACHANCIPÁ', '25295', 11, NULL, 0),
(425, 'GACHETÁ', '25297', 11, NULL, 0),
(426, 'GIRARDOT', '25307', 11, NULL, 0),
(427, 'GRANADA', '25312', 11, NULL, 0),
(428, 'GUACHET?', '25317', 11, NULL, 0),
(429, 'GUADUAS', '2532', 11, NULL, 0),
(430, 'GUASCA', '25322', 11, NULL, 0),
(431, 'GUATAQU?', '25324', 11, NULL, 0),
(432, 'GUATAVITA', '25326', 11, NULL, 0),
(433, 'GUAYABETAL', '25335', 11, NULL, 0),
(434, 'GUTI?RREZ', '25339', 11, NULL, 0),
(435, 'JERUSAL?N', '25368', 11, NULL, 0),
(436, 'JUN?N', '25372', 11, NULL, 0),
(437, 'LA CALERA', '25377', 11, NULL, 0),
(438, 'LA MESA', '25386', 11, NULL, 0),
(439, 'LA PALMA', '25394', 11, NULL, 0),
(440, 'LA PE?A', '25398', 11, NULL, 0),
(441, 'LA VEGA', '25402', 11, NULL, 0),
(442, 'LENGUAZAQUE', '25407', 11, NULL, 0),
(443, 'MACHETA', '25426', 11, NULL, 0),
(444, 'MADRID', '2543', 11, NULL, 0),
(445, 'MANTA', '25436', 11, NULL, 0),
(446, 'MEDINA', '25438', 11, NULL, 0),
(447, 'MOSQUERA', '25473', 11, NULL, 0),
(448, 'NARI?O', '25483', 11, NULL, 0),
(449, 'NEMOC?N', '25486', 11, NULL, 0),
(450, 'NILO', '25488', 11, NULL, 0),
(451, 'NIMAIMA', '25489', 11, NULL, 0),
(452, 'NOCAIMA', '25491', 11, NULL, 0),
(453, 'VENECIA', '25506', 11, NULL, 0),
(454, 'PACHO', '25513', 11, NULL, 0),
(455, 'PAIME', '25518', 11, NULL, 0),
(456, 'PANDI', '25524', 11, NULL, 0),
(457, 'PARATEBUENO', '2553', 11, NULL, 0),
(458, 'PASCA', '25535', 11, NULL, 0),
(459, 'PUERTO SALGAR', '25572', 11, NULL, 0),
(460, 'PUL?', '2558', 11, NULL, 0),
(461, 'QUEBRADANEGRA', '25592', 11, NULL, 0),
(462, 'QUETAME', '25594', 11, NULL, 0),
(463, 'QUIPILE', '25596', 11, NULL, 0),
(464, 'APULO', '25599', 11, NULL, 0),
(465, 'RICAURTE', '25612', 11, NULL, 0),
(466, 'SAN BERNARDO', '25649', 11, NULL, 0),
(467, 'SAN CAYETANO', '25653', 11, NULL, 0),
(468, 'SAN FRANCISCO', '25658', 11, NULL, 0),
(469, 'SESQUIL?', '25736', 11, NULL, 0),
(470, 'SIBAT?', '2574', 11, NULL, 0),
(471, 'SILVANIA', '25743', 11, NULL, 0),
(472, 'SIMIJACA', '25745', 11, NULL, 0),
(473, 'SOACHA', '25754', 11, NULL, 0),
(474, 'SUBACHOQUE', '25769', 11, NULL, 0),
(475, 'SUESCA', '25772', 11, NULL, 0),
(476, 'SUPAT?', '25777', 11, NULL, 0),
(477, 'SUSA', '25779', 11, NULL, 0),
(478, 'SUTATAUSA', '25781', 11, NULL, 0),
(479, 'TABIO', '25785', 11, NULL, 0),
(480, 'TAUSA', '25793', 11, NULL, 0),
(481, 'TENA', '25797', 11, NULL, 0),
(482, 'TENJO', '25799', 11, NULL, 0),
(483, 'TIBACUY', '25805', 11, NULL, 0),
(484, 'TIBIRITA', '25807', 11, NULL, 0),
(485, 'TOCAIMA', '25815', 11, NULL, 0),
(486, 'TOCANCIP?', '25817', 11, NULL, 0),
(487, 'TOPAIP?', '25823', 11, NULL, 0),
(488, 'UBAL?', '25839', 11, NULL, 0),
(489, 'UBAQUE', '25841', 11, NULL, 0),
(490, 'UNE', '25845', 11, NULL, 0),
(491, 'ÚTICA', '25851', 11, NULL, 0),
(492, 'VIAN?', '25867', 11, NULL, 0),
(493, 'VILLAG?MEZ', '25871', 11, NULL, 0),
(494, 'VILLAPINZ?N', '25873', 11, NULL, 0),
(495, 'VILLETA', '25875', 11, NULL, 0),
(496, 'VIOT?', '25878', 11, NULL, 0),
(497, 'ZIPAC?N', '25898', 11, NULL, 0),
(498, 'QUIBDÓ', '27001', 12, NULL, 0),
(499, 'ACANDÍ', '27006', 12, NULL, 0),
(500, 'ALTO BAUDO', '27025', 12, NULL, 0),
(501, 'ATRATO', '2705', 12, NULL, 0),
(502, 'BAGADÓ', '27073', 12, NULL, 0),
(503, 'BAHÍA SOLANO', '27075', 12, NULL, 0),
(504, 'BAJO BAUDÓ', '27077', 12, NULL, 0),
(505, 'BOJAYA', '27099', 12, NULL, 0),
(506, 'CÉRTEGUI', '2716', 12, NULL, 0),
(507, 'CONDOTO', '27205', 12, NULL, 0),
(508, 'JURAD?', '27372', 12, NULL, 0),
(509, 'LLOR?', '27413', 12, NULL, 0),
(510, 'MEDIO ATRATO', '27425', 12, NULL, 0),
(511, 'MEDIO BAUD?', '2743', 12, NULL, 0),
(512, 'MEDIO SAN JUAN', '2745', 12, NULL, 0),
(513, 'N?VITA', '27491', 12, NULL, 0),
(514, 'NUQU?', '27495', 12, NULL, 0),
(515, 'R?O IRO', '2758', 12, NULL, 0),
(516, 'R?O QUITO', '276', 12, NULL, 0),
(517, 'RIOSUCIO', '27615', 12, NULL, 0),
(518, 'SIP?', '27745', 12, NULL, 0),
(519, 'UNGUÍA', '278', 12, NULL, 0),
(520, 'NEIVA', '41001', 13, NULL, 0),
(521, 'ACEVEDO', '41006', 13, NULL, 0),
(522, 'AGRADO', '41013', 13, NULL, 0),
(523, 'AIPE', '41016', 13, NULL, 0),
(524, 'ALGECIRAS', '4102', 13, NULL, 0),
(525, 'ALTAMIRA', '41026', 13, NULL, 0),
(526, 'BARAYA', '41078', 13, NULL, 0),
(527, 'CAMPOALEGRE', '41132', 13, NULL, 0),
(528, 'COLOMBIA', '41206', 13, NULL, 0),
(529, 'ELÍAS', '41244', 13, NULL, 0),
(530, 'GARZÓN', '41298', 13, NULL, 0),
(531, 'GIGANTE', '41306', 13, NULL, 0),
(532, 'GUADALUPE', '41319', 13, NULL, 0),
(533, 'HOBO', '41349', 13, NULL, 0),
(534, 'IQUIRA', '41357', 13, NULL, 0),
(535, 'ISNOS', '41359', 13, NULL, 0),
(536, 'LA ARGENTINA', '41378', 13, NULL, 0),
(537, 'LA PLATA', '41396', 13, NULL, 0),
(538, 'N?TAGA', '41483', 13, NULL, 0),
(539, 'OPORAPA', '41503', 13, NULL, 0),
(540, 'PAICOL', '41518', 13, NULL, 0),
(541, 'PALERMO', '41524', 13, NULL, 0),
(542, 'PALESTINA', '4153', 13, NULL, 0),
(543, 'PITAL', '41548', 13, NULL, 0),
(544, 'PITALITO', '41551', 13, NULL, 0),
(545, 'RIVERA', '41615', 13, NULL, 0),
(546, 'SALADOBLANCO', '4166', 13, NULL, 0),
(547, 'SANTA MAR?A', '41676', 13, NULL, 0),
(548, 'SUAZA', '4177', 13, NULL, 0),
(549, 'TARQUI', '41791', 13, NULL, 0),
(550, 'TESALIA', '41797', 13, NULL, 0),
(551, 'TELLO', '41799', 13, NULL, 0),
(552, 'TERUEL', '41801', 13, NULL, 0),
(553, 'TIMAN?', '41807', 13, NULL, 0),
(554, 'VILLAVIEJA', '41872', 13, NULL, 0),
(555, 'YAGUAR?', '41885', 13, NULL, 0),
(556, 'RIOHACHA', '44001', 14, NULL, 0),
(557, 'ALBANIA', '44035', 14, NULL, 0),
(558, 'BARRANCAS', '44078', 14, NULL, 0),
(559, 'DIBULA', '4409', 14, NULL, 0),
(560, 'DISTRACCI?N', '44098', 14, NULL, 0),
(561, 'EL MOLINO', '4411', 14, NULL, 0),
(562, 'FONSECA', '44279', 14, NULL, 0),
(563, 'HATONUEVO', '44378', 14, NULL, 0),
(564, 'MAICAO', '4443', 14, NULL, 0),
(565, 'MANAURE', '4456', 14, NULL, 0),
(566, 'URIBIA', '44847', 14, NULL, 0),
(567, 'URUMITA', '44855', 14, NULL, 0),
(568, 'VILLANUEVA', '44874', 14, NULL, 0),
(569, 'SANTA MARTA', '47001', 15, NULL, 0),
(570, 'ALGARROBO', '4703', 15, NULL, 0),
(571, 'ARACATACA', '47053', 15, NULL, 0),
(572, 'ARIGUANÍ', '47058', 15, NULL, 0),
(573, 'CERRO SAN ANTONIO', '47161', 15, NULL, 0),
(574, 'CHIVOLO', '4717', 15, NULL, 0),
(575, 'CONCORDIA', '47205', 15, NULL, 0),
(576, 'EL BANCO', '47245', 15, NULL, 0),
(577, 'EL PI?ON', '47258', 15, NULL, 0),
(578, 'EL RETÉN', '47268', 15, NULL, 0),
(579, 'FUNDACI?N', '47288', 15, NULL, 0),
(580, 'GUAMAL', '47318', 15, NULL, 0),
(581, 'NUEVA GRANADA', '4746', 15, NULL, 0),
(582, 'PEDRAZA', '47541', 15, NULL, 0),
(583, 'PIVIJAY', '47551', 15, NULL, 0),
(584, 'PLATO', '47555', 15, NULL, 0),
(585, 'REMOLINO', '47605', 15, NULL, 0),
(586, 'SALAMINA', '47675', 15, NULL, 0),
(587, 'SAN ZEN?N', '47703', 15, NULL, 0),
(588, 'SANTA ANA', '47707', 15, NULL, 0),
(589, 'SITIONUEVO', '47745', 15, NULL, 0),
(590, 'TENERIFE', '47798', 15, NULL, 0),
(591, 'ZAPAYÁN', '4796', 15, NULL, 0),
(592, 'ZONA BANANERA', '4798', 15, NULL, 0),
(593, 'VILLAVICENCIO', '50001', 16, NULL, 0),
(594, 'ACACIAS', '50006', 16, NULL, 0),
(595, 'CABUYARO', '50124', 16, NULL, 0),
(596, 'CUBARRAL', '50223', 16, NULL, 0),
(597, 'CUMARAL', '50226', 16, NULL, 0),
(598, 'EL CALVARIO', '50245', 16, NULL, 0),
(599, 'EL CASTILLO', '50251', 16, NULL, 0),
(600, 'EL DORADO', '5027', 16, NULL, 0),
(601, 'GRANADA', '50313', 16, NULL, 0),
(602, 'GUAMAL', '50318', 16, NULL, 0),
(603, 'MAPIRIP?N', '50325', 16, NULL, 0),
(604, 'MESETAS', '5033', 16, NULL, 0),
(605, 'LA MACARENA', '5035', 16, NULL, 0),
(606, 'LEJAN?AS', '504', 16, NULL, 0),
(607, 'PUERTO CONCORDIA', '5045', 16, NULL, 0),
(608, 'PUERTO GAITÁN', '50568', 16, NULL, 0),
(609, 'PUERTO LÓPEZ', '50573', 16, NULL, 0),
(610, 'PUERTO LLERAS', '50577', 16, NULL, 0),
(611, 'PUERTO RICO', '5059', 16, NULL, 0),
(612, 'RESTREPO', '50606', 16, NULL, 0),
(613, 'SAN JUANITO', '50686', 16, NULL, 0),
(614, 'SAN MARTÍN', '50689', 16, NULL, 0),
(615, 'VISTA HERMOSA', '50711', 16, NULL, 0),
(616, 'PASTO', '52001', 17, NULL, 0),
(617, 'ALBÁN', '52019', 17, NULL, 0),
(618, 'ALDANA', '52022', 17, NULL, 0),
(619, 'ANCUYÁ', '52036', 17, NULL, 0),
(620, 'BARBACOAS', '52079', 17, NULL, 0),
(621, 'COLÓN', '52203', 17, NULL, 0),
(622, 'CONSACA', '52207', 17, NULL, 0),
(623, 'CONTADERO', '5221', 17, NULL, 0),
(624, 'CÓRDOBA', '52215', 17, NULL, 0),
(625, 'CUASPUD', '52224', 17, NULL, 0),
(626, 'CUMBAL', '52227', 17, NULL, 0),
(627, 'CUMBITARA', '52233', 17, NULL, 0),
(628, 'EL CHARCO', '5225', 17, NULL, 0),
(629, 'EL PE?OL', '52254', 17, NULL, 0),
(630, 'EL ROSARIO', '52256', 17, NULL, 0),
(631, 'EL TAMBO', '5226', 17, NULL, 0),
(632, 'FUNES', '52287', 17, NULL, 0),
(633, 'GUACHUCAL', '52317', 17, NULL, 0),
(634, 'GUAITARILLA', '5232', 17, NULL, 0),
(635, 'GUALMAT?N', '52323', 17, NULL, 0),
(636, 'ILES', '52352', 17, NULL, 0),
(637, 'IMU?S', '52354', 17, NULL, 0),
(638, 'IPIALES', '52356', 17, NULL, 0),
(639, 'LA CRUZ', '52378', 17, NULL, 0),
(640, 'LA FLORIDA', '52381', 17, NULL, 0),
(641, 'LA LLANADA', '52385', 17, NULL, 0),
(642, 'LA TOLA', '5239', 17, NULL, 0),
(643, 'LA UNIÓN', '52399', 17, NULL, 0),
(644, 'LEIVA', '52405', 17, NULL, 0),
(645, 'LINARES', '52411', 17, NULL, 0),
(646, 'LOS ANDES', '52418', 17, NULL, 0),
(647, 'MAG??', '52427', 17, NULL, 0),
(648, 'MALLAMA', '52435', 17, NULL, 0),
(649, 'MOSQUERA', '52473', 17, NULL, 0),
(650, 'NARI?O', '5248', 17, NULL, 0),
(651, 'OLAYA HERRERA', '5249', 17, NULL, 0),
(652, 'OSPINA', '52506', 17, NULL, 0),
(653, 'FRANCISCO PIZARRO', '5252', 17, NULL, 0),
(654, 'POLICARPA', '5254', 17, NULL, 0),
(655, 'POTOSÍ', '5256', 17, NULL, 0),
(656, 'PROVIDENCIA', '52565', 17, NULL, 0),
(657, 'PUERRES', '52573', 17, NULL, 0),
(658, 'PUPIALES', '52585', 17, NULL, 0),
(659, 'RICAURTE', '52612', 17, NULL, 0),
(660, 'ROBERTO PAY?N', '52621', 17, NULL, 0),
(661, 'SAMANIEGO', '52678', 17, NULL, 0),
(662, 'SANDON?', '52683', 17, NULL, 0),
(663, 'SAN BERNARDO', '52685', 17, NULL, 0),
(664, 'SAN LORENZO', '52687', 17, NULL, 0),
(665, 'SAN PABLO', '52693', 17, NULL, 0),
(666, 'SANTA B?RBARA', '52696', 17, NULL, 0),
(667, 'SAPUYES', '5272', 17, NULL, 0),
(668, 'TAMINANGO', '52786', 17, NULL, 0),
(669, 'TANGUA', '52788', 17, NULL, 0),
(670, 'T?QUERRES', '52838', 17, NULL, 0),
(671, 'YACUANQUER', '52885', 17, NULL, 0),
(672, 'ARMENIA', '63001', 19, NULL, 0),
(673, 'BUENAVISTA', '63111', 19, NULL, 0),
(674, 'CIRCASIA', '6319', 19, NULL, 0),
(675, 'CÓRDOBA', '63212', 19, NULL, 0),
(676, 'FILANDIA', '63272', 19, NULL, 0),
(677, 'LA TEBAIDA', '63401', 19, NULL, 0),
(678, 'MONTENEGRO', '6347', 19, NULL, 0),
(679, 'PIJAO', '63548', 19, NULL, 0),
(680, 'QUIMBAYA', '63594', 19, NULL, 0),
(681, 'SALENTO', '6369', 19, NULL, 0),
(682, 'PEREIRA', '66001', 20, NULL, 0),
(683, 'APÍA', '66045', 20, NULL, 0),
(684, 'BALBOA', '66075', 20, NULL, 0),
(685, 'DOSQUEBRADAS', '6617', 20, NULL, 0),
(686, 'GU?TICA', '66318', 20, NULL, 0),
(687, 'LA CELIA', '66383', 20, NULL, 0),
(688, 'LA VIRGINIA', '664', 20, NULL, 0),
(689, 'MARSELLA', '6644', 20, NULL, 0),
(690, 'MISTRAT?', '66456', 20, NULL, 0),
(691, 'PUEBLO RICO', '66572', 20, NULL, 0),
(692, 'QUINCH?A', '66594', 20, NULL, 0),
(693, 'SANTUARIO', '66687', 20, NULL, 0),
(694, 'BUCARAMANGA', '68001', 21, NULL, 0),
(695, 'AGUADA', '68013', 21, NULL, 0),
(696, 'ALBANIA', '6802', 21, NULL, 0),
(697, 'ARATOCA', '68051', 21, NULL, 0),
(698, 'BARBOSA', '68077', 21, NULL, 0),
(699, 'BARICHARA', '68079', 21, NULL, 0),
(700, 'BARRANCABERMEJA', '68081', 21, NULL, 0),
(701, 'BETULIA', '68092', 21, NULL, 0),
(702, 'BOLÍVAR', '68101', 21, NULL, 0),
(703, 'CABRERA', '68121', 21, NULL, 0),
(704, 'CALIFORNIA', '68132', 21, NULL, 0),
(705, 'CARCASÍ', '68152', 21, NULL, 0),
(706, 'CEPIT?', '6816', 21, NULL, 0),
(707, 'CERRITO', '68162', 21, NULL, 0),
(708, 'CHARAL?', '68167', 21, NULL, 0),
(709, 'CHARTA', '68169', 21, NULL, 0),
(710, 'CHIPATÁ', '68179', 21, NULL, 0),
(711, 'CIMITARRA', '6819', 21, NULL, 0),
(712, 'CONCEPCIÓN', '68207', 21, NULL, 0),
(713, 'CONFINES', '68209', 21, NULL, 0),
(714, 'CONTRATACIÓN', '68211', 21, NULL, 0),
(715, 'COROMORO', '68217', 21, NULL, 0),
(716, 'CURIT?', '68229', 21, NULL, 0),
(717, 'EL GUACAMAYO', '68245', 21, NULL, 0),
(718, 'EL PLAYÓN', '68255', 21, NULL, 0),
(719, 'ENCINO', '68264', 21, NULL, 0),
(720, 'ENCISO', '68266', 21, NULL, 0),
(721, 'FLORI?N', '68271', 21, NULL, 0),
(722, 'FLORIDABLANCA', '68276', 21, NULL, 0),
(723, 'GALÁN', '68296', 21, NULL, 0),
(724, 'GAMBITA', '68298', 21, NULL, 0),
(725, 'GIRÓN', '68307', 21, NULL, 0),
(726, 'GUACA', '68318', 21, NULL, 0),
(727, 'GUADALUPE', '6832', 21, NULL, 0),
(728, 'GUAPOT?', '68322', 21, NULL, 0),
(729, 'GUAVAT?', '68324', 21, NULL, 0),
(730, 'G?EPSA', '68327', 21, NULL, 0),
(731, 'JES?S MAR?A', '68368', 21, NULL, 0),
(732, 'JORD?N', '6837', 21, NULL, 0),
(733, 'LA BELLEZA', '68377', 21, NULL, 0),
(734, 'LANDÁZURI', '68385', 21, NULL, 0),
(735, 'LA PAZ', '68397', 21, NULL, 0),
(736, 'LEBR?JA', '68406', 21, NULL, 0),
(737, 'LOS SANTOS', '68418', 21, NULL, 0),
(738, 'MACARAVITA', '68425', 21, NULL, 0),
(739, 'M?LAGA', '68432', 21, NULL, 0),
(740, 'MATANZA', '68444', 21, NULL, 0),
(741, 'MOGOTES', '68464', 21, NULL, 0),
(742, 'MOLAGAVITA', '68468', 21, NULL, 0),
(743, 'OCAMONTE', '68498', 21, NULL, 0),
(744, 'OIBA', '685', 21, NULL, 0),
(745, 'ONZAGA', '68502', 21, NULL, 0),
(746, 'PALMAR', '68522', 21, NULL, 0),
(747, 'PÁRAMO', '68533', 21, NULL, 0),
(748, 'PIEDECUESTA', '68547', 21, NULL, 0),
(749, 'PINCHOTE', '68549', 21, NULL, 0),
(750, 'PUENTE NACIONAL', '68572', 21, NULL, 0),
(751, 'RIONEGRO', '68615', 21, NULL, 0),
(752, 'SAN ANDRÉS', '68669', 21, NULL, 0),
(753, 'SAN GIL', '68679', 21, NULL, 0),
(754, 'SAN JOAQUÍN', '68682', 21, NULL, 0),
(755, 'SAN MIGUEL', '68686', 21, NULL, 0),
(756, 'SANTA B?RBARA', '68705', 21, NULL, 0),
(757, 'SIMACOTA', '68745', 21, NULL, 0),
(758, 'SOCORRO', '68755', 21, NULL, 0),
(759, 'SUAITA', '6877', 21, NULL, 0),
(760, 'SUCRE', '68773', 21, NULL, 0),
(761, 'SURAT?', '6878', 21, NULL, 0),
(762, 'TONA', '6882', 21, NULL, 0),
(763, 'VÉLEZ', '68861', 21, NULL, 0),
(764, 'VETAS', '68867', 21, NULL, 0),
(765, 'VILLANUEVA', '68872', 21, NULL, 0),
(766, 'ZAPATOCA', '68895', 21, NULL, 0),
(767, 'SINCELEJO', '70001', 22, NULL, 0),
(768, 'BUENAVISTA', '7011', 22, NULL, 0),
(769, 'CAIMITO', '70124', 22, NULL, 0),
(770, 'COLOSO', '70204', 22, NULL, 0),
(771, 'COVE?AS', '70221', 22, NULL, 0),
(772, 'CHAL?N', '7023', 22, NULL, 0),
(773, 'EL ROBLE', '70233', 22, NULL, 0),
(774, 'GALERAS', '70235', 22, NULL, 0),
(775, 'GUARANDA', '70265', 22, NULL, 0),
(776, 'LA UNIÓN', '704', 22, NULL, 0),
(777, 'LOS PALMITOS', '70418', 22, NULL, 0),
(778, 'MAJAGUAL', '70429', 22, NULL, 0),
(779, 'MORROA', '70473', 22, NULL, 0),
(780, 'OVEJAS', '70508', 22, NULL, 0),
(781, 'PALMITO', '70523', 22, NULL, 0),
(782, 'SAN BENITO ABAD', '70678', 22, NULL, 0),
(783, 'SAN MARCOS', '70708', 22, NULL, 0),
(784, 'SAN ONOFRE', '70713', 22, NULL, 0),
(785, 'SAN PEDRO', '70717', 22, NULL, 0),
(786, 'SUCRE', '70771', 22, NULL, 0),
(787, 'TOL? VIEJO', '70823', 22, NULL, 0),
(788, 'ALPUJARRA', '73024', 23, NULL, 0),
(789, 'ALVARADO', '73026', 23, NULL, 0),
(790, 'AMBALEMA', '7303', 23, NULL, 0),
(791, 'ARMERO', '73055', 23, NULL, 0),
(792, 'ATACO', '73067', 23, NULL, 0),
(793, 'CAJAMARCA', '73124', 23, NULL, 0),
(794, 'CHAPARRAL', '73168', 23, NULL, 0),
(795, 'COELLO', '732', 23, NULL, 0),
(796, 'COYAIMA', '73217', 23, NULL, 0),
(797, 'CUNDAY', '73226', 23, NULL, 0),
(798, 'DOLORES', '73236', 23, NULL, 0),
(799, 'ESPINAL', '73268', 23, NULL, 0),
(800, 'FALAN', '7327', 23, NULL, 0),
(801, 'FLANDES', '73275', 23, NULL, 0),
(802, 'FRESNO', '73283', 23, NULL, 0),
(803, 'GUAMO', '73319', 23, NULL, 0),
(804, 'HERVEO', '73347', 23, NULL, 0),
(805, 'HONDA', '73349', 23, NULL, 0),
(806, 'ICONONZO', '73352', 23, NULL, 0),
(807, 'MARIQUITA', '73443', 23, NULL, 0),
(808, 'MELGAR', '73449', 23, NULL, 0),
(809, 'MURILLO', '73461', 23, NULL, 0),
(810, 'NATAGAIMA', '73483', 23, NULL, 0),
(811, 'ORTEGA', '73504', 23, NULL, 0),
(812, 'PALOCABILDO', '7352', 23, NULL, 0),
(813, 'PIEDRAS', '73547', 23, NULL, 0),
(814, 'PLANADAS', '73555', 23, NULL, 0),
(815, 'PRADO', '73563', 23, NULL, 0),
(816, 'PURIFICACIÓN', '73585', 23, NULL, 0),
(817, 'RIO BLANCO', '73616', 23, NULL, 0),
(818, 'RONCESVALLES', '73622', 23, NULL, 0),
(819, 'ROVIRA', '73624', 23, NULL, 0),
(820, 'SALDAÑA', '73671', 23, NULL, 0),
(821, 'SANTA ISABEL', '73686', 23, NULL, 0),
(822, 'VENADILLO', '73861', 23, NULL, 0),
(823, 'VILLAHERMOSA', '7387', 23, NULL, 0),
(824, 'VILLARRICA', '73873', 23, NULL, 0),
(825, 'ARAUQUITA', '81065', 25, NULL, 0),
(826, 'CRAVO NORTE', '8122', 25, NULL, 0),
(827, 'FORTUL', '813', 25, NULL, 0),
(828, 'PUERTO ROND?N', '81591', 25, NULL, 0),
(829, 'SARAVENA', '81736', 25, NULL, 0),
(830, 'TAME', '81794', 25, NULL, 0),
(831, 'ARAUCA', '81001', 25, NULL, 0),
(832, 'YOPAL', '85001', 26, NULL, 0),
(833, 'AGUAZUL', '8501', 26, NULL, 0),
(834, 'CH?MEZA', '85015', 26, NULL, 0),
(835, 'HATO COROZAL', '85125', 26, NULL, 0),
(836, 'LA SALINA', '85136', 26, NULL, 0),
(837, 'MONTERREY', '85162', 26, NULL, 0),
(838, 'PORE', '85263', 26, NULL, 0),
(839, 'RECETOR', '85279', 26, NULL, 0),
(840, 'SABANALARGA', '853', 26, NULL, 0),
(841, 'S?CAMA', '85315', 26, NULL, 0),
(842, 'TAURAMENA', '8541', 26, NULL, 0),
(843, 'TRINIDAD', '8543', 26, NULL, 0),
(844, 'VILLANUEVA', '8544', 26, NULL, 0),
(845, 'MOCOA', '86001', 27, NULL, 0),
(846, 'COLÓN', '86219', 27, NULL, 0),
(847, 'ORITO', '8632', 27, NULL, 0),
(848, 'PUERTO CAICEDO', '86569', 27, NULL, 0),
(849, 'PUERTO GUZMÁN', '86571', 27, NULL, 0),
(850, 'LEGUÍZAMO', '86573', 27, NULL, 0),
(851, 'SIBUNDOY', '86749', 27, NULL, 0),
(852, 'SAN FRANCISCO', '86755', 27, NULL, 0),
(853, 'SAN MIGUEL', '86757', 27, NULL, 0),
(854, 'SANTIAGO', '8676', 27, NULL, 0),
(855, 'LETICIA', '91001', 29, NULL, 0),
(856, 'EL ENCANTO', '91263', 29, NULL, 0),
(857, 'LA CHORRERA', '91405', 29, NULL, 0),
(858, 'LA PEDRERA', '91407', 29, NULL, 0),
(859, 'LA VICTORIA', '9143', 29, NULL, 0),
(860, 'PUERTO ARICA', '91536', 29, NULL, 0),
(861, 'PUERTO NARI?O', '9154', 29, NULL, 0),
(862, 'PUERTO SANTANDER', '91669', 29, NULL, 0),
(863, 'TARAPAC?', '91798', 29, NULL, 0),
(864, 'IN?RIDA', '94001', 30, NULL, 0),
(865, 'BARRANCO MINAS', '94343', 30, NULL, 0),
(866, 'MAPIRIPANA', '94663', 30, NULL, 0),
(867, 'SAN FELIPE', '94883', 30, NULL, 0),
(868, 'PUERTO COLOMBIA', '94884', 30, NULL, 0),
(869, 'LA GUADALUPE', '94885', 30, NULL, 0),
(870, 'CACAHUAL', '94886', 30, NULL, 0),
(871, 'PANA PANA', '94887', 30, NULL, 0),
(872, 'MIT?', '97001', 32, NULL, 0),
(873, 'CARUR?', '97161', 32, NULL, 0),
(874, 'TARAIRA', '97666', 32, NULL, 0),
(875, 'PAPUNAHUA', '97777', 32, NULL, 0),
(876, 'YAVARAT?', '97889', 32, NULL, 0),
(877, 'PACOA', '97511', 32, NULL, 0),
(878, 'MORICHAL', '94888', 30, NULL, 0),
(879, 'PUERTO CARREÑO', '99001', 33, NULL, 0),
(880, 'LA PRIMAVERA', '99524', 33, NULL, 0),
(881, 'SANTA ROSAL?A', '99624', 33, NULL, 0),
(882, 'CUMARIBO', '99773', 33, NULL, 0),
(883, 'SAN JOS? DEL FRAGUA', '1861', 7, NULL, 0),
(884, 'BARRANCA DE UPÍA', '5011', 16, NULL, 0),
(885, 'PALMAS DEL SOCORRO', '68524', 21, NULL, 0),
(886, 'SAN JUAN DE R?O SECO', '25662', 11, NULL, 0),
(887, 'JUAN DE ACOSTA', '8372', 2, NULL, 0),
(888, 'FUENTE DE ORO', '50287', 16, NULL, 0),
(889, 'SAN LUIS DE GACENO', '85325', 26, NULL, 0),
(890, 'EL LITORAL DEL SAN JUAN', '2725', 12, NULL, 0),
(891, 'VILLA DE SAN DIEGO DE UBATE', '25843', 11, NULL, 0),
(892, 'BARRANCO DE LOBA', '13074', 4, NULL, 0),
(893, 'TOG??', '15816', 5, NULL, 0),
(894, 'SANTA ROSA DEL SUR', '13688', 4, NULL, 0),
(895, 'EL CANTÓN DEL SAN PABLO', '27135', 12, NULL, 0),
(896, 'VILLA DE LEYVA', '15407', 5, NULL, 0),
(897, 'SAN SEBASTI?N DE BUENAVISTA', '47692', 15, NULL, 0),
(898, 'PAZ DE RíO', '15537', 5, NULL, 0),
(899, 'HATILLO DE LOBA', '133', 4, NULL, 0),
(900, 'SABANAS DE SAN ANGEL', '4766', 15, NULL, 0),
(901, 'CALAMAR', '95015', 31, NULL, 0),
(902, 'R?O DE ORO', '20614', 9, NULL, 0),
(903, 'SAN PEDRO DE URABA', '5665', 1, NULL, 0),
(904, 'SAN JOS? DEL GUAVIARE', '95001', 31, NULL, 0),
(905, 'SANTA ROSA DE VITERBO', '15693', 5, NULL, 0),
(906, 'SANTANDER DE QUILICHAO', '19698', 8, NULL, 0),
(907, 'MIRAFLORES', '952', 31, NULL, 0),
(908, 'SANTAF? DE ANTIOQUIA', '5042', 1, NULL, 0),
(909, 'SAN CARLOS DE GUAROA', '5068', 16, NULL, 0),
(910, 'PALMAR DE VARELA', '852', 2, NULL, 0),
(911, 'SANTA ROSA DE OSOS', '5686', 1, NULL, 0),
(912, 'SAN ANDR?S DE CUERQU?A', '5647', 1, NULL, 0),
(913, 'VALLE DE SAN JUAN', '73854', 23, NULL, 0),
(914, 'SAN VICENTE DE CHUCUR?', '68689', 21, NULL, 0),
(915, 'SAN JOSÉ DE MIRANDA', '68684', 21, NULL, 0),
(916, 'PROVIDENCIA', '88564', 28, NULL, 0),
(917, 'SANTA ROSA DE CABAL', '66682', 20, NULL, 0),
(918, 'GUAYABAL DE SIQUIMA', '25328', 11, NULL, 0),
(919, 'BELÉN DE LOS ANDAQUIES', '18094', 7, NULL, 0),
(920, 'PAZ DE ARIPORO', '8525', 26, NULL, 0),
(921, 'SANTA HELENA DEL OP?N', '6872', 21, NULL, 0),
(922, 'SAN PABLO DE BORBUR', '15681', 5, NULL, 0),
(923, 'LA JAGUA DEL PILAR', '4442', 14, NULL, 0),
(924, 'LA JAGUA DE IBIRICO', '204', 9, NULL, 0),
(925, 'SAN LUIS DE SINC?', '70742', 22, NULL, 0),
(926, 'SAN LUIS DE GACENO', '15667', 5, NULL, 0),
(927, 'EL CARMEN DE BOL?VAR', '13244', 4, NULL, 0),
(928, 'EL CARMEN DE ATRATO', '27245', 12, NULL, 0),
(929, 'SAN JUAN DE BETULIA', '70702', 22, NULL, 0),
(930, 'PIJIÑO DEL CARMEN', '47545', 15, NULL, 0),
(931, 'VIG?A DEL FUERTE', '5873', 1, NULL, 0),
(932, 'SAN MARTÍN DE LOBA', '13667', 4, NULL, 0),
(933, 'ALTOS DEL ROSARIO', '1303', 4, NULL, 0),
(934, 'CARMEN DE APICALA', '73148', 23, NULL, 0),
(935, 'SAN ANTONIO DEL TEQUENDAMA', '25645', 11, NULL, 0),
(936, 'SABANA DE TORRES', '68655', 21, NULL, 0),
(937, 'EL RETORNO', '95025', 31, NULL, 0),
(938, 'SAN JOSÉ DE UR?', '23682', 10, NULL, 0),
(939, 'SAN PEDRO DE CARTAGO', '52694', 17, NULL, 0),
(940, 'CAMPO DE LA CRUZ', '8137', 2, NULL, 0),
(941, 'SAN JUAN DE ARAMA', '50683', 16, NULL, 0),
(942, 'SAN JOSÉ DE LA MONTAÑA', '5658', 1, NULL, 0),
(943, 'CARTAGENA DEL CHAIRÁ', '1815', 7, NULL, 0),
(944, 'SAN JOS? DEL PALMAR', '2766', 12, NULL, 0),
(945, 'AGUA DE DIOS', '25001', 11, NULL, 0),
(946, 'SAN JACINTO DEL CAUCA', '13655', 4, NULL, 0),
(947, 'SAN AGUSTÍN', '41668', 13, NULL, 0),
(948, 'EL TABL?N DE G?MEZ', '52258', 17, NULL, 0),
(949, 'SAN ANDRÉS', '88001', 28, NULL, 0),
(950, 'SAN JOSÉ DE PARE', '15664', 5, NULL, 0),
(951, 'VALLE DE GUAMEZ', '86865', 27, NULL, 0),
(952, 'SAN PABLO DE BORBUR', '1367', 4, NULL, 0),
(953, 'SANTIAGO DE TOL?', '7082', 22, NULL, 0),
(954, 'BOGOTÁ D.C.', '11001', 3, NULL, 0),
(955, 'CARMEN DE CARUPA', '25154', 11, NULL, 0),
(956, 'CIÉNAGA DE ORO', '23189', 10, NULL, 0),
(957, 'SAN JUAN DE URAB?', '5659', 1, NULL, 0),
(958, 'SAN JUAN DEL CESAR', '4465', 14, NULL, 0),
(959, 'EL CARMEN DE CHUCURÍ', '68235', 21, NULL, 0),
(960, 'EL CARMEN DE VIBORAL', '5148', 1, NULL, 0),
(961, 'BELÉN DE UMBRÍA', '66088', 20, NULL, 0),
(962, 'BELÉN DE BAJIRA', '27086', 12, NULL, 0),
(963, 'VALLE DE SAN JOSÉ', '68855', 21, NULL, 0),
(964, 'SAN LUIS', '73678', 23, NULL, 0),
(965, 'SAN MIGUEL DE SEMA', '15676', 5, NULL, 0),
(966, 'SAN ANTONIO', '73675', 23, NULL, 0),
(967, 'SAN BENITO', '68673', 21, NULL, 0),
(968, 'VERGARA', '25862', 11, NULL, 0),
(969, 'SAN CARLOS', '23678', 10, NULL, 0),
(970, 'PUERTO ALEGR?A', '9153', 29, NULL, 0),
(971, 'HATO', '68344', 21, NULL, 0),
(972, 'SAN JACINTO', '13654', 4, NULL, 0),
(973, 'SAN SEBASTI?N', '19693', 8, NULL, 0),
(974, 'SAN CARLOS', '5649', 1, NULL, 0),
(975, 'TUTA', '15837', 5, NULL, 0),
(976, 'SILOS', '54743', 18, NULL, 0),
(977, 'CÁCOTA', '54125', 18, NULL, 0),
(978, 'EL DOVIO', '7625', 24, NULL, 0),
(979, 'TOLEDO', '5482', 18, NULL, 0),
(980, 'ROLDANILLO', '76622', 24, NULL, 0),
(981, 'MUTISCUA', '5448', 18, NULL, 0),
(982, 'ARGELIA', '76054', 24, NULL, 0),
(983, 'EL ZULIA', '54261', 18, NULL, 0),
(984, 'SALAZAR', '5466', 18, NULL, 0),
(985, 'SEVILLA', '76736', 24, NULL, 0),
(986, 'ZARZAL', '76895', 24, NULL, 0),
(987, 'CUCUTILLA', '54223', 18, NULL, 0),
(988, 'EL CERRITO', '76248', 24, NULL, 0),
(989, 'CARTAGO', '76147', 24, NULL, 0),
(990, 'CAICEDONIA', '76122', 24, NULL, 0),
(991, 'PUERTO SANTANDER', '54553', 18, NULL, 0),
(992, 'GRAMALOTE', '54313', 18, NULL, 0),
(993, 'EL CAIRO', '76246', 24, NULL, 0),
(994, 'EL TARRA', '5425', 18, NULL, 0),
(995, 'LA UNIÓN', '764', 24, NULL, 0),
(996, 'RESTREPO', '76606', 24, NULL, 0),
(997, 'TEORAMA', '548', 18, NULL, 0),
(998, 'DAGUA', '76233', 24, NULL, 0),
(999, 'ARBOLEDAS', '54051', 18, NULL, 0),
(1000, 'GUACAR?', '76318', 24, NULL, 0),
(1001, 'LOURDES', '54418', 18, NULL, 0),
(1002, 'ANSERMANUEVO', '76041', 24, NULL, 0),
(1003, 'BOCHALEMA', '54099', 18, NULL, 0),
(1004, 'BUGALAGRANDE', '76113', 24, NULL, 0),
(1005, 'CONVENCIÓN', '54206', 18, NULL, 0),
(1006, 'HACAR?', '54344', 18, NULL, 0),
(1007, 'LA VICTORIA', '76403', 24, NULL, 0),
(1008, 'HERR?N', '54347', 18, NULL, 0),
(1009, 'GINEBRA', '76306', 24, NULL, 0),
(1010, 'YUMBO', '76892', 24, NULL, 0),
(1011, 'OBANDO', '76497', 24, NULL, 0),
(1012, 'TIB?', '5481', 18, NULL, 0),
(1013, 'SAN CAYETANO', '54673', 18, NULL, 0),
(1014, 'SAN CALIXTO', '5467', 18, NULL, 0),
(1015, 'BOLÍVAR', '761', 24, NULL, 0),
(1016, 'LA PLAYA', '54398', 18, NULL, 0),
(1017, 'CALI', '76001', 24, NULL, 0),
(1018, 'SAN PEDRO', '7667', 24, NULL, 0),
(1019, 'GUADALAJARA DE BUGA', '76111', 24, NULL, 0),
(1020, 'CHIN?COTA', '54172', 18, NULL, 0),
(1021, 'RAGONVALIA', '54599', 18, NULL, 0),
(1022, 'LA ESPERANZA', '54385', 18, NULL, 0),
(1023, 'VILLA DEL ROSARIO', '54874', 18, NULL, 0),
(1024, 'CHITAG?', '54174', 18, NULL, 0),
(1025, 'CALIMA', '76126', 24, NULL, 0),
(1026, 'SARDINATA', '5472', 18, NULL, 0),
(1027, 'ANDALUCÍA', '76036', 24, NULL, 0),
(1028, 'PRADERA', '76563', 24, NULL, 0),
(1029, 'ABREGO', '54003', 18, NULL, 0),
(1030, 'LOS PATIOS', '54405', 18, NULL, 0),
(1031, 'OCA?A', '54498', 18, NULL, 0),
(1032, 'BUCARASICA', '54109', 18, NULL, 0),
(1033, 'YOTOCO', '7689', 24, NULL, 0),
(1034, 'PALMIRA', '7652', 24, NULL, 0),
(1035, 'RIOFR?O', '76616', 24, NULL, 0),
(1036, 'SANTIAGO', '5468', 18, NULL, 0),
(1037, 'ALCALÁ', '7602', 24, NULL, 0),
(1038, 'VERSALLES', '76863', 24, NULL, 0),
(1039, 'LABATECA', '54377', 18, NULL, 0),
(1040, 'CACHIR?', '54128', 18, NULL, 0),
(1041, 'VILLA CARO', '54871', 18, NULL, 0),
(1042, 'DURANIA', '54239', 18, NULL, 0),
(1043, 'EL ?GUILA', '76243', 24, NULL, 0),
(1044, 'TORO', '76823', 24, NULL, 0),
(1045, 'CANDELARIA', '7613', 24, NULL, 0),
(1046, 'LA CUMBRE', '76377', 24, NULL, 0),
(1047, 'ULLOA', '76845', 24, NULL, 0),
(1048, 'TRUJILLO', '76828', 24, NULL, 0),
(1049, 'VIJES', '76869', 24, NULL, 0),
(1050, 'CHIM?', '68176', 21, NULL, 0),
(1051, 'SAMPUÉS', '7067', 22, NULL, 0),
(1052, 'NUNCH?A', '85225', 26, NULL, 0),
(1053, 'PAMPLONA', '54518', 18, NULL, 0),
(1054, 'ALBÁN', '25019', 11, NULL, 0),
(1055, 'MONTELÍBANO', '23466', 10, NULL, 0),
(1056, 'PUERTO ASÍS', '86568', 27, NULL, 0),
(1057, 'COROZAL', '70215', 22, NULL, 0),
(1058, 'BUESACO', '5211', 17, NULL, 0),
(1059, 'MAN?', '85139', 26, NULL, 0),
(1060, 'EL PEÑÓN', '13268', 4, NULL, 0),
(1061, 'TULU?', '76834', 24, NULL, 0),
(1062, 'CASABIANCA', '73152', 23, NULL, 0),
(1063, 'ANOLAIMA', '2504', 11, NULL, 0),
(1064, 'CHÍA', '25175', 11, NULL, 0),
(1065, 'SAN ANDRÉS DE TUMACO', '52835', 17, NULL, 0),
(1066, 'MIL?N', '1846', 7, NULL, 0),
(1067, 'CAPITANEJO', '68147', 21, NULL, 0),
(1068, 'ANZOÁTEGUI', '73043', 23, NULL, 0),
(1069, 'FLORIDA', '76275', 24, NULL, 0),
(1070, 'REPELÓN', '8606', 2, NULL, 0),
(1071, 'FRONTINO', '5284', 1, NULL, 0),
(1072, 'EL PEÑÓN', '25258', 11, NULL, 0),
(1073, 'PAMPLONITA', '5452', 18, NULL, 0),
(1074, 'MIRITI PARAN?', '9146', 29, NULL, 0),
(1075, 'T?MARA', '854', 26, NULL, 0),
(1076, 'TIBASOSA', '15806', 5, NULL, 0),
(1077, 'PÁEZ', '19517', 8, NULL, 0),
(1078, 'IBAGU?', '73001', 23, NULL, 0),
(1079, 'PUERTO COLOMBIA', '8573', 2, NULL, 0),
(1080, 'BELÉN', '52083', 17, NULL, 0),
(1081, 'SOP?', '25758', 11, NULL, 0),
(1082, 'CARMEN DEL DARIEN', '2715', 12, NULL, 0),
(1083, 'GAMA', '25299', 11, NULL, 0),
(1084, 'SASAIMA', '25718', 11, NULL, 0),
(1085, 'CHACHAG??', '5224', 17, NULL, 0),
(1086, 'CÚCUTA', '54001', 18, NULL, 0),
(1087, 'CARTAGENA', '13001', 4, NULL, 0),
(1088, 'GRANADA', '5313', 1, NULL, 0),
(1089, 'SANTA B?RBARA DE PINTO', '4772', 15, NULL, 0),
(1090, 'MARÍA LA BAJA', '13442', 4, NULL, 0),
(1091, 'LA MONTA?ITA', '1841', 7, NULL, 0),
(1092, 'SAN VICENTE DEL CAGU?N', '18753', 7, NULL, 0),
(1093, 'EL PEÑÓN', '6825', 21, NULL, 0),
(1094, 'JARD?N', '5364', 1, NULL, 0),
(1095, 'JAMUND?', '76364', 24, NULL, 0),
(1096, 'TAD?', '27787', 12, NULL, 0),
(1097, 'OROCU?', '8523', 26, NULL, 0),
(1098, 'LÍBANO', '73411', 23, NULL, 0),
(1099, 'YACOP?', '25885', 11, NULL, 0),
(1100, 'CALARC?', '6313', 19, NULL, 0),
(1101, 'SONS?N', '5756', 1, NULL, 0),
(1102, 'EL CARMEN', '54245', 18, NULL, 0),
(1103, 'L?RIDA', '73408', 23, NULL, 0),
(1104, 'LA APARTADA', '2335', 10, NULL, 0),
(1105, 'SAN CRIST?BAL', '1362', 4, NULL, 0),
(1106, 'FUSAGASUGÁ', '2529', 11, NULL, 0),
(1107, 'ZAMBRANO', '13894', 4, NULL, 0),
(1108, 'LA UVITA', '15403', 5, NULL, 0),
(1109, 'ZIPAQUIRÁ', '25899', 11, NULL, 0),
(1110, 'G?NOVA', '63302', 19, NULL, 0),
(1111, 'SU?REZ', '7377', 23, NULL, 0),
(1112, 'CASTILLA LA NUEVA', '5015', 16, NULL, 0),
(1113, 'BELÉN', '15087', 5, NULL, 0),
(1114, 'UNIÓN PANAMERICANA', '2781', 12, NULL, 0),
(1115, 'PUEBLO VIEJO', '4757', 15, NULL, 0),
(1116, 'VILLAGARZ?N', '86885', 27, NULL, 0),
(1117, 'FACATATIVÁ', '25269', 11, NULL, 0),
(1118, 'PUERTO LIBERTADOR', '2358', 10, NULL, 0),
(1119, 'MARQUETALIA', '17444', 6, NULL, 0),
(1120, 'ARBOLEDA', '52051', 17, NULL, 0),
(1121, 'BUENAVENTURA', '76109', 24, NULL, 0),
(1122, 'CIÉNAGA', '47189', 15, NULL, 0),
(1123, 'PONEDERA', '856', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poles`
--

CREATE TABLE `poles` (
  `id_pole` bigint(20) NOT NULL,
  `id_delivery_pole` bigint(20) NOT NULL,
  `code_pole` text NOT NULL,
  `id_material_pole` bigint(20) NOT NULL,
  `id_height_pole` bigint(20) NOT NULL,
  `detail_pole` text NOT NULL,
  `address_pole` text NOT NULL,
  `latitude_pole` float NOT NULL,
  `longitude_pole` float NOT NULL,
  `life_pole` mediumtext NOT NULL,
  `gallery_pole` text NOT NULL,
  `cost_pole` decimal(15,2) NOT NULL,
  `status_pole` varchar(8) NOT NULL,
  `date_created_pole` date DEFAULT NULL,
  `date_updated_pole` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `poles`
--

INSERT INTO `poles` (`id_pole`, `id_delivery_pole`, `code_pole`, `id_material_pole`, `id_height_pole`, `detail_pole`, `address_pole`, `latitude_pole`, `longitude_pole`, `life_pole`, `gallery_pole`, `cost_pole`, `status_pole`, `date_created_pole`, `date_updated_pole`) VALUES
(1, 1, 'POST-015', 1, 1, 'CILINDRICO PINTADO DE VERDE', 'CALLE 15 CON CARRERA 1-5', 10.2523, -74.1525, '                                                                                                                                <p>PRUEBA</p>                                                                                                                                ', '[\"POST-015_1241454385.jpg\",\"POST-015_1038811274.jpg\"]', 350000.00, 'Activo', '2024-10-16', '2024-10-17 05:00:00'),
(2, 1, 'pos-928', 1, 1, 'sdsdf', 'CASSSS', 1.23523, 74.2536, '<p>sdsdsd</p>', '[\"<br \\/>\\n<b>Fatal error<\\/b>:  Uncaught Error: Call to undefined function imagecreatefromjpeg() in C:\\\\xampp\\\\htdocs\\\\salp\\\\admin-salp\\\\views\\\\img\\\\index.php:37\\nStack trace:\\n#0 {main}\\n  thrown in <b>C:\\\\xampp\\\\htdocs\\\\salp\\\\admin-salp\\\\views\\\\img\\\\index.php<\\/b> on line <b>37<\\/b><br \\/>\\n\"]', 444.00, 'Activo', '2024-10-17', '2024-10-17 15:30:27');

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
(1, '30W', 'Activo', '2024-08-04', '2024-08-04 15:46:17'),
(2, '40W', 'Activo', '2024-10-05', '2024-10-06 00:30:59'),
(3, '100W', 'Activo', '2024-10-05', '2024-10-06 00:31:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqrs`
--

CREATE TABLE `pqrs` (
  `id_pqr` bigint(20) NOT NULL,
  `date_pqr` datetime DEFAULT NULL,
  `name_pqr` text NOT NULL,
  `email_pqr` text NOT NULL,
  `address_pqr` text NOT NULL,
  `message_pqr` text NOT NULL,
  `id_element_pqr` bigint(20) DEFAULT NULL,
  `dateasign_pqr` datetime DEFAULT NULL,
  `id_crew_pqr` bigint(20) DEFAULT NULL,
  `datesolved_pqr` datetime DEFAULT NULL,
  `solution_pqr` text DEFAULT NULL,
  `latitude_pqr` float NOT NULL,
  `longitude_pqr` float NOT NULL,
  `name_address_pqr` text NOT NULL,
  `status_pqr` varchar(8) NOT NULL,
  `date_created_pqr` date DEFAULT NULL,
  `date_updated_pqr` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pqrs`
--

INSERT INTO `pqrs` (`id_pqr`, `date_pqr`, `name_pqr`, `email_pqr`, `address_pqr`, `message_pqr`, `id_element_pqr`, `dateasign_pqr`, `id_crew_pqr`, `datesolved_pqr`, `solution_pqr`, `latitude_pqr`, `longitude_pqr`, `name_address_pqr`, `status_pqr`, `date_created_pqr`, `date_updated_pqr`) VALUES
(2, '2024-10-02 09:21:50', 'Pedro Perez', 'correokdl@correo.com', 'carrera 11 calle 17Santa Marta Colombia', 'ldldld', NULL, NULL, NULL, NULL, NULL, 11.2433, -74.2049, 'Cra. 11 & Cl. 17, Comuna 4, Santa Marta, Magdalena, Colombia', 'Pending', '2024-08-15', '2024-08-15 15:31:01'),
(3, '2024-10-02 09:22:06', 'Juan Guerra', 'elcorrl@kkf.com', 'calle 22 carrera 3, Santa Marta Colombia', 'se apago', NULL, '2024-10-05 00:00:00', 2, NULL, NULL, 11.2409, -74.2132, 'Cl. 22 & Cra. 3, Comuna 2, Santa Marta, Magdalena, Colombia', 'Assign', '2024-08-15', '2024-08-15 15:32:34'),
(4, '2024-10-07 14:22:12', 'Autopistas Y Carreteras 2', 'osvicor@hotmail.com', 'calle 23 carrera 4, Santa Marta Colombia', 'prueaba', NULL, '2024-08-16 00:00:00', 1, '2024-10-08 09:30:00', NULL, 11.2337, -74.1794, 'Cl. 23, Santa Marta, Magdalena, Colombia', 'Success', '2024-08-15', '2024-10-07 05:00:00'),
(6, '2024-10-04 11:22:21', 'Osvaldo Villalobos Cortina', 'osvicor1964@gmail.com', 'urb san lorenzo mz j cs 34, Santa Marta Colombia', 'se apago', NULL, NULL, NULL, NULL, NULL, 11.2097, -74.163, 'Cra. 66 #48-106, Santa Marta, Magdalena, Colombia', 'Pending', '2024-10-07', '2024-10-07 16:12:19'),
(7, '2024-10-03 10:07:19', 'Prueba Ut', 'osvicor1964@gmail.com', 'urb. san lorenzo mz j cs 34, MAGDALENA, SANTA MARTA', 'se daño', NULL, NULL, NULL, NULL, NULL, 11.2097, -74.163, 'Cra. 66 #48-106, Santa Marta, Magdalena, Colombia', 'Pending', '2024-10-11', '2024-10-11 19:32:55');

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
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id_setting` bigint(20) NOT NULL,
  `nit_setting` text NOT NULL,
  `fullname_setting` text NOT NULL,
  `id_department_setting` bigint(20) NOT NULL,
  `id_municipality_setting` bigint(20) NOT NULL,
  `address_setting` text NOT NULL,
  `email_setting` text NOT NULL,
  `phone_setting` text NOT NULL,
  `manager_setting` text NOT NULL,
  `signature_setting` text NOT NULL,
  `date_created_setting` date DEFAULT NULL,
  `date_updated_setting` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id_setting`, `nit_setting`, `fullname_setting`, `id_department_setting`, `id_municipality_setting`, `address_setting`, `email_setting`, `phone_setting`, `manager_setting`, `signature_setting`, `date_created_setting`, `date_updated_setting`) VALUES
(1, '901901901', 'EMPRESA DE PRUEBA', 15, 569, 'CARRERA 11 No. 6-45 centro', 'empresa2@correo.com', '325325325', 'Juan Carlos Pérez H', 'signature.png', '0000-00-00', '2024-10-06 15:17:10');

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
(1, 'LED', 'Activo', '2024-08-05', '2024-08-05 15:35:55'),
(2, 'SODIO', 'Activo', '2024-10-05', '2024-10-06 00:31:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformers`
--

CREATE TABLE `transformers` (
  `id_transformer` bigint(20) NOT NULL,
  `id_delivery_transformer` bigint(20) NOT NULL,
  `code_transformer` varchar(15) NOT NULL,
  `power_transformer` int(5) NOT NULL,
  `address_transformer` text NOT NULL,
  `latitude_transformer` float NOT NULL,
  `longitude_transformer` float NOT NULL,
  `type_transformer` varchar(20) NOT NULL,
  `class_transformer` varchar(20) NOT NULL,
  `circuit_transformer` varchar(12) NOT NULL,
  `cost_transformer` decimal(15,2) NOT NULL,
  `life_transformer` mediumtext NOT NULL,
  `status_transformer` varchar(8) NOT NULL,
  `gallery_transformer` text NOT NULL,
  `date_created_transformer` date DEFAULT NULL,
  `date_updated_transformer` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transformers`
--

INSERT INTO `transformers` (`id_transformer`, `id_delivery_transformer`, `code_transformer`, `power_transformer`, `address_transformer`, `latitude_transformer`, `longitude_transformer`, `type_transformer`, `class_transformer`, `circuit_transformer`, `cost_transformer`, `life_transformer`, `status_transformer`, `gallery_transformer`, `date_created_transformer`, `date_updated_transformer`) VALUES
(1, 1, 'TRANS-001', 150, 'carrera 22 calle 5', 10.2526, -74.0252, 'Exclusivo', 'Pedestal', '', 0.00, '', 'Activo', '', '2024-10-14', '2024-10-14 15:14:18'),
(2, 1, 'TRANS004', 150, 'CALLE', 10.2523, -74.1525, 'Exclusivo', 'Aereo', 'LE91891', 0.00, '                                                                                                                                                                                                                                                                                                                                                                                                                                prueba dos                                                                                                                                                                                                                                                                                                                                                                                                ', 'Activo', '[\"TRANS004_9588372128.png\"]', '2024-10-15', '2024-10-16 05:00:00'),
(8, 1, 'TRANS-002', 150, 'CALLE', 10.2523, -74.1525, 'Exclusivo', 'Aereo', 'L020251', 5000000.00, '                                                                                                                                                                                                                                                                                                <p>zxzxzx</p>                                                                                                                                                                                                                                                                                                ', 'Activo', '[\"TRANS-002_7054669825.jpg\",\"TRANS-002_8221960063.jpg\",\"TRANS-002_9305056070.jpg\"]', '2024-10-16', '2024-10-16 05:00:00'),
(9, 1, 'TRANS-020', 150, 'CALLE 33LLDL', 10.253, -74.2536, 'Exclusivo', 'Aereo', 'C5658', 2500000.00, '                                <p>prueba</p>                                ', 'Activo', '[\"trans-020-66966241.jpg\"]', '2024-10-28', '2024-10-28 05:00:00'),
(10, 1, 'TRANS-021', 500, 'EL CENTRO', 10.2533, -74.2536, 'Exclusivo', 'Subterraneo', 'D2525', 3500000.00, '<p>OTRA</p>', 'Activo', '[\"trans-021-49751014.jpg\"]', '2024-10-28', '2024-10-28 14:43:07'),
(11, 1, 'TRANS-022', 500, 'CARTAGEA', 10.2533, -74.2536, 'Compartido con Red', 'Aereo', 'D2525333', 2500000.00, '<p>RUEBA</p>', 'Activo', '[\"trans-022-41322203.jpg\"]', '2024-10-28', '2024-10-28 14:45:06'),
(12, 1, 'port-KDL', 150, 'CALLE 33LLDLDDDDD', 10.253, -74.2536, 'Exclusivo', 'Pedestal', 'D2525', 3500000.00, '<p>SDSD</p>', 'Activo', '[\"port-kdl-26029486.jpg\"]', '2024-10-28', '2024-10-28 15:05:16');

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
(2, '02', 'INVERSION', 'Activo', '2024-08-02', '2024-08-02 16:14:39'),
(3, '03', 'ACTA DE BAJA', 'Activo', '2024-08-14', '2024-08-14 15:44:29');

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
(1, 'Osvaldo José Villalobos Cortina', 'osvicor', 'osvicor@hotmail.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MzAxMjMwNjEsImV4cCI6MTczMDIwOTQ2MSwiZGF0YSI6eyJpZCI6MSwiZW1haWwiOiJvc3ZpY29yQGhvdG1haWwuY29tIn19.i6-Y5an6kjPuW-DvBwF1zzj84BgVq2gEeH4e7XnL0BA', '1730209461', 'Administradores', '1.jpg', 'Afghanistan', 'Santa Marta', 'Urb. San Lorenzo Mz J Cs 34', '93_3153153153', 'direct', '2024-06-17', '2024-06-17 18:47:27', 1, 0),
(7, 'Jorge Villalobos', 'jorgito', 'jorge@gmail.com', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', NULL, NULL, 'Usuarios', '7.png', 'Algeria', 'Varsobia', 'LA QUE SEA', '+213_3153153153', 'direct', '2024-06-22', '2024-06-22 14:18:30', 1, 1),
(31, 'Juan Prueto', '', 'prueba@mail.com', '', NULL, NULL, '1', NULL, 'Afghanistan', 'Otra', 'calle 1', '+93_3253253325', 'direct', '2024-06-25', '2024-06-25 20:10:46', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uses`
--

CREATE TABLE `uses` (
  `id_use` bigint(20) NOT NULL,
  `name_use` text NOT NULL,
  `amount_use` decimal(10,2) NOT NULL,
  `minimal_use` decimal(10,2) NOT NULL,
  `status_use` varchar(8) NOT NULL,
  `date_created_use` date DEFAULT NULL,
  `date_updated_use` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `uses`
--

INSERT INTO `uses` (`id_use`, `name_use`, `amount_use`, `minimal_use`, `status_use`, `date_created_use`, `date_updated_use`) VALUES
(1, 'RESIDENCIAL ESTRATO I', 15.00, 15200.00, 'Activo', '2024-10-20', '2024-10-20 16:27:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viewinvs`
--

CREATE TABLE `viewinvs` (
  `id_viewinv` bigint(20) NOT NULL,
  `group_viewinv` varchar(20) NOT NULL,
  `code_viewinv` varchar(10) NOT NULL,
  `info_viewinv` text NOT NULL,
  `address_viewinv` text NOT NULL,
  `qty_viewinv` decimal(15,2) NOT NULL,
  `cost_viewinv` decimal(15,2) NOT NULL,
  `date_created_viewinv` date DEFAULT NULL,
  `date_updated_viewinv` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viewinvs`
--

INSERT INTO `viewinvs` (`id_viewinv`, `group_viewinv`, `code_viewinv`, `info_viewinv`, `address_viewinv`, `qty_viewinv`, `cost_viewinv`, `date_created_viewinv`, `date_updated_viewinv`) VALUES
(1, 'TRANSFORMADORES', 'TRANS-020', '150 KWh', 'CALLE 33LLDL', 1.00, 2500000.00, '2024-10-28', '2024-10-28 14:34:38'),
(2, 'TRANSFORMADORES', 'TRANS-021', '500 KWh', 'EL CENTRO', 1.00, 3500000.00, '2024-10-28', '2024-10-28 14:43:07'),
(3, 'TRANSFORMADORES', 'TRANS-022', '500 KWh', 'CARTAGEA', 1.00, 2500000.00, '2024-10-28', '2024-10-28 14:45:07'),
(4, 'TRANSFORMADORES', 'port-KDL', '150 KWh', 'CALLE 33LLDLDDDDD', 1.00, 3500000.00, '2024-10-28', '2024-10-28 15:05:16');

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
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id_department`);

--
-- Indices de la tabla `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id_detail`);

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
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Indices de la tabla `itemdeliveries`
--
ALTER TABLE `itemdeliveries`
  ADD PRIMARY KEY (`id_itemdelivery`);

--
-- Indices de la tabla `luminaries`
--
ALTER TABLE `luminaries`
  ADD PRIMARY KEY (`id_luminary`),
  ADD KEY `id_delivery_luminary` (`id_delivery_luminary`);

--
-- Indices de la tabla `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`id_municipality`);

--
-- Indices de la tabla `poles`
--
ALTER TABLE `poles`
  ADD PRIMARY KEY (`id_pole`);

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
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indices de la tabla `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id_technology`);

--
-- Indices de la tabla `transformers`
--
ALTER TABLE `transformers`
  ADD PRIMARY KEY (`id_transformer`);

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
-- Indices de la tabla `uses`
--
ALTER TABLE `uses`
  ADD PRIMARY KEY (`id_use`);

--
-- Indices de la tabla `viewinvs`
--
ALTER TABLE `viewinvs`
  ADD PRIMARY KEY (`id_viewinv`);

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
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id_department` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `details`
--
ALTER TABLE `details`
  MODIFY `id_detail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `elements`
--
ALTER TABLE `elements`
  MODIFY `id_element` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `heights`
--
ALTER TABLE `heights`
  MODIFY `id_height` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id_image` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `itemdeliveries`
--
ALTER TABLE `itemdeliveries`
  MODIFY `id_itemdelivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `luminaries`
--
ALTER TABLE `luminaries`
  MODIFY `id_luminary` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id_material` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `id_municipality` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1124;

--
-- AUTO_INCREMENT de la tabla `poles`
--
ALTER TABLE `poles`
  MODIFY `id_pole` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `powers`
--
ALTER TABLE `powers`
  MODIFY `id_power` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  MODIFY `id_pqr` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id_technology` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transformers`
--
ALTER TABLE `transformers`
  MODIFY `id_transformer` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `typedeliveries`
--
ALTER TABLE `typedeliveries`
  MODIFY `id_typedelivery` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `uses`
--
ALTER TABLE `uses`
  MODIFY `id_use` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `viewinvs`
--
ALTER TABLE `viewinvs`
  MODIFY `id_viewinv` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
