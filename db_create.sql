-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db591622819.db.1and1.com
-- Generation Time: Oct 13, 2016 at 01:32 PM
-- Server version: 5.5.50-0+deb7u2-log
-- PHP Version: 5.4.45-0+deb7u5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db591622819`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `idaccount` int(11) NOT NULL AUTO_INCREMENT,
  `id_producer` int(11) NOT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idaccount`),
  KEY `fk_account_1_idx` (`id_producer`),
  KEY `fk_account_2_idx` (`campaign_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `calculation`
--

CREATE TABLE IF NOT EXISTS `calculation` (
  `calculation_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) DEFAULT NULL,
  `cpm` int(11) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`calculation_id`),
  KEY `fk_calculation_1_idx` (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(255) DEFAULT NULL,
  `budget` float DEFAULT NULL,
  `billing_approved` enum('Y','N') DEFAULT NULL,
  `estimate` float DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT 'N',
  `screen_shot` varchar(45) DEFAULT NULL,
  `copy` longtext,
  `url` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `order_number` int(10) NOT NULL,
  `producer_approved` enum('Y','N') NOT NULL DEFAULT 'N',
  `friendly_url` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '5',
  PRIMARY KEY (`campaign_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_responses`
--

CREATE TABLE IF NOT EXISTS `campaign_responses` (
  `campaign_response_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `supporter_id` int(11) DEFAULT NULL,
  `campaign_response` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`campaign_response_id`),
  KEY `fk_campaign_response_1_idx` (`campaign_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE IF NOT EXISTS `donations` (
  `donation_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `donationtype_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `campaign_id_idx` (`campaign_id`),
  KEY `fk_donationtype_id_idx` (`donationtype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `donation_type`
--

CREATE TABLE IF NOT EXISTS `donation_type` (
  `donationtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `donation_name` varchar(45) NOT NULL,
  PRIMARY KEY (`donationtype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `escrow`
--

CREATE TABLE IF NOT EXISTS `escrow` (
  `escrow_id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate` double DEFAULT NULL,
  `actual` double DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`escrow_id`),
  KEY `fk_escrow_1_idx` (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `follower_count`
--

CREATE TABLE IF NOT EXISTS `follower_count` (
  `follower_count_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `supporter_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`follower_count_id`),
  KEY `fk_follower_count_1_idx` (`supporter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `links_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`links_id`),
  KEY `fk_links_1_idx` (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `org class`
--

CREATE TABLE IF NOT EXISTS `org class` (
  `orgclass_id` int(11) NOT NULL AUTO_INCREMENT,
  `classname` varchar(45) NOT NULL,
  PRIMARY KEY (`orgclass_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `id_owner` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_owner`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

CREATE TABLE IF NOT EXISTS `producers` (
  `id_producer` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `organization_url` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `description` longtext,
  `country` varchar(255) DEFAULT NULL,
  `orgclass_id` int(11) DEFAULT NULL,
  `friendly_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_producer`),
  KEY `orgclass_id_idx` (`orgclass_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `producer_account`
--

CREATE TABLE IF NOT EXISTS `producer_account` (
  `producer_id` int(11) NOT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`producer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE IF NOT EXISTS `reward` (
  `reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `quantity_remaining` int(11) DEFAULT NULL,
  `point_value` int(11) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE IF NOT EXISTS `rewards` (
  `reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `reward_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `quantity_remaining` int(11) DEFAULT NULL,
  `point_value` int(11) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`reward_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `reward_claimed`
--

CREATE TABLE IF NOT EXISTS `reward_claimed` (
  `id_supporter` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `point_value` int(11) NOT NULL,
  `date_claimed` datetime DEFAULT NULL,
  PRIMARY KEY (`id_supporter`,`reward_id`),
  KEY `fk_reward_claimed_reward1_idx` (`reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `screen_shots`
--

CREATE TABLE IF NOT EXISTS `screen_shots` (
  `screen_shots_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `id_supporter` int(11) DEFAULT NULL,
  PRIMARY KEY (`screen_shots_id`),
  KEY `fk_screen_shots_1_idx` (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `supporters`
--

CREATE TABLE IF NOT EXISTS `supporters` (
  `id_supporter` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_follower_count` int(11) DEFAULT NULL,
  `interests` varchar(45) DEFAULT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_supporter`)
) ENGINE=MyISAM  DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `supporter_interest`
--

CREATE TABLE IF NOT EXISTS `supporter_interest` (
  `supporter_interest_if` int(11) NOT NULL AUTO_INCREMENT,
  `supporter_id` int(11) DEFAULT NULL,
  `id_interest` int(11) DEFAULT NULL,
  PRIMARY KEY (`supporter_interest_if`),
  KEY `fk_supporter_interest_1_idx` (`supporter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` int(11) NOT NULL,
  `tag_name` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- Table structure for table `targeting`
--

CREATE TABLE IF NOT EXISTS `targeting` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `fk_targeting_1_idx` (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=big5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
