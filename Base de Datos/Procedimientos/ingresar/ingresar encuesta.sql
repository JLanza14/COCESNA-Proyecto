DROP PROCEDURE IF EXISTS SP_INENCUESTA;
DELIMITER $$
CREATE PROCEDURE SP_INENCUESTA()
SP:BEGIN
	        
       /**/
       
       INSERT INTO encuesta(fecha_encuesta)
       VALUES((select current_timestamp()));
        
        /**/
        
END $$
DELIMITER ;