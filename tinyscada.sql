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


-- fatih_tinyscada için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `db_tinyscada` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_tinyscada`;

-- tablo yapısı dökülüyor fatih_tinyscada.node
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor fatih_tinyscada.readtags
CREATE TABLE IF NOT EXISTS `readtags` (
  `serialNumber` int(11) NOT NULL,
  `tagName` varchar(50) NOT NULL,
  `tagValue` double DEFAULT NULL,
  `readTime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`serialNumber`,`tagName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor fatih_tinyscada.tagpool
CREATE TABLE IF NOT EXISTS `tagpool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serialNumber` int(11) NOT NULL DEFAULT 0,
  `tagName` varchar(50) NOT NULL DEFAULT 'tagPath',
  `tagTitle` varchar(50) NOT NULL DEFAULT 'tagTitle',
  `tagUnit` varchar(50) DEFAULT NULL,
  `tagType` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor fatih_tinyscada.user
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor fatih_tinyscada.writedtags
CREATE TABLE IF NOT EXISTS `writedtags` (
  `serialNumber` int(11) NOT NULL,
  `tagName` varchar(50) NOT NULL DEFAULT '',
  `tagValue` double NOT NULL DEFAULT 0,
  `dateTime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`serialNumber`,`tagName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor fatih_tinyscada._counters
CREATE TABLE IF NOT EXISTS `_counters` (
  `readtagcount` double DEFAULT NULL,
  `writetagcount` double DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Veri çıktısı seçilmemişti

-- yöntem yapısı dökülüyor fatih_tinyscada.getReadTags
DELIMITER //
CREATE PROCEDURE `getReadTags`(
	IN `in_serialnumbers` LONGTEXT
)
BEGIN SET @s = CONCAT('SELECT rt.*,tp.tagTitle,tp.tagUnit,tp.tagType FROM fatih_tinyscada.readtags rt left join fatih_tinyscada.tagpool tp on tp.tagName=rt.tagName WHERE rt.serialNumber IN (',in_serialnumbers,') and rt.serialNumber = tp.serialNumber '); PREPARE stmt1 FROM @s; EXECUTE stmt1 ; DEALLOCATE PREPARE stmt1; END//
DELIMITER ;

-- tetikleyici yapısı dökülüyor fatih_tinyscada.node_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
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

-- tetikleyici yapısı dökülüyor fatih_tinyscada.readtags_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `readtags_after_update` AFTER INSERT ON `readtags` FOR EACH ROW BEGIN
	update  _counters SET readtagcount = readtagcount+0.2;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
