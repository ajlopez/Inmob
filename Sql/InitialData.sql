-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 25, 2012 at 02:31 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `inmob`
--

-- --------------------------------------------------------

--
-- Dumping data for table `inmob_monedas`
--

INSERT INTO `inmob_monedas` (`Id`, `Nombre`, `Simbolo`) VALUES
(1, 'Pesos', '$'),
(2, 'Dólares Estadounidenses', 'u$s');

-- --------------------------------------------------------

--
-- Dumping data for table `inmob_tipospropiedad`
--

INSERT INTO `inmob_tipospropiedad` (`Id`, `Nombre`) VALUES
(1, 'Casa'),
(2, 'Departamento'),
(3, 'Local'),
(4, 'Lote');

-- --------------------------------------------------------

--
-- Dumping data for table `inmob_zonas`
--

INSERT INTO `inmob_zonas` (`Id`, `Nombre`, `IdZonaPadre`) VALUES
(1, 'Ciudad Autónoma de Buenos Aires', 0),
(2, 'Villa Pueyrredón', 1),
(3, 'Villa Devoto', 1),
(4, 'Villa Urquiza', 1);

