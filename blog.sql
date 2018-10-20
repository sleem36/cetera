-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2018 at 04:42 
-- Server version: 5.5.25
-- PHP Version: 5.6.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `date`, `name`, `message`) VALUES
(44, '2018-10-20 18:18:57', 'Вячеслав Баженов', 'asd fasd fsad fa'),
(51, '2018-10-20 18:28:05', 'sdf', 's вапы вап'),
(55, '2018-10-20 18:31:08', 'slom', 'sfdg ыва пыва п'),
(56, '2018-10-20 18:31:21', 'kometa', 'sfdg ыва пыва п'),
(57, '2018-10-20 18:31:41', 'parashut', 'Бывает же'),
(58, '2018-10-20 20:07:55', 'asg ', ' dsfgsd'),
(59, '2018-10-20 20:07:57', 'asg ', ' dsfgsd'),
(60, '2018-10-20 20:07:59', 'asg ', ' dsfgsd'),
(61, '2018-10-20 20:08:02', 'asg ', ' dsfgsd'),
(62, '2018-10-20 20:08:04', 'asg ', ' dsfgsd'),
(63, '2018-10-20 21:15:29', 'Постный пост', 'вот он ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `pass`) VALUES
(1, 'demo', 'demo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
