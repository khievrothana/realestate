/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.17 : Database - realestate
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`realestate` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `realestate`;

/*Table structure for table `imageproperty` */

DROP TABLE IF EXISTS `imageproperty`;

CREATE TABLE `imageproperty` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ImageId` int(11) DEFAULT NULL,
  `PropertyId` int(11) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `imageproperty` */

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `PhysicalPath` varchar(100) DEFAULT NULL,
  `ThumbnailPath` varchar(100) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=767 DEFAULT CHARSET=utf8;

/*Data for the table `images` */

insert  into `images`(`Id`,`Name`,`PhysicalPath`,`ThumbnailPath`,`UserId`,`DateCreated`) values (766,'11933476_1074814709218626_6157621182511757121_n.jpg','2015101801123511933476_1074814709218626_6157621182511757121_n.jpg','300x2015101801123511933476_1074814709218626_6157621182511757121_n.jpg',NULL,'2015-10-18 01:12:35');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `Decription` text,
  `Status` bit(1) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `LastUpdate` datetime DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `LastUpdateId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

/*Table structure for table `property` */

DROP TABLE IF EXISTS `property`;

CREATE TABLE `property` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Decription` varchar(1000) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `OnRent` bit(1) DEFAULT NULL,
  `OnSale` bit(1) DEFAULT NULL,
  `PropertySize` varchar(30) DEFAULT NULL,
  `LandSize` varchar(30) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `BathRoom` int(11) DEFAULT NULL,
  `BedRoom` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Status` bit(1) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `LastUpdated` datetime DEFAULT NULL,
  `Thumnail` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `User` (`UserId`),
  CONSTRAINT `User` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `property` */

insert  into `property`(`Id`,`Code`,`Name`,`Decription`,`Type`,`Price`,`OnRent`,`OnSale`,`PropertySize`,`LandSize`,`Location`,`BathRoom`,`BedRoom`,`UserId`,`Status`,`DateCreated`,`LastUpdated`,`Thumnail`) values (1,NULL,'rothana',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,'2015-09-27 12:23:16','2015-09-27 12:23:16',NULL),(3,NULL,'11rothana',NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2015-09-27 12:41:33','2015-09-27 12:41:33',NULL);

/*Table structure for table `propertytype` */

DROP TABLE IF EXISTS `propertytype`;

CREATE TABLE `propertytype` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `LastUpdated` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT '0',
  `UserId` int(11) NOT NULL,
  `ParentCategory` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `propertytype` */

insert  into `propertytype`(`Id`,`Name`,`DateCreated`,`LastUpdated`,`Status`,`UserId`,`ParentCategory`) values (1,'Apartment',NULL,'2015-09-30 22:53:28',0,0,0),(2,'Villa','2015-09-30 22:53:23','2015-09-30 22:53:25',0,0,0);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `DateCreated` date DEFAULT NULL,
  `LastUpdate` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

insert  into `roles`(`Id`,`Name`,`DateCreated`,`LastUpdate`) values (1,'dfdfd','2015-09-15',NULL),(2,'dfdf','2015-09-24',NULL);

/*Table structure for table `userroles` */

DROP TABLE IF EXISTS `userroles`;

CREATE TABLE `userroles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `RoleId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `userroles` */

insert  into `userroles`(`Id`,`UserId`,`RoleId`) values (1,1,1),(2,1,2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Sex` varchar(10) DEFAULT NULL,
  `AccountName` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `GroupId` int(11) NOT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `LastLogout` datetime DEFAULT NULL,
  `IsUse` tinyint(1) DEFAULT '1',
  `Status` tinyint(1) DEFAULT '1',
  `DateCreated` datetime DEFAULT NULL,
  `LastUpdate` datetime DEFAULT NULL,
  `Version` int(11) DEFAULT '0',
  `Photo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`Id`,`FirstName`,`LastName`,`Sex`,`AccountName`,`Password`,`Email`,`GroupId`,`LastLogin`,`LastLogout`,`IsUse`,`Status`,`DateCreated`,`LastUpdate`,`Version`,`Photo`) values (1,'Khiev','Rothana','Male','rothana','1234','it.rothana@gmali.com',1,'2015-09-16 23:23:32','2015-09-18 23:23:34',1,1,'2015-09-16 23:23:44','2015-09-24 23:23:49',0,NULL),(2,'Chan','Srey Pich','Femal','sreyPich','12345',NULL,0,NULL,NULL,1,1,NULL,NULL,0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
