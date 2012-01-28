-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2012 at 06:49 AM
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
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `sess_id` varchar(100) NOT NULL,
  `u_id` int(9) NOT NULL,
  `lastaction` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sess_id` (`sess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `id` int(9) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `ups` int(4) NOT NULL DEFAULT '0',
  `downs` int(4) NOT NULL DEFAULT '0',
  `post` varchar(2000) NOT NULL,
  `scope` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
