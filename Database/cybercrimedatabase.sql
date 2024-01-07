-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 03:38 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cybercrimedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `c_id` varchar(10) NOT NULL,
  `category` varchar(36) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `social_media` varchar(40) NOT NULL,
  `datetime` date NOT NULL,
  `suspect` varchar(100) NOT NULL,
  `area` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'NEW',
  `priority` varchar(20) NOT NULL DEFAULT 'MEDIUM',
  `bureau_notes` varchar(400) NOT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`c_id`, `category`, `subject`, `details`, `social_media`, `datetime`, `suspect`, `area`, `status`, `priority`, `bureau_notes`, `username`) VALUES
('C023', 'Child Pornography', 'I saw some theft doing bad stuff using childrens', 'Near my home their are some young people who have captured some kids making bad things from them and torchuring them', '', '2023-01-09', 'I think they have support of our area MLA', 'Mysore', 'CLOSED', 'HIGH', 'As per your details we have arrested all the people who responsible of this crime', '1'),
('C062', 'Identity Theft', 'someone stolled my phone', 'I was in bus and someone stole my phone', '', '2023-01-20', 'NO idea of it', 'vijayanagar', 'NEW', '', '', 'sammu'),
('C101', 'Email or Phone Call Scam', 'I got scammed of Rs.3,00,000', 'someone called me and ask for otp', 'whatsapp', '2023-01-11', 'Petty hackers', 'mysore', 'NEW', '', '', '1'),
('C386', 'Cyberbullying', 'someone is blackmailing for money t', 'A hacker has stolen my personal data from personal desktop and asking me to give him Rs. 5  lakh', '', '2023-01-03', 'Maybe some person who is close to me', 'Mysore', 'INPROGRESS', 'MEDIUM', 'investigation going on', '1'),
('C727', 'Bank Account Fraud', 'Dajsha', 'nvjgkjkgkhhj', '', '2023-02-15', 'bhfxghxvnm,m', 'gfgkjffghjgfghjk', 'NEW', '', '', '1'),
('C858', 'Social Media Content', 'Someone as used my photo', 'I posted my photo in the instagram and someone used for wrong purpose', 'instagram', '2023-01-03', 'Shailesh', 'Mysore', 'NEW', '', '', '2'),
('C888', 'Cyberbullying', 'someone stacking me', 'I feel like some one is watching my moves ', 'all', '2023-01-11', 'One boy who will be following in black hoodie', 'Bangalore', 'INPROGRESS', 'HIGH', 'WE are going to all suspects', '1');

--
-- Triggers `complaint`
--
DELIMITER $$
CREATE TRIGGER `INSERTLogComplaint` AFTER INSERT ON `complaint` FOR EACH ROW INSERT INTO logs VALUES (null, "New Complaint Inserted", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UPDATELogComplaint` AFTER UPDATE ON `complaint` FOR EACH ROW INSERT INTO logs VALUES (null, "Complaint Entry Updated", NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `criminal`
--

CREATE TABLE `criminal` (
  `cr_id` varchar(10) NOT NULL,
  `cr_name` char(50) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(10) NOT NULL,
  `nation` char(50) NOT NULL,
  `spec` char(50) NOT NULL,
  `info` longtext NOT NULL,
  `sen_info` longtext NOT NULL,
  `police_id` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criminal`
--

INSERT INTO `criminal` (`cr_id`, `cr_name`, `age`, `dob`, `gender`, `nation`, `spec`, `info`, `sen_info`, `police_id`) VALUES
('CR292', 'Rakesh', 26, '1997-01-23', 'Male', 'Indian', 'Hacking and Viruses', 'This guy have hacked a company litta .corp and robnbed all the user details', '5 years of imprizonment and Rs.10 lakh fine', 'kush'),
('CR682', 'Namratha', 45, '1978-04-13', 'Female', 'Australian', 'Cyberbullying', '\nThis women blackmailed a young girl and mental torcherd her by sending her private photos', '10 years 9 months of blackcell imprisonment', '8'),
('CR826', 'dsfvsvdgf', 0, '2023-01-12', 'safsf', 'safsf', 'Hacking and Viruses', 'sdfafsafd', 'asfsafsafs', 'kush');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logs` int(10) NOT NULL,
  `action` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logs`, `action`, `datetime`) VALUES
