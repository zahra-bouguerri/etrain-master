-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 12:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mathplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `motPass` varchar(250) DEFAULT NULL,
  `roles` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `motPass`, `roles`) VALUES
(1, 'mathprof214@gmail.com', 'prof', 'admin'),
(2, 'enseignant@gmail.com', 'enseignant', 'ens');

-- --------------------------------------------------------

--
-- Table structure for table `année`
--

CREATE TABLE `année` (
  `year_id` int(11) NOT NULL,
  `year_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `année`
--

INSERT INTO `année` (`year_id`, `year_name`) VALUES
(1, 'الاولى ثانوي'),
(2, 'الثانية ثانوي'),
(3, 'الثالثة ثانوي');

-- --------------------------------------------------------

--
-- Table structure for table `chapitre`
--

CREATE TABLE `chapitre` (
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(250) DEFAULT NULL,
  `etat` varchar(250) DEFAULT NULL,
  `filiere_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapitre`
--

INSERT INTO `chapitre` (`chapter_id`, `chapter_name`, `etat`, `filiere_id`) VALUES
(24, 'mana3a', ' جديد', 14);

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(250) DEFAULT NULL,
  `subchapter_id` int(11) DEFAULT NULL,
  `video_name` varchar(250) DEFAULT NULL,
  `pdf_name` varchar(250) DEFAULT NULL,
  `etat` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`course_id`, `course_name`, `subchapter_id`, `video_name`, `pdf_name`, `etat`) VALUES
(24, 'roz', 19, NULL, NULL, ' جديد');

-- --------------------------------------------------------

--
-- Table structure for table `filière`
--

CREATE TABLE `filière` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(50) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filière`
--

INSERT INTO `filière` (`field_id`, `field_name`, `year_id`) VALUES
(14, '3olom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question_text` varchar(255) DEFAULT NULL,
  `question_img` varchar(250) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_text`, `question_img`, `quiz_id`) VALUES
(38, 'how u doing', 'upload/', 42),
(39, 'hi', 'upload/', 42);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(50) DEFAULT NULL,
  `quiz_score` int(250) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `quiz_score`, `course_id`) VALUES
(42, 'gg', NULL, 24);

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `response_id` int(11) NOT NULL,
  `response_text` varchar(255) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`response_id`, `response_text`, `question_id`, `is_correct`) VALUES
(78, 'ok', 38, 1),
(79, 'not', 38, 0),
(80, '<ch', 39, 0),
(81, 'ium', 39, 0),
(82, 'tt', 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sous_chapitre`
--

CREATE TABLE `sous_chapitre` (
  `subchapter_id` int(11) NOT NULL,
  `subchapter_name` varchar(250) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sous_chapitre`
--

INSERT INTO `sous_chapitre` (`subchapter_id`, `subchapter_name`, `chapter_id`) VALUES
(19, 'makla', 24);

-- --------------------------------------------------------

--
-- Table structure for table `étudiant`
--

CREATE TABLE `étudiant` (
  `student_id` int(11) NOT NULL,
  `nom` varchar(250) DEFAULT NULL,
  `prenom` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `motPass` varchar(250) DEFAULT NULL,
  `annee` varchar(250) DEFAULT NULL,
  `anneereg` varchar(255) DEFAULT extract(year from curdate())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `étudiant`
--

INSERT INTO `étudiant` (`student_id`, `nom`, `prenom`, `email`, `motPass`, `annee`, `anneereg`) VALUES
(1, 'Azzedine', 'Chalabi', 'bouguerrifatmazohra3@gmail.com', '$2y$10$jnKBtDl0Z99.4q3bCyIipO78MAvOnMoMjdEFFLB.e.wgu4gmUiiVO', 'الأولى ثانوي', '2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `année`
--
ALTER TABLE `année`
  ADD PRIMARY KEY (`year_id`);

--
-- Indexes for table `chapitre`
--
ALTER TABLE `chapitre`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `fk_chapitre_filiere` (`filiere_id`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `subchapter_id` (`subchapter_id`);

--
-- Indexes for table `filière`
--
ALTER TABLE `filière`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `year_id` (`year_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `sous_chapitre`
--
ALTER TABLE `sous_chapitre`
  ADD PRIMARY KEY (`subchapter_id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Indexes for table `étudiant`
--
ALTER TABLE `étudiant`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `année`
--
ALTER TABLE `année`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chapitre`
--
ALTER TABLE `chapitre`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `filière`
--
ALTER TABLE `filière`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `sous_chapitre`
--
ALTER TABLE `sous_chapitre`
  MODIFY `subchapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `étudiant`
--
ALTER TABLE `étudiant`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapitre`
--
ALTER TABLE `chapitre`
  ADD CONSTRAINT `chapitre_ibfk_2` FOREIGN KEY (`filiere_id`) REFERENCES `filière` (`field_id`),
  ADD CONSTRAINT `fk_chapitre_filiere` FOREIGN KEY (`filiere_id`) REFERENCES `filière` (`field_id`);

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`subchapter_id`) REFERENCES `sous_chapitre` (`subchapter_id`);

--
-- Constraints for table `filière`
--
ALTER TABLE `filière`
  ADD CONSTRAINT `filière_ibfk_1` FOREIGN KEY (`year_id`) REFERENCES `année` (`year_id`),
  ADD CONSTRAINT `filière_ibfk_2` FOREIGN KEY (`year_id`) REFERENCES `année` (`year_id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `étudiant` (`student_id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `cours` (`course_id`);

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `sous_chapitre`
--
ALTER TABLE `sous_chapitre`
  ADD CONSTRAINT `sous_chapitre_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapitre` (`chapter_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
