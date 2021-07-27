DROP PROCEDURE IF EXISTS SP_INUSUARIOSXTURNOS;
DELIMITER $$
CREATE PROCEDURE SP_INUSUARIOSXTURNOS( 
						IN pnUserId		INT,
                        IN pnTurnoId INT
						)
SP:BEGIN
          INSERT INTO user_x_turnos (user_id,turnos_id_turno)
          VAlUES ( pnUserId,pnTurnoId);  
END $$
DELIMITER ;
/*
CALL SP_INUSUARIOSXTURNOS(1,1);
*/
