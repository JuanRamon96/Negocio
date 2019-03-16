-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-03-2019 a las 03:27:28
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `negocio01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

DROP TABLE IF EXISTS `abonos`;
CREATE TABLE IF NOT EXISTS `abonos` (
  `id_abono` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de cada abono',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha en que se realizo el abono',
  `monto` double NOT NULL COMMENT 'El monto por el cual fue realizado el abono',
  `detalle_credito` int(11) NOT NULL COMMENT 'Clave de referencia del crédito al que le atribuye el abono',
  PRIMARY KEY (`id_abono`),
  KEY `detalle_credito` (`detalle_credito`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de cada cliente',
  `folio` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(150) CHARACTER SET latin1 NOT NULL COMMENT 'Nombre completo del cliente',
  `direccion` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT 'Domicilio donde vive el cliente',
  `telefono` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT 'Teléfono de localización del cliente',
  `celular` varchar(200) CHARACTER SET latin1 NOT NULL,
  `ciudad` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Ciudad donde vive el cliente',
  `colonia` varchar(150) CHARACTER SET latin1 NOT NULL,
  `codigo_postal` varchar(20) CHARACTER SET latin1 NOT NULL,
  `descuento` double NOT NULL COMMENT 'Descuento que le aplica a cada cliente en sus compras',
  `lim_credito` double NOT NULL COMMENT 'Limite de la linea de crédito del cliente',
  `correo` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Correo electrónico de localización del cliente',
  `fecha_nacimiento` date NOT NULL COMMENT 'Fecha de nacimiento del cliente',
  `sexo` varchar(10) CHARACTER SET latin1 NOT NULL COMMENT 'Sexo del cliente',
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de registro del cliente',
  `foto` varchar(300) CHARACTER SET latin1 NOT NULL,
  `rfc` varchar(50) CHARACTER SET latin1 NOT NULL,
  `empresa` varchar(200) CHARACTER SET latin1 NOT NULL,
  `no_cuenta` varchar(30) CHARACTER SET latin1 NOT NULL,
  `banco` varchar(60) CHARACTER SET latin1 NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de la compra',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha y hora de la compra',
  `usuario` int(11) NOT NULL COMMENT 'Clave de referencia del empleado que realizo la compra',
  `proveedor` int(11) NOT NULL COMMENT 'Clave de referencia del proveedor al que se le hizo la compra',
  `total` double NOT NULL COMMENT 'Monto total de la compra',
  `estatus` varchar(50) NOT NULL COMMENT 'Muestra el estado de la factura generada si ya esta pagada o pendiente de pago.',
  `clase` int(11) NOT NULL COMMENT 'Muestra la clase a la que pertenece, compra de materia prima o compra de producto a la venta.',
  `folio` varchar(250) NOT NULL,
  `dias_pagar` int(11) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `empleado` (`usuario`,`proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costos`
--

DROP TABLE IF EXISTS `costos`;
CREATE TABLE IF NOT EXISTS `costos` (
  `id_costo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro del costo.',
  `folio` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Folio que debera ser unico e irrepetible.',
  `fecha` date NOT NULL COMMENT 'Hace referencia a la fecha en que se realizo el costo.',
  `cantidad` double NOT NULL COMMENT 'Cantidad de producto ya sea en unidades enteras o medidas con punto flotante.',
  `tipo_costo` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Es el tipo de costo que se selecciona el usuario ya sea costo de producción, costos de materia prima y otros costos.',
  `otro_costo` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del costo adicional que no sea costo de materia prima, lo seleccionara el usuario como: sueldos, luz, teléfono, etc.',
  `costo` double NOT NULL COMMENT 'Costo total de la cantidad de producto por el costo unitario.',
  `observaciones` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_costo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

