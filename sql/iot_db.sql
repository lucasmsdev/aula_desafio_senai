-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql306.infinityfree.com
-- Tempo de geração: 21/01/2026 às 20:28
-- Versão do servidor: 11.4.9-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_40962004_iot_db`
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
(108, 'Fabrica_A1', '47.37', '42.30', '999.99', '2026-01-18 15:33:13', 'Fabrica'),
(109, 'Externa_A1', '28.78', '53.30', '999.99', '2026-01-18 15:33:13', 'Externa'),
(110, 'sala_escritorio', '46.91', '31.90', '999.99', '2026-01-18 15:34:52', 'Sala'),
(114, 'Armazem_A1', '31.94', '60.60', '999.99', '2026-01-21 23:38:07', 'Armazem'),
(115, 'Armazem_A2', '33.48', '98.80', '999.99', '2026-01-21 23:38:35', 'Armazem'),
(116, 'Armazem_B1', '41.50', '50.90', '999.99', '2026-01-21 23:38:45', 'Armazem'),
(117, 'Fabrica_A2', '49.89', '82.70', '990.50', '2026-01-21 23:40:28', 'Fabrica'),
(118, 'Fabrica_A3', '20.84', '27.50', '999.99', '2026-01-21 23:40:33', 'Fabrica'),
(119, 'Fabrica_B1', '24.36', '79.90', '999.99', '2026-01-21 23:40:38', 'Fabrica'),
(120, 'Fabrica_B2', '31.21', '29.30', '999.99', '2026-01-21 23:40:45', 'Fabrica'),
(121, 'Fabrica_D1', '47.72', '79.90', '999.99', '2026-01-21 23:40:52', 'Fabrica'),
(122, 'Externa_A2', '29.81', '79.70', '999.99', '2026-01-21 23:41:26', 'Externa'),
(123, 'Externa_B1', '49.28', '36.50', '999.99', '2026-01-21 23:41:33', 'Externa'),
(124, 'Externa_D1', '27.13', '99.30', '999.99', '2026-01-21 23:41:41', 'Externa'),
(125, 'Externa_D2', '39.32', '71.80', '999.20', '2026-01-21 23:41:46', 'Externa');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `sensor_readings`
--
ALTER TABLE `sensor_readings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `sensor_readings`
--
ALTER TABLE `sensor_readings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
