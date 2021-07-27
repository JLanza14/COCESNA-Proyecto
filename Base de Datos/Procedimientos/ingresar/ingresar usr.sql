DROP PROCEDURE IF EXISTS SP_INUSR;
DELIMITER $$
CREATE PROCEDURE SP_INUSR(
					IN pnPosicionId INT,
                    IN pnPersonalId INT,
                    IN pcUsuario VARCHAR(255),
                    IN pcPass VARCHAR(32),
                    IN pcPassHash VARCHAR(255),
                    IN pcPassToken VARCHAR(255),
                    IN pcCorreo VARCHAR(255),
                    IN pnStatus SMALLINT(6),
                    IN pnCreado int,
                    IN pnActualizado int,
                    IN pcTokenVerificacion VARCHAR(255)
                    )
SP:BEGIN
/*VALORES NULOS: PASSWORDR_RESET_TOKEN,STATUS,VERIFICATION_TOKEN */       
	INSERT INTO `ccocesna`.`user1`
	(`posicion_id_posicion`,`personal_id_personal`,`username`,`auth_key`,`password_hash`,
    `password_reset_token`,`email`,`status`,`created_at`,`updated_at`,`verification_token`)
	VALUES
	(pnPosicionId,pnPersonalId,pcUsuario,pcPass,pcPassHash,
    pcPassToken,pcCorreo,pnStatus,pnCreado,pnActualizado, pcTokenVerificacion);
    
    IF pnPosicionId=3 then 
		insert into enviar_notificacion(user_id) values ((select id from user1 ORDER BY id DESC LIMIT 1));
	end if;

   INSERT INTO `ccocesna`.`user`
	(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,
    `email`,`status`,`created_at`,`updated_at`,`verification_token`)
	VALUES(
		( select id from user1 ORDER BY id DESC LIMIT 1),
        ( select username from user1 ORDER BY id DESC LIMIT 1),
        ( select auth_key from user1 ORDER BY id DESC LIMIT 1),
        ( select password_hash from user1 ORDER BY id DESC LIMIT 1),
        ( select password_reset_token from user1 ORDER BY id DESC LIMIT 1),
        ( select email from user1 ORDER BY id DESC LIMIT 1),
        ( select `status` from user1 ORDER BY id DESC LIMIT 1),
        ( select created_at from user1 ORDER BY id DESC LIMIT 1),
        ( select updated_at from user1 ORDER BY id DESC LIMIT 1),
        ( select verification_token from user1 ORDER BY id DESC LIMIT 1)
    );
      
END $$
DELIMITER ;

/*
call SP_INUSR(1,1,'JuanLopez1970','123',123,null,'juanLopez@gmail.com',10,2019,2019,null);
*/