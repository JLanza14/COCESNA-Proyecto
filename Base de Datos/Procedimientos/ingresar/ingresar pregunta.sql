DROP PROCEDURE IF EXISTS SP_INPREGUNTA;
DELIMITER $$
CREATE PROCEDURE SP_INPREGUNTA( 
						IN pcPregunta 	VARCHAR(200), 
						IN pnTipoR		INT,
                        IN pnCategoria	INT)
SP:BEGIN

        INSERT INTO pregunta (pregunta,tipo_respuesta_idTipoR,categorias_id_categoria) 
        VALUES (pcPregunta,pnTipoR,pnCategoria);

END $$
DELIMITER ;
/*
call SP_INPREGUNTA('PREGUNTA 1',2,1);
*/