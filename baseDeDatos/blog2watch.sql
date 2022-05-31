-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2022 a las 08:35:12
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buzon`
--

CREATE TABLE `buzon` (
  `id_buzon` int(11) NOT NULL,
  `users` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_mensaje` int(11) NOT NULL,
  `mensaje` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `buzon`
--

INSERT INTO `buzon` (`id_buzon`, `users`, `tipo_mensaje`, `mensaje`) VALUES
(1, 'Jesus', 1, 'sdfghjk,lñxdcrnjmkl,cdrftvgybhnjmkl,'),
(2, 'Jose', 2, 'dcfvgbhnjmkl,dcrftvgybhunjmkl,ctfvgybhnjmk,');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `plataforma` int(1) NOT NULL,
  `tipo` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `extreno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `duracion` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id_post`, `titulo`, `info`, `plataforma`, `tipo`, `calificacion`, `extreno`, `duracion`) VALUES
(28, 'Ejemplo 2', 'Información del ejemplo 2', 4, 2, 5, '', ''),
(29, 'Ejemplo 3', 'Información del ejemplo 3', 3, 1, 2, '', ''),
(30, 'Ejemplo 4', 'Información del ejemplo 4', 2, 1, 4, '', ''),
(32, 'Ejemplo 5', 'Información del ejemplo 5', 1, 2, 5, '', ''),
(33, 'Ejemplo 6', 'Información ejemplo 6', 2, 2, 2, '2022', '1:30 min'),
(34, 'Ejemplo 7', 'Informació ejemplo 7', 2, 2, 5, '1111', '1:30 min');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactions`
--

CREATE TABLE `reactions` (
  `id_reaction` int(11) NOT NULL,
  `id_post` int(3) NOT NULL,
  `id_user` int(3) NOT NULL,
  `calificacion` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pregunta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `pregunta`, `respuesta`) VALUES
(38, 'Jesus', '$2y$10$xtSBRbZwuz30nl/XmImmn.e.UFTdqhfN6TmvoO0HjrvQwV2R46gfq', '1', 'chikis'),
(39, 'Haro123', '$2y$10$BBcN7ixTp6k94KyDdQT8.uxUKmHtPWNCuCmFpsXcOWOUxgO4oguKO', '1', 'firualis'),
(41, 'Geremi', '$2y$10$MzTKJKfVDrim1nHsFDRlTeYjTXWgmUAv7VYSOE77f2rrdaEpS232C', '2', 'Milanesa'),
(42, 'jesus3', '$2y$10$946xRwXSSW4wfuomrZDG4udFD61aYyCICrgwg8l62XoQ5JCBI3vA.', '1', 'max'),
(43, 'Administrador', '$2y$10$Ue06SfwqT7D9NFBYPAZtmeUNnmd3e8YaYDWBEiTWH5dNWtqZT3h2W', '1', 'max');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buzon`
--
ALTER TABLE `buzon`
  ADD PRIMARY KEY (`id_buzon`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indices de la tabla `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id_reaction`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `buzon`
--
ALTER TABLE `buzon`
  MODIFY `id_buzon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id_reaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
