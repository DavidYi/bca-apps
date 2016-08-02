-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2016 at 07:35 AM
-- Server version: 5.6.28
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atcsdevb_teacher_dashboard`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `insert_user_test`$$
$$

DROP PROCEDURE IF EXISTS `update_proctoring_proctor_count`$$
$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `elect_course`
--

DROP TABLE IF EXISTS `elect_course`;
CREATE TABLE IF NOT EXISTS `elect_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(30) NOT NULL,
  `course_desc` varchar(1000) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`,`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;


-- --------------------------------------------------------

--
-- Table structure for table `elect_student_course_xref`
--

DROP TABLE IF EXISTS `elect_student_course_xref`;
CREATE TABLE IF NOT EXISTS `elect_student_course_xref` (
  `usr_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `updt_usr_id` int(11) NOT NULL,
  `updt_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`usr_id`,`course_id`),
  KEY `fk_course_id_idx` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `elect_time`
--

DROP TABLE IF EXISTS `elect_time`;
CREATE TABLE IF NOT EXISTS `elect_time` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_short_desc` varchar(45) DEFAULT NULL,
  `day` varchar(15) NOT NULL,
  `mods` varchar(8) NOT NULL,
  `sort_order` int(3) NOT NULL,
  `day_order` int(3) DEFAULT NULL,
  `day_short` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `elect_time`
--

INSERT INTO `elect_time` (`time_id`, `time_short_desc`, `day`, `mods`, `sort_order`, `day_order`, `day_short`) VALUES
(1, 'M 1-3', 'Monday', '1-3', 1, 1, 'M'),
(2, 'M 4-6', 'Monday', '4-6', 2, 1, 'M'),
(3, 'M 7-9', 'Monday', '7-9', 3, 1, 'M'),
(4, 'M 10-12', 'Monday', '10-12', 4, 1, 'M'),
(5, 'M 13-15', 'Monday', '13-15', 5, 1, 'M'),
(6, 'M 16-18', 'Monday', '16-18', 6, 1, 'M'),
(7, 'M 19-21', 'Monday', '19-21', 7, 1, 'M'),
(8, 'M 22-24', 'Monday', '22-24', 8, 1, 'M'),
(10, 'T 1-3', 'Tuesday', '1-3', 10, 1, 'T'),
(11, 'T 4-6', 'Tuesday', '4-6', 11, 1, 'T'),
(12, 'T 10-12', 'Tuesday', '10-12', 13, 2, 'T'),
(13, 'T 13-15', 'Tuesday', '13-15', 14, 2, 'T'),
(14, 'T 16-18', 'Tuesday', '16-18', 15, 2, 'T'),
(15, 'T 19-21', 'Tuesday', '19-21', 16, 2, 'T'),
(16, 'T 22-24', 'Tuesday', '22-24', 17, 2, 'T'),
(17, 'W 1-3', 'Wednesday', '1-3', 18, 3, 'W'),
(18, 'W 4-6', 'Wednesday', '4-6', 19, 3, 'W'),
(19, 'W 7-9', 'Wednesday', '7-9', 20, 3, 'W'),
(20, 'W 10-12', 'Wednesday', '10-12', 21, 3, 'W'),
(21, 'W 13-15', 'Wednesday', '13-15', 22, 3, 'W'),
(22, 'W 16-18', 'Wednesday', '16-18', 23, 3, 'W'),
(23, 'W 19-21', 'Wednesday', '19-21', 24, 3, 'W'),
(24, 'W 22-24', 'Wednesday', '22-24', 25, 3, 'W'),
(25, 'R 1-3', 'Thursday', '1-3', 26, 4, 'R'),
(26, 'R 4-6', 'Thursday', '4-6', 27, 4, 'R'),
(27, 'R 7-9', 'Thursday', '7-9', 28, 4, 'R'),
(28, 'R 10-12', 'Thursday', '10-12', 29, 4, 'R'),
(29, 'R 13-15', 'Thursday', '13-15', 30, 4, 'R'),
(30, 'R 16-18', 'Thursday', '16-18', 31, 4, 'R'),
(31, 'R 19-21', 'Thursday', '19-21', 32, 4, 'R'),
(32, 'R 22-24', 'Thursday', '22-24', 33, 4, 'R'),
(33, 'F 1-3', 'Friday', '1-3', 34, 5, 'F'),
(34, 'F 4-6', 'Friday', '4-6', 35, 5, 'F'),
(35, 'F 7-9', 'Friday', '7-9', 36, 5, 'F'),
(36, 'F 10-12', 'Friday', '10-12', 37, 5, 'F'),
(37, 'F 13-15', 'Friday', '13-15', 38, 5, 'F'),
(38, 'F 16-18', 'Friday', '16-18', 39, 5, 'F'),
(39, 'F 19-21', 'Friday', '19-21', 40, 5, 'F'),
(40, 'F 22-24', 'Friday', '22-24', 41, 5, 'F'),
(41, 'T 7-9', 'Tuesday', '7-9', 12, 2, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `elect_user_free_xref`
--

DROP TABLE IF EXISTS `elect_user_free_xref`;
CREATE TABLE IF NOT EXISTS `elect_user_free_xref` (
  `usr_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `updt_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updt_usr_id` int(11) NOT NULL,
  PRIMARY KEY (`usr_id`,`time_id`),
  KEY `fk_time_id_idx` (`time_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `rm_id` int(11) NOT NULL AUTO_INCREMENT,
  `rm_nbr` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`rm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`rm_id`, `rm_nbr`) VALUES
