-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2017 at 08:30 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `state`, `name`) VALUES
(5, 1, 'Kategorija A'),
(6, 1, 'Kategorija B');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `is_sent` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_sent` datetime NOT NULL,
  `subscriber` int(11) NOT NULL,
  `newsletter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 1, '', '2017-01-01', 5, 'Newspeipis', ''),
(2, 1, 'Newspeipis', '2017-02-01', 5, 'Pavasaris arteja', 'blasf anf asfabshfbhasf bhasf \r\nsdfsdf\r\ndsfsd\r\nfsdfsdfsdfsdfsdf'),
(3, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(4, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(5, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(6, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(7, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(8, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(9, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf '),
(10, 1, '', '2017-01-01', 5, 'Newspeipis', 'blasf anf asfabshfbhasf bhasf ');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_category_xref`
--

CREATE TABLE `subscriber_category_xref` (
  `subscriber_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriber` (`subscriber`),
  ADD KEY `newsletter` (`newsletter`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber_category_xref`
--
ALTER TABLE `subscriber_category_xref`
  ADD PRIMARY KEY (`subscriber_id`,`category_id`),
  ADD KEY `subscriber_id` (`subscriber_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`subscriber`) REFERENCES `subscriber` (`id`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`newsletter`) REFERENCES `newsletter` (`id`);

--
-- Constraints for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Constraints for table `subscriber_category_xref`
--
ALTER TABLE `subscriber_category_xref`
  ADD CONSTRAINT `subscriber_category_xref_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `subscriber_category_xref_ibfk_2` FOREIGN KEY (`subscriber_id`) REFERENCES `subscriber` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
