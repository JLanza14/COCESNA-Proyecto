DROP PROCEDURE IF EXISTS SP_ACTUALIZARUSER;
DELIMITER $$
CREATE PROCEDURE SP_ACTUALIZARUSER(
					IN pnId			INT(11),
					IN pnPosicionId INT,
                    IN pnPersonalId INT,
                    IN pcUsuario VARCHAR(255),
                    IN pcCorreo VARCHAR(255),
                    IN pnStatus SMALLINT(6)
                    )
SP:BEGIN

	UPDATE user1  SET posicion_id_posicion=pnPosicionId,personal_id_personal=pnPersonalId,username=pcUsuario,email=pcCorreo,`status`=pnStatus,updated_at=(select YEAR(current_date())) WHERE id=pnId;
	UPDATE `user`  SET username=pcUsuario,email=pcCorreo,`status`=pnStatus,updated_at=(select YEAR(current_date())) WHERE id=pnId;
    
END $$
DELIMITER ;
/*
call SP_ACTUALIZARUSER(1,1,1,'JuanLopez1971','juanlopez@gmail.com',20);
*/