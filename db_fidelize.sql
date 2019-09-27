-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 27/09/2019 às 14:08
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
CREATE DATABASE IF NOT EXISTS `fidelize_master` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `nota`, `comentario`, `fk_loja`, `fk_cliente`) VALUES
(33, 4, 'Roupas maravilhosas', 18, 47985630228),
(34, 5, 'Cuidado com os meu cachorrinho Ã³timo!', 20, 47985630228),
(35, 3, 'O melhor mercado da regiÃ£o', 2, 47996385544),
(36, 5, 'Super Atensioso', 21, 47996385544),
(37, 4, 'PreÃ§o barato e atendimento excelente!', 21, 47984889683),
(38, 3, 'Gostei do lanche mas pode melhorar.', 15, 47984889683),
(39, 5, 'Roupas de qualidade!', 18, 82995212805),
(40, 5, 'Atendimento perfeito. PromoÃ§Ã£o muito boa!', 15, 95992843864),
(41, 5, 'Perfeito!', 15, 67986578671),
(42, 5, 'Melhor atendimento!', 21, 67986578671),
(43, 3, 'Mercado limpo e bem ambientado mas faltou alguns produtos necessÃ¡rios.', 19, 47985630228);

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

--
-- Despejando dados para a tabela `cartaoFidelidade`
--

