-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06-Jan-2019 às 17:49
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_mercos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`) VALUES
(00001, 'Darth Vader'),
(00002, 'Obi-Wan Kenobi'),
(00003, 'Luke Skywalker'),
(00004, 'Imperador Palpatine'),
(00005, 'Han Solo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_pedido`
--

DROP TABLE IF EXISTS `itens_pedido`;
CREATE TABLE IF NOT EXISTS `itens_pedido` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `id_pedido` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_produto` int(5) UNSIGNED ZEROFILL NOT NULL,
  `qtdade_de_produtos` int(5) NOT NULL,
  `valor_venda` decimal(10,2) NOT NULL,
  `total_item` decimal(10,2) NOT NULL,
  `rentabilidade` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido` (`id_pedido`),
  KEY `fk_produto` (`id_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=391 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id`, `id_pedido`, `id_produto`, `qtdade_de_produtos`, `valor_venda`, `total_item`, `rentabilidade`) VALUES
(00299, 00135, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00298, 00135, 00005, 5, '6000.00', '30000.00', 'Boa'),
(00297, 00135, 00004, 2, '75000.01', '150000.02', 'Ótima'),
(00296, 00135, 00003, 2, '4570000.00', '9140000.00', 'Boa'),
(00295, 00135, 00002, 4, '60000.00', '240000.00', 'Boa'),
(00130, 00136, 00001, 1, '550000.00', '550000.00', 'Boa'),
(00131, 00136, 00002, 2, '60000.00', '120000.00', 'Boa'),
(00132, 00136, 00003, 1, '4570000.00', '4570000.00', 'Boa'),
(00133, 00136, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00134, 00137, 00002, 2, '60000.01', '120000.02', 'Ótima'),
(00135, 00137, 00003, 2, '4570000.01', '9140000.02', 'Ótima'),
(00136, 00138, 00001, 1, '550000.00', '550000.00', 'Boa'),
(00137, 00138, 00002, 2, '60000.00', '120000.00', 'Boa'),
(00138, 00138, 00003, 1, '4570000.00', '4570000.00', 'Boa'),
(00139, 00138, 00007, 10, '1500.01', '15000.10', 'Ótima'),
(00140, 00139, 00001, 1, '550000.03', '550000.03', 'Ótima'),
(00141, 00139, 00002, 2, '60000.01', '120000.02', 'Ótima'),
(00142, 00139, 00003, 1, '4570000.00', '4570000.00', 'Boa'),
(00143, 00139, 00004, 4, '75000.04', '300000.16', 'Ótima'),
(00144, 00139, 00005, 10, '6000.00', '60000.00', 'Boa'),
(00145, 00139, 00006, 1, '5800.00', '5800.00', 'Boa'),
(00146, 00139, 00007, 20, '1500.01', '30000.20', 'Ótima'),
(00147, 00140, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00148, 00141, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00149, 00141, 00006, 1, '5800.00', '5800.00', 'Boa'),
(00150, 00141, 00007, 10, '1500.01', '15000.10', 'Ótima'),
(00151, 00142, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00152, 00142, 00006, 1, '5800.00', '5800.00', 'Boa'),
(00153, 00142, 00007, 10, '1500.01', '15000.10', 'Ótima'),
(00154, 00143, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00155, 00144, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00156, 00144, 00003, 1, '4570000.00', '4570000.00', 'Boa'),
(00157, 00145, 00004, 2, '75000.01', '150000.02', 'Ótima'),
(00158, 00145, 00005, 5, '6000.00', '30000.00', 'Boa'),
(00159, 00145, 00007, 10, '1500.01', '15000.10', 'Ótima'),
(00160, 00146, 00002, 2, '60000.01', '120000.02', 'Ótima'),
(00161, 00146, 00003, 1, '4570000.00', '4570000.00', 'Boa'),
(00162, 00146, 00004, 2, '75000.01', '150000.02', 'Ótima'),
(00163, 00147, 00004, 2, '75000.00', '150000.00', 'Boa'),
(00164, 00147, 00005, 5, '6000.01', '30000.05', 'Ótima'),
(00165, 00147, 00007, 10, '1500.01', '15000.10', 'Ótima'),
(00294, 00135, 00001, 2, '550000.00', '1100000.00', 'Boa'),
(00381, 00168, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00380, 00168, 00005, 5, '6000.01', '30000.05', 'Ótima'),
(00379, 00168, 00004, 2, '75000.00', '150000.00', 'Boa'),
(00309, 00167, 00002, 2, '60000.00', '120000.00', 'Boa'),
(00308, 00167, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00310, 00167, 00007, 10, '1500.01', '15000.10', 'Ótima'),
(00318, 00166, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00317, 00166, 00006, 1, '5800.00', '5800.00', 'Boa'),
(00316, 00166, 00002, 2, '60000.00', '120000.00', 'Boa'),
(00315, 00166, 00001, 1, '550000.00', '550000.00', 'Boa'),
(00345, 00165, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00339, 00148, 00007, 20, '1502.30', '30046.00', 'Ótima'),
(00338, 00148, 00005, 5, '6000.00', '30000.00', 'Boa'),
(00337, 00148, 00004, 2, '75000.00', '150000.00', 'Boa'),
(00344, 00165, 00006, 1, '5800.01', '5800.01', 'Ótima'),
(00343, 00165, 00005, 5, '6000.00', '30000.00', 'Boa'),
(00357, 00169, 00003, 1, '4570000.01', '4570000.01', 'Ótima'),
(00356, 00169, 00002, 2, '60000.00', '120000.00', 'Boa'),
(00355, 00169, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00366, 00149, 00007, 10, '1500.01', '15000.10', 'Ótima'),
(00365, 00149, 00004, 2, '75000.00', '150000.00', 'Boa'),
(00364, 00149, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00377, 00170, 00002, 4, '60000.00', '240000.00', 'Boa'),
(00376, 00170, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00373, 00164, 00002, 4, '80000.00', '320000.00', 'Ótima'),
(00374, 00164, 00007, 10, '1700.00', '17000.00', 'Ótima'),
(00375, 00163, 00003, 1, '4570000.01', '4570000.01', 'Ótima'),
(00378, 00170, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00390, 00171, 00007, 10, '2500.00', '25000.00', 'Ótima'),
(00389, 00171, 00005, 5, '6000.00', '30000.00', 'Boa'),
(00388, 00171, 00004, 2, '75000.00', '150000.00', 'Boa'),
(00385, 00160, 00007, 10, '1500.00', '15000.00', 'Boa'),
(00386, 00159, 00001, 1, '550000.01', '550000.01', 'Ótima'),
(00387, 00159, 00006, 1, '5800.01', '5800.01', 'Ótima');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `id_cliente` int(5) UNSIGNED ZEROFILL NOT NULL,
  `valor_do_pedido` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente` (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `valor_do_pedido`) VALUES
(00170, 00002, '805000.01'),
(00169, 00004, '5240000.02'),
(00168, 00002, '195000.05'),
(00167, 00005, '685000.11'),
(00166, 00004, '690800.00'),
(00141, 00005, '570800.11'),
(00165, 00002, '50800.01'),
(00164, 00003, '337000.00'),
(00163, 00001, '4570000.01'),
(00162, 00001, '165000.12'),
(00161, 00001, '165000.12'),
(00160, 00002, '15000.00'),
(00159, 00003, '555800.02'),
(00157, 00001, '165000.12'),
(00156, 00001, '165000.12'),
(00171, 00003, '205000.00'),
(00151, 00001, '165000.12'),
(00140, 00003, '15000.00'),
(00149, 00005, '715000.11'),
(00139, 00004, '5635800.41'),
(00142, 00004, '570800.11'),
(00143, 00003, '15000.00'),
(00138, 00001, '5255000.10'),
(00144, 00004, '5120000.01'),
(00148, 00003, '210046.00'),
(00135, 00002, '10675000.02'),
(00136, 00005, '5255000.00'),
(00137, 00001, '9260000.04'),
(00145, 00001, '195000.12'),
(00146, 00003, '4840000.04'),
(00147, 00004, '195000.15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `multiplos` varchar(2) DEFAULT NULL,
  `end_imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `multiplos`, `end_imagem`) VALUES
(00001, 'Millenium Falcon', '550000.00', '1', 'images/MillenniumFalcon.png'),
(00002, 'X-Wing', '60000.00', '2', 'images/X-Wing.png'),
(00003, 'Super Star Destroyer', '4570000.00', '1', 'images/SuperStarDestroyer.png'),
(00004, 'TIE Fighter', '75000.00', '2', 'images/TIEFighter.png'),
(00005, 'Lightsaber', '6000.00', '5', 'images/Lightsabers.png'),
(00006, 'DLT-19 Heavy Blaster Rifle', '5800.00', '1', 'images/DLT-19.png'),
(00007, 'DL-44 Heavy Blaster Pistol', '1500.00', '10', 'images/DL-44.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
