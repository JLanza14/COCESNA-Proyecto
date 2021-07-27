DROP PROCEDURE IF EXISTS SP_ACTUALIZARPREGUNTA;
DELIMITER $$
CREATE PROCEDURE SP_ACTUALIZARPREGUNTA( 
						IN pnId						INT,
						IN pcPregunta  	  			VARCHAR(150), 
						IN pnTipoRespuesta			INT,
                        IN pncategoria				INT
)
SP:BEGIN			
         UPDATE pregunta SET  pregunta=pcPregunta,tipo_respuesta_idTipoR=pnTipoRespuesta,categorias_id_categoria=pncategoria
         WHERE id_pregunta=pnId;
END $$
DELIMITER ;

/*
call SP_ACTUALIZARPREGUNTA(3,'pregunta actulizada', 2,2);
*/