(1, 'Gym N'),
(2, 'Gym S'),
(3, 'Auditorium'),
(4, 'College C');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_type_cde` varchar(3) CHARACTER SET utf8 NOT NULL,
  `rm_id` int(11) DEFAULT NULL,
  `test_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `test_dt` date NOT NULL,
  PRIMARY KEY (`test_id`),
  KEY `fk_test_type_cde_idx` (`test_type_cde`),
  KEY `fk_rm_id_idx` (`rm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `test_type_cde`, `rm_id`, `test_name`, `test_dt`) VALUES
(1, 'PAR', 1, 'Gymnasium (PARCC)', '2016-04-22'),
(2, 'AP', 4, 'College Center (AP Psychology)', '2016-05-02'),
(3, 'AP', 1, 'Gym (AP Chemistry)', '2016-05-02'),
(4, 'AP', 2, 'Gym (AP Psychology)', '2016-05-02'),
(5, 'IB', 1, 'Gym (IB Economics HL Paper 1)', '2016-05-02'),
(6, 'BIO', 1, 'Gym (NJ BIO Exam)', '2016-09-14'),
(37, 'PNC', 3, 'Auditorium (Pre-NOCTI)', '2016-10-13'),
(40, 'IB', 4, 'College Center (IB Economics)', '2017-05-22'),
(41, 'PST', 2, 'Gym (PSAT)', '2016-10-24'),
(42, 'PAR', 2, 'Gym (PARCC)', '2017-03-15'),
(45, 'AP', 2, 'Gym (AP Calc AB)', '2016-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `test_time`
--

DROP TABLE IF EXISTS `test_time`;
CREATE TABLE IF NOT EXISTS `test_time` (
  `test_time_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_time_desc` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`test_time_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `test_time`
--

INSERT INTO `test_time` (`test_time_id`, `test_time_desc`, `sort_order`) VALUES
(1, '1-3', 1),
(2, '4-6', 2),
(3, '7-9', 3),
(4, '10-12', 4),
(5, '13-15', 5),
(6, '16-18', 6),
(7, '19-21', 7),
(8, '22-24', 8),
(9, '25-27', 9);

-- --------------------------------------------------------

--
-- Table structure for table `test_time_xref`
--

DROP TABLE IF EXISTS `test_time_xref`;
CREATE TABLE IF NOT EXISTS `test_time_xref` (
  `test_id` int(11) NOT NULL,
  `test_time_id` int(11) NOT NULL,
  `proc_needed` int(11) NOT NULL,
  `proc_enrolled` int(11) NOT NULL,
  `reminder_sent_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`test_id`,`test_time_id`),
  UNIQUE KEY `test_id` (`test_id`,`test_time_id`),
  UNIQUE KEY `test_id_2` (`test_id`,`test_time_id`),
  KEY `fk_test_time_id_idx` (`test_time_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_time_xref`
--

INSERT INTO `test_time_xref` (`test_id`, `test_time_id`, `proc_needed`, `proc_enrolled`, `reminder_sent_dt`) VALUES
(1, 1, 18, 0, NULL),
(1, 2, 5, 0, NULL),
(1, 3, 8, 0, NULL),
(4, 5, 5, 0, NULL),
(4, 6, 5, 0, NULL),
(4, 7, 5, 0, NULL),
(6, 1, 10, 3, NULL),
(6, 2, 2, 2, NULL),
(40, 1, 5, 2, NULL),
(40, 3, 6, 1, NULL),
(40, 5, 9, 0, NULL),
(41, 1, 4, 2, NULL),
(41, 2, 3, 0, NULL),
(41, 3, 4, 4, NULL),
(41, 4, 5, 2, NULL),
(42, 1, 9, 3, NULL),
(42, 2, 2, 1, NULL),
(42, 3, 3, 2, NULL),
(42, 4, 7, 1, NULL),
(45, 1, 5, 2, '2016-07-28 00:00:00'),
(45, 5, 8, 2, '2016-07-28 00:00:00'),
(45, 6, 6, 1, '2016-07-28 00:00:00'),
(45, 7, 4, 1, '2016-07-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `test_type`
--

DROP TABLE IF EXISTS `test_type`;
CREATE TABLE IF NOT EXISTS `test_type` (
  `test_type_cde` varchar(3) CHARACTER SET utf8 NOT NULL,
  `test_type_desc` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`test_type_cde`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_type`
--

INSERT INTO `test_type` (`test_type_cde`, `test_type_desc`) VALUES
('AP', 'AP'),
('BIO', 'NJBCT Exam'),
('IB', 'IB'),
('NOC', 'NOCTI'),
('PAR', 'PARCC'),
('PNC', 'Pre NOCTI'),
('PST', 'PSAT');

-- --------------------------------------------------------

--
-- Table structure for table `test_updt_xref`
--

DROP TABLE IF EXISTS `test_updt_xref`;
CREATE TABLE IF NOT EXISTS `test_updt_xref` (
  `test_id` int(11) NOT NULL,
  `test_time_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `updt_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updt_usr_id` int(11) NOT NULL,
  KEY `FK_TEST_TIME_XREF_idx` (`test_id`,`test_time_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_updt_xref`
--

INSERT INTO `test_updt_xref` (`test_id`, `test_time_id`, `usr_id`, `updt_dt`, `updt_usr_id`) VALUES
(41, 4, 1081, '2016-07-27 14:09:26', 1081),
(42, 1, 1081, '2016-07-27 14:04:57', 1081),
(42, 4, 1081, '2016-07-27 14:04:57', 1081),
(40, 3, 1081, '2016-07-27 14:05:20', 1081),
(6, 1, 1081, '2016-07-27 13:53:50', 1081),
(41, 3, 1096, '2016-07-27 14:09:26', 1096),
(42, 1, 1096, '2016-07-27 14:04:57', 1096),
(42, 3, 1096, '2016-07-27 14:04:57', 1096),
(41, 4, 1157, '2016-07-27 14:09:26', 1157),
(40, 1, 1157, '2016-07-27 14:05:20', 1157),
(42, 3, 1157, '2016-07-27 14:04:57', 1157),
(41, 1, 1157, '2016-07-27 14:09:26', 1157),
(6, 1, 1133, '2016-07-27 13:53:50', 1133),
(41, 1, 1133, '2016-07-27 14:09:26', 1133),
(45, 5, 1133, '2016-07-27 13:53:50', 1133),
(41, 3, 1133, '2016-07-27 14:09:26', 1133),
(45, 6, 1, '2016-07-27 13:53:50', 1),
(41, 3, 1, '2016-07-27 14:09:26', 1),
(40, 1, 1, '2016-07-27 14:05:20', 1191),
(42, 2, 1, '2016-07-27 14:04:57', 3),
(45, 1, 1067, '2016-07-27 13:53:50', 1191),
(45, 1, 1078, '2016-07-27 13:53:50', 1078),
(6, 1, 1078, '2016-07-27 13:53:50', 3),
(6, 2, 1071, '2016-07-27 13:53:50', 3),
(45, 5, 1071, '2016-07-27 13:53:50', 3),
(6, 2, 1067, '2016-07-27 13:53:50', 3),
(42, 1, 1067, '2016-07-27 14:04:57', 3),
(41, 3, 1067, '2016-07-27 14:09:26', 3),
(45, 7, 1118, '2016-07-27 16:08:09', 1118);

--
-- Triggers `test_updt_xref`
--
DROP TRIGGER IF EXISTS `test_updt_xref_AFTER_DELETE`;
DELIMITER //
CREATE TRIGGER `test_updt_xref_AFTER_DELETE` AFTER DELETE ON `test_updt_xref`
 FOR EACH ROW BEGIN
 call update_proctoring_proctor_count (old.test_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `test_updt_xref_AFTER_INSERT`;
DELIMITER //
CREATE TRIGGER `test_updt_xref_AFTER_INSERT` AFTER INSERT ON `test_updt_xref`
 FOR EACH ROW BEGIN
 call update_proctoring_proctor_count (new.test_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `test_updt_xref_AFTER_UPDATE`;
DELIMITER //
CREATE TRIGGER `test_updt_xref_AFTER_UPDATE` AFTER UPDATE ON `test_updt_xref`
 FOR EACH ROW BEGIN
 call update_proctoring_proctor_count (new.test_id);
END
//
DELIMITER ;

-- --------------------------------------------------------


--
-- Constraints for dumped tables
--

--
-- Constraints for table `elect_student_course_xref`
--
ALTER TABLE `elect_student_course_xref`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `elect_course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `elect_user_free_xref`
--
ALTER TABLE `elect_user_free_xref`
  ADD CONSTRAINT `fk_time_id` FOREIGN KEY (`time_id`) REFERENCES `elect_time` (`time_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `fk_rm_id` FOREIGN KEY (`rm_id`) REFERENCES `room` (`rm_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_test_type_cde` FOREIGN KEY (`test_type_cde`) REFERENCES `test_type` (`test_type_cde`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test_time_xref`
--
ALTER TABLE `test_time_xref`
  ADD CONSTRAINT `fk_test_id` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_test_time_id` FOREIGN KEY (`test_time_id`) REFERENCES `test_time` (`test_time_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test_updt_xref`
--
ALTER TABLE `test_updt_xref`
  ADD CONSTRAINT `FK_TEST_TIME_XREF` FOREIGN KEY (`test_id`, `test_time_id`) REFERENCES `test_time_xref` (`test_id`, `test_time_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
