-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Jun 2019 um 08:33
-- Server-Version: 10.1.40-MariaDB
-- PHP-Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `pizzaservice`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot`
--

CREATE TABLE `angebot` (
  `PizzaNummer` bigint(20) UNSIGNED NOT NULL,
  `PizzaName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Bilddatei` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Preis` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `angebot`
--

INSERT INTO `angebot` (`PizzaNummer`, `PizzaName`, `Bilddatei`, `Preis`) VALUES
(1, 'FerisPizza', '../Bilder/pizza.png', '13.99'),
(2, 'MargheritaExtraKäse', '../Bilder/Pizza.png', '4.50'),
(3, 'SalamiExtraKäse', '../Bilder/Pizza.png', '6.00'),
(4, 'Margherita', '../Bilder/Pizza.png', '4.00'),
(5, 'Salami', '../Bilder/Pizza.png', '4.50'),
(6, 'Prosciutto', '../Bilder/Pizza.png', '5.50'),
(7, 'Tonno', '../Bilder/Pizza.png', '5.00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestelltepizza`
--

CREATE TABLE `bestelltepizza` (
  `PizzaID` bigint(20) UNSIGNED NOT NULL,
  `fBestellungID` bigint(20) UNSIGNED NOT NULL,
  `fPizzaNummer` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestelltepizza`
--

INSERT INTO `bestelltepizza` (`PizzaID`, `fBestellungID`, `fPizzaNummer`) VALUES
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 5),
(8, 14, 7),
(9, 14, 6),
(10, 15, 1),
(11, 15, 6),
(12, 15, 7),
(13, 16, 1),
(14, 16, 6),
(15, 16, 5),
(16, 17, 1),
(17, 17, 7),
(18, 17, 6),
(19, 17, 5),
(20, 18, 1),
(21, 18, 7),
(22, 18, 6),
(23, 18, 5),
(24, 18, 4),
(25, 18, 3),
(26, 19, 1),
(27, 20, 7),
(28, 21, 7),
(29, 21, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `BestellungID` bigint(20) UNSIGNED NOT NULL,
  `Adresse` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Bestellzeitpunkt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Status` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Bestellt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`BestellungID`, `Adresse`, `Bestellzeitpunkt`, `Status`) VALUES
(2, 'TEST FERRI 11111', '2019-06-14 13:06:08', 'Geliefert'),
(3, 'TEST FERRI 11111', '2019-06-17 10:09:34', 'Geliefert'),
(4, 'sdf sfd 11111', '2019-06-17 10:09:36', 'Geliefert'),
(5, 'js js 64297', '2019-06-17 10:10:42', 'Geliefert'),
(6, 'TEST adf 11111', '2019-06-17 19:36:43', 'Geliefert'),
(7, '  ', '2019-06-17 19:36:46', 'Geliefert'),
(8, '  ', '2019-06-17 19:16:42', 'Bestellt'),
(9, 'TEST adf 11111', '2019-06-17 19:19:19', 'Bestellt'),
(10, 'TEST adf 11111', '2019-06-17 19:19:40', 'Bestellt'),
(11, 'TEST adf 11111', '2019-06-17 19:24:12', 'Bestellt'),
(12, '  ', '2019-06-17 19:32:43', 'Bestellt'),
(13, '  ', '2019-06-17 19:33:19', 'Bestellt'),
(14, 'TEST adf 64297', '2019-06-17 19:36:44', 'Geliefert'),
(15, 'TEST adf 11111', '2019-06-17 19:37:34', 'Geliefert'),
(16, 'TEST adf 11111', '2019-06-17 19:58:20', 'Geliefert'),
(17, 'FERRI adf 64297', '2019-06-17 19:58:25', 'Geliefert'),
(18, 'TEST adf 11111', '2019-06-17 19:58:27', 'Geliefert'),
(19, 'asf adf 11111', '2019-06-17 19:58:30', 'Geliefert'),
(20, 'safdaf agag 77777', '2019-06-17 19:58:32', 'Geliefert'),
(21, '&lt;h1&gt;xxx&lt;/h1&gt; &lt;h', '2019-06-17 20:01:20', 'Fertig');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `angebot`
--
ALTER TABLE `angebot`
  ADD PRIMARY KEY (`PizzaNummer`),
  ADD UNIQUE KEY `PizzaNummer` (`PizzaNummer`);

--
-- Indizes für die Tabelle `bestelltepizza`
--
ALTER TABLE `bestelltepizza`
  ADD PRIMARY KEY (`PizzaID`),
  ADD UNIQUE KEY `PizzaID` (`PizzaID`),
  ADD KEY `fk_bestellung` (`fBestellungID`),
  ADD KEY `fk_pizza` (`fPizzaNummer`);

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`BestellungID`),
  ADD UNIQUE KEY `BestellungID` (`BestellungID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `angebot`
--
ALTER TABLE `angebot`
  MODIFY `PizzaNummer` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `bestelltepizza`
--
ALTER TABLE `bestelltepizza`
  MODIFY `PizzaID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `BestellungID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestelltepizza`
--
ALTER TABLE `bestelltepizza`
  ADD CONSTRAINT `fk_bestellung` FOREIGN KEY (`fBestellungID`) REFERENCES `bestellung` (`BestellungID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pizza` FOREIGN KEY (`fPizzaNummer`) REFERENCES `angebot` (`PizzaNummer`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