(1, 'New Complaint Inserted', '2023-01-30 10:05:50'),
(2, 'New Complaint Inserted', '2023-01-30 11:25:06'),
(3, 'New Complaint Inserted', '2023-01-30 14:30:44'),
(4, 'New Complaint Inserted', '2023-01-30 14:49:34'),
(5, 'New Complaint Inserted', '2023-01-30 14:57:29'),
(6, 'New Complaint Inserted', '2023-01-30 15:04:11'),
(7, 'New Complaint Inserted', '2023-01-30 15:04:22'),
(8, 'New Complaint Inserted', '2023-01-30 15:05:53'),
(9, 'New Complaint Inserted', '2023-01-30 19:04:04'),
(10, 'New Complaint Inserted', '2023-01-30 19:10:00'),
(11, 'New Complaint Inserted', '2023-01-30 19:12:50'),
(12, 'New Complaint Inserted', '2023-01-30 19:24:25'),
(13, 'New Complaint Inserted', '2023-01-30 19:32:29'),
(14, 'Complaint Entry Updated', '2023-01-30 21:47:45'),
(15, 'Complaint Entry Updated', '2023-01-30 21:48:23'),
(16, 'Complaint Entry Updated', '2023-01-30 21:48:32'),
(17, 'Complaint Entry Updated', '2023-01-30 21:48:52'),
(18, 'Complaint Entry Updated', '2023-01-30 21:49:04'),
(19, 'Complaint Entry Updated', '2023-01-30 21:50:00'),
(20, 'Complaint Entry Updated', '2023-01-30 21:50:16'),
(21, 'Complaint Entry Updated', '2023-01-30 21:50:27'),
(22, 'Complaint Entry Updated', '2023-01-30 21:50:51'),
(23, 'Complaint Entry Updated', '2023-01-30 21:51:02'),
(24, 'Complaint Entry Updated', '2023-01-30 22:27:38'),
(25, 'Complaint Entry Updated', '2023-01-30 22:27:53'),
(26, 'Complaint Entry Updated', '2023-01-30 22:28:06'),
(27, 'Complaint Entry Updated', '2023-01-30 22:28:13'),
(28, 'Complaint Entry Updated', '2023-01-30 22:28:45'),
(29, 'Complaint Entry Updated', '2023-01-30 22:28:58'),
(30, 'Complaint Entry Updated', '2023-01-30 22:29:08'),
(31, 'Complaint Entry Updated', '2023-01-30 22:29:37'),
(32, 'Complaint Entry Updated', '2023-01-30 22:29:46'),
(33, 'Complaint Entry Updated', '2023-01-31 11:20:47'),
(34, 'New Complaint Inserted', '2023-01-31 20:10:47'),
(35, 'New Complaint Inserted', '2023-02-02 10:35:11'),
(36, 'Complaint Entry Updated', '2023-02-02 10:38:54'),
(37, 'New Complaint Inserted', '2023-02-02 12:23:44'),
(38, 'Complaint Entry Updated', '2023-02-02 15:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `police_id` varchar(50) NOT NULL,
  `name` varchar(36) NOT NULL,
  `password` varchar(36) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `specialization` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`police_id`, `name`, `password`, `phone`, `gender`, `address`, `specialization`) VALUES
('8', 'Shailesh', '1234', '7689545564', 'male', 'london', 'Cyberbullying'),
('kush', 'Sukesh', '7890', '9971531254', 'male', 'Tumkur', 'Hacking and Viruses'),
('namu', 'Namratha', '1234', '123456789', 'male', 'Shimoga', 'Bank Account Fraud'),
('rak', 'Rakesh', '1234', '1234567', 'male', 'Hubli', 'Social Media Crime'),
('Sami', 'Samiuddin Syed', 'sam123', '9845673218', 'male', 'Mysore', 'E-Commerce Scam'),
('sar', 'Sarika', 'kullz', '123456789', 'female', 'Udupi', 'Email or Phone Call Scam'),
('shama', 'Shama', '1234', '88079719', 'female', 'Bangalore', 'Identity Theft'),
('sharu', 'Sharath', '1234', '9086455221', 'male', 'Mandya', ' Child Pornography');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(36) NOT NULL,
  `name` varchar(36) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` varchar(8) NOT NULL,
  `email` varchar(36) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `name`, `address`, `pincode`, `email`, `phone`, `gender`) VALUES
('1', '5089', 'Shailesh', 'Mysore', '570008', 'shaileshz2002@gmail.com', '9036462008', 'male'),
('2', '9999', 'Sukesh ', 'Mandya', '123456', 'kush@outlook.com', '123456787', 'male'),
('3', '1234', 'sarika', 'Bangalore', '570009', 'rakesh@gmail.com', '44444', 'female'),
('4', '1234', 'Sharath', 'Tumkur', '456789', 'sharu@gmail.com', '99715', 'male'),
('RAJ', '1327', 'Saman G', 'Saptagiri nilaya 13th cross sewage farm road', '570008', '4mh20is082@gmail.com', '9036462008', 'male'),
('sammu', '789', 'Saman G', 'Saptagiri nilaya 13th cross sewage farm road', '570008', '4mh20is082@gmail.com', '9036462008', 'female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `user` (`username`);

--
-- Indexes for table `criminal`
--
ALTER TABLE `criminal`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `policedetails` (`police_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logs`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`police_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logs` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `user` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `criminal`
--
ALTER TABLE `criminal`
  ADD CONSTRAINT `policedetails` FOREIGN KEY (`police_id`) REFERENCES `police` (`police_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
