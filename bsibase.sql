-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Sty 2023, 21:46
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
  `lastBadLoginNum` datetime DEFAULT NULL,
  `pernamentLock` tinyint(4) DEFAULT NULL,
  `tempLock` int(11) DEFAULT NULL,
  `ipAddress` varchar(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `block_login`
--

INSERT INTO `block_login` (`id`, `badLoginNum`, `lastBadLoginNum`, `pernamentLock`, `tempLock`, `ipAddress`, `userId`) VALUES
(34, 0, '2023-01-11 21:44:30', NULL, NULL, '127.0.0.1', 156),
(35, 0, '2023-01-11 21:09:34', NULL, NULL, '127.0.0.1', 157);

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
('', 157, '2023-01-11 21:09:32', 0, 552, '127.0.0.1'),
('', 157, '2023-01-11 21:09:34', 0, 553, '127.0.0.1'),
('p0c6dabbcrjjtl6sg9kgsl7bao', 157, '2023-01-11 21:09:38', 1, 554, '127.0.0.1'),
('p0c6dabbcrjjtl6sg9kgsl7bao', 157, '2023-01-11 21:09:40', 1, 555, '127.0.0.1'),
('p0c6dabbcrjjtl6sg9kgsl7bao', 157, '2023-01-11 21:10:01', 1, 556, '127.0.0.1'),
('p0c6dabbcrjjtl6sg9kgsl7bao', 157, '2023-01-11 21:10:04', 1, 557, '127.0.0.1'),
('p0c6dabbcrjjtl6sg9kgsl7bao', 157, '2023-01-11 21:10:07', 1, 558, '127.0.0.1'),
('p0c6dabbcrjjtl6sg9kgsl7bao', 157, '2023-01-11 21:10:25', 1, 559, '127.0.0.1'),
('gfq22doiplr6qtc5tsj1phq25g', 157, '2023-01-11 21:10:54', 1, 560, '127.0.0.1'),
('m11fi1qvl9tfur127kbi794bh9', 157, '2023-01-11 21:11:06', 1, 561, '127.0.0.1'),
('q54uh4jm3b0bqfihd8gl6hubvj', 157, '2023-01-11 21:11:16', 1, 562, '127.0.0.1'),
('hakprdv1f5pd24jvm7bdkf1r14', 157, '2023-01-11 21:13:36', 1, 563, '127.0.0.1'),
('47hrit9tb7qjrks54ravimq6gk', 157, '2023-01-11 21:14:06', 1, 564, '127.0.0.1'),
('47hrit9tb7qjrks54ravimq6gk', 156, '2023-01-11 21:44:04', 1, 565, '127.0.0.1'),
('', 156, '2023-01-11 21:44:22', 0, 566, '127.0.0.1'),
('', 156, '2023-01-11 21:44:24', 0, 567, '127.0.0.1'),
('', 156, '2023-01-11 21:44:27', 0, 568, '127.0.0.1'),
('', 156, '2023-01-11 21:44:30', 0, 569, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:36', 1, 570, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:40', 1, 571, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:41', 1, 572, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:43', 1, 573, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:48', 1, 574, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:50', 1, 575, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:54', 1, 576, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:57', 1, 577, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 156, '2023-01-11 21:44:58', 1, 578, '127.0.0.1'),
('7binrfani7fca33c3a4mp8vr0c', 157, '2023-01-11 21:45:06', 1, 579, '127.0.0.1'),
('g9se6eehkcd2mlq9q4s3dlgl6t', 156, '2023-01-11 21:45:13', 1, 580, '127.0.0.1'),
('g9se6eehkcd2mlq9q4s3dlgl6t', 156, '2023-01-11 21:45:15', 1, 581, '127.0.0.1'),
('g9se6eehkcd2mlq9q4s3dlgl6t', 156, '2023-01-11 21:45:20', 1, 582, '127.0.0.1'),
('g9se6eehkcd2mlq9q4s3dlgl6t', 156, '2023-01-11 21:45:22', 1, 583, '127.0.0.1'),
('g9se6eehkcd2mlq9q4s3dlgl6t', 157, '2023-01-11 21:45:27', 1, 584, '127.0.0.1'),
('vfbchau18re8otmvobhh3n2u2q', 156, '2023-01-11 21:45:34', 1, 585, '127.0.0.1'),
('vfbchau18re8otmvobhh3n2u2q', 156, '2023-01-11 21:45:38', 1, 586, '127.0.0.1'),
('vfbchau18re8otmvobhh3n2u2q', 156, '2023-01-11 21:45:45', 1, 587, '127.0.0.1'),
('vfbchau18re8otmvobhh3n2u2q', 156, '2023-01-11 21:46:04', 1, 588, '127.0.0.1');

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
(88, 'ddd', '5AV86Gx9PY5r3Cjta1sSrQ==', 'sss', 'aaa', 156),
(89, 'yy', 'KEa0U2Q37sPPMhp17irWxA==', 'yy', 'yy', 157);

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
(156, 'ddd', 'sz@wp.pl', '$2y$10$IZl9HyyVYGxvp8JZN7F5cO9wTbQQmbjrmdW2jFbY4QGxd7cxO.qNa', '0CpeMHBJTg'),
(157, 'eee', 'ee@wp.pl', '$2y$10$UiWvYxQX.FLMr8n4YA3deussUUHH6Po6HreEwou8bwrmFlSuDF1jq', 'zA0WT3E7QG');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `block_login`
--
ALTER TABLE `block_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`userId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;

--
-- AUTO_INCREMENT dla tabeli `password`
--
ALTER TABLE `password`
  MODIFY `id_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `block_login`
--
ALTER TABLE `block_login`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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
