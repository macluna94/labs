-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-09-2019 a las 22:12:07
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Lab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `name_teacher` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `name_class` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `class_rom` text COLLATE latin1_spanish_ci NOT NULL,
  `carreer_class` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `semester_class` int(2) NOT NULL,
  `num_students` int(2) NOT NULL,
  `stage` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`name_teacher`, `name_class`, `class_rom`, `carreer_class`, `semester_class`, `num_students`, `stage`) VALUES
('Eduardo', 'Contabilidad', '1', 'industrial', 1, 56, 'Enero-Julio'),
('Jose Lopez', 'Mate', '2', 'contabilidad', 5, 56, 'Agosto-Diciembre'),
('Manuel Luna', 'Fisica', '2', 'administracion', 7, 34, 'Agosto-Diciembre'),
('Martin Lopez', 'Biologia', '1', 'industrial', 1, 23, 'Enero-Julio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(8) NOT NULL,
  `teacher` int(8) NOT NULL,
  `class` text COLLATE latin1_spanish_ci NOT NULL,
  `time_in` time(6) NOT NULL,
  `time_out` time(6) NOT NULL,
  `date` date NOT NULL,
  `state` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`name_teacher`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
