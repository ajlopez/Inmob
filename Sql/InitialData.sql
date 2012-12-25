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
-- Table structure for table `inmob_monedas`
--

CREATE TABLE IF NOT EXISTS `inmob_monedas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `inmob_monedas`
--

INSERT INTO `inmob_monedas` (`Id`, `Nombre`) VALUES
(1, 'Pesos'),
(2, 'Dólares Estadounidenses');

-- --------------------------------------------------------

--
-- Table structure for table `inmob_tipospropiedad`
--

CREATE TABLE IF NOT EXISTS `inmob_tipospropiedad` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
-- Table structure for table `inmob_zonas`
--

CREATE TABLE IF NOT EXISTS `inmob_zonas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) DEFAULT NULL,
  `IdZonaPadre` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `inmob_zonas`
--

INSERT INTO `inmob_zonas` (`Id`, `Nombre`, `IdZonaPadre`) VALUES
(1, 'Ciudad Autónoma de Buenos Aires', 0),
(2, 'Villa Pueyrredón', 1),
(3, 'Villa Devoto', 1),
(4, 'Villa Urquiza', 1);

