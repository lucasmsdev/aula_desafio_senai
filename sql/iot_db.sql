-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/01/2026 às 23:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `iot_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `sensor_readings`
--

CREATE TABLE `sensor_readings` (
  `id` int(11) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `temperature` decimal(5,2) NOT NULL,
  `humidity` decimal(5,2) NOT NULL,
  `pressure` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `setor` varchar(50) DEFAULT 'Geral'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sensor_readings`
--

INSERT INTO `sensor_readings` (`id`, `device_id`, `temperature`, `humidity`, `pressure`, `created_at`, `setor`) VALUES
(103, 'sala_01', 27.97, 59.10, 999.99, '2026-01-16 04:56:52', 'Geral'),
(104, 'sensor teste', 48.21, 55.90, 999.99, '2026-01-16 04:57:05', 'Geral'),
(106, 'Sensor-Fabrica02', 44.91, 41.50, 998.60, '2026-01-16 04:58:33', 'Geral'),
(107, 'SalaA-Temp', 19.14, 61.70, 999.99, '2026-01-18 15:33:13', 'Sala'),
(108, 'FabricaB-Hum', 34.27, 98.50, 999.99, '2026-01-18 15:33:13', 'Fabrica'),
(109, 'ExternaC-Press', 33.11, 53.60, 999.99, '2026-01-18 15:33:13', 'Externa'),
(110, 'sala_01', 42.90, 38.50, 999.99, '2026-01-18 15:34:52', 'Sala');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `sensor_readings`
--
ALTER TABLE `sensor_readings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `sensor_readings`
--
ALTER TABLE `sensor_readings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
