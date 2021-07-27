DROP PROCEDURE IF EXISTS SP_INFILTRO;
DELIMITER $$
CREATE PROCEDURE SP_INFILTRO( 
						IN pcPregunta 	VARCHAR(150), 
						IN pnTipoR		INT
                        )
SP:BEGIN
         INSERT INTO pregunta_filtro(pregunta_filtro,tipo_respuesta_idTipoR)
         VALUES (pcPregunta,pnTipoR);
         
END $$
DELIMITER ;
/*
call SP_INFILTRO('Se siente completamente apto para realizar su turno',2);
*/
