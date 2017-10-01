-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: 192.168.43.162
-- Erstellungszeit: 22. Apr 2016 um 18:16
-- Server Version: 5.1.73rel14.11
-- PHP-Version: 5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `102707_0`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `email`, `password`) VALUES
(1, 'admin@outlook.com', '111111');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_buy`
--

CREATE TABLE IF NOT EXISTS `tbl_buy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `changes` varchar(100) NOT NULL,
  `dates` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Daten für Tabelle `tbl_buy`
--

INSERT INTO `tbl_buy` (`id`, `userid`, `symbol`, `name`, `changes`, `dates`, `price`, `quantity`) VALUES
(3, 6, 'AAPL', 'Apple Inc.', '-2.25', '2016-04-15 16:00:00', '70', '100'),
(4, 7, 'APC.F', 'APPLE', '-1.894', '2016-04-15 19:46:00', '97.69', '0'),
(5, 7, 'APC.F', 'APPLE', '-1.894', '2016-04-15 19:46:00', '97.69', '300'),
(6, 7, 'LHA.DE', 'Deutsche Lufthansa Aktiengesellschaft', '+0.06', '2016-04-15 17:35:00', '14.19', '1000'),
(7, 8, 'APC.F', 'APPLE', '-1.894', '2016-04-15 19:46:00', '97.69', '0'),
(8, 10, 'APC.F', 'APPLE', '-2.052', '2016-04-18 18:02:00', '95.64', '0'),
(9, 10, 'LHA.DE', 'Deutsche Lufthansa Aktiengesellschaft', '-0.260', '2016-04-18 17:35:00', '13.94', '100'),
(10, 10, 'GOOG', 'Alphabet Inc.', '+1.26', '2016-04-18 09:56:00', '672.86', '0'),
(11, 10, 'ADS.BE', 'ADIDAS N', '+0.58', '2016-04-18 11:51:00', '104.84', '10'),
(12, 10, 'TL0.BE', 'TESLA MOTORS', '+3.25', '2016-04-18 15:40:00', '226.88', '0'),
(13, 10, '2FE.BE', 'FERRARI', '+1.50', '2016-04-18 17:39:00', '39.20', '0'),
(14, 10, '2FE.DU', 'FERRARI', '+4.170', '2016-03-01 12:59:00', '35.40', '200'),
(15, 6, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.92', '0'),
(16, 6, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '70', '1'),
(17, 6, 'DB', 'Deutsche Bank AG', '+0.39', '2016-04-18 20:00:00', '15.62', '100'),
(18, 12, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.92', '0'),
(19, 12, 'DB', 'Deutsche Bank AG', '+0.39', '2016-04-18 20:00:00', '15.62', '0'),
(20, 12, 'BMW.F', 'BMW', '', '2016-04-19 13:05:00', '70', '0'),
(21, 12, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '70', '0'),
(22, 12, 'ADS.BE', 'ADIDAS N', '', '2016-04-18 11:51:00', '70', '0'),
(23, 13, 'APC.F', 'APPLE', '+0.430', '2016-04-19 14:27:00', '95.08', '0'),
(24, 13, 'ADS.DE', 'Adidas AG', '', '2016-04-18 17:35:00', '100', '102'),
(25, 13, 'TL0.BE', 'TESLA MOTORS', '', '2016-04-19 10:34:00', '190', '120'),
(26, 14, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '70', '0'),
(27, 14, 'APC.F', 'APPLE', '+0.301', '2016-04-19 08:24:00', '70', '1'),
(28, 12, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.90', '0'),
(29, 12, 'APC.F', 'APPLE', '', '2016-04-19 08:24:00', '50', '5'),
(30, 12, 'APC.F', 'APPLE', '-1.215', '2016-04-19 18:47:00', '93.43', '0'),
(31, 12, 'APC.DE', 'Apple Inc.', '', '2016-04-20 12:26:21', '70', '0'),
(32, 12, '^VXGOG', 'CBOE EQUITY VIXON GOOGLE', '', '2016-04-20 12:46:41', '15', '0'),
(33, 12, 'LHA.DE', 'Deutsche Lufthansa Aktiengesellschaft', '', '2016-04-20 13:17:38', '10', '0'),
(34, 12, 'ADS.F', 'ADIDAS N', '-0.792', '2016-04-20 14:28:56', '107.59', '10'),
(35, 12, 'SAP.DE', 'SAP SE', '-0.62', '2016-04-20 14:29:51', '70.41', '0'),
(36, 12, 'PLR.BE', 'PILBARA MINERAL', '+0.05', '2016-04-20 14:30:48', '0.45', '0'),
(37, 12, 'APC.F', 'APPLE', '', '2016-04-21 12:00:54', '70', '1'),
(38, 17, 'APC.F', 'APPLE', '', '2016-03-21 12:07:00', '70', '0'),
(39, 12, 'ADS.DE', 'Adidas AG', '-2.15', '2016-04-21 13:09:19', '105.25', '1'),
(40, 18, 'APC.DE', 'Apple Inc.', '', '2016-04-21 13:19:29', '70', '0'),
(41, 18, 'APC.DE', 'Apple Inc.', '', '2016-04-21 13:25:38', '90', '100'),
(42, 12, 'APC.DE', 'Apple Inc.', '-1.27', '2016-04-21 17:55:42', '93.95', '100'),
(43, 12, 'APC.F', 'APPLE', '-1.307', '2016-04-21 18:00:02', '93.99', '800'),
(44, 20, 'APC.F', 'APPLE', '-1.307', '2016-04-21 18:18:25', '93.99', '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_desc`
--

CREATE TABLE IF NOT EXISTS `tbl_desc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc1` varchar(200) NOT NULL,
  `desc2` varchar(200) NOT NULL,
  `desc3` varchar(200) NOT NULL,
  `desc4` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `tbl_desc`
--

INSERT INTO `tbl_desc` (`id`, `desc1`, `desc2`, `desc3`, `desc4`) VALUES
(2, 'Berliner Bank', 'DE1231 213131 3121', 'BIC 1231313 ', '35135135');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_sell`
--

CREATE TABLE IF NOT EXISTS `tbl_sell` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `changes` varchar(100) NOT NULL,
  `dates` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Daten für Tabelle `tbl_sell`
--

INSERT INTO `tbl_sell` (`id`, `userid`, `symbol`, `name`, `changes`, `dates`, `price`, `quantity`) VALUES
(4, 7, 'APC.F', 'APPLE', '-1.894', '2016-04-15 19:46:00', '97.69', '300'),
(5, 8, 'APC.F', 'APPLE', '-1.894', '2016-04-15 19:46:00', '97.69', '100'),
(6, 10, 'APC.F', 'APPLE', '-2.052', '2016-04-18 18:02:00', '96.32', '100'),
(7, 10, 'GOOG', 'Alphabet Inc.', '+1.26', '2016-04-18 09:56:00', '677.52', '5'),
(8, 10, 'TL0.BE', 'TESLA MOTORS', '+3.25', '2016-04-18 15:40:00', '226.88', '1'),
(9, 10, 'TL0.BE', 'TESLA MOTORS', '+3.25', '2016-04-18 15:40:00', '226.88', '19'),
(10, 10, '2FE.BE', 'FERRARI', '+1.50', '2016-04-18 17:39:00', '39.20', '60'),
(11, 6, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.92', '1'),
(12, 12, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.92', '100'),
(13, 13, 'APC.F', 'APPLE', '+0.430', '2016-04-19 14:27:00', '94.65', '100'),
(14, 12, 'DB', 'Deutsche Bank AG', '+0.39', '2016-04-18 20:00:00', '15.60', '1'),
(15, 14, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.76', '100'),
(16, 12, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.43', '1'),
(17, 12, 'AAPL', 'Apple Inc.', '-2.37', '2016-04-18 16:00:00', '94.10', '10'),
(18, 12, 'ADS.BE', 'ADIDAS N', '', '2016-04-18 11:51:00', '108.29', '80'),
(19, 12, '^VXGOG', 'CBOE EQUITY VIXON GOOGLE', '', '2016-04-20 12:46:41', '26.60', '1'),
(20, 12, 'SAP.DE', 'SAP SE', '-0.62', '2016-04-20 14:29:51', '71.03', '12'),
(21, 12, 'SAP.DE', 'SAP SE', '-0.62', '2016-04-20 14:29:51', '70.85', '8'),
(22, 12, 'PLR.BE', 'PILBARA MINERAL', '+0.05', '2016-04-20 14:30:48', '0.47', '10000'),
(23, 12, 'LHA.DE', 'Deutsche Lufthansa Aktiengesellschaft', '', '2016-04-20 13:17:38', '14.09', '100'),
(24, 12, 'BMW.F', 'BMW', '', '2016-04-19 13:05:00', '84.23', '1'),
(25, 12, 'APC.F', 'APPLE', '-1.215', '2016-04-19 18:47:00', '93.72', '1'),
(26, 12, 'APC.DE', 'Apple Inc.', '', '2016-04-20 12:26:21', '93.92', '1'),
(27, 12, 'APC.F', 'APPLE', '', '2016-04-21 12:00:54', '95.30', '100'),
(28, 17, 'APC.F', 'APPLE', '', '2016-03-21 12:07:00', '95.30', '300'),
(29, 18, 'APC.DE', 'Apple Inc.', '', '2016-04-21 13:19:29', '95.22', '100'),
(30, 12, '^VXGOG', 'CBOE EQUITY VIXON GOOGLE', '', '2016-04-20 12:46:41', '27.14', '10');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `balance` double NOT NULL DEFAULT '1000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Daten für Tabelle `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `name`, `street`, `phone`, `balance`) VALUES
(20, 'hans@test.de', '123456', 'Hans MÃ¼ller0', 'Hansstr 200', '0202312130', 99906.01),
(12, 'test@test.de', '111111', 'Sebastian, MÃ¼ller0', 'MÃ¼hlengassee 250', '020301020120', 17073.15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
