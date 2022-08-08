CREATE DATABASE  IF NOT EXISTS `muo-db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `muo-db`;
-- MySQL dump 10.13  Distrib 5.7.38, for Win64 (x86_64)
--
-- Host: localhost    Database: muo-db
-- ------------------------------------------------------
-- Server version	5.7.38-log

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
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(255) DEFAULT NULL,
  `id_exposicion` int(11) DEFAULT NULL,
  `id_usuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exposicion_idx` (`id_exposicion`),
  KEY `fk_usuario_idx` (`id_usuarios`),
  CONSTRAINT `fk_exposicion` FOREIGN KEY (`id_exposicion`) REFERENCES `exposiciones` (`id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exposiciones`
--

DROP TABLE IF EXISTS `exposiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exposiciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `informacion` varchar(45) DEFAULT NULL,
  `id_museos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_museosId_idx` (`id_museos`),
  CONSTRAINT `fk_museosId` FOREIGN KEY (`id_museos`) REFERENCES `museos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exposiciones`
--

LOCK TABLES `exposiciones` WRITE;
/*!40000 ALTER TABLE `exposiciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `exposiciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritosusuarios`
--

DROP TABLE IF EXISTS `favoritosusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoritosusuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_exposicion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_idx` (`id_usuario`),
  KEY `fk_exposicion_idx` (`id_exposicion`),
  CONSTRAINT `fk_exposicion_id` FOREIGN KEY (`id_exposicion`) REFERENCES `exposiciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritosusuarios`
--

LOCK TABLES `favoritosusuarios` WRITE;
/*!40000 ALTER TABLE `favoritosusuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `favoritosusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `museos`
--

DROP TABLE IF EXISTS `museos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `museos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `museos`
--

LOCK TABLES `museos` WRITE;
/*!40000 ALTER TABLE `museos` DISABLE KEYS */;
/*!40000 ALTER TABLE `museos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passwordcode`
--

DROP TABLE IF EXISTS `passwordcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passwordcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `limit_time` datetime DEFAULT NULL,
  `resend_code` datetime DEFAULT NULL,
  `passToken` varchar(16) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_password_code` (`user_id`),
  CONSTRAINT `fk_password_code` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwordcode`
--

LOCK TABLES `passwordcode` WRITE;
/*!40000 ALTER TABLE `passwordcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `passwordcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'usuario'),(2,'admin');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `verifyToken` varchar(45) DEFAULT NULL,
  `disponible_resend` datetime DEFAULT NULL,
  `emailToken` varchar(16) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rol_idx` (`id_rol`),
  CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (35,'gerardo.saz120@gmail.com','123','asdas','dasdasds','2ab106e3c4bbc4908f1eb65cd4459931','2022-08-08 00:56:33','c8892edae8172c5b',1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-08  1:40:49
