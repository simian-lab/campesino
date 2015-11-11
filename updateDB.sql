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

ALTER TABLE EVE_EVENTOS ADD EVE_PREFIJO varchar(5);

-- ----------------------------
--  Procedure structure for `AB_DESCONTAR_MAX`
-- ----------------------------
DROP PROCEDURE IF EXISTS `AB_DESCONTAR_MAX`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AB_DESCONTAR_MAX`(
pUSER_ID INT
,pTIPO INT
,pEVE INT
)
BEGIN

  DECLARE vRESPUESTA INTEGER;
    DECLARE vCOMENTARIO VARCHAR(127);
  DECLARE pVAR INT;
  DECLARE pEVEN VARCHAR(127);
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


SELECT EVE_NOMBRE INTO pEVEN FROM EVE_EVENTOS WHERE EVE_ID=pEVE;

SELECT AXP_PAQUETE INTO pPAQ_ID FROM AXP_ADMINXPAQUETE INNER JOIN PAQUETES_NOMBRES ON PAQUETES_NOMBRES.PAQ_ID=AXP_ADMINXPAQUETE.AXP_PAQUETE WHERE AXP_ADMIN=pUSER_ID AND PAQ_EVENTO=pEVE;

IF NOT EXISTS (SELECT 1 FROM PAQUETES_NOMBRES WHERE PAQ_ID=pPAQ_ID )
THEN

    SET vRESPUESTA = 101;
        SET vCOMENTARIO = CONCAT('Esta Promocion no se puede agregar, favor comunicar con atencion al cliente para validar sus paquetes asociados a ',pEVEN);
END IF;




SELECT COUNT(*) INTO pVAR from EXP_EVENTOXPROMOCION INNER JOIN PRO_PROMOCIONES ON PRO_PROMOCIONES.PRO_ID=EXP_EVENTOXPROMOCION.EXP_PROMOCION WHERE PRO_SRC_ID=pTIPO AND PRO_USER_CREADOR=pUSER_ID AND EXP_EVENTO=pEVE;




SELECT PAQ_MONTO_PREMIUN,PAQ_MONTO_BASICO,PAQ_MONTO_PREMIUN_CATEGORIA
INTO pPAQ_MONTO_PREMIUN,pPAQ_MONTO_BASICO
,pPAQ_MONTO_PREMIUN_CATEGORIA

FROM PAQUETES_NOMBRES WHERE PAQ_ID=pPAQ_ID;


IF (pPAQ_MONTO_PREMIUN  <= pVAR) AND (pTIPO=2)
THEN
    SET vRESPUESTA = 120;
        SET vCOMENTARIO = CONCAT('EL USUARIO SUPERO EL MAXIMO DE PROMOCIONES PREMIUN A CARGAR PARA EL EVENTO ',pEVEN);

END IF;


IF (pPAQ_MONTO_PREMIUN_CATEGORIA  <= pVAR ) AND (pTIPO=3)
THEN
    SET vRESPUESTA = 121;
        SET vCOMENTARIO = CONCAT('EL USUARIO SUPERO EL MAXIMO DE PROMOCIONES A CARGAR POR CATEGORIA PREMIUN PARA EL EVENTO ',pEVEN);

END IF;



IF (pPAQ_MONTO_BASICO <= pVAR ) AND (pTIPO=1)
THEN
    SET vRESPUESTA = 130;
        SET vCOMENTARIO = CONCAT('EL USUARIO SUPERO EL MAXIMO DE PROMOCIONES BASICAS A CARGAR PARA EL EVENTO ',pEVEN);

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

/**Vista para el Reporteador**/

/*Vista Paquetes*/
CREATE
    ALGORITHM = UNDEFINED
    SQL SECURITY DEFINER
VIEW `v_reporteador_paquetes` AS
    SELECT
        `admin_users`.`id` AS `USER_ID`,
        `admin_users`.`username` AS `username`,
        `PAQUETES_NOMBRES`.`PAQ_ID` AS `PAQ_ID`,
        `PAQUETES_NOMBRES`.`PAQ_NOMBRE` AS `PAQ_NOMBRE`,
        `PAQUETES_NOMBRES`.`PAQ_MONTO_BASICO` AS `PAQ_MONTO_BASICO`,
        `PAQUETES_NOMBRES`.`PAQ_MONTO_PREMIUN` AS `PAQ_MONTO_PREMIUN`,
        `PAQUETES_NOMBRES`.`PAQ_MONTO_PREMIUN_CATEGORIA` AS `PAQ_MONTO_PREMIUN_CATEGORIA`
    FROM
        ((`AXP_ADMINXPAQUETE`
        JOIN `admin_users` ON ((`admin_users`.`id` = `AXP_ADMINXPAQUETE`.`AXP_ADMIN`)))
        JOIN `PAQUETES_NOMBRES` ON ((`PAQUETES_NOMBRES`.`PAQ_ID` = `AXP_ADMINXPAQUETE`.`AXP_PAQUETE`)))

/*vista de Promociones*/
    CREATE
    ALGORITHM = UNDEFINED
    SQL SECURITY DEFINER
VIEW `v_reporteador_promociones` AS
    SELECT
        CONCAT(`PAT_PATROCINADORES`.`OMNITURE_PRE`,
                `PRO_PROMOCIONES`.`PRO_ID`) AS `ID`,
        `PRO_PROMOCIONES`.`PRO_NOMBRE` AS `PRO_NOMBRE_t`,
        `PRO_PROMOCIONES`.`PRO_DESCRIPCION` AS `PRO_DESCRIPCION_t`,
        `PRO_PROMOCIONES`.`PRO_TIPO_MONEDA` AS `PRO_TIPO_MONEDA_t`,
        `PRO_PROMOCIONES`.`PRO_PRECIO_INICIAL` AS `PRO_PRECIO_INICIAL_i`,
        `PRO_PROMOCIONES`.`PRO_PRECIO_FINAL` AS `PRO_PRECIO_FINAL_i`,
        `PRO_PROMOCIONES`.`PRO_DESCUENTO` AS `PRO_DESCUENTO_i`,
        `PRO_PROMOCIONES`.`VISIBILITY` AS `VISIBILITY_i`,
        `PRO_PROMOCIONES`.`PRO_FECHA` AS `PRO_FECHA_t`,
        `PRO_PROMOCIONES`.`PRO_AUTOR` AS `PRO_AUTOR_s`,
        `PRO_PROMOCIONES`.`PRO_LOGO_PREMIUM` AS `PRO_LOGO_PREMIUM_t`,
        `PRO_PROMOCIONES`.`PRO_LOGO_GENERAL` AS `PRO_LOGO_GENERAL_t`,
        `PRO_PROMOCIONES`.`CAT_ID` AS `TAX_ID_i`,
        `CAT_CATEGORIA`.`CAT_NOMBRE` AS `TAX_NAME_s`,
        `PRO_PROMOCIONES`.`MAR_ID` AS `MAR_ID_i`,
        `MAR_MARCAS`.`MAR_NOMBRE` AS `MAR_NOMBRE_s`,
        CONCAT(`PAT_PATROCINADORES`.`OMNITURE_PRE`,
                `PAT_PATROCINADORES`.`OMNITURE_ID`) AS `TIE_ID_s`,
        `PAT_PATROCINADORES`.`PAT_NOMBRE` AS `TIE_NOMBRE_s`,
        `PAT_PATROCINADORES`.`PAT_LOGO` AS `TIE_IMAGEN_LOGO_t`,
        `PAT_PATROCINADORES`.`PAT_URL_EVENT` AS `TIE_URL_t`,
        `PRO_PROMOCIONES`.`PRO_USER_CREADOR` AS `USER_ID`
    FROM
        ((((`PRO_PROMOCIONES`
        JOIN `MAR_MARCAS` ON ((`MAR_MARCAS`.`MAR_ID` = `PRO_PROMOCIONES`.`MAR_ID`)))
        JOIN `CAT_CATEGORIA` ON ((`CAT_CATEGORIA`.`CAT_ID` = `PRO_PROMOCIONES`.`CAT_ID`)))
        LEFT JOIN `SUB_SUBCATEGORIA` ON ((`SUB_SUBCATEGORIA`.`SUB_ID` = `PRO_PROMOCIONES`.`SUB_ID`)))
        LEFT JOIN `PAT_PATROCINADORES` ON ((`PAT_PATROCINADORES`.`PAT_ALIADO` = `PRO_PROMOCIONES`.`PRO_USER_CREADOR`))
/*CAMPO E INDICE ADICIONAL PARA IDENTIFICAR LOS CLIENTES EN OMNITURE, LOGOS*/
ALTER TABLE `PAT_PATROCINADORES`
ADD COLUMN `OMNITURE_ID` INT(11) NULL DEFAULT NULL COMMENT 'ID unico por cliente para Omniture',
ADD COLUMN `OMNITURE_PRE` VARCHAR(10) NULL DEFAULT NULL COMMENT 'Prefijo para concatenar con OMNITURE_ID',
ADD UNIQUE INDEX `omniture_id_unique` (`OMNITURE_ID` ASC)  COMMENT 'Evitar repetir el ID unique para lso clientes';
/*Vista de Promciones X Eventos*/
CREATE
    ALGORITHM = UNDEFINED
    SQL SECURITY DEFINER
VIEW `v_reporteador_eventos` AS
    SELECT
        CONCAT(`PAT_PATROCINADORES`.`OMNITURE_PRE`,
                `PRO_PROMOCIONES`.`PRO_ID`) AS `ID`,
        `EVE_EVENTOS`.`EVE_ID` AS `EVE_ID_i`,
        `EVE_EVENTOS`.`EVE_NOMBRE` AS `EVE_NOMBRE_s`
    FROM
        (((`PRO_PROMOCIONES`
        LEFT JOIN `PAT_PATROCINADORES` ON ((`PAT_PATROCINADORES`.`PAT_ALIADO` = `PRO_PROMOCIONES`.`PRO_USER_CREADOR`)))
        JOIN `EXP_EVENTOXPROMOCION` ON ((`EXP_EVENTOXPROMOCION`.`EXP_PROMOCION` = `PRO_PROMOCIONES`.`PRO_ID`)))
        JOIN `EVE_EVENTOS` ON ((`EVE_EVENTOS`.`EVE_ID` = `EXP_EVENTOXPROMOCION`.`EXP_EVENTO`)));


/* Vista para el reporte de promociones */
CREATE VIEW V_REPORTE_PROMOCIONES AS
SELECT
AXP_ID AS AXP_ID,
AXP_ADMIN AS PAT_ID,
admin_users.username AS PAT_NOMBRE,
PAQUETES_NOMBRES.PAQ_NOMBRE AS PAQ_NOMBRE,
EVE_EVENTOS.EVE_NOMBRE AS EVE_NOMBRE,
PAQUETES_NOMBRES.PAQ_MONTO_PREMIUN AS PAQ_MONTO_PREMIUM,
COUNT(IF(PRO_PROMOCIONES.PRO_SRC_ID = 2, 1, NULL)) AS PAQ_CREADAS_PREMIUM,
COUNT(IF(PRO_PROMOCIONES.PRO_SRC_ID = 2 AND PRO_PROMOCIONES.AUTORIZADO = 1, 1, NULL)) AS PAQ_APROBADAS_PREMIUM,
PAQUETES_NOMBRES.PAQ_MONTO_PREMIUN_CATEGORIA AS PAQ_MONTO_PREMIUM_CATEGORIA,
COUNT(IF(PRO_PROMOCIONES.PRO_SRC_ID = 3, 1, NULL)) AS PAQ_CREADAS_PREMIUM_CATEGORIA,
COUNT(IF(PRO_PROMOCIONES.PRO_SRC_ID = 3 AND PRO_PROMOCIONES.AUTORIZADO = 1, 1, NULL)) AS PAQ_APROBADAS_PREMIUM_CATEGORIA,
PAQUETES_NOMBRES.PAQ_MONTO_BASICO AS PAQ_MONTO_GENERAL,
COUNT(IF(PRO_PROMOCIONES.PRO_SRC_ID = 1, 1, NULL)) AS PAQ_CREADAS_GENERAL,
COUNT(IF(PRO_PROMOCIONES.PRO_SRC_ID = 1 AND PRO_PROMOCIONES.AUTORIZADO = 1, 1, NULL)) AS PAQ_APROBADAS_GENERAL
FROM AXP_ADMINXPAQUETE
INNER JOIN admin_users ON AXP_ADMINXPAQUETE.AXP_ADMIN = admin_users.id
INNER JOIN PRO_PROMOCIONES ON AXP_ADMINXPAQUETE.AXP_ADMIN = PRO_PROMOCIONES.PRO_USER_CREADOR
INNER JOIN PAQUETES_NOMBRES ON AXP_ADMINXPAQUETE.AXP_PAQUETE = PAQUETES_NOMBRES.PAQ_ID
INNER JOIN EVE_EVENTOS ON PAQUETES_NOMBRES.PAQ_EVENTO = EVE_EVENTOS.EVE_ID
INNER JOIN EXP_EVENTOXPROMOCION ON PRO_PROMOCIONES.PRO_ID = EXP_EVENTOXPROMOCION.EXP_PROMOCION
WHERE PAQUETES_NOMBRES.PAQ_EVENTO = EXP_EVENTOXPROMOCION.EXP_EVENTO
GROUP BY PAT_ID, EVE_EVENTOS.EVE_NOMBRE;

/* Creo el enlace del menú para el reporte */
INSERT INTO `admin_process` (`id`, `process`, `method`, `process_id`, `menu`, `orden`, `style`)
VALUES
  (78, 'Reporte', 'main/reporte_promociones', 30, 1, 1, NULL);

/* Agrego el enlace del menú para aliados y super usuarios. */
INSERT INTO `admin_process_groups` (`id`, `process_id`, `group_id`)
VALUES
  (2012, 78, 4);
INSERT INTO `admin_process_groups` (`id`, `process_id`, `group_id`)
VALUES
  (2013, 78, 5);
INSERT INTO `admin_process_groups` (`process_id`, `group_id`)
VALUES
  (78, 3);

/* Creo los enlaces de Eventos para el menú */
INSERT INTO `admin_process` (`id`, `process`, `method`, `process_id`, `menu`, `orden`, `style`)
VALUES
  (79, 'EVENTOS', '', NULL, 1, 1, NULL);
INSERT INTO `admin_process` (`id`, `process`, `method`, `process_id`, `menu`, `orden`, `style`)
VALUES
  (80, 'Administrar eventos', 'main/eventos', 79, 1, 106, NULL);

/* Agrego los enlaces de Eventos al menú del super usuario */
INSERT INTO `admin_process_groups` (`id`, `process_id`, `group_id`)
VALUES
  (2014, 79, 4);
INSERT INTO `admin_process_groups` (`id`, `process_id`, `group_id`)
VALUES
  (2015, 80, 4);

