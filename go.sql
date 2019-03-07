-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2017 at 11:57 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `go`
--
CREATE DATABASE IF NOT EXISTS `go` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `go`;

-- --------------------------------------------------------

--
-- Table structure for table `associates`
--

CREATE TABLE `associates` (
  `ioid` int(10) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `preferedname` varchar(100) DEFAULT NULL,
  `pronouns` varchar(10) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `personalemail` varchar(150) DEFAULT NULL,
  `peachioemail` varchar(150) DEFAULT NULL,
  `phone1` varchar(30) DEFAULT NULL,
  `phone1_type` varchar(30) DEFAULT NULL,
  `phone2` varchar(30) DEFAULT NULL,
  `phone2_type` varchar(30) DEFAULT NULL,
  `address1` varchar(200) DEFAULT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `admin` int(1) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `managerdirector` int(1) NOT NULL DEFAULT '0',
  `projects_safe` varchar(500) DEFAULT NULL,
  `media_safe` varchar(500) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `quip` varchar(300) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `startdate` varchar(20) DEFAULT NULL,
  `enddate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `notes` varchar(2000) DEFAULT NULL,
  `ssn` varchar(30) DEFAULT NULL,
  `license` varchar(200) DEFAULT NULL,
  `license_state` varchar(50) DEFAULT NULL,
  `dob` varchar(8) DEFAULT NULL,
  `citizenship` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `associates`
--

-- --------------------------------------------------------

--
-- Table structure for table `g_groups_sync`
--

CREATE TABLE `g_groups_sync` (
  `gid` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `notes` varchar(1000) DEFAULT NULL,
  `members` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g_users_sync`
--

CREATE TABLE `g_users_sync` (
  `gid` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `given_name` varchar(100) DEFAULT NULL,
  `family_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `hd` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ic_creators`
--

CREATE TABLE `ic_creators` (
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ic_leads`
--

CREATE TABLE `ic_leads` (
  `lead_id` int(11) NOT NULL,
  `status_read` int(1) NOT NULL DEFAULT '0',
  `status_open` int(1) NOT NULL DEFAULT '0',
  `status_archive` int(1) NOT NULL DEFAULT '0',
  `date_income` varchar(40) DEFAULT NULL,
  `date_open` varchar(40) DEFAULT NULL,
  `date_lastcontact` varchar(40) DEFAULT NULL,
  `date_archive` varchar(40) DEFAULT NULL,
  `agent` varchar(40) DEFAULT NULL,
  `contact_firstname` varchar(50) DEFAULT NULL,
  `contact_lastname` varchar(50) DEFAULT NULL,
  `contact_position` varchar(50) DEFAULT NULL,
  `contact_company` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(30) DEFAULT NULL,
  `contact_phonealt` varchar(30) DEFAULT NULL,
  `contact_address` varchar(100) DEFAULT NULL,
  `contact_state` varchar(100) DEFAULT NULL,
  `contact_code` varchar(30) DEFAULT NULL,
  `contact_country` varchar(50) DEFAULT NULL,
  `attachment` varchar(300) DEFAULT NULL,
  `app_content` varchar(50) DEFAULT NULL,
  `app_assistance` varchar(30) DEFAULT NULL,
  `app_goals` varchar(500) DEFAULT NULL,
  `app_samples` varchar(500) DEFAULT NULL,
  `proj_type` varchar(60) DEFAULT NULL,
  `proj_synopsis` varchar(500) DEFAULT NULL,
  `proj_submissions` varchar(500) DEFAULT NULL,
  `proj_screened` varchar(500) DEFAULT NULL,
  `proj_goals` varchar(500) DEFAULT NULL,
  `content_title` varchar(50) DEFAULT NULL,
  `content_duration` varchar(20) DEFAULT NULL,
  `content_year` varchar(4) DEFAULT NULL,
  `content_genre` varchar(20) DEFAULT NULL,
  `content_keycast` varchar(400) DEFAULT NULL,
  `content_keycrew` varchar(400) DEFAULT NULL,
  `content_writer` varchar(100) DEFAULT NULL,
  `content_adtl` varchar(500) DEFAULT NULL,
  `notes` varchar(1000) DEFAULT NULL,
  `process` varchar(500) DEFAULT NULL,
  `creator_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_leads`
--

-- --------------------------------------------------------

--
-- Table structure for table `portal_mods`
--

CREATE TABLE `portal_mods` (
  `modid` int(5) NOT NULL,
  `portal_access_name` varchar(50) NOT NULL,
  `friendly` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `parent` varchar(20) NOT NULL,
  `haschildren` int(1) NOT NULL,
  `hidden` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portal_mods`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associates`
--
ALTER TABLE `associates`
  ADD UNIQUE KEY `agentid` (`ioid`);

--
-- Indexes for table `g_groups_sync`
--
ALTER TABLE `g_groups_sync`
  ADD UNIQUE KEY `gid` (`gid`);

--
-- Indexes for table `g_users_sync`
--
ALTER TABLE `g_users_sync`
  ADD UNIQUE KEY `gid` (`gid`);

--
-- Indexes for table `ic_creators`
--
ALTER TABLE `ic_creators`
  ADD UNIQUE KEY `creator_id` (`creator_id`);

--
-- Indexes for table `ic_leads`
--
ALTER TABLE `ic_leads`
  ADD UNIQUE KEY `lead_id` (`lead_id`);

--
-- Indexes for table `portal_mods`
--
ALTER TABLE `portal_mods`
  ADD UNIQUE KEY `modid` (`modid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portal_mods`
--
ALTER TABLE `portal_mods`
  MODIFY `modid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
