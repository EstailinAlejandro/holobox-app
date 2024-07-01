-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 feb 2024 om 11:14
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rocmondriaan_info`
--
CREATE DATABASE IF NOT EXISTS `rocmondriaan_info` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rocmondriaan_info`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `branche`
--

DROP TABLE IF EXISTS `branche`;
CREATE TABLE `branche` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `branche`
--

INSERT INTO `branche` (`id`, `name`, `img`) VALUES
(1, 'ICT', ''),
(2, 'Techniek\r\n', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learning_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `course`
--

INSERT INTO `course` (`id`, `name`, `learning_path`, `niveau`, `durence`, `start`, `branch_id`) VALUES
(1, 'Medewerker ICT support', 'Niveau 2, bol', '', '', '', 1),
(2, 'System & Devices', 'bol 3/4', '', '', '', 1),
(3, 'dvsdsddsaasdasd', 'sdsssadsadsasa', '', '', '', 1),
(4, 'sdasaddsasdasad', 'asdsadsadsadasddsa', '', '', '', 1),
(5, 'sadsad', 'dsadasads', '', '', '', 1),
(6, 'saddsasdasad', 'asdadsdsadsa', '', '', '', 1),
(7, 'asdadssdaasd', 'saddsadsasda', '', '', '', 1),
(8, 'sdadsaasdsad', 'asdsadsaddas', '', '', '', 1),
(9, 'baannaan', 'Bol-3', '', '', '', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231120121900', '2023-11-20 13:19:04', 42),
('DoctrineMigrations\\Version20231122084044', '2023-11-22 11:35:29', 135),
('DoctrineMigrations\\Version20231122084359', '2023-11-22 11:35:29', 153),
('DoctrineMigrations\\Version20231122093133', '2023-11-22 11:35:29', 191),
('DoctrineMigrations\\Version20231129110751', '2023-11-29 12:07:57', 19),
('DoctrineMigrations\\Version20240212091929', '2024-02-12 11:09:20', 109);
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `video`
--

INSERT INTO `video` (`id`, `filename`, `name`, `course_id`) VALUES
(1, 'video_of_funny_cat (1080p)-655b537d5eadb.mp4', 'ccat', 1),
(3, 'video_of_funny_cat (1080p)-655c83904ac89.mp4', 'cat3', NULL),
(4, 'video_of_funny_cat (1080p)-655c8399c8be9.mp4', 'cat4', NULL),
(5, 'video_of_funny_cat (1080p)-655c83a1c58aa.mp4', 'cat5', NULL),
(6, '2020-04-02_04_26_53_A_single_Nacho_Cheese_Dorito_chip_in_the_Franklin_Farm_section_of_Oak_Hill,_Fairfax_County,_Virginia-657af79fcdc2f.jpg', 'dolan', NULL);
(5, 'video_of_funny_cat (1080p)-655c83a1c58aa.mp4', 'cat5', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `branche`
--
ALTER TABLE `branche`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_169E6FB9DCD6CC49` (`branch_id`);

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CC7DA2C591CC992` (`course_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `branche`
--
ALTER TABLE `branche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_169E6FB9DCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `branche` (`id`);

--
-- Beperkingen voor tabel `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2C591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
