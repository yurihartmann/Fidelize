-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 26/09/2019 às 14:19
-- Versão do servidor: 10.3.16-MariaDB
-- Versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fidelize_master`
--
CREATE DATABASE IF NOT EXISTS `fidelize_master` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fidelize_master`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id` int(11) NOT NULL,
  `nota` int(11) DEFAULT NULL,
  `comentario` text CHARACTER SET utf8 DEFAULT NULL,
  `fk_loja` int(11) DEFAULT NULL,
  `fk_cliente` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cartaoFidelidade`
--

CREATE TABLE `cartaoFidelidade` (
  `id` int(11) NOT NULL,
  `nome_cartao` varchar(50) NOT NULL,
  `objetivo` int(11) NOT NULL,
  `fk_loja` int(11) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `premio` varchar(100) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `fk_destaque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `numero` bigint(20) NOT NULL,
  `nome` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `destaque`
--

CREATE TABLE `destaque` (
  `id` int(11) NOT NULL,
  `nome_destaque` varchar(40) DEFAULT NULL,
  `valor_destaque` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fidelizar`
--

CREATE TABLE `fidelizar` (
  `id` int(4) NOT NULL,
  `nome` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `descricao` text CHARACTER SET utf8 DEFAULT NULL,
  `tipo` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lojas`
--

CREATE TABLE `lojas` (
  `id` int(11) NOT NULL,
  `nome` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `segmento` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperacao_senha`
--

CREATE TABLE `recuperacao_senha` (
  `id` int(11) NOT NULL,
  `hash` int(11) NOT NULL,
  `data_valido` datetime NOT NULL,
  `fk_cliente` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro_cartaoFidelidade`
--

CREATE TABLE `registro_cartaoFidelidade` (
  `id` int(11) NOT NULL,
  `fk_cliente` bigint(20) NOT NULL,
  `fk_carimbo` int(11) NOT NULL,
  `data_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `segmento`
--

CREATE TABLE `segmento` (
  `id` int(11) NOT NULL,
  `nome_segmento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sms_enviados`
--

CREATE TABLE `sms_enviados` (
  `id` int(11) NOT NULL,
  `fk_cliente` bigint(20) NOT NULL,
  `conteudo` varchar(1000) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `suporte`
--

CREATE TABLE `suporte` (
  `id` int(6) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `fk_cliente` bigint(20) NOT NULL,
  `fk_carimbo` int(11) NOT NULL,
  `token` varchar(10) NOT NULL,
  `usado` tinyint(1) NOT NULL,
  `data_usado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_loja` (`fk_loja`),
  ADD KEY `fk_cliente` (`fk_cliente`);

--
-- Índices de tabela `cartaoFidelidade`
--
ALTER TABLE `cartaoFidelidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartaoFidelidade_carimbo_fk0` (`fk_loja`),
  ADD KEY `fk_destaque` (`fk_destaque`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`numero`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `destaque`
--
ALTER TABLE `destaque`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fidelizar`
--
ALTER TABLE `fidelizar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `segmento` (`segmento`);

--
-- Índices de tabela `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente` (`fk_cliente`);

--
-- Índices de tabela `registro_cartaoFidelidade`
--
ALTER TABLE `registro_cartaoFidelidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registro_cartaoFidelidade_carimbo_fk0` (`fk_cliente`),
  ADD KEY `registro_cartaoFidelidade_carimbo_fk1` (`fk_carimbo`);

--
-- Índices de tabela `segmento`
--
ALTER TABLE `segmento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sms_enviados`
--
ALTER TABLE `sms_enviados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_enviados_fk0` (`fk_cliente`);

--
-- Índices de tabela `suporte`
--
ALTER TABLE `suporte`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `tokens_fk0` (`fk_cliente`),
  ADD KEY `tokens_fk1` (`fk_carimbo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cartaoFidelidade`
--
ALTER TABLE `cartaoFidelidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `destaque`
--
ALTER TABLE `destaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fidelizar`
--
ALTER TABLE `fidelizar`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro_cartaoFidelidade`
--
ALTER TABLE `registro_cartaoFidelidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `segmento`
--
ALTER TABLE `segmento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sms_enviados`
--
ALTER TABLE `sms_enviados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `suporte`
--
ALTER TABLE `suporte`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`fk_loja`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`numero`);

--
-- Restrições para tabelas `cartaoFidelidade`
--
ALTER TABLE `cartaoFidelidade`
  ADD CONSTRAINT `cartaoFidelidade_carimbo_fk0` FOREIGN KEY (`fk_loja`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `cartaoFidelidade_ibfk_1` FOREIGN KEY (`fk_destaque`) REFERENCES `destaque` (`id`);

--
-- Restrições para tabelas `lojas`
--
ALTER TABLE `lojas`
  ADD CONSTRAINT `segmento` FOREIGN KEY (`segmento`) REFERENCES `segmento` (`id`);

--
-- Restrições para tabelas `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`numero`);

--
-- Restrições para tabelas `registro_cartaoFidelidade`
--
ALTER TABLE `registro_cartaoFidelidade`
  ADD CONSTRAINT `registro_cartaoFidelidade_carimbo_fk0` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`numero`),
  ADD CONSTRAINT `registro_cartaoFidelidade_carimbo_fk1` FOREIGN KEY (`fk_carimbo`) REFERENCES `cartaoFidelidade` (`id`);

--
-- Restrições para tabelas `sms_enviados`
--
ALTER TABLE `sms_enviados`
  ADD CONSTRAINT `sms_enviados_fk0` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`numero`);

--
-- Restrições para tabelas `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_fk0` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`numero`),
  ADD CONSTRAINT `tokens_fk1` FOREIGN KEY (`fk_carimbo`) REFERENCES `cartaoFidelidade` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
