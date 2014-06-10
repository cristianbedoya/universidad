-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2014 at 01:05 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mundo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblantesala`
--

CREATE TABLE IF NOT EXISTS `tblantesala` (
  `cod_antesala` int(5) NOT NULL AUTO_INCREMENT,
  `cod_usuario` int(10) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`cod_antesala`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblcatalogo`
--

CREATE TABLE IF NOT EXISTS `tblcatalogo` (
  `cod_catalogo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  PRIMARY KEY (`cod_catalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblestado`
--

CREATE TABLE IF NOT EXISTS `tblestado` (
  `cod_estado` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblestado_servicio`
--

CREATE TABLE IF NOT EXISTS `tblestado_servicio` (
  `cod_estado` int(10) NOT NULL AUTO_INCREMENT,
  `cod_servicio` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblfuncionalidades`
--

CREATE TABLE IF NOT EXISTS `tblfuncionalidades` (
  `cod_funcion` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_funcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblfuncion_perfil`
--

CREATE TABLE IF NOT EXISTS `tblfuncion_perfil` (
  `cod_perfil` int(2) NOT NULL,
  `cod_funcion` int(2) NOT NULL,
  `fechamodificacion` date NOT NULL,
  PRIMARY KEY (`cod_perfil`),
  UNIQUE KEY `fechamodificacion` (`fechamodificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblperfil`
--

CREATE TABLE IF NOT EXISTS `tblperfil` (
  `cod_perfil` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblservicios`
--

CREATE TABLE IF NOT EXISTS `tblservicios` (
  `cod_servicio` int(10) NOT NULL AUTO_INCREMENT,
  `n_nota` int(20) NOT NULL,
  `nit_cc` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `barrio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `cod_usuario` int(10) NOT NULL,
  `cod_catalogo` int(10) NOT NULL,
  `cod_estado` int(10) NOT NULL,
  `cod_zona` int(10) NOT NULL,
  `fechainicial` date NOT NULL,
  `fechafinal` date NOT NULL,
  PRIMARY KEY (`cod_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblusuario`
--

CREATE TABLE IF NOT EXISTS `tblusuario` (
  `cod_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `cod_perfil` int(2) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_perfil`),
  UNIQUE KEY `cod_usuario` (`cod_usuario`,`correo`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblusuario_datos`
--

CREATE TABLE IF NOT EXISTS `tblusuario_datos` (
  `cod_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `cedula` int(11) NOT NULL,
  `nombre1` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre2` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tblusuario_datos`
--

INSERT INTO `tblusuario_datos` (`cod_usuario`, `cedula`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `telefono`, `direccion`, `correo`) VALUES
(10, 123123, 'sdads', 'ddsa', 'dsad', 'sad', 'dsa', 'sad', 'asdasd'),
(12, 12312333, 'sdads', 'ddsa', 'dsad', 'sad', 'dsa', 'sad', 'asdasd'),
(14, 12, 'sdads', 'ddsa', 'dsad', 'sad', 'dsa', 'sad', 'asdasd'),
(15, 12213, 'sdads', 'ddsa', 'dsad', 'sad', 'dsa', 'sad', 'asdasd'),
(16, 1221, 'sdads', 'ddsa', 'dsad', 'sad', 'dsa', 'sad', 'asdasd'),
(17, 1221123, 'sdads', 'ddsa', 'dsad', 'sad', 'dsa', 'sad', 'asdasd'),
(18, 12123, 'sdads', 'ddsa', 'dsad', 'sad', 'dsa', 'sad', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `tblzona`
--

CREATE TABLE IF NOT EXISTS `tblzona` (
  `cod_zona` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cod_zona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zona_tecnico`
--

CREATE TABLE IF NOT EXISTS `zona_tecnico` (
  `cod_usuario` int(10) NOT NULL,
  `cod_zona` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblfuncion_perfil`
--
ALTER TABLE `tblfuncion_perfil`
  ADD CONSTRAINT `tblfuncion_perfil_ibfk_1` FOREIGN KEY (`cod_perfil`) REFERENCES `tblperfil` (`cod_perfil`);

--
-- Constraints for table `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD CONSTRAINT `tblusuario_ibfk_2` FOREIGN KEY (`cod_perfil`) REFERENCES `tblperfil` (`cod_perfil`),
  ADD CONSTRAINT `tblusuario_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `tblusuario_datos` (`cod_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
