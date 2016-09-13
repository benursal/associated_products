/*
SQLyog Community v12.04 (32 bit)
MySQL - 5.6.21 : Database - monte
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`monte` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `monte`;

/*Table structure for table `complaints` */

DROP TABLE IF EXISTS `complaints`;

CREATE TABLE `complaints` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `details` text NOT NULL,
  `diagnosis` text NOT NULL,
  `date` date NOT NULL,
  `patient_id` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `complaints` */

insert  into `complaints`(`id`,`details`,`diagnosis`,`date`,`patient_id`,`status`) values (1,'ambot na lang','Lorem ipsum dolor, sit amet baho ka igit, Lorem ipsum dolor, sit amet baho ka igit, Lorem ipsum dolor, sit amet baho ka igit','2015-03-30',9,1),(2,'mas nubo, subong ang, iya reklamo','nubo man, ang mga, solution','2015-03-22',9,1),(4,'asdsdad as das ','dsadasd','2015-03-30',9,1),(5,'badfsfsdf','sdfsdfsdfsdf','2015-03-31',5,1),(6,'sdfsdfsdf','sdfsdfsdf','2015-03-31',6,0),(7,'fdsfsdfsdf','sdfsdfsdf','2015-03-31',6,0);

/*Table structure for table `history_types` */

DROP TABLE IF EXISTS `history_types`;

CREATE TABLE `history_types` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `history_types` */

insert  into `history_types`(`id`,`description`) values (1,'History of Birth and Immunizations'),(2,'Past Illnesses'),(3,'Personal and Social History'),(4,'Family History'),(5,'Menstrual History'),(6,'Obstetrical - Gynecological History');

/*Table structure for table `history_types_patients` */

DROP TABLE IF EXISTS `history_types_patients`;

CREATE TABLE `history_types_patients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) DEFAULT NULL,
  `history_type_id` int(2) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `history_type_id` (`history_type_id`),
  CONSTRAINT `history_types_patients_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  CONSTRAINT `history_types_patients_ibfk_2` FOREIGN KEY (`history_type_id`) REFERENCES `history_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `history_types_patients` */

insert  into `history_types_patients`(`id`,`patient_id`,`history_type_id`,`description`) values (1,7,1,'i have a headache, toothache, utotache, baho igit, baho lupot, baho tubol'),(2,4,1,'sdfsdf'),(3,7,2,'igit mo baho'),(4,7,3,'this is the shit'),(5,7,4,'fsd fsd fsdf '),(6,7,5,'fdsfsfd'),(7,7,6,'fsdfsdfsdf'),(8,9,3,'A very nice one'),(9,9,4,'this is a family history'),(10,9,2,'baho igit,basta'),(11,9,1,'baho itlog');

/*Table structure for table `patients` */

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `age` tinyint(3) DEFAULT NULL,
  `civil_status` char(1) NOT NULL,
  `gender` char(1) NOT NULL,
  `occupation` varchar(150) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `birth_place` varchar(150) DEFAULT NULL,
  `address` text,
  `contact_number` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1-active, 0-deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `patients` */

insert  into `patients`(`id`,`code`,`name`,`age`,`civil_status`,`gender`,`occupation`,`nationality`,`birth_place`,`address`,`contact_number`,`status`) values (1,'abc32134','baho ka igit',34,'s','m','','Filipino','','','',1),(2,'45512sdg','Paul Dy',42,'s','m','','Filipino','','','',1),(3,'4441sssf','Lyka Ursal',34,'s','f','','Filipino','','','',1),(4,'5431ddsa','Sarah',34,'s','f','','Filipino','','','',1),(5,'asd35ff2','John Carlo Dy',9,'s','m','Programmer','Filipino','alijis','Bacolod Homes Royal','324234234',1),(6,'234ffdsf','hello',54,'m','m','Programmer','Filipino','bacvds','fsdfsdf','324234234',1),(7,'18a7356f','hello',54,'m','m','Programmer','Filipino','bacvds','fsdfsdf','324234234',1),(8,'18a7356f','hello',54,'m','m','Programmer','Filipino','bacvds','fsdfsdf','324234234',1),(9,'2ef3c57c','cathy doggy',3,'s','f','guard dog','Filipino','Tangub','eroreco subd','24324234',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
