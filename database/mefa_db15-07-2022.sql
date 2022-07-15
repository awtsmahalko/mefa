# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.24)
# Database: mefa_db
# Generation Time: 2022-07-15 07:36:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_posts`;

CREATE TABLE `tbl_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_category` varchar(1) NOT NULL DEFAULT '' COMMENT 'A,E',
  `post_status` int(1) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_posts` WRITE;
/*!40000 ALTER TABLE `tbl_posts` DISABLE KEYS */;

INSERT INTO `tbl_posts` (`post_id`, `user_id`, `post_title`, `post_content`, `post_date`, `post_category`, `post_status`)
VALUES
	(1,1,'Title 1','Sample contents','2022-02-03 14:09:24','A',1),
	(2,1,'Title 1','Sample contentss','2022-01-01 14:09:24','I',1),
	(3,1,'Title 1','Sample contents','2022-03-05 14:09:24','A',1),
	(4,0,'Post 1','1','2022-09-13 07:47:35','',1),
	(6,1,'Title 1','Sample contents','2022-04-07 14:09:24','A',1),
	(7,0,'asdas','dasdad','2022-05-11 08:52:02','A',1);

/*!40000 ALTER TABLE `tbl_posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_properties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_properties`;

CREATE TABLE `tbl_properties` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_code` varchar(5) NOT NULL DEFAULT '',
  `property_name` varchar(150) NOT NULL DEFAULT '',
  `property_coordinates` text NOT NULL,
  `property_address` varchar(250) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_properties` WRITE;
/*!40000 ALTER TABLE `tbl_properties` DISABLE KEYS */;

INSERT INTO `tbl_properties` (`property_id`, `property_code`, `property_name`, `property_coordinates`, `property_address`, `user_id`, `date_added`, `date_updated`)
VALUES
	(2,'asf','sa','234','asda',3,'2022-07-15 14:10:38','2022-07-15 14:18:26'),
	(3,'AYG5E','H2 Bldg','100.0122,5.152151','Bredco',3,'2022-07-15 14:30:03','0000-00-00 00:00:00'),
	(4,'EYjti','ddgd','100.45151,21.005848','dfsdfsdf',3,'2022-07-15 14:32:41','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `tbl_properties` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_sensors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_sensors`;

CREATE TABLE `tbl_sensors` (
  `sensor_id` int(11) NOT NULL AUTO_INCREMENT,
  `sensor_code` varchar(5) NOT NULL DEFAULT '',
  `sensor_radius` decimal(12,2) NOT NULL DEFAULT '10.00',
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sensor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_sensors` WRITE;
/*!40000 ALTER TABLE `tbl_sensors` DISABLE KEYS */;

INSERT INTO `tbl_sensors` (`sensor_id`, `sensor_code`, `sensor_radius`, `user_id`, `property_id`, `date_added`, `date_updated`)
VALUES
	(1,'sadas',10.00,2,2,'2022-07-15 11:08:08','2022-07-15 14:16:59'),
	(2,'adasd',10.00,2,2,'2022-07-15 11:58:14','2022-07-15 14:17:00'),
	(3,'asdas',10.00,3,3,'2022-07-15 14:30:25','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `tbl_sensors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `user_fullname` varchar(100) NOT NULL DEFAULT '',
  `user_address` text NOT NULL,
  `user_location` text,
  `user_category` varchar(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `user_fullname`, `user_address`, `user_location`, `user_category`)
VALUES
	(1,'admin','0cc175b9c0f1b6a831c399e269772661','Onir C. Arton','Back Call Load',NULL,'A'),
	(2,'onir','4b38514829beb9b919f29d94a3dcf602','Onir C. Arton','Back Call Load',NULL,'R'),
	(3,'eduard','0cc175b9c0f1b6a831c399e269772661','Eduard Rino Carton','Purok Torrecampo Village',NULL,'R');

/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
