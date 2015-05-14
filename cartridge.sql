/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.5.41-log : Database - cart_request
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cart_request` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cart_request`;

/*Table structure for table `cms_address` */

DROP TABLE IF EXISTS `cms_address`;

CREATE TABLE `cms_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

/*Data for the table `cms_address` */

insert  into `cms_address`(`id`,`id_user`,`address`,`active`) values (1,1,'г. Великий Новгород, ул. Людогоща, д.2',1),(2,2,'г. Великий Новгород, ул. Большая Московская, д.94',1);

/*Table structure for table `cms_cartridge` */

DROP TABLE IF EXISTS `cms_cartridge`;

CREATE TABLE `cms_cartridge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `comment` varchar(10000) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=575 DEFAULT CHARSET=utf8;

/*Data for the table `cms_cartridge` */

insert  into `cms_cartridge`(`id`,`name`,`comment`,`deleted`) values (1,'Epson LX-300/800',NULL,0),(2,'Кассета EPSON LX-1050\r\n',NULL,0),(3,'C13S020034',NULL,0),(4,'C13T051141 (S020108/S020189)',NULL,0),(5,'Кассета EPSON LX-100',NULL,0),(6,'Тонер Toshiba 1340/1350/1360/1370',NULL,0),(7,'Тонер Toshiba T-2060(E)\r\n',NULL,0),(8,'Тонер Toshiba 1550/1560\r\n',NULL,0),(9,'Canon FX10 черный (заправка)',NULL,0),(10,'Canon E16 черный\r\n',NULL,0),(11,'Canon E 30',NULL,0),(12,'Bc-20',NULL,0),(13,'Bci-24Bk',NULL,0),(14,'HP Q6511A черный',NULL,0),(15,'HP Q6511X',NULL,0),(16,'HP Q7553A (заправка)',NULL,0),(17,'HP Q5949A черный (заправка)',NULL,0),(18,'HP C6615NE ',NULL,0),(19,'HP C6625AE ',NULL,0),(20,'HP Q2613A',NULL,0),(21,'HP C3906A',NULL,0),(22,'HP C7115A (заправка)',NULL,0),(23,'HP Q7516A',NULL,0),(24,'HP CE505A (заправка)',NULL,0),(25,'HP Q6470A чёрный',NULL,0),(26,'HP Q7581A',NULL,0),(27,'HP Q7582A',NULL,0),(28,'HP Q7583A пурпурный\r\n',NULL,0),(29,'HP С8543Х\r\n',NULL,0),(30,'HP Q2612A черный',NULL,0),(31,'HP C4096A',NULL,0),(32,'HP C4092A черный\r\n',NULL,0),(33,'Тонер Kyocera Mita TK-410\r\n',NULL,0),(34,'Kyocera Mita  TK-715   ',NULL,0),(35,'Kyocera Mita  TK-60',NULL,0),(36,'Kyocera TK-435\r\n',NULL,0),(37,'Xerox 113R00692',NULL,0),(38,'Xerox 113R00693',NULL,0),(39,'Xerox 113R00694',NULL,0),(40,'Xerox 113R00695',NULL,0),(41,'Xerox 106R01148',NULL,0),(42,'HP Q3960A',NULL,0),(43,'HP Q3961A',NULL,0),(44,'HP Q3962A',NULL,0),(45,'HP Q3963A',NULL,0),(46,'HP Q3971A',NULL,0),(47,'HP Q3972A',NULL,0),(48,'HP Q3973A',NULL,0),(49,'HP CC530A черный\r\n',NULL,0),(50,'HP CC531A голубой\r\n',NULL,0),(51,'HP CC532A желтый\r\n',NULL,0),(52,'HP CC533A пурпурный\r\n',NULL,0),(53,'HP Q5942X',NULL,0),(54,'HP C9385AE',NULL,0),(55,'HP C9387AE пурпурный\r\n',NULL,0),(56,'HP C9386AE голубой',NULL,0),(57,'HP C9388AE желтый',NULL,1),(58,'HP C9391AE',NULL,0),(59,'HP C9392AE',NULL,0),(60,'HP C9393AE',NULL,0),(61,'HP C9396AE',NULL,0),(62,'Lexmark 10S0150',NULL,0),(63,'Xerox 106R01414',NULL,0),(64,'Лента красящая 13ммx12м\r\n',NULL,0),(65,'Xerox 109R00639',NULL,0),(66,'HP С6614DE \r\n',NULL,0),(67,'HP 51649A',NULL,0),(68,'106R00687',NULL,0),(69,'Samsung SCX-4720D5 черный\r\n',NULL,0),(70,'HP Q2624A',NULL,0),(71,'HP CE253A',NULL,0),(72,'HP CE252A',NULL,0),(73,'HP CE250X',NULL,0),(74,'HP CE251A',NULL,0),(75,'13TO101',NULL,0),(76,'HP C6578DE',NULL,0),(77,'Тонер Kyocera Mita TK-130\r\n',NULL,0),(78,'728 statrer',NULL,0),(79,'HP C6578DE',NULL,0),(80,'HP C51626AE',NULL,0),(81,'Xerox 106R01415',NULL,0),(82,'TK-475',NULL,0),(83,'106R01034',NULL,1),(84,'HP C6615DE ',NULL,0),(85,'HP Q5949X (заправка)',NULL,0),(86,'HP 51645AE черный\r\n',NULL,0),(87,'Xerox 106R01485',NULL,0),(88,'Epson C13S015327BA (FX-2190)\r\n',NULL,0),(89,'Термопленка KX-FA54A\r\n',NULL,0),(90,'СЕ 250А черный\r\n',NULL,0),(91,'HP Q2613x\r\n',NULL,0),(92,'HP 51649AE ',NULL,0),(93,'HP 51629AE',NULL,0),(94,'Xerox 106R01487\r\n',NULL,0),(95,'HP CB436AF',NULL,0),(96,'HP CD975AE черный\r\n',NULL,0),(97,'HP C3903A',NULL,0),(98,'Brother TN-6600',NULL,0),(99,'Canon 719 H',NULL,0),(100,'Canon 728',NULL,0),(101,'Тонер Canon C-EXV14 2020/2016\r\n',NULL,0),(102,'Canon C-EXV 18 (0388B002)',NULL,0),(103,'Canon EP-22',NULL,0),(104,'Epson S015019 (FX-800/LX-300)(C13S015019BA)',NULL,0),(105,'Epson C13T00740210\r\n',NULL,0),(106,'Epson T009 (C13T00940210)',NULL,0),(107,'Epson T0481 (C13T04814010)',NULL,0),(108,'Epson T0482 (C13T04824010)',NULL,0),(109,'Epson T0483 (C13T04834010)',NULL,0),(110,'Epson T0484 (C13T04844010)',NULL,0),(111,'Epson T0485 (C13T04854010)',NULL,0),(112,'Epson T0486 (C13T04864010)',NULL,0),(113,'Canon PFI-102M(0897B001)',NULL,0),(114,'Canon PFI-102C (0896B001)',NULL,0),(115,'Canon PFI-102Y (0898B001)',NULL,0),(116,'Canon PFI-102BK (0895B001)',NULL,0),(117,'Canon PFI-102 MBK              ( 0894B001)',NULL,0),(118,'Epson T0821 (C13T11214A10) (C13T11214A10/T08214A10)',NULL,0),(119,'Epson T0822 (C13T11224A10) (C13T11224A10/T08224A10)',NULL,0),(120,'Epson T0823 (C13T11234A10) (C13T11234A10/T08234A10)',NULL,0),(121,'Epson T0824 (C13T11244A10) (C13T11244A10/T08244A10)',NULL,0),(122,'Epson T0825 (C13T11254A10) (C13T11254A10/T08254A10)',NULL,0),(123,'Epson T0826 (C13T11264A10)(C13T11264A10/T08264A10)',NULL,0),(124,'HP C4129X',NULL,0),(125,'HP C6578AE(C6578A)',NULL,0),(126,'HP C6656AE',NULL,0),(127,'HP C6657AE\r\n',NULL,0),(128,'HP C7115X',NULL,0),(129,'HP C8721HE\r\n',NULL,0),(130,'HP C8727AE',NULL,0),(131,'HP C8728AE',NULL,0),(132,'HP C8771HE',NULL,0),(133,'HP C8772HE',NULL,0),(134,'HP C8773HE',NULL,0),(135,'HP C8774HE',NULL,0),(136,'HP C8775HE',NULL,0),(137,'HP C9388AE желтый\r\n',NULL,0),(138,'HP C9730A',NULL,0),(139,'HP C9731A (оригинальный)\r\n',NULL,0),(140,'HP C9732A (оригинальный)\r\n',NULL,0),(141,'HP C9733A (оригинальный)\r\n',NULL,0),(142,'HP CB436A черный\r\n',NULL,0),(143,'HP CB540A',NULL,0),(144,'HP CB541A',NULL,0),(145,'HP CB542A',NULL,0),(146,'HP CB543A',NULL,0),(147,'HP CC641HE черный\r\n',NULL,0),(148,'HP CC644HE цветной\r\n',NULL,0),(149,'HP CE505X',NULL,0),(150,'HP Q6000A',NULL,0),(151,'HP Q6001A',NULL,0),(152,'HP Q6002A',NULL,0),(153,'HP Q6003A',NULL,0),(154,'HP Q7553XC (заправка)',NULL,0),(155,'HP CE320A ',NULL,0),(156,'HP CE321A ',NULL,0),(157,'HP CE322A ',NULL,0),(158,'HP CE323A ',NULL,0),(159,'Kyocera Mita TK-440',NULL,0),(160,'Panasonic KX-FA83A',NULL,0),(161,'Panasonic KX-FAT88A(KX-FAT88A7)',NULL,0),(162,'Samsung SCX-D4725A\r\n',NULL,0),(163,'Xerox 106R01412\r\n',NULL,0),(519,'HP C7115А (заправка)',NULL,0),(520,'HP CQ5949X',NULL,0),(521,'HP CN053AE (черный 932XL - для HP officejet 7110)',NULL,0),(522,'HP CN054AE (синий 933XL - для HP officejet 7110)',NULL,0),(523,'HP CN055AE (красный 933XL - для HP officejet 7110)',NULL,0),(524,'HP CN056AE (желтый 933XL - для HP officejet 7110)',NULL,0),(525,'Xerox 106R01335',NULL,0),(526,'Xerox 106R01336',NULL,0),(527,'Xerox 106R01337',NULL,0),(528,'Xerox 106R01338',NULL,0),(529,'Kyocera Mita TK-1140',NULL,0),(530,'HP CE278A',NULL,0),(531,'HP CF210A (131A)',NULL,0),(532,'HP CF211A (131A)',NULL,0),(533,'HP CF212A (131A)',NULL,0),(534,'HP CF213A (131A)',NULL,0),(535,'S020189 - черный (для Epson Stylus Color 1160)',NULL,0),(536,'S020191 - цветной (для Epson Stylus Color 1160)',NULL,0),(537,'Xerox WorkCentre 3325',NULL,0),(538,'HP CE410A',NULL,0),(539,'HP CE411A',NULL,0),(540,'HP CE412A',NULL,0),(541,'HP CE413A',NULL,0),(542,'siemens nixdorf nd 77 (для кассовых аппараторов)',NULL,0),(543,'Xerox   Workcentre 3220/3210',NULL,0),(544,'Xerox 106RO2312 (картридж для МФУ xerox 3325)',NULL,0),(545,'HP 920XL черный',NULL,0),(546,'HP 920XL желтый',NULL,0),(547,'HP 920XL пурпурный',NULL,0),(548,'HP 920XL голубой',NULL,0),(549,'Xerox 106R02306',NULL,0),(550,'Xerox 106R02304',NULL,0),(551,'Kyocera KM-1635',NULL,0),(552,'Kyocera TK-170',NULL,0),(553,'Kyocera Mita TK-825Y (желтый) для Kyocera Mita КМ-С2525Е',NULL,0),(554,'Panasonic KX-F4D89',NULL,0),(555,'ML-1210D3/XEL',NULL,0),(556,'121ХL  черный',NULL,0),(557,'121ХL трехцветный',NULL,0),(558,'Катридж 36А для  HP  L J  M1522nf',NULL,0),(559,'TAPE CASSETTE Tze-FX231',NULL,0),(560,'Canon i9950',NULL,0),(561,'Тонер-картридж Xerox 5016 (106R01277) ',NULL,0),(562,'Xerox 101R00432',NULL,0),(563,'Картридж Kyocera TK-170',NULL,0),(564,'Kyocera FS1320',NULL,0),(565,'Xerox 106R02312',NULL,0),(566,'CANON iR2018',NULL,0),(567,'Canon Color CL-511',NULL,0),(568,'Canon Black PG-510',NULL,0),(569,'Xerox 106R02721',NULL,0),(570,'Xerox 106R02723',NULL,0),(571,'Xerox 106R02732',NULL,0),(572,'CANON EP-27',NULL,0),(573,'C13S015329BA',NULL,0),(574,'HP Q7553X',NULL,0);

