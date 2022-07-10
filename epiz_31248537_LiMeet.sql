-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql102.epizy.com
-- Generation Time: Apr 16, 2022 at 06:15 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_31248537_LiMeet`
--

-- --------------------------------------------------------

--
-- Table structure for table `availableInterest`
--

CREATE TABLE `availableInterest` (
  `InterestId` int(11) NOT NULL,
  `InterestName` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `availableInterest`
--

INSERT INTO `availableInterest` (`InterestId`, `InterestName`) VALUES
(1, 'Sport'),
(2, 'Video games'),
(5, 'painting');

-- --------------------------------------------------------

--
-- Table structure for table `DislikeTable`
--

CREATE TABLE `DislikeTable` (
  `DislikeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Disliked_UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Interest`
--

CREATE TABLE `Interest` (
  `InterestID` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Interest`
--

INSERT INTO `Interest` (`InterestID`, `UserId`) VALUES
(1, 1),
(1, 2),
(1, 14),
(1, 16),
(1, 20),
(1, 21),
(2, 1),
(2, 2),
(2, 5),
(2, 14),
(2, 16),
(2, 20),
(5, 5),
(5, 14),
(5, 16),
(5, 19),
(5, 20),
(5, 21);

-- --------------------------------------------------------

--
-- Table structure for table `LikeTable`
--

