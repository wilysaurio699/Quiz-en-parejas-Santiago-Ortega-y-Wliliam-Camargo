-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2023 a las 16:08:38
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_víveres`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `Codigo` int(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Cantidad` int(100) NOT NULL,
  `precio` int(100) NOT NULL,
  `fecha_de_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`Codigo`, `Nombre`, `Cantidad`, `precio`, `fecha_de_vencimiento`) VALUES
(101, 'Aceite', 25, 2000, '2024-06-21'),
(102, 'Panela', 65, 1000, '2024-02-22'),
(103, 'Huevos', 0, 18000, '2024-04-12'),
(104, 'Café', 60, 3000, '2024-05-28'),
(105, 'Leche', 15, 4000, '2024-09-12'),
(106, 'carne res', 50, 2000, '2024-11-12'),
(107, 'pescado', 20, 3000, '2024-11-15'),
(108, 'salchichas', 15, 1000, '2024-05-15'),
(109, 'mantequilla', 14, 6000, '2024-03-15'),
(110, 'limon', 15, 2000, '2024-06-15'),
(111, 'piñas', -40, 6000, '2024-02-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Codigo` int(100) NOT NULL,
  `FechaPedido` date NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Cantidad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Codigo`, `FechaPedido`, `Nombre`, `Cantidad`) VALUES
(106, '2023-11-17', 'carne de res', 50),
(107, '2023-11-22', 'pescado', 20),
(108, '2023-11-21', 'salchichas', 15),
(109, '2023-11-21', 'mantequilla', 16),
(110, '2023-11-10', 'limon', 20),
(111, '2023-11-05', 'piñas', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `Codigo` int(100) NOT NULL,
  `Cantidad` int(100) NOT NULL,
  `NombreProducto` varchar(100) NOT NULL,
  `FechaDeVenta` date NOT NULL,
  `PrecioTotal` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`Codigo`, `Cantidad`, `NombreProducto`, `FechaDeVenta`, `PrecioTotal`) VALUES
(109, 2, 'mantequilla', '2023-11-20', 100000),
(110, 5, 'limon', '2023-10-20', 10000),
(111, 80, 'piñas', '2023-12-21', 480000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
