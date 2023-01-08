-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Sty 2023, 20:00
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
  `lastBadLoginNum` int(11) DEFAULT NULL,
  `pernamentLock` tinyint(4) DEFAULT NULL,
  `tempLock` int(11) DEFAULT NULL,
  `ipAddress` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `block_login`
--

INSERT INTO `block_login` (`id`, `badLoginNum`, `lastBadLoginNum`, `pernamentLock`, `tempLock`, `ipAddress`) VALUES
(2, 0, NULL, NULL, NULL, '127.0.0.1');

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
('', 138, '2023-01-08 19:40:09', 0, 77, '127.0.0.1'),
('', 138, '2023-01-08 19:40:57', 0, 78, '127.0.0.1'),
('', 138, '2023-01-08 19:41:13', 0, 79, '127.0.0.1'),
('', 138, '2023-01-08 19:41:36', 0, 80, '127.0.0.1'),
('', 138, '2023-01-08 19:41:48', 0, 81, '127.0.0.1'),
('', 138, '2023-01-08 19:43:33', 0, 82, '127.0.0.1'),
('fe0jhclc23e36gi9rtp98fr1ee', 138, '2023-01-08 19:43:59', 1, 83, '127.0.0.1'),
('fe0jhclc23e36gi9rtp98fr1ee', 138, '2023-01-08 19:44:59', 1, 84, '127.0.0.1'),
('fe0jhclc23e36gi9rtp98fr1ee', 138, '2023-01-08 19:45:02', 1, 85, '127.0.0.1'),
('', 138, '2023-01-08 19:45:10', 0, 86, '127.0.0.1'),
('', 138, '2023-01-08 19:45:27', 0, 87, '127.0.0.1'),
('', 138, '2023-01-08 19:45:31', 0, 88, '127.0.0.1'),
('', 138, '2023-01-08 19:45:45', 0, 89, '127.0.0.1'),
('fe0jhclc23e36gi9rtp98fr1ee', 138, '2023-01-08 19:57:05', 1, 90, '127.0.0.1');

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
(138, 'ddd', 'ddd@wp.pl', '$2y$10$b0zsbXkB6g6.7wd2VUYtfO9MhQz7H5GUaFHgvYr.CXmZAsjzAB/cO', 'xX0Q22SyRN');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT dla tabeli `password`
--
ALTER TABLE `password`
  MODIFY `id_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

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
