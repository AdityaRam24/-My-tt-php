-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 03:16 PM
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
  `A_password` varchar(20) DEFAULT NULL,
  `dept` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`A_name`, `A_password`, `dept`) VALUES
('Rohit Barve', 'Rohit@123', 'INFT');

-- --------------------------------------------------------

--
-- Table structure for table `codinator_adds`
--

CREATE TABLE `codinator_adds` (
  `slot_id` varchar(20) NOT NULL,
  `t_name` varchar(20) NOT NULL,
  `venue` varchar(20) NOT NULL,
  `subject_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codinator_adds`
--

INSERT INTO `codinator_adds` (`slot_id`, `t_name`, `venue`, `subject_name`) VALUES
('S23', 'Rohit Barve', 'E101', 'Automata Theory'),
('S34', 'Rohit Barve', 'L05', 'Database Management Systems Lab'),
('S35', 'Rohit Barve', 'L05', 'Database Management Systems Lab'),
('S39', 'Sameer Khatu', 'M206', 'Principles of Economy & Management'),
('S46', 'Kanchan Dhuri', 'L07', 'Computer Networks Lab'),
('S46', 'Sampat Mali', 'E101', 'Engineering Maths 4');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `C_name` varchar(20) NOT NULL,
  `C_password` varchar(20) DEFAULT NULL,
  `dept` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`C_name`, `C_password`, `dept`) VALUES
('Rasika Ransing', 'Rasika@123', 'INFT');

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
  `Subject_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept_contains`
--

INSERT INTO `dept_contains` (`D_name`, `Subject_name`) VALUES
('CMPN', 'Automata Theory'),
('CMPN', 'Database Management'),
('CMPN', 'Engineering Maths 4'),
('CMPN', 'Operating Systems'),
('INFT', 'Automata Theory'),
('INFT', 'Computer Networks'),
('INFT', 'Computer Networks Lab'),
('INFT', 'Database Management'),
('INFT', 'Database Management Systems Lab'),
('INFT', 'Engineering Maths 4'),
('INFT', 'Operating Systems'),
('INFT', 'Operating Systems Lab'),
('INFT', 'Principles of Economy & Management'),
('INFT', 'Python Lab'),
('INFT', 'Software Engineering & Web Developement');

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
('Rasika Ransing', 'S16', 'Operating Systems', 'E101'),
('Rasika Ransing', 'S17', 'Operating Systems', 'E101'),
('Rohit Barve', 'S23', 'Automata Theory', 'E101'),
('Rohit Barve', 'S34', 'Database Management Systems Lab', 'L05'),
('Rohit Barve', 'S35', 'Database Management Systems Lab', 'L05'),
('Sameer Khatu', 'S39', 'Principles of Economy & Management', 'M206'),
('Sampat Mali', 'S04', 'Engineering Maths 4', 'E101'),
('Sampat Mali', 'S05', 'Engineering Maths 4', 'E101'),
('Sampat Mali', 'S26', 'Engineering Maths 4', 'E101'),
('Snehal Angane', 'S23', 'Computer Networks Lab', 'E101'),
('Uday Kashid', 'S22', 'Engineering Maths 4', 'M206'),
('Uday Kashid', 'S23', 'Engineering Maths 4', 'M206'),
('Uday Kashid', 'S34', 'Engineering Maths 4', 'E204'),
('Uday Kashid', 'S35', 'Engineering Maths 4', 'E204'),
('Uday Kashid', 'S44', 'Engineering Maths 4', 'E204'),
('Uday Kashid', 'S46', 'Engineering Maths 4', 'M206');

-- --------------------------------------------------------

--
-- Table structure for table `is_alloted_to`
--

