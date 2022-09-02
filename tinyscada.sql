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
  `localIp` varchar(17) NOT NULL DEFAULT '0',
  `externalp` varchar(50) NOT NULL DEFAULT '0',
  `nodeSerialNumber` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- tinyscada.node: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `node` (`id`, `userId`, `title`, `localIp`, `externalp`, `nodeSerialNumber`, `createdDate`, `updatedDate`) VALUES
	(4, 1, 'Fatih1', '10.10.120.151', '88.248.170.254', 1301909, '2022-08-31 16:34:22', '2022-09-01 16:35:12');

-- tablo yapısı dökülüyor tinyscada.readtags
CREATE TABLE IF NOT EXISTS `readtags` (
  `serialNumber` int(11) NOT NULL,
  `tagName` varchar(50) NOT NULL,
  `tagValue` double DEFAULT NULL,
  `readTime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`serialNumber`,`tagName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tinyscada.readtags: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `readtags` (`serialNumber`, `tagName`, `tagValue`, `readTime`) VALUES
	(1301909, 'di1', 1, '2022-09-02 16:29:40'),
	(1301909, 'di2', 1, '2022-09-02 16:29:40'),
	(1301909, 'do1', 0, '2022-09-02 16:29:40'),
	(1301909, 'nem', 147.8, '2022-09-02 16:29:40'),
	(1301909, 'sicaklik', 14.1, '2022-09-02 16:29:40');

-- tablo yapısı dökülüyor tinyscada.tagpool
CREATE TABLE IF NOT EXISTS `tagpool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serialNumber` int(11) NOT NULL DEFAULT 0,
  `tagName` varchar(50) NOT NULL DEFAULT 'tagPath',
  `tagTitle` varchar(50) NOT NULL DEFAULT 'tagTitle',
  `tagUnit` varchar(50) DEFAULT NULL,
  `tagType` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- tinyscada.tagpool: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `tagpool` (`id`, `serialNumber`, `tagName`, `tagTitle`, `tagUnit`, `tagType`) VALUES
	(16, 1301909, 'sicaklik', 'Sıcaklık', '°C', 8),
	(17, 1301909, 'nem', 'Bağıl Nem', '%', 8),
	(18, 1301909, 'di1', 'Dijital Giriş 1', '', 1),
	(19, 1301909, 'di2', 'Dijital Giriş 2', '', 1),
	(20, 1301909, 'do1', 'Dijital Çıkış 1', '', 1);

-- tablo yapısı dökülüyor tinyscada.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '0',
  `surname` varchar(20) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `tel` varchar(16) NOT NULL DEFAULT '0',
  `isActive` bit(1) NOT NULL DEFAULT b'0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `confirmHash` tinytext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- tinyscada.user: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `user` (`id`, `name`, `surname`, `email`, `tel`, `isActive`, `password`, `createdDate`, `UpdatedDate`, `confirmHash`) VALUES
	(1, 'fatih', 'kütük', 'fatihkutuk@outlook.com', '0', b'1', '5583413443164b56500def9a533c7c70', '2022-08-31 10:02:27', '2022-09-02 16:28:41', NULL),
	(17, 'fatih kütük', 'kütük', 'fatih.kutuk@envest.com.tr', '05465498182', b'0', 'asdasd', '2022-09-02 18:29:16', NULL, '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8');

-- tablo yapısı dökülüyor tinyscada.writedtags
CREATE TABLE IF NOT EXISTS `writedtags` (
  `serialNumber` int(11) NOT NULL,
  `tagName` varchar(50) NOT NULL DEFAULT '',
  `tagValue` double NOT NULL DEFAULT 0,
  `dateTime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`serialNumber`,`tagName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tinyscada.writedtags: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tetikleyici yapısı dökülüyor tinyscada.node_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `node_after_insert` AFTER INSERT ON `node` FOR EACH ROW BEGIN
	INSERT INTO tagpool (serialNumber,tagName,tagTitle,tagUnit,tagType) 
	VALUES (NEW.nodeSerialNumber,'sicaklik','Sıcaklık','°C',8);
	
	INSERT INTO tagpool (serialNumber,tagName,tagTitle,tagUnit,tagType) 
	VALUES (NEW.nodeSerialNumber,'nem','Bağıl Nem','%',8);
	
	INSERT INTO tagpool (serialNumber,tagName,tagTitle,tagUnit,tagType) 
	VALUES (NEW.nodeSerialNumber,'di1','Dijital Giriş 1','',1);
	
	INSERT INTO tagpool (serialNumber,tagName,tagTitle,tagUnit,tagType) 
	VALUES (NEW.nodeSerialNumber,'di2','Dijital Giriş 2','',1);
	
	INSERT INTO tagpool (serialNumber,tagName,tagTitle,tagUnit,tagType) 
	VALUES (NEW.nodeSerialNumber,'do1','Dijital Çıkış 1','',1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
