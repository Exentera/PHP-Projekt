-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Jan 2025 um 14:29
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cg`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cards`
--

CREATE TABLE `cards` (
  `card_id` int(11) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `energy_cost` int(11) DEFAULT NULL,
  `power` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `card_unlock_requirements`
--

CREATE TABLE `card_unlock_requirements` (
  `card_id` int(11) NOT NULL,
  `required_deck_xp` int(11) NOT NULL,
  `unlocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `decks`
--

CREATE TABLE `decks` (
  `deck_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deck_name` varchar(100) DEFAULT NULL,
  `xp` int(11) DEFAULT 0,
  `energy_points` int(11) DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `deck_cards`
--

CREATE TABLE `deck_cards` (
  `deck_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game_moves`
--

CREATE TABLE `game_moves` (
  `move_id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `energy_spent` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `move_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game_sessions`
--

CREATE TABLE `game_sessions` (
  `game_id` int(11) NOT NULL,
  `player1_id` int(11) DEFAULT NULL,
  `player2_id` int(11) DEFAULT NULL,
  `turn` int(11) DEFAULT 1,
  `winner_id` int(11) DEFAULT NULL,
  `game_status` enum('waiting','in_progress','finished') DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `game_sessions`
--

INSERT INTO `game_sessions` (`game_id`, `player1_id`, `player2_id`, `turn`, `winner_id`, `game_status`, `created_at`) VALUES
(1, 3, 15, 103, NULL, 'waiting', '2025-01-10 10:51:51');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(3, 'Seto Kaiber', '', '$2y$10$uJUl63.tPPHjawfj.g4QAeZ1royYIh/nzWmQXt.X4NOQ1farYGiBG', '2025-01-07 15:18:03'),
(11, 'Moin', '', '$2y$10$3ptnv2OesmrrfXwAUencWOidZGTUAz71TH17hmCKYFnoYDVNA3pyW', '2025-01-08 12:16:45'),
(12, 'Rei', '', '$2y$10$SKvwaPb0rFMJRPHvF6gILOqoI/awaCRw13df6qh7GrsKDsBgir.8i', '2025-01-08 12:23:18'),
(13, '1234', '', '$2y$10$rHS2KSi/ygmw8X3Yc3NA.uMz/BtbHthRrkHlNOE39j2Vo2xHy2Dum', '2025-01-08 12:25:21'),
(14, 'omi', '', '$2y$10$0KRpn38nGyoDdJ2Y2hZQBOQ4ygTE2SnwlIp0g9XbWtbkqsaYM8KT2', '2025-01-08 12:51:08'),
(15, 'Yugi', '', '$2y$10$Md9d07Vy0LILXJC.gwpKAuoowQsCCJtBBAJQOKjF.HmlLtD.iXfRG', '2025-01-09 11:35:12');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`);

--
-- Indizes für die Tabelle `card_unlock_requirements`
--
ALTER TABLE `card_unlock_requirements`
  ADD PRIMARY KEY (`card_id`,`required_deck_xp`);

--
-- Indizes für die Tabelle `decks`
--
ALTER TABLE `decks`
  ADD PRIMARY KEY (`deck_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `deck_cards`
--
ALTER TABLE `deck_cards`
  ADD PRIMARY KEY (`deck_id`,`card_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indizes für die Tabelle `game_moves`
--
ALTER TABLE `game_moves`
  ADD PRIMARY KEY (`move_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indizes für die Tabelle `game_sessions`
--
ALTER TABLE `game_sessions`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `player1_id` (`player1_id`),
  ADD KEY `player2_id` (`player2_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `decks`
--
ALTER TABLE `decks`
  MODIFY `deck_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `game_moves`
--
ALTER TABLE `game_moves`
  MODIFY `move_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `game_sessions`
--
ALTER TABLE `game_sessions`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `card_unlock_requirements`
--
ALTER TABLE `card_unlock_requirements`
  ADD CONSTRAINT `card_unlock_requirements_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`);

--
-- Constraints der Tabelle `decks`
--
ALTER TABLE `decks`
  ADD CONSTRAINT `decks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `deck_cards`
--
ALTER TABLE `deck_cards`
  ADD CONSTRAINT `deck_cards_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`deck_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deck_cards_ibfk_2` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `game_moves`
--
ALTER TABLE `game_moves`
  ADD CONSTRAINT `game_moves_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game_sessions` (`game_id`),
  ADD CONSTRAINT `game_moves_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `game_moves_ibfk_3` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`);

--
-- Constraints der Tabelle `game_sessions`
--
ALTER TABLE `game_sessions`
  ADD CONSTRAINT `game_sessions_ibfk_1` FOREIGN KEY (`player1_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `game_sessions_ibfk_2` FOREIGN KEY (`player2_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
