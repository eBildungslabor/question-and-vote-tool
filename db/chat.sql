-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 11 Mai 2016 à 19:43
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `msg` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123499 ;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id`, `name`, `msg`, `date`) VALUES
(123457, 'dada', 'Hello everyone', '2016-02-18 12:09:44'),
(123458, 'kana', 'hey hey', '2016-02-18 12:09:44'),
(123459, 'kana', 'are here', '2016-02-18 12:11:34'),
(123460, 'kana', 'tous vas bien', '2016-02-18 12:12:20'),
(123461, 'dou', 'je suis la aussi', '2016-02-18 12:20:21'),
(123473, 'df', 'hhy', '2016-02-19 15:18:29'),
(123474, 'df', 'hhy', '2016-02-19 15:20:43'),
(123475, 'df', 'hhy', '2016-02-19 15:21:04'),
(123476, 'dd', 'ccc', '2016-02-19 15:22:49'),
(123477, 'sfsf', 'fsf', '2016-02-19 15:23:09'),
(123478, 'kana', 'FRRR', '2016-03-25 08:38:05'),
(123486, 'fff', 'ggg', '2016-03-25 14:33:04'),
(123487, 'CFFF', 'GGGG', '2016-03-25 14:38:52'),
(123488, '', 'nnnn', '2016-04-18 19:35:40'),
(123489, '', 'nnnn', '2016-04-18 19:35:55'),
(123490, '', 'dac', '2016-04-18 19:36:04'),
(123491, '', 'dac', '2016-04-18 19:36:30'),
(123492, '', 'ff', '2016-05-10 17:13:32'),
(123493, '', 'ghh', '2016-05-10 17:13:44'),
(123494, '', 'gg', '2016-05-10 17:20:41'),
(123495, '', 'gg', '2016-05-10 17:21:24'),
(123496, '', 'gg', '2016-05-10 17:23:10'),
(123497, '', 'gg', '2016-05-11 17:43:02'),
(123498, '', 'aloo', '2016-05-11 17:43:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