/*Table structure for table `cms_cartridge_price` */

DROP TABLE IF EXISTS `cms_cartridge_price`;

CREATE TABLE `cms_cartridge_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cartridge` int(11) DEFAULT NULL,
  `price` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cartridge` (`id_cartridge`),
  CONSTRAINT `fk_cartridge` FOREIGN KEY (`id_cartridge`) REFERENCES `cms_cartridge` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8;

/*Data for the table `cms_cartridge_price` */

insert  into `cms_cartridge_price`(`id`,`id_cartridge`,`price`) values (1,1,138),(2,2,112),(3,3,440),(4,4,2190),(5,5,83),(6,6,636),(7,7,521),(8,8,623),(9,9,2348),(10,10,2760),(11,11,3960),(12,12,1500),(13,13,526),(14,14,5155),(15,15,8666),(16,16,3351),(17,17,3419),(18,18,666),(19,19,1149),(20,20,3417),(21,21,3326),(22,22,2945),(23,23,7557),(24,24,3320),(25,25,5501),(26,26,7082),(27,27,7082),(28,28,7082),(29,29,11477),(30,30,2909),(31,31,4800),(32,32,2830),(33,33,3071),(34,34,5769),(35,35,4968),(36,36,3396),(37,37,4289),(38,38,8206),(39,39,8206),(40,40,8206),(41,41,8111),(42,42,3446),(43,43,4152),(44,44,4152),(45,45,4153),(46,46,3068),(47,47,3068),(48,48,3068),(49,49,5076),(50,50,4553),(51,51,4553),(52,52,4553),(53,53,6199),(54,54,819),(55,55,614),(56,56,614),(57,57,614),(58,58,1023),(59,59,1023),(60,60,1023),(61,61,1432),(62,62,5135),(63,63,4259),(64,64,30),(65,65,4855),(66,66,1340),(67,67,1281),(68,68,7900),(69,69,5280),(70,70,2972),(71,71,9896),(72,72,9896),(73,73,5027),(74,74,9896),(75,75,2000),(76,76,1398),(77,77,4343),(78,78,2854),(79,79,1316),(80,80,1244),(81,81,5442),(82,82,4700),(83,83,8201),(84,84,1245),(85,85,6256),(86,86,1277),(87,87,2808),(88,88,423),(89,89,859),(90,90,5027),(91,91,4272),(92,92,1380),(93,93,1355),(94,94,3586),(95,95,4654),(96,96,1158),(97,97,4301),(98,98,3876),(99,99,5532),(100,100,2854),(101,101,2485),(102,102,4560),(103,103,2178),(104,104,86),(105,105,1652),(106,106,1982),(107,107,555),(108,108,555),(109,109,555),(110,110,555),(111,111,555),(112,112,555),(113,113,2647),(114,114,2647),(115,115,2647),(116,116,2647),(117,117,2647),(118,118,502),(119,119,502),(120,120,502),(121,121,502),(122,122,502),(123,123,502),(124,124,7840),(125,125,2502),(126,126,839),(127,127,1392),(128,128,3193),(129,129,685),(130,130,726),(131,131,898),(132,132,449),(133,133,449),(134,134,449),(135,135,449),(136,136,449),(137,137,614),(138,138,10260),(139,139,14398),(140,140,14398),(141,141,14398),(142,142,2909),(143,143,2941),(144,144,2688),(145,145,2688),(146,146,2688),(147,147,1258),(148,148,1452),(149,149,6071),(150,150,3163),(151,151,3448),(152,152,3448),(153,153,3448),(154,154,11098),(155,155,2677),(156,156,2543),(157,157,2543),(158,158,2543),(159,159,3870),(160,160,1287),(161,161,1080),(162,162,2760),(163,163,6599),(167,519,3390),(168,520,4540),(169,521,500),(170,522,350),(171,523,350),(172,524,350),(173,525,2000),(174,526,2000),(175,527,2000),(176,528,2000),(177,529,3484),(178,530,2410),(179,531,2800),(180,532,2800),(181,533,2800),(182,534,2800),(183,535,850),(184,536,1020),(185,537,6710),(186,538,3000),(187,539,4500),(188,540,4000),(189,541,4200),(190,542,165),(191,543,3500),(192,544,6874),(193,545,1000),(194,546,500),(195,547,500),(196,548,500),(197,549,6479),(198,550,4800),(199,551,2055),(200,552,4500),(201,553,2500),(202,554,1000),(203,555,1945),(204,556,1690),(205,557,850),(206,558,4500),(207,559,1100),(208,560,510),(209,561,1290),(210,562,4620),(211,563,4500),(212,564,3920),(213,565,7591),(214,566,2500),(215,567,1200),(216,568,850),(217,569,9500),(218,570,12500),(219,571,12000),(220,572,3000),(221,573,500),(222,574,13000);

/*Table structure for table `cms_limits` */

DROP TABLE IF EXISTS `cms_limits`;

CREATE TABLE `cms_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_time_period` int(11) NOT NULL,
  `limit` int(10) NOT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

/*Data for the table `cms_limits` */

/*Table structure for table `cms_request` */

DROP TABLE IF EXISTS `cms_request`;

CREATE TABLE `cms_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_time_period` int(11) NOT NULL,
  `date_creation` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('opened','approved','closed') DEFAULT 'opened',
  `person_in_charge` varchar(255) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `fk_time_period` (`id_time_period`),
  KEY `fk_user` (`id_user`),
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `cms_user` (`id`),
  CONSTRAINT `fk_time_period` FOREIGN KEY (`id_time_period`) REFERENCES `cms_time_period` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

/*Data for the table `cms_request` */

/*Table structure for table `cms_request_position` */

DROP TABLE IF EXISTS `cms_request_position`;

CREATE TABLE `cms_request_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_request` int(11) NOT NULL,
  `id_cartridge` int(11) NOT NULL,
  `id_address` int(11) NOT NULL,
  `amount` int(7) NOT NULL,
  `price` int(6) NOT NULL,
  `comment` text,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=477 DEFAULT CHARSET=utf8;

/*Data for the table `cms_request_position` */

/*Table structure for table `cms_setting` */

DROP TABLE IF EXISTS `cms_setting`;

CREATE TABLE `cms_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` text NOT NULL,
  `show_header` tinyint(1) NOT NULL,
  `mpage_topic` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cms_setting` */