CREATE TABLE `LikeTable` (
  `LikeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Liked_UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `LikeTable`
--

INSERT INTO `LikeTable` (`LikeID`, `UserID`, `Liked_UserID`) VALUES
(27, 2, 1),
(29, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `MatchTable`
--

CREATE TABLE `MatchTable` (
  `MatchID` int(11) NOT NULL,
  `UserID_A` int(11) NOT NULL,
  `UserID_B` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `MatchTable`
--

INSERT INTO `MatchTable` (`MatchID`, `UserID_A`, `UserID_B`) VALUES
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `MessageTable`
--

CREATE TABLE `MessageTable` (
  `MessageID` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `MessageTable`
--

INSERT INTO `MessageTable` (`MessageID`, `id_expediteur`, `id_destinataire`, `message`) VALUES
(1, 2, 1, 'coucou');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserId` int(8) NOT NULL,
  `FirstName` varchar(28) NOT NULL,
  `LastName` varchar(28) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Age` int(3) NOT NULL,
  `Gender` varchar(26) DEFAULT NULL,
  `Seeking` varchar(26) DEFAULT NULL,
  `Banned` tinyint(1) DEFAULT NULL,
  `Description` blob DEFAULT NULL,
  `Nationality` varchar(26) CHARACTER SET latin1 DEFAULT NULL,
  `Studies` varchar(26) CHARACTER SET latin1 DEFAULT NULL,
  `Picture` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `Admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserId`, `FirstName`, `LastName`, `Email`, `Password`, `Age`, `Gender`, `Seeking`, `Banned`, `Description`, `Nationality`, `Studies`, `Picture`, `Admin`) VALUES
(1, 'Lorenzo', 'Burgio', 'lorenzo.burgio@epita.fr', 'Lorenzo', 19, 'Male', 'Female', 0, 0x426f6e6a6f75722c20636563692065737420756e65204465736372697074696f6e, 'french', 'Computer Science', '624aefc64ef570.00493529.png', 1),
(2, 'PasMoi', 'Burgio', 'PasMoi@lol.fr', 'Pooper', 19, 'Female', 'Female', 0, 0x426f6e6a6f75722c20636563692065737420756e65204465736372697074696f6e, 'french', 'Computer Science', '624b4d248923b2.77505927.png', NULL),
(4, 'g', 'gg', 'vutyvuytvut@gmail.com', 'nujjor-zyztyb-9Nephy', 27, NULL, NULL, NULL, NULL, NULL, NULL, '6239c2ea23a598.34087149.jpg', NULL),
(5, 'Scoop', 'Scooper', 'Scoop@poop.com', 'poop123', 9, 'Male', 'Male', NULL, '', 'french', 'Computer Science', '6239c4dd264791.76224542.jpg', NULL),
(6, '1', '1', '1064@qq.com', '1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Plop', 'Plopper', 'plop@plop.com', 'Plop123', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Sarmad', 'Ali', 'sarmad.ali@lero.ie', 'sarmad', 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '3213', '213213', '123213123@12', '312312', 1312, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '1', '1', '1@1', '1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'test', 'tester', 'tester123@gmail.com', 'test123456', 21, '', '', NULL, '', '', '', NULL, NULL),
(12, 'Hefi', 'Dij', 'hefidij961@minimeq.com', 'asdASD123!', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Daniel', 'Larkin', 'ddcc112@gmail.com', 'daniel123', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'David', 'Condon', 'dmdcondon@gmail.com', 'hello', 21, 'Male', 'Female', NULL, '', 'irish', 'Computer Science', NULL, NULL),
(15, 'Eoin', 'Chedzey', 'eoinisnow@gmail.com', 'password', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Sean', 'Fitz', 'fitzsean@gmail.com', 'testpassword', 21, 'Male', 'Male', NULL, '', 'irish', 'Computer Science', '62444dcfe08f46.15558258.jpg', NULL),
(17, '133r', '456', 'david@gmail.com', 'hello', 15, 'Female', '', NULL, '', '', '', '62449a6a801521.40975344.jpg', NULL),
(18, 'Adelyn', 'Nelson', '123@gmail.com', 'woxihuanni2', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Barry', 'Benson', 'marytease40@gmail.com', 'SixSix66', 26, 'Male', 'Other', NULL, 0x42757a7a, 'french', 'psychologie', '6245b13b770432.42280919.jpg', NULL),
(20, '11', '12', 'test@error', '1', 21, 'Male', 'Female', NULL, 0x74657374206465736372697074696f6e, 'irish', 'Computer Science', '6245da68a59194.41784628.jpg', NULL),
(21, 'Eoin', 'Chedzey', 'eoinisnow@gmail.net', 'passwordTest', 21, 'Male', 'Female', NULL, '', 'irish', 'Enginering', '6249fb3d24f652.04444830.png', NULL),
(22, 'Daniel', 'Larkin', 'daniel112@gmail.com', 'daniel', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'gilbert', 'murphy', 'hello@gmail.com', 'world', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availableInterest`
--
ALTER TABLE `availableInterest`
  ADD PRIMARY KEY (`InterestId`);

--
-- Indexes for table `DislikeTable`
--
ALTER TABLE `DislikeTable`
  ADD PRIMARY KEY (`DislikeID`,`UserID`,`Disliked_UserID`),
  ADD KEY `Dislike_fk_1` (`UserID`),
  ADD KEY `Dislike_fk_2` (`Disliked_UserID`);

--
-- Indexes for table `Interest`
--
ALTER TABLE `Interest`
  ADD PRIMARY KEY (`InterestID`,`UserId`),
  ADD KEY `interest_fk_1` (`UserId`),
  ADD KEY `interestID` (`InterestID`) USING BTREE;

--
-- Indexes for table `LikeTable`
--
ALTER TABLE `LikeTable`
  ADD PRIMARY KEY (`LikeID`,`UserID`,`Liked_UserID`),
  ADD KEY `like_fk_1` (`UserID`),
  ADD KEY `like_fk_2` (`Liked_UserID`);

--
-- Indexes for table `MatchTable`
--
ALTER TABLE `MatchTable`
  ADD PRIMARY KEY (`MatchID`,`UserID_A`,`UserID_B`),
  ADD KEY `match_fk_1` (`UserID_A`),
  ADD KEY `match_fk_2` (`UserID_B`);

--
-- Indexes for table `MessageTable`
--
ALTER TABLE `MessageTable`
  ADD PRIMARY KEY (`MessageID`,`id_expediteur`,`id_destinataire`),
  ADD KEY `message_fk_1` (`id_expediteur`),
  ADD KEY `message_fk_2` (`id_destinataire`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availableInterest`
--
ALTER TABLE `availableInterest`
  MODIFY `InterestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `DislikeTable`
--
ALTER TABLE `DislikeTable`
  MODIFY `DislikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `LikeTable`
--
ALTER TABLE `LikeTable`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `MatchTable`
--
ALTER TABLE `MatchTable`
  MODIFY `MatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `MessageTable`
--
ALTER TABLE `MessageTable`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DislikeTable`
--
ALTER TABLE `DislikeTable`
  ADD CONSTRAINT `Dislike_fk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `Dislike_fk_2` FOREIGN KEY (`Disliked_UserID`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `Interest`
--
ALTER TABLE `Interest`
  ADD CONSTRAINT `interest_fk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `interest_fk_2` FOREIGN KEY (`InterestID`) REFERENCES `availableInterest` (`InterestId`);

--
-- Constraints for table `LikeTable`
--
ALTER TABLE `LikeTable`
  ADD CONSTRAINT `like_fk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `like_fk_2` FOREIGN KEY (`Liked_UserID`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `MatchTable`
--
ALTER TABLE `MatchTable`
  ADD CONSTRAINT `match_fk_1` FOREIGN KEY (`UserID_A`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `match_fk_2` FOREIGN KEY (`UserID_B`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `MessageTable`
--
ALTER TABLE `MessageTable`
  ADD CONSTRAINT `message_fk_1` FOREIGN KEY (`id_expediteur`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `message_fk_2` FOREIGN KEY (`id_destinataire`) REFERENCES `Users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
