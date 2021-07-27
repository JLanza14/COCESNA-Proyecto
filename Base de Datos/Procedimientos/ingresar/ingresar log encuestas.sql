DROP PROCEDURE IF EXISTS SP_INLOGENCUESTA;
DELIMITER $$
CREATE PROCEDURE SP_INLOGENCUESTA(
	IN pnEncuestaId			INT,
    IN pnPreguntaId			INT,
    IN pnPreguntaR			INT,
    IN pnUsuarioId			INT,
    IN pcRespuesta			VARCHAR(45)
    )
SP:BEGIN
	        
       /**/
       
       INSERT INTO log_encuestas(encuesta_id_encuesta,preguntas_id_pregunta,preguntas_tipo_respuesta_idTipoR,user_id,respuesta)
       VALUES(pnEncuestaId, pnPreguntaId, pnPreguntaR,pnUsuarioId,pcRespuesta );
        /**/
        
END $$
DELIMITER ;