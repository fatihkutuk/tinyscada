-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                10.4.18-MariaDB - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- tinyscada için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `tinyscada` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tinyscada`;

-- yöntem yapısı dökülüyor tinyscada.getReadTafs
DELIMITER //
CREATE PROCEDURE `getReadTafs`(
	IN `in_serialnumbers` LONGTEXT
)
BEGIN
 
 SET @s = CONCAT('SELECT rt.*,tp.tagTitle,tp.tagUnit,tp.tagType FROM tinyscada.readtags rt 
 						left join tinyscada.tagpool tp on tp.tagName=rt.tagName
						WHERE rt.serialNumber IN (',in_serialnumbers,') AND tp.serialNumber = rt.serialNumber');
	
PREPARE stmt1 FROM @s; 
EXECUTE stmt1 ;
DEALLOCATE PREPARE stmt1;
END//
DELIMITER ;

-- tablo yapısı dökülüyor tinyscada.node
CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `localIp` varchar(15) NOT NULL DEFAULT '0',
  `externalp` varchar(50) NOT NULL DEFAULT '0',
  `nodeSerialNumber` int(11) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor tinyscada.readtags
CREATE TABLE IF NOT EXISTS `readtags` (
  `serialNumber` int(11) NOT NULL,
  `tagName` varchar(50) NOT NULL,
  `tagValue` double DEFAULT NULL,
  `readTime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`serialNumber`,`tagName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor tinyscada.tagpool
CREATE TABLE IF NOT EXISTS `tagpool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serialNumber` int(11) NOT NULL DEFAULT 0,
  `tagName` varchar(50) NOT NULL DEFAULT 'tagPath',
  `tagTitle` varchar(50) NOT NULL DEFAULT 'tagTitle',
  `tagUnit` varchar(50) DEFAULT NULL,
  `tagType` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
