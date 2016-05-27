-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Maio-2016 às 01:20
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `caronasja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amizade`
--

CREATE TABLE IF NOT EXISTS `amizade` (
  `email_amigo1` varchar(100) NOT NULL,
  `email_amigo2` varchar(100) NOT NULL,
  `data_inicio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email_amigo1`,`email_amigo2`),
  KEY `email_amigo2` (`email_amigo2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avalia`
--

CREATE TABLE IF NOT EXISTS `avalia` (
  `email_avaliador` varchar(100) NOT NULL,
  `email_avaliado` varchar(100) NOT NULL,
  `data` date DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `conteudo` text,
  PRIMARY KEY (`email_avaliador`,`email_avaliado`),
  KEY `email_avaliado` (`email_avaliado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carona`
--

CREATE TABLE IF NOT EXISTS `carona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `origem` varchar(50) NOT NULL,
  `destino` varchar(50) NOT NULL,
  `descricao` text,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `qtd_passageiros` int(11) NOT NULL,
  `bagagem` char(1) DEFAULT NULL,
  `preco` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`,`email`),
  KEY `email` (`email`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `email_criador` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email_criador` (`email_criador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_modelo`
--

CREATE TABLE IF NOT EXISTS `info_modelo` (
  `modelo` varchar(50) NOT NULL DEFAULT '',
  `marca` varchar(50) DEFAULT NULL,
  `lugares` tinyint(4) NOT NULL,
  PRIMARY KEY (`modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE IF NOT EXISTS `mensagem` (
  `email_destinatario` varchar(100) NOT NULL,
  `email_remetente` varchar(100) NOT NULL,
  `conteudo` text,
  `status` int(1) DEFAULT NULL,
  `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email_destinatario`,`email_remetente`),
  KEY `email_remetente` (`email_remetente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participa`
--

CREATE TABLE IF NOT EXISTS `participa` (
  `email` varchar(100) NOT NULL DEFAULT '',
  `Id_grupo` int(11) NOT NULL,
  PRIMARY KEY (`email`,`Id_grupo`),
  KEY `Id_grupo` (`Id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `preferencias`
--

CREATE TABLE IF NOT EXISTS `preferencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `email` varchar(100) NOT NULL,
  `id_carona` int(11) NOT NULL,
  PRIMARY KEY (`email`,`id_carona`),
  KEY `id_carona` (`id_carona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(100) NOT NULL,
  `senha` char(64) DEFAULT NULL COMMENT 'Senha criptografada em 64 bytes',
  `nome` varchar(50) DEFAULT NULL,
  `genero` char(1) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`email`, `senha`, `nome`, `genero`, `nascimento`, `celular`) VALUES
('yu@gmail.com', '123', 'Yuri Catarino DelgadÃ³', 'M', '0000-00-00', '11952904930'),
('yuridelg@gmail.com', '123', 'Yuri Catarino Delgado', 'M', '0000-00-00', '11952904930');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_preferencias`
--

CREATE TABLE IF NOT EXISTS `usuario_preferencias` (
  `email` varchar(100) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`,`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) NOT NULL,
  `conforto` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `cor` varchar(20) DEFAULT NULL,
  `email_dono` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email_dono` (`email_dono`),
  KEY `modelo` (`modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `amizade`
--
ALTER TABLE `amizade`
  ADD CONSTRAINT `amizade_ibfk_1` FOREIGN KEY (`email_amigo1`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `amizade_ibfk_2` FOREIGN KEY (`email_amigo2`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `avalia`
--
ALTER TABLE `avalia`
  ADD CONSTRAINT `avalia_ibfk_1` FOREIGN KEY (`email_avaliador`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avalia_ibfk_2` FOREIGN KEY (`email_avaliado`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `carona`
--
ALTER TABLE `carona`
  ADD CONSTRAINT `carona_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carona_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`email_criador`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `mensagem_ibfk_1` FOREIGN KEY (`email_destinatario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensagem_ibfk_2` FOREIGN KEY (`email_remetente`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `participa`
--
ALTER TABLE `participa`
  ADD CONSTRAINT `participa_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participa_ibfk_2` FOREIGN KEY (`Id_grupo`) REFERENCES `carona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_carona`) REFERENCES `carona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario_preferencias`
--
ALTER TABLE `usuario_preferencias`
  ADD CONSTRAINT `usuario_preferencias_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_preferencias_ibfk_2` FOREIGN KEY (`id`) REFERENCES `preferencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`email_dono`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `veiculo_ibfk_2` FOREIGN KEY (`modelo`) REFERENCES `info_modelo` (`modelo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
