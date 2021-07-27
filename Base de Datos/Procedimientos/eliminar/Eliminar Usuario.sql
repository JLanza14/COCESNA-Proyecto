DROP PROCEDURE IF EXISTS SP_BORRARUSUARIO;
DELIMITER $$
CREATE PROCEDURE SP_BORRARUSUARIO(
								IN pIdUsuario INT)
BEGIN
DECLARE vIdPersonal INT;
DECLARE vConcatenacion varchar(400);

SET vIdPersonal=(select personal_id_personal from user1 where id=pIdUsuario);
SET vConcatenacion=(SELECT  concat('IdPersonal: ',id_personal,' Nombre: ',nombres,' ',apellidos,' FechaNacimiento: ',fecha_nacimiento,' Sexo: ' ,sexo,' No. Empleado: ',no_empleado,' Activo: ',activo)
					from personal1 where (select personal_id_personal from user1  where id=pIdusuario)=id_personal);
	
    
	DELETE FROM user_x_turnos WHERE user_id=pIdUsuario;
    DELETE FROM enviar_notificacion WHERE user_id=pIdUsuario;
    
    DELETE FROM `user` WHERE id=pIdUsuario;
	DELETE FROM personal WHERE id_personal=vIdPersonal;
    
    SET foreign_key_checks = 0;
    DELETE FROM personal1 WHERE id_personal=vIdPersonal;
    DELETE FROM user1 WHERE id=pIdUsuario;  
    
    INSERT INTO `ccocesna`.`log_usuarios`
    (`tipo_accion_id_accion`,`user_id`,`fecha_accion`,`detalle_anterior`,`detalle_Nuevo`)
	VALUES	(3,pIdUsuario,(select current_timestamp()) ,null,vConcatenacion);
    
    SET foreign_key_checks = 1;
END$$
DELIMITER ;
/*
CALL SP_BORRARUSUARIO(1);
*/
