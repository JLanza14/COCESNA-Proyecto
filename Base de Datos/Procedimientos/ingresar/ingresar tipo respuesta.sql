DROP PROCEDURE IF EXISTS SP_INTIPORESPUESTA;
DELIMITER $$
CREATE PROCEDURE SP_INTIPORESPUESTA( 
						IN pcRespuesta  	  		VARCHAR(45), 
						IN pcDetalle			VARCHAR(150)
)
SP:BEGIN
         /**/
		INSERT INTO tipo_respuesta(respuesta, detalle_respuesta)
		VALUES(pcRespuesta, pcDetalle);
        /**/
END $$
DELIMITER ;
/*
call SP_INTIPORESPUESTA('Escala 1','Tres niveles: Alto, Medio y Bajo');
*/
