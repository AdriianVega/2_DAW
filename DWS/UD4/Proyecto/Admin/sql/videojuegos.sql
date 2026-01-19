-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2026 a las 12:53:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videojuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(50) NOT NULL,
  `genero` char(1) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codpostal` char(5) NOT NULL,
  `poblacion` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `email`, `password`, `genero`, `direccion`, `codpostal`, `poblacion`, `provincia`, `create_time`) VALUES
(4, 'Pedro', 'Pedrete', 'dfef@gmail.com', 'c37ccff16c055d9f451e83f4499385b136b98d04', 'M', 'pedrito de la calzada 233', '01234', '29384', 'Pedrolandia', '2025-12-12 09:05:03'),
(6, 'manuel', 'manolo', 'manolo@gmail.com', '62e2c90ea3d6c10e656395323f6a641a931dc90d', 'M', 'pedrito de la calzada 233', '01234', '29384', 'Pedrolandia', '2025-12-12 09:05:52'),
(8, 'manuel', 'manolo', 'irfirfi@gmail.com', '0d3dfc14235f76f61390e4415c8cc8a6106d23e9', 'M', 'pedrito de la calzada 233', '01234', '29384', 'Pedrolandia', '2025-12-12 09:08:30'),
(9, 'manuel', 'manolo', 'maodfs@gmail.com', '3c0a3a521c91191b074750a3a6a479f4a2b4ad67', 'M', 'pedrito de la calzada 233', '01234', '29384', 'Pedrolandia', '2025-12-12 09:09:28'),
(12, 'Emilio', '4rrfrfrfr', 'adrvegper@gmail.com', '4f03c04e99f4cf4cb62929bef35d36c267e2036d', 'F', 'rfrferef', 'rfref', 'rfrfrefr', 'rfrefrfe', '2025-12-12 09:32:44'),
(13, 'Emilio', '4rrfrfrfr', 'adrvegpe5r@gmail.com', '4f03c04e99f4cf4cb62929bef35d36c267e2036d', 'M', 'rfrferef', 'rfref', 'rfrfrefr', 'rfrefrfe', '2025-12-12 09:33:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` tinyint(1) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `rol`, `nombre`, `icono`, `create_time`) VALUES
(3, 'adrvegper@gmail.com', '12870ae1d28b54578d65d4371abbb5ee9272e3a6', 1, 'Adrián Nataniel', '../img/usuarios/adriannataniel.jpg', '2026-01-19 10:24:41'),
(9, 'lorenzo@gmail.com', '12870ae1d28b54578d65d4371abbb5ee9272e3a6', 0, 'Lorenzo Gayllén', '../img/usuarios/696e13eaa641aGemini_Generated_Image_3sp43x3sp43x3sp4.png', '2026-01-19 11:04:59'),
(10, 'alejandrobonobo@gmail.com', '12870ae1d28b54578d65d4371abbb5ee9272e3a6', 0, 'Alejandro Bonobo', '../img/usuarios/696e10515289fGemini_Generated_Image_roqbzhroqbzhroqb.png', '2026-01-19 11:06:57'),
(11, 'angelito@gmail.com', '12870ae1d28b54578d65d4371abbb5ee9272e3a6', 0, 'Angel Garcia', '../img/usuarios/696e15e562a61Gemini_Generated_Image_kh1iy7kh1iy7kh1i.png', '2026-01-19 11:30:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
