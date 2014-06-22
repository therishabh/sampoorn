-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2013 at 10:34 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `check_retail`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_number` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `discount_per_item` varchar(255) NOT NULL,
  `discount_amount_per_item` varchar(255) NOT NULL,
  `amount_per_item` varchar(255) NOT NULL,
  `total_item` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `main_discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `pay` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `bill_number`, `customer_id`, `product_id`, `quantity`, `product_price`, `discount_per_item`, `discount_amount_per_item`, `amount_per_item`, `total_item`, `sub_total`, `main_discount`, `grand_total`, `pay`, `due`, `created_date`, `status`) VALUES
(1, 'AWC_1', '2', '*3*/*5*', '*1*/*2*', '499.00/259.00', '0/0', '0.00/0.00', '499.00/518.00', '3', '1017.00', '2.9', '988.00', '500', '488.00', '2013-11-13 01:43:59', 1),
(2, 'AWC_2', '3', '*2*/*6*/*5*', '*3*/*1*/*1*', '599.00/579.00/259.00', '0/0/0', '0.00/0.00/0.00', '1797.00/579.00/259.00', '5', '2635.00', '0', '2635.00', '20003', '0.00', '2013-11-13 01:45:16', 1),
(3, 'AWC_3', '4', '*4*/*6*/*10*', '*3*/*2*/*1*', '689.00/579.00/469.00', '8/0/0', '165.36/0.00/0.00', '1901.64/1158.00/469.00', '6', '3528.64', '10', '3176.00', '3000', '176.00', '2013-11-13 01:47:03', 1),
(4, 'AWC_4', '5', '*4*/*8*', '*1*/*2*', '689.00/899.00', '10/2', '68.90/35.96', '620.10/1762.04', '3', '2382.14', '2', '2334.00', '2500', '0.00', '2013-11-13 01:48:07', 1),
(5, 'AWC_5', '6', '*7*/*8*', '*2*/*1*', '499.00/899.00', '0/0', '0.00/0.00', '998.00/899.00', '3', '1897.00', '0', '1897.00', '1500', '397.00', '2013-11-13 01:49:40', 1),
(6, 'AWC_6', '7', '*4*', '*2*', '689.00', '0', '0.00', '1378.00', '2', '1378.00', '0', '1378.00', '0', '1378.00', '2013-11-13 01:56:53', 1),
(7, 'AWC_7', '8', '*1*', '*1*', '299.00', '0', '0.00', '299.00', '1', '299.00', '10', '269.00', '0', '269.00', '2013-11-13 02:01:57', 1),
(8, 'AWC_8', '9', '*6*', '*1*', '579.00', '0', '0.00', '579.00', '1', '579.00', '20', '463.00', '500', '0.00', '2013-11-14 12:47:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `status`) VALUES
(1, 'Misc', 1),
(2, 'AllenSolly', 1),
(3, 'Armani', 1),
(4, 'BlackBerrey', 1),
(5, 'Gucci', 1),
(6, 'Levis', 1),
(7, 'Nike', 1),
(8, 'Sleepwell', 1),
(9, 'Versace', 1),
(10, 'Lee', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `status`) VALUES
(1, 'Misc', 1),
(2, 'Trousers', 1),
(3, 'Bed sheet', 1),
(4, 'Pajama', 1),
(5, 'Shirt', 1),
(6, 'Kurta', 1),
(7, 'Swimwear', 1),
(8, 'Nightwear', 1),
(9, 'Jeans', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `total_due` varchar(255) NOT NULL DEFAULT '0',
  `paid_due` varchar(255) NOT NULL,
  `total_paid_due` varchar(255) NOT NULL DEFAULT '0',
  `paid_due_date` varchar(2000) NOT NULL,
  `created_date` datetime NOT NULL,
  `notification_status` char(1) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone_no`, `email`, `address`, `bill_no`, `due`, `total_due`, `paid_due`, `total_paid_due`, `paid_due_date`, `created_date`, `notification_status`, `status`) VALUES
(1, 'Misc', '0000000000', 'misc@kasovious.com', 'Misc', '', '', '0', '', '0', '', '2013-11-11 02:10:38', '1', 1),
(2, 'Rishabh Agrawal', '8010979311', 'rishabh_agr@yahoo.com', 'Sitapur, Lucknow (UP India)', 'AWC_1', '488.00', '488.00', '', '0', '', '2013-11-13 01:43:59', '1', 1),
(3, 'Sachin Yadav', '9874447545', 'sachin_yad@gmail.com', 'Delhi, India', 'AWC_2', '0.00', '0.00', '', '0', '', '2013-11-13 01:45:16', '1', 1),
(4, 'Somya Tripathi', '8856497979', 'somya129@gmail.com', 'Agra, India', 'AWC_3', '176.00', '176.00', '', '0', '', '2013-11-13 01:47:03', '1', 1),
(5, 'Rituja Gupta', '9879646465', 'rituja_gupta@gmail.com', 'Lucknow India ', 'AWC_4', '0.00', '0.00', '', '0', '', '2013-11-13 01:48:07', '1', 1),
(6, 'Shivam Goyal', '9944616179', 'shivam132@gmail.com', 'Kanpur, India', 'AWC_5', '397.00', '397.00', '', '0', '', '2013-11-13 01:49:40', '1', 1),
(7, 'Karan Kumar', '9494544564', 'karan@gmail.com', 'india', 'AWC_6', '1378.00', '1378.00', '300.00', '300.00', '2013-11-13 09:38:31', '2013-11-13 01:56:53', '1', 1),
(8, 'Jatin Gupta', '9854948498', 'jatin@gmail.com', '', 'AWC_7', '269.00', '269.00', '', '0', '', '2013-11-13 02:01:57', '1', 1),
(9, 'Mayank Mittal', '8854578797', 'mayank@gmail.com', 'Punjab', 'AWC_8', '0.00', '0.00', '', '0', '', '2013-11-14 12:47:41', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dues`
--

CREATE TABLE IF NOT EXISTS `dues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(20) NOT NULL,
  `paid_amount` varchar(20) NOT NULL,
  `paid_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dues`
--

INSERT INTO `dues` (`id`, `customer_id`, `paid_amount`, `paid_date`) VALUES
(1, '7', '300.00', '2013-11-13 09:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `rating` varchar(20) NOT NULL,
  `ratting_date` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE IF NOT EXISTS `finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `purchase_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `product_id`, `qty`, `price`, `purchase_date`) VALUES
(1, '3', '1', '499.00', '2013-11-13 01:43:59'),
(2, '5', '2', '259.00', '2013-11-13 01:43:59'),
(3, '2', '3', '599.00', '2013-11-13 01:45:16'),
(4, '6', '1', '579.00', '2013-11-13 01:45:16'),
(5, '5', '1', '259.00', '2013-11-13 01:45:16'),
(6, '4', '3', '689.00', '2013-11-13 01:47:03'),
(7, '6', '2', '579.00', '2013-11-13 01:47:03'),
(8, '10', '1', '469.00', '2013-11-13 01:47:03'),
(9, '4', '1', '689.00', '2013-11-13 01:48:07'),
(10, '8', '2', '899.00', '2013-11-13 01:48:07'),
(11, '7', '2', '499.00', '2013-11-13 01:49:40'),
(12, '8', '1', '899.00', '2013-11-13 01:49:40'),
(13, '4', '2', '689.00', '2013-11-13 01:56:53'),
(14, '1', '1', '299.00', '2013-11-13 02:01:57'),
(15, '6', '1', '579.00', '2013-11-14 12:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(20) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'misc',
  `product_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `sell_qty` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notification_status` char(1) NOT NULL DEFAULT '1',
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `barcode`, `category`, `product_name`, `qty`, `sell_qty`, `price`, `brand`, `color`, `size`, `type`, `notification_status`, `status`) VALUES
(1, '00001', '4', 'Pajama', 150, 1, 299, '9', 'Gray', '32', 'M', '1', '1'),
(2, '00002', '5', 'Men&#039;s Shirt', 100, 3, 599, '5', 'Black', '34', 'M', '1', '1'),
(3, '00003', '8', 'Lower', 120, 1, 499, '5', 'Black', '34', 'F', '1', '1'),
(4, '00004', '3', 'Bed Sheet', 50, 6, 689, '8', 'Blue', '', '', '1', '1'),
(5, '00005', '7', 'Shirt', 68, 3, 259, '3', 'Black', '36', 'M', '1', '1'),
(6, '00006', '6', 'Laddies Kurta', 150, 4, 579, '9', 'Black', '36', 'F', '1', '1'),
(7, '00007', '2', 'Trousers', 160, 2, 499, '6', 'Blue', '34', 'M', '1', '1'),
(8, '00008', '9', 'Jeans', 80, 3, 899, '5', '', '', 'F', '1', '1'),
(9, '00009', '4', 'Pajama', 74, 0, 158, '7', 'Black', '', 'M', '1', '1'),
(10, '00010', '3', 'Bed Sheet', 100, 1, 469, '8', 'Gray', '', '', '1', '1'),
(11, '00011', '2', 'Trouser', 60, 0, 999, '10', 'Blue', '36', 'F', '1', '1'),
(12, '00012', '2', 'Trouser', 75, 0, 789, '10', 'Black', '32', 'M', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sam`
--

CREATE TABLE IF NOT EXISTS `sam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `command` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `sam`
--

INSERT INTO `sam` (`id`, `command`, `address`, `status`) VALUES
(1, 'Home Page', 'dashboard.php', 1),
(2, 'dashboard', 'dashboard.php', 1),
(3, 'stock', 'stock.php', 1),
(4, 'Newbill', 'new_bill.php', 1),
(5, 'Manage Bill', 'manage_bill.php', 1),
(6, 'Billing', 'billing.php', 1),
(7, 'Customer', 'customer.ph', 1),
(8, 'Dues', 'dues.php', 1),
(9, 'Barcode', 'barcode.php', 1),
(10, 'New stock', 'addstock.php', 1),
(11, 'Add Stock', 'addstock.php', 1),
(12, 'Manage Stock', 'viewstock.php', 1),
(13, 'View Stock', 'viewstock.php', 1),
(14, 'View Bill', 'manage_bill.php', 1),
(15, 'System wizard', 'system_wizard.php', 1),
(16, 'Setting', 'system_wizard.php', 1),
(17, 'Manage User', 'manage_user.php', 1),
(18, 'View User', 'manage_user.php', 1),
(19, 'Password', 'change_password.php', 1),
(20, 'Change_password', 'change_password.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privileges` varchar(255) NOT NULL,
  `notification` char(1) NOT NULL DEFAULT '0',
  `due_day` int(11) NOT NULL DEFAULT '7',
  `stock_item` int(11) NOT NULL DEFAULT '10',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `privileges`, `notification`, `due_day`, `stock_item`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'billing.php/new_bill.php/manage_bill.php/stock.php/addstock.php/viewstock.php/system_wizard.php/change_password.php/manage_user.php/customer.php/dues.php/dashboard.php/notification.php/barcode.php/current_barcode.php/finance.php', '1', 1, 6, 1),
(2, 'rishabh', '202cb962ac59075b964b07152d234b70', 'billing.php/new_bill.php/manage_bill.php/stock.php/addstock.php/viewstock.php/finance.php/dashboard.php/billing.php/stock.php/barcode.php/current_barcode.php', '0', 7, 10, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
