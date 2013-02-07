-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2012 at 03:45 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
-- Table structure for table `buyer_accounts`
--

CREATE TABLE IF NOT EXISTS `buyer_accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint(20) NOT NULL,
  `credit` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `buyer_accounts`
--


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
-- Table structure for table `buyer_bills`
--

CREATE TABLE IF NOT EXISTS `buyer_bills` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `payed_on` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `buyer_bills`
--

INSERT INTO `buyer_bills` (`id`, `buyer_id`, `date`, `payed_on`, `time`) VALUES
(1, 3, '2012-01-07', '0000-00-00', '2012-01-13 01:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_credit_usage`
--

CREATE TABLE IF NOT EXISTS `buyer_credit_usage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint(20) NOT NULL,
  `bill_id` bigint(20) NOT NULL,
  `money` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `buyer_credit_usage`
--

INSERT INTO `buyer_credit_usage` (`id`, `buyer_id`, `bill_id`, `money`, `date`) VALUES
(1, 3, 1, 5000, '0000-00-00'),
(2, 3, 1, 1000, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_expenses`
--

CREATE TABLE IF NOT EXISTS `buyer_expenses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bill_id` bigint(20) NOT NULL,
  `description` varchar(225) NOT NULL,
  `money` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `buyer_expenses`
--

INSERT INTO `buyer_expenses` (`id`, `bill_id`, `description`, `money`) VALUES
(1, 1, 'Balance', 2000),
(2, 1, 'Another add', 3000),
(3, 1, 'Blah blah', 1000),
(4, 1, 'he he he', 500),
(5, 1, 'sd dsf df', 642),
(6, 1, 'asdf', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `name` varchar(500) NOT NULL,
  `town` varchar(200) NOT NULL,
  `favicon` text NOT NULL,
  `bill_bg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`name`, `town`, `favicon`, `bill_bg`) VALUES
('JBA Adeppagari Balaji Traders', 'Kalyandurg', '', '');

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
(14, 11, -500),
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
(1, 11, '2011-12-09', 0, 60, 15, '0000-00-00', '2011-12-15 02:04:12'),
(2, 1, '2011-12-16', 0, 0, 0, '0000-00-00', '2011-12-18 14:02:34'),
(3, 1, '2011-12-09', 0, 0, 0, '0000-00-00', '2011-12-24 16:35:57'),
(4, 15, '2011-12-30', 0, 0, 0, '0000-00-00', '2012-01-05 11:06:11'),
(5, 18, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-06 13:33:03'),
(6, 9, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-08 18:02:28'),
(7, 11, '2012-01-07', 0, 0, 0, '0000-00-00', '2012-01-09 01:56:27'),
(8, 1, '2011-11-26', 0, 0, 0, '0000-00-00', '2012-01-11 11:08:46'),
(9, 3, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-11 13:42:56');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `farmer_credit_payments`
--

INSERT INTO `farmer_credit_payments` (`id`, `farmer_id`, `bill_id`, `credit`, `date`) VALUES
(2, 18, 5, 2671, '2012-01-07'),
(4, 3, 9, 4000, '2012-01-11'),
(5, 11, 7, 500, '2012-01-12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `farmer_expenses`
--

INSERT INTO `farmer_expenses` (`id`, `bill_id`, `description`, `money`) VALUES
(14, 1, 'sdfsf', 4500),
(15, 1, 'sdfdsf', 746),
(16, 5, 'karchu cash', 1000),
(17, 9, 'FREIGHT', 40),
(19, 8, 'freight', 40),
(20, 9, 'hand cash', 500),
(21, 7, 'Cash', 1000),
(22, 7, 'blah blah', 8652);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`lot_id`, `lot_number`, `quality`, `farmer_id`, `buyer_id`, `cost`, `total_cost`, `date`, `pending`, `time`) VALUES
(26, 5, 1, 10, 3, 5678, 14365, '2011-11-25', 0, '2011-11-25 08:30:10'),
(27, 4, 2, 1, 3, 4565, 9221, '2011-11-26', 0, '2011-11-26 06:03:06'),
(28, 3, 2, 8, 6, 5, 8, '2011-11-25', 0, '2011-11-26 19:53:09'),
(29, 3, 2, 11, 3, 6500, 8710, '2011-12-09', 0, '2011-12-10 19:26:42'),
(30, 4, 1, 11, 3, 9800, 17738, '2011-12-09', 0, '2011-12-10 21:15:41'),
(31, 5, 3, 1, 3, 9500, 19475, '2011-12-09', 0, '2011-12-10 21:16:23'),
(32, 5, 1, 1, 11, 9600, 24288, '2011-12-16', 0, '2011-12-18 13:59:42'),
(33, 3, 2, 15, 3, 40000, 79200, '2011-12-30', 0, '2012-01-04 13:31:45'),
(35, 4, 1, 17, 5, 9800, 2352, '2011-12-30', 0, '2012-01-05 17:57:52'),
(36, 3, 1, 18, 5, 9000, 8370, '2012-01-06', 0, '2012-01-06 13:32:25'),
(37, 4, 3, 1, 3, 9800, 16856, '2012-01-06', 0, '2012-01-08 12:57:51'),
(38, 4, 2, 9, 6, 7600, 10108, '2012-01-06', 0, '2012-01-08 13:03:36'),
(41, 3, 1, 12, 6, 8500, 12665, '2012-01-06', 0, '2012-01-08 14:46:21'),
(44, 4, 1, 11, 3, 9850, 18321, '2012-01-07', 0, '2012-01-09 01:30:07'),
(45, 6, 1, 4, 7, 12000, 22200, '2012-01-06', 0, '2012-01-11 13:36:18'),
(46, 4, 2, 3, 3, 7000, 6440, '2012-01-06', 0, '2012-01-11 13:39:36'),
(47, 3, 1, 1, 3, 9800, 13426, '2012-01-07', 0, '2012-01-13 01:39:10'),
(48, 4, 2, 9, 3, 5600, 8512, '2012-01-07', 0, '2012-01-13 01:39:28'),
(49, 3, 3, 11, 3, 6500, 10010, '2012-01-07', 0, '2012-01-13 01:39:50');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203 ;

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
(192, 46, 22),
(193, 47, 50),
(194, 47, 43),
(195, 47, 44),
(196, 48, 43),
(197, 48, 40),
(198, 48, 33),
(199, 48, 36),
(200, 49, 56),
(201, 49, 46),
(202, 49, 52);

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
