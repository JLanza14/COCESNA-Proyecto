DROP PROCEDURE IF EXISTS SP_ACTUALIZARFILTRO;
DELIMITER $$
CREATE PROCEDURE SP_ACTUALIZARFILTRO( 
						IN pnId						INT,
						IN pcPregunta  	  			VARCHAR(150), 
						IN pcTipoRespuesta			INT 
)
SP:BEGIN
			
         UPDATE pregunta_filtro SET  pregunta_filtro=pcPregunta,tipo_respuesta_idTipoR=pcTipoRespuesta
         WHERE idFiltro=pnId;
END $$
DELIMITER ;

/*
call SP_ACTUALIZARFILTRO(2,'pregunta actulizada', 2);
*/