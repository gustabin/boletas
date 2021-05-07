-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2021 a las 14:07:44
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boletas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `nombre`) VALUES
(1, 'ABN AMRO'),
(2, 'BACS'),
(3, 'Banco Bica'),
(4, 'Banco Bradesco'),
(5, 'Banco Cetelem'),
(6, 'Banco Ciudad'),
(7, 'Banco CMF'),
(8, 'Banco Coinag'),
(9, 'Banco Columbia'),
(10, 'Banco Comafi'),
(11, 'Banco Credicoop'),
(12, 'Banco de Comercio'),
(13, 'Banco de Córdoba'),
(14, 'Banco de Corrientes'),
(15, 'Banco de Formosa'),
(16, 'Banco de La Pampa'),
(17, 'Banco de la República Oriental del Uruguay'),
(18, 'Banco de San Juan'),
(19, 'Banco de Santiago del Estero'),
(20, 'Banco de Servicios Financieros'),
(21, 'Banco de Servicios y Transacciones'),
(22, 'Banco de Tierra del Fuego'),
(23, 'Banco de Valores'),
(24, 'Banco del Chubut'),
(25, 'Banco del Sol'),
(26, 'Banco do Brasil'),
(27, 'Banco Finansur'),
(28, 'Banco Galicia'),
(29, 'Banco Hipotecario'),
(30, 'Banco Industrial'),
(31, 'Banco Interfinanzas'),
(32, 'Banco Itaú'),
(33, 'Banco Julio'),
(34, 'Banco Macro'),
(35, 'Banco Mariva'),
(36, 'Banco Masventas'),
(37, 'Banco Meridian'),
(38, 'Banco Municipal de Rosario'),
(39, 'Banco Nación'),
(40, 'Banco Patagonia'),
(41, 'Banco Piano'),
(42, 'Banco Provincia'),
(43, 'Banco Provincia del Neuquén'),
(44, 'Banco Rioja'),
(45, 'Banco Roela'),
(46, 'Banco Saenz'),
(47, 'Banco Santa Cruz'),
(48, 'Banco Santander Río'),
(49, 'Banco Supervielle'),
(50, 'Banco Tucumán'),
(51, 'Banco Voii'),
(52, 'Bank of America'),
(53, 'Bank of Tokyo-Mitsubishi UFJ'),
(54, 'BBVA Banco Francés'),
(55, 'BICE'),
(56, 'BNP Paribas'),
(57, 'Citibank'),
(58, 'Deutsche Bank'),
(59, 'HSBC Bank'),
(60, 'ICBC'),
(61, 'J.P. Morgan'),
(62, 'Nuevo Banco de Entre Ríos'),
(63, 'Nuevo Banco de Santa Fe'),
(64, 'Nuevo Banco del Chaco'),
(65, 'RCI Banque'),
(66, 'Wilobank');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaempleados`
--

CREATE TABLE `categoriaempleados` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=Inactivo; 1=Activo	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoriaempleados`
--

