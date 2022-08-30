-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                10.4.24-MariaDB - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- tinyscada için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `tinyscada` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tinyscada`;

-- tablo yapısı dökülüyor tinyscada.node
CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `localIp` varchar(15) NOT NULL DEFAULT '0',
  `externalp` varchar(50) NOT NULL DEFAULT '0',
  `nodeSerialNumber` int(11) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- tinyscada.node: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT IGNORE INTO `node` (`id`, `userId`, `title`, `localIp`, `externalp`, `nodeSerialNumber`, `createdDate`, `updatedDate`) VALUES
	(1, 25, 'Fatih 1', '192.168.1.1', '192.168.1.1.', 5666, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 25, 'Fatih 2', '192.168.1.1', '192.168.1.1.', 5667, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 25, 'Fatih 3', '192.168.1.1', '192.168.1.1.', 5668, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 25, 'Fatih 4', '192.168.1.1', '192.168.1.1.', 5669, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- tablo yapısı dökülüyor tinyscada.readtags
CREATE TABLE IF NOT EXISTS `readtags` (
  `serialNumber` int(11) NOT NULL,
  `tagName` varchar(50) NOT NULL,
  `tagValue` double DEFAULT NULL,
  `readTime` datetime DEFAULT NULL,
  PRIMARY KEY (`serialNumber`,`tagName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tinyscada.readtags: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT IGNORE INTO `readtags` (`serialNumber`, `tagName`, `tagValue`, `readTime`) VALUES
	(5666, 'sicaklik', 25, NULL);

-- tablo yapısı dökülüyor tinyscada.tagpool
CREATE TABLE IF NOT EXISTS `tagpool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nodeId` int(11) NOT NULL DEFAULT 0,
  `tagName` varchar(50) NOT NULL DEFAULT 'tagPath',
  `tagTitle` varchar(50) NOT NULL DEFAULT 'tagTitle',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- tinyscada.tagpool: ~16 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT IGNORE INTO `tagpool` (`id`, `nodeId`, `tagName`, `tagTitle`) VALUES
	(1, 4, 'sicaklik', 'Sıcakalık'),
	(2, 4, 'nem', 'Nem'),
	(3, 4, 'di1', 'Dijital Giriş 1'),
	(4, 4, 'di2', 'Dijital Giriş 2'),
	(5, 3, 'sicaklik', 'Sıcakalık'),
	(6, 3, 'nem', 'Nem'),
	(7, 3, 'di1', 'Dijital Giriş 1'),
	(8, 3, 'di2', 'Dijital Giriş 2'),
	(9, 2, 'sicaklik', 'Sıcakalık'),
	(10, 2, 'nem', 'Nem'),
	(11, 2, 'di1', 'Dijital Giriş 1'),
	(12, 2, 'di2', 'Dijital Giriş 2'),
	(13, 1, 'sicaklik', 'Sıcakalık'),
	(14, 1, 'nem', 'Nem'),
	(15, 1, 'di1', 'Dijital Giriş 1'),
	(16, 1, 'di2', 'Dijital Giriş 2');

-- tablo yapısı dökülüyor tinyscada.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '0',
  `surname` varchar(20) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `tel` varchar(16) NOT NULL DEFAULT '0',
  `isActive` bit(1) NOT NULL DEFAULT b'0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL,
  `UpdatedDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- tinyscada.user: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT IGNORE INTO `user` (`id`, `name`, `surname`, `email`, `tel`, `isActive`, `password`, `createdDate`, `UpdatedDate`) VALUES
	(1, 'Fatih', 'Kütük', 'fatihkutuk@outlook.com', '05465498182', b'1', '89f7b61a88cccd01a6301c898e1c157c', '2022-08-26 16:35:06', '2022-08-26 16:35:08');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
