-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2012 at 08:26 AM
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
  `serial` varchar(10) NOT NULL,
  `farmer_id` bigint(20) NOT NULL,
  `quality` int(11) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `cost` int(11) NOT NULL,
  `lot_number` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `auction_list`
--

REPLACE INTO `auction_list` (`id`, `serial`, `farmer_id`, `quality`, `buyer_id`, `cost`, `lot_number`, `date`) VALUES
(3, '', 2, 2, 5, 1512, 5, '2011-12-02'),
(4, '', 9, 1, 3, 9600, 3, '2011-12-09'),
(5, '', 1, 3, 11, 5455, 5, '2011-12-30'),
(6, '', 9, 2, 11, 6000, 3, '2012-01-06'),
(7, '', 18, 2, 3, 6545, 4, '2012-01-06'),
(8, '', 1, 1, 3, 9000, 5, '2012-01-06'),
(9, '', 1, 1, 10, 8000, 6, '2012-01-06'),
(10, '', 4, 1, 7, 12000, 6, '2012-01-06'),
(11, '', 7, 2, 5, 7000, 4, '2012-01-06'),
(12, '', 20, 1, 12, 9800, 5, '2012-01-13'),
(13, '', 17, 1, 3, 9800, 3, '2012-01-13'),
(14, '1/3', 9, 1, 10, 8977, 3, '2012-01-13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `buyers`
--

REPLACE INTO `buyers` (`id`, `name`, `short_name`, `shop`, `street`, `town`, `phone`, `mobile`, `email`, `fax`, `tin`) VALUES
(3, 'Eshwar', 'ESH', 'Jayas Health Care', 'Kukatpally', 'Hyderabad', '12312312312', '9959076450', 'eshwarcc@gmail.com', '08497220564', '2A335S34M'),
(4, 'Vijay', 'VJ', 'Vijays shop', 'Vidya nagar', 'Hyderabad', '04023564854', '9596852564', 'vijay@gg.com', '5446464', '54s65d'),
(5, 'Karthik GV', 'GV', 'JBA', '', '', '', '', '', '', ''),
(6, 'Sandeep', 'SDP', 'Sandeep''s Shop', '', '', '', '9876543210', 'sda@sd.com', '', ''),
(7, 'Varma', 'VRM', '', '', '', '', '', '', '', ''),
(10, 'Chandra', 'CND', 'blah shop', '', '', '', '', '', '', ''),
(11, 'Chandra Sekhar', 'CND', 'blah shop', '', '', '', '', '', '', ''),
(12, 'Harish', 'BT', '', '', '', '', '', '', '', ''),
(13, 'BL', 'BL', '', '', '', '', '', '', '', ''),
(14, 'DV', 'DV', '', '', '', '', '', '', '', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `buyer_additions`
--

CREATE TABLE IF NOT EXISTS `buyer_additions` (
  `commission` varchar(10) NOT NULL COMMENT 'percentage',
  `loading` varchar(10) NOT NULL COMMENT 'per bag',
  `labour` varchar(10) NOT NULL COMMENT 'per bag',
  `gumastha` varchar(10) NOT NULL COMMENT 'per bag',
  `gumastha_new` varchar(10) NOT NULL,
  `bags` varchar(10) NOT NULL COMMENT 'per bag',
  `amc` varchar(10) NOT NULL COMMENT 'percentage',
  `rusum` varchar(10) NOT NULL COMMENT 'per bag'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyer_additions`
--

REPLACE INTO `buyer_additions` (`commission`, `loading`, `labour`, `gumastha`, `gumastha_new`, `bags`, `amc`, `rusum`) VALUES
('1', '3', '3', '0.5', '0.5', '28', '1', '0.5');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `buyer_bills`
--

REPLACE INTO `buyer_bills` (`id`, `buyer_id`, `date`, `payed_on`, `time`) VALUES
(1, 3, '2012-01-07', '0000-00-00', '2012-01-12 19:37:34'),
(2, 13, '2012-01-13', '0000-00-00', '2012-01-13 16:42:41'),
(3, 3, '2012-01-13', '0000-00-00', '2012-01-13 19:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_credit_usage`
--

CREATE TABLE IF NOT EXISTS `buyer_credit_usage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint(20) NOT NULL,
  `bill_id` bigint(20) NOT NULL,
  `money` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `buyer_credit_usage`
--

REPLACE INTO `buyer_credit_usage` (`id`, `buyer_id`, `bill_id`, `money`, `description`, `date`) VALUES
(1, 3, 1, 5000, 'Payed last time', '0000-00-00'),
(2, 3, 1, 1000, 'Deduction 2', '0000-00-00'),
(3, 3, 1, 2000, 'Previous balance', '2012-01-13'),
(10, 3, 1, 142, 'sdfdsfd', '2012-01-13'),
(11, 3, 3, 646, 'deduct', '2012-01-16');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `buyer_expenses`
--

REPLACE INTO `buyer_expenses` (`id`, `bill_id`, `description`, `money`) VALUES
(2, 1, 'Another add', 3000),
(24, 3, 'sdfsdf', 589),
(22, 3, 'sdfsdfd', 8100),
(23, 3, 'sdd', 456),
(7, 2, 'jhgjhh', 456);

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

REPLACE INTO `company` (`name`, `town`, `favicon`, `bill_bg`) VALUES
('JBA Balaji Traders', 'Kalyandurg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE IF NOT EXISTS `farmers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `village_id` bigint(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `farmers`
--

REPLACE INTO `farmers` (`id`, `village_id`, `name`) VALUES
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
(19, 11, 'khr'),
(20, 14, 'one two'),
(21, 3, 'Basanna'),
(22, 15, 'Shiva Raj'),
(23, 3, 'Ramnjineyulu'),
(24, 3, 'Siva raj'),
(25, 3, 'Vannur swamy'),
(26, 3, 'Soori');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_accounts`
--

CREATE TABLE IF NOT EXISTS `farmer_accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) NOT NULL,
  `credit` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `farmer_accounts`
--

REPLACE INTO `farmer_accounts` (`id`, `farmer_id`, `credit`) VALUES
(14, 11, -500),
(15, 18, -2671),
(16, 3, -4000),
(17, 9, -5000);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `farmer_bills`
--

REPLACE INTO `farmer_bills` (`id`, `farmer_id`, `date`, `advance`, `freight`, `misc`, `payed_on`, `time`) VALUES
(1, 11, '2011-12-09', 0, 60, 15, '0000-00-00', '2011-12-14 20:34:12'),
(2, 1, '2011-12-16', 0, 0, 0, '0000-00-00', '2011-12-18 08:32:34'),
(3, 1, '2011-12-09', 0, 0, 0, '0000-00-00', '2011-12-24 11:05:57'),
(4, 15, '2011-12-30', 0, 0, 0, '0000-00-00', '2012-01-05 05:36:11'),
(5, 18, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-06 08:03:03'),
(6, 9, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-08 12:32:28'),
(7, 11, '2012-01-07', 0, 0, 0, '0000-00-00', '2012-01-08 20:26:27'),
(8, 1, '2011-11-26', 0, 0, 0, '0000-00-00', '2012-01-11 05:38:46'),
(9, 3, '2012-01-06', 0, 0, 0, '0000-00-00', '2012-01-11 08:12:56'),
(10, 1, '2012-01-07', 0, 0, 0, '0000-00-00', '2012-01-13 16:27:07'),
(11, 9, '2012-01-13', 0, 0, 0, '0000-00-00', '2012-01-13 16:32:34'),
(12, 21, '2012-01-13', 0, 0, 0, '0000-00-00', '2012-01-13 16:39:13'),
(13, 23, '2012-01-13', 0, 0, 0, '0000-00-00', '2012-01-15 10:28:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `farmer_credit_payments`
--

REPLACE INTO `farmer_credit_payments` (`id`, `farmer_id`, `bill_id`, `credit`, `date`) VALUES
(2, 18, 5, 2671, '2012-01-07'),
(4, 3, 9, 4000, '2012-01-11'),
(5, 11, 7, 500, '2012-01-12'),
(6, 9, 11, 5000, '2012-01-13');

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

REPLACE INTO `farmer_deductions` (`cash`, `commission`, `amali`, `extra`) VALUES
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `farmer_expenses`
--

REPLACE INTO `farmer_expenses` (`id`, `bill_id`, `description`, `money`) VALUES
(14, 1, 'sdfsf', 4500),
(15, 1, 'sdfdsf', 746),
(16, 5, 'karchu cash', 1000),
(17, 9, 'FREIGHT', 40),
(19, 8, 'freight', 40),
(20, 9, 'hand cash', 500),
(21, 7, 'Cash', 1000),
(22, 7, 'blah blah', 8652),
(24, 11, 'cash', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `lots`
--

CREATE TABLE IF NOT EXISTS `lots` (
  `lot_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `serial` varchar(10) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `lots`
--

REPLACE INTO `lots` (`lot_id`, `serial`, `lot_number`, `quality`, `farmer_id`, `buyer_id`, `cost`, `total_cost`, `date`, `pending`, `time`) VALUES
(26, '', 5, 1, 10, 3, 5678, 14365, '2011-11-25', 0, '2011-11-25 03:00:10'),
(27, '', 4, 2, 1, 3, 4565, 9221, '2011-11-26', 0, '2011-11-26 00:33:06'),
(28, '', 3, 2, 8, 6, 5, 8, '2011-11-25', 0, '2011-11-26 14:23:09'),
(29, '', 3, 2, 11, 3, 6500, 8710, '2011-12-09', 0, '2011-12-10 13:56:42'),
(30, '', 4, 1, 11, 3, 9800, 17738, '2011-12-09', 0, '2011-12-10 15:45:41'),
(31, '', 5, 3, 1, 3, 9500, 19475, '2011-12-09', 0, '2011-12-10 15:46:23'),
(32, '', 5, 1, 1, 11, 9600, 24288, '2011-12-16', 0, '2011-12-18 08:29:42'),
(33, '', 3, 2, 15, 3, 40000, 79200, '2011-12-30', 0, '2012-01-04 08:01:45'),
(35, '', 4, 1, 17, 5, 9800, 2352, '2011-12-30', 0, '2012-01-05 12:27:52'),
(36, '', 3, 1, 18, 5, 9000, 8370, '2012-01-06', 0, '2012-01-06 08:02:25'),
(37, '', 4, 3, 1, 3, 9800, 16856, '2012-01-06', 0, '2012-01-08 07:27:51'),
(38, '', 4, 2, 9, 6, 7600, 10108, '2012-01-06', 0, '2012-01-08 07:33:36'),
(41, '', 3, 1, 12, 6, 8500, 12665, '2012-01-06', 0, '2012-01-08 09:16:21'),
(44, '', 4, 1, 11, 3, 9850, 18321, '2012-01-07', 0, '2012-01-08 20:00:07'),
(45, '', 6, 1, 4, 7, 12000, 22200, '2012-01-06', 0, '2012-01-11 08:06:18'),
(46, '', 4, 2, 3, 3, 7000, 6440, '2012-01-06', 0, '2012-01-11 08:09:36'),
(47, '', 3, 1, 1, 0, 9800, 13426, '2012-01-07', 0, '2012-01-12 20:09:10'),
(48, '', 4, 2, 9, 0, 5600, 8512, '2012-01-07', 0, '2012-01-12 20:09:28'),
(49, '', 3, 3, 11, 0, 6500, 10010, '2012-01-07', 0, '2012-01-12 20:09:50'),
(50, '', 5, 1, 9, 0, 9800, 18326, '2012-01-13', 0, '2012-01-13 16:17:58'),
(51, '', 6, 1, 21, 13, 10000, 26000, '2012-01-13', 0, '2012-01-13 16:29:14'),
(52, '', 5, 1, 1, 11, 9800, 21756, '2012-01-13', 0, '2012-01-13 16:30:04'),
(53, '', 3, 1, 9, 13, 5820, 7391, '2012-01-13', 0, '2012-01-13 16:30:22'),
(54, '4/5', 3, 1, 1, 0, 8950, 13604, '2012-01-13', 0, '2012-01-15 05:51:33'),
(55, '', 2, 2, 1, 0, 8500, 8925, '2012-01-13', 0, '2012-01-15 05:58:30'),
(56, '', 3, 1, 9, 0, 9800, 14994, '2012-01-13', 0, '2012-01-15 06:01:26'),
(57, '1/3', 3, 1, 9, 0, 9800, 14700, '2012-01-13', 0, '2012-01-15 06:05:07'),
(58, '1/8', 3, 2, 1, 0, 8500, 11730, '2012-01-13', 0, '2012-01-15 07:21:09'),
(59, '4', 4, 2, 22, 0, 7000, 8470, '2012-01-13', 0, '2012-01-15 10:04:25'),
(60, '', 3, 1, 23, 13, 6500, 7215, '2012-01-13', 0, '2012-01-15 10:26:37'),
(61, '', 4, 2, 24, 14, 7000, 8470, '2012-01-13', 0, '2012-01-15 10:27:07'),
(62, '', 4, 1, 25, 14, 11500, 14490, '2012-01-13', 0, '2012-01-15 10:27:40'),
(63, '', 3, 1, 26, 13, 12000, 8640, '2012-01-13', 0, '2012-01-15 10:28:13'),
(64, '', 5, 1, 9, 3, 8900, 22250, '2012-01-13', 0, '2012-01-16 09:37:49'),
(65, '', 3, 1, 18, 3, 9000, 7830, '2012-01-13', 0, '2012-01-16 09:38:03'),
(66, '', 3, 2, 1, 3, 6852, 9935, '2012-01-13', 0, '2012-01-16 09:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE IF NOT EXISTS `quality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quality` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `quality`
--

REPLACE INTO `quality` (`id`, `quality`) VALUES
(1, 'K'),
(2, 'F'),
(3, 'C'),
(4, 'B'),
(5, 'Mandi');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `multiple_buyers` tinyint(1) NOT NULL,
  `serial_numbers` tinyint(1) NOT NULL,
  `day_book` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

REPLACE INTO `settings` (`multiple_buyers`, `serial_numbers`, `day_book`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE IF NOT EXISTS `villages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `village` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `villages`
--

REPLACE INTO `villages` (`id`, `village`) VALUES
(1, 'Kalyandurgam'),
(2, 'Rayadurg'),
(3, 'Anantapur'),
(5, 'madras'),
(8, 'Bangalore'),
(9, 'dodagatta'),
(10, 'Pavani Cosmopolitan'),
(11, 'bandameedapalli'),
(12, 'chapari'),
(13, 'makodiki'),
(14, 'blah blah '),
(15, 'Hyderabad');

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE IF NOT EXISTS `weights` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lot_id` bigint(20) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=326 ;

--
-- Dumping data for table `weights`
--

REPLACE INTO `weights` (`id`, `lot_id`, `buyer_id`, `weight`) VALUES
(89, 26, 0, 52),
(90, 26, 0, 52),
(91, 26, 0, 43),
(92, 26, 0, 83),
(93, 26, 0, 23),
(94, 27, 0, 83),
(95, 27, 0, 23),
(96, 27, 0, 43),
(97, 27, 0, 53),
(98, 28, 0, 50),
(99, 28, 0, 54),
(100, 28, 0, 56),
(101, 29, 0, 48),
(102, 29, 0, 63),
(103, 29, 0, 23),
(104, 30, 0, 48),
(105, 30, 0, 43),
(106, 30, 0, 52),
(107, 30, 0, 38),
(108, 31, 0, 23),
(109, 31, 0, 52),
(110, 31, 0, 54),
(111, 31, 0, 33),
(112, 31, 0, 43),
(113, 32, 0, 48),
(114, 32, 0, 23),
(115, 32, 0, 80),
(116, 32, 0, 50),
(117, 32, 0, 52),
(118, 33, 0, 46),
(119, 33, 0, 52),
(120, 33, 0, 100),
(124, 35, 0, 30),
(125, 35, 0, -2),
(126, 35, 0, -2),
(127, 35, 0, -2),
(128, 36, 0, 30),
(129, 36, 0, 31),
(130, 36, 0, 32),
(131, 37, 0, 48),
(132, 37, 0, 38),
(133, 37, 0, 58),
(134, 37, 0, 28),
(139, 41, 0, 48),
(140, 41, 0, 58),
(141, 41, 0, 43),
(165, 44, 0, 48),
(166, 44, 0, 44),
(167, 44, 0, 46),
(168, 44, 0, 48),
(175, 38, 0, 40),
(176, 38, 0, 32),
(177, 38, 0, 30),
(178, 38, 0, 31),
(179, 45, 0, 30),
(180, 45, 0, 29),
(181, 45, 0, 31),
(182, 45, 0, 30),
(183, 45, 0, 32),
(184, 45, 0, 33),
(189, 46, 0, 30),
(190, 46, 0, 19),
(191, 46, 0, 21),
(192, 46, 0, 22),
(193, 47, 0, 50),
(194, 47, 0, 43),
(195, 47, 0, 44),
(196, 48, 0, 43),
(197, 48, 0, 40),
(198, 48, 0, 33),
(199, 48, 0, 36),
(200, 49, 0, 56),
(201, 49, 0, 46),
(202, 49, 0, 52),
(208, 50, 0, 48),
(209, 50, 0, 43),
(210, 50, 0, 23),
(211, 50, 0, 23),
(212, 50, 0, 50),
(213, 51, 0, 38),
(214, 51, 0, 48),
(215, 51, 0, 33),
(216, 51, 0, 52),
(217, 51, 0, 43),
(218, 51, 0, 46),
(219, 52, 0, 52),
(220, 52, 0, 23),
(221, 52, 0, 40),
(222, 52, 0, 52),
(223, 52, 0, 55),
(224, 53, 0, 23),
(225, 53, 0, 52),
(226, 53, 0, 52),
(274, 58, 3, 46),
(275, 58, 12, 46),
(276, 58, 4, 46),
(277, 54, 10, 60),
(278, 54, 5, 52),
(279, 54, 10, 40),
(283, 55, 3, 52),
(284, 55, 12, 53),
(285, 56, 12, 52),
(286, 56, 3, 50),
(287, 56, 13, 51),
(288, 57, 10, 50),
(289, 57, 3, 50),
(290, 57, 3, 50),
(291, 59, 14, 35),
(292, 59, 12, 22),
(293, 59, 12, 30),
(294, 59, 7, 34),
(298, 61, 0, 35),
(299, 61, 0, 22),
(300, 61, 0, 30),
(301, 61, 0, 34),
(302, 62, 0, 30),
(303, 62, 0, 30),
(304, 62, 0, 32),
(305, 62, 0, 34),
(306, 63, 0, 25),
(307, 63, 0, 23),
(308, 63, 0, 24),
(312, 60, 0, 35),
(313, 60, 0, 41),
(314, 60, 0, 35),
(315, 64, 0, 54),
(316, 64, 0, 50),
(317, 64, 0, 43),
(318, 64, 0, 40),
(319, 64, 0, 63),
(320, 65, 0, 30),
(321, 65, 0, 29),
(322, 65, 0, 28),
(323, 66, 0, 52),
(324, 66, 0, 50),
(325, 66, 0, 43);

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

REPLACE INTO `weight_deduction` (`weight_deduction`) VALUES
(2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
