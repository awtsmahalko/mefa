# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.24)
# Database: mefa_db
# Generation Time: 2022-11-08 06:09:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_departments`;

CREATE TABLE `tbl_departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_code` varchar(5) NOT NULL DEFAULT '',
  `department_name` varchar(150) NOT NULL DEFAULT '',
  `department_coordinates` text NOT NULL,
  `department_address` varchar(250) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_departments` WRITE;
/*!40000 ALTER TABLE `tbl_departments` DISABLE KEYS */;

INSERT INTO `tbl_departments` (`department_id`, `department_code`, `department_name`, `department_coordinates`, `department_address`, `user_id`, `date_added`, `date_updated`)
VALUES
	(1,'QMna8','Fire Officer','100.234','sadasd',0,'2022-07-19 10:07:00','0000-00-00 00:00:00'),
	(2,'xSEP7','fgh','fgh','fgh',0,'2022-07-19 10:17:03','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `tbl_departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_notifications`;

CREATE TABLE `tbl_notifications` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `notif_title` varchar(255) NOT NULL DEFAULT '',
  `notif_message` text NOT NULL,
  `notif_status` int(11) NOT NULL DEFAULT '0',
  `coordinates` varchar(255) NOT NULL DEFAULT '',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sensor_smoke` float NOT NULL DEFAULT '0',
  `sensor_heat` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_notifications` WRITE;
/*!40000 ALTER TABLE `tbl_notifications` DISABLE KEYS */;

INSERT INTO `tbl_notifications` (`notif_id`, `notif_title`, `notif_message`, `notif_status`, `coordinates`, `date_added`, `date_updated`, `sensor_smoke`, `sensor_heat`)
VALUES
	(1,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 11:53:31','2022-11-07 12:21:12',0,0),
	(2,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 12:15:21','2022-11-07 12:21:12',0,0),
	(3,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 12:24:41','2022-11-07 12:24:44',0,0),
	(4,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 12:25:02','2022-11-07 12:25:06',0,0),
	(5,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 12:25:02','2022-11-07 12:25:06',0,0),
	(6,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 12:25:03','2022-11-07 12:25:06',0,0),
	(7,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 12:25:03','2022-11-07 12:25:06',0,0),
	(8,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-07 12:26:47','2022-11-07 12:26:49',0,0),
	(9,'Fire Alert','There is a fire in your area',1,'10.63629241849944,122.9585436492834','2022-11-07 12:27:41','2022-11-07 12:27:45',0,0),
	(10,'Fire Alert','There is a fire in your area',1,'10.63629241849944,122.9585436492834','2022-11-07 12:27:43','2022-11-07 12:27:46',0,0),
	(11,'Fire Alert','There is a fire in your area',1,'10.63629241849944,122.9585436492834','2022-11-07 12:27:43','2022-11-07 12:27:46',0,0),
	(12,'Fire Alert','There is a fire in your area',1,'10.63629241849944,122.9585436492834','2022-11-07 12:29:14','2022-11-07 12:29:17',0,0),
	(13,'Fire Alert','There is a fire in your area',1,'10.63629241849944,122.9585436492834','2022-11-07 12:29:15','2022-11-07 12:29:18',0,0),
	(14,'Fire Alert','There is a fire in your area',1,'10.63629241849944,122.9585436492834','2022-11-07 12:36:26','2022-11-07 12:37:03',0,0),
	(15,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-08 13:55:54','2022-11-08 13:55:56',0,0),
	(16,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-08 13:56:59','2022-11-08 13:57:01',0,0),
	(17,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-08 13:57:30','2022-11-08 13:57:31',1,0),
	(18,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-08 13:58:13','2022-11-08 13:58:15',15,0),
	(19,'Fire Alert','There is a fire in your area',1,'10.6826927,122.9438081','2022-11-08 13:58:32','2022-11-08 13:58:34',15,0);

/*!40000 ALTER TABLE `tbl_notifications` ENABLE KEYS */;
UNLOCK TABLES;


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
  `property_coordinates` varchar(255) NOT NULL DEFAULT '10.659831487641943,122.96660646298393',
  `property_radius` decimal(10,2) NOT NULL DEFAULT '2.00',
  `property_address` varchar(250) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_properties` WRITE;
