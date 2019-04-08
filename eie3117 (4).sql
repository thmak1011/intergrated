-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2019-04-08 10:33:26
-- 伺服器版本: 10.1.13-MariaDB
-- PHP 版本： 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `eie3117`
--
CREATE DATABASE IF NOT EXISTS `eie3117` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eie3117`;

-- --------------------------------------------------------

--
-- 資料表結構 `driver`
--

CREATE TABLE `driver` (
  `Username` varchar(45) NOT NULL,
  `Car_class` varchar(45) DEFAULT NULL,
  `Car_plate_No` varchar(45) DEFAULT NULL,
  `ImagePath` varchar(45) NOT NULL,
  `Image` varchar(45) DEFAULT NULL,
  `Car_model` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `driver`
--

INSERT INTO `driver` (`Username`, `Car_class`, `Car_plate_No`, `ImagePath`, `Image`, `Car_model`) VALUES
('aristotle', '4-Passenger Vehicles', 'D1230', '', 'D:xampp	mpphp37DC.tmp', 'BMW'),
('plato', '4-Passenger Vehicles', 'CX1526', 'D:/xampp/htdocs/images/', 'Plato.jpg', 'BMW');

-- --------------------------------------------------------

--
-- 資料表結構 `passager`
--

CREATE TABLE `passager` (
  `Username` varchar(45) NOT NULL,
  `Home_Location` text,
  `Work_Location` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `passager`
--

INSERT INTO `passager` (`Username`, `Home_Location`, `Work_Location`) VALUES
('socrates', 'Athen', 'Cimiory');

-- --------------------------------------------------------

--
-- 資料表結構 `request`
--

CREATE TABLE `request` (
  `Request_ID` int(11) NOT NULL,
  `Request_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Pickup_time` datetime NOT NULL,
  `Complete_time` datetime DEFAULT NULL,
  `PassagerName` varchar(45) NOT NULL,
  `DriverName` varchar(45) DEFAULT NULL,
  `Start_location` text NOT NULL,
  `Destination` text NOT NULL,
  `Suggested_Fee` double NOT NULL,
  `Final_Fee` double DEFAULT NULL,
  `Tips` double DEFAULT NULL,
  `Acceptance` tinyint(1) NOT NULL DEFAULT '0',
  `Completance` tinyint(1) NOT NULL DEFAULT '0',
  `Paid` tinyint(1) NOT NULL DEFAULT '0',
  `Dispute` tinyint(1) NOT NULL DEFAULT '0',
  `Dispute_value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `request`
--

INSERT INTO `request` (`Request_ID`, `Request_time`, `Pickup_time`, `Complete_time`, `PassagerName`, `DriverName`, `Start_location`, `Destination`, `Suggested_Fee`, `Final_Fee`, `Tips`, `Acceptance`, `Completance`, `Paid`, `Dispute`, `Dispute_value`) VALUES
(18, '2019-03-11 06:45:41', '2019-02-18 19:30:00', '2019-03-11 09:40:07', 'socrates', 'aristotle', 'é¦™æ¸¯æŽƒæ¡¿åŸ”æ¨‚æ™¯è‡ºDè™Ÿ', 'V city, 83 Tuen Mun Heung Sze Wui Rd, Tuen Mun, é¦™æ¸¯', 227.66, 224, 0, 1, 1, 0, 0, 24),
(19, '2019-03-11 10:56:43', '2019-02-18 19:30:00', '2019-03-11 10:57:08', 'socrates', 'aristotle', 'Suite 1305, Exchange Square Block 1 And 2, 8 Connaught Pl, Central, é¦™æ¸¯', 'é¦™æ¸¯ä¹é¾å¡˜åŠæ©‹é“6è™Ÿ', 69.28, 71, 0, 1, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `Username` varchar(45) NOT NULL,
  `Fullname` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Phone_No` int(8) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Type` varchar(45) NOT NULL,
  `Wallet_addr` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`Username`, `Fullname`, `Email`, `Phone_No`, `Password`, `Type`, `Wallet_addr`) VALUES
('aristotle', 'Aristotle Ethinz', 'testingelementalpha@gmail.com', 89472831, 'e8511d36e7a7fdb42c2ac44333260e56', 'driver', 'mn9rCrGmTgzQ4ps6z6KYiiQQ3bHyLAnH8P'),
('plato', 'Plato Pluto', 'testingelementbeta@gmail.com', 38294712, '056bdb24c6743824202ee45910a09a0d', 'driver', NULL),
('socrates', 'Socrates Philo', 'testingelementzero@gmail.com', 79726392, 'e06dab3dfe2888c46dc31f0ffce9c530', 'passager', 'mzsyCjrnoCBA5ruhFfqUfDFnjF9wR5sNvk');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `Username` (`Username`);

--
-- 資料表索引 `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `Username` (`Username`);

--
-- 資料表索引 `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `PassagerName` (`PassagerName`),
  ADD KEY `DriverName` (`DriverName`),
  ADD KEY `PassagerName_2` (`PassagerName`),
  ADD KEY `DriverName_2` (`DriverName`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `request`
--
ALTER TABLE `request`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `DriverName` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `passager`
--
ALTER TABLE `passager`
  ADD CONSTRAINT `PassagerName` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `Driver` FOREIGN KEY (`DriverName`) REFERENCES `driver` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Passager` FOREIGN KEY (`PassagerName`) REFERENCES `passager` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
