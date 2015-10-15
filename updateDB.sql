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

ALTER TABLE `PAQUETES_NOMBRES` ADD `PAQ_EVENTO` int(11);

/*ALTER TABLE `admin_users` DROP `paquete`;*/;


DROP TABLE IF EXISTS `AXP_ADMINXPAQUETE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AXP_ADMINXPAQUETE` (
  `AXP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AXP_ADMIN` mediumint(8) unsigned  NOT NULL,
  `AXP_PAQUETE` int(11) NOT NULL,
  PRIMARY KEY (`AXP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------
--  Procedure structure for `AB_DESCONTAR_MAX`
-- ----------------------------
DROP PROCEDURE IF EXISTS `AB_DESCONTAR_MAX`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AB_DESCONTAR_MAX`(
pUSER_ID INT
,pTIPO INT
)
BEGIN

  DECLARE vRESPUESTA INTEGER;
    DECLARE vCOMENTARIO VARCHAR(127);
  DECLARE pVAR INT;
  DECLARE pPAQ_MONTO_PREMIUN INT;
  DECLARE pPAQ_MONTO_BASICO INT;
  declare pPAQ_MONTO_PREMIUN_CATEGORIA  INT;
  DECLARE pPAQ_ID INT;
  DECLARE pVARGRANDES INT;
  DECLARE pVARCHICAS INT;

    SET vRESPUESTA = 0;
    SET vCOMENTARIO = 'TODO OK';

    IF pUSER_ID IS NULL
    THEN
        SET vRESPUESTA = 100;
        SET vCOMENTARIO = 'EL pUSER_ID NO PUEDE SER NULL';
    END IF;


IF NOT EXISTS (SELECT 1 FROM admin_users WHERE id=pUSER_ID AND active=1)
THEN

    SET vRESPUESTA = 101;
        SET vCOMENTARIO = 'NO EXISTE EL USUARIO CON EL pUSER_ID ';


END IF;


SELECT paquete INTO pPAQ_ID FROM admin_users WHERE id=pUSER_ID;


IF NOT EXISTS (SELECT 1 FROM PAQUETES_NOMBRES WHERE PAQ_ID=pPAQ_ID )
THEN

    SET vRESPUESTA = 101;
        SET vCOMENTARIO = 'NO EXISTE EL PAQUETE INGRESADO CON EL pUSER_ID ';


END IF;





SELECT COUNT(*) INTO pVAR from PRO_PROMOCIONES WHERE PRO_SRC_ID=pTIPO
AND PRO_USER_CREADOR=pUSER_ID;




SELECT PAQ_MONTO_PREMIUN,PAQ_MONTO_BASICO,PAQ_MONTO_PREMIUN_CATEGORIA
INTO pPAQ_MONTO_PREMIUN,pPAQ_MONTO_BASICO
,pPAQ_MONTO_PREMIUN_CATEGORIA

FROM PAQUETES_NOMBRES WHERE PAQ_ID=pPAQ_ID;


IF (pPAQ_MONTO_PREMIUN  <= pVAR) AND (pTIPO=2)
THEN
    SET vRESPUESTA = 120;
        SET vCOMENTARIO = 'EL USUARIO SUPERÓ EL MAXIMO DE PROMOCIONES PREMIUN A CARGAR ';

END IF;


IF (pPAQ_MONTO_PREMIUN_CATEGORIA  <= pVAR ) AND (pTIPO=3)
THEN
    SET vRESPUESTA = 121;
        SET vCOMENTARIO = 'EL USUARIO SUPERÓ EL MAXIMO DE PROMOCIONES A CARGAR POR CATEGORIA PREMIUN ';

END IF;



IF (pPAQ_MONTO_BASICO <= pVAR ) AND (pTIPO=1)
THEN
    SET vRESPUESTA = 130;
        SET vCOMENTARIO = 'EL USUARIO SUPERÓ EL MAXIMO DE PROMOCIONES BASICAS A CARGAR ';

END IF;




 IF vRESPUESTA = 0
    THEN


IF (pTIPO=2)
THEN

INSERT INTO CONTROL_PAQUETE (PAQ_ID,USER_ID,CON_MONTO_PREMIUN,CON_MONTO_BASICO)
VALUES (pPAQ_ID,pUSER_ID,1,0);

    SET vRESPUESTA = 0;


END IF;

IF (pTIPO=1)
THEN

INSERT INTO CONTROL_PAQUETE (PAQ_ID,USER_ID,CON_MONTO_PREMIUN,CON_MONTO_BASICO)
VALUES (pPAQ_ID,pUSER_ID,0,1);

SET vRESPUESTA = 0;




END IF;

 SELECT vRESPUESTA AS RESPUESTA
            ,vCOMENTARIO AS COMENTARIO;
ELSE


 SELECT vRESPUESTA AS RESPUESTA
            ,vCOMENTARIO AS COMENTARIO;





END IF;









END
 ;;
delimiter ;

