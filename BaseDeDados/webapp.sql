-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 13, 2020 at 06:49 PM
-- Server version: 5.7.23
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id_game` int(11) NOT NULL AUTO_INCREMENT,
  `pontos` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id_game`,`users_id`),
  KEY `fk_user_id` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id_game`, `pontos`, `date`, `users_id`) VALUES
(64, 2, '2020-06-10 00:55:41', 13),
(63, 10, '2020-06-10 00:55:21', 13),
(62, 3, '2020-06-10 00:53:50', 13),
(61, 7, '2020-06-10 00:52:38', 19),
(60, 7, '2020-06-10 00:50:37', 19),
(59, 9, '2020-06-10 00:50:02', 19),
(58, 8, '2020-06-10 00:47:37', 19),
(57, 15, '2020-06-10 00:46:36', 19),
(56, 30, '2020-06-10 00:45:20', 19),
(55, 7, '2020-06-10 00:44:16', 19),
(54, 5, '2020-06-10 00:42:38', 19),
(53, 27, '2020-06-10 00:09:54', 17),
(52, 12, '2020-06-10 00:09:39', 17),
(51, 34, '2020-06-10 00:09:20', 17),
(50, 3, '2020-06-10 00:08:16', 17),
(49, 24, '2020-06-10 00:07:26', 17),
(48, 5, '2020-06-10 00:07:00', 17),
(47, 16, '2020-06-10 00:06:05', 17),
(65, 20, '2020-06-10 00:56:06', 13),
(66, 38, '2020-06-10 01:03:37', 13),
(67, 56, '2020-06-10 01:18:10', 13),
(68, 2, '2020-06-13 18:16:25', 14),
(69, 7, '2020-06-13 18:17:08', 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primeiro` text NOT NULL,
  `apelido` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `data_nasc` text NOT NULL,
  `email` text NOT NULL,
  `permissao` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `primeiro`, `apelido`, `username`, `password`, `data_nasc`, `email`, `permissao`) VALUES
(13, 'Marcos', 'Ferreira', 'scratchuz4k', '123', '1212-12-12', 'whiteknight96@hotmail.com', 2),
(14, 'Marcos', 'Ferreira', 'aaa', '123', '1996-12-12', 'asd@asd.asd', 2),
(16, 'Marcos', 'Ferreira', 'asass', 'asd', '2020-05-25', 'aaht96@hotmail.com', 0),
(17, 'Helder', 'Abrantes', 'xuxu', '123', '1999-08-25', 'helder@hotmail.com', 1),
(18, 'Rui', 'Agostinho', 'roi', '123', '2001-07-22', 'rui@hotmail.com', 1),
(19, 'EugÃ©nia', 'RascÃ£o', 'genita', '123', '1991-03-12', 'eugenia@gmail.com', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
