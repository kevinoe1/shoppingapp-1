-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 29-04-2020 a las 15:27:27
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `shoppingapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Carrito`
--

CREATE TABLE `Carrito` (
  `PK_Carrito` int(11) NOT NULL,
  `Cantidad` double DEFAULT NULL,
  `FK_Producto` int(11) NOT NULL,
  `FK_Pedido` int(11) DEFAULT NULL,
  `FK_Talla` int(11) DEFAULT NULL,
  `FK_Color` int(11) DEFAULT NULL,
  `FK_Cliente` int(11) DEFAULT NULL,
  `FechaHoraAgregado` datetime DEFAULT NULL,
  `FK_TipoPedido` int(11) DEFAULT NULL,
  `FK_Destinatario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Carrito`
--

INSERT INTO `Carrito` (`PK_Carrito`, `Cantidad`, `FK_Producto`, `FK_Pedido`, `FK_Talla`, `FK_Color`, `FK_Cliente`, `FechaHoraAgregado`, `FK_TipoPedido`, `FK_Destinatario`) VALUES
(11, 1, 2, NULL, 1, 1, 1, '2020-04-28 21:36:50', 2, 1),
(12, 2, 2, NULL, 1, 1, 1, '2020-04-28 21:38:05', 2, 1),
(13, 1, 2, NULL, 1, 1, 1, '2020-04-29 14:40:40', 2, 1),
(14, 1, 2, NULL, 1, 1, 1, '2020-04-29 15:14:14', 1, NULL),
(15, 1, 2, NULL, 1, 1, 1, '2020-04-29 15:17:48', 1, NULL),
(16, 1, 3, NULL, NULL, NULL, 1, '2020-04-29 15:22:24', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `PK_Categoria` int(11) NOT NULL,
  `NombreCategoria` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(400) DEFAULT NULL,
  `Imagen` varchar(200) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`PK_Categoria`, `NombreCategoria`, `Descripcion`, `Imagen`, `Estado`) VALUES
(1, 'Calzado', 'Zapatos y sandalias', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudades`
--

CREATE TABLE `Ciudades` (
  `PK_Ciudad` int(11) NOT NULL,
  `NombreCiudad` varchar(80) DEFAULT NULL,
  `FK_Pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Ciudades`
--

INSERT INTO `Ciudades` (`PK_Ciudad`, `NombreCiudad`, `FK_Pais`) VALUES
(1, 'Tegucigalpa', 1),
(2, 'Choluteca', 1),
(3, 'San Pedro Sula', 1),
(4, 'Managua', 2),
(5, 'Leon', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes`
--

CREATE TABLE `Clientes` (
  `PK_Cliente` int(11) NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  `PrimerNombre` varchar(50) DEFAULT NULL,
  `SegundoNombre` varchar(50) DEFAULT NULL,
  `PrimerApellido` varchar(50) DEFAULT NULL,
  `SegundoApellido` varchar(50) DEFAULT NULL,
  `Direccion1` varchar(200) DEFAULT NULL,
  `Direccion2` varchar(200) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `FK_Ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Clientes`
--

INSERT INTO `Clientes` (`PK_Cliente`, `FK_Usuario`, `PrimerNombre`, `SegundoNombre`, `PrimerApellido`, `SegundoApellido`, `Direccion1`, `Direccion2`, `Telefono`, `FK_Ciudad`) VALUES
(1, 3, 'Kevin', '', 'canales', '', 'njk', 'njk', '789', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Colores`
--

CREATE TABLE `Colores` (
  `PK_Color` int(11) NOT NULL,
  `Color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Colores`
--

INSERT INTO `Colores` (`PK_Color`, `Color`) VALUES
(1, 'Rojo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Destinatarios`
--

CREATE TABLE `Destinatarios` (
  `PK_Destinatario` int(11) NOT NULL,
  `NombresDestinatario` varchar(100) DEFAULT NULL,
  `ApellidosDestinatario` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Departamento` varchar(100) DEFAULT NULL,
  `Direccion1` varchar(200) DEFAULT NULL,
  `Direccion2` varchar(200) DEFAULT NULL,
  `CodigoPostal` varchar(10) DEFAULT NULL,
  `FK_Cliente` int(11) NOT NULL,
  `FK_Ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Destinatarios`
--

INSERT INTO `Destinatarios` (`PK_Destinatario`, `NombresDestinatario`, `ApellidosDestinatario`, `Telefono`, `Departamento`, `Direccion1`, `Direccion2`, `CodigoPostal`, `FK_Cliente`, `FK_Ciudad`) VALUES
(1, 'Kevin', 'Canales', '33712740', 'Choluteca', 'Bario la cruz', 'Calle del registro', '52102', 1, 2),
(2, 'Anthony', 'Canales', '32959545', 'Francisco Morazán', 'Barrio el centro', 'Calle 8', '53189', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetallePedidos`
--

CREATE TABLE `DetallePedidos` (
  `PK_DetallePedido` int(11) NOT NULL,
  `Precio` double DEFAULT NULL,
  `Cantidad` double DEFAULT NULL,
  `Descuento` double DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `FK_Producto` int(11) NOT NULL,
  `FK_Pedido` int(11) NOT NULL,
  `FK_Talla` int(11) DEFAULT NULL,
  `FK_Color` int(11) DEFAULT NULL,
  `FK_TipoPedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleProducto`
--

CREATE TABLE `DetalleProducto` (
  `PK_DetalleProducto` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `FK_Talla` int(11) DEFAULT NULL,
  `FK_Color` int(11) DEFAULT NULL,
  `Peso` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `DetalleProducto`
--

INSERT INTO `DetalleProducto` (`PK_DetalleProducto`, `FK_Producto`, `FK_Talla`, `FK_Color`, `Peso`) VALUES
(1, 2, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Idiomas`
--

CREATE TABLE `Idiomas` (
  `PK_Idioma` int(11) NOT NULL,
  `idioma` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Idiomas`
--

INSERT INTO `Idiomas` (`PK_Idioma`, `idioma`) VALUES
(1, 'Ingles'),
(2, 'Español');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LogUsuarios`
--

CREATE TABLE `LogUsuarios` (
  `PK_LogUsuarios` int(11) NOT NULL,
  `Transaccion` varchar(250) DEFAULT NULL,
  `FechaHoraTransaccion` datetime DEFAULT NULL,
  `FK_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paises`
--

CREATE TABLE `Paises` (
  `PK_Pais` int(11) NOT NULL,
  `NombrePais` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Paises`
--

INSERT INTO `Paises` (`PK_Pais`, `NombrePais`) VALUES
(1, 'Honduras'),
(2, 'Nicaragua');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedidos`
--

CREATE TABLE `Pedidos` (
  `PK_Pedido` int(11) NOT NULL,
  `FK_Cliente` int(11) NOT NULL,
  `FK_Tienda` int(11) NOT NULL,
  `NumeroPedido` varchar(20) DEFAULT NULL,
  `FechaHoraOrden` datetime DEFAULT NULL,
  `FechaHoraCompra` datetime DEFAULT NULL,
  `FechaHoraEnvio` datetime DEFAULT NULL,
  `FechaHoraEntrega` datetime DEFAULT NULL,
  `PesoPedido` double DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `FK_Destinatario` int(11) DEFAULT NULL,
  `FK_TipoPedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE `Productos` (
  `PK_Producto` int(11) NOT NULL,
  `NombreProducto` varchar(200) DEFAULT NULL,
  `Descripcion` varchar(12000) DEFAULT NULL,
  `CantidadPorUnidad` int(11) DEFAULT NULL,
  `PrecioUnitario` double DEFAULT NULL,
  `PrecioEnvio` double DEFAULT NULL,
  `Descuento` double DEFAULT NULL,
  `UnidadesDisponibles` int(11) DEFAULT NULL,
  `UnidadesVendidas` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `Imagen` varchar(200) DEFAULT NULL,
  `Ranking` double DEFAULT NULL,
  `Nota` varchar(400) DEFAULT NULL,
  `FK_Tienda` int(11) NOT NULL,
  `FK_Categoria` int(11) NOT NULL,
  `Adomicilio` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`PK_Producto`, `NombreProducto`, `Descripcion`, `CantidadPorUnidad`, `PrecioUnitario`, `PrecioEnvio`, `Descuento`, `UnidadesDisponibles`, `UnidadesVendidas`, `Estado`, `Imagen`, `Ranking`, `Nota`, `FK_Tienda`, `FK_Categoria`, `Adomicilio`) VALUES
(2, 'Sandalias de colores', '\r\nManufacturer Model: CoDrone\r\nFun and educational drone\r\nPerfect for beginners learning programming\r\nArduino Compatible controller\r\nUse your Apple or Android smart phone to fly, battle, voice control CoDrone\r\nEasily removable/replaceable motors\r\nDescription\r\nLearning to code is fast and simple with CoDrone, a fully programmable drone. Simply unbox your CoDrone, watch our tutorials, and start coding within minutes. Then watch your code take flight! Start from introductory basics to gaining hands-on experience with real world programming for hardware.\r\n\r\n', 1, 50, 5, 10, 250, 50, 1, 'uploads/img/productos/product.jpg', 3.5, 'Nuevas', 1, 1, 1),
(3, 'Producto de prueba', 'Esta es una descripción de prueba', 1, 10, NULL, NULL, 12, 1, 1, 'uploads/img/productos/product2.jpg', 5, 'nada', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RegionesEnvio`
--

CREATE TABLE `RegionesEnvio` (
  `FK_Ciudad` int(11) NOT NULL,
  `FK_Tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `RegionesEnvio`
--

INSERT INTO `RegionesEnvio` (`FK_Ciudad`, `FK_Tienda`) VALUES
(1, 1),
(2, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tallas`
--

CREATE TABLE `Tallas` (
  `PK_Talla` int(11) NOT NULL,
  `Talla` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Tallas`
--

INSERT INTO `Tallas` (`PK_Talla`, `Talla`) VALUES
(1, '40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tiendas`
--

CREATE TABLE `Tiendas` (
  `PK_Tienda` int(11) NOT NULL,
  `NombreTienda` varchar(200) DEFAULT NULL,
  `NombreContacto` varchar(50) DEFAULT NULL,
  `ApellidoContacto` varchar(50) DEFAULT NULL,
  `Direccion1` varchar(200) DEFAULT NULL,
  `Direccion2` varchar(200) DEFAULT NULL,
  `SitioWeb` varchar(100) DEFAULT NULL,
  `Correo` varchar(80) DEFAULT NULL,
  `CorreoPaypal` varchar(80) DEFAULT NULL,
  `Logo` varchar(200) DEFAULT NULL,
  `Adomicilio` tinyint(4) DEFAULT NULL,
  `FK_Ciudad` int(11) NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Portada` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Tiendas`
--

INSERT INTO `Tiendas` (`PK_Tienda`, `NombreTienda`, `NombreContacto`, `ApellidoContacto`, `Direccion1`, `Direccion2`, `SitioWeb`, `Correo`, `CorreoPaypal`, `Logo`, `Adomicilio`, `FK_Ciudad`, `FK_Usuario`, `Telefono`, `Portada`) VALUES
(1, 'mitienda', 'kevin', 'canales', '2fre', 'erf', '', 'noe@noe.com', 'noe@bus.com', 'tienda_2_logo.jpg', 1, 1, 2, '234', 'tienda_2_portada.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TiendasTipoPago`
--

CREATE TABLE `TiendasTipoPago` (
  `FK_Tienda` int(11) NOT NULL,
  `FK_TipoPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TiposPago`
--

CREATE TABLE `TiposPago` (
  `PK_TipoPago` int(11) NOT NULL,
  `TipoPago` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TiposPedido`
--

CREATE TABLE `TiposPedido` (
  `PK_TipoPedido` int(11) NOT NULL,
  `TipoPedido` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TiposPedido`
--

INSERT INTO `TiposPedido` (`PK_TipoPedido`, `TipoPedido`) VALUES
(1, 'En tienda'),
(2, 'A domicilio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoUsuario`
--

CREATE TABLE `TipoUsuario` (
  `PK_TipoUsuario` int(11) NOT NULL,
  `TipoUsuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TipoUsuario`
--

INSERT INTO `TipoUsuario` (`PK_TipoUsuario`, `TipoUsuario`) VALUES
(1, 'Cliente'),
(2, 'Tienda'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `PK_Usuario` int(11) NOT NULL,
  `NombreUsuario` varchar(50) DEFAULT NULL,
  `Contrasena` varchar(50) DEFAULT NULL,
  `Correo` varchar(80) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `FK_TipoUsuario` int(11) NOT NULL,
  `FK_Idioma` int(11) NOT NULL,
  `Foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`PK_Usuario`, `NombreUsuario`, `Contrasena`, `Correo`, `Estado`, `FK_TipoUsuario`, `FK_Idioma`, `Foto`) VALUES
(1, 'kevine1', 'hola1234', 'noe@noe', 1, 1, 1, NULL),
(2, 'noe@noe.com', 'hola', 'noe@noe.com', 1, 2, 1, 'tienda_2_logo.jpg'),
(3, 'kevin', 'hola1234', 'kevin@kevin.com', 1, 1, 1, 'user_3_foto_perfil.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Carrito`
--
ALTER TABLE `Carrito`
  ADD PRIMARY KEY (`PK_Carrito`),
  ADD KEY `FK_Producto` (`FK_Producto`),
  ADD KEY `FK_Pedido` (`FK_Pedido`),
  ADD KEY `FK_Talla` (`FK_Talla`),
  ADD KEY `FK_Color` (`FK_Color`),
  ADD KEY `carrito_ibfk_3` (`FK_Cliente`),
  ADD KEY `carrito_ibfk_4` (`FK_TipoPedido`),
  ADD KEY `carrito_ibfk_5` (`FK_Destinatario`);

--
-- Indices de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`PK_Categoria`);

--
-- Indices de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  ADD PRIMARY KEY (`PK_Ciudad`),
  ADD KEY `FK_Pais` (`FK_Pais`);

--
-- Indices de la tabla `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`PK_Cliente`,`FK_Usuario`),
  ADD KEY `FK_Usuario` (`FK_Usuario`),
  ADD KEY `FK_Ciudad` (`FK_Ciudad`);

--
-- Indices de la tabla `Colores`
--
ALTER TABLE `Colores`
  ADD PRIMARY KEY (`PK_Color`);

--
-- Indices de la tabla `Destinatarios`
--
ALTER TABLE `Destinatarios`
  ADD PRIMARY KEY (`PK_Destinatario`),
  ADD KEY `FK_Cliente` (`FK_Cliente`),
  ADD KEY `FK_Ciudad` (`FK_Ciudad`);

--
-- Indices de la tabla `DetallePedidos`
--
ALTER TABLE `DetallePedidos`
  ADD PRIMARY KEY (`PK_DetallePedido`),
  ADD KEY `FK_Producto` (`FK_Producto`),
  ADD KEY `FK_Pedido` (`FK_Pedido`),
  ADD KEY `FK_Talla` (`FK_Talla`),
  ADD KEY `detallepedidos_ibfk_4` (`FK_Color`),
  ADD KEY `detallepedidos_ibfk_5` (`FK_TipoPedido`);

--
-- Indices de la tabla `DetalleProducto`
--
ALTER TABLE `DetalleProducto`
  ADD PRIMARY KEY (`PK_DetalleProducto`),
  ADD KEY `FK_Producto` (`FK_Producto`),
  ADD KEY `FK_Talla` (`FK_Talla`),
  ADD KEY `FK_Color` (`FK_Color`);

--
-- Indices de la tabla `Idiomas`
--
ALTER TABLE `Idiomas`
  ADD PRIMARY KEY (`PK_Idioma`);

--
-- Indices de la tabla `LogUsuarios`
--
ALTER TABLE `LogUsuarios`
  ADD PRIMARY KEY (`PK_LogUsuarios`),
  ADD KEY `FK_Usuario` (`FK_Usuario`);

--
-- Indices de la tabla `Paises`
--
ALTER TABLE `Paises`
  ADD PRIMARY KEY (`PK_Pais`);

--
-- Indices de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD PRIMARY KEY (`PK_Pedido`),
  ADD KEY `FK_Destinatario` (`FK_Destinatario`),
  ADD KEY `FK_TipoPedido` (`FK_TipoPedido`),
  ADD KEY `FK_Cliente` (`FK_Cliente`),
  ADD KEY `FK_Tienda` (`FK_Tienda`);

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`PK_Producto`),
  ADD KEY `FK_Tienda` (`FK_Tienda`),
  ADD KEY `FK_Categoria` (`FK_Categoria`);
ALTER TABLE `Productos` ADD FULLTEXT KEY `Descripcion` (`Descripcion`);
ALTER TABLE `Productos` ADD FULLTEXT KEY `Descripcion_2` (`Descripcion`);

--
-- Indices de la tabla `RegionesEnvio`
--
ALTER TABLE `RegionesEnvio`
  ADD PRIMARY KEY (`FK_Ciudad`,`FK_Tienda`),
  ADD KEY `FK_Tienda` (`FK_Tienda`);

--
-- Indices de la tabla `Tallas`
--
ALTER TABLE `Tallas`
  ADD PRIMARY KEY (`PK_Talla`);

--
-- Indices de la tabla `Tiendas`
--
ALTER TABLE `Tiendas`
  ADD PRIMARY KEY (`PK_Tienda`),
  ADD KEY `FK_Ciudad` (`FK_Ciudad`),
  ADD KEY `FK_Usuario` (`FK_Usuario`);

--
-- Indices de la tabla `TiendasTipoPago`
--
ALTER TABLE `TiendasTipoPago`
  ADD PRIMARY KEY (`FK_Tienda`,`FK_TipoPago`),
  ADD KEY `FK_TipoPago` (`FK_TipoPago`);

--
-- Indices de la tabla `TiposPago`
--
ALTER TABLE `TiposPago`
  ADD PRIMARY KEY (`PK_TipoPago`);

--
-- Indices de la tabla `TiposPedido`
--
ALTER TABLE `TiposPedido`
  ADD PRIMARY KEY (`PK_TipoPedido`);

--
-- Indices de la tabla `TipoUsuario`
--
ALTER TABLE `TipoUsuario`
  ADD PRIMARY KEY (`PK_TipoUsuario`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`PK_Usuario`),
  ADD UNIQUE KEY `NombreUsuario` (`NombreUsuario`),
  ADD KEY `FK_TipoUsuario` (`FK_TipoUsuario`),
  ADD KEY `FK_Idioma` (`FK_Idioma`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Carrito`
--
ALTER TABLE `Carrito`
  MODIFY `PK_Carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `PK_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  MODIFY `PK_Ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Clientes`
--
ALTER TABLE `Clientes`
  MODIFY `PK_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Colores`
--
ALTER TABLE `Colores`
  MODIFY `PK_Color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Destinatarios`
--
ALTER TABLE `Destinatarios`
  MODIFY `PK_Destinatario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `DetallePedidos`
--
ALTER TABLE `DetallePedidos`
  MODIFY `PK_DetallePedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `DetalleProducto`
--
ALTER TABLE `DetalleProducto`
  MODIFY `PK_DetalleProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Idiomas`
--
ALTER TABLE `Idiomas`
  MODIFY `PK_Idioma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `LogUsuarios`
--
ALTER TABLE `LogUsuarios`
  MODIFY `PK_LogUsuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Paises`
--
ALTER TABLE `Paises`
  MODIFY `PK_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  MODIFY `PK_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `PK_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Tallas`
--
ALTER TABLE `Tallas`
  MODIFY `PK_Talla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Tiendas`
--
ALTER TABLE `Tiendas`
  MODIFY `PK_Tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `TiposPago`
--
ALTER TABLE `TiposPago`
  MODIFY `PK_TipoPago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TiposPedido`
--
ALTER TABLE `TiposPedido`
  MODIFY `PK_TipoPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TipoUsuario`
--
ALTER TABLE `TipoUsuario`
  MODIFY `PK_TipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `PK_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Carrito`
--
ALTER TABLE `Carrito`
  ADD CONSTRAINT `FK_Color` FOREIGN KEY (`FK_Color`) REFERENCES `Colores` (`PK_Color`),
  ADD CONSTRAINT `FK_Talla` FOREIGN KEY (`FK_Talla`) REFERENCES `Tallas` (`PK_Talla`),
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`FK_Producto`) REFERENCES `Productos` (`PK_Producto`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`FK_Pedido`) REFERENCES `Pedidos` (`PK_Pedido`),
  ADD CONSTRAINT `carrito_ibfk_3` FOREIGN KEY (`FK_Cliente`) REFERENCES `Clientes` (`PK_Cliente`),
  ADD CONSTRAINT `carrito_ibfk_4` FOREIGN KEY (`FK_TipoPedido`) REFERENCES `TiposPedido` (`PK_TipoPedido`),
  ADD CONSTRAINT `carrito_ibfk_5` FOREIGN KEY (`FK_Destinatario`) REFERENCES `Destinatarios` (`PK_Destinatario`);

--
-- Filtros para la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  ADD CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`FK_Pais`) REFERENCES `Paises` (`PK_Pais`);

--
-- Filtros para la tabla `Clientes`
--
ALTER TABLE `Clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`FK_Usuario`) REFERENCES `Usuarios` (`PK_Usuario`),
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`FK_Ciudad`) REFERENCES `Ciudades` (`PK_Ciudad`);

--
-- Filtros para la tabla `Destinatarios`
--
ALTER TABLE `Destinatarios`
  ADD CONSTRAINT `destinatarios_ibfk_1` FOREIGN KEY (`FK_Ciudad`) REFERENCES `Ciudades` (`PK_Ciudad`),
  ADD CONSTRAINT `destinatarios_ibfk_2` FOREIGN KEY (`FK_Cliente`) REFERENCES `Clientes` (`PK_Cliente`);

--
-- Filtros para la tabla `DetallePedidos`
--
ALTER TABLE `DetallePedidos`
  ADD CONSTRAINT `detallepedidos_ibfk_1` FOREIGN KEY (`FK_Producto`) REFERENCES `Productos` (`PK_Producto`),
  ADD CONSTRAINT `detallepedidos_ibfk_2` FOREIGN KEY (`FK_Pedido`) REFERENCES `Pedidos` (`PK_Pedido`),
  ADD CONSTRAINT `detallepedidos_ibfk_3` FOREIGN KEY (`FK_Talla`) REFERENCES `Tallas` (`PK_Talla`),
  ADD CONSTRAINT `detallepedidos_ibfk_4` FOREIGN KEY (`FK_Color`) REFERENCES `Colores` (`PK_Color`),
  ADD CONSTRAINT `detallepedidos_ibfk_5` FOREIGN KEY (`FK_TipoPedido`) REFERENCES `TiposPedido` (`PK_TipoPedido`);

--
-- Filtros para la tabla `DetalleProducto`
--
ALTER TABLE `DetalleProducto`
  ADD CONSTRAINT `detalleproducto_ibfk_1` FOREIGN KEY (`FK_Producto`) REFERENCES `Productos` (`PK_Producto`),
  ADD CONSTRAINT `detalleproducto_ibfk_2` FOREIGN KEY (`FK_Talla`) REFERENCES `Tallas` (`PK_Talla`),
  ADD CONSTRAINT `detalleproducto_ibfk_3` FOREIGN KEY (`FK_Color`) REFERENCES `Colores` (`PK_Color`);

--
-- Filtros para la tabla `LogUsuarios`
--
ALTER TABLE `LogUsuarios`
  ADD CONSTRAINT `logusuarios_ibfk_1` FOREIGN KEY (`FK_Usuario`) REFERENCES `Usuarios` (`PK_Usuario`);

--
-- Filtros para la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`FK_Destinatario`) REFERENCES `Destinatarios` (`PK_Destinatario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`FK_TipoPedido`) REFERENCES `Pedidos` (`PK_Pedido`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`FK_Cliente`) REFERENCES `Clientes` (`PK_Cliente`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`FK_Tienda`) REFERENCES `Tiendas` (`PK_Tienda`);

--
-- Filtros para la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`FK_Tienda`) REFERENCES `Tiendas` (`PK_Tienda`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`FK_Categoria`) REFERENCES `Categorias` (`PK_Categoria`);

--
-- Filtros para la tabla `RegionesEnvio`
--
ALTER TABLE `RegionesEnvio`
  ADD CONSTRAINT `regionesenvio_ibfk_1` FOREIGN KEY (`FK_Ciudad`) REFERENCES `Ciudades` (`PK_Ciudad`),
  ADD CONSTRAINT `regionesenvio_ibfk_2` FOREIGN KEY (`FK_Tienda`) REFERENCES `Tiendas` (`PK_Tienda`);

--
-- Filtros para la tabla `Tiendas`
--
ALTER TABLE `Tiendas`
  ADD CONSTRAINT `tiendas_ibfk_1` FOREIGN KEY (`FK_Ciudad`) REFERENCES `Ciudades` (`PK_Ciudad`),
  ADD CONSTRAINT `tiendas_ibfk_2` FOREIGN KEY (`FK_Usuario`) REFERENCES `Usuarios` (`PK_Usuario`);

--
-- Filtros para la tabla `TiendasTipoPago`
--
ALTER TABLE `TiendasTipoPago`
  ADD CONSTRAINT `tiendastipopago_ibfk_1` FOREIGN KEY (`FK_TipoPago`) REFERENCES `TiposPago` (`PK_TipoPago`),
  ADD CONSTRAINT `tiendastipopago_ibfk_2` FOREIGN KEY (`FK_Tienda`) REFERENCES `Tiendas` (`PK_Tienda`);

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`FK_TipoUsuario`) REFERENCES `TipoUsuario` (`PK_TipoUsuario`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`FK_Idioma`) REFERENCES `Idiomas` (`PK_Idioma`);
