-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Sty 2023, 21:54
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bsibase`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `block_login`
--

CREATE TABLE `block_login` (
  `id` int(11) NOT NULL,
  `badLoginNum` int(11) NOT NULL,
  `lastBadLoginNum` varchar(11) DEFAULT NULL,
  `pernamentLock` tinyint(4) DEFAULT NULL,
  `tempLock` int(11) DEFAULT NULL,
  `ipAddress` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `block_login`
--

INSERT INTO `block_login` (`id`, `badLoginNum`, `lastBadLoginNum`, `pernamentLock`, `tempLock`, `ipAddress`) VALUES
(3, 5, '2023-01-08 ', NULL, 1673211903, '127.0.0.1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logged_in_users`
--

CREATE TABLE `logged_in_users` (
  `sessionId` varchar(100) NOT NULL,
  `userId` int(10) NOT NULL,
  `lastUpdate` datetime NOT NULL,
  `logSuccess` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL,
  `ipAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `logged_in_users`
--

INSERT INTO `logged_in_users` (`sessionId`, `userId`, `lastUpdate`, `logSuccess`, `id`, `ipAddress`) VALUES
('', 138, '2023-01-08 19:45:45', 0, 89, '127.0.0.1'),
('fe0jhclc23e36gi9rtp98fr1ee', 138, '2023-01-08 19:57:05', 1, 90, '127.0.0.1'),
('', 138, '2023-01-08 21:13:59', 0, 91, '127.0.0.1'),
('', 138, '2023-01-08 21:14:14', 0, 92, '127.0.0.1'),
('', 138, '2023-01-08 21:14:27', 0, 93, '127.0.0.1'),
('cancdar4196cvhrph403s1e8ub', 138, '2023-01-08 21:30:20', 1, 94, '127.0.0.1'),
('', 138, '2023-01-08 21:30:50', 0, 95, '127.0.0.1'),
('', 138, '2023-01-08 21:32:25', 0, 96, '127.0.0.1'),
('', 138, '2023-01-08 21:32:57', 0, 97, '127.0.0.1'),
('', 138, '2023-01-08 21:33:17', 0, 98, '127.0.0.1'),
('', 138, '2023-01-08 21:36:09', 0, 99, '127.0.0.1'),
('', 138, '2023-01-08 21:36:53', 0, 100, '127.0.0.1'),
('', 138, '2023-01-08 21:42:29', 0, 101, '127.0.0.1'),
('', 138, '2023-01-08 21:43:00', 0, 102, '127.0.0.1'),
('', 138, '2023-01-08 21:43:40', 0, 103, '127.0.0.1'),
('cancdar4196cvhrph403s1e8ub', 139, '2023-01-08 21:44:40', 1, 104, '127.0.0.1'),
('', 139, '2023-01-08 21:45:04', 0, 105, '127.0.0.1'),
('v9qhslo0p22d8l5h479fe16phu', 139, '2023-01-08 21:47:55', 1, 106, '127.0.0.1'),
('', 139, '2023-01-08 21:48:28', 0, 107, '127.0.0.1'),
('', 139, '2023-01-08 21:49:32', 0, 108, '127.0.0.1'),
('', 139, '2023-01-08 21:49:51', 0, 109, '127.0.0.1'),
('', 139, '2023-01-08 21:52:18', 0, 110, '127.0.0.1'),
('', 139, '2023-01-08 21:52:25', 0, 111, '127.0.0.1'),
('', 139, '2023-01-08 21:52:33', 0, 112, '127.0.0.1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password`
--

CREATE TABLE `password` (
  `id_password` int(11) NOT NULL,
  `login` varchar(80) NOT NULL,
  `password` varchar(256) NOT NULL,
  `web_address` varchar(100) NOT NULL,
  `description` varchar(256) NOT NULL,
  `userId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `password`
--

INSERT INTO `password` (`id_password`, `login`, `password`, `web_address`, `description`, `userId`) VALUES
(69, 'dssda', 'wpAQifxWFQrUNrZK/W0M8Q==', 'dsadsa', 'dsadsa', 135),
(84, 'dasda', 'emBJ/cEdrjHDr7uhIHX8zQ==', 'zzz', 'dasda', 138);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `login` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `login`, `email`, `password`, `salt`) VALUES
(135, 'szymon', 'szsz@wp.pl', '$2y$10$3ngPNMusmxlxLVZvhU6W/eM3GVsi7yyo2TiQ8Pr/G7TSR4B.6XTVW', '2LcTZM396d'),
(136, 'www', 'www@wp.pl', '$2y$10$NbP8TSLoSro0IqF2ahdfFedrY25v.va9Upoqxom9VFVZEQIDPkVwO', 'cCLpYM8Zg'),
(137, 'szsz', 'wwaaw@wp.pl', '$2y$10$PhBgl2686d7rQWlIduKyuOa1kqvpU2Z4QxDlPbvrWzUKj/3IIZvke', 'sNIMjItIWc'),
(138, 'ddd', 'ddd@wp.pl', '$2y$10$b0zsbXkB6g6.7wd2VUYtfO9MhQz7H5GUaFHgvYr.CXmZAsjzAB/cO', 'xX0Q22SyRN'),
(139, 'rrr', 'ddd@wp.pl', '$2y$10$/ehrVRDbtZa0PQ6GoD1hKOZbD6hYNAPkaUbkR2bwZ6MFp.mdW088e', '7UF2bVwu6');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `block_login`
--
ALTER TABLE `block_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessionId` (`sessionId`),
  ADD KEY `userId` (`userId`);

--
-- Indeksy dla tabeli `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`id_password`),
  ADD KEY `id_password` (`id_password`),
  ADD KEY `userId` (`userId`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `block_login`
--
ALTER TABLE `block_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT dla tabeli `password`
--
ALTER TABLE `password`
  MODIFY `id_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD CONSTRAINT `logged_in_users_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `password`
--
ALTER TABLE `password`
  ADD CONSTRAINT `password_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
