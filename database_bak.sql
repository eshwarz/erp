-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2012 at 02:49 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tamarind`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_list`
--

CREATE TABLE IF NOT EXISTS `auction_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) NOT NULL,
  `quality` int(11) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `cost` int(11) NOT NULL,
  `lot_number` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `auction_list`
--

INSERT INTO `auction_list` (`id`, `farmer_id`, `quality`, `buyer_id`, `cost`, `lot_number`, `date`) VALUES
(3, 2, 2, 5, 1512, 5, '2011-12-02'),
(4, 9, 1, 3, 9600, 3, '2011-12-09'),
(5, 1, 3, 11, 5455, 5, '2011-12-30'),
(6, 9, 2, 11, 6000, 3, '2012-01-06'),
(7, 18, 2, 3, 6545, 4, '2012-01-06'),
(8, 1, 1, 3, 9000, 5, '2012-01-06'),
(9, 1, 1, 10, 8000, 6, '2012-01-06'),
(10, 4, 1, 7, 12000, 6, '2012-01-06'),
(11, 7, 2, 5, 7000, 4, '2012-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE IF NOT EXISTS `buyers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `shop` varchar(300) NOT NULL,
  `street` varchar(300) NOT NULL,
  `town` varchar(300) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(300) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `tin` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `name`, `short_name`, `shop`, `street`, `town`, `phone`, `mobile`, `email`, `fax`, `tin`) VALUES
(3, 'Eshwar', 'ESH', 'Jayas Health Care', 'Kukatpally', 'Hyderabad', '12312312312', '9959076450', 'eshwarcc@gmail.com', '08497220564', '2A335S34M'),
(4, 'Vijay', 'VJ', 'Vijays shop', 'Vidya nagar', 'Hyderabad', '04023564854', '9596852564', 'vijay@gg.com', '5446464', '54s65d'),
(5, 'Karthik GV', 'GV', 'JBA', '', '', '', '', '', '', ''),
(6, 'Sandeep', 'SDP', 'Sandeep''s Shop', '', '', '', '9876543210', 'sda@sd.com', '', ''),
(7, 'Varma', 'VRM', '', '', '', '', '', '', '', ''),
(10, 'Chandra', 'CND', 'blah shop', '', '', '', '', '', '', ''),
(11, 'Chandra Sekhar', 'CND', 'blah shop', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_additions`
--

CREATE TABLE IF NOT EXISTS `buyer_additions` (
  `commission` varchar(10) NOT NULL COMMENT 'percentage',
  `loading` varchar(10) NOT NULL COMMENT 'per bag',
  `labour` varchar(10) NOT NULL COMMENT 'per bag',
  `gumastha` varchar(10) NOT NULL COMMENT 'percentage',
  `gumastha_new` varchar(10) NOT NULL,
  `bags` varchar(10) NOT NULL COMMENT 'per bag',
  `amc` varchar(10) NOT NULL COMMENT 'percentage',
  `rusum` varchar(10) NOT NULL COMMENT 'percentage'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyer_additions`
--

INSERT INTO `buyer_additions` (`commission`, `loading`, `labour`, `gumastha`, `gumastha_new`, `bags`, `amc`, `rusum`) VALUES
('1', '3', '2', '0.5', '0.5', '30', '1', '0.25');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `name` varchar(500) NOT NULL,
  `town` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`name`, `town`) VALUES
('JBA Traders', 'Kalyandurg');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE IF NOT EXISTS `farmers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `village_id` bigint(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `village_id`, `name`) VALUES
(1, 3, 'Harsha'),
(2, 1, 'Jabeer'),
(3, 1, 'jabeer.s'),
(4, 2, 'Srikanth'),
(6, 3, 'Vijay'),
(7, 5, 'Vinay'),
(8, 3, 'Sai'),
(9, 2, 'Avinash'),
(10, 4, 'Ravi'),
(11, 1, 'posa'),
(12, 3, 'shiva'),
(13, 12, 'shekshavali.p'),
(15, 10, 'Pavani'),
(16, 11, 'vannuruswamy'),
(17, 9, 'avinash p'),
(18, 8, 'padma'),
(19, 11, 'khr');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_accounts`
--

