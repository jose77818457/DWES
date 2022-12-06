-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2022 a las 19:40:14
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `studium_dws_p2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ninios`
--

CREATE TABLE `ninios` (
  `idNinio` int(11) NOT NULL,
  `nombreNinio` varchar(45) NOT NULL,
  `apeNinio` varchar(45) NOT NULL,
  `fechaNacimientoNinio` date NOT NULL,
  `buenoSiNo` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ninios`
--

INSERT INTO `ninios` (`idNinio`, `nombreNinio`, `apeNinio`, `fechaNacimientoNinio`, `buenoSiNo`) VALUES
(1, 'Alejandro', 'Alcántara', '1994-10-13', 'No'),
(2, 'Elisa', 'Lopez', '1982-04-18', 'Si'),
(3, 'Jose Ignacio', 'Barragan', '1998-12-01', 'Si'),
(4, 'Alvaro', 'Domíngez', '1987-09-02', 'No'),
(5, 'Pablo', 'Gonzalez', '1996-08-12', 'Si'),
(6, 'Isabel', 'Fernández', '1990-07-28', 'Si'),
(46, 'Lucia', 'Soria', '2012-02-10', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedir` int(11) NOT NULL,
  `idNinioFK` int(11) NOT NULL,
  `idRegaloFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedir`, `idNinioFK`, `idRegaloFK`) VALUES
(1, 1, 15),
(2, 2, 17),
(3, 2, 18),
(4, 4, 15),
(5, 6, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalos`
--

CREATE TABLE `regalos` (
  `idRegalo` int(11) NOT NULL,
  `nombreRegalo` varchar(45) NOT NULL,
  `precioRegalo` decimal(10,2) NOT NULL,
  `idReyFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `regalos`
--

INSERT INTO `regalos` (`idRegalo`, `nombreRegalo`, `precioRegalo`, `idReyFK`) VALUES
(14, 'Play Station 5 1TB', '560.95', 1),
(15, 'Carbón', '0.00', 2),
(16, 'Playmovil Fortaleza', '89.95', 3),
(17, 'Juego de mesa : Virus', '19.95', 1),
(18, 'Lego Villa familiar modular', '64.99', 2),
(19, 'Magia Borrás Clásica 150 trucos con luz', '32.95', 3),
(20, 'Meccano Excavadora contrucción', '30.99', 1),
(21, 'Nenuco Hace pompas', '29.95', 2),
(22, 'Barbie multipeinados', '34.00', 3),
(23, 'Nintendo Switch', '299.95', 1),
(24, 'Robot Coji', '69.95', 2),
(25, 'Telescopio astrómico terretre', '72.00', 3),
(26, 'Juego Nintengo Switch: Xenobale chronicles 3', '70.95', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reyes`
--

CREATE TABLE `reyes` (
  `idRey` int(11) NOT NULL,
  `nombreRey` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `reyes`
--

INSERT INTO `reyes` (`idRey`, `nombreRey`) VALUES
(1, 'Melchor'),
(2, 'Gaspar'),
(3, 'Baltasar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ninios`
--
ALTER TABLE `ninios`
  ADD PRIMARY KEY (`idNinio`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedir`),
  ADD KEY `idNinioFK` (`idNinioFK`),
  ADD KEY `idRegaloFK` (`idRegaloFK`);

--
-- Indices de la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD PRIMARY KEY (`idRegalo`),
  ADD KEY `idReyFK` (`idReyFK`);

--
-- Indices de la tabla `reyes`
--
ALTER TABLE `reyes`
  ADD PRIMARY KEY (`idRey`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ninios`
--
ALTER TABLE `ninios`
  MODIFY `idNinio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `regalos`
--
ALTER TABLE `regalos`
  MODIFY `idRegalo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `reyes`
--
ALTER TABLE `reyes`
  MODIFY `idRey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idNinioFK`) REFERENCES `ninios` (`idNinio`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idRegaloFK`) REFERENCES `regalos` (`idRegalo`);

--
-- Filtros para la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD CONSTRAINT `regalos_ibfk_1` FOREIGN KEY (`idReyFK`) REFERENCES `reyes` (`idRey`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
