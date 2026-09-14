-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2023 a las 16:02:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `starxmovie`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_pelicula`
--

CREATE TABLE `categoria_pelicula` (
  `NCategoria` varchar(15) NOT NULL,
  `DCategoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_pelicula`
--

INSERT INTO `categoria_pelicula` (`NCategoria`, `DCategoria`) VALUES
('Accion', 'Películas de acción'),
('Animacion', 'Películas de animación'),
('Aventura', 'Películas de aventuras'),
('Biografia', 'Películas biográficas'),
('Ciencia Ficcion', 'Películas de ciencia ficción'),
('Comedia', 'Películas de comedia'),
('Crimen', 'Películas de crimen'),
('Deporte', 'Películas de deportes'),
('Documental', 'Documentales'),
('Drama', 'Películas de drama'),
('Fantasia', 'Películas de fantasía'),
('Guerra', 'Películas de guerra'),
('Historica', 'Películas históricas'),
('Misterio', 'Películas de misterio'),
('Musical', 'Películas musicales'),
('Romance', 'Películas de romance'),
('Superheroes', 'Películas de superhéroes'),
('Suspenso', 'Películas de suspense'),
('Terror', 'Películas de terror'),
('Western', 'Películas del oeste');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `IdPregunta` int(11) NOT NULL,
  `Interrogante` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`IdPregunta`, `Interrogante`) VALUES
(1, '¿Cuál es el nombre de tu primer mascota?'),
(2, '¿Cuál es tu color favorito?'),
(3, '¿Cuál es tu comida favorita?'),
(4, '¿Cuál es tu canción favorita?'),
(5, '¿Cuál es tu película favorita?'),
(6, '¿Cuál es tu libro favorito?'),
(7, '¿Cuál es tu deporte favorito?'),
(8, '¿Cuál es tu equipo deportivo favorito?'),
(9, '¿En qué ciudad naciste?'),
(10, '¿En qué año naciste?'),
(11, '¿Cuál es el nombre de tu mejor amigo/a de la infancia?'),
(12, '¿Cuál es el nombre de tu abuela/o materna/paterna?'),
(13, '¿Cuál es el nombre de la calle en la que creciste?'),
(14, '¿Cuál es el nombre de la escuela primaria a la que asististe?'),
(15, '¿Cuál es el nombre de la escuela secundaria a la que asististe?'),
(16, '¿Cuál es el nombre de la universidad a la que asististe?'),
(17, '¿Cuál es el nombre de tu primer jefe/a?'),
(18, '¿Cuál es el nombre de tu personaje histórico favorito?'),
(19, '¿Cuál es el nombre de tu ciudad favorita para visitar?'),
(20, '¿Cuál es el nombre de tu destino turístico favorito?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `NUsuario` varchar(20) NOT NULL,
  `PNombre` varchar(15) DEFAULT NULL,
  `SNombre` varchar(15) DEFAULT NULL,
  `PApellido` varchar(15) DEFAULT NULL,
  `SApellido` varchar(15) DEFAULT NULL,
  `FNacimiento` date DEFAULT NULL,
  `Contrasena` varchar(70) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `FPerfil` varchar(70) DEFAULT 'DefaultFPerfil.jpg',
  `IdPregunta` int(11) DEFAULT NULL,
  `Respuesta` varchar(20) DEFAULT NULL,
  `CFavorita` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`NUsuario`, `PNombre`, `SNombre`, `PApellido`, `SApellido`, `FNacimiento`, `Contrasena`, `Mail`, `FPerfil`, `IdPregunta`, `Respuesta`, `CFavorita`) VALUES
('Anthony23', 'Alex', 'Anthony', 'Anderson', 'Aguilar', '2005-05-20', '$2y$10$KLTXMvyny1wzF4oWwJlPVuuhqnYro9cyIVTQWIPjzcu4wpNljh3ku', 'anthonyaguilarparrales2005@gmail.com', 'Anthony23_6564974c4b16c.png', 2, 'Negro', 'Animacion'),
('Slendog', 'Lerner', 'Saul', 'Morales', 'Gomez', '2004-12-13', '$2y$10$EQYCPzgDC7S2Xnp/yQ5A/ugAqG5hzqSirfTpBJt5beGJ0uRB5/PC6', 'lernersaul265@gmail.com', 'Slendog_655e675075ce1.png', 2, 'Celeste', 'Western'),
('Kubz', 'Enrique ', 'Mauricio', 'Alemany', 'Torres', '2001-01-04', '$2y$10$ATFvd.dHGp5E3XOESGQEvejfWhsmqIXDafzqp4GfmeoiAhGr/sGyK', 'alemanye04@gmail.com', 'DefaultFPerfil.jpg', 7, 'Futbol', 'Western'),
('ALAN', 'Alexander', 'Alex', 'Anderson', 'Parrales', '2023-12-09', '$2y$10$wE21RBxxtB8hstljcU1G0uufuegnSbDvEkwB8hmBnRaLRKiedM8Lq', 'yatagaratsuorochi@gmail.com', 'DefaultFPerfil.jpg', 1, 'Princesa', NULL),
('ALAN2', 'Alexander', 'Alex', 'Anderson', 'Parrales', '2023-12-09', '$2y$10$lBTD5dcc3Kw7CYD.kmOPCu.zkFHFyUhE12umEtUPIksuD9nOdOTeu', 'yatagaratsuorochi@gmail.com', 'DefaultFPerfil.jpg', 1, 'Princesa', NULL),
('kubz12', 'Alexander', 'Alex', 'Anderson', 'Parrales', '2023-12-03', '$2y$10$Qm6UUF.f5CHEfGaJ9HQBc.P.unQAf5ZCSpwoDeymG/6lHVnTsd.u6', 'yatagaratsuorochi@gmail.com', 'DefaultFPerfil.jpg', 1, 'Princesa', 'Western'),
('Anth', 'an', 'Anthony', 'Anderson', 'Aguilar', '2023-12-05', '$2y$10$2PsdzS40HIUJYn5I6bg9sumaLwma2MenA5FWagBcpZPAtppqfI7aa', 'Anthonyaguilarparrales2005@gmail.com', 'DefaultFPerfil.jpg', 1, 'Princesa', 'Drama'),
('Anthon', 'an', 'Anthony', 'Anderson', 'Aguilar', '2023-12-06', '$2y$10$gDWwHeROVQpI8HmsBy7HleGyJK1sYsJ0Cq5iHEWiKLiXBCbiemN.m', 'Anthonyaguilarparrales2005@gmail.com', 'DefaultFPerfil.jpg', 1, 'Princesa', 'Crimen'),
('Anthony', 'an', 'Anthony', 'Anderson', 'Aguilar', '2023-12-04', '$2y$10$1f6Gxuyypx7V.Gxn9ngIm.0GkWUWAZ3ltfe5f9XuPtJ2Uu.rEVJ7.', 'Anthonyaguilarparrales2005@gmail.com', 'DefaultFPerfil.jpg', 1, 'Princesa', 'Fantasia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `NUsuario` varchar(17) DEFAULT NULL,
  `IdPelicula` int(11) DEFAULT NULL,
  `Puntuacion` double NOT NULL,
  `Fecha` datetime NOT NULL,
  `Comentario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`NUsuario`, `IdPelicula`, `Puntuacion`, `Fecha`, `Comentario`) VALUES
('Slendog', 335984, 10, '2023-11-16 19:21:08', 'Obra maestra'),
('Slendog', 671, 7, '2023-11-16 20:26:20', 'Aceptable'),
('Slendog', 101299, 0, '2023-11-16 20:56:07', 'basura'),
('Anthony23', 671, 9, '2023-11-17 21:02:50', 'cine'),
('Anthony23', 43641, 9.5, '2023-11-18 02:34:45', 'Obra maestra'),
('kubz', 142, 8, '2023-11-28 20:09:58', '\"Dicen los memes que esta buena\"'),
('kubz', 671, 8, '2023-12-02 02:18:56', 'me gusta mucho'),
('kubz', 313369, 10, '2023-12-02 02:20:02', 'si duda una obra maestra'),
('kubz', 136799, 5, '2023-12-02 02:21:37', 'Es entretenido'),
('Anthon', 671, 9, '2023-12-02 03:16:51', 'me gusta'),
('Anthony', 313369, 10, '2023-12-02 03:21:24', 'muy buena');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