INSERT INTO `categoriaempleados` (`id`, `idsindicato`, `nombre`, `fecha`, `status`) VALUES
(1, 6, 'Personal administrativo', '2021-04-15 09:47:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `porcentaje` int(2) NOT NULL,
  `formula` varchar(100) COLLATE utf8_spanish2_ci DEFAULT '1',
  `confirma` int(1) NOT NULL COMMENT '1=con confirmacion, 2=sin confirmacion',
  `importecantidad` int(1) NOT NULL COMMENT '1=importe,2=cantidad',
  `seimprime` int(1) NOT NULL COMMENT '1=se imprime, 2=no se imprime',
  `conceptoasociado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `debitocredito` int(1) NOT NULL COMMENT '1=suma, 2=resta',
  `idtipoboleta` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=Inactivo; 1=Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`id`, `idsindicato`, `nombre`, `descripcion`, `porcentaje`, `formula`, `confirma`, `importecantidad`, `seimprime`, `conceptoasociado`, `debitocredito`, `idtipoboleta`, `fecha`, `status`) VALUES
(12, 6, 'C100', 'SUELDO BRUTO', 1, '1', 2, 2, 1, '', 1, 1, '2021-03-08 15:07:48', 1),
(13, 6, 'C110', '% Categoría', 0, '1', 0, 1, 2, '0', 1, 1, '2021-03-08 15:39:15', 1),
(17, 6, 'C111', 'Categoría', 0, 'C100 * C110 /100', 0, 1, 1, 'C111', 1, 1, '2021-03-08 16:37:42', 1),
(18, 6, 'C120', '% Capacitación', 0, '1', 0, 1, 2, '', 1, 1, '2021-03-08 16:42:36', 1),
(19, 6, 'C121', 'Capacitación', 12, 'C100 * C120 / 100', 1, 1, 1, 'C120', 1, 1, '2021-03-08 16:43:40', 1),
(20, 6, 'C130', '% AF/AB', 0, '1', 0, 1, 2, '', 2, 1, '2021-03-08 16:47:39', 1),
(21, 6, 'C131', 'AF/AB', 10, 'C100 * C130 / 100', 1, 1, 1, 'C130', 2, 1, '2021-03-17 08:00:47', 1),
(22, 6, 'C140', '% Gestión', 0, '', 1, 1, 2, '0', 2, 1, '2021-04-01 07:52:03', 1),
(23, 6, 'C141', 'Gestión', 20, 'C100 * C140 / 100', 1, 1, 1, 'C140', 2, 1, '2021-04-01 07:53:03', 1),
(24, 6, 'C150', '% Elaboración', 0, '1', 1, 1, 2, '', 2, 1, '2021-04-01 07:53:51', 1),
(25, 6, 'C151', 'Elaboración', 10, 'C100 * C150 / 100', 1, 1, 1, 'C150', 2, 1, '2021-04-01 07:53:51', 1),
(26, 6, 'C160', '% Presentismo', 0, '1', 1, 1, 2, '', 1, 1, '2021-04-01 07:53:51', 1),
(27, 6, 'C161', 'Presentismo', 10, 'C100 * C160 / 100', 1, 1, 1, 'C160', 1, 1, '2021-04-01 07:53:51', 1),
(28, 6, 'C170', '% Idioma', 0, '1', 1, 1, 2, '', 1, 1, '2021-04-01 07:53:51', 1),
(29, 6, 'C171', 'Idioma', 10, 'C100 * C170 / 100', 1, 1, 1, 'C170', 1, 1, '2021-04-01 07:53:51', 1),
(30, 6, 'C180', '% Domicilio', 0, '1', 1, 1, 2, '', 1, 1, '2021-04-01 07:53:51', 1),
(31, 6, 'C181', 'Domicilio', 5, 'C100 * C120 / 100', 1, 1, 1, 'C180', 1, 1, '2021-04-01 07:53:51', 1),
(32, 6, 'C190', '% Zona', 0, '1', 1, 1, 2, '', 1, 1, '2021-04-01 07:53:51', 1),
(33, 6, 'C191', 'Zona', 0, 'C100 * C120 / 100', 1, 1, 1, 'C190', 1, 1, '2021-04-01 07:53:51', 1),
(34, 6, 'C300', 'SUELDO IMPONIBLE', 0, 'C100 + C110 + C120 + C130 + C140 + C150 + C160 + C170 + C180 + C190', 1, 1, 1, '', 1, 1, '2021-04-01 07:53:51', 1),
(35, 6, 'C310', 'ANTIGÜEDAD', 0, 'AÑOS / 100 * C300', 1, 1, 1, '', 1, 1, '2021-04-01 07:53:51', 1),
(36, 6, 'C320', 'OTROS', 0, '1', 1, 1, 1, '', 1, 1, '2021-04-01 07:53:51', 1),
(37, 6, 'C400', 'SUELDO INTEGRAL', 0, 'C300 + C310 + C320', 0, 1, 0, '', 1, 1, '2021-04-01 07:53:51', 1),
(38, 6, 'C500', 'Capacitación', 0, 'C100 * 0,05', 0, 0, 0, '', 1, 1, '2021-04-01 07:53:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`) VALUES
(77, 'Oikosplus Corporation'),
(78, 'Jeff Bezos'),
(79, 'Bill Gates'),
(80, 'Warren Buffett'),
(81, 'Bernard Arnault'),
(82, 'Larry Ellison'),
(83, 'Amancio Ortega');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=Inactivo; 1=Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `nombre`, `fecha`, `status`) VALUES
(1, 'Documento Unico de Identidad', '2021-01-11 16:07:54', 1),
(2, 'Fé bautismal', '2021-01-11 16:07:54', 1),
(3, 'Constancia de estudio', '2021-01-11 16:08:01', 0),
(4, 'Visa', '2021-01-11 16:08:10', 0),
(5, 'Acta de nacimiento', '2021-01-13 07:40:22', 2),
(6, 'Pasaporte', '2021-01-13 08:39:06', 2),
(7, 'Documentación original', '2021-02-20 13:34:23', 1),
(8, 'Acta de defunción', '2021-02-25 16:53:48', 1),
(9, 'Acta de matrimonio', '2021-02-25 16:54:19', 1),
(10, 'Cartilla militar', '2021-02-25 16:54:31', 1),
(11, 'Cédula profesional', '2021-02-25 16:54:42', 0),
(12, 'Certificado médico', '2021-02-25 16:54:54', 1),
(13, 'Contrato', '2021-02-25 16:55:02', 1),
(14, 'Credencial de elector', '2021-02-25 16:55:12', 1),
(15, 'Garantía', '2021-02-25 16:55:20', 1),
(16, 'Licencia de manejo', '2021-02-25 16:55:41', 1),
(17, 'Pagarés', '2021-02-25 16:55:50', 1),
(18, 'Pasaporte', '2021-02-25 16:56:04', 1),
(19, 'Testamento', '2021-02-25 16:56:15', 1),
(20, 'Remito', '2021-02-25 16:57:00', 1),
(21, 'Recibo', '2021-02-25 16:57:08', 1),
(22, 'Nota de crédito y Nota de débito', '2021-02-25 16:57:17', 0),
(23, 'Cheque', '2021-02-25 16:57:26', 1),
(24, 'Comprobante de las tarjetas de crédito', '2021-02-25 16:57:37', 0),
(25, 'Extractos bancarios', '2021-02-25 16:57:46', 1),
(26, 'test', '2021-03-15 20:27:21', 2),
(27, 'test', '2021-03-15 21:06:14', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `seccional` int(2) NOT NULL,
  `numero` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `codpostal` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `idprovincia` int(11) NOT NULL,
  `ramo` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `contacto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaalta` datetime NOT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `fechabaja` datetime DEFAULT NULL,
  `idempresaantecedente` int(11) DEFAULT NULL,
  `idempresaprecedente` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=Inactivo; 1=Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `idsindicato`, `nombre`, `cuit`, `seccional`, `numero`, `direccion`, `localidad`, `codpostal`, `idprovincia`, `ramo`, `email`, `contacto`, `fechaalta`, `fechamodificacion`, `fechabaja`, `idempresaantecedente`, `idempresaprecedente`, `fecha`, `status`) VALUES