CREATE TABLE `is_alloted_to` (
  `t_name` varchar(20) NOT NULL,
  `S_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `is_alloted_to`
--

INSERT INTO `is_alloted_to` (`t_name`, `S_id`) VALUES
('Sampat Mali', 'S04'),
('Sampat Mali', 'S05'),
('Shruti Agrawal', 'S10'),
('Shruti Agrawal', 'S11'),
('Shruti Agrawal', 'S12'),
('Rasika Ransing', 'S16'),
('Rasika Ransing', 'S17'),
('Rohit Barve', 'S22 '),
('Shruti Agrawal', 'S22'),
('Snehal Angane', 'S22'),
('Uday Kashid', 'S22'),
('Rohit Barve', 'S23'),
('Snehal Angane', 'S23'),
('Uday Kashid', 'S23'),
('Sampat Mali', 'S26'),
('Rasika Ransing', 'S31'),
('Rohit Barve', 'S34'),
('Rohit Barve', 'S35'),
('Sameer Khatu', 'S39'),
('Kanchan Dhuri', 'S46'),
('Sampat Mali', 'S46'),
('Snehal Angane', 'S46'),
('Uday Kashid', 'S46');

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
('INFT', 'Kanchan Dhuri'),
('INFT', 'Rasika Ransing'),
('INFT', 'Rohit Barve'),
('INFT', 'Sameer Khatu'),
('INFT', 'Sampat Mali'),
('INFT', 'Shruti Agrawal'),
('INFT', 'Snehal Angane');

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
('S01', '8:00 - 9:00'),
('S02', '9:00 - 10:00'),
('S03', '10:00 - 11:00'),
('S04', '11:15 - 12:15'),
('S05', '12:15 - 1:15'),
('S06', '1:45 - 2:45'),
('S07', '2:45 - 3:45'),
('S08', '3:45 - 4:45'),
('S09', '4:45 - 5:45'),
('S10', '5:45 - 6:45'),
('S11', '8:00 - 9:00'),
('S12', '9:00 - 10:00'),
('S13', '10:00 - 11:00'),
('S14', '11:15 - 12:15'),
('S15', '12:15 - 1:15'),
('S16', '1:45-2:45'),
('S17', '2:45-3:45'),
('S18', '3:45 - 4:45'),
('S19', '4:45 - 5:45'),
('S20', '5:45 - 6:45'),
('S21', '8:00 - 9:00'),
('S22', '9:00 - 10:00'),
('S23', '10:00 - 11:00'),
('S24', '11:15 - 12:15'),
('S25', '12:15 - 1:15'),
('S26', '1:45 - 2:45'),
('S27', '2:45 - 3:45'),
('S28', '3:45 - 4:45'),
('S29', '4:45 - 5:45'),
('S30', '5:45 - 6:45'),
('S31', '8:00 - 9:00'),
('S32', '9:00 - 10:00'),
('S33', '10:00 - 11:00'),
('S34', '11:15 - 12:15'),
('S35', '12:15 - 1:15'),
('S36', '1:45 - 2:45'),
('S37', '2:45 - 3:45'),
('S38', '3:45 - 4:45'),
('S39', '4:45 - 5:45'),
('S40', '5:45 - 6:45'),
('S41', '8:00 - 9:00'),
('S42', '9:00 - 10:00'),
('S43', '10:00 - 11:00'),
('S44', '11:15 - 12:15'),
('S45', '12:15 - 1:15'),
('S46', '1:45 - 2:45'),
('S47', '2:45 - 3:45'),
('S48', '3:45 - 4:45'),
('S49', '4:45 - 5:45'),
('S50', '5:45 - 6:45');

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
('22101B0016', 'Sanika', 'Jade', 'Sanika@123', 'INFT'),
('22101B0030', 'Aniket', 'Panchal', 'Aniket@123', 'INFT'),
('22104B0060', 'Aditya', 'Vemuri', 'Aditya@123', 'INFT');

-- --------------------------------------------------------

--
-- Table structure for table `student_selects_slots`
--

CREATE TABLE `student_selects_slots` (
  `Roll_no` varchar(11) NOT NULL,
  `S_id` varchar(50) NOT NULL,
  `subject_name` varchar(30) NOT NULL,
  `t_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_selects_slots`
--

INSERT INTO `student_selects_slots` (`Roll_no`, `S_id`, `subject_name`, `t_name`) VALUES
('22101B0008', 'S16S17', 'Operating Systems', 'Rasika Ransing'),
('22101B0030', 'S16S17', 'Operating Systems', 'Rasika Ransing'),
('22101B0030', 'S22S23S46', 'Engineering Maths 4', 'Uday Kashid'),
('22101B0030', 'S46', 'Python Lab', 'Shruti Agrawal'),
('22104B0060', 'S04S05S26', 'Engineering Maths 4', 'Sampat Mali');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_name` varchar(50) NOT NULL,
  `subject_type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_name`, `subject_type`) VALUES
('Automata Theory', 'ALC'),
('Computer Networks', 'MAND'),
('Computer Networks Lab', 'MAND'),
('Database Management', 'MAND'),
('Database Management Systems Lab', 'MAND'),
('Engineering Maths 4', 'MAND'),
('Operating Systems', 'MAND'),
('Operating Systems Lab', 'MAND'),
('Principles of Economy', 'MAND'),
('Principles of Economy & Management', 'MAND'),
('Python', 'MAND'),
('Python Lab', 'MAND'),
('Software Engineering & Web Developement', 'ALC');

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
('S34', 'Database Management Systems Lab'),
('S35', 'Database Management Systems Lab'),
('S22', 'Engineering Maths 4'),
('S23', 'Engineering Maths 4'),
('S26', 'Engineering Maths 4'),
('S04', 'Operating Systems'),
('S05', 'Operating Systems'),
('S16', 'Operating Systems'),
('S17', 'Operating Systems'),
('S46', 'Operating Systems'),
('S39', 'Principles of Economy & Management'),
('S10', 'Python');

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
('Rohit Barve', 'Automata Theory'),
('Rohit Barve', 'Database Management'),
('Sampat Mali', 'Engineering Maths 4'),
('Shruti Agrawal', 'Python'),
('Shruti Agrawal', 'Python Lab'),
('Snehal Angane', 'Operating Systems'),
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
('Kanchan Dhuri', NULL, NULL),
('Rasika Ransing', NULL, 'Rasika Ransing'),
('Rohit Barve', 'Rohit Barve', NULL),
('Sameer Khatu', NULL, NULL),
('Sampat Mali', NULL, NULL),
('Shruti Agrawal', NULL, NULL),
('Snehal Angane', NULL, NULL),
('Uday Kashid', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`A_name`),
  ADD KEY `dept_fk` (`dept`);