INSERT INTO `cartaoFidelidade` (`id`, `nome_cartao`, `objetivo`, `fk_loja`, `foto`, `premio`, `descricao`, `data_inicio`, `data_fim`, `valor`, `fk_destaque`) VALUES
(76, 'Cesta Basica', 3, 2, NULL, 'Cesta Basica', 'Melhor cesta do bairro', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '300.50', 3),
(80, 'EduInfo', 3, 2, NULL, 'uma placa de video', 'PeÃ§as com alto teor de desconto', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '1.00', 1),
(91, 'Shack-Shack', 10, 15, NULL, '1 hambÃºrguer grÃ¡tis ', 'Bons momentos pedem um bom hambÃºrguer, atinja os 10 hambÃºrguers para conseguir 1 de brinde ', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '2.00', 3),
(92, 'Shack-Challenge', 5, 15, NULL, 'Shack Burger ', 'Para conseguir estÃ¡ promoÃ§Ã£o vocÃª precisa comprar 5 Burguer Shack, cada 1 vale 1 ticket.', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '21.50', 1),
(93, 'Isso Ã© um sonho', 10, 17, NULL, 'VocÃª ganharÃ¡ trÃªs sonhos recheados conforme a sua escolha', 'Relembre como Ã© estÃ¡ sonhando', '2019-09-06 10:00:00', '2020-09-06 10:00:00', '9.75', 2),
(94, 'Shackout', 15, 15, NULL, 'Combo Premium ', 'ApÃ³s atingir o objetivo de 15 hambÃºrguer, vocÃª recebe um combo de brinde.', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '15.50', 4),
(95, 'Milkshakes Kingdom', 8, 17, NULL, 'VocÃª ganharÃ¡ dois milkshakes apresentado com uma surpresa', 'Bons momentos com os amigos', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '17.25', 3),
(96, 'DemonBrownie', 5, 17, NULL, 'GanharÃ¡ um DemonBrownie', 'VocÃª irÃ¡ experimentar o mais assustador Brownie', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '500.00', 3),
(97, 'Dia da  camisa ', 5, 18, NULL, 'Camisa.', 'Nesta promoÃ§Ã£o incrÃ­vel vocÃª ganha uma camisa apÃ³s comprar 5 camisas/blusas.', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '27.75', 2),
(98, 'Seu treino nÃ£o fica de fora!', 10, 18, NULL, '3 camisas esportivas', 'VocÃª irÃ¡ ganhar 3 modelos de camisas esportivas apÃ³s completar a compra de 10 camisetas (1 ticket por camisa).', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '80.99', 3),
(99, 'Semana da Limpeza', 5, 19, NULL, 'Kit de Limpeza', 'Bassos Supermercado estÃ¡ oferecendo uma linda promoÃ§Ã£o de produtos de limpeza para seus clientes. ApÃ³s atingir 5 compras (MÃ­nimo R$ 50,00) vocÃª receberÃ¡ um maravilhoso kit limpeza.', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '70.25', 4),
(100, 'Moda? TÃ´ dentro ', 7, 18, NULL, 'Camiseta Chanel', 'ApÃ³s completar a compra de 7 camisetas ou blusas vocÃª recebe uma linda camiseta da Chanel. ', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '44.99', 2),
(101, 'Tosa premiada ', 5, 20, NULL, 'Tosa grÃ¡tis ', 'AuAmigos estÃ¡ disponibilizando uma promoÃ§Ã£o para seu pet, valendo o prÃªmio de uma tosa de brinde!', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '37.00', 1),
(102, 'Cesta Premiada', 10, 19, NULL, 'Cesta BÃ¡sica', 'Uma linda e recheada cesta bÃ¡sica para nossos clientes. ApÃ³s atingir 10 compras (MÃ­nimo R$ 50 cada compra) vocÃª recebe uma bela cesta bÃ¡sica', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '35.90', 1),
(103, 'Banho Especial', 10, 20, NULL, 'Banho grÃ¡tis ', 'AuAmigos estÃ¡ promovendo uma promoÃ§Ã£o especial para seu pet, com o prÃªmio de um banho completo apÃ³s completar os 10 banhos. ', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '15.50', 3),
(104, 'RaÃ§Ã£o de montÃ£o', 10, 20, NULL, '1kg raÃ§Ã£o ', 'AuAmigos estÃ¡ disponibilizando uma promoÃ§Ã£o imperdÃ­vel para seu pet. Quando completar 10kg em compra de raÃ§Ã£o vocÃª recebe 1kg a sua escolha.', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '350.99', 2),
(105, 'Carrinho Premiado', 10, 19, NULL, 'Um carrinho de compras cheio, de graÃ§a!', 'Um carrinho lotado no final do mÃªs? Esse Ã© o prÃªmio da promoÃ§Ã£o Carrinho Premiado. ApÃ³s atingir 10 compras (MÃ­nimo R$ 60,00 por compra) vocÃª pode encher um carrinho de compras de graÃ§a', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '700.00', 2),
(106, 'DecoraÃ§Ã£o premiada.', 3, 21, NULL, 'Abajur', 'Na compra de 3 mÃ³veis decorativos ganhe um lindo abajur para iluminar sua casa.', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '87.50', 2),
(107, 'Banheiro Novo ', 5, 21, NULL, 'Chuveiro ', 'Para um banheiro novo nada melhor que um lindo chuveiro, e para isso Ã  Donizete ImÃ³veis criou a promoÃ§Ã£o Banheiro Novo, que na compra de cinco mÃ³veis para seu banheiro vocÃª ganha 1 lindo chuveiro. ', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '35.90', 3),
(108, 'Brinde especial', 5, 21, NULL, '1 Escrivaninha ', 'Donizete ImÃ³veis estÃ¡ com uma promoÃ§Ã£o especial para seus clientes, na compra de cinco produtos relacionados a promoÃ§Ã£o vocÃª ganha uma linda escrivaninha.', '2019-09-18 10:00:00', '2020-09-06 10:00:00', '150.00', 4);

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

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`numero`, `nome`, `email`, `senha`, `img`) VALUES
(4799136103, 'Gabriel Luchtenberg', 'gabrielluchtenberg10@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47984889683, 'Joao de Paula', 'joaoentra21@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47985630228, 'Marcela Regina Lara', 'marcelaregina@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47988734858, 'MÃ´nica ', 'moniluizad@hotmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47991436103, 'Gabriel Luchtenberg', 'danzomikaelson@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47992030801, 'William Basso', 'williambasso73@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47992030802, 'William.B,,,,,Â¥â‚©â‚¬/â™¥ï¸â™¥ï¸â™¥ï¸â™¥ï¸', 'williambasso75@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47992152233, 'Andrei Gustavo', 'andrei.gustavo96@gmail.com', '0d18cff639a0e423d4588231ad61d5f7', NULL),
(47996385544, 'Yuri Hartmann', 'yurihartmann0607@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47996717615, 'Sabrina Capeleti dos Santos', 'binasantos1314@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47998065107, 'SebastiÃ£o Leandro Oliveira', 'sebastiaoleandro@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(47999999999, 'Gabriel Luchtenberg', 'vsfdanzo@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(67986578671, 'Cristiane Fabiana da Cruz', 'critianef@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL),
(82995212805, 'Raimundo Lorenzo', 'raimundolorenzoandredrumond_@innovatis.com.br', '25d55ad283aa400af464c76d713c07ad', NULL),
(95992843864, 'PatrÃ­cia Melissa EloÃ¡', 'ppatriciamelissaeloaoliveira@com.br', '25d55ad283aa400af464c76d713c07ad', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `destaque`
--

CREATE TABLE `destaque` (
  `id` int(11) NOT NULL,
  `nome_destaque` varchar(40) DEFAULT NULL,
  `valor_destaque` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `destaque`
--

INSERT INTO `destaque` (`id`, `nome_destaque`, `valor_destaque`) VALUES
(1, 'Sem destaque', '0.00'),
(2, '<i class=\"fas fa-sun\"></i> Prata', '0.50'),
(3, '<i class=\"fas fa-medal\"></i> Ouro', '1.00'),
(4, '<i class=\"far fa-gem\"></i> Diamante', '1.50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fidelizar`
--

CREATE TABLE `fidelizar` (
  `id` int(4) NOT NULL,
  `nome` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `descricao` text CHARACTER SET utf8 DEFAULT NULL,
  `fk_segmento` int(11) NOT NULL
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

--
-- Despejando dados para a tabela `lojas`
--

INSERT INTO `lojas` (`id`, `nome`, `email`, `senha`, `img`, `segmento`, `descricao`) VALUES
(1, 'Padaria Pao do Bom', 'padaria@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 3, 'Com o intuito de produzir artesanalmente, pÃ£es de fermentaÃ§Ã£o natural, livres de conservantes, sem aditivos quÃ­micos, sem misturas prontas, e com receitas autÃªnticas europeias, feitas como sÃ£o produzidas por lÃ¡, chegamos em Blumenau com o nosso coraÃ§Ã£o e a  Padaria PÃ£o do Bom. Temos, sobretudo, o compromisso de levar pÃ£o de verdade para a sua casa.'),
(2, 'Mercadinho da Esquina', 'mercado@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 3, 'Somos uma empresa recentemente ingressada no mercado, e nÃ³s assumimos a responsabilidade de ter prazer em servir, agir com Ã©tica, trazer soluÃ§Ãµes simples e querer aprender e ensinar.\r\n'),
(15, 'The Burguer Shack', 'burguer@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 7, 'The burguer Shack se destaca principalmente na qualidade dos produtos oferecidos para nossos clientes, sem contar nossas promoÃ§Ãµes diÃ¡rias patrocinada pela empresa Fidelize.'),
(17, 'Padoca Do Juca', 'padoca@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 3, 'Nossa padaria Ã© uma companhia altamente dedicada para nossos clientes, fornecemos diversos produtos que tem baixa densidade de valores.'),
(18, 'Roupas Maria', 'roupasmaria@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 6, 'Roupas Maria vem sempre trazendo seus clientes atualizados com a moda feminina. Ã“timos produtos e preÃ§os que cabem em seu bolso.'),
(19, 'Bassos SuperMercados', 'bassos@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 4, 'O SuperMercado Bassos vem a quase VINTE anos entregando nossos produtos de Ã³tima qualidade para nosso clientes. Contamos com uma equipe de profissionais para atender nossos clientes.'),
(20, 'AuAmigos', 'auamigos@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 7, 'As pessoas amam seus animais de estimaÃ§Ã£o. Compram presentes, brinquedos, comidas especiais e outros itens para satisfazer aqueles que sÃ£o responsÃ¡veis por nos fazer bem e causar momentos inesquecÃ­veis, Na AuAmigos vocÃª encontra tudo isso!\r\n\r\n'),
(21, 'Donizete MÃ³veis', 'donizete@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 8, 'A Donizete MÃ³veis Ã© uma empresa focada em entregar produtos de Ã³tima qualidade e satisfazer os pedidos de nossos clientes com muito amor e dedicaÃ§Ã£o. Estamos a mais de CINCO anos produzindo os melhores mÃ³veis para sua casa.');

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

--
-- Despejando dados para a tabela `registro_cartaoFidelidade`
--

INSERT INTO `registro_cartaoFidelidade` (`id`, `fk_cliente`, `fk_carimbo`, `data_registro`) VALUES
(141, 47996385544, 76, '2019-05-29 10:48:26'),
(148, 47996385544, 76, '2019-08-29 20:25:47'),
(149, 47996385544, 76, '2019-08-29 20:25:51'),
(232, 47985630228, 91, '2019-09-12 10:22:57'),
(233, 67986578671, 92, '2019-09-12 10:25:11'),
(234, 82995212805, 94, '2019-09-12 10:26:13'),
(235, 47985630228, 93, '2019-09-12 10:27:57'),
(236, 95992843864, 95, '2019-09-12 10:28:56'),
(237, 82995212805, 96, '2019-09-12 10:29:19'),
(238, 47998065107, 97, '2019-09-12 10:31:22'),
(239, 47985630228, 98, '2019-09-12 10:31:56'),
(240, 67986578671, 100, '2019-09-12 10:32:56'),
(241, 47985630228, 99, '2019-09-12 10:35:15'),
(242, 47998065107, 102, '2019-09-12 10:35:37'),
(243, 67986578671, 105, '2019-09-12 10:36:11'),
(244, 47985630228, 101, '2019-09-12 10:40:12'),
(245, 67986578671, 103, '2019-09-12 10:40:26'),
(246, 82995212805, 104, '2019-09-12 10:40:42'),
(247, 82995212805, 106, '2019-09-12 10:41:29'),
(248, 47985630228, 107, '2019-09-12 10:41:49'),
(249, 67986578671, 108, '2019-09-12 10:41:58'),
(250, 67986578671, 92, '2019-09-12 11:30:12'),
(251, 67986578671, 92, '2019-09-12 11:30:25'),
(252, 67986578671, 92, '2019-09-12 11:30:31'),
(253, 67986578671, 92, '2019-05-12 11:30:36'),
(254, 82995212805, 91, '2019-05-12 11:30:53'),
(255, 82995212805, 91, '2019-05-12 11:30:58'),
(256, 82995212805, 91, '2019-06-12 11:31:01'),
(257, 82995212805, 91, '2019-06-12 11:31:04'),
(258, 82995212805, 91, '2019-06-12 11:31:07'),
(259, 82995212805, 91, '2019-06-12 11:31:10'),
(260, 82995212805, 91, '2019-06-12 11:31:13'),
(261, 47985630228, 91, '2019-06-12 11:31:18'),
(262, 95992843864, 91, '2019-06-12 11:31:50'),
(263, 95992843864, 91, '2019-09-12 11:31:54'),
(264, 95992843864, 91, '2019-06-12 11:31:56'),
(265, 95992843864, 91, '2019-07-12 11:31:59'),
(266, 95992843864, 91, '2019-09-12 11:32:01'),
(267, 95992843864, 91, '2019-07-12 11:32:04'),
(268, 95992843864, 91, '2019-09-12 11:32:08'),
(269, 95992843864, 91, '2019-08-12 11:32:11'),
(270, 95992843864, 91, '2019-09-12 11:32:13'),
(271, 95992843864, 91, '2019-08-12 11:32:31'),
(272, 47988734858, 94, '2019-09-12 11:32:54'),
(273, 47988734858, 94, '2019-08-12 11:32:59'),
(274, 47988734858, 94, '2019-09-12 11:33:02'),
(275, 47988734858, 94, '2019-08-12 11:33:09'),
(276, 47988734858, 94, '2019-09-12 11:33:16'),
(277, 47988734858, 91, '2019-08-12 11:33:39'),
(278, 47992152233, 92, '2019-09-13 11:14:45'),
(279, 47992152233, 92, '2019-09-13 11:14:54'),
(280, 47992152233, 92, '2019-09-13 11:15:04'),
(281, 47992152233, 92, '2019-09-13 11:15:10'),
(282, 47992152233, 92, '2019-09-13 11:15:16'),
(290, 47984889683, 107, '2019-09-24 11:03:02'),
(294, 4799136103, 93, '2019-09-21 08:20:48'),
(295, 4799136103, 93, '2019-09-21 08:20:48'),
(296, 4799136103, 93, '2019-09-21 08:20:48'),
(297, 4799136103, 93, '2019-09-21 08:20:48'),
(298, 4799136103, 95, '2019-09-21 08:20:48'),
(299, 4799136103, 96, '2019-09-21 08:20:48'),
(300, 4799136103, 96, '2019-09-21 08:20:48'),
(301, 4799136103, 95, '2019-09-21 08:20:48'),
(302, 47984889683, 93, '2019-09-21 08:20:48'),
(303, 47984889683, 95, '2019-09-21 08:20:48'),
(304, 47984889683, 96, '2019-09-21 08:20:48'),
(305, 47984889683, 93, '2019-09-21 08:20:48'),
(306, 47984889683, 93, '2019-09-21 08:20:48'),
(307, 47984889683, 96, '2019-09-21 08:20:48'),
(308, 47985630228, 93, '2019-09-21 08:20:48'),
(309, 47985630228, 96, '2019-09-21 08:20:48'),
(310, 47988734858, 93, '2019-09-21 08:20:48'),
(311, 47988734858, 95, '2019-09-22 08:22:18'),
(312, 47992030801, 93, '2019-09-22 08:22:18'),
(313, 47992030801, 95, '2019-09-22 08:22:18'),
(314, 47992030801, 96, '2019-09-22 08:22:18'),
(315, 47992030801, 96, '2019-09-22 08:22:18'),
(316, 47985630228, 97, '2019-09-22 08:22:18'),
(317, 47985630228, 97, '2019-09-22 08:22:18'),
(318, 47985630228, 97, '2019-09-22 08:22:18'),
(319, 47985630228, 97, '2019-09-22 08:22:18'),
(320, 47992030801, 95, '2019-09-22 08:22:18'),
(321, 47985630228, 97, '2019-09-22 08:22:18'),
(322, 47992152233, 93, '2019-09-22 08:22:18'),
(323, 47992152233, 96, '2019-09-22 08:22:18'),
(324, 47992152233, 95, '2019-09-22 08:22:18'),
(325, 47992030801, 98, '2019-09-23 08:23:43'),
(326, 47985630228, 101, '2019-09-23 08:23:43'),
(327, 47992030801, 98, '2019-09-23 08:23:43'),
(328, 47996385544, 95, '2019-09-23 08:23:43'),
(329, 47985630228, 103, '2019-09-23 08:23:43'),
(330, 47996385544, 96, '2019-09-23 08:23:43'),
(331, 47992030801, 98, '2019-09-23 08:23:43'),
(332, 47985630228, 104, '2019-09-23 08:23:43'),
(333, 47992030801, 100, '2019-09-23 08:23:43'),
(334, 47996717615, 93, '2019-09-23 08:23:43'),
(335, 47985630228, 101, '2019-09-23 08:23:43'),
(336, 47996717615, 95, '2019-09-23 08:23:43'),
(337, 47992030801, 100, '2019-09-24 08:24:02'),
(338, 47985630228, 101, '2019-09-24 08:24:02'),
(339, 47992030801, 100, '2019-09-24 08:24:02'),
(340, 47985630228, 101, '2019-09-24 08:24:02'),
(341, 47996717615, 93, '2019-09-24 08:24:02'),
(342, 47996717615, 93, '2019-09-24 08:24:02'),
(343, 47996717615, 93, '2019-09-24 08:24:02'),
(344, 47996717615, 93, '2019-09-24 08:24:02'),
(345, 47996717615, 93, '2019-09-24 08:24:02'),
(346, 47985630228, 98, '2019-09-24 08:24:02'),
(347, 47985630228, 103, '2019-09-24 08:24:02'),
(348, 47985630228, 103, '2019-09-24 08:24:02'),
(349, 47998065107, 93, '2019-09-24 08:24:02'),
(350, 47985630228, 103, '2019-09-24 08:24:02'),
(351, 47998065107, 95, '2019-09-25 08:25:00'),
(352, 47985630228, 103, '2019-09-25 08:25:00'),
(353, 47998065107, 95, '2019-09-25 08:25:00'),
(354, 47985630228, 103, '2019-09-25 08:25:00'),
(355, 47998065107, 95, '2019-09-25 08:25:00'),
(356, 47985630228, 98, '2019-09-25 08:25:00'),
(357, 47985630228, 98, '2019-09-25 08:25:00'),
(358, 67986578671, 97, '2019-09-25 08:25:00'),
(359, 67986578671, 103, '2019-09-25 08:25:00'),
(360, 67986578671, 103, '2019-09-25 08:25:00'),
(361, 67986578671, 100, '2019-09-25 08:25:00'),
(362, 67986578671, 100, '2019-09-25 08:25:00'),
(363, 67986578671, 103, '2019-09-25 08:25:00'),
(364, 67986578671, 100, '2019-09-25 08:25:00'),
(365, 67986578671, 103, '2019-09-26 08:25:45'),
(366, 67986578671, 100, '2019-09-26 08:25:45'),
(367, 67986578671, 103, '2019-09-26 08:25:45'),
(368, 67986578671, 103, '2019-09-26 08:25:45'),
(369, 47985630228, 98, '2019-09-26 08:25:45'),
(370, 47985630228, 98, '2019-09-26 08:25:45'),
(371, 47985630228, 98, '2019-09-26 08:25:45'),
(372, 47985630228, 104, '2019-09-26 08:25:45'),
(373, 67986578671, 97, '2019-09-26 08:25:45'),
(374, 67986578671, 97, '2019-09-26 08:25:45'),
(375, 67986578671, 97, '2019-09-26 08:25:45'),
(376, 47985630228, 104, '2019-09-26 08:25:45'),
(377, 82995212805, 104, '2019-09-26 08:25:45'),
(378, 82995212805, 104, '2019-09-26 08:25:45'),
(379, 82995212805, 104, '2019-09-26 08:25:45'),
(380, 82995212805, 104, '2019-09-26 08:25:45'),
(381, 82995212805, 104, '2019-09-26 08:25:45'),
(382, 47985630228, 104, '2019-09-26 08:25:45'),
(383, 47996717615, 97, '2019-09-24 08:24:02'),
(384, 47996717615, 97, '2019-09-24 08:24:02'),
(385, 47996717615, 97, '2019-09-24 08:24:02'),
(386, 47984889683, 103, '2019-09-24 08:24:02'),
(387, 47984889683, 103, '2019-09-24 08:24:02'),
(388, 4799136103, 91, '2019-09-24 08:24:02'),
(389, 47984889683, 103, '2019-09-24 08:24:02'),
(390, 47984889683, 103, '2019-09-24 08:24:02'),
(391, 47984889683, 91, '2019-09-24 08:24:02'),
(392, 47984889683, 92, '2019-09-24 08:24:02'),
(393, 47984889683, 103, '2019-09-24 08:24:02'),
(394, 47984889683, 92, '2019-09-24 08:24:02'),
(395, 47984889683, 103, '2019-09-24 08:24:02'),
(396, 47984889683, 92, '2019-09-24 08:24:02'),
(397, 47984889683, 103, '2019-09-24 08:24:02'),
(398, 47984889683, 92, '2019-09-24 08:24:02'),
(399, 47984889683, 92, '2019-09-24 08:24:02'),
(400, 47984889683, 103, '2019-09-24 08:24:02'),
(401, 47984889683, 103, '2019-09-24 08:24:02'),
(402, 47985630228, 92, '2019-09-24 08:24:02'),
(403, 47985630228, 91, '2019-09-24 08:24:02'),
(404, 47992030801, 98, '2019-09-24 08:24:02'),
(405, 47985630228, 91, '2019-09-27 08:31:24'),
(406, 47985630228, 91, '2019-09-27 08:31:28'),
(407, 47992030801, 98, '2019-09-27 08:31:28'),
(408, 47992030801, 98, '2019-09-27 08:31:31'),
(409, 47985630228, 91, '2019-09-27 08:31:31'),
(410, 47992030801, 98, '2019-09-27 08:31:35'),
(411, 47988734858, 94, '2019-09-27 08:31:40'),
(412, 47988734858, 94, '2019-09-27 08:31:43'),
(413, 47991436103, 94, '2019-09-27 08:31:50'),
(414, 47991436103, 91, '2019-09-27 08:31:55'),
(415, 47991436103, 91, '2019-09-27 08:31:58'),
(416, 47991436103, 91, '2019-09-27 08:32:03'),
(417, 47992030801, 91, '2019-09-27 08:32:30'),
(418, 47992030801, 94, '2019-09-27 08:32:34'),
(419, 47992030801, 94, '2019-09-27 08:32:39'),
(420, 47992030801, 94, '2019-09-27 08:32:42'),
(421, 47992030801, 92, '2019-09-27 08:32:45'),
(422, 47992030801, 92, '2019-09-27 08:32:50'),
(423, 47992030801, 92, '2019-09-27 08:33:10'),
(424, 47992030801, 94, '2019-09-27 08:33:16'),
(425, 47992152233, 91, '2019-09-27 08:33:27'),
(426, 47992152233, 94, '2019-09-27 08:33:32'),
(427, 47992152233, 94, '2019-09-27 08:34:08'),
(428, 47996385544, 91, '2019-09-27 08:34:25'),
(429, 47996385544, 94, '2019-09-27 08:34:30'),
(430, 47996717615, 92, '2019-09-27 08:34:37'),
(431, 47998065107, 91, '2019-09-27 08:34:53'),
(432, 47998065107, 92, '2019-09-27 08:34:58'),
(433, 47998065107, 94, '2019-09-27 08:35:02'),
(434, 67986578671, 91, '2019-09-27 08:35:23'),
(435, 67986578671, 94, '2019-09-27 08:35:36'),
(436, 82995212805, 91, '2019-09-27 08:35:42'),
(437, 82995212805, 91, '2019-09-27 08:35:45'),
(438, 82995212805, 94, '2019-09-27 08:35:48'),
(439, 47985630228, 107, '2019-09-27 08:35:51'),
(440, 47985630228, 107, '2019-09-27 08:36:58'),
(441, 67986578671, 108, '2019-09-27 08:37:11'),
(442, 67986578671, 108, '2019-09-27 08:37:19'),
(443, 67986578671, 108, '2019-09-27 08:37:26'),
(444, 82995212805, 106, '2019-09-27 08:37:44'),
(445, 47984889683, 107, '2019-09-27 08:37:59'),
(446, 47996717615, 108, '2019-09-27 08:38:28'),
(447, 47996717615, 108, '2019-09-27 08:40:34'),
(448, 47996717615, 108, '2019-09-27 08:40:40'),
(449, 47996717615, 108, '2019-09-27 08:40:47'),
(450, 47996717615, 108, '2019-09-27 08:40:52'),
(451, 47996385544, 106, '2019-09-27 08:41:29'),
(452, 82995212805, 100, '2019-09-27 08:41:35'),
(453, 47996385544, 106, '2019-09-27 08:41:36'),
(454, 82995212805, 100, '2019-09-27 08:41:39'),
(455, 47996385544, 106, '2019-09-27 08:41:40'),
(456, 82995212805, 100, '2019-09-27 08:41:44'),
(457, 82995212805, 100, '2019-09-27 08:41:48'),
(458, 82995212805, 100, '2019-09-27 08:41:52'),
(459, 82995212805, 100, '2019-09-27 08:41:55'),
(460, 82995212805, 100, '2019-09-27 08:41:58'),
(461, 82995212805, 97, '2019-09-27 08:42:04'),
(462, 47998065107, 108, '2019-09-27 08:42:05'),
(463, 82995212805, 97, '2019-09-27 08:42:08'),
(464, 82995212805, 97, '2019-09-27 08:42:10'),
(465, 47998065107, 108, '2019-09-27 08:42:19'),
(466, 47998065107, 108, '2019-09-27 08:42:29'),
(467, 47985630228, 98, '2019-09-27 08:42:31'),
(468, 47985630228, 98, '2019-09-27 08:42:35'),
(469, 47998065107, 108, '2019-09-27 08:42:37'),
(470, 47985630228, 98, '2019-09-27 08:42:38'),
(471, 47992152233, 107, '2019-09-27 08:42:54'),
(472, 47992152233, 107, '2019-09-27 08:43:00'),
(473, 67986578671, 108, '2019-09-27 08:43:16'),
(474, 47992030801, 107, '2019-09-27 08:43:35'),
(475, 47992030801, 107, '2019-09-27 08:43:45'),
(476, 47992030801, 107, '2019-09-27 08:43:50'),
(477, 47992030801, 107, '2019-09-27 08:43:58'),
(478, 47984889683, 107, '2019-09-27 08:44:16'),
(479, 47984889683, 107, '2019-09-27 08:44:23'),
(480, 47984889683, 107, '2019-09-27 08:44:31'),
(482, 47985630228, 99, '2019-09-27 09:01:34'),
(483, 47985630228, 99, '2019-09-27 09:01:36'),
(484, 47985630228, 99, '2019-09-27 09:01:40'),
(485, 47985630228, 99, '2019-09-27 09:01:44'),
(486, 47998065107, 102, '2019-09-27 09:01:55'),
(487, 47998065107, 102, '2019-09-27 09:01:58'),
(488, 47998065107, 102, '2019-09-27 09:02:01'),
(489, 47998065107, 102, '2019-09-27 09:02:05'),
(490, 47998065107, 102, '2019-09-27 09:02:08'),
(491, 67986578671, 105, '2019-09-27 09:02:14'),
(492, 67986578671, 105, '2019-09-27 09:02:17'),
(493, 67986578671, 103, '2019-09-27 09:05:35'),
(494, 67986578671, 103, '2019-09-27 09:05:40'),
(495, 67986578671, 103, '2019-09-27 09:05:46'),
(496, 47996717615, 93, '2019-09-27 09:05:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `segmento`
--

CREATE TABLE `segmento` (
  `id` int(11) NOT NULL,
  `nome_segmento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `segmento`
--

INSERT INTO `segmento` (`id`, `nome_segmento`) VALUES
(1, 'Geral'),
(3, 'Padaria'),
(4, 'Mercado'),
(5, 'Pet Shop'),
(6, 'Varejo'),
(7, 'Restaurante'),
(8, 'MÃ³veis/DecoraÃ§Ã£o');

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
-- Despejando dados para a tabela `tokens`
--

INSERT INTO `tokens` (`id`, `fk_cliente`, `fk_carimbo`, `token`, `usado`, `data_usado`) VALUES
(23, 47996385544, 76, '260586', 1, '2019-09-14 21:18:37'),
(40, 67986578671, 92, '398037', 0, '2019-09-12 11:30:36'),
(41, 95992843864, 91, '965476', 1, '2019-09-12 11:32:31'),
(42, 47992152233, 92, '592445', 0, '2019-09-13 11:15:16'),
(47, 47985630228, 97, '956045', 0, '2019-09-27 08:23:16'),
(48, 47985630228, 101, '393942', 0, '2019-09-27 08:24:20'),
(49, 47984889683, 92, '929055', 0, '2019-09-27 08:31:01'),
(50, 47996717615, 108, '127428', 1, '2019-09-27 08:40:52'),
(51, 47996385544, 106, '558785', 0, '2019-09-27 08:41:40'),
(52, 82995212805, 100, '879717', 0, '2019-09-27 08:41:58'),
(53, 47985630228, 98, '712119', 1, '2019-09-27 08:50:04'),
(54, 67986578671, 108, '200176', 0, '2019-09-27 08:43:16'),
(55, 47984889683, 107, '137797', 0, '2019-09-27 08:44:31'),
(56, 47985630228, 99, '609038', 1, '2019-09-27 09:01:44'),
(57, 67986578671, 103, '814771', 0, '2019-09-27 09:05:46');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_segmento` (`fk_segmento`);

--
-- Índices de tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `segmento` (`segmento`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `cartaoFidelidade`
--
ALTER TABLE `cartaoFidelidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de tabela `destaque`
--
ALTER TABLE `destaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `fidelizar`
--
ALTER TABLE `fidelizar`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `registro_cartaoFidelidade`
--
ALTER TABLE `registro_cartaoFidelidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=497;

--
-- AUTO_INCREMENT de tabela `segmento`
--
ALTER TABLE `segmento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `suporte`
--
ALTER TABLE `suporte`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
-- Restrições para tabelas `fidelizar`
--
ALTER TABLE `fidelizar`
  ADD CONSTRAINT `fk_segmento` FOREIGN KEY (`fk_segmento`) REFERENCES `segmento` (`id`);

--
-- Restrições para tabelas `lojas`
--
ALTER TABLE `lojas`
  ADD CONSTRAINT `segmento` FOREIGN KEY (`segmento`) REFERENCES `segmento` (`id`);

--
-- Restrições para tabelas `registro_cartaoFidelidade`
--
ALTER TABLE `registro_cartaoFidelidade`
  ADD CONSTRAINT `registro_cartaoFidelidade_carimbo_fk0` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`numero`),
  ADD CONSTRAINT `registro_cartaoFidelidade_carimbo_fk1` FOREIGN KEY (`fk_carimbo`) REFERENCES `cartaoFidelidade` (`id`);

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
