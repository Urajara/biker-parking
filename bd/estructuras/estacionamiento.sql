-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2026 a las 06:58:03
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
-- Base de datos: `estacionamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `nombre_banco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `nombre_banco`) VALUES
(1, 'venezuela'),
(2, 'provincial'),
(3, 'banesco'),
(4, 'mercantil'),
(5, '100%banco'),
(6, 'banco nacional de credito'),
(7, 'bicentenario'),
(8, 'ban plus'),
(9, 'banco exterior');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES
(1, '9625928', 'Jose', 'Gonzalez', '04160728601'),
(2, '18862633', 'Cristina', 'Capo', '04123866572'),
(3, '13581004', 'Carmen', 'Capote', '04120323580'),
(5, '31550216', 'deivis', 'cardenas', '04120533074'),
(7, '23455688', 'josue', 'lara', '04245347789'),
(9, '31550215', 'roberth', 'vega', '04120533072'),
(10, '31550219', 'maluelo', 'mendoza', '26353618'),
(11, '33455677', 'miguel', 'suares', '1533521176537'),
(12, '11222344', 'pedro', 'aguilar', '31454325'),
(13, '31550214', 'deivis paul', 'chivobuto', '04120533071');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id` int(11) NOT NULL,
  `nombre_forma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id`, `nombre_forma`) VALUES
(1, 'efectivo_dolar'),
(2, 'efectivo_bs'),
(3, 'pago_movil'),
(4, 'transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre_modulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `nombre_modulo`) VALUES
(1, 'Clientes'),
(2, 'Vehículos'),
(3, 'pagos_Tickets'),
(5, 'Usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `id_forma_pago` int(11) NOT NULL,
  `id_banco` int(11) DEFAULT NULL,
  `id_tasa` int(11) NOT NULL,
  `monto_dolares` decimal(10,2) NOT NULL DEFAULT 1.00,
  `monto_final_pagado` decimal(10,2) NOT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `id_ticket`, `id_forma_pago`, `id_banco`, `id_tasa`, `monto_dolares`, `monto_final_pagado`, `referencia`, `fecha_pago`) VALUES
(4, 4, 3, 2, 1, 230.50, 9335.25, '1235', '2026-06-17 21:13:45'),
(5, 7, 1, NULL, 1, 230.33, 9328.36, 'N/A', '2026-06-17 21:16:57'),
(6, 4, 1, NULL, 1, 231.03, 9356.72, 'N/A', '2026-06-17 21:45:39'),
(7, 4, 3, 8, 1, 231.05, 9357.52, '4465', '2026-06-17 21:46:32'),
(8, 12, 1, NULL, 1, 1.00, 40.50, 'N/A', '2026-06-17 21:50:07'),
(9, 4, 3, 3, 1, 231.12, 9360.36, '3312', '2026-06-17 21:50:48'),
(10, 13, 1, NULL, 1, 1.00, 40.50, 'N/A', '2026-06-18 09:57:50'),
(11, 14, 3, 1, 1, 1.00, 40.50, '12221', '2026-06-18 13:18:35'),
(12, 7, 2, NULL, 1, 246.37, 9977.99, 'N/A', '2026-06-18 13:19:02'),
(14, 22, 3, 3, 1, 1.00, 40.50, '3455', '2026-06-19 09:52:27'),
(15, 21, 2, NULL, 1, 1.00, 40.50, 'N/A', '2026-06-19 09:53:22'),
(16, 20, 1, NULL, 1, 1.00, 40.50, 'N/A', '2026-06-19 09:54:52'),
(17, 24, 1, NULL, 1, 68.41, 2770.61, 'N/A', '2026-06-22 12:09:21'),
(18, 23, 1, NULL, 1, 70.67, 2862.14, 'N/A', '2026-06-22 12:09:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `id_rol`, `id_modulo`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Gerente'),
(2, 'Supervisor'),
(3, 'Operador de Caja'),
(4, 'Administrador'),
(5, 'SuperUsuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasa_cambio`
--

