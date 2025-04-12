-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-04-2025 a las 12:59:08
-- Versión del servidor: 10.11.11-MariaDB-0+deb12u1
-- Versión de PHP: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Servijam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `print_jobs_3d`
--

CREATE TABLE `print_jobs_3d` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `submitted_at` datetime DEFAULT current_timestamp(),
  `status` enum('pending','printing','done','error','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','user','guest') DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$E7/Vpo3cfjCKy1SJQ82T7O0o7flGGfHW6tK9Tep1zJOVLhTXUVzoG', NULL, 'admin', '2025-04-12 12:30:48'),
(2, 'user', '$2y$10$JRRYW750usehUmxQ4OyFlOjOQyd.aMMIMkYIacIRYdyz.AL1f0w.u', NULL, 'user', '2025-04-12 12:30:48'),
(6, 'user_prueba', '$2y$10$cX4mcgNXy9w7nhZiYpMZSOFxF4c.JKyrbmZF9IsId7BfYjW87mAM6', NULL, 'user', '2025-04-12 13:34:40'),
(7, 'juancarlos', '$2y$10$nKN1cGzT2QrIoPZcniyMquawJ6NBk.VmOygfQJXfmc4Vy0.uj6LgC', NULL, 'admin', '2025-04-12 13:49:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `print_jobs_3d`
--
ALTER TABLE `print_jobs_3d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `print_jobs_3d`
--
ALTER TABLE `print_jobs_3d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `print_jobs_3d`
--
ALTER TABLE `print_jobs_3d`
  ADD CONSTRAINT `print_jobs_3d_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
