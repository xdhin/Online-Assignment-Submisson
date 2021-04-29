-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2021 at 04:07 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineassignmentsubmission`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(8) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(40) NOT NULL,
  `admin_email` varchar(40) NOT NULL,
  `admin_phone_no` varchar(12) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_phone_no`) VALUES
(1, 'Chai Ying Chian', 'Chaiyingchian', 'yingchian@gmail.com', '0163235631'),
(2, 'Zhaoxuan Ng', 'zhaoxuanng8218', 'zhaoxuanng@gmail.com', '0163286233');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

DROP TABLE IF EXISTS `assignment`;
CREATE TABLE IF NOT EXISTS `assignment` (
  `asg_id` int(100) NOT NULL AUTO_INCREMENT,
  `asg_name` varchar(1000) NOT NULL,
  `asg_question` text NOT NULL,
  `asg_description` text NOT NULL,
  `asg_file` varchar(1000) DEFAULT NULL,
  `asg_file_size` varchar(100) DEFAULT NULL,
  `asg_file_type` varchar(100) DEFAULT NULL,
  `asg_start_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `asg_end_date_time` timestamp NOT NULL,
  `asg_total_marks` int(11) NOT NULL,
  `intake_module_id` int(100) NOT NULL,
  PRIMARY KEY (`asg_id`),
  KEY `test` (`intake_module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`asg_id`, `asg_name`, `asg_question`, `asg_description`, `asg_file`, `asg_file_size`, `asg_file_type`, `asg_start_date_time`, `asg_end_date_time`, `asg_total_marks`, `intake_module_id`) VALUES
