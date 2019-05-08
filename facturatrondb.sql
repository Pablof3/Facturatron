-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2019 at 07:13 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facturatrondb`
--
CREATE DATABASE IF NOT EXISTS `facturatrondb` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `facturatrondb`;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `detalle`) VALUES
(1, 'mi categoria', 'este es detalle de categoria'),
(6, 'Nueva Categoria', '...'),
(7, 'Nueva Categoriax', 'no se xD'),
(9, 'mi categoria new', 'lol');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `razon` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(35) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `razon`, `nit`, `nombre`, `apellidos`) VALUES
(1, 'Lopez', '9511301', 'Abel', 'Lopez Paniaugua');

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `nro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `proveedor` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`id_compra`, `nro`, `fecha`, `usuario`, `proveedor`, `total`) VALUES
(1, 1, '2019-04-01', 1, 2, '45.50');

-- --------------------------------------------------------

--
-- Table structure for table `compradetalle`
--

CREATE TABLE `compradetalle` (
  `id_compradetalle` int(11) NOT NULL,
  `compra` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `compradetalle`
--

INSERT INTO `compradetalle` (`id_compradetalle`, `compra`, `producto`, `precio`, `cantidad`, `subtotal`) VALUES
(1, 1, 2, '0.00', 10, '45.50');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `nitEmisor` int(13) NOT NULL,
  `numeroFactura` int(8) NOT NULL,
  `cuf` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cufd` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `codigoSucursal` tinyint(4) NOT NULL,
  `direccion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `codigoPuntoVenta` tinyint(4) DEFAULT NULL,
  `fechaEmision` datetime NOT NULL,
  `nombreRazonSocial` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `codigoTipoDocumentoIdentidad` tinyint(1) NOT NULL,
  `numeroDocumento` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `complemento` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigoCliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `codigoMetodoPago` tinyint(2) NOT NULL,
  `numeroTarjeta` int(16) DEFAULT NULL,
  `montoTotal` decimal(25,5) NOT NULL,
  `montoDescuento` decimal(25,5) DEFAULT NULL,
  `codigoMoneda` tinyint(4) NOT NULL,
  `tipoCambio` decimal(25,5) NOT NULL,
  `montoTotalMoneda` decimal(25,5) NOT NULL,
  `leyenda` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `codigoDocumentoSector` tinyint(4) NOT NULL,
  `anulada` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facturadetalle`
--

CREATE TABLE `facturadetalle` (
  `id_facturadetalle` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `actividadEconomica` int(8) NOT NULL,
  `codigoProductoSin` int(8) NOT NULL,
  `codigoProducto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` decimal(25,5) NOT NULL,
  `unidadMedida` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precioUnitario` decimal(25,5) NOT NULL,
  `montoDescuento` decimal(25,5) DEFAULT NULL,
  `subTotal` decimal(25,5) NOT NULL,
  `numeroSerie` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `medida` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock_minimo` int(11) NOT NULL DEFAULT '0',
  `precio_compra` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id_producto`, `descripcion`, `precio_unitario`, `medida`, `categoria`, `imagen`, `stock_minimo`, `precio_compra`) VALUES
(2, 'Producto DOS EXTREME', '12.00', 'Kg', 9, 'img/productos/4501553815522203.jpg', 0, '4.55'),
(10, 'Producto SEIS', '7.00', 'Unidad', 6, 'img/productos/4361553813250834.jpg', 0, '5.25');

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(55) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `telefono`, `direccion`) VALUES
(1, 'Proveedor 1', '4414018', 'Av. Dorvigni 1827'),
(2, 'Proveedor 2', '56123123', 'mi direccion');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ci` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `esAdmin` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `ci`, `nombre`, `apellidos`, `esAdmin`) VALUES
(1, 'topx', '1234', '9511301', 'Abel', 'Lopez', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `nro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `factura` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`id_venta`, `nro`, `fecha`, `usuario`, `cliente`, `factura`, `total`) VALUES
(1, 1, '2019-04-01', 1, 1, NULL, '175.00'),
(3, 2, '2019-04-01', 1, 1, NULL, '70.00'),
(4, 3, '2019-04-01', 1, 1, NULL, '70.00'),
(5, 4, '2019-04-01', 1, 1, NULL, '24.00'),
(6, 5, '2019-04-01', 1, 1, NULL, '24.00'),
(7, 6, '2019-04-01', 1, 1, NULL, '24.00'),
(8, 7, '2019-04-01', 1, 1, NULL, '24.00'),
(9, 8, '2019-04-01', 1, 1, NULL, '36.00'),
(10, 9, '2019-04-02', 1, 1, NULL, '14.00'),
(11, 10, '2019-04-02', 1, 1, NULL, '45.00'),
(12, 11, '2019-04-02', 1, 1, NULL, '48.00'),
(13, 12, '2019-04-02', 1, 1, NULL, '50.00'),
(14, 13, '2019-05-08', 1, 1, NULL, '155.00');