CREATE TABLE `tasa_cambio` (
  `id` int(11) NOT NULL,
  `valor_bs` decimal(10,2) NOT NULL,
  `fecha_tasa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasa_cambio`
--

INSERT INTO `tasa_cambio` (`id`, `valor_bs`, `fecha_tasa`) VALUES
(1, 545.50, '2026-06-16'),
(2, 600.20, '2026-06-17'),
(25, 600.24, '2026-06-18'),
(26, 607.39, '2026-06-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_zona` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `estatus` varchar(20) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `id_vehiculo`, `id_usuario`, `id_zona`, `fecha_entrada`, `hora_entrada`, `estatus`) VALUES
(4, 2, 1, 2, '2026-06-08', '02:43:31', 'Pagado'),
(7, 3, 1, 3, '2026-06-08', '02:56:43', 'Pagado'),
(12, 3, 1, 2, '2026-06-17', '17:49:47', 'Pagado'),
(13, 17, 1, 2, '2026-06-18', '05:57:14', 'Pagado'),
(14, 18, 1, 2, '2026-06-18', '09:17:47', 'Pagado'),
(15, 1, 1, 2, '2026-06-18', '09:46:50', 'Activo'),
(16, 3, 1, 3, '2026-06-18', '09:47:32', 'Activo'),
(17, 17, 1, 4, '2026-06-18', '11:28:19', 'Activo'),
(18, 19, 1, 1, '2026-06-18', '11:31:26', 'Activo'),
(20, 22, 1, 3, '2026-06-19', '05:50:50', 'Pagado'),
(21, 21, 1, 2, '2026-06-19', '05:51:06', 'Pagado'),
(22, 20, 1, 2, '2026-06-19', '05:51:44', 'Pagado'),
(23, 1, 1, 2, '2026-06-19', '09:29:44', 'Pagado'),
(24, 17, 1, 2, '2026-06-19', '11:44:19', 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `apellido`, `password`, `id_rol`, `estatus`) VALUES
(1, '9625928', 'jose', 'Gonzalez', '123456', 1, 0),
(2, '31152335', 'eliecer', 'lara', '123456', 3, 1),
(119, '31550216', 'samuel', 'cardenas', '123456', 1, 0),
(120, '31550217', 'odeilis', 'delgado', '31550217', NULL, 1),
(121, '31550214', 'manuel', 'mendoza', '31550214', NULL, 1),
(123, '31600207', 'elmer', 'perez', '31600207', NULL, 0),
(124, '31550218', 'deivis', 'cortes', '31550218', NULL, 0),
(125, '33450677', 'carlos', 'paez', '33450677', NULL, 1),
(127, '15886154', 'manuel', 'perez', '$2y$10$um3DCWpRjpHAu8YhSruFKO7QKfue6pcGRccH9SVKj8MTeitMIDtmq', 1, 1),
(130, '13445667', 'lola', 'melendez', '$2y$10$0s3o3HFrMLhwERJooLgGGeaMJIC.vMvWzb38t3//436sB9YD1TFUm', 2, 0),
(133, '33667789', 'el', 'meles', '$2y$10$yD1A43mvG3JQjhrxIVZXDuyQzpDAAR2MBDFxmexu9hlhlfBI9wdg2', 3, 0),
(135, '31550219', 'deivis', 'cardenas', '$2y$10$TPd6sWob6jx0pk3QZI8AneA0jIUvkXzpvYbJp7YJTq4Yicf.qSsAq', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `placa` varchar(15) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `id_cliente`, `placa`, `marca`, `modelo`, `color`) VALUES
(1, 1, 'AA3821A', 'Empire', '150', 'Rojo'),
(2, 2, 'AA13BC', 'bera', 'sbr', 'Azul'),
(3, 3, 'AA1B32', 'Suzuki', 'Horse', 'Verde'),
(16, 1, 'ffdd33gg', 'bera', '150', 'verde'),
(17, 7, 'ab5hl5h', 'bera', '200', 'morada'),
(18, 2, 'dsasda', 'bera', '250', 'rosado'),
(19, 3, 'dd4eehj', 'ava', 'leopardo', 'rojo'),
(20, 10, 'dde12gf', 'bera', '250', 'rojo'),
(21, 11, 'aavc23b', 'empire', 'ava', 'morado'),
(22, 12, 'hhht3j4', 'susuki', '200', 'morado'),
(23, 13, 'ddsa24ews', 'bera', 'leon', 'blanco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id_zona` int(11) NOT NULL,
  `nombre_zona` varchar(50) NOT NULL,
  `descuento_porcentaje` decimal(5,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id_zona`, `nombre_zona`, `descuento_porcentaje`) VALUES
(1, 'Zona 1 - Empleado Centro Comercial', 0.50),
(2, 'Zona 2 - Motos Paseo', 0.25),
(3, 'Zona 3 - Motos Enduro', 0.00),
(4, 'Zona 4 - Motos Deterioradas o LLevadas', 0.15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_cedula_cliente` (`cedula`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ticket` (`id_ticket`),
  ADD KEY `id_forma_pago` (`id_forma_pago`),
  ADD KEY `id_banco` (`id_banco`),
  ADD KEY `id_tasa` (`id_tasa`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tasa_cambio`
--
ALTER TABLE `tasa_cambio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_fecha_tasa` (`fecha_tasa`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculo` (`id_vehiculo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_zona` (`id_zona`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_cedula_user` (`cedula`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_placa` (`placa`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tasa_cambio`
--
ALTER TABLE `tasa_cambio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`id_forma_pago`) REFERENCES `forma_pago` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_ibfk_3` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_ibfk_4` FOREIGN KEY (`id_tasa`) REFERENCES `tasa_cambio` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`id_zona`) REFERENCES `zonas` (`id_zona`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