(1, 6, 'Policlínico Central ', '20959018082', 2, 2, 'Sarmiento 2036 Piso 2 Dpto B', 'San Cristobal', '1717', 1, 1, 'comercio@test.com', 'Luis Gonzalez', '2021-02-01 00:00:00', '2021-03-08 00:00:00', '0000-00-00 00:00:00', 2, 6, '2021-01-13 11:39:40', 1),
(7, 7, 'Multiservicios el gaucho s.a.', '20807060504', 1, 2, 'Egipto 566 Piso 9 Ofic A', 'Avellaneda', '1765', 1, 1, 'test@test.com', 'Silvio Dessy', '2021-04-16 14:12:25', NULL, NULL, NULL, NULL, '2021-04-16 14:12:25', 1),
(8, 8, 'Oikosplus Corporation', '45675423456', 2, 2, 'Av Sarmiento 3300 Piso 3 Ofic D', 'Almagro', '1173', 2, 2, 'panadeiro@joaopan.com', 'Roberto Galván', '2021-04-21 15:15:40', NULL, NULL, NULL, NULL, '2021-04-21 15:15:40', 1),
(9, 6, 'Oikosplus Corporation', '20437912812', 3, 1, 'Egipto 566 Piso 9 Ofic A', 'Avellaneda', '1765', 1, 1, 'test@test.com', 'Roberto Galván', '2021-04-28 09:54:59', NULL, NULL, NULL, NULL, '2021-04-28 09:54:59', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresaslogin`
--

CREATE TABLE `empresaslogin` (
  `id` int(11) NOT NULL,
  `cuit` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esquema`
--

CREATE TABLE `esquema` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `texto1boleta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `texto2boleta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `texto3boleta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `texto4boleta` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `textoNomina` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `logovertical` int(1) NOT NULL COMMENT '1=izquierda,2=centro,3=derecha',
  `logohorizontal` int(1) NOT NULL COMMENT '1=arriba,2=centro,3=abajo',
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '	0=Inactivo; 1=Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `esquema`
--

INSERT INTO `esquema` (`id`, `idsindicato`, `texto1boleta`, `texto2boleta`, `texto3boleta`, `texto4boleta`, `textoNomina`, `logovertical`, `logohorizontal`, `fecha`, `status`) VALUES
(1, 6, 'Aportes que componen la boleta', 'Deposito con impago', 'Periodo abonado', 'Cuota sindical', 'Nómina mensual', 1, 1, '2021-04-24 14:31:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivil`
--

CREATE TABLE `estadocivil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estadocivil`
--

INSERT INTO `estadocivil` (`id`, `nombre`) VALUES
(1, 'Soltero'),
(3, 'Viudo'),
(4, 'Separado'),
(6, 'Divorciado'),
(7, 'Conviviente'),
(20, 'Casado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialnomina`
--

CREATE TABLE `historialnomina` (
  `id` int(11) NOT NULL,
  `periodo` varchar(7) COLLATE utf8_spanish2_ci NOT NULL,
  `tipoboleta` int(1) NOT NULL,
  `cuit` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `cuil` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `idconcepto` varchar(300) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `historialnomina`
--

INSERT INTO `historialnomina` (`id`, `periodo`, `tipoboleta`, `cuit`, `cuil`, `idconcepto`) VALUES
(5, '2021/01', 0, '20959018082', '1010101010', '12,13,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `importeseguro`
--

CREATE TABLE `importeseguro` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `vigenciadesde` date NOT NULL,
  `vigenciahasta` date NOT NULL,
  `importe` decimal(6,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Inactivo; 1=Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `importeseguro`
--

INSERT INTO `importeseguro` (`id`, `idsindicato`, `nombre`, `vigenciadesde`, `vigenciahasta`, `importe`, `fecha`, `status`) VALUES
(1, 6, 'Polizas de trabajo', '2021-01-01', '2021-01-06', '101.48', '2021-04-24 14:17:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidades`
--

CREATE TABLE `nacionalidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `nacionalidades`
--

INSERT INTO `nacionalidades` (`id`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Alemania'),
(3, 'Bolivia'),
(4, 'Brasil'),
(5, 'Chile'),
(6, 'España'),
(7, 'Estados Unidos'),
(8, 'Francia'),
(9, 'Paraguay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `idpadron` int(11) NOT NULL,
  `cuil` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `sueldo` decimal(8,2) NOT NULL,
  `idcategoriaempleado` int(11) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `idusuarioalta` int(11) NOT NULL,
  `idusuariomodificacion` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Inactivo; 1=Activo	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `nomina`
--

INSERT INTO `nomina` (`id`, `idsindicato`, `idempresa`, `idpadron`, `cuil`, `sueldo`, `idcategoriaempleado`, `fechaalta`, `fechamodificacion`, `idusuarioalta`, `idusuariomodificacion`, `fecha`, `status`) VALUES
(3, 6, 1, 5, '1010101010', '196700.00', 1, '2021-04-27 16:45:57', NULL, 2, NULL, '2021-04-27 16:45:57', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padron`
--

CREATE TABLE `padron` (
  `id` int(11) NOT NULL,
  `documento` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `cuil` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` int(1) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `provincia` int(11) NOT NULL,
  `nacimiento` date NOT NULL,
  `idestadocivil` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `idseccional` int(11) NOT NULL,
  `idnacionalidad` int(11) NOT NULL,
  `idsituacionrevista` int(11) NOT NULL,
  `idcategoriaempleado` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `idtipodocumento` int(11) NOT NULL,
  `baja` date DEFAULT NULL,
  `alta` date DEFAULT NULL,
  `modificacion` datetime DEFAULT NULL,
  `idusuariobaja` int(11) DEFAULT NULL,
  `idusuarioalta` int(11) NOT NULL,
  `idusuariomodificacion` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Inactivo; 1=Activo; 2=Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `padron`
--

INSERT INTO `padron` (`id`, `documento`, `cuil`, `nombre`, `apellido`, `sexo`, `telefono`, `direccion`, `localidad`, `provincia`, `nacimiento`, `idestadocivil`, `idsindicato`, `idseccional`, `idnacionalidad`, `idsituacionrevista`, `idcategoriaempleado`, `idempresa`, `idtipodocumento`, `baja`, `alta`, `modificacion`, `idusuariobaja`, `idusuarioalta`, `idusuariomodificacion`, `fecha`, `status`) VALUES
(210, '9685258', '11958678811', 'Leonardo', 'Freites', 0, '11828621', 'Viamonte 5509 Piso 4 Dpto B', 'Doral', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(211, '18654667', '12056543241', 'Paul', 'Gomez', 0, '12676543', 'Gascon 4629 Piso 3 Dpto 15', 'Balvanera', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(212, '43534325', '12147483642', 'Carlos', 'Lima', 0, '65374722', 'Mario Bravo 4656 Piso 2 Dpto A', 'Almagro', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(213, '67376787', '12355676562', 'Marcelo', 'Colmenares', 0, '11256756', 'Av Pueyrredon 9545 piso 4 Dpto 1', 'Palermo', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(214, '11202120', '19118083372', 'Gustavo', 'Duque', 0, '25828688', 'Arenales 626 Piso 3 Dpto A', 'Colegiales', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(215, '9685258', '19425867861', 'Laura', 'Perez', 0, '11288688', 'Paraguay 670 Piso 1 Dpto B', 'Monserrat', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(216, '34567544', '19867543451', 'German', 'Morales', 0, '11253537', 'Av Rivadavia 4647 Piso 5 Dpto B', 'Villa Crespo', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(217, '56798764', '19875456762', 'Jorge', 'Laguna', 0, '43564425', 'Tucuman 3535 Piso 2 Dpto C', 'Caballito', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, '0000-00-00', NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0),
(218, '87656345', '20959018082', 'Carmen', 'Duran', 0, '62672724', 'Tucuman 3434 Piso 2 Dpto A', 'Caballito', 1, '0000-00-00', 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 2, NULL, '2021-04-28 14:58:44', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `idbanco` int(11) NOT NULL,
  `idboleta` int(11) NOT NULL,
  `fechapago` date NOT NULL,
  `importe` decimal(6,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Inactivo; 1=Activo; 2=Eliminado	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(1, 'Capital Federal'),
(2, 'Buenos Aires'),
(3, 'Catamarca'),
(4, 'Chaco'),
(5, 'Chubut'),
(6, 'Córdoba'),
(7, 'Corrientes'),
(8, 'Entre Ríos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ramos`
--

CREATE TABLE `ramos` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '	0=Inactivo; 1=Activo	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ramos`
--

INSERT INTO `ramos` (`id`, `idsindicato`, `nombre`, `fecha`, `status`) VALUES
(1, 6, 'Administrativo', '2021-01-13 14:24:36', 1),
(2, 8, 'Metalmecanico', '2021-04-21 15:14:30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `accesos` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Inactivo; 1=Activo; 2=Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `accesos`, `fecha`, `status`) VALUES
(1, 'Administrador', 'Genera Los Permisos De Los Usuarios Del Sistema Programadores Creadores De Funcionalidad.', 'Clientes;Bancos;CategoriaEmpleados;Conceptos;Documentos;Empresas;EmpresasLogin;Esquema;EstadoCivil;ImporteSeguro;Nacionalidades;Nomina;Pagos;Provincias;Ramas;Rol;Seteos;SituacionRevista;TasaInteres;TipoDocumento;Usuarios;Vencimiento;Contacto;Padron;Sindicato;Seccional;Recibos;Importar;Tipoboleta', '2021-01-19 17:01:18', 1),
(2, 'Sindicatos', 'Encargado De Administrar El Acceso De Las Empresas Pertenecientes A Su Organizacion.', 'Clientes;Bancos;CategoriaEmpleados;Conceptos;Documentos;Empresas;EmpresasLogin;Esquema;EstadoCivil;ImporteSeguro;Nacionalidades;Nomina;Pagos;Provincias;Ramas;Rol;Seteos;SituacionRevista;TasaInteres;TipoDocumento;Usuarios;Vencimiento;Contacto;Padron;Sindicato;Seccional;Recibos;Importar;Tipoboleta', '2021-01-30 13:28:38', 1),
(3, 'Empresas', 'Responsable De Gestionar La Informacion Correspondiente A Sus Empleados.', 'Clientes;Bancos;CategoriaEmpleados;;;;;;;;;;;;Ramas;;;;;;;;;;;;;;', '2021-02-03 15:39:15', 1),
(4, 'Operador', 'Usuario normal con acceso básico al sistema', 'Clientes;Bancos;;;Documentos;;;;EstadoCivil;;Nacionalidades;;;;Ramas;;;SituacionRevista;;;;;Contacto;;;;;;', '2021-03-17 07:43:17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccional`
--

CREATE TABLE `seccional` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0=Inactiva; 1=Activa; 2=Eliminada\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `seccional`
--

INSERT INTO `seccional` (`id`, `idsindicato`, `nombre`, `fecha`, `status`) VALUES
(1, 6, 'Sán Nicolas', '2021-04-15 09:45:45', 1),
(3, 6, 'Unica', '2021-04-28 09:54:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seteos`
--

CREATE TABLE `seteos` (
  `id` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `idboleta` int(11) NOT NULL,
  `cuentabna` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `cbu` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sindicatos`
--

CREATE TABLE `sindicatos` (
  `id` int(11) NOT NULL,
  `razonsocial` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Inactivo; 1=Activo; 2=Eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sindicatos`
--

INSERT INTO `sindicatos` (`id`, `razonsocial`, `cuit`, `direccion`, `fecha`, `status`) VALUES
(6, 'UOM Unión Obrera Metalúrgica', '543535455', 'Adolfo Alsina 477 CABA 1087', '2021-02-20 14:45:25', 1),
(7, 'Actores Asociación Argentina De Actores', '1234567890', 'Av Sarmiento 3300 Piso 3 Ofic D', '2021-04-16 12:30:38', 1),
(8, 'test', '1020304050', 'Av Cordoba 3450', '2021-04-21 15:12:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacionrevista`
--

CREATE TABLE `situacionrevista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `situacionrevista`
--

INSERT INTO `situacionrevista` (`id`, `nombre`) VALUES
(1, 'Normal'),
(2, 'Recibe haberes regularmente'),
(10, 'Maternidad'),
(11, 'Reserva por enfermedad'),
(12, 'Reserva Accidente'),
(13, 'Desempleo'),
(14, 'Licencia extraordinaria'),
(15, 'Contrato'),
(99, 'Desconocida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasainteres`
--

CREATE TABLE `tasainteres` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `vigenciadesde` date NOT NULL,
  `vigenciahasta` date NOT NULL,
  `porcentaje` decimal(3,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '	0=Inactivo; 1=Activo	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tasainteres`
--

INSERT INTO `tasainteres` (`id`, `idsindicato`, `vigenciadesde`, `vigenciahasta`, `porcentaje`, `fecha`, `status`) VALUES
(2, 6, '2021-01-01', '2021-04-24', '4.50', '2021-04-24 14:30:24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoboleta`
--

CREATE TABLE `tipoboleta` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=Inactivo; 1=Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipoboleta`
--

INSERT INTO `tipoboleta` (`id`, `idsindicato`, `nombre`, `fecha`, `status`) VALUES
(1, 6, 'Boleta Especial', '2021-04-22 09:47:20', 1),
(3, 6, 'Ajustes sindicales', '2021-04-22 09:48:20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `nombre`) VALUES
(1, 'DU Documento Unico'),
(2, 'LE Libreta Enrolamiento'),
(3, 'LC Libreta Civica'),
(4, 'PA Pasaporte'),
(5, 'CM Certificado Migrator');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cuil` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `rolid` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `idempresa`, `nombre`, `apellido`, `telefono`, `email`, `password`, `cuil`, `direccion`, `rolid`, `fecha`, `status`) VALUES
(1, 1, 'Alejandro', 'Sansoni', '1144343251', 'sansoniale@gmail.com', 'Z05CMUhvQ1NHRjVrUnhpY3Y4bnl5QT09', 2147483647, 'Av Hipolito Yrigoyen', 1, '2021-01-07 17:44:50', 1),
(2, 1, 'Gustavo', 'Arias', '1128927594', 'gustabin@yahoo.com', 'Z05CMUhvQ1NHRjVrUnhpY3Y4bnl5QT09', 2134567, 'Sanchez de Bustamante 444', 1, '2021-01-07 07:37:08', 1),
(3, 1, 'Daniel', 'Zapata', '1161805923', 'zapatadaniel@hotmail.com', 'Z05CMUhvQ1NHRjVrUnhpY3Y4bnl5QT09', 324567578, 'Buenos Aires', 1, '2021-01-07 17:48:55', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vencimiento`
--

CREATE TABLE `vencimiento` (
  `id` int(11) NOT NULL,
  `idsindicato` int(11) NOT NULL,
  `periodo` date NOT NULL,
  `cuit0` int(2) NOT NULL,
  `cuit1` int(2) NOT NULL,
  `cuit2` int(2) NOT NULL,
  `cuit3` int(2) NOT NULL,
  `cuit4` int(2) NOT NULL,
  `cuit5` int(2) NOT NULL,
  `cuit6` int(2) NOT NULL,
  `cuit7` int(2) NOT NULL,
  `cuit8` int(2) NOT NULL,
  `cuit9` int(2) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Inactivo; 1=Activo	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `vencimiento`
--

INSERT INTO `vencimiento` (`id`, `idsindicato`, `periodo`, `cuit0`, `cuit1`, `cuit2`, `cuit3`, `cuit4`, `cuit5`, `cuit6`, `cuit7`, `cuit8`, `cuit9`, `fecha`, `status`) VALUES
(1, 6, '2021-04-24', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, '2021-04-24 14:30:45', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriaempleados`
--
ALTER TABLE `categoriaempleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`),
  ADD KEY `idtipoboleta` (`idtipoboleta`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuit` (`cuit`),
  ADD KEY `ramo` (`ramo`);

--
-- Indices de la tabla `empresaslogin`
--
ALTER TABLE `empresaslogin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esquema`
--
ALTER TABLE `esquema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- Indices de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historialnomina`
--
ALTER TABLE `historialnomina`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `periodo` (`periodo`,`cuil`),
  ADD KEY `cuit` (`cuit`),
  ADD KEY `cuil` (`cuil`);

--
-- Indices de la tabla `importeseguro`
--
ALTER TABLE `importeseguro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- Indices de la tabla `nacionalidades`
--
ALTER TABLE `nacionalidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuil_2` (`cuil`),
  ADD KEY `idsindicato` (`idsindicato`),
  ADD KEY `cuil` (`cuil`);

--
-- Indices de la tabla `padron`
--
ALTER TABLE `padron`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuil` (`cuil`),
  ADD KEY `provincia` (`provincia`),
  ADD KEY `idestadocivil` (`idestadocivil`),
  ADD KEY `idseccional` (`idseccional`),
  ADD KEY `idsindicato` (`idsindicato`),
  ADD KEY `idnacionalidad` (`idnacionalidad`),
  ADD KEY `idrevista` (`idsituacionrevista`),
  ADD KEY `idcategoriaempleado` (`idcategoriaempleado`),
  ADD KEY `idempresa` (`idempresa`),
  ADD KEY `idtipodocumento` (`idtipodocumento`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idbanco` (`idbanco`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ramos`
--
ALTER TABLE `ramos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccional`
--
ALTER TABLE `seccional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- Indices de la tabla `seteos`
--
ALTER TABLE `seteos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sindicatos`
--
ALTER TABLE `sindicatos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cuit` (`cuit`);

--
-- Indices de la tabla `situacionrevista`
--
ALTER TABLE `situacionrevista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasainteres`
--
ALTER TABLE `tasainteres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- Indices de la tabla `tipoboleta`
--
ALTER TABLE `tipoboleta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `idempresa` (`idempresa`);

--
-- Indices de la tabla `vencimiento`
--
ALTER TABLE `vencimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsindicato` (`idsindicato`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `categoriaempleados`
--
ALTER TABLE `categoriaempleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empresaslogin`
--
ALTER TABLE `empresaslogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `esquema`
--
ALTER TABLE `esquema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `historialnomina`
--
ALTER TABLE `historialnomina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `importeseguro`
--
ALTER TABLE `importeseguro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nacionalidades`
--
ALTER TABLE `nacionalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `padron`
--
ALTER TABLE `padron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ramos`
--
ALTER TABLE `ramos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccional`
--
ALTER TABLE `seccional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `seteos`
--
ALTER TABLE `seteos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sindicatos`
--
ALTER TABLE `sindicatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tasainteres`
--
ALTER TABLE `tasainteres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoboleta`
--
ALTER TABLE `tipoboleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vencimiento`
--
ALTER TABLE `vencimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoriaempleados`
--
ALTER TABLE `categoriaempleados`
  ADD CONSTRAINT `categoriaempleados_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD CONSTRAINT `conceptos_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `conceptos_ibfk_2` FOREIGN KEY (`idtipoboleta`) REFERENCES `tipoboleta` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_ibfk_1` FOREIGN KEY (`ramo`) REFERENCES `ramos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `esquema`
--
ALTER TABLE `esquema`
  ADD CONSTRAINT `esquema_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `historialnomina`
--
ALTER TABLE `historialnomina`
  ADD CONSTRAINT `historialnomina_ibfk_2` FOREIGN KEY (`cuit`) REFERENCES `empresas` (`cuit`) ON UPDATE CASCADE,
  ADD CONSTRAINT `historialnomina_ibfk_3` FOREIGN KEY (`cuil`) REFERENCES `nomina` (`cuil`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `importeseguro`
--
ALTER TABLE `importeseguro`
  ADD CONSTRAINT `importeseguro_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `nomina_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `padron`
--
ALTER TABLE `padron`
  ADD CONSTRAINT `padron_ibfk_1` FOREIGN KEY (`provincia`) REFERENCES `provincias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_2` FOREIGN KEY (`idestadocivil`) REFERENCES `estadocivil` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_3` FOREIGN KEY (`idseccional`) REFERENCES `seccional` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_4` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_5` FOREIGN KEY (`idnacionalidad`) REFERENCES `nacionalidades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_6` FOREIGN KEY (`idsituacionrevista`) REFERENCES `situacionrevista` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_7` FOREIGN KEY (`idcategoriaempleado`) REFERENCES `categoriaempleados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_8` FOREIGN KEY (`idempresa`) REFERENCES `empresas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `padron_ibfk_9` FOREIGN KEY (`idtipodocumento`) REFERENCES `documentos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idbanco`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ramos`
--
ALTER TABLE `ramos`
  ADD CONSTRAINT `ramos_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `seccional`
--
ALTER TABLE `seccional`
  ADD CONSTRAINT `seccional_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tasainteres`
--
ALTER TABLE `tasainteres`
  ADD CONSTRAINT `tasainteres_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipoboleta`
--
ALTER TABLE `tipoboleta`
  ADD CONSTRAINT `tipoboleta_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idempresa`) REFERENCES `empresas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `vencimiento`
--
ALTER TABLE `vencimiento`
  ADD CONSTRAINT `vencimiento_ibfk_1` FOREIGN KEY (`idsindicato`) REFERENCES `sindicatos` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
