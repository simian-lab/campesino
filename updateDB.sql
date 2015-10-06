DROP TABLE IF EXISTS `EVE_EVENTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EVE_EVENTOS` (
  `EVE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EVE_NOMBRE` varchar(70) DEFAULT NULL,
  `EVE_DESCRIPCION` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`EVE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EVE_EVENTOS`
--

LOCK TABLES `EVE_EVENTOS` WRITE;
/*!40000 ALTER TABLE `EVE_EVENTOS` DISABLE KEYS */;
INSERT INTO `EVE_EVENTOS` VALUES (1,'cyberlunes','cyberlunes');
INSERT INTO `EVE_EVENTOS` VALUES (2,'black_friday','black friday');
INSERT INTO `EVE_EVENTOS` VALUES (3,'loe_navidad','lo encontraste navidad');
/*!40000 ALTER TABLE `EVE_EVENTOS` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `EXP_EVENTOXPROMOCION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EXP_EVENTOXPROMOCION` (
  `EXP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EXP_EVENTO` int(11) NOT NULL,
  `EXP_PROMOCION` int(11) NOT NULL,
  PRIMARY KEY (`EXP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;