DROP TABLE IF EXISTS `creditos`;
CREATE TABLE IF NOT EXISTS `creditos` (
  `id_credito` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro del crédito del cliente',
  `cliente` int(11) NOT NULL COMMENT 'Clave foránea del cliente al que se le atribuye el crédito',
  `fecha_inicio` date NOT NULL COMMENT 'Fecha en la que se dio de alta el crédito del cliente',
  `interes` double NOT NULL COMMENT 'Tasa de interes que le atribuye al cliente',
  `empleado` int(11) NOT NULL COMMENT 'Clave foránea del empleado que dio de al el crédito ',
  `fecha_vencimiento` date NOT NULL COMMENT 'Fecha de vencimiento del crédito',
  PRIMARY KEY (`id_credito`),
  KEY `cliente` (`cliente`,`empleado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de departamentos',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre del departamento o área de trabajo',
  `sucursal` int(11) NOT NULL COMMENT 'Llave foránea a la sucursal que pertenece el departamento',
  PRIMARY KEY (`id_departamento`),
  KEY `sucursal` (`sucursal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

DROP TABLE IF EXISTS `detalle_compras`;
CREATE TABLE IF NOT EXISTS `detalle_compras` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro del detalle',
  `compra` int(11) NOT NULL COMMENT 'Clave de referencia de la compra a la que le atribuye el detalle',
  `producto` int(11) NOT NULL COMMENT 'Clave de referencia del producto que fue comprado',
  `cantidad` double NOT NULL COMMENT 'Cantidad del producto que fue comprado',
  `subtotal` double NOT NULL COMMENT 'Subtotal del detalle de la compra',
  `sucursal` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `compra` (`compra`,`producto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_creditos`
--

DROP TABLE IF EXISTS `detalle_creditos`;
CREATE TABLE IF NOT EXISTS `detalle_creditos` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de cada detalle',
  `producto` int(11) NOT NULL COMMENT 'Clave de referencia del producto que le atribuye la venta de crédito ',
  `credito` int(11) NOT NULL COMMENT 'Clave de referencia del credito al que le atribuye el detalle',
  `cantidad` double NOT NULL COMMENT 'Cantidad de productos de la venta del crédit ',
  PRIMARY KEY (`id_detalle`),
  KEY `producto` (`producto`,`credito`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_lotes`
--

DROP TABLE IF EXISTS `detalle_lotes`;
CREATE TABLE IF NOT EXISTS `detalle_lotes` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `lote` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `costo` double NOT NULL,
  `sucursal` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_productos`
--

DROP TABLE IF EXISTS `detalle_productos`;
CREATE TABLE IF NOT EXISTS `detalle_productos` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave ùnica de registro de del detalle',
  `producto` int(11) NOT NULL COMMENT 'Clave de referencia del producto',
  `sucursal` int(11) NOT NULL COMMENT 'Clave de referencia de la sucursal en la que se encuentra el producto',
  `cantidad` double NOT NULL COMMENT 'Cantidad de producto que se encuentra en la sucursal',
  PRIMARY KEY (`id_detalle`),
  KEY `producto` (`producto`,`sucursal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_proveedores`
--

DROP TABLE IF EXISTS `detalle_proveedores`;
CREATE TABLE IF NOT EXISTS `detalle_proveedores` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave ùnica de registro del detalle',
  `proveedor` int(11) NOT NULL COMMENT 'Clave de referencia del proveedor al que le atribuye el producto de compra',
  `producto` int(11) NOT NULL COMMENT 'Clave de referencia del producto que vende el proveedor',
  PRIMARY KEY (`id_detalle`),
  KEY `proveedor` (`proveedor`,`producto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE IF NOT EXISTS `detalle_ventas` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de cada detalle de una venta',
  `venta` int(11) NOT NULL COMMENT 'Clave de referencia de la venta que se detalla',
  `producto` int(11) NOT NULL COMMENT 'Clave de referencia del producto que fue vendido',
  `cantidad` double NOT NULL COMMENT 'Cantidad del producto que fue vendido',
  `subtotal` double NOT NULL COMMENT 'Subtotal de del detalle de la venta',
  PRIMARY KEY (`id_detalle`),
  KEY `venta` (`venta`,`producto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro del empleado',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre completo del empleado',
  `direccion` varchar(250) NOT NULL COMMENT 'Domicilio del empleado',
  `colonia` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL COMMENT 'Numero telefónico del empleado',
  `celular` varchar(25) NOT NULL,
  `ciudad` varchar(80) NOT NULL COMMENT 'Ciudad donde vive el empleado',
  `correo` varchar(100) NOT NULL COMMENT 'Correo electrónico del empleado',
  `fecha_nacimiento` date NOT NULL COMMENT 'Fecha de nacimiento del empleado',
  `fecha_entrada` date NOT NULL COMMENT 'Fecha en que inicio a laborar el empleado',
  `puesto` varchar(250) NOT NULL COMMENT 'Clave de referencia de la tabla puestos',
  `sueldo` double NOT NULL COMMENT 'Sueldo que gana el empleado semanalmente',
  `horario` varchar(100) NOT NULL COMMENT 'Horario de trabajo del empleado',
  `sexo` varchar(10) NOT NULL COMMENT 'Sexo del empleado',
  `foto` varchar(300) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `puesto` (`puesto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `fecha_act` date DEFAULT NULL,
  `hora_act` time DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

DROP TABLE IF EXISTS `lotes`;
CREATE TABLE IF NOT EXISTS `lotes` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero único de registro de cada lote de productos',
  `codigo` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Código único del lote, este mismo sera ingresado por el usuario.',
  `fecha_inicio` date NOT NULL COMMENT 'Fecha en la que se inicio a elaborar este lote de producto.',
  `fecha_final` date NOT NULL COMMENT 'Fecha en la que concluyó la elaboración del producto.',
  `producto` int(11) NOT NULL COMMENT 'Hace referencia al producto que se elaboro de la tabla de productos.',
  `cantidad` double NOT NULL COMMENT 'Es la cantidad de productos produjo este lote.',
  `sucursal` int(11) NOT NULL,
  `estatus` char(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Este campo muestra el estado del lote, ya sea en proceso o terminado',
  PRIMARY KEY (`id_lote`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `modulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `movimiento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cookie` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_movimiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL COMMENT 'Hace referencia al id del usuario al que le atribuye la notificacion.',
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre de la notificacion.',
  `descripcion` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Una breve descripcion de la notificacion.',
  `fecha` date NOT NULL COMMENT 'Fecha en la que se activara la notificacion.',
  `modulo` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_modulo` int(11) NOT NULL,
  PRIMARY KEY (`id_notificacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `compra` int(11) NOT NULL COMMENT 'Hace referencia al id de la compra.',
  `monto` double NOT NULL COMMENT 'Monto en pesos del pago realizado para la nota seleccionada.',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha exacta en la que se realizo el pago.',
  PRIMARY KEY (`id_pago`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro del producto',
  `codigo` varchar(300) NOT NULL COMMENT 'Código que se asigna al producto, debe de ser único e irrepetible.',
  `nombre` varchar(250) NOT NULL COMMENT 'Nombre del producto',
  `descripcion` text NOT NULL COMMENT 'Descripción del producto',
  `costo` double NOT NULL COMMENT 'Cantidad de dinero que costo el proucto',
  `precio` double NOT NULL COMMENT 'Precio del producto al publico',
  `tipo` varchar(100) NOT NULL COMMENT 'Tipo de producto (botones, blondas, cierres, etc) ',
  `material` varchar(100) NOT NULL COMMENT 'Material con el que esta hecho el producto en caso necesario de especificar como en telas',
  `categoria` varchar(100) NOT NULL COMMENT 'Categoría a la que pertenece el producto',
  `foto` varchar(300) NOT NULL,
  `fecha_ingreso` date NOT NULL COMMENT 'Se ingresa la fecha que aparece por primera vez el producto',
  `clase` varchar(60) NOT NULL COMMENT 'Especifica que clase de producto es, si es materia prima o producto directo para su venta',
  `medida` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro del proveedor',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre completo del proveedor',
  `direccion` varchar(200) NOT NULL COMMENT 'Domicilio del proveedor',
  `telefono` varchar(300) NOT NULL COMMENT 'Teléfono de contacto del proveedor',
  `ciudad` varchar(100) NOT NULL COMMENT 'Ciudad donde vive o trabaja el proveedor',
  `empresa` varchar(200) NOT NULL COMMENT 'Nombre de la empresa a la que pertenece el proveedor',
  `colonia` varchar(250) NOT NULL COMMENT 'Se refiere a la colonia de la ubicación del proveedor.',
  `codigo_postal` varchar(100) NOT NULL COMMENT 'Es el codigo postal del proveedor.',
  `puesto` varchar(150) NOT NULL COMMENT 'Es el puesto en el que se desempeña el contacto.',
  `correo` varchar(150) NOT NULL COMMENT 'Correo electronico del contacto.',
  `rfc` varchar(150) NOT NULL COMMENT 'Rfc de la empresa, sirve para facturar.',
  `credito` varchar(100) NOT NULL COMMENT 'Señala el monto o tiempo que ofrecen para pagar.',
  `celular` varchar(300) NOT NULL,
  `no_cuenta` varchar(30) NOT NULL,
  `banco` varchar(30) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

DROP TABLE IF EXISTS `puestos`;
CREATE TABLE IF NOT EXISTS `puestos` (
  `id_puesto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro del puesto',
  `nombre` varchar(150) NOT NULL COMMENT 'Nombre del puesto del departamento',
  `departamento` int(11) NOT NULL COMMENT 'Clave de referencia del departamento al que pertenece el puesto',
  PRIMARY KEY (`id_puesto`),
  KEY `departamento` (`departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
CREATE TABLE IF NOT EXISTS `sucursales` (
  `id_sucursal` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de cada sucursal',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre de la tienda o sucursal',
  `direccion` varchar(150) NOT NULL COMMENT 'Domicilio de cada sucursal',
  `telefono` varchar(20) NOT NULL COMMENT 'Teléfono de la sucursal',
  PRIMARY KEY (`id_sucursal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave unica de registro de usuario',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre completo del usuario',
  `usuario` varchar(100) NOT NULL COMMENT 'Correo electroico del usuario',
  `contrasena` varchar(100) NOT NULL COMMENT 'Contraseña del usuario',
  `estatus` char(20) NOT NULL COMMENT 'Estatus del usuario (Bloqueado o Desbloqueado)',
  `permisos` varchar(100) NOT NULL COMMENT 'Cadena de números para referenciar a los permisos a los que se tienen acceso',
  `intentos` int(11) NOT NULL COMMENT 'Numero de veces que intenta acceder un usuario erroneamente',
  `ultimointento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha del ultimo intento de inicio de sesión',
  `foto` varchar(300) NOT NULL,
  `sesion` int(11) NOT NULL,
  `tiempo_inicio` datetime NOT NULL,
  `tiempo_final` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `contrasena`, `estatus`, `permisos`, `intentos`, `ultimointento`, `foto`, `sesion`, `tiempo_inicio`, `tiempo_final`) VALUES
(1, 'Usuario Ejemplo', 'ing.luis.ra@gmail.com', 'a2720eff0ba78bd7722ea504bf740b36', 'Desbloqueado', '1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;', 1, '2019-03-16 02:56:23', 'b9e2_UsuarioEjemplo.jpg', 0, '2019-03-06 02:33:28', '2019-03-15 20:56:23'),
(7, 'Jessica Lizareli', 'jessicar_12@hotmail.com', '2378abc7bd7bb37cd33b00b9073e16f1', 'Desbloqueado', '1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;', 0, '2018-02-22 17:39:24', 'c3ee_JessicaLizareli.jpg', 1, '2018-02-22 11:27:29', '2015-02-03 23:16:54'),
(18, 'Ejemplo', 'ejemplo@gmail.com', 'a2720eff0ba78bd7722ea504bf740b36', 'Desbloqueado', '1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;1,1,1,1;', 0, '2019-03-06 07:46:15', 'b9e2_UsuarioEjemplo.jpg', 1, '2018-11-13 18:36:41', '2018-10-19 22:18:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de la venta',
  `cliente` int(11) NOT NULL COMMENT 'Clave de referencia del cliente al que le atribuye la venta',
  `usuario` int(11) NOT NULL COMMENT 'Clave de referencia del usuario que realizo la venta',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha y tiempo en que se realizo la venta',
  `total` double NOT NULL COMMENT 'Suma del subtotal de la tabla de detalle de ventas',
  `descuento` double NOT NULL COMMENT 'Este campo se llenara automáticamente con el descuento que tiene el cliente seleccionado pero se podrá modificar.',
  `folio` varchar(100) NOT NULL,
  `estatus` varchar(50) NOT NULL,
  `dias_pagar` int(11) NOT NULL,
  `iva` int(11) NOT NULL COMMENT 'Su estado solo sera de 0 para falso y 1 para verdadero',
  `sucursal` int(11) NOT NULL COMMENT 'Hace referencia al id de la tabla de sucursales',
  `tipo_venta` varchar(50) NOT NULL COMMENT 'Se ingresa el tipo de venta realizado, ya sea contado, crédito o pedido',
  PRIMARY KEY (`id_venta`),
  KEY `cliente` (`cliente`,`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
