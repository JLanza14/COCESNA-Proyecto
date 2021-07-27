DROP PROCEDURE IF EXISTS SP_INLOGPREGUNTAFILTRO;
DELIMITER $$
CREATE PROCEDURE SP_INLOGPREGUNTAFILTRO( 
						IN pnidUsuario		INT,
                        IN pnidPregunta		INT,
						IN pcRespuesta 	VARCHAR(45)
                        )
SP:BEGIN
		/*DECLARE		vFecha DATETIME;*/
       /* SET vFecha = (select current_timestamp());*/
        INSERT INTO log_pregunta_filtro (user_id,pregunta_filtro_idFiltro,respuesta,fecha )
        VALUES (pnidUsuario,pnidPregunta,pcRespuesta,(select current_timestamp()));
        
END $$
DELIMITER ;
/*
call SP_INLOGPREGUNTAFILTRO(1,1,'SI');
*/

