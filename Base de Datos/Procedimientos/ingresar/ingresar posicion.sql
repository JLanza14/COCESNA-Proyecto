DROP PROCEDURE IF EXISTS SP_INPOSICION;
DELIMITER $$
CREATE PROCEDURE SP_INPOSICION( 
						IN pcPosicion 	VARCHAR(50)
)
SP:BEGIN
        INSERT INTO posicion1(posicion) 
        VALUES (pcPosicion);

        INSERT INTO posicion( id_posicion,posicion) 
        VALUES (
			( select id_posicion from posicion1 ORDER BY id_posicion DESC LIMIT 1),
            ( select posicion from posicion1 ORDER BY id_posicion DESC LIMIT 1)
        );				
END $$
DELIMITER ;
/*
call SP_INPOSICION('Controlador');
*/