--
-- Indexes for table `codinator_adds`
--
ALTER TABLE `codinator_adds`
  ADD PRIMARY KEY (`slot_id`,`subject_name`,`t_name`,`venue`),
  ADD UNIQUE KEY `inique_sidven` (`slot_id`,`venue`),
  ADD KEY `tfk` (`t_name`),
  ADD KEY `cod_fk` (`subject_name`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`C_name`),
  ADD KEY `deptfk` (`dept`);

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
  ADD KEY `dep_fk` (`Subject_name`);

--
-- Indexes for table `final_slots`
--
ALTER TABLE `final_slots`
  ADD PRIMARY KEY (`t_name`,`S_id`,`sub_name`),
  ADD KEY `S_id` (`S_id`),
  ADD KEY `final_fk` (`sub_name`);

--
-- Indexes for table `is_alloted_to`
--
ALTER TABLE `is_alloted_to`
  ADD PRIMARY KEY (`S_id`,`t_name`),
  ADD KEY `t_name` (`t_name`),
  ADD KEY `S_id` (`S_id`);

--
-- Indexes for table `is_from`
--
ALTER TABLE `is_from`
  ADD PRIMARY KEY (`D_name`,`t_name`),
  ADD KEY `t_name` (`t_name`);

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
  ADD PRIMARY KEY (`Roll_no`,`S_id`,`subject_name`,`t_name`),
  ADD UNIQUE KEY `unique_constraint_name` (`Roll_no`,`subject_name`),
  ADD KEY `fk_t_name` (`t_name`),
  ADD KEY `std_fk` (`subject_name`);

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
  ADD KEY `sub_fk` (`subject_name`);

--
-- Indexes for table `taught_by`
--
ALTER TABLE `taught_by`
  ADD PRIMARY KEY (`t_name`,`Subject_name`),
  ADD KEY `tb_fk` (`Subject_name`);

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
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `dept_fk` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_name`);

--
-- Constraints for table `codinator_adds`
--
ALTER TABLE `codinator_adds`
  ADD CONSTRAINT `cod_fk` FOREIGN KEY (`subject_name`) REFERENCES `subject` (`subject_name`),
  ADD CONSTRAINT `sfk` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`S_id`),
  ADD CONSTRAINT `slot_fk` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`S_id`),
  ADD CONSTRAINT `tfk` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`);

--
-- Constraints for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD CONSTRAINT `deptfk` FOREIGN KEY (`dept`) REFERENCES `department` (`dept_name`);

--
-- Constraints for table `dept_contains`
--
ALTER TABLE `dept_contains`
  ADD CONSTRAINT `dep_fk` FOREIGN KEY (`Subject_name`) REFERENCES `subject` (`subject_name`),
  ADD CONSTRAINT `dept_contains_ibfk_1` FOREIGN KEY (`D_name`) REFERENCES `department` (`dept_name`);

--
-- Constraints for table `final_slots`
--
ALTER TABLE `final_slots`
  ADD CONSTRAINT `final_fk` FOREIGN KEY (`sub_name`) REFERENCES `subject` (`subject_name`),
  ADD CONSTRAINT `final_slots_ibfk_1` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `final_slots_ibfk_2` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`),
  ADD CONSTRAINT `final_slots_ibfk_3` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `final_slots_ibfk_4` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`);

--
-- Constraints for table `is_alloted_to`
--
ALTER TABLE `is_alloted_to`
  ADD CONSTRAINT `fk_slots` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_alloted_to_ibfk_1` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `is_alloted_to_ibfk_2` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`);

--
-- Constraints for table `is_from`
--
ALTER TABLE `is_from`
  ADD CONSTRAINT `fk_D_name` FOREIGN KEY (`D_name`) REFERENCES `department` (`dept_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_name` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`);

--
-- Constraints for table `student_selects_slots`
--
ALTER TABLE `student_selects_slots`
  ADD CONSTRAINT `fk_Roll_no` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`),
  ADD CONSTRAINT `fk_t_name` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `std_fk` FOREIGN KEY (`subject_name`) REFERENCES `subject` (`subject_name`);

--
-- Constraints for table `sub_has_slots`
--
ALTER TABLE `sub_has_slots`
  ADD CONSTRAINT `fk_Slot_id` FOREIGN KEY (`S_id`) REFERENCES `slots` (`S_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_fk` FOREIGN KEY (`subject_name`) REFERENCES `subject` (`subject_name`);

--
-- Constraints for table `taught_by`
--
ALTER TABLE `taught_by`
  ADD CONSTRAINT `taught_by_ibfk_1` FOREIGN KEY (`t_name`) REFERENCES `teacher` (`t_name`),
  ADD CONSTRAINT `tb_fk` FOREIGN KEY (`Subject_name`) REFERENCES `subject` (`subject_name`);

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
