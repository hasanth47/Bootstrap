-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 jun 2025 om 10:29
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerling`
--

CREATE TABLE `leerling` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `klas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leerling`
--

INSERT INTO `leerling` (`id`, `naam`, `klas`) VALUES
(1, 'Sophia de Vries', 'T2K'),
(2, 'Achemed Akkabi', 'T2K'),
(3, 'Sjoerd Binnendelijk', 'T2J');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `toets`
--

CREATE TABLE `toets` (
  `id` int(11) NOT NULL,
  `vak` varchar(50) NOT NULL,
  `cijfer` int(11) NOT NULL,
  `leerling_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `toets`
--

INSERT INTO `toets` (`id`, `vak`, `cijfer`, `leerling_id`) VALUES
(1, 'Engels', 7, 1),
(2, 'Duits', 2, 1),
(3, 'Databases', 6, 1),
(4, 'Engels', 8, 2),
(5, 'PHP', 9, 2),
(6, 'Nederlands', 6, 3),
(7, 'PHP', 9, 3);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `leerling`
--
ALTER TABLE `leerling`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `toets`
--
ALTER TABLE `toets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leerling_id` (`leerling_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `leerling`
--
ALTER TABLE `leerling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `toets`
--
ALTER TABLE `toets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `toets`
--
ALTER TABLE `toets`
  ADD CONSTRAINT `toets_ibfk_1` FOREIGN KEY (`leerling_id`) REFERENCES `leerling` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;