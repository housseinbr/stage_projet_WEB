-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 10:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `c_user`
--

CREATE TABLE `c_user` (
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `tel` int(8) NOT NULL,
  `disc` varchar(500) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `tel` varchar(8) NOT NULL,
  `disc` varchar(1000) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `photo` varchar(1000) NOT NULL,
  `pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`nom`, `email`, `cin`, `tel`, `disc`, `user_type`, `photo`, `pwd`) VALUES
('Houssein Barbirou', 'hbarbirou0@gmail.com', '11111111', '', '', '', '', '$2y$10$4AVHNmPnsGc.WZ3/Isx8LOWvWFYNiUFO0NOim/kULxq'),
('Housse', 'houssein.barbirou@gmail.com', '2004', '', '', '', '', '$2y$10$5Z5Ll5Upa8fXH395kwn/CeQDfHkHbfJJ6hE23w723km'),
('1', 'hbarbirou0@gmail.comF', '1', '', '', '', '', '$2y$10$as9qAdg45cxSyN100nhhA.uW5WtLfkYp5590SbGoTrh'),
('zfezf', 'barbirou@gmail.com', 'ezfzef', '', '', 'job_seeker', '', '$2y$10$IiZBZFYuFP7tRQVJMc3N6OV4e0TweORoKyQLEPu0ccj'),
('CSDCSDC', 'hbarbirou0@gmail.comm', 'A', '', '', 'employer', '', '$2y$10$9JyJcejA6MCHp0InZfc8ZuAxkIvaiR2nBQuy4cJ3hHV'),
('zefzfezf', 'houssein@gmail.com', 'b', '', '', 'admin', '', '$2y$10$ThKsGnR6GF0fz6ba3WqJcus98QjdfI35wdvwPfUWgHC'),
('fff', 'fkjnzkefnz@esprit.tn', 'f', '', '', 'employer', '', '$2y$10$kn3K/I4kdpyb/qFm5vzyHeKfG2wHiKOtQpnE398fVa1'),
('housseinbarbirou', 'hbarbiroufezf@zfkzbf.com', 'zefzef', '', '', 'admin', '', '$2y$10$xc/E4qPcHSb5fyQO.rdPp.ARPmPar419122BjPfDdYK'),
('housseinbarbirourgeg', 'hbarbiroufezf@zfkzbf.comggr', 'zefzefhrth', '', '', 'admin', '', '$2y$10$o/nF5iubImtqTBMx0t8Ue.aNzKo0nSuSQxd7aQr8nRT'),
('rbgnfngdn', 'barbirou.houssein@gmail.com', 'fgngfdnn', '', '', 'admin', '', '$2y$10$kW5htb5DeQymuXg/IzIjmO/siGZYg5ud/bF46XsfiTH');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
