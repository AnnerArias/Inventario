-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2024 a las 04:05:43
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
-- Base de datos: `mvc_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustes`
--

CREATE TABLE `ajustes` (
  `id` int(20) NOT NULL,
  `nombre_app` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'Viveres', 'Activo'),
(3, 'Reiciendis dolores l', 'Activo'),
(10, 'Licor', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(20) NOT NULL,
  `proveedor_id` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `factura` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `proveedor_id`, `fecha`, `factura`, `estado`) VALUES
(1, 1, '2024-11-06', '000909', 'Activo'),
(2, 3, '2024-11-06', '8989', 'Activo'),
(3, 3, '1975-07-22', 'Cumque et ut consequ', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despachos`
--

CREATE TABLE `despachos` (
  `id` int(20) NOT NULL,
  `emisor_id` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `factura` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `despachos`
--

INSERT INTO `despachos` (`id`, `emisor_id`, `fecha`, `factura`, `estado`) VALUES
(1, 1, '2024-11-06', '009', 'Activo'),
(2, 1, '1977-01-19', 'Quod voluptatem Ess', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compras`
--

CREATE TABLE `detalles_compras` (
  `id` int(20) NOT NULL,
  `id_compra` int(20) NOT NULL,
  `producto_id` int(20) NOT NULL,
  `cantidad` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_compras`
--

INSERT INTO `detalles_compras` (`id`, `id_compra`, `producto_id`, `cantidad`) VALUES
(1, 1, 1, 22),
(4, 1, 7, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_despachos`
--

CREATE TABLE `detalles_despachos` (
  `id` int(20) NOT NULL,
  `id_despacho` int(11) NOT NULL,
  `producto_id` int(20) NOT NULL,
  `cantidad` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_despachos`
--

INSERT INTO `detalles_despachos` (`id`, `id_despacho`, `producto_id`, `cantidad`) VALUES
(1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `presentacion` varchar(100) NOT NULL,
  `cant_empaque` int(20) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `categoria_id` int(20) NOT NULL,
  `min_stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `presentacion`, `cant_empaque`, `imagen`, `estado`, `categoria_id`, `min_stock`) VALUES
(1, 'Producto Uno', 'Individual', 1, 'Prod.png', 'Activo', 3, 10),
(3, 'ZIM', 'Hol', 9, 'ZIM.png', 'Activo', 3, 9),
(4, 'Ejemplo', '1', 1, 'Ejem.jpeg', 'Activo', 1, 5),
(6, 'Ejemplo', '1', 1, 'Ejem.jpeg', 'Activo', 1, 5),
(7, 'Penhouse', 'kjkljkljklj', 1, 'Penh.png', 'Activo', 1, 3),
(8, 'jjlkjkljkljkljkljkljklj', 'kjkljkljklj', 1, 'jjlk.png', 'Activo', 1, 7),
(10, 'jjlkjkljkljkljkljkljklj', 'kjkljkljklj', 1, 'jjlk.jpeg', 'Activo', 1, 7),
(11, 'jjlkjkljkljkljkljkljklj', 'kjkljkljklj', 1, 'jjlk.jpeg', 'Activo', 1, 7),
(13, 'jjlkjkljkljkljkljkljklj', 'kjkljkljklj', 1, 'jjlk.jpeg', 'Activo', 1, 7),
(14, 'jjlkjkljkljkljkljkljklj', 'kjkljkljklj', 1, 'jjlk.jpeg', 'Activo', 1, 7),
(15, '66666', '6666666', 66, '6666.jpeg', 'Activo', 1, 6),
(16, '66666', '6666666', 66, '6666.jpeg', 'Activo', 1, 6),
(17, 'uuuu', 'uuuuu', 1, 'uuuu.jpeg', 'Activo', 1, 5),
(18, 'uuuu', 'uuuuu', 1, 'uuuu.jpeg', 'Activo', 1, 5),
(19, 'uuuu', 'uuuuu', 1, 'uuuu.jpeg', 'Activo', 1, 5),
(20, 'Nuevo', 'Unidad', 2, 'Nuev.png', 'Activo', 3, 5),
(21, 'Inventore qui molest', 'Eiusmod blanditiis v', 16, 'Inve.png', 'Activo', 3, 1),
(22, 'Ut sint molestiae c', 'Non nostrum quia min', 6, 'no-imagen.png', 'Activo', 1, 72);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(20) NOT NULL,
  `rif` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `rif`, `nombre`, `direccion`, `telefono`, `logo`, `estado`) VALUES
(1, 'Quia deserunt omnis ', 'Illum facilis non i', 'Commodo ut qui ex ad', '+1 (344) 994-6105', 'J-8989898-0.PNG', 'Activo'),
(3, 'Voluptas quia amet ', 'Commodi qui totam in', 'Ab qui saepe quia ad', '+1 (744) 581-2532', 'no-imagen.png', 'Activo'),
(5, 'Ipsum molestiae aut ', 'Aspernatur minim mai', 'Voluptas cumque pari', '999299388299839', 'Ipsum molestiae aut .png', 'Activo'),
(6, 'Est voluptas dolore', 'Consectetur ut ullam', 'In aliquip possimus', '+1 (854) 326-7976', 'no-imagen.png', 'Activo'),
(8, 'J-89898988-2', 'Veniam libero sequi', 'Ea eum quia alias pe', '+1 (982) 983-3923', 'no-imagen.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id` int(20) NOT NULL,
  `id_producto` int(20) NOT NULL,
  `cantidad` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id`, `id_producto`, `cantidad`) VALUES
(1, 1, 20),
(2, 2, 210),
(3, 3, 0),
(4, 4, -5),
(5, 5, 0),
(6, 6, 0),
(7, 7, 8),
(8, 8, 0),
(9, 9, 0),
(10, 10, 0),
(11, 11, 0),
(12, 12, 0),
(13, 13, 0),
(14, 14, 0),
(15, 15, 0),
(16, 16, 0),
(17, 17, 0),
(18, 18, 0),
(19, 19, 0),
(20, 20, 0),
(21, 21, 0),
(22, 22, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `clave` text NOT NULL,
  `correo` varchar(200) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `clave`, `correo`, `rol`, `avatar`, `estado`) VALUES
(1, 'Anner', 'Arias', '512d2085bb5a170f341d081d6a445416', 'anner@arias.com', 'Root', 'no-avatar.png', 'Activo'),
(2, 'Genesis', 'Ramos', '512d2085bb5a170f341d081d6a445416', 'genesis@gmail.com', 'Administrador', '', 'Activo'),
(3, 'Selena', 'Arias', '512d2085bb5a170f341d081d6a445416', 'selena@gmail.com', 'Operador', 'no-avatar', 'Activo'),
(4, 'Jhon', 'Doe', '512d2085bb5a170f341d081d6a445416', 'faxy@mailinator.com', 'Operador', 'no-avatar', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `despachos`
--
ALTER TABLE `despachos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor_id` (`emisor_id`);

--
-- Indices de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `detalles_despachos`
--
ALTER TABLE `detalles_despachos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_despacho` (`id_despacho`,`producto_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `despachos`
--
ALTER TABLE `despachos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalles_despachos`
--
ALTER TABLE `detalles_despachos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
