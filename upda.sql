/* Añadimos la columna de URL de Evento */
ALTER TABLE PAT_PATROCINADORES ADD PAT_URL_EVENT VARCHAR(155);

/* Añadimos una columna para indicar el paquete (oro, plata, etc.) del patrocinador */
ALTER TABLE PAT_PATROCINADORES ADD PAT_PAQUETE INTEGER;

/* Añadimos una nueva columna para asociar los patrocinadores a los aliados */
ALTER TABLE PAT_PATROCINADORES ADD PAT_ALIADO INTEGER;

/* Añadimos una nueva columna para guardar el hash de la URL del evento */
ALTER TABLE PAT_PATROCINADORES ADD PAT_HASH_URL_EVENT VARCHAR(255);

/* También asociamos los aliados con un usuario administrador */
ALTER TABLE admin_users ADD ally_id INTEGER;

/* Esto lo hacemos para crear el menú en el administrador. (PATROCINADORES) */
INSERT INTO admin_process_groups (process_id, group_id) VALUES (41, 5);

/* Creamos un submenú */
INSERT INTO admin_process (process, method, process_id, menu, orden) VALUES ('Administrar patrocinador', 'main/aliado', '41', '1', '16');

/* Aquí añadimos el submenú que acabamos de crear al administrador  */
INSERT INTO admin_process_groups (process_id, group_id) VALUES (77, 5);

/* Existía un Stored Procedure que trae los patrocinadores, lo borramos para poder crearlo nuevamente (los SPs no se pueden editar) */
DROP PROCEDURE `AB_PATROCINADORES_GET`;

/* El nuevo SP trae la información nueva de URL de evento y ID de Paquete. */
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AB_PATROCINADORES_GET`()
BEGIN

DECLARE vRESPUESTA INTEGER;
DECLARE vCOMENTARIO VARCHAR(127);

SET vRESPUESTA = 0;
SET vCOMENTARIO = 'TODO OK';

IF vRESPUESTA = 0
    THEN

    SELECT vRESPUESTA AS RESPUESTA,vCOMENTARIO AS COMENTARIO,PAT_ID,PAT_NOMBRE,PAT_LOGO,PAT_IDENTIFICADOR,PAT_FECHA,PAT_URL,PAT_PAQUETE,PAT_URL_EVENT, PAT_HASH_URL_EVENT
    FROM PAT_PATROCINADORES WHERE VISIBILITY=1 AND AUTORIZADO=1 ;

    END IF;

END;;
DELIMITER ;

/* Agregamos el campo Ciudad para el formulario de registro. */
ALTER TABLE US_USUARIOS_PARTICIPACION ADD US_CIUDAD VARCHAR(100) AFTER US_CARGO;

/* Borramos el procedimiento que no inserta el campo Ciudad */
DROP PROCEDURE AB_US_USUARIOS_PARTICIPACION_SET;

/* Creamos el procedimiento que acabamos de borrar pero esta vez sí tiene en cuenta el campo Ciudad. */
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AB_US_USUARIOS_PARTICIPACION_SET`(
pUS_EMPRESA VARCHAR (255)
,pUS_NOMBRE VARCHAR (255)
,pUS_CARGO VARCHAR (255)
,pUS_CIUDAD VARCHAR (100)
,pUS_EMAIL VARCHAR (255)
,pUS_TELEFONO_MOVIL VARCHAR (255)
,pUS_TELEFONO_OFICINA VARCHAR (255)
,pUS_URL_TIENDA VARCHAR (255)
,pUS_COMENTARIOS VARCHAR (255)
)
BEGIN

DECLARE vRESPUESTA INTEGER;
DECLARE vCOMENTARIO VARCHAR(127);

SET vRESPUESTA = 0;
SET vCOMENTARIO = 'TODO OK';

IF pUS_EMPRESA IS NULL
THEN
SET vRESPUESTA = 100;
SET vCOMENTARIO = 'EL pUS_EMPRESA NO PUEDE SER NULL';
END IF;

IF pUS_NOMBRE IS NULL
THEN
SET vRESPUESTA = 101;
SET vCOMENTARIO = 'EL pUS_NOMBRE NO PUEDE SER NULL';
END IF;

IF pUS_CARGO IS NULL
THEN
SET vRESPUESTA = 102;
SET vCOMENTARIO = 'EL pUS_CARGO NO PUEDE SER NULL';
END IF;

IF pUS_CIUDAD IS NULL
THEN
SET vRESPUESTA = 103;
SET vCOMENTARIO = 'EL pUS_CIUDAD NO PUEDE SER NULL';
END IF;

IF pUS_EMAIL IS NULL
THEN
SET vRESPUESTA = 104;
SET vCOMENTARIO = 'EL pUS_EMAIL NO PUEDE SER NULL';
END IF;

IF pUS_TELEFONO_MOVIL IS NULL
THEN
SET vRESPUESTA = 105;
SET vCOMENTARIO = 'EL pUS_TELEFONO_MOVIL NO PUEDE SER NULL';
END IF;

IF pUS_TELEFONO_OFICINA IS NULL
THEN
SET vRESPUESTA = 106;
SET vCOMENTARIO = 'EL pUS_TELEFONO_OFICINA NO PUEDE SER NULL';
END IF;

IF pUS_URL_TIENDA IS NULL
THEN
SET vRESPUESTA = 107;
SET vCOMENTARIO = 'EL pUS_URL_TIENDA NO PUEDE SER NULL';
END IF;

IF pUS_COMENTARIOS IS NULL
THEN
SET vRESPUESTA = 108;
SET vCOMENTARIO = 'EL pUS_COMENTARIOS NO PUEDE SER NULL';
END IF;

IF vRESPUESTA = 0
THEN

INSERT INTO US_USUARIOS_PARTICIPACION 
(US_EMPRESA
,US_NOMBRE
,US_CARGO
,US_CIUDAD
,US_EMAIL
,US_TELEFONO_MOVIL
,US_TELEFONO_OFICINA
,US_URL_TIENDA
,US_COMENTARIOS
)

VALUES 
(pUS_EMPRESA
,pUS_NOMBRE
,pUS_CARGO
,pUS_CIUDAD
,pUS_EMAIL
,pUS_TELEFONO_MOVIL
,pUS_TELEFONO_OFICINA
,pUS_URL_TIENDA
,pUS_COMENTARIOS
);


END IF;

SELECT vRESPUESTA AS RESPUESTA
,vCOMENTARIO AS COMENTARIO;

END;;





