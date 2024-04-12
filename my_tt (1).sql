-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 04:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my tt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `A_name` varchar(20) NOT NULL,
  `A_password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`A_name`, `A_password`) VALUES
('Rohit Barve', 'Rohit@123');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `C_name` varchar(20) NOT NULL,
  `C_password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_name`) VALUES
('BIOM'),
('CMPN'),
('EXCS'),
('EXTC'),
('INFT');

-- --------------------------------------------------------

--
-- Table structure for table `dept_contains`
--

CREATE TABLE `dept_contains` (
  `D_name` varchar(10) NOT NULL,
  `Subject_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept_contains`
--

INSERT INTO `dept_contains` (`D_name`, `Subject_name`) VALUES
('CMPN', 'Automata Theory'),
('CMPN', 'Database Management'),
('CMPN', 'Engineering Maths 4'),
('CMPN', 'Operating Systems'),
('CMPN', 'Principles of Econom'),
('INFT', 'Automata Theory'),
('INFT', 'Computer Networks'),
('INFT', 'Database Management'),
('INFT', 'Engineering Maths 4'),
('INFT', 'Operating Systems'),
('INFT', 'Principles of Econom'),
('INFT', 'SEWDL');

-- --------------------------------------------------------

--
-- Table structure for table `final_slots`
--

CREATE TABLE `final_slots` (
  `t_name` varchar(50) NOT NULL,
  `S_id` varchar(5) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `venue` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `final_slots`
--

INSERT INTO `final_slots` (`t_name`, `S_id`, `sub_name`, `venue`) VALUES
('Sampat Mali', 'S04', 'Engineering Maths 4', 'E101'),
('Sampat Mali', 'S05', 'Engineering Maths 4', 'E101'),
('Sampat Mali', 'S26', 'Engineering Maths 4', 'E101'),
('Uday Kashid', 'S34', 'Engineering Maths 4', 'E204'),
('Uday Kashid', 'S35', 'Engineering Maths 4', 'E204'),
('Uday Kashid', 'S44', 'Engineering Maths 4', 'E204');

-- --------------------------------------------------------

--
-- Table structure for table `is_alloted_to`
--

CREATE TABLE `is_alloted_to` (
  `t_name` varchar(20) DEFAULT NULL,
  `S_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `is_alloted_to`
--

INSERT INTO `is_alloted_to` (`t_name`, `S_id`) VALUES
('Rasika Ransing', 'S16'),
('Rasika Ransing', 'S17'),
('Uday Kashid', 'S22'),
('Uday Kashid', 'S23'),
('Uday Kashid', 'S46'),
('Sampat Mali', 'S04'),
('Sampat Mali', 'S05'),
('Sampat Mali', 'S26');

-- --------------------------------------------------------

--
-- Table structure for table `is_from`
--

CREATE TABLE `is_from` (
  `D_name` varchar(10) NOT NULL,
  `t_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `is_from`
--

INSERT INTO `is_from` (`D_name`, `t_name`) VALUES
('INFT', 'Rasika Ransing'),
('INFT', 'Rohit Barve');

-- --------------------------------------------------------

--
-- Table structure for table `selects`
--

CREATE TABLE `selects` (
  `Roll_no` varchar(10) NOT NULL,
  `Subject_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `S_id` varchar(5) NOT NULL,
  `s_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`S_id`, `s_time`) VALUES
('S04', '11:15 - 12:15'),
('S05', '12:15 - 1:15'),
('S16', '1:45-2:45'),
('S17', '2:45-3:45'),
('S22', '9:00 - 10:00'),
('S23', '10:00 - 11:00'),
('S26', '1:45 - 2:45'),
('S34', '11:15 - 12:15'),
('S35', '12:15 - 1:15'),
('S44', '11:15 - 12:15'),
('S46', '1:45 - 2:45');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Roll_no` varchar(10) NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL,
  `s_password` varchar(20) DEFAULT NULL,
  `dept_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Roll_no`, `f_name`, `l_name`, `s_password`, `dept_name`) VALUES
('22101B0008', 'Chinmay', 'Tikole', 'Chinmay@345', 'INFT'),
('22101B0030', 'Aniket', 'panchal', 'Aniket@123', 'INFT'),
('22104B0060', 'Aditya', 'Vemuri', 'Aditya@123', 'INFT');

-- --------------------------------------------------------

--
-- Table structure for table `student_selects_slots`
--

CREATE TABLE `student_selects_slots` (
  `Roll_no` varchar(10) DEFAULT NULL,
  `S_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_selects_slots`
--

INSERT INTO `student_selects_slots` (`Roll_no`, `S_id`) VALUES
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', 'S44'),
('22101B0030', NULL),
('22101B0030', 'S44'),
('22101B0030', 'S44');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_name` varchar(20) NOT NULL,
  `subject_type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_name`, `subject_type`) VALUES
('Automata Theory', 'ALC'),
('Computer Networks', 'MAND'),
('Database Management', 'MAND'),
('Engineering Maths 4', 'MAND'),
('Operating Systems', 'MAND'),
('Principles of Econom', 'MAND'),
('SEWDL', 'ALC');

-- --------------------------------------------------------

--
-- Table structure for table `sub_has_slots`
--

CREATE TABLE `sub_has_slots` (
  `S_id` varchar(5) NOT NULL,
  `subject_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_has_slots`
--

INSERT INTO `sub_has_slots` (`S_id`, `subject_name`) VALUES
('S22', 'Engineering Maths 4'),
('S23', 'Engineering Maths 4'),
('S26', 'Engineering Maths 4'),
('S16', 'Operating Systems'),
('S17', 'Operating Systems');

-- --------------------------------------------------------

--
-- Table structure for table `taught_by`
--

CREATE TABLE `taught_by` (
  `t_name` varchar(20) NOT NULL,
  `Subject_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taught_by`
--

INSERT INTO `taught_by` (`t_name`, `Subject_name`) VALUES
('Rasika Ransing', 'Operating Systems'),
('Rohit Barve', 'Database Management'),
('Sampat Mali', 'Engineering Maths 4'),
('Uday Kashid', 'Engineering Maths 4');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_name` varchar(20) NOT NULL,
  `A_name` varchar(20) DEFAULT NULL,
  `C_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_name`, `A_name`, `C_name`) VALUES
