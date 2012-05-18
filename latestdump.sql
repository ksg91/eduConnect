-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2012 at 07:01 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

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
(8, 'lolll', '2012-04-05 11:07:35', 1, 1),
(9, 'wow', '2012-04-18 12:46:23', 3, 4),
(10, 'what?', '2012-04-18 12:50:00', 1, 4),
(11, 'Hello\r\n', '2012-04-19 06:52:08', 1, 3),
(12, 'How Are you?', '2012-04-19 06:52:14', 1, 3),
(13, 'lol', '2012-04-19 06:52:51', 1, 3),
(14, 'This is a chat room!', '2012-04-19 06:53:01', 1, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `talk_id` int(9) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ups` int(4) NOT NULL DEFAULT '0',
  `downs` int(4) NOT NULL DEFAULT '0',
  `by` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `talk_id`, `content`, `date`, `ups`, `downs`, `by`) VALUES
(1, 17, 'Testing Passed', '2012-04-17 16:40:06', 0, 0, 1),
(2, 17, 'Test Comment', '2012-04-17 16:50:56', 0, 0, 1),
(3, 16, 'Yeah Man, It was Fun', '2012-04-17 16:52:01', 0, 0, 1),
(4, 16, 'Test', '2012-04-17 16:57:40', 0, 0, 1),
(5, 16, 'Test 2', '2012-04-17 16:58:17', 0, 0, 1),
(6, 16, 'Test 2', '2012-04-17 16:58:51', 0, 0, 1),
(7, 16, 'Test 2', '2012-04-17 16:59:22', 0, 0, 1),
(8, 16, 'sdkf;sldfj', '2012-04-17 17:00:18', 0, 0, 1),
(9, 16, 'sdkf;sldfj', '2012-04-17 17:00:59', 0, 0, 1),
(10, 16, 'sdkf;sldfj', '2012-04-17 17:01:16', 0, 0, 1),
(11, 16, 'esetstsd', '2012-04-17 17:01:34', 0, 0, 1),
(12, 18, 'Testing is Cool', '2012-04-17 17:02:10', 0, 0, 1),
(13, 15, 'Hehe, Congrats :)', '2012-04-17 17:15:50', 0, 0, 1),
(14, 20, 'test', '2012-04-19 07:04:26', 1, 0, 1),
(15, 19, 'kejflksdj;flsd', '2012-04-17 17:59:20', 0, 0, 1),
(16, 20, 'wow', '2012-04-19 07:05:04', 0, 1, 1);

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
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sec_id` int(5) NOT NULL,
  `perm_g` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `name`, `sec_id`, `perm_g`) VALUES
