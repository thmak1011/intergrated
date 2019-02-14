-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2019-02-13 08:07:50
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
  `Car_plate_No` varchar(45) NOT NULL,
  `Image` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `passager`
--

CREATE TABLE `passager` (
  `Username` varchar(45) NOT NULL,
  `Home_Location` text,
  `Work_Location` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `request`
--

CREATE TABLE `request` (
  `Request_ID` int(11) NOT NULL,
  `Request_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Pickup_time` datetime DEFAULT NULL,
  `Complete_time` datetime DEFAULT NULL,
  `PassagerName` varchar(45) NOT NULL,
  `DriverName` varchar(45) NOT NULL,
  `Start_location` text NOT NULL,
  `Destination` text NOT NULL,
  `Suggested_Fee` double NOT NULL,
  `Final_Fee` double DEFAULT NULL,
  `Tips` double DEFAULT NULL,
  `Acceptance` tinyint(1) NOT NULL DEFAULT '0',
  `Completance` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `Username` varchar(45) NOT NULL,
  `Fullname` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Phone_No` int(8) NOT NULL,
  `Password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT;
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