('Rasika Ransing', NULL, NULL),
('Rohit Barve', 'Rohit Barve', NULL),
('Sampat Mali', NULL, NULL),
('Uday Kashid', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`A_name`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`C_name`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_name`);

--
-- Indexes for table `dept_contains`
--
ALTER TABLE `dept_contains`
  ADD PRIMARY KEY (`D_name`,`Subject_name`),
  ADD KEY `Subject_name` (`Subject_name`);

--
-- Indexes for table `final_slots`
--
ALTER TABLE `final_slots`
  ADD PRIMARY KEY (`t_name`,`S_id`,`sub_name`),
  ADD KEY `S_id` (`S_id`),
  ADD KEY `sub_name` (`sub_name`);

--
-- Indexes for table `is_alloted_to`
--
ALTER TABLE `is_alloted_to`
  ADD KEY `t_name` (`t_name`),
  ADD KEY `S_id` (`S_id`);

--
-- Indexes for table `is_from`
--
ALTER TABLE `is_from`
  ADD PRIMARY KEY (`D_name`,`t_name`),
  ADD KEY `t_name` (`t_name`);

--
-- Indexes for table `selects`
--
ALTER TABLE `selects`
  ADD PRIMARY KEY (`Roll_no`,`Subject_name`),
  ADD KEY `Subject_name` (`Subject_name`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`S_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Roll_no`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `student_selects_slots`
--
ALTER TABLE `student_selects_slots`
  ADD KEY `Roll_no` (`Roll_no`),
  ADD KEY `S_id` (`S_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_name`);

--
-- Indexes for table `sub_has_slots`
--
ALTER TABLE `sub_has_slots`
  ADD PRIMARY KEY (`S_id`) USING BTREE,
  ADD KEY `subject_name` (`subject_name`);

--
-- Indexes for table `taught_by`
--
ALTER TABLE `taught_by`
  ADD PRIMARY KEY (`t_name`,`Subject_name`),
  ADD KEY `Subject_name` (`Subject_name`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_name`),
  ADD KEY `A_name` (`A_name`),
  ADD KEY `C_name` (`C_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dept_contains`
--
ALTER TABLE `dept_contains`
  ADD CONSTRAINT `dept_contains_ibfk_1` FOREIGN KEY (`D_name`) REFERENCES `department` (`dept_name`),
  ADD CONSTRAINT `dept_contains_ibfk_2` FOREIGN KEY (`Subject_name`) REFERENCES `subject` (`subject_name`);

--
-- Constraints for table `final_slots`
--
ALTER TABLE `final_slots`
  ADD CONSTRAINT `final_slots_ibfk_1` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `final_slots_ibfk_2` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`),
  ADD CONSTRAINT `final_slots_ibfk_3` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `final_slots_ibfk_4` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`),
  ADD CONSTRAINT `final_slots_ibfk_5` FOREIGN KEY (`sub_name`) REFERENCES `subject` (`subject_name`);

--
-- Constraints for table `is_alloted_to`
--
ALTER TABLE `is_alloted_to`
  ADD CONSTRAINT `is_alloted_to_ibfk_1` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `is_alloted_to_ibfk_2` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`);

--
-- Constraints for table `is_from`
--
ALTER TABLE `is_from`
  ADD CONSTRAINT `is_from_ibfk_1` FOREIGN KEY (`D_name`) REFERENCES `department` (`dept_name`),
  ADD CONSTRAINT `is_from_ibfk_2` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`);

--
-- Constraints for table `selects`
--
ALTER TABLE `selects`
  ADD CONSTRAINT `selects_ibfk_1` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`),
  ADD CONSTRAINT `selects_ibfk_2` FOREIGN KEY (`Subject_name`) REFERENCES `subject` (`subject_name`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`);

--
-- Constraints for table `student_selects_slots`
--
ALTER TABLE `student_selects_slots`
  ADD CONSTRAINT `student_selects_slots_ibfk_1` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`),
  ADD CONSTRAINT `student_selects_slots_ibfk_2` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`);

--
-- Constraints for table `sub_has_slots`
--
ALTER TABLE `sub_has_slots`
  ADD CONSTRAINT `sub_has_slots_ibfk_1` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`),
  ADD CONSTRAINT `sub_has_slots_ibfk_2` FOREIGN KEY (`subject_name`) REFERENCES `subject` (`subject_name`);

--
-- Constraints for table `taught_by`
--
ALTER TABLE `taught_by`
  ADD CONSTRAINT `taught_by_ibfk_1` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `taught_by_ibfk_2` FOREIGN KEY (`Subject_name`) REFERENCES `subject` (`subject_name`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`A_name`) REFERENCES `admin` (`A_name`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`C_name`) REFERENCES `coordinator` (`C_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
