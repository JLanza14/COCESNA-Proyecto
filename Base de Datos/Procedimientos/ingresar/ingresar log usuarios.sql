	DROP PROCEDURE IF EXISTS SP_INLOGUSUARIOS;
	DELIMITER $$
	CREATE PROCEDURE SP_INLOGUSUARIOS(
						IN pnTipoAccion INT,
						IN pnIdUSR INT
                        )
	SP:BEGIN
    DECLARE vConcatenacion varchar(400);
	SET vConcatenacion=(SELECT  concat('IdPersonal: ',id_personal,' Nombre: ',nombres,' ',apellidos,' FechaNacimiento: ',fecha_nacimiento,' Sexo: ' ,sexo,' No. Empleado: ',no_empleado,' Activo: ',activo)
						from personal1                      
						where (select personal_id_personal from user1 order by id desc limit 1)=id_personal
                        ORDER BY id_personal DESC LIMIT 1) ;
		INSERT INTO `ccocesna`.`log_usuarios`
		(`tipo_accion_id_accion`,`user_id`,`fecha_accion`,`detalle_anterior`,`detalle_Nuevo`)
		VALUES
		(1,pnIdUSR,(select current_timestamp()) ,null,vConcatenacion);
				 
END $$
DELIMITER ;
/*
call SP_INLOGUSUARIOS(1,1);
*/