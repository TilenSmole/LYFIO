-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 02:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `did` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'id od userjev',
  `DATUM` date NOT NULL,
  `NASLOVNIK` text NOT NULL,
  `VSOTA` int(11) NOT NULL,
  `OPOMBE` text NOT NULL,
  `odhoPrih` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`did`, `uid`, `DATUM`, `NASLOVNIK`, `VSOTA`, `OPOMBE`, `odhoPrih`) VALUES
(60, 13, '2023-06-02', 'SONČEK', -4000, 'dopust', 'minus'),
(61, 13, '2023-03-14', 'plača', 12555, 'placa', 'plus'),
(62, 13, '2023-05-12', 'placa', 1255, 'jej', 'plus'),
(63, 13, '2023-09-22', 'fri', -35, 'solnina', 'minus'),
(64, 28, '2023-04-24', 'plače', -50000, '', 'minus'),
(65, 28, '2023-05-12', 'drzava', 100000, '/', 'plus'),
(66, 28, '2023-04-26', 'hehe', -10000, 'no comment', 'minus'),
(112, 13, '2023-04-25', 'čaj s sosolci', 412, 'kaj', 'plus'),
(114, 30, '2023-05-15', 'ok', 241312412, '', 'plus');

-- --------------------------------------------------------

--
-- Table structure for table `old_data`
--

CREATE TABLE `old_data` (
  `odid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `text` text NOT NULL,
  `datum_spremembe` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `old_data`
--

INSERT INTO `old_data` (`odid`, `did`, `text`, `datum_spremembe`) VALUES
(54, 63, '2023-10-05  fri -35  solnina', '2023-05-24 12:21:35'),
(55, 62, '2023-05-12  placa 1255  /', '2023-05-24 12:21:57'),
(56, 61, '2023-03-14  placa 12555  placa', '2023-05-24 12:22:17'),
(57, 112, '2023-05-15  čaj s sosolci 412  kaj', '2023-05-24 12:42:18'),
(58, 65, '2023-05-12  drzava 100000  financiranje', '2023-05-24 12:56:35'),
(59, 64, '2023-04-24  place -50000  ', '2023-05-24 12:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` char(255) NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `birth_date`) VALUES
(13, 'tilen', '$2y$10$g6PIRhDpyX9FRjf5mqKReeEZwh7ZqV91aah8btWAPK/ZNKCCJz5O2', '2002-06-01'),
(16, 'tilen2', '$2y$10$7UoEHTr9OHm.oPGpL3FKX.qqwdvJiCHmw5/IA0r4pgo0tDQAgE9Fi', '2020-02-10'),
(28, 'fri', '$2y$10$TG5WaNJZeq.n09Uf0OQFw.2bl1SzeHlRdsEY51Fds4NAemLLJGece', '1222-12-12'),
(29, 'nekdo', '$2y$10$GZGf3vTtDBzdO7g5.3S0Dus/hg2FRezjG3LrBSYCYxsYU1DdEiWGC', '2020-10-10'),
(30, 'lmao', '$2y$10$rk0J9uckgpabw8H8p5HoYeqRMX3m1Ht7Fi706.7WuGquhFS19xQmK', '0002-12-12'),
(31, 'uporabnik', '$2y$10$NywGAGznqqBPCLfp1olcxOaAHWimPrPDbDT0v8Nwe5VnkOosAAcoS', '2000-10-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`did`),
  ADD UNIQUE KEY `OPOMBE` (`did`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `old_data`
--
ALTER TABLE `old_data`
  ADD PRIMARY KEY (`odid`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `old_data`
--
ALTER TABLE `old_data`
  MODIFY `odid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `old_data`
--
ALTER TABLE `old_data`
  ADD CONSTRAINT `old_data_ibfk_1` FOREIGN KEY (`did`) REFERENCES `data` (`did`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
