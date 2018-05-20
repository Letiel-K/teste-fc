-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 20-Maio-2018 às 14:23
-- Versão do servidor: 10.0.34-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `teste_fc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `familias`
--

CREATE TABLE `familias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `quantidade_membros` bigint(20) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `familias`
--

INSERT INTO `familias` (`id`, `nome`, `quantidade_membros`) VALUES
(22, 'Targaryen', 2),
(23, 'Stark', 4),
(24, 'Tyrel', 10),
(26, 'Lannister', 15),
(27, 'Greyjoy', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `guerras`
--

CREATE TABLE `guerras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_familia_desafiadora` bigint(20) NOT NULL,
  `id_familia_desafiada` bigint(20) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `id_familia_vencedora` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `guerras`
--

INSERT INTO `guerras` (`id`, `id_familia_desafiadora`, `id_familia_desafiada`, `data_inicio`, `data_fim`, `id_familia_vencedora`) VALUES
(5, 24, 22, '2018-05-20', '2018-05-20', 24),
(6, 22, 24, '2018-05-08', '2018-05-17', 24),
(7, 27, 26, '2018-05-20', '2018-05-20', 26),
(8, 27, 26, '2018-05-19', '2018-05-19', 27),
(9, 23, 26, '2018-05-21', '2018-05-21', 26),
(10, 22, 26, '2018-05-22', '2018-05-22', 22),
(11, 23, 24, '2018-05-21', '2018-05-31', 23),
(12, 22, 23, '2018-05-16', '2018-05-24', 22),
(13, 22, 24, '2018-05-13', '2018-05-20', 22),
(14, 26, 23, '2018-05-20', '2018-05-29', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `guerras`
--
ALTER TABLE `guerras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `guerras`
--
ALTER TABLE `guerras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;