(18, 'Haha Related System', 'aveve', 'advaz', 'ALQKESv1.docx', '282414', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2021-03-09 07:36:46', '2021-03-09 07:37:00', 50, 16),
(20, 'Education Related System', 'test', 'test', 'Proposal.docx', '42221', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2021-03-15 16:57:19', '2021-03-17 16:57:00', 100, 16);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `feedback_content` varchar(10000) NOT NULL,
  `feedback_mark` int(3) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `lec_id` int(11) NOT NULL,
  PRIMARY KEY (`feedback_id`),
  UNIQUE KEY `sub_id` (`sub_id`),
  KEY `lec_id` (`lec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback_date_time`, `feedback_content`, `feedback_mark`, `sub_id`, `lec_id`) VALUES
(8, '2021-03-15 17:21:46', 'idiot!', 25, 9, 1),
(13, '2021-03-15 17:55:05', 'are u sure u wanna submit this shit to me?', 50, 11, 1),
(14, '2021-03-15 18:55:14', 'dvsdv', 84, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `intake`
--

DROP TABLE IF EXISTS `intake`;
CREATE TABLE IF NOT EXISTS `intake` (
  `intake_id` varchar(20) NOT NULL,
  `intake_name` varchar(1000) NOT NULL,
  `intake_incharge` int(20) DEFAULT NULL,
  `intake_date` date DEFAULT NULL,
  PRIMARY KEY (`intake_id`),
  KEY `test` (`intake_incharge`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intake`
--

INSERT INTO `intake` (`intake_id`, `intake_name`, `intake_incharge`, `intake_date`) VALUES
('UCDF1905BIT', 'Diploma in Business with Information Technology', 1, '2019-05-14'),
('UCDF1905ICTDI', 'Diploma in Information & Communication Technology (with a specialism in Data Informatics)', 2, '2019-05-13'),
('UCDF1905ICTSE', 'Diploma in Information & Communication Technology (with a specialism in Software Engineering)', 1, '2019-05-13'),
('UCDF1909BIT', 'Diploma in Business with Information Technology', 3, '2019-09-16'),
('UCDF1909ICTSE', 'Diploma in Information & Communication Technology (with a specialism in Software Engineering)', 2, '2019-09-16'),
('UCDF2103BIT', 'Diploma in Business with Information Technology', 3, '2021-03-01'),
('UCDF2103ICTSE', 'Diploma in Information & Communication Technology (with a specialism in Software Engineering)', 2, '2021-03-08'),
('UCDF2108ICTSE', 'Diploma in Information & Communication Technology (with a specialism in Software Engineering)', 1, '2021-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `intake_module`
--

DROP TABLE IF EXISTS `intake_module`;
CREATE TABLE IF NOT EXISTS `intake_module` (
  `intake_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `intake_id` varchar(20) NOT NULL,
  `module_id` varchar(100) NOT NULL,
  `lec_id` int(10) NOT NULL,
  PRIMARY KEY (`intake_module_id`),
  KEY `lec_id` (`lec_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intake_module`
--

INSERT INTO `intake_module` (`intake_module_id`, `intake_id`, `module_id`, `lec_id`) VALUES
(2, 'UCDF1905BIT', 'AAPP006-4-2', 1),
(3, 'UCDF1905ICT', 'AAPP002-4-2', 2),
(4, 'UCDF1909ICTSE', 'AAPP006-4-2', 1),
(5, 'UCDF1909ICTSE', 'AAPP006-4-2', 1),
(12, 'UCDF2108ICTSE', 'AAPP004-4-2', 2),
(13, 'UCDF2108ICTSE', 'AICT006-4-2', 1),
(15, 'UCDF1905ICTSE', 'AICT006-4-2', 3),
(16, 'UCDF1905ICTSE', 'AAPP004-4-2', 1),
(21, 'UCDF1905BIT', 'AAPP002-4-2', 2),
(22, 'UCDF1905ICTSE', 'AAPP006-4-2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `lec_id` int(20) NOT NULL AUTO_INCREMENT,
  `lec_name` varchar(100) NOT NULL,
  `lec_password` varchar(80) NOT NULL,
  `lec_email` varchar(80) NOT NULL,
  `lec_dob` date NOT NULL,
  `lec_phone_no` varchar(12) NOT NULL,
  PRIMARY KEY (`lec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lec_id`, `lec_name`, `lec_password`, `lec_email`, `lec_dob`, `lec_phone_no`) VALUES
(1, 'Jolin Chua', 'jolinchua', 'jolin@gmail.com', '2000-07-13', '0163256327'),
(2, 'Chong Chee Hin', 'Chongcheehin', 'cheehin@gmail.com', '2000-10-15', '01685632220'),
(3, 'Ng Zhao Xuan', 'zhaoxuanng8218', 'zhaoxuanng@gmail.com', '2001-03-05', '0166391963');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_id` varchar(100) NOT NULL,
  `module_name` varchar(1000) NOT NULL,
  `module_leader` int(100) NOT NULL,
  PRIMARY KEY (`module_id`),
  KEY `lec_id` (`module_leader`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `module_leader`) VALUES
('AAPP002-4-2', 'Introduction to Artificial Intelligence', 1),
('AAPP004-4-2', 'Java Programming (JP)', 2),
('AAPP006-4-2', 'Software Development Project (SDP)', 3),
('AICT006-4-2', 'Digital Security and Forensic (DSF)', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `std_id` varchar(10) NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `std_password` varchar(40) NOT NULL,
  `std_email` varchar(40) NOT NULL,
  `std_dob` date NOT NULL,
  `std_phone_no` varchar(12) NOT NULL,
  `intake_id` varchar(20) NOT NULL,
  PRIMARY KEY (`std_id`),
  KEY `intake_id` (`intake_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_name`, `std_password`, `std_email`, `std_dob`, `std_phone_no`, `intake_id`) VALUES
('TP031112', 'Chong Hin Hin', 'chonghinhin', 'cheehin@gmail.com', '2001-06-09', '0145236856', 'UCDF1905ICTSE'),
('TP054325', 'Chai Ying Chian', 'chaiyingchian', 'yingchianchai@gmail.com', '2000-10-05', '0128563298', 'UCDF1905ICTSE'),
('TP056024', 'Sydney Lam', 'sydneylam', 'sydneylam@gmail.com', '2000-07-29', '0176523458', 'UCDF1905ICTSE'),
('TP056029', 'Jimmy Lam', 'jimmylam', 'jimmylam@gmail.com', '2000-07-29', '0176523458', 'UCDF1905BIT'),
('TP056031', 'Zhaoxuan Ng', 'zhaoxuanng0000', 'zhaoxuanng@gmail.com', '2001-03-05', '0166391963', 'UCDF1905ICTSE'),
('TP056032', 'Jacky Chia', 'jackychia', 'jackychia@gmail.com', '2001-06-17', '0132025362', 'UCDF1905ICTSE'),
('TP056059', 'Jolin Chua', 'jolinchua', 'jolin@gmail.com', '2001-03-16', '0165234785', 'UCDF1909ICTSE');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

DROP TABLE IF EXISTS `submission`;
CREATE TABLE IF NOT EXISTS `submission` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(1000) NOT NULL,
  `sub_file` varchar(10000) NOT NULL,
  `sub_file_size` varchar(100) NOT NULL,
  `sub_file_type` varchar(100) NOT NULL,
  `sub_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sub_status` varchar(100) DEFAULT NULL,
  `asg_id` int(100) NOT NULL,
  `std_id` varchar(10) NOT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `asg_id` (`asg_id`),
  KEY `submission_ibfk_1` (`std_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`sub_id`, `sub_name`, `sub_file`, `sub_file_size`, `sub_file_type`, `sub_date_time`, `sub_status`, `asg_id`, `std_id`) VALUES
(9, 'JP Assignment', 'ALQKESv1.docx', '282414', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2021-03-15 17:02:40', 'On Time', 20, 'TP056031'),
(10, 'JP Assignment', 'ALQKESv1.docx', '282414', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2021-03-15 17:22:24', 'Late Submission', 18, 'TP054325'),
(11, 'JP Assignment', 'Proposal.docx', '42221', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2021-03-15 17:23:10', 'On Time', 20, 'TP054325');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `test` FOREIGN KEY (`intake_module_id`) REFERENCES `intake_module` (`intake_module_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `submission` (`sub_id`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `lec_id` FOREIGN KEY (`module_leader`) REFERENCES `lecturer` (`lec_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `intake_id` FOREIGN KEY (`intake_id`) REFERENCES `intake` (`intake_id`);

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student` (`std_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
