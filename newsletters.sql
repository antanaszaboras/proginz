-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 10:30 AM
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
-- Table structure for table `confirmation_link`
--

CREATE TABLE `confirmation_link` (
  `id` int(11) NOT NULL,
  `is_used` int(11) NOT NULL,
  `secret` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_sent` datetime NOT NULL,
  `date_used` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `confirmation_link`
--

INSERT INTO `confirmation_link` (`id`, `is_used`, `secret`, `email`, `date_sent`, `date_used`) VALUES
(1, 0, 'cq376X5FEW', 'antzab@ktu.edu', '2017-05-18 18:13:46', NULL),
(2, 0, 'RxxZBiwxov', 'antanas.zaboras@gmail.com', '2017-05-18 18:18:21', NULL),
(3, 0, 'sQTke4EmOD', 'antanas.zaboras@gmail.com', '2017-05-18 18:22:19', NULL),
(4, 0, 'x6FDJpLGZB', 'antanas.zaboras@gmail.com', '2017-05-18 18:24:42', NULL),
(5, 1, 'bTNgy5DW0q', 'antanas.zaboras@gmail.com', '2017-05-18 19:11:20', '2017-05-18 20:24:30'),
(6, 0, 's3NW6hytJq', 'antanas.zaboras@gmail.com', '2017-05-18 20:26:40', NULL),
(7, 0, 'FLucrXLiBn', 'antanas.zaboras@gmail.com', '2017-05-18 20:26:42', NULL),
(8, 1, 'QKFbUvNqe0', 'antanas.zaboras@gmail.com', '2017-05-19 17:47:48', '2017-05-19 17:48:28'),
(9, 1, 'JtvIZhr0Gq', 'antanas.zaboras@gmail.com', '2017-05-19 18:48:48', '2017-05-19 18:54:18'),
(10, 0, 'Rymtz26Uax', 'antanas.zaboras@gmail.com', '2017-05-19 22:56:58', NULL),
(11, 1, 'Nbj7d7boEx', 'antanas.zaboras@gmail.com', '2017-05-19 23:02:26', '2017-05-19 23:03:22'),
(12, 1, 'gtxjz20aEp', 'antanas.zaboras@gmail.com', '2017-05-19 23:03:55', '2017-05-19 23:11:41'),
(13, 0, 'XcUvc80vVu', 'asd@as', '2017-05-19 23:23:27', NULL),
(14, 1, 'LdFmvGhKzQ', 'antanas.zaboras@gmail.com', '2017-05-19 23:24:07', '2017-05-19 23:24:20'),
(15, 1, 'VkUjvkcKqz', 'antanas.zaboras@gmail.com', '2017-05-19 23:25:55', '2017-05-19 23:26:13'),
(16, 0, 'hi2ijDoWG4', 'antanas.zaboras@gmail.com', '2017-05-20 10:21:06', NULL),
(17, 1, 'x0pbc3tbxw', 'antanas.zaboras@gmail.com', '2017-05-20 10:21:08', '2017-05-20 10:21:51'),
(18, 1, '2j6VLeg3qX', 'antanas.zaboras@gmail.com', '2017-05-20 10:22:03', '2017-05-20 10:40:59'),
(19, 1, 'CKCzJsZLz8', 'antanas.zaboras@gmail.com', '2017-05-20 10:50:15', '2017-05-20 10:55:03'),
(20, 0, 'HfIS7kgGQq', 'antanas.zaboras@gmail.com', '2017-05-20 10:55:12', NULL),
(21, 1, 'LIpNuSh6Wb', 'antanas.zaboras@gmail.com', '2017-05-20 11:40:50', '2017-05-20 11:47:21'),
(22, 0, 'cCQhJ3iBn3', 'antanas.zaboras@gmail.com', '2017-05-20 11:50:29', NULL),
(23, 1, 'uKB4N2QMGG', 'antanas.zaboras@gmail.com', '2017-05-20 11:50:55', '2017-05-20 11:51:19'),
(24, 1, 'tFM0K9lfSW', 'antanas.zaboras@gmail.com', '2017-05-20 11:52:03', '2017-05-20 11:52:19'),
(25, 0, '75lNr9f6gl', 'antanas.zaboras@gmail.com', '2017-05-20 11:52:29', NULL),
(26, 1, '7IazEdDEYO', 'antanas.zaboras@gmail.com', '2017-05-20 12:25:29', '2017-05-20 12:25:46'),
(27, 0, 'CESFTtbQtq', 'antanas.zaboras@gmail.com', '2017-05-20 12:25:31', NULL),
(28, 1, 'hwLcy7R1BX', 'antanas.zaboras@gmail.com', '2017-05-20 12:25:57', '2017-05-20 12:26:13');

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
(80, 1, '2017-05-10 20:29:49', '2017-05-10 20:29:50', 6, 19),
(81, 1, '2017-05-20 12:10:45', '2017-05-20 12:10:47', 6, 20);

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
(19, 2, 'dvi savaitÄ—s', '2017-05-10', 8, 'Liko 2 savaitÄ—s iki projekto pabaigos', 'Liko dvi savaitÄ—s iki projekto pabaigos. Padaryti testus, dokumentacijÄ…, dizainÄ…, klaidÅ³ tvarkymÄ…. '),
(20, 2, 'Lipsum 1', '2017-05-20', 8, 'Your Lipsum is ready', 'Parturient donec per torquent egestas a tellus viverra vel a pulvinar praesent interdum class id arcu. Condimentum ultricies mi in et in congue donec suscipit in sagittis pulvinar etiam pretium integer erat condimentum morbi vel aenean nam parturient eget posuere mi adipiscing ridiculus cum. Suspendisse aenean lacus ullamcorper ut id quisque lobortis ante conubia viverra tempor vulputate dolor in habitant a integer placerat himenaeos elementum massa lacus leo vitae nulla. Ut porttitor platea ut arcu orci amet ad ullamcorper pharetra ornare nisl scelerisque luctus proin rutrum integer et parturient suspendisse tellus mollis nisl a orci a tincidunt dictumst. Eros hendrerit vestibulum proin duis hac facilisis vivamus interdum vestibulum nascetur sit scelerisque a adipiscing. \r\n'),
(21, 3, 'Vestibulum', '2017-05-20', 5, 'Vestibulum nam a morbi iaculis', 'Parturient donec per torquent egestas a tellus viverra vel a pulvinar praesent interdum class id arcu. Condimentum ultricies mi in et in congue donec suscipit in sagittis pulvinar etiam pretium integer erat condimentum morbi vel aenean nam parturient eget posuere mi adipiscing ridiculus cum. Suspendisse aenean lacus ullamcorper ut id quisque lobortis ante conubia viverra tempor vulputate dolor in habitant a integer placerat himenaeos elementum massa lacus leo vitae nulla. Ut porttitor platea ut arcu orci amet ad ullamcorper pharetra ornare nisl scelerisque luctus proin rutrum integer et parturient suspendisse tellus mollis nisl a orci a tincidunt dictumst. Eros hendrerit vestibulum proin duis hac facilisis vivamus interdum vestibulum nascetur sit scelerisque a adipiscing. \r\n\r\nVenenatis eu orci vulputate ullamcorper est augue imperdiet consectetur hendrerit varius tellus urna ut dolor venenatis et. Netus non ac nunc rutrum fermentum et suspendisse tellus adipiscing sodales bibendum montes urna non consectetur ultricies lacinia. Morbi ut semper condimentum id a primis ut condimentum urna eu tellus a vestibulum senectus et a eros a blandit condimentum at commodo cubilia nam. Adipiscing posuere a in a euismod augue vestibulum nulla a non at condimentum magna posuere a nisl condimentum sem scelerisque erat orci parturient mi. Ullamcorper ut vestibulum aliquam vivamus dis a a imperdiet ut mi eu vitae scelerisque per montes cras donec fusce. Hendrerit dictumst arcu a aliquet eu elementum parturient hendrerit ante eu convallis id condimentum placerat potenti lacus nisi litora imperdiet parturient adipiscing lacus quisque curabitur vulputate dis venenatis. \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_subscribed` datetime DEFAULT NULL,
  `date_suspended` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `state`, `email`, `date_subscribed`, `date_suspended`) VALUES
(5, 1, 'antzab@ktu.edu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 0, 'antanas.zaboras@gmail.com', '2017-05-20 10:21:51', '2017-05-20 12:26:13');

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
(5, 5),
(5, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirmation_link`
--
ALTER TABLE `confirmation_link`
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
-- AUTO_INCREMENT for table `confirmation_link`
--
ALTER TABLE `confirmation_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