CREATE TABLE IF NOT EXISTS `farmer_accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) NOT NULL,
  `credit` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `farmer_accounts`
--

INSERT INTO `farmer_accounts` (`id`, `farmer_id`, `credit`) VALUES
(14, 11, 0),
(15, 18, -2671),
(16, 3, -4000);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_bills`
--

CREATE TABLE IF NOT EXISTS `farmer_bills` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `advance` int(11) NOT NULL,
  `freight` int(11) NOT NULL,
  `misc` int(11) NOT NULL,
  `payed_on` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `farmer_bills`
--

INSERT INTO `farmer_bills` (`id`, `farmer_id`, `date`, `advance`, `freight`, `misc`, `payed_on`, `time`) VALUES
(1, 11, '2011-12-09', 0, 60, 15, '0000-00-00', '2011-12-14 20:34:12'),
(2, 1, '2011-12-16', 0, 0, 0, '0000-00-00', '2011-12-18 08:32:34'),
(3, 1, '2011-12-09', 0, 0, 0, '0000-00-00', '2011-12-24 11:05:57'),
(4, 15, '2011-12-30', 0, 0, 0, '0000-00-00', '2012-01-05 05:36:11'),
(5, 18, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-06 08:03:03'),
(6, 9, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-08 12:32:28'),
(7, 11, '2012-01-07', 0, 0, 0, '0000-00-00', '2012-01-08 20:26:27'),
(8, 1, '2011-11-26', 0, 0, 0, '0000-00-00', '2012-01-11 05:38:46'),
(9, 3, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-11 08:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_credit_payments`
--

CREATE TABLE IF NOT EXISTS `farmer_credit_payments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) NOT NULL,
  `bill_id` bigint(20) NOT NULL,
  `credit` bigint(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `farmer_credit_payments`
--

INSERT INTO `farmer_credit_payments` (`id`, `farmer_id`, `bill_id`, `credit`, `date`) VALUES
(2, 18, 5, 2671, '2012-01-07'),
(4, 3, 9, 4000, '2012-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_deductions`
--

CREATE TABLE IF NOT EXISTS `farmer_deductions` (
  `cash` varchar(10) NOT NULL,
  `commission` varchar(10) NOT NULL,
  `amali` varchar(10) NOT NULL,
  `extra` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer_deductions`
--

INSERT INTO `farmer_deductions` (`cash`, `commission`, `amali`, `extra`) VALUES
('6.25', '2', '3', '');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_expenses`
--

CREATE TABLE IF NOT EXISTS `farmer_expenses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bill_id` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `money` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `farmer_expenses`
--

INSERT INTO `farmer_expenses` (`id`, `bill_id`, `description`, `money`) VALUES
(14, 1, 'sdfsf', 4500),
(15, 1, 'sdfdsf', 746),
(16, 5, 'karchu cash', 1000),
(17, 9, 'FREIGHT', 40),
(19, 8, 'freight', 40),
(20, 9, 'hand cash', 500);

-- --------------------------------------------------------

--
-- Table structure for table `lots`
--

CREATE TABLE IF NOT EXISTS `lots` (
  `lot_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lot_number` bigint(20) NOT NULL,
  `quality` int(11) NOT NULL,
  `farmer_id` bigint(20) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `cost` bigint(20) NOT NULL,
  `total_cost` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `pending` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`lot_id`, `lot_number`, `quality`, `farmer_id`, `buyer_id`, `cost`, `total_cost`, `date`, `pending`, `time`) VALUES
(26, 5, 1, 10, 3, 5678, 14365, '2011-11-25', 0, '2011-11-25 03:00:10'),
(27, 4, 2, 1, 3, 4565, 9221, '2011-11-26', 0, '2011-11-26 00:33:06'),
(28, 3, 2, 8, 6, 5, 8, '2011-11-25', 0, '2011-11-26 14:23:09'),
(29, 3, 2, 11, 3, 6500, 8710, '2011-12-09', 0, '2011-12-10 13:56:42'),
(30, 4, 1, 11, 3, 9800, 17738, '2011-12-09', 0, '2011-12-10 15:45:41'),
(31, 5, 3, 1, 3, 9500, 19475, '2011-12-09', 0, '2011-12-10 15:46:23'),
(32, 5, 1, 1, 11, 9600, 24288, '2011-12-16', 0, '2011-12-18 08:29:42'),
(33, 3, 2, 15, 3, 40000, 79200, '2011-12-30', 0, '2012-01-04 08:01:45'),
(35, 4, 1, 17, 5, 9800, 2352, '2011-12-30', 0, '2012-01-05 12:27:52'),
(36, 3, 1, 18, 5, 9000, 8370, '2012-01-06', 0, '2012-01-06 08:02:25'),
(37, 4, 3, 1, 3, 9800, 16856, '2012-01-06', 0, '2012-01-08 07:27:51'),
(38, 4, 2, 9, 6, 7600, 10108, '2012-01-06', 0, '2012-01-08 07:33:36'),
(41, 3, 1, 12, 6, 8500, 12665, '2012-01-06', 0, '2012-01-08 09:16:21'),
(44, 4, 1, 11, 3, 9850, 18321, '2012-01-07', 0, '2012-01-08 20:00:07'),
(45, 6, 1, 4, 7, 12000, 22200, '2012-01-06', 0, '2012-01-11 08:06:18'),
(46, 4, 2, 3, 3, 7000, 6440, '2012-01-06', 0, '2012-01-11 08:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE IF NOT EXISTS `quality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quality` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quality`
--

INSERT INTO `quality` (`id`, `quality`) VALUES
(1, 'K'),
(2, 'F'),
(3, 'C'),
(4, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE IF NOT EXISTS `villages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `village` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `village`) VALUES
(1, 'Kalyandurg'),
(2, 'Rayadurg'),
(3, 'Anantapur'),
(5, 'madras'),
(8, 'Bangalore'),
(9, 'dodagatta'),
(10, 'Pavani Cosmopolitan'),
(11, 'bandameedapalli'),
(12, 'chapari'),
(13, 'makodiki');

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE IF NOT EXISTS `weights` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lot_id` bigint(20) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=193 ;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`id`, `lot_id`, `weight`) VALUES
(89, 26, 52),
(90, 26, 52),
(91, 26, 43),
(92, 26, 83),
(93, 26, 23),
(94, 27, 83),
(95, 27, 23),
(96, 27, 43),
(97, 27, 53),
(98, 28, 50),
(99, 28, 54),
(100, 28, 56),
(101, 29, 48),
(102, 29, 63),
(103, 29, 23),
(104, 30, 48),
(105, 30, 43),
(106, 30, 52),
(107, 30, 38),
(108, 31, 23),
(109, 31, 52),
(110, 31, 54),
(111, 31, 33),
(112, 31, 43),
(113, 32, 48),
(114, 32, 23),
(115, 32, 80),
(116, 32, 50),
(117, 32, 52),
(118, 33, 46),
(119, 33, 52),
(120, 33, 100),
(124, 35, 30),
(125, 35, -2),
(126, 35, -2),
(127, 35, -2),
(128, 36, 30),
(129, 36, 31),
(130, 36, 32),
(131, 37, 48),
(132, 37, 38),
(133, 37, 58),
(134, 37, 28),
(139, 41, 48),
(140, 41, 58),
(141, 41, 43),
(165, 44, 48),
(166, 44, 44),
(167, 44, 46),
(168, 44, 48),
(175, 38, 40),
(176, 38, 32),
(177, 38, 30),
(178, 38, 31),
(179, 45, 30),
(180, 45, 29),
(181, 45, 31),
(182, 45, 30),
(183, 45, 32),
(184, 45, 33),
(189, 46, 30),
(190, 46, 19),
(191, 46, 21),
(192, 46, 22);

-- --------------------------------------------------------

--
-- Table structure for table `weight_deduction`
--

CREATE TABLE IF NOT EXISTS `weight_deduction` (
  `weight_deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weight_deduction`
--

INSERT INTO `weight_deduction` (`weight_deduction`) VALUES
(2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