/*!40000 ALTER TABLE `tbl_properties` DISABLE KEYS */;

INSERT INTO `tbl_properties` (`property_id`, `property_code`, `property_name`, `property_coordinates`, `property_radius`, `property_address`, `user_id`, `date_added`, `date_updated`)
VALUES
	(2,'asf','Sabu','10.63629241849944,122.9585436492834',2.00,'asda',3,'2022-07-15 14:10:38','2022-11-07 11:31:47'),
	(7,'1pEza','H2 Buldinf','10.6826927,122.9438081',2.00,'H2 Buldinf',4,'2022-11-07 11:49:58','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `tbl_properties` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_sensors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_sensors`;

CREATE TABLE `tbl_sensors` (
  `sensor_id` int(11) NOT NULL AUTO_INCREMENT,
  `sensor_code` varchar(5) NOT NULL DEFAULT '',
  `sensor_radius` decimal(12,2) NOT NULL DEFAULT '10.00',
  `sensor_location` text NOT NULL,
  `sensor_coordinates` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sensor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_sensors` WRITE;
/*!40000 ALTER TABLE `tbl_sensors` DISABLE KEYS */;

INSERT INTO `tbl_sensors` (`sensor_id`, `sensor_code`, `sensor_radius`, `sensor_location`, `sensor_coordinates`, `user_id`, `property_id`, `date_added`, `date_updated`)
VALUES
	(1,'sadas',10.00,'','',2,2,'2022-07-15 11:08:08','2022-07-15 14:16:59'),
	(2,'adasd',10.00,'','',2,2,'2022-07-15 11:58:14','2022-07-15 14:17:00'),
	(3,'asdas',10.00,'','',3,3,'2022-07-15 14:30:25','0000-00-00 00:00:00'),
	(4,'12312',10.00,'asdasd','',1,0,'2022-09-23 15:11:41','0000-00-00 00:00:00'),
	(5,'asdas',10.00,'asdasd','adasda',1,0,'2022-09-23 15:20:56','0000-00-00 00:00:00');

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
  `user_mobile` varchar(15) NOT NULL DEFAULT '',
  `user_token` text NOT NULL,
  `user_coordinates` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `user_fullname`, `user_address`, `user_location`, `user_category`, `user_mobile`, `user_token`, `user_coordinates`)
VALUES
	(1,'admin','0cc175b9c0f1b6a831c399e269772661','Onir C. Arton','Back Call Load',NULL,'A','s','',''),
	(2,'onir','4b38514829beb9b919f29d94a3dcf602','Onir C. Arton','Back Call Load',NULL,'R','','',''),
	(3,'eduard','0cc175b9c0f1b6a831c399e269772661','Eduard Rino Carton','Purok Torrecampo Village',NULL,'R','09096836075','f0hxhYNZRuyZPbmP-3vK5P:APA91bEOECS1WKD1yRASNWEiHmwKkjQMRW2ztKies9P8QSAbXdxgyQPH8mPR-8J7VcfUiRU-StLHQ2Uuo_lnYmdfi9PsRcQ5LiuZF4z-OgAB4B46N_MvIR7lfw_USsVm_MJsIItnDINB','10.6827004,122.9438061'),
	(4,'jeff','0cc175b9c0f1b6a831c399e269772661','Jeff Lim','bacolod',NULL,'R','','fGFGgwwVRui-0TEFkjhSRg:APA91bFQN0GpG0QIgtA8_001UvyhxGycndNCx6zUZKlu3_FaZ2R4xOHSz3NkQts-hWCkCfTsOsOE7BlT9W03IMtfOqL9cFTZsgIDonC6E7KHFJogo-MfLsYQWX3XPqiqRWFBH5S6lTAP','');

/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_web_notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_web_notifications`;

CREATE TABLE `tbl_web_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notif_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
