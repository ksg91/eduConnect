-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2012 at 03:09 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `educonnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(9) NOT NULL,
  `name` text NOT NULL,
  `college` int(3) NOT NULL,
  `hod` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(9) NOT NULL,
  `sem` int(2) NOT NULL,
  `branch` int(3) NOT NULL,
  `college` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `id` int(9) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `principal` int(9) NOT NULL,
  `ph_no` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(9) NOT NULL,
  `talk_id` int(9) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `ups` int(4) NOT NULL DEFAULT '0',
  `downs` int(4) NOT NULL DEFAULT '0',
  `by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `param` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `param` (`param`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(9) NOT NULL,
  `user1` int(9) NOT NULL,
  `user2` int(9) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE IF NOT EXISTS `principal` (
  `id` int(9) NOT NULL,
  `u_id` int(9) NOT NULL,
  `college` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(9) NOT NULL,
  `u_id` int(9) NOT NULL,
  `enrol_no` int(9) NOT NULL,
  `branch` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `talks`
--

CREATE TABLE IF NOT EXISTS `talks` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `content` varchar(2000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `by` int(9) NOT NULL,
  `ups` int(4) NOT NULL DEFAULT '0',
  `downs` int(4) NOT NULL DEFAULT '0',
  `scope` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `talks`
--

INSERT INTO `talks` (`id`, `content`, `date`, `by`, `ups`, `downs`, `scope`) VALUES
(1, 'This is a demo Talk', '2012-02-23 04:58:27', 1, 0, 0, 1),
(2, 'Another Talk', '2012-02-12 14:57:15', 1, 2, 3, 0),
(3, 'Third Talk', '2012-02-12 14:57:15', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `perm` int(1) NOT NULL,
  `address` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `pass` varchar(100) NOT NULL,
  `ph_no` varchar(20) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `gender` binary(1) NOT NULL,
  `about_me` varchar(300) NOT NULL,
  `college_id` int(2) NOT NULL,
  `lastseen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `perm`, `address`, `dob`, `pass`, `ph_no`, `profile_pic`, `gender`, `about_me`, `college_id`, `lastseen`) VALUES
(1, 'Kishan Gor', 'ego@ksg91.com', 1, '', '0000-00-00', '098f6bcd4621d373cade4e832627b4f6', '', '', '', '', 0, '2012-02-04 09:27:26');
