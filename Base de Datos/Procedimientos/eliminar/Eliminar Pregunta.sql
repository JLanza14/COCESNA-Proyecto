
DROP PROCEDURE IF EXISTS SP_BORRARPREGUNTA;
DELIMITER $$
CREATE PROCEDURE SP_BORRARPREGUNTA(
								IN pIdPregunta INT)
BEGIN
	
    DELETE FROM log_encuestas where preguntas_id_pregunta =pIdPregunta;
    DELETE FROM pregunta WHERE id_pregunta = pIdPregunta;
	
  
END$$
DELIMITER ;
/*
CALL SP_BORRARPREGUNTA(1);
*/
