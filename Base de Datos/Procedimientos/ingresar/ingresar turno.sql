DROP PROCEDURE IF EXISTS SP_INTURNOS;
DELIMITER $$
CREATE PROCEDURE SP_INTURNOS( 
						IN pcTurno 		VARCHAR(25), 
                        IN phHoraI 		TIME,
                        IN phHoraF 		TIME,
                        IN pnActivo		TINYINT(1)
)
SP:BEGIN
       INSERT INTO turnos1 (turno,hora_inicio,hora_fin,activo)
       VALUES (pcTurno,phHoraI,phHoraF,pnActivo);
       
       INSERT INTO turnos (id_turno,turno,hora_inicio,hora_fin,activo)
       VALUES (( select id_turno from turnos1 ORDER BY id_turno DESC LIMIT 1),
				( select turno from turnos1 ORDER BY id_turno DESC LIMIT 1),
                ( select hora_inicio from turnos1 ORDER BY id_turno DESC LIMIT 1),
                ( select hora_fin from turnos1 ORDER BY id_turno DESC LIMIT 1),
                ( select activo from turnos1 ORDER BY id_turno DESC LIMIT 1)
       );
END $$
DELIMITER ;
/*
call SP_INTURNOS('Dia',0800,1700,1);
*/