-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2017 at 08:30 PM
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
(5, 1, 'Kategorija Asdasdasd'),
(6, 1, 'Kategorija Bfffffffffff'),
(7, 1, 'Kategorija C'),
(8, 1, 'PROJEKTAS');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `is_sent` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `subscriber` int(11) NOT NULL,
  `newsletter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `is_sent`, `date_added`, `date_sent`, `subscriber`, `newsletter`) VALUES
(1, 1, '2017-04-16 00:00:00', '2017-04-18 00:00:00', 1, 5),
(2, 1, '2017-04-13 00:00:00', '2017-04-26 00:00:00', 2, 6),
(3, 1, '2017-04-16 00:00:00', '2017-04-18 00:00:00', 3, 5),
(4, 1, '2017-04-13 00:00:00', '2017-04-26 00:00:00', 2, 9),
(5, 1, '2017-04-23 00:00:00', '2017-04-23 19:04:53', 1, 14),
(6, 1, '2017-04-23 00:00:00', '2017-04-23 19:04:53', 1, 14),
(7, 0, '2017-04-23 00:00:00', NULL, 1, 1),
(8, 1, '2017-04-23 00:00:00', '2017-04-23 19:04:53', 1, 14),
(9, 0, '2017-04-23 00:00:00', '2017-04-23 21:14:28', 1, 1),
(10, 0, '2017-04-23 00:00:00', '2017-04-23 21:14:42', 1, 1),
(11, 0, '2017-04-23 00:00:00', '2017-04-23 21:15:19', 1, 1),
(12, 0, '2017-04-23 00:00:00', NULL, 1, 10),
(13, 0, '2017-04-23 18:20:39', NULL, 1, 10),
(14, 0, '2017-04-23 18:22:44', NULL, 1, 10),
(15, 0, '2017-04-23 18:23:00', NULL, 1, 12),
(16, 0, '2017-04-23 18:23:04', NULL, 1, 12),
(17, 1, '2017-04-23 18:54:47', '2017-04-23 18:57:54', 1, 15),
(18, 1, '2017-04-23 18:56:00', '2017-04-23 19:01:35', 1, 15),
(19, 1, '2017-04-23 18:56:12', '2017-04-23 19:01:35', 1, 15),
(20, 1, '2017-04-23 18:57:12', '2017-04-23 19:01:35', 1, 15),
(21, 1, '2017-04-23 18:57:22', '2017-04-23 19:01:35', 1, 15),
(22, 1, '2017-04-23 18:57:30', '2017-04-23 19:01:35', 1, 15),
(23, 1, '2017-04-23 18:57:54', '2017-04-23 19:01:35', 1, 15),
(24, 1, '2017-04-23 19:01:35', '2017-04-23 19:01:35', 1, 15),
(25, 1, '2017-04-23 19:04:22', '2017-04-23 19:04:22', 1, 15),
(26, 1, '2017-04-23 19:04:32', '2017-04-23 19:04:32', 1, 15),
(27, 1, '2017-04-23 19:04:35', '2017-04-23 19:04:35', 1, 15),
(28, 1, '2017-04-23 19:04:36', '2017-04-23 19:04:36', 1, 15),
(29, 1, '2017-04-23 19:04:53', '2017-04-23 19:04:53', 1, 14),
(30, 1, '2017-04-23 19:04:55', '2017-04-23 19:04:55', 1, 14),
(31, 1, '2017-04-23 19:05:02', '2017-04-23 19:05:02', 1, 2),
(32, 1, '2017-04-23 19:05:04', '2017-04-23 19:05:04', 1, 2),
(33, 1, '2017-05-10 16:54:57', '2017-05-10 16:54:58', 1, 17),
(34, 1, '2017-05-10 16:54:57', '2017-05-10 16:54:59', 5, 17),
(35, 1, '2017-05-10 17:01:16', '2017-05-10 17:01:16', 1, 17),
(36, 1, '2017-05-10 17:01:16', '2017-05-10 17:01:16', 5, 17),
(37, 1, '2017-05-10 17:02:05', '2017-05-10 17:11:41', 1, 17),
(38, 1, '2017-05-10 17:02:05', '2017-05-10 17:11:41', 5, 17),
(39, 1, '2017-05-10 17:02:48', '2017-05-10 17:11:41', 1, 17),
(40, 1, '2017-05-10 17:02:48', '2017-05-10 17:11:41', 5, 17),
(41, 1, '2017-05-10 17:02:53', '2017-05-10 17:11:41', 1, 17),
(42, 1, '2017-05-10 17:02:53', '2017-05-10 17:11:41', 5, 17),
(43, 1, '2017-05-10 17:05:01', '2017-05-10 17:11:41', 1, 17),
(44, 1, '2017-05-10 17:05:01', '2017-05-10 17:11:41', 5, 17),
(45, 1, '2017-05-10 17:07:20', '2017-05-10 17:11:41', 1, 17),
(46, 1, '2017-05-10 17:07:20', '2017-05-10 17:11:41', 5, 17),
(47, 1, '2017-05-10 17:08:47', '2017-05-10 17:11:41', 1, 17),
(48, 1, '2017-05-10 17:08:47', '2017-05-10 17:11:41', 5, 17),
(49, 1, '2017-05-10 17:11:41', '2017-05-10 17:11:41', 1, 17),
(50, 1, '2017-05-10 17:11:41', '2017-05-10 17:11:41', 5, 17),
(51, 1, '2017-05-10 17:11:44', '2017-05-10 17:11:44', 1, 17),
(52, 1, '2017-05-10 17:11:44', '2017-05-10 17:11:44', 5, 17),
(53, 1, '2017-05-10 19:57:33', '2017-05-10 20:00:30', 1, 17),
(54, 1, '2017-05-10 19:57:33', '2017-05-10 20:00:30', 5, 17),
(55, 1, '2017-05-10 19:58:02', '2017-05-10 20:00:30', 1, 17),
(56, 1, '2017-05-10 19:58:02', '2017-05-10 20:00:30', 5, 17),
(57, 1, '2017-05-10 20:00:30', '2017-05-10 20:00:30', 1, 17),
(58, 1, '2017-05-10 20:00:30', '2017-05-10 20:00:30', 5, 17),
(59, 1, '2017-05-10 20:00:33', '2017-05-10 20:00:33', 1, 17),
(60, 1, '2017-05-10 20:00:33', '2017-05-10 20:00:33', 5, 17),
(61, 1, '2017-05-10 20:18:45', '2017-05-10 20:22:36', 1, 17),
(62, 1, '2017-05-10 20:18:45', '2017-05-10 20:22:37', 5, 17),
(63, 1, '2017-05-10 20:19:29', '2017-05-10 20:22:39', 1, 17),
(64, 1, '2017-05-10 20:19:29', '2017-05-10 20:22:40', 5, 17),
(65, 0, '2017-05-10 20:19:35', NULL, 1, 18),
(66, 0, '2017-05-10 20:19:35', NULL, 5, 18),
(67, 1, '2017-05-10 20:20:25', '2017-05-10 20:22:42', 1, 17),
(68, 1, '2017-05-10 20:20:25', '2017-05-10 20:22:43', 5, 17),
(69, 1, '2017-05-10 20:20:28', '2017-05-10 20:22:45', 1, 17),
(70, 1, '2017-05-10 20:20:28', '2017-05-10 20:22:47', 5, 17),
(71, 1, '2017-05-10 20:20:57', '2017-05-10 20:22:48', 1, 17),
(72, 1, '2017-05-10 20:20:57', '2017-05-10 20:22:50', 5, 17),
(73, 1, '2017-05-10 20:21:43', '2017-05-10 20:22:51', 1, 17),
(74, 1, '2017-05-10 20:21:43', '2017-05-10 20:22:53', 5, 17),
(75, 1, '2017-05-10 20:22:33', '2017-05-10 20:22:55', 1, 17),
(76, 1, '2017-05-10 20:22:33', '2017-05-10 20:22:56', 5, 17),
(77, 1, '2017-05-10 20:25:48', '2017-05-10 20:25:50', 6, 19),
(78, 1, '2017-05-10 20:28:20', '2017-05-10 20:28:21', 6, 19),
(79, 1, '2017-05-10 20:28:56', '2017-05-10 20:28:58', 6, 19),
(80, 1, '2017-05-10 20:29:49', '2017-05-10 20:29:50', 6, 19);

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
(16, 3, 'aasd', '2017-04-23', 6, 'sadas', 'VISKAS GERAI KAS '),
(17, 2, '1asasdasd', '2017-05-08', 6, 'Pirmas', 'Pirmas'),
(18, 3, 'xusfsafan', '2017-05-08', 5, 'aaa', 'bbb'),
(19, 2, 'dvi savaitÄ—s', '2017-05-10', 8, 'Liko 2 savaitÄ—s iki projekto pabaigos', 'Liko dvi savaitÄ—s iki projekto pabaigos. Padaryti testus, dokumentacijÄ…, dizainÄ…, klaidÅ³ tvarkymÄ…. ');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `state`, `email`) VALUES
(1, 1, 'aA@aa'),
(2, 1, 'aA@aas'),
(3, 1, 'aA@aa'),
(4, 1, 'aA@aaa'),
(5, 1, 'antzab@ktu.edu'),
(6, 1, 'antanas.zaboras@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_category_xref`
--

CREATE TABLE `subscriber_category_xref` (
  `subscriber_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriber_category_xref`
--

INSERT INTO `subscriber_category_xref` (`subscriber_id`, `category_id`) VALUES
(1, 5),
(1, 6),
(5, 5),
(5, 6),
(6, 8);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
