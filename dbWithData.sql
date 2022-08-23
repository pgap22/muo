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
-- Table structure for table `categoriaeng`
--

DROP TABLE IF EXISTS `categoriaeng`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriaeng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoriaEn_idx` (`id_categoria`),
  CONSTRAINT `fk_categoriaEn` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriaeng`
--

LOCK TABLES `categoriaeng` WRITE;
/*!40000 ALTER TABLE `categoriaeng` DISABLE KEYS */;
INSERT INTO `categoriaeng` VALUES (1,'Art',1),(2,'History',2),(3,'Sculpture',3);
/*!40000 ALTER TABLE `categoriaeng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Arte'),(2,'Historia'),(3,'Escultura');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

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
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exposicion_idx` (`id_exposicion`),
  KEY `fk_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_exposicion` FOREIGN KEY (`id_exposicion`) REFERENCES `exposiciones` (`id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (1,'Interesante...',2,1);
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exposeng`
--

DROP TABLE IF EXISTS `exposeng`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exposeng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informacion` varchar(550) DEFAULT NULL,
  `nombre` varchar(120) DEFAULT NULL,
  `id_expo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_expoID_idx` (`id_expo`),
  CONSTRAINT `fk_expoID` FOREIGN KEY (`id_expo`) REFERENCES `exposiciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exposeng`
--

LOCK TABLES `exposeng` WRITE;
/*!40000 ALTER TABLE `exposeng` DISABLE KEYS */;
INSERT INTO `exposeng` VALUES (1,'The mural, a stone mosaic, represents freedom and is symbolized by a naked man looking up with his arms raised. This figure is known as El ChulÃ³n and is an urban landmark. The stones that make up the mosaic are of natural colors and were collected nationally. ','Revolution Monument',1),(2,'The volcaneÃ±a is inspired by the strong and feisty women who come down from the volcano to sell flowers to the city.','Sculpture by the artist (Titi Escalante).',2);
/*!40000 ALTER TABLE `exposeng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exposiciones`
--

DROP TABLE IF EXISTS `exposiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exposiciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) DEFAULT NULL,
  `informacion` varchar(550) DEFAULT NULL,
  `id_museos` int(11) DEFAULT NULL,
  `id_categorias` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_museosId_idx` (`id_museos`),
  KEY `fk_categoriaId_idx` (`id_categorias`),
  CONSTRAINT `fk_categoriaId` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_museosId` FOREIGN KEY (`id_museos`) REFERENCES `museos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exposiciones`
--

LOCK TABLES `exposiciones` WRITE;
/*!40000 ALTER TABLE `exposiciones` DISABLE KEYS */;
INSERT INTO `exposiciones` VALUES (1,'Monumento a la RevoluciÃ³n','El mural, un mosaico en piedra, representa la libertad y es simbolizada por un hombre desnudo mirando hacia arriba y con los brazos levantados. Esta figura es conocida como El ChulÃ³n y constituye un punto de referencia urbana. Las piedras que forman el mosaico son de colores naturales y fueron recolectadas a nivel nacional. ',2,1),(2,'Escultura de la artista plÃ¡stica (Titi Escalante).','La volcaneÃ±a estÃ¡ inspirada en las mujeres fuertes y luchadoras que bajan del volcÃ¡n a vender flores a la ciudad.',2,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritosusuarios`
--

LOCK TABLES `favoritosusuarios` WRITE;
/*!40000 ALTER TABLE `favoritosusuarios` DISABLE KEYS */;
INSERT INTO `favoritosusuarios` VALUES (1,1,1),(3,1,2);
/*!40000 ALTER TABLE `favoritosusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenesexpo`
--

DROP TABLE IF EXISTS `imagenesexpo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenesexpo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rutaImagen` varchar(120) DEFAULT NULL,
  `id_exposicion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_expoImg_id_idx` (`id_exposicion`),
  CONSTRAINT `fk_expoImg_id` FOREIGN KEY (`id_exposicion`) REFERENCES `exposiciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenesexpo`
--

LOCK TABLES `imagenesexpo` WRITE;
/*!40000 ALTER TABLE `imagenesexpo` DISABLE KEYS */;
INSERT INTO `imagenesexpo` VALUES (1,'/expoImg/6d16f87093428fa44fb5aad5a196e6fe.jpg',1),(2,'/expoImg/2230240451ef6377022bd32e542185a8.jpg',1),(3,'/expoImg/37233d9564fbef376b61cbc3c038de2f.jpg',1),(4,'/expoImg/206b3788b605025bb64298d82c1e31c6.jpg',2),(5,'/expoImg/71fc0f08f63bd079b0ad004ef2e0772b.jpg',2),(6,'/expoImg/40f07eb53d0f19f05fb37c5ac0ffda57.jpg',2),(7,'/expoImg/810c4adceaa4d289a1b1bafe0bd53c15.jpg',2);
/*!40000 ALTER TABLE `imagenesexpo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `museos`
--

DROP TABLE IF EXISTS `museos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `museos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(155) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `imagen` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `museos`
--

LOCK TABLES `museos` WRITE;
/*!40000 ALTER TABLE `museos` DISABLE KEYS */;
INSERT INTO `museos` VALUES (1,'MUNA','El Museo Nacional de AntropologÃ­a tiene una larga tradiciÃ³n expositiva, conforme al carÃ¡cter patrimonial de sus colecciones; fue creado por Decreto Ejecutivo el 1 de febrero de 1883 y fundado el 9 de octubre del mismo aÃ±o. En un primer momento desarrollÃ³ una colecciÃ³n de diversidad biolÃ³gica y geolÃ³gica del paÃ­s, asÃ­ como productos manufacturados, bellas artes e historia. En 1945, fue designado con el nombre de David J. GuzmÃ¡n.','/museosImg/a9bc0dcf69dcd4d657578f68cfd63ac7.jpg'),(2,'MARTE','El Museo de Arte de El Salvador (MARTE) fue inaugurado el 22 de mayo de 2003. Es una instituciÃ³n privada, sin fines de lucro, cuyo funcionamiento es responsabilidad de la AsociaciÃ³n Museo de Arte de El Salvador, la cual se creÃ³ con ese propÃ³sito y cuya personerÃ­a jurÃ­dica se obtuvo mediante Acuerdo Ejecutivo No. 338 publicado en el Diario Oficial 89 Tomo 347 del 6 de mayo del aÃ±o 2000. ','/museosImg/45df10d059d0b543ab111a2bce0571e7.jpg'),(3,'Museo FORMA de El Salvador','Fundado en 1983, tras la iniciativa de la prestigiosa pintora Julia DÃ­az primera dama en la profesiÃ³n, el proyecto FORMA se planteo como el misionero para resguardar con celo y altruismo las creaciones salvadoreÃ±as con el fin de legarlas a las futuras generaciones. Por otra parte su fundadora tenÃ­a como precepto dedicar salas o galerÃ­as (no importa su tÃ©rmino o funciÃ³n arquitectÃ³nica) para la incorporaciÃ³n de exposiciones temporales de nuevos talentos.','/museosImg/850fb91143956640bc1896f2d719664e.jpg'),(4,'MUTE','El Museo TecleÃ±o, tambiÃ©n conocido como MUTE, es un sitio que atesora una particularidad histÃ³ricamente invaluable: Fue una penitenciarÃ­a construida en 1902 por el arquitecto JosÃ© JerÃ©z, quien diseÃ±Ã³ las mÃ¡s destacables infraestructuras del municipio de Santa Tecla. Durante la guerra civil salvadoreÃ±a, funcionÃ³ como cuartel del ejÃ©rcito y como centro de detenciÃ³n de presos polÃ­ticos, quienes sufrieron torturas o ejecuciones. ','/museosImg/70a92309610c906edc6301b93bfd4bf4.jpg'),(5,'MUA','El Museo Universitario de AntropologÃ­a de la Universidad TecnolÃ³gica de El Salvador, cumpliendo con el propÃ³sito de difusiÃ³n del patrimonio cultural que resguarda este recinto cultural universitario, pone a disposiciÃ³n para conocimiento pÃºblico, la semblanza sobre el inmueble y la colecciÃ³n que resguarda y exhibe actualmente dentro de sus instalaciones.','/museosImg/65c3654063a221d64e4eaab6032e1c1c.jpg');
/*!40000 ALTER TABLE `museos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `museoseng`
--

DROP TABLE IF EXISTS `museoseng`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `museoseng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(500) DEFAULT NULL,
  `id_museo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_museo_ID_idx` (`id_museo`),
  CONSTRAINT `fk_museo_ID` FOREIGN KEY (`id_museo`) REFERENCES `museos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `museoseng`
--

LOCK TABLES `museoseng` WRITE;
/*!40000 ALTER TABLE `museoseng` DISABLE KEYS */;
INSERT INTO `museoseng` VALUES (1,'The National Museum of Anthropology has a long exhibition tradition, in accordance with the patrimonial character of its collections; it was created by Executive Decree on February 1, 1883 and founded on October 9 of the same year. At first it developed a collection of biological and geological diversity of the country, as well as manufactured products, fine arts and history. In 1945, it was designated with the name of David J. GuzmÃ¡n.',1),(2,'The Museo de Arte de El Salvador (MARTE) was inaugurated on May 22, 2003. It is a private, non-profit institution, whose operation is the responsibility of the AsociaciÃ³n Museo de Arte de El Salvador, which was created for that purpose and whose legal status was obtained through Executive Agreement No. 338 published in the Official Gazette 89 Volume 347 of May 6, 2000. ',2),(3,'Founded in 1983, after the initiative of the prestigious painter Julia Diaz first lady in the profession, the FORMA project was raised as the missionary to safeguard with zeal and altruism the Salvadoran creations in order to bequeath them to future generations. On the other hand, its founder had as a precept to dedicate rooms or galleries (no matter its term or architectural function) for the incorporation of temporary exhibitions of new talents.',3),(4,'The Museo TecleÃ±o, also known as MUTE, is a site that treasures a historically invaluable particularity: It was a penitentiary built in 1902 by the architect JosÃ© JerÃ©z, who designed the most outstanding infrastructures of the municipality of Santa Tecla. During the Salvadoran civil war, it functioned as an army barracks and as a detention center for political prisoners, who were tortured or executed.',4),(5,'The University Museum of Anthropology of the Technological University of El Salvador, in compliance with the purpose of disseminating the cultural heritage that protects this university cultural precinct, makes available for public knowledge, the semblance of the building and the collection that currently protects and exhibits within its facilities.',5);
/*!40000 ALTER TABLE `museoseng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passwordcode`
--

DROP TABLE IF EXISTS `passwordcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passwordcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(5) DEFAULT NULL,
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
  `isAdmin` tinyint(1) NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'gerardo.saz120@gmail.com','$2y$10$siTJJ.45/yxOUUPnPooiB.ek6S.28S6B1JhNoOGKuoDQO4DytID8m','Gerardo','Saz','50a9197119df081852e7df68a4fbece6','2022-08-22 07:08:05','171c73fb2270e081',0,1),(2,'admin@muo.com','$2y$10$ypBRjB75i4OMOQ1Xb5TP2e.A0s8j2akZjLBX6LcvUTn/lqwjW/gXm','Admin','MUO','2eb47789455e9c060117875d336e2309','2022-08-22 07:12:26','b08bd6de650c7d4b',1,1);
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

-- Dump completed on 2022-08-22 22:24:19
