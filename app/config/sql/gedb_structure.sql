-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2010 at 10:43 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

DROP TABLE IF EXISTS `m_item`;
CREATE TABLE IF NOT EXISTS `m_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(15) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `brand_id` varchar(3) NOT NULL,
  `type_id` varchar(2) NOT NULL,
  `group_id` varchar(1) NOT NULL,
  `size_id` varchar(2) NOT NULL,
  `color_id` varchar(2) NOT NULL,
  `article_id` varchar(10) NOT NULL,
  `cost_price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga Pembelian',
  `pricing_method` char(1) NOT NULL COMMENT 'M : By Margin\nD : Direct',
  `margin` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga Pokok Penjualan (HPP)\n',
  `margin_pct` decimal(10,2) DEFAULT NULL,
  `sales_price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga Penjualan',
  `discount_pct` decimal(10,2) DEFAULT '0.00',
  `active` char(1) NOT NULL DEFAULT 'T',
  `is_upcome` char(1) NOT NULL DEFAULT 'T',
  `description` TEXT,
  `image_file` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `mimetype` varchar(255) DEFAULT NULL,
  `read_count` int(11) NOT NULL DEFAULT 0,
  `last_view_time` datetime DEFAULT NULL,
  `is_recommended` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT (`item_id`),
  KEY (`brand_id`),
  KEY (`type_id`),
  KEY (`group_id`),
  KEY (`size_id`),
  KEY (`color_id`),
  KEY (`article_id`),
  FULLTEXT (`item_name`),
  FULLTEXT (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_article`
--

DROP TABLE IF EXISTS `m_item_article`;
CREATE TABLE IF NOT EXISTS `m_item_article` (
  `article_id` varchar(10) NOT NULL,
  `article_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `brand_id` varchar(3) NOT NULL,
  `date_create` date NOT NULL,
  `designer` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `type_id` varchar(2) CHARACTER SET latin1 NOT NULL,
  `front_side` varchar(35) CHARACTER SET latin1 NOT NULL DEFAULT 'noimage.jpg',
  `back_side` varchar(35) CHARACTER SET latin1 NOT NULL DEFAULT 'noimage.jpg',
  `active` char(1) CHARACTER SET latin1 NOT NULL DEFAULT 'T',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  KEY (`brand_id`),
  KEY (`type_id`),
  FULLTEXT (`article_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_brand`
--

DROP TABLE IF EXISTS `m_item_brand`;
CREATE TABLE IF NOT EXISTS `m_item_brand` (
  `brand_id` varchar(3) NOT NULL,
  `brand_name` varchar(30) NOT NULL,
  `brand_logo` varchar(30) NOT NULL DEFAULT 'noimage.jpg',
  `active` char(1) NOT NULL DEFAULT 'T',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`brand_id`),
  FULLTEXT (`brand_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_category`
--

DROP TABLE IF EXISTS `m_item_category`;
CREATE TABLE IF NOT EXISTS `m_item_category` (
  `category_id` varchar(1) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'T',
  `image_file` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `mimetype` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  FULLTEXT (`category_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_color`
--

DROP TABLE IF EXISTS `m_item_color`;
CREATE TABLE IF NOT EXISTS `m_item_color` (
  `color_id` varchar(2) NOT NULL,
  `color_name` varchar(30) NOT NULL,
  `hexa_decimal` varchar(7) DEFAULT NULL,
  `active` char(1) NOT NULL DEFAULT 'T',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`color_id`),
  FULLTEXT (`color_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_group`
--

DROP TABLE IF EXISTS `m_item_group`;
CREATE TABLE IF NOT EXISTS `m_item_group` (
  `group_id` varchar(1) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'T',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  FULLTEXT (`group_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_size`
--

DROP TABLE IF EXISTS `m_item_size`;
CREATE TABLE IF NOT EXISTS `m_item_size` (
  `size_id` varchar(2) NOT NULL,
  `size` varchar(20) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'T',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`size_id`),
  FULLTEXT (`size`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_stock`
--

DROP TABLE IF EXISTS `m_item_stock`;
CREATE TABLE IF NOT EXISTS `m_item_stock` (
  `stock_id` INT(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` varchar(5) NOT NULL,
  `item_id` int(11) NOT NULL,
  `total_stock` int(11) NOT NULL DEFAULT '0',
  `actual_stock` int(11) NOT NULL DEFAULT '0',
  `booked_stock` int(11) NOT NULL DEFAULT '0',
  `release_stock` int(11) NOT NULL DEFAULT '0',
  `reject` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_id`),
  KEY (`warehouse_id`),
  KEY (`item_id`),
  KEY (`warehouse_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_type`
--

DROP TABLE IF EXISTS `m_item_type`;
CREATE TABLE IF NOT EXISTS `m_item_type` (
  `type_id` varchar(2) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `category_id` varchar(1) DEFAULT NULL,
  `active` char(1) NOT NULL DEFAULT 'T',
  `image_file` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `mimetype` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`type_id`),
  KEY (`category_id`),
  FULLTEXT (`type_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_warehouse`
--

DROP TABLE IF EXISTS `m_warehouse`;
CREATE TABLE IF NOT EXISTS `m_warehouse` (
  `warehouse_id` varchar(3) NOT NULL,
  `warehouse` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `active` char(1) NOT NULL DEFAULT 'T',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`warehouse_id`),
  FULLTEXT (`warehouse`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
