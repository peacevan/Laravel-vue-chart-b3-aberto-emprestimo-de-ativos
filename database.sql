-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2023-05-04 15:53:42
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for lendingopenposition
CREATE DATABASE IF NOT EXISTS `lendingopenposition` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lendingopenposition`;


-- Dumping structure for table lendingopenposition.lending_open_position
CREATE TABLE IF NOT EXISTS `lending_open_position` (
  `id_open_position` int NOT NULL AUTO_INCREMENT,
  `RptDt` datetime DEFAULT NULL,
  `TckrSymb` varchar(255) DEFAULT NULL,
  `Asst` varchar(255) DEFAULT NULL,
  `BalQty` bigint DEFAULT NULL,
  `TradAvrgPric` float DEFAULT NULL,
  `PricFctr` int DEFAULT NULL,
  `BalVal` double DEFAULT NULL,
  PRIMARY KEY (`id_open_position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
