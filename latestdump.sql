-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2012 at 09:31 AM
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
-- Table structure for table `chatposts`
--

CREATE TABLE IF NOT EXISTS `chatposts` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `by` int(9) NOT NULL,
  `room_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `chatposts`
--

INSERT INTO `chatposts` (`id`, `content`, `time`, `by`, `room_id`) VALUES
(1, 'ddfsfsd', '2012-04-05 10:29:51', 1, 1),
(2, 'lol', '2012-04-05 10:31:48', 1, 1),
(3, 'really?', '2012-04-05 10:32:01', 1, 1),
(4, 'no', '2012-04-05 10:32:04', 1, 1),
(5, 'whu?', '2012-04-05 10:32:08', 1, 1),
(6, 'duh', '2012-04-04 10:32:12', 1, 1),
(7, 'kfjg hdfkjh dfkghdfk dklh gkjd hgksdhdgkf', '2012-04-05 10:32:16', 1, 1),
(8, 'lolll', '2012-04-05 11:07:35', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE IF NOT EXISTS `chatrooms` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `perm` int(9) NOT NULL,
  `users` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `name`, `perm`, `users`) VALUES
(1, 'Chatroom 1', 0, 0),
(2, 'Chatroom 2', 0, 0),
(3, 'Chat 3', 1, 1),
(4, 'Chat 4', 2, 0);

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
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `principal` int(9) NOT NULL,
  `ph_no` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `name`, `address`, `principal`, `ph_no`) VALUES
(2, 'LCIT', 'Bhandu', 1, '8128764460');

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
-- Table structure for table `perm_group`
--

CREATE TABLE IF NOT EXISTS `perm_group` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `created_by` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `perm_group`
--

INSERT INTO `perm_group` (`id`, `name`, `type`, `created_by`) VALUES
(1, 'Test Group', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `perm_member`
--

CREATE TABLE IF NOT EXISTS `perm_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_id` int(5) NOT NULL,
  `u_id` int(9) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `mem_since` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `perm_member`
--

INSERT INTO `perm_member` (`id`, `perm_id`, `u_id`, `accepted`, `mem_since`) VALUES
(1, 1, 1, 1, '0000-00-00'),
(2, 1, 2, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pms`
--

CREATE TABLE IF NOT EXISTS `pms` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `content` varchar(2000) NOT NULL,
  `by` int(9) NOT NULL,
  `to` int(9) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pms`
--

INSERT INTO `pms` (`id`, `content`, `by`, `to`, `date`, `read`) VALUES
(1, 'Hey, can you send me assignment?', 2, 1, '2012-03-10 06:39:52', 1),
(2, 'what is your result?', 3, 1, '2012-03-10 06:39:52', 1),
(3, 'Test PM to self', 1, 1, '2012-03-10 06:39:52', 1),
(4, 'Test PM 2', 1, 1, '2012-03-10 06:39:51', 1),
(5, 'Reply to a PM', 1, 1, '2012-03-10 06:39:51', 1);

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
  `comments` int(5) NOT NULL DEFAULT '0',
  `scope` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `talks`
--

INSERT INTO `talks` (`id`, `content`, `date`, `by`, `ups`, `downs`, `comments`, `scope`) VALUES
(1, 'This is a demo Talk', '2012-02-23 04:58:27', 1, 0, 0, 0, 1),
(2, 'Another Talk', '2012-02-12 14:57:15', 1, 2, 3, 0, 0),
(3, 'Third Talk', '2012-02-12 14:57:15', 1, 0, 0, 0, 0),
(4, 'This kflksj lkasdlkjf hsdkfkjsadfkh askljdflksda', '2012-03-01 09:27:04', 1, 0, 0, 0, 0),
(5, 'kjerwjerfkhsdkljfhasdlkfhlksjdfklsdhf kljshafljksdahflksdhflkjashflkjaslkjsdlkjsdkljsdflkjsflkjflkjsdljpouigf ougj', '2012-03-01 09:27:57', 1, 0, 0, 0, 0),
(6, 'hie', '2012-03-01 09:30:02', 1, 0, 0, 0, 0),
(7, 'gfdkgfgmffhglhghgfh\r\n', '2012-03-01 09:35:28', 2, 0, 0, 0, 0),
(8, 'hdsfklashdkfj hasdkjfhaslkjdshfljk hsdfksdklhfkljshdfkljshadkl asdljkf ', '2012-03-01 09:37:43', 2, 0, 0, 0, 0),
(9, 'kishan is mad', '2012-03-01 09:48:04', 1, 0, 0, 0, 0),
(10, 'ajay is too mad', '2012-03-01 09:48:26', 1, 0, 0, 0, 0),
(11, 'Hie, how are you?', '2012-03-01 16:11:40', 1, 0, 0, 0, 0),
(12, 'Hey, I am Ajay!', '2012-03-04 16:29:22', 3, 0, 0, 0, 0),
(13, 'We are having presentation tomorrow! ', '2012-03-04 16:31:45', 2, 0, 0, 0, 0),
(14, 'Not ready for presentation yet!', '2012-03-04 16:32:09', 1, 0, 0, 0, 0),
(15, 'Result of Mid-sem is fabulous!', '2012-03-04 16:33:11', 2, 0, 0, 0, 0),
(16, 'Had lot of fun at Pratibha-12!', '2012-03-04 16:33:25', 3, 0, 0, 0, 0),
(17, 'Testing', '2012-04-14 08:23:41', 1, 0, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `perm`, `address`, `dob`, `pass`, `ph_no`, `profile_pic`, `gender`, `about_me`, `college_id`, `lastseen`) VALUES
(1, 'Kishan Gor', 'ego@ksg91.com', 1, '', '0000-00-00', 'b1634c02812896b87fff3d56f89e36af', '', 'proPic/default.png', '', '', 0, '2012-03-01 08:56:09'),
(2, 'Sonali Patel', 'sonalipatel071@gmail.com', 1, 'Dharti', '1991-05-08', '371ab955fdc11c44c980779c3135b155', '', 'proPic/default_f.png', '\0', 'I am  cute!', 0, '2012-03-04 16:18:39'),
(3, 'Ajay Mandera', 'ajay_m65@yahoo.com', 1, 'Adityana', '1991-05-15', '29e457082db729fa1059d4294ede3909', '9723414186', 'proPic/default.png', '', 'I am cool guy', 0, '2012-03-04 16:28:37');
