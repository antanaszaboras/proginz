-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2017 at 07:08 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsletters`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `state`, `name`, `date`, `category`, `description`, `body`) VALUES
(1, 2, '', '2017-01-01', 5, 'Newspeipis', ''),
(2, 2, 'Newspeipis', '2017-02-01', 5, 'Pavasaris arteja', 'blasf anf asfabshfbhasf bhasf \r\nsdfsdf\r\ndsfsd\r\nfsdfsdfsdfsdfsdf'),
(3, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(4, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(5, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(6, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(7, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(8, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(9, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(10, 2, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(11, 3, 'asdasd', '2017-04-23', 6, 'aBBBBBBBBBBBB', 'f sasf asfsaf asf'),
(12, 3, 'B laias', '2017-04-23', 6, 'My desct', 'asas fsdf\r\nsdgf\r\nsdag\r\n\r\nsdg\r\n\r\nsadg'),
(13, 3, 'aasd', '2017-04-23', 6, 'sadas', '~!@#$%^&*()_"::\';'),
(14, 2, '', '2017-01-01', 6, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(15, 2, '', '2017-01-01', 6, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(16, 3, 'aasd', '2017-04-23', 6, 'sadas', 'VISKAS GERAI KAS ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
