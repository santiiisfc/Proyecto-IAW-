-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2016 a las 13:05:18
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `muebles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cesta`
--

CREATE TABLE `cesta` (
  `IDPRODUCTO` int(4) NOT NULL,
  `IDUSUARIO` int(4) NOT NULL,
  `CANTIDAD` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineapedido`
--

CREATE TABLE `lineapedido` (
  `IDLINEAPEDIDO` int(6) NOT NULL,
  `IDPEDIDO` int(6) NOT NULL,
  `IDPRODUCTO` int(4) NOT NULL,
  `CANTIDAD` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `IDPEDIDO` int(6) NOT NULL,
  `IDUSUARIO` int(4) NOT NULL,
  `FECHA_PEDIDO` date NOT NULL,
  `IMPORTE` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IDPRODUCTO` int(4) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `COLOR` varchar(20) NOT NULL,
  `ANCHO` int(4) NOT NULL,
  `ALTO` int(4) NOT NULL,
  `PROFUNDO` int(4) NOT NULL,
  `PRECIO` double(8,2) NOT NULL,
  `DESCUENTO` int(2) NOT NULL,
  `PRECIO_DESCUENTO` double(8,2) NOT NULL,
  `IMAGEN` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IDPRODUCTO`, `NOMBRE`, `COLOR`, `ANCHO`, `ALTO`, `PROFUNDO`, `PRECIO`, `DESCUENTO`, `PRECIO_DESCUENTO`, `IMAGEN`) VALUES
(1, 'sofa', 'verde', 100, 100, 100, 23.00, 0, 0.00, './imagenes/productos/sofa1.jpg'),
(2, 'sofa2', 'verde', 100, 100, 100, 23.00, 0, 0.00, './imagenes/productos/sofa1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDUSUARIO` int(4) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSW` varchar(300) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDOS` varchar(20) NOT NULL,
  `CORREO` varchar(30) NOT NULL,
  `ROL` varchar(5) DEFAULT NULL,
  `ESTADO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDUSUARIO`, `USERNAME`, `PASSW`, `NOMBRE`, `APELLIDOS`, `CORREO`, `ROL`, `ESTADO`) VALUES
(1, 'malive', '81dc9bdb52d04dc20036dbd8313ed055', 'david', 'r', '11', 'admin', ''),
(2, 'japan', '81dc9bdb52d04dc20036dbd8313ed055', 'j', 'jjjjjjjjjjjjjjjjjjj', '113@gmail.com', 'user', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`IDPRODUCTO`,`IDUSUARIO`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indices de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD PRIMARY KEY (`IDLINEAPEDIDO`,`IDPEDIDO`,`IDPRODUCTO`),
  ADD KEY `IDPEDIDO` (`IDPEDIDO`),
  ADD KEY `IDPRODUCTO` (`IDPRODUCTO`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`IDPEDIDO`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IDPRODUCTO`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUSUARIO`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD UNIQUE KEY `CORREO` (`CORREO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  MODIFY `IDLINEAPEDIDO` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `IDPEDIDO` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IDPRODUCTO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUSUARIO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD CONSTRAINT `cesta_ibfk_1` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `producto` (`IDPRODUCTO`),
  ADD CONSTRAINT `cesta_ibfk_2` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`IDUSUARIO`);

--
-- Filtros para la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD CONSTRAINT `lineapedido_ibfk_1` FOREIGN KEY (`IDPEDIDO`) REFERENCES `pedido` (`IDPEDIDO`),
  ADD CONSTRAINT `lineapedido_ibfk_2` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `producto` (`IDPRODUCTO`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuario` (`IDUSUARIO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
