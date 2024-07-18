-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2024 a las 10:41:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `nombre`, `apellido`, `email`, `telefono`) VALUES
(1, 'Odwell Dael', 'Ortiz Nicolalde', 'odwellortiz@gmail.com', '0992796271'),
(2, 'Fernando', 'Ortiz Nicolalde', 'fwe@gmail.com', '2134555'),
(3, 'Suzana', 'Nicolalde', 'suz@gmail.com', '2135677');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `precio`, `stock`) VALUES
(1, 'Computadora', 'Asus rog', 1500.00, 2),
(2, 'telefono', 'Samsung', 800.00, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `venta_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`venta_id`, `cliente_id`, `producto_id`, `cantidad`, `precio_total`, `fecha`) VALUES
(1, 1, 1, 1, 1500.00, '2024-07-18 00:00:00'),
(3, 3, 2, 3, 2400.00, '2024-07-18 00:00:00'),
(4, 2, 2, 1, 800.00, '2024-07-18 08:01:35'),
(5, 1, 1, 4, 6000.00, '2024-07-18 08:01:53'),
(6, 1, 1, 15, 22500.00, '2024-07-18 08:02:13'),
(7, 2, 2, 1, 800.00, '2024-07-18 08:12:49'),
(8, 3, 1, 2, 3000.00, '2024-07-18 08:13:14'),
(9, 1, 2, 10, 8000.00, '2024-07-18 08:13:38'),
(10, 3, 1, 10, 15000.00, '2024-07-18 08:18:48'),
(11, 2, 1, 4, 6000.00, '2024-07-18 08:19:04'),
(12, 1, 1, 1, 1500.00, '2024-07-18 08:29:32'),
(13, 1, 1, 1, 0.00, '2024-07-18 08:36:49'),
(14, 1, 1, 1, 0.00, '2024-07-18 08:37:20'),
(15, 1, 1, 1, 0.00, '2024-07-18 08:37:26'),
(16, 1, 1, 2, 3000.00, '2024-07-18 09:51:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`venta_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`);
COMMIT;
