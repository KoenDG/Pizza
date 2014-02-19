-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 19 feb 2014 om 12:37
-- Serverversie: 5.5.32
-- PHP-versie: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `pizzadb`
--
CREATE DATABASE IF NOT EXISTS `pizzadb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pizzadb`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` varchar(40) NOT NULL,
  `gemeente_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `pwhash` binary(120) NOT NULL,
  `registratiedatum` datetime NOT NULL,
  `vnaam` varchar(45) NOT NULL,
  `anaam` varchar(45) NOT NULL,
  `leveradres` varchar(45) NOT NULL,
  `huisNr` varchar(10) NOT NULL,
  `telefoon` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_Accounts_Gemeente_idx` (`gemeente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `accounts`
--

INSERT INTO `accounts` (`id`, `gemeente_id`, `email`, `pwhash`, `registratiedatum`, `vnaam`, `anaam`, `leveradres`, `huisNr`, `telefoon`) VALUES
('VKycGVv7g2BlSHXq4IAHhA', 6, 'degroote.koen@gmail.com', '243279243131246847706C36594347456B764C594D54594C793945324F302F5665574B5A776232584B7039356238436A52392E48736E786D72627A4B', '2014-01-24 11:40:03', 'Koen', 'De Groote', 'Ooievaarstraat', '93', '0496430010');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `accounts_public`
--
CREATE TABLE IF NOT EXISTS `accounts_public` (
`id` varchar(40)
,`gemeente_id` int(11)
,`vnaam` varchar(45)
,`anaam` varchar(45)
,`leveradres` varchar(45)
,`huisNr` varchar(10)
,`telefoon` varchar(45)
);
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE IF NOT EXISTS `bestellingen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(40) NOT NULL,
  `afgehandeld` tinyint(1) NOT NULL DEFAULT '0',
  `tBesteld` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Bestellingen_Account_idx` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `account_id`, `afgehandeld`, `tBesteld`) VALUES
(1, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 13:50:10'),
(2, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 14:22:50'),
(3, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 14:25:38'),
(4, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 14:26:44'),
(5, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 14:30:53'),
(6, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 14:32:36'),
(7, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 14:35:10'),
(8, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-01-28 14:39:12'),
(9, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-02-19 11:45:28'),
(10, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-02-19 11:47:42'),
(11, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-02-19 11:48:06'),
(12, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-02-19 11:51:56'),
(13, 'VKycGVv7g2BlSHXq4IAHhA', 0, '2014-02-19 11:55:54');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling_details`
--

CREATE TABLE IF NOT EXISTS `bestelling_details` (
  `Bestellingen_id` int(11) NOT NULL,
  `Pizzas_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  PRIMARY KEY (`Bestellingen_id`,`Pizzas_id`),
  KEY `fk_Bestelling_Details_Pizzas_idx` (`Pizzas_id`),
  KEY `fk_Bestelling_Details_Bestellingen_idx` (`Bestellingen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `bestelling_details`
--

INSERT INTO `bestelling_details` (`Bestellingen_id`, `Pizzas_id`, `aantal`) VALUES
(8, 1, 1),
(8, 2, 2),
(9, 1, 2),
(12, 1, 1),
(12, 4, 2),
(13, 1, 1),
(13, 3, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gemeentes`
--

CREATE TABLE IF NOT EXISTS `gemeentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `code` int(11) NOT NULL,
  `leverbaar` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `gemeentes`
--

INSERT INTO `gemeentes` (`id`, `naam`, `code`, `leverbaar`) VALUES
(1, 'Aaigem', 9420, 1),
(2, 'Aalst', 9300, 0),
(3, 'Aalter', 9880, 1),
(4, 'Adegem', 9991, 0),
(5, 'Afsnee', 9051, 1),
(6, 'Appels', 9200, 1),
(7, 'Appelterre-Eichem', 9400, 1),
(8, 'Aspelare', 9404, 1),
(9, 'Asper', 9890, 1),
(10, 'Assenede', 9960, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pizzas`
--

CREATE TABLE IF NOT EXISTS `pizzas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `prijs` varchar(6) NOT NULL,
  `beschikbaar` tinyint(1) NOT NULL,
  `calorien` int(11) NOT NULL,
  `samenstelling` text NOT NULL,
  `omschrijving` text NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `pizzas`
--

INSERT INTO `pizzas` (`id`, `naam`, `prijs`, `beschikbaar`, `calorien`, `samenstelling`, `omschrijving`, `foto`) VALUES
(1, '4 Kazen', '5', 1, 300, 'Veel kaas', 'De 4 kazen pizza', ''),
(2, 'Hawai', '5', 1, 200, 'Ananas, ham', 'Pizza met ananas en ham', ''),
(3, 'Margherita', '5', 1, 200, 'Geitenkaas denk ik', 'Pizza met geitenkaas', ''),
(4, 'Pepperoni', '5', 1, 200, 'Pepperoni', 'Pizza met stukjes Pepperoni.', '');

-- --------------------------------------------------------

--
-- Structuur voor de view `accounts_public`
--
DROP TABLE IF EXISTS `accounts_public`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `accounts_public` AS select `accounts`.`id` AS `id`,`accounts`.`gemeente_id` AS `gemeente_id`,`accounts`.`vnaam` AS `vnaam`,`accounts`.`anaam` AS `anaam`,`accounts`.`leveradres` AS `leveradres`,`accounts`.`huisNr` AS `huisNr`,`accounts`.`telefoon` AS `telefoon` from `accounts`;

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `fk_Accounts_Gemeente` FOREIGN KEY (`gemeente_id`) REFERENCES `gemeentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `fk_Bestellingen_Accounts1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `bestelling_details`
--
ALTER TABLE `bestelling_details`
  ADD CONSTRAINT `fk_Bestelling_Details_Bestellingen` FOREIGN KEY (`Bestellingen_id`) REFERENCES `bestellingen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bestelling_Details_Pizzas` FOREIGN KEY (`Pizzas_id`) REFERENCES `pizzas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
