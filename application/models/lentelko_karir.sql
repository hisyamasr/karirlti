-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: lentelko_karir
-- ------------------------------------------------------
-- Server version	5.7.16-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appsetting`
--

DROP TABLE IF EXISTS `appsetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_pembukaan` datetime NOT NULL,
  `tanggal_penutupan` datetime NOT NULL,
  `text_pengumuman` varchar(45) DEFAULT NULL,
  `status_rekrutmen` tinyint(1) NOT NULL DEFAULT '1',
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appsetting`
--

LOCK TABLES `appsetting` WRITE;
/*!40000 ALTER TABLE `appsetting` DISABLE KEYS */;
INSERT INTO `appsetting` VALUES (1,'2018-07-14 00:00:00','2018-07-31 23:59:59',NULL,1,NULL);
/*!40000 ALTER TABLE `appsetting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_pelamar`
--

DROP TABLE IF EXISTS `data_pelamar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_pelamar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_registrasi` varchar(15) DEFAULT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `umur` int(11) DEFAULT '0',
  `jenis_kelamin` varchar(9) NOT NULL,
  `agama` varchar(45) DEFAULT NULL,
  `no_handphone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `domisili` longtext,
  `alamat_asli` longtext,
  `foto_url` varchar(100) DEFAULT NULL,
  `cv_url` varchar(100) DEFAULT NULL,
  `kode_posisi` varchar(10) NOT NULL,
  `posisiID` int(11) NOT NULL,
  `universitas` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `jenjangID` int(11) NOT NULL,
  `pengalaman_kerja` longtext,
  `pengalaman_lainnya` longtext,
  `status_pengalaman` varchar(25) DEFAULT NULL,
  `status_perkawinan` varchar(30) NOT NULL,
  `info_loker` varchar(45) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_registrasi_UNIQUE` (`no_registrasi`),
  KEY `Pelamar_Posisi_idx` (`posisiID`),
  KEY `Pelamar_Pendidikan_idx` (`jenjangID`),
  CONSTRAINT `Pelamar_Pendidikan` FOREIGN KEY (`jenjangID`) REFERENCES `setup_pendidikan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Pelamar_Posisi` FOREIGN KEY (`posisiID`) REFERENCES `setup_posisi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_pelamar`
--

LOCK TABLES `data_pelamar` WRITE;
/*!40000 ALTER TABLE `data_pelamar` DISABLE KEYS */;
INSERT INTO `data_pelamar` VALUES (1,'123','321','ada ada saja','bidan','2001-10-01',50,'rahasia','Islam','12345','a@a.a','jalan domisili no.0000','sesuai domisili','aaaaaaaaaaaaaaaaaaaaaadaaaaaa','dsaaaaaaaaaaaaaadawwwwwwww','3DA',1,'di kampus','caheum ledeng','1 meter',2,'apa saja','bebas','tak berstatus','kawin','yang ngasih',NULL,NULL);
/*!40000 ALTER TABLE `data_pelamar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'members','General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_jurusan`
--

DROP TABLE IF EXISTS `setup_jurusan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kode_jurusan` varchar(10) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_jurusan`
--

LOCK TABLES `setup_jurusan` WRITE;
/*!40000 ALTER TABLE `setup_jurusan` DISABLE KEYS */;
INSERT INTO `setup_jurusan` VALUES (1,'Manajemen','Man',1,NULL,NULL),(2,'Teknik Industri','TI',1,NULL,NULL),(3,'Akuntansi','AKT',1,NULL,NULL);
/*!40000 ALTER TABLE `setup_jurusan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_pendidikan`
--

DROP TABLE IF EXISTS `setup_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jenjang` varchar(10) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_pendidikan`
--

LOCK TABLES `setup_pendidikan` WRITE;
/*!40000 ALTER TABLE `setup_pendidikan` DISABLE KEYS */;
INSERT INTO `setup_pendidikan` VALUES (1,'Diploma','D3',1,NULL,NULL),(2,'Sarjana','S1',1,NULL,NULL),(3,'Magister','S2',1,NULL,NULL),(4,'Doktor','S3',0,NULL,NULL);
/*!40000 ALTER TABLE `setup_pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_posisi`
--

DROP TABLE IF EXISTS `setup_posisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_posisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kode_posisi` varchar(10) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_posisi`
--

LOCK TABLES `setup_posisi` WRITE;
/*!40000 ALTER TABLE `setup_posisi` DISABLE KEYS */;
INSERT INTO `setup_posisi` VALUES (1,'Akuntansi','AKT',1,NULL,NULL),(2,'Sumber Daya Manusia','SDM',1,NULL,NULL);
/*!40000 ALTER TABLE `setup_posisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_universitas`
--

DROP TABLE IF EXISTS `setup_universitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_universitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `singkatan` varchar(10) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_universitas`
--

LOCK TABLES `setup_universitas` WRITE;
/*!40000 ALTER TABLE `setup_universitas` DISABLE KEYS */;
INSERT INTO `setup_universitas` VALUES (1,'Institut Pertanian Bogor','IPB',NULL,NULL),(2,'Institut Teknologi Bandung','ITB',NULL,NULL),(3,'Institut Teknologi Nasional ','ITN',NULL,NULL),(4,'Institut Teknologi Sepuluh Nopember','ITSN',NULL,NULL),(5,'Universitas Airlangga',NULL,NULL,NULL),(6,'Universitas Atma Jaya Yogyakarta ',NULL,NULL,NULL),(7,'Universitas Bina Nusantara',NULL,NULL,NULL),(8,'Universitas Brawijaya',NULL,NULL,NULL),(9,'Universitas Diponegoro',NULL,NULL,NULL),(10,'Universitas Gadjah Mada',NULL,NULL,NULL),(11,'Universitas Hasanuddin',NULL,NULL,NULL),(12,'Universitas Indonesia','UI',NULL,NULL),(13,'Universitas Islam Indonesia ',NULL,NULL,NULL),(14,'Universitas Katolik Parahyangan ',NULL,NULL,NULL),(15,'Universitas Kristen Petra ',NULL,NULL,NULL),(16,'Universitas Kristen Satya Wacana',NULL,NULL,NULL),(17,'Universitas Merdeka Malang ',NULL,NULL,NULL),(18,'Universitas Muhammadiyah Malang',NULL,NULL,NULL),(19,'Universitas Negeri Yogyakarta',NULL,NULL,NULL),(20,'Universitas Padjadjaran',NULL,NULL,NULL),(21,'Universitas Sanata Dharma ',NULL,NULL,NULL),(22,'Universitas Surabaya ',NULL,NULL,NULL),(23,'Universitas Telkom',NULL,NULL,NULL),(24,'Universitas Trisakti',NULL,NULL,NULL);
/*!40000 ALTER TABLE `setup_universitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,NULL,1268889823,1531475131,1,'Admin','istrator','ADMIN','0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1,1),(2,1,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-16  8:42:55