(1, 'Forum 1', 1, 0),
(2, 'Forum 2', 2, 0),
(3, 'Forum 3', 1, 0),
(4, 'Forum 4', 2, 0),
(5, 'Perm 2 Forum', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum_sec`
--

CREATE TABLE IF NOT EXISTS `forum_sec` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forum_sec`
--

INSERT INTO `forum_sec` (`id`, `name`) VALUES
(1, 'Section 1'),
(2, 'Section 2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `perm_group`
--

INSERT INTO `perm_group` (`id`, `name`, `type`, `created_by`) VALUES
(1, 'Test Group', 0, 1),
(2, 'Perm 2 ', 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `perm_member`
--

INSERT INTO `perm_member` (`id`, `perm_id`, `u_id`, `accepted`, `mem_since`) VALUES
(1, 1, 1, 1, '0000-00-00'),
(2, 1, 2, 1, '0000-00-00'),
(3, 2, 1, 1, '0000-00-00');

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
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `t_id` int(9) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `by` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `t_id`, `content`, `by`, `date`) VALUES
(1, 1, 'First Reply', 1, '2012-05-16 13:19:26'),
(2, 1, 'Another Reply', 1, '2012-05-16 18:42:17'),
(3, 1, 'Replues.s.se smnf, msnf ,sndfjsd \r\nsdkjbs b\r\nf sadf\r\nsdf\r\nsd\r\nfsd\r\nd\r\n', 1, '2012-05-16 18:42:30'),
(4, 4, 'This is reply', 1, '2012-05-16 18:49:35'),
(5, 1, 'Test reply', 2, '2012-05-16 18:56:45');

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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `by` int(9) NOT NULL,
  `ups` int(4) NOT NULL DEFAULT '0',
  `downs` int(4) NOT NULL DEFAULT '0',
  `comments` int(5) NOT NULL DEFAULT '0',
  `scope` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `talks`
--

INSERT INTO `talks` (`id`, `content`, `date`, `by`, `ups`, `downs`, `comments`, `scope`) VALUES
(1, 'This is a demo Talk', '2012-02-23 04:58:27', 1, 0, 0, 0, 1),
(2, 'Another Talk', '2012-02-12 14:57:15', 1, 0, 0, 0, 0),
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
(15, 'Result of Mid-sem is fabulous!', '2012-04-17 17:15:50', 2, 0, 0, 1, 0),
(16, 'Had lot of fun at Pratibha-12!', '2012-04-17 17:01:34', 3, 0, 0, 2, 0),
(17, 'Testing', '2012-04-14 08:23:41', 1, 0, 0, 0, 0),
(18, 'Test', '2012-04-17 17:02:10', 1, 0, 0, 1, 0),
(19, 'Test Talk in Test Group', '2012-04-17 17:10:09', 1, 0, 0, 1, 1),
(20, 'Test Group Talk', '2012-04-17 17:58:36', 1, 0, 1, 2, 1),
(21, 'Hello', '2012-04-19 02:33:22', 1, 1, 0, 0, 0),
(22, 'Test Talk', '2012-05-16 12:38:13', 1, 0, 0, 0, 0),
(23, 'Test', '2012-05-16 12:47:26', 1, 0, 0, 0, 0),
(24, 'Test 1', '2012-05-16 18:21:48', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `by` int(9) NOT NULL,
  `f_id` int(9) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `title`, `content`, `by`, `f_id`, `date`) VALUES
(1, 'Topic 1', 'This is first topic', 1, 1, '2012-05-13 20:38:36'),
(2, 'Test Topic', 'This is a test topic.', 1, 1, '2012-05-16 12:24:31'),
(3, 'Test Topic', 'Topic\r\n', 1, 1, '2012-05-16 12:25:13'),
(4, 'Topic 1', 'Topic Content', 1, 3, '2012-05-16 12:26:38'),
(5, 'This Is Topic Title', 'This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.This is topic Content.', 1, 2, '2012-05-16 18:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `updown`
--

CREATE TABLE IF NOT EXISTS `updown` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `u_id` int(9) NOT NULL,
  `c_id` int(9) NOT NULL,
  `talk` tinyint(1) NOT NULL DEFAULT '1',
  `up` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `updown`
--

INSERT INTO `updown` (`id`, `u_id`, `c_id`, `talk`, `up`) VALUES
(15, 1, 21, 1, 1),
(16, 1, 20, 1, 0),
(17, 1, 14, 0, 1),
(18, 1, 16, 0, 0);

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
(1, 'Kishan Gor', 'ego@ksg91.com', 1, '', '0000-00-00', 'b1634c02812896b87fff3d56f89e36af', '', 'proPic/default.png', '', 'I love code!', 2, '2012-04-17 17:46:52'),
(2, 'Sonali Patel', 'sonalipatel071@gmail.com', 1, 'Dharti', '1991-05-08', '371ab955fdc11c44c980779c3135b155', '', 'proPic/default_f.png', '\0', 'I am  cute!', 2, '2012-04-17 17:46:52'),
(3, 'Ajay Mandera', 'ajay_m65@yahoo.com', 1, 'Adityana', '1991-05-15', '29e457082db729fa1059d4294ede3909', '9723414186', 'proPic/default.png', '', 'I am cool guy', 2, '2012-04-17 17:46:52');
