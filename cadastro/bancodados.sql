-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `escolinha`
--
CREATE DATABASE `escolinha` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `escolinha`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista`
--

CREATE TABLE IF NOT EXISTS `lista` (
  `email` varchar(60) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  `dataAtualizacao` datetime DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL DEFAULT '0',
  `codigo` varchar(40) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista`
--

INSERT INTO `lista` (`email`, `dataCadastro`, `dataAtualizacao`, `situacao`, `codigo`) VALUES
('xandy.bq@gmail.com', '2015-11-25 07:31:15', NULL, 0, '356a192b7913b04c54574d18c28d46e6395428ab'),
('ninny16@gmail.com', '2015-11-25 05:40:31', NULL, 0, 'da4b9237bacccdf19c0760cab7aec4a8359010b0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
