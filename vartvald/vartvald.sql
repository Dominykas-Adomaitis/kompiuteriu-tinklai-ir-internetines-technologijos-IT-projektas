-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 01:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vartvald`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `FilmID` int(11) NOT NULL,
  `FilmName` varchar(255) NOT NULL,
  `FilmTime` varchar(255) NOT NULL,
  `FilmPrice` decimal(8,2) NOT NULL,
  `FilmDate` datetime NOT NULL,
  `FilmFoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`FilmID`, `FilmName`, `FilmTime`, `FilmPrice`, `FilmDate`, `FilmFoto`) VALUES
(1, 'AVATAR', '150', '7.00', '2020-11-20 17:03:40', 'avatar.jpg'),
(2, 'THE GODFATHER', '180', '8.00', '2020-11-20 17:03:40', 'The Godfather.jpg'),
(3, 'THE MATRIX', '115', '8.00', '2020-11-21 21:30:00', 'matrix.jpg'),
(4, 'RAMBO', '91', '6.00', '2020-11-29 23:00:00', 'rembo.jpg'),
(8, 'Pabėgimas iš Šoušenko', '144', '9.00', '2020-11-26 17:00:00', 'The Shawshank Redemption.jpg'),
(11, 'TENET', '150', '10.00', '2020-12-18 18:00:00', 'tenet.jpg'),
(17, 'Tarp žvaigždžių', '169', '8.00', '0000-00-00 00:00:00', 'Interstellar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `filmorder`
--

CREATE TABLE `filmorder` (
  `orderID` int(11) NOT NULL,
  `orderTotal` decimal(8,2) NOT NULL,
  `orderFilmName` varchar(255) NOT NULL,
  `ticketCount` int(11) NOT NULL,
  `ticketPrice` decimal(8,2) NOT NULL,
  `orderEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filmorder`
--

INSERT INTO `filmorder` (`orderID`, `orderTotal`, `orderFilmName`, `ticketCount`, `ticketPrice`, `orderEmail`) VALUES
(58, '72.00', 'RAMBO', 12, '6.00', 'd.adomaitis@ktu.edu'),
(59, '9.00', 'Pabėgimas iš Šoušenko', 1, '9.00', 'd.adomaitis@ktu.edu'),
(60, '60.00', 'RAMBO', 10, '6.00', 'd.adomaitis@ktu.edu'),
(61, '6.00', 'RAMBO', 1, '6.00', 'd.adomaitis@ktu.edu'),
(63, '80.00', 'THE MATRIX', 10, '8.00', 'd.adomaitis@ktu.edu'),
(64, '84.00', 'AVATAR', 12, '7.00', 'd.adomaitis@ktu.edu'),
(65, '32.00', 'THE MATRIX', 4, '8.00', 'd.adomaitis@ktu.edu'),
(66, '45.00', 'Pabėgimas iš Šoušenko', 5, '9.00', 'd.adomaitis@ktu.edu'),
(67, '48.00', 'THE MATRIX', 6, '8.00', 'd.adomaitis@ktu.edu'),
(68, '36.00', 'Pabėgimas iš Šoušenko', 4, '9.00', 'd.adomaitis@ktu.edu'),
(69, '160.00', 'THE GODFATHER', 20, '8.00', 'vartotojas1@gmail.com'),
(71, '9.00', 'Pabėgimas iš Šoušenko', 1, '9.00', 'vartotojas1@gmail.com'),
(72, '60.00', 'RAMBO', 10, '6.00', 'vartotojas1@gmail.com'),
(73, '72.00', 'Pabėgimas iš Šoušenko', 8, '9.00', 'vartotojas1@gmail.com'),
(74, '90.00', 'Pabėgimas iš Šoušenko', 10, '9.00', 'vartotojas1@gmail.com'),
(75, '9.00', 'Pabėgimas iš Šoušenko', 1, '9.00', 'vartotojas1@gmail.com'),
(76, '6.00', 'RAMBO', 1, '6.00', 'vartotojas1@gmail.com'),
(77, '9.00', 'Pabėgimas iš Šoušenko', 1, '9.00', 'vartotojas1@gmail.com'),
(78, '8.00', 'THE MATRIX', 1, '8.00', 'vartotojas1@gmail.com'),
(79, '6.00', 'RAMBO', 1, '6.00', 'vartotojas1@gmail.com'),
(80, '56.00', 'THE GODFATHER', 7, '8.00', 'vartotojas1@gmail.com'),
(81, '90.00', 'RAMBO', 15, '6.00', 'vartotojas1@gmail.com'),
(82, '42.00', 'AVATAR', 6, '7.00', 'd.adomaitis@ktu.edu'),
(83, '70.00', 'AVATAR', 10, '7.00', 'direktorius@gmail.com'),
(84, '60.00', 'RAMBO', 10, '6.00', 'vartotojas1@gmail.com'),
(85, '32.00', 'THE MATRIX', 4, '8.00', 'd.adomaitis@ktu.edu');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `filmoID` int(11) NOT NULL,
  `filmoPavadinimas` varchar(255) NOT NULL,
  `filmoValanda` time NOT NULL,
  `filmoDiena` date NOT NULL,
  `filmoLaikas` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`filmoID`, `filmoPavadinimas`, `filmoValanda`, `filmoDiena`, `filmoLaikas`) VALUES
(42, 'Tarp žvaigždžių', '10:00:00', '2020-12-10', '2020-12-10 10:00:00'),
(43, 'Tarp žvaigždžių', '19:00:00', '2020-12-10', '2020-12-10 19:00:00'),
(44, 'TENET', '13:00:00', '2020-12-11', '2020-12-11 13:00:00'),
(45, 'TENET', '19:00:00', '2020-12-11', '2020-12-11 19:00:00'),
(46, 'RAMBO', '13:00:00', '2020-12-12', '2020-12-12 13:00:00'),
(47, 'THE MATRIX', '16:00:00', '2020-12-10', '2020-12-10 16:00:00'),
(48, 'Tarp žvaigždžių', '13:00:00', '2020-12-10', '2020-12-10 13:00:00'),
(49, 'Tarp žvaigždžių', '16:00:00', '2020-12-11', '2020-12-11 16:00:00'),
(51, 'THE GODFATHER', '13:00:00', '2020-12-13', '2020-12-13 13:00:00'),
(52, 'THE GODFATHER', '13:00:00', '2020-12-14', '2020-12-14 13:00:00'),
(53, 'AVATAR', '10:00:00', '2020-12-12', '2020-12-12 10:00:00'),
(55, 'Pabėgimas iš Šoušenko', '10:00:00', '2020-12-11', '2020-12-11 10:00:00'),
(56, 'Pabėgimas iš Šoušenko', '19:00:00', '2020-12-12', '2020-12-12 19:00:00'),
(57, 'THE MATRIX', '16:00:00', '2020-12-12', '2020-12-12 16:00:00'),
(58, 'Tarp žvaigždžių', '19:00:00', '2020-12-13', '2020-12-13 19:00:00'),
(59, 'THE GODFATHER', '16:00:00', '2020-12-14', '2020-12-14 16:00:00'),
(60, 'AVATAR', '10:00:00', '2020-12-13', '2020-12-13 10:00:00'),
(61, 'Tarp žvaigždžių', '10:00:00', '2020-12-27', '2020-12-27 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) NOT NULL,
  `userlevel` tinyint(1) UNSIGNED DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('direktorius', '156d18b39900e310f75586981c8a2545', 'bb887d043bc86d2d939cf13fda8297c8', 7, 'direktorius@gmail.com', '2020-11-19 14:08:24'),
('admin', '777a8b217fc167238572bb08585881e6', '8935a9266d04b58e15970201940aa1d1', 9, 'vartotojas1@gmail.com', '2020-12-10 11:28:53'),
('dominykas', '74216f3e15c761ee1a5e255f06795362', 'b9c928f4570242f62062dd5ea178a2bb', 5, 'd.adomaitis@ktu.edu', '2020-12-09 15:48:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`FilmID`);

--
-- Indexes for table `filmorder`
--
ALTER TABLE `filmorder`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`filmoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `FilmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `filmorder`
--
ALTER TABLE `filmorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `filmoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