insert  into `cms_setting`(`id`,`site_name`,`show_header`,`mpage_topic`) values (1,'Заявки на картриджи',1,'Картриджи 106R01034 и 106R01033 исключены из ассортимента по причине снятия их с производства');

/*Table structure for table `cms_time_period` */

DROP TABLE IF EXISTS `cms_time_period`;

CREATE TABLE `cms_time_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `cms_time_period` */

insert  into `cms_time_period`(`id`,`description`,`date_start`,`date_end`,`active`) values (1,'Заявки на 4-й квартал 2014 г.','2014-10-01 00:00:00','2014-12-31 23:59:59',0),(2,'Заявки на 1-й квартал 2015 г.','2015-01-01 00:00:00','2015-03-31 23:59:59',0);

/*Table structure for table `cms_user` */

DROP TABLE IF EXISTS `cms_user`;

CREATE TABLE `cms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `departament` varchar(255) DEFAULT NULL,
  `staff_status` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `ban` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

/*Data for the table `cms_user` */

insert  into `cms_user`(`id`,`short_name`,`password`,`name`,`surname`,`lastname`,`departament`,`staff_status`,`role`,`ban`,`email`,`created`) values (1,'admin','abe6db4c9f5484fae8d79f2e868a673c','Андрей','Чиков','Викторович','ИТ','Инженер-программист',2,0,'andr@inbox.ru',NULL),(2,'user','abe6db4c9f5484fae8d79f2e868a673c','Иван','Иванов','Иванович','ГСПС','Инженер',1,0,'','0000-00-00 00:00:00'),(4,'new_user','abe6db4c9f5484fae8d79f2e868a673c','Пользователь','Новый','Отстарого','Очень крутой департамент','Нравится',1,1,'user@mail.ru',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
