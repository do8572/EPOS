-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: localhost    Database: epos
-- ------------------------------------------------------
-- Server version	5.7.31-0ubuntu0.18.04.1

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
-- Table structure for table `Artikli`
--

DROP TABLE IF EXISTS `Artikli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Artikli` (
  `idArtikel` int(11) NOT NULL AUTO_INCREMENT,
  `idProdajalec` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `opis` text,
  `cena` double DEFAULT NULL,
  `zaloga` int(11) DEFAULT NULL,
  `stanje` enum('aktiviran','deaktiviran') NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idArtikel`),
  KEY `fk_Artikli_Uporabniki1_idx` (`idProdajalec`),
  CONSTRAINT `fk_Artikli_Uporabniki1` FOREIGN KEY (`idProdajalec`) REFERENCES `Uporabniki` (`idUporabnik`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Artikli`
--

LOCK TABLES `Artikli` WRITE;
/*!40000 ALTER TABLE `Artikli` DISABLE KEYS */;
INSERT INTO `Artikli` VALUES (1,12,'Printer Cannon Pixma 580','Black inkjet printer',63.28,NULL,'aktiviran',0),(2,12,'Nikkon DSLR 350','All purpose Camera',350.28,NULL,'aktiviran',0),(3,12,'Printer Cannon Pixma 580','Black inkjet printer',63.28,NULL,'aktiviran',0),(4,12,'Nikkon DSLR 350','All purpose Camera',350.28,NULL,'aktiviran',0),(5,12,'Razor keyboard','Super!',12.5,NULL,'aktiviran',0);
/*!40000 ALTER TABLE `Artikli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Narocila`
--

DROP TABLE IF EXISTS `Narocila`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Narocila` (
  `idNarocilo` int(11) NOT NULL AUTO_INCREMENT,
  `idStranka` int(11) NOT NULL,
  `datum_narocila` date DEFAULT NULL,
  `stanje` enum('neobdelano','potrjeno','preklicano','stornirano') NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `skupnaCena` double DEFAULT NULL,
  PRIMARY KEY (`idNarocilo`),
  UNIQUE KEY `idnarocila_UNIQUE` (`idNarocilo`),
  KEY `fk_Narocila_Uporabniki1_idx` (`idStranka`),
  CONSTRAINT `fk_Narocila_Uporabniki1` FOREIGN KEY (`idStranka`) REFERENCES `Uporabniki` (`idUporabnik`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Narocila`
--

LOCK TABLES `Narocila` WRITE;
/*!40000 ALTER TABLE `Narocila` DISABLE KEYS */;
INSERT INTO `Narocila` VALUES (1,2,'2020-07-31','stornirano',0,NULL),(2,2,'2020-07-31','preklicano',0,NULL),(3,2,'2020-07-31','potrjeno',0,NULL),(4,2,'2020-07-31','neobdelano',0,NULL),(5,2,'2020-08-15','neobdelano',0,NULL),(6,2,'2020-08-15','neobdelano',0,NULL);
/*!40000 ALTER TABLE `Narocila` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Narocila_has_Artikli`
--

DROP TABLE IF EXISTS `Narocila_has_Artikli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Narocila_has_Artikli` (
  `idNarocilo` int(11) NOT NULL,
  `idArtikel` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `cena` double NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`idNarocilo`,`idArtikel`),
  KEY `fk_Narocila_has_Artikli_Artikli1_idx` (`idArtikel`),
  KEY `fk_Narocila_has_Artikli_Narocila1_idx` (`idNarocilo`),
  CONSTRAINT `fk_Narocila_has_Artikli_Artikli1` FOREIGN KEY (`idArtikel`) REFERENCES `Artikli` (`idArtikel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Narocila_has_Artikli_Narocila1` FOREIGN KEY (`idNarocilo`) REFERENCES `Narocila` (`idNarocilo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Narocila_has_Artikli`
--

LOCK TABLES `Narocila_has_Artikli` WRITE;
/*!40000 ALTER TABLE `Narocila_has_Artikli` DISABLE KEYS */;
INSERT INTO `Narocila_has_Artikli` VALUES (3,1,0,63.28,1),(3,2,0,350.28,1),(4,1,0,63.28,3),(5,3,0,63.28,4),(6,1,0,63.28,1);
/*!40000 ALTER TABLE `Narocila_has_Artikli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Uporabniki`
--

DROP TABLE IF EXISTS `Uporabniki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Uporabniki` (
  `idUporabnik` int(11) NOT NULL AUTO_INCREMENT,
  `vloga` enum('administrator','prodajalec','stranka') NOT NULL,
  `ime` varchar(45) NOT NULL,
  `priimek` varchar(45) NOT NULL,
  `elektronski naslov` varchar(45) NOT NULL,
  `geslo` varchar(60) NOT NULL,
  `naslov` varchar(45) DEFAULT NULL,
  `telefonska stevilka` varchar(45) DEFAULT NULL,
  `stanje` enum('aktiviran','deaktiviran') DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUporabnik`),
  UNIQUE KEY `idUporabniki_UNIQUE` (`idUporabnik`),
  UNIQUE KEY `elektronski naslov_UNIQUE` (`elektronski naslov`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Uporabniki`
--

LOCK TABLES `Uporabniki` WRITE;
/*!40000 ALTER TABLE `Uporabniki` DISABLE KEYS */;
INSERT INTO `Uporabniki` VALUES (1,'administrator','david','ocepek','do8572@student.uni-lj.si','$2y$10$o7GSCbrvicxXGZUjyGCARe0WAKPMRWbkPfDcs8xrIUAFOVlUwsL/a',NULL,NULL,'aktiviran',0),(2,'stranka','Denis','Ocepek','denis@gmail.com','$2y$10$KdDWbUI4ZKaXjppohhJAzeCTNOpwTfxKZbCfnhFXYl6I4fDflvMcK','Vecna pot 11','070856391','aktiviran',0),(3,'stranka','Doris','Ocepek','doris@gmail.com','$2y$10$FWU9UM5hvL7vwuXOpf4zkeJLsPMkKwVNimQw4tN.bh3THgPo9KnO6','Vecna pot 11','070856391','aktiviran',0),(4,'stranka','Diona','Ocepek','diona@gmail.com','$2y$10$rVtVlGZAa.kFhHTqqRHxRuewVOx7OUI2jmycoaeVT.vKltck0cYje','Vecna pot 11','070856391','aktiviran',0),(10,'prodajalec','Ivan','Ocepek','ivan@gmail.com','$2y$10$t7LTV5S8HAMEuwHDxOvee.cIm/dlwjhS/B3ONM5IwJjr2Xwdeb8Wm',NULL,NULL,'aktiviran',0),(11,'prodajalec','Alexandra','Ocepek','alexandra@gmail.com','$2y$10$0xL7U3QNZ3OdUaB0FMYQfev70VqZJgsUBaU4e6sk2fjwPyKT7X1Rq',NULL,NULL,'aktiviran',0),(12,'prodajalec','Denis','Trcek','Denis.Trcek@fri.uni-lj.si','$2y$10$NGcHuO.GH1PE28N0HLkHK.xif24By.8hpA1PV2yldD497OweQdVIS','','','aktiviran',0),(13,'stranka','Jan','JOKOVIC','joko@gmail.com','$2y$10$dHNOEwRYpoPWhRO6FIjgoenH6aiOlQrSRMdWslLfBGSAOc4zIIXde','vsdfdsf ','02568359','aktiviran',0);
/*!40000 ALTER TABLE `Uporabniki` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-15 15:01:31