-- --------------------------------------------------------

--
-- Table structure for table `ventadetalle`
--

CREATE TABLE `ventadetalle` (
  `id_ventadetalle` int(11) NOT NULL,
  `venta` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `ventadetalle`
--

INSERT INTO `ventadetalle` (`id_ventadetalle`, `venta`, `producto`, `precio`, `cantidad`, `subtotal`) VALUES
(1, 1, 10, '7.00', 25, '175.00'),
(3, 3, 10, '7.00', 10, '70.00'),
(4, 4, 10, '7.00', 10, '70.00'),
(5, 5, 2, '12.00', 2, '24.00'),
(6, 6, 2, '12.00', 2, '24.00'),
(7, 7, 2, '12.00', 2, '24.00'),
(8, 8, 2, '12.00', 2, '24.00'),
(9, 9, 2, '12.00', 3, '36.00'),
(10, 10, 10, '7.00', 2, '14.00'),
(11, 11, 10, '7.00', 3, '21.00'),
(12, 11, 2, '12.00', 2, '24.00'),
(13, 12, 2, '12.00', 4, '48.00'),
(14, 13, 10, '7.00', 2, '14.00'),
(15, 13, 2, '12.00', 3, '36.00'),
(16, 14, 10, '7.00', 5, '35.00'),
(17, 14, 2, '12.00', 10, '120.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `nit` (`nit`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD UNIQUE KEY `nro` (`nro`),
  ADD KEY `compra_usuario` (`usuario`),
  ADD KEY `compra_proveedor` (`proveedor`);

--
-- Indexes for table `compradetalle`
--
ALTER TABLE `compradetalle`
  ADD PRIMARY KEY (`id_compradetalle`),
  ADD KEY `compra_detalle` (`compra`),
  ADD KEY `compra_producto` (`producto`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indexes for table `facturadetalle`
--
ALTER TABLE `facturadetalle`
  ADD PRIMARY KEY (`id_facturadetalle`),
  ADD KEY `factura_detalle` (`factura`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `descripcion` (`descripcion`),
  ADD KEY `producto_categoria` (`categoria`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `telefono` (`telefono`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD UNIQUE KEY `nro` (`nro`),
  ADD KEY `venta_usuario` (`usuario`),
  ADD KEY `venta_cliente` (`cliente`),
  ADD KEY `venta_factura` (`factura`);

--
-- Indexes for table `ventadetalle`
--
ALTER TABLE `ventadetalle`
  ADD PRIMARY KEY (`id_ventadetalle`),
  ADD KEY `venta_detalle` (`venta`),
  ADD KEY `venta_detalle_producto` (`producto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `compradetalle`
--
ALTER TABLE `compradetalle`
  MODIFY `id_compradetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facturadetalle`
--
ALTER TABLE `facturadetalle`
  MODIFY `id_facturadetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ventadetalle`
--
ALTER TABLE `ventadetalle`
  MODIFY `id_ventadetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_proveedor` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;

--
-- Constraints for table `compradetalle`
--
ALTER TABLE `compradetalle`
  ADD CONSTRAINT `compra_detalle` FOREIGN KEY (`compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_producto` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;

--
-- Constraints for table `facturadetalle`
--
ALTER TABLE `facturadetalle`
  ADD CONSTRAINT `factura_detalle` FOREIGN KEY (`factura`) REFERENCES `factura` (`id_factura`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_cliente` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_factura` FOREIGN KEY (`factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `venta_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;

--
-- Constraints for table `ventadetalle`
--
ALTER TABLE `ventadetalle`
  ADD CONSTRAINT `venta_detalle` FOREIGN KEY (`venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_detalle_producto